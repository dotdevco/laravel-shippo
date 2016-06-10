<?php

namespace App\Http\Controllers;

use App\Product;
use App\Http\Requests;
use App\Services\Shipping;
use Illuminate\Http\Request;
use App\Repositories\UserRepository;

class CheckoutController extends Controller
{
    private $shipping;

    private $user;

    public function __construct(UserRepository $user, Shipping $shipping)
    {
        $this->middleware('auth');
        $this->shipping = $shipping;
        $this->user = $user;
    }

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
        try {
            $rates = $this->shipping->rates($user, $product);
        } catch (\Exception $e) {
            return $e->getMessage();
        }

        return view('checkout.index', ['rates' => $rates]);
    }

    public function store(Request $request)
    {
        // validate all the data
        $this->validate($request, [
            'rate' => 'required',
        ]);

        // now that the user has selected the rate
        // build out the shipping label and tracking
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
        echo( $transaction["label_url"] );
        echo("\n");
        echo( $transaction["tracking_number"] );

        // We are going to bail here because we have
        // created the transaction and shipping is done
        dd($transaction);

        // This will route to show method below.
        return redirect('checkout/thanks');
    }

    public function show()
    {
        dd('done');
    }
}
