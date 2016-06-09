<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'company',
        'street1', 'street2', 'city', 'state',
        'zip', 'country', 'phone',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Return the shipping data for a user
     * 
     * @return array
     */
    public function shippingAddress()
    {
        return [
            'name' => $this->name,
            'company' => $this->company,
            'street1' => $this->street1,
            'city' => $this->city,
            'state' => $this->state,
            'zip' => $this->zip,
            'country' => $this->country,
            'phone' => $this->phone,
            'email' => $this->email,
        ];
    }
}
