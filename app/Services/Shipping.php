<?php

namespace App\Services;

use Shippo;
use App\User;
use App\Product;
use Shippo_Address;
use Shippo_Shipment;
use Shippo_Transaction;

class Shipping 
{
    protected $fromAddress = [
        'object_purpose' => 'PURCHASE',
        'name' => 'Eric Barnes',
        'company' => 'dotdev inc.',
        'street1' => '814 Mission St.',
        'city' => 'San Francisco',
        'state' => 'CA',
        'zip' => '94105',
        'country' => 'US',
        'phone' => '+1 555 341 9393',
        'email' => 'shippotle@goshippo.com',
    ];

	public function __construct()
	{
        // Grab this private key from
        // .env and setup the Shippo api
		Shippo::setApiKey(env('SHIPPO_PRIVATE'));
	}

    /**
     * Validate an address through Shippo service
     *
     * @param User $user
     * @return \Shippo_Adress
     */
    public function validateAddress(User $user)
    {
        // Grab the shipping address from the User model
        $toAddress = $user->shippingAddress();

        // Pass a validate flag to Shippo
        $toAddress['validate'] = true;

        // Verify the address data
        return Shippo_Address::create($toAddress);
    }

    /**
     * Create a Shippo shipping rates
     *
     * @param User $user
     * @param Product $product
     * @return \Shippo_Get_Shipping_Rates
     */
    public function rates(User $user, Product $product)
    {
        // Grab the shipping address from the User model
        $toAddress = $user->shippingAddress();

        // Pass the PURCHASE flag.
        $toAddress['object_purpose'] = 'PURCHASE';

        // Get the shipment object
        $shipment = Shippo_Shipment::create([
                'object_purpose'=> 'PURCHASE',
                'address_from'=> $this->fromAddress,
                'address_to'=> $toAddress,
                'parcel'=> $product->toArray(),
                'insurance_amount'=> '30',
                'insurance_currency'=> 'USD',
                'async'=> false
        ]);

        // Finally return the rates.
        return Shippo_Shipment::get_shipping_rates(array('id'=> $shipment["object_id"]));
    }

    /**
     * Create the shipping label transaction
     *
     * @param $rate
     * @return Shippo_Transaction
     */
    public function createLabel($rate)
    {
        return Shippo_Transaction::create([
            'rate' => $rate,
            'label_file_type' => "PDF",
            'async' => false
        ]);
    }
}