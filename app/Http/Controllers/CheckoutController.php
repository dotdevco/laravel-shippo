<?php

namespace App\Http\Controllers;

use App\Product;
use App\Http\Requests;
use App\Services\Shipping;
use Illuminate\Http\Request;
use App\Repositories\UserRepository;

class CheckoutController extends Controller
{
    /**
     * @var Shipping
     */
    private $shipping;

    /**
     * @var UserRepository
     */
    private $user;

    /**
     * CheckoutController constructor.
     * @param UserRepository $user
     * @param Shipping $shipping
     */
    public function __construct(UserRepository $user, Shipping $shipping)
    {
        $this->middleware('auth');
        $this->shipping = $shipping;
        $this->user = $user;
    }

    /**
     * Show the checkout page that
     * lists all the shipping rates
     *
     * @return View
     */
    public function index()
    {
        // Grabbed the logged in user.
        $user = auth()->user();

        // Here we are faking a product and this would typically
        // come from the cart and then look it up from the database
        $product = new Product([
            'length'=> '5',
            'width'=> '5',
            'height'=> '5',
            'distance_unit'=> 'in',
            'weight'=> '2',
            'mass_unit'=> 'lb',
        ]);

        // Now that we have all the data lets try to
        // get a list of shipping providers and pricing
        $rates = $this->shipping->rates($user, $product);

// The rates is a complete object but for this we
// only need the rates_list items and will pass that.
return view('checkout.index', ['rates' => $rates->rates_list]);
    }

    /**
     * Complete the order and
     * return the tracking information
     *
     * @param Request $request
     * @return View
     */
    public function store(Request $request)
    {
        // validate all the data and
        // add your own rules here.
        $this->validate($request, [
            'rate' => 'required',
        ]);

        // now that the user has selected the rate
        // build out the shipping label and tracking
        // in this situation the rate is the object_id
        $transaction = $this->shipping->createLabel($request->rate);

        // If it failed then redirect back and tell them whats wrong
        if ($transaction["object_status"] != "SUCCESS"){
            return back()->withMessage($transaction["messages"]);
        }

        // At this point we have our transaction with a
        // label url and a tracking number. Typically you'd
        // log this with the order and email them the receipt.

        // For the purpose of this tutorial we will just
        // return a view with a fictional order and receipt..
        return view('checkout.thanks', [
            'shipping' => $transaction,
        ]);
    }
}
