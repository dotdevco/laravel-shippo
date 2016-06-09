<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Services\Shipping;
use Illuminate\Http\Request;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    private $user;

    private $shipping;

    public function __construct(UserRepository $user, Shipping $shipping)
    {
        $this->user = $user;
        $this->shipping = $shipping;
    }

    public function index()
    {
        return view('cart');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required', // Add other rules here..
        ]);

        $user = $this->user->findOrCreate($request);

        try {
            $this->shipping->validateAddress($user);
            // Login the user to the new account:
            Auth::login($user);
            return redirect('/checkout/');
        } catch (\Exception $e) {
            return back()->withError($e->getMessage());
        }
    }
}
