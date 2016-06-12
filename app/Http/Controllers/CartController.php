<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Services\Shipping;
use Illuminate\Http\Request;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * @var UserRepository
     */
    private $user;

    /**
     * @var Shipping
     */
    private $shipping;

    /**
     * CartController constructor.
     * @param UserRepository $user
     * @param Shipping $shipping
     */
    public function __construct(UserRepository $user, Shipping $shipping)
    {
        $this->user = $user;
        $this->shipping = $shipping;
    }

    /**
     * Show the cart
     *
     * @return View
     */
    public function index()
    {
        return view('cart');
    }

    /**
     * Create the user and get shipping information
     *
     * @param Request $request
     * @return Redirector
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required', // Add other rules here..
        ]);

        // Either find a user
        // or create a new one
        $user = $this->user->findOrCreate($request);

        // Try and validate the address
        $validate = $this->shipping->validateAddress($user);

        // Make sure it's not an invalid address this
        // could also be moved to a custom validator rule
        if ($validate->object_state == 'INVALID') {
            return back()->withMessages($validate->messages);
        }

        Auth::login($user);
        return redirect('/checkout/');
    }
}
