<?php

namespace App\Repositories;

use App\User;
use Illuminate\Http\Request;

class UserRepository
{
    public function findUserByEmail($email)
    {
        return User::where('email', $email)->first();
    }
    public function findOrCreate(Request $request)
    {
        if ($user = $this->findUserByEmail($request->email)) {
            return $user;
        }

        return User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'company' => $request->company,
            'street1' => $request->street1,
            'street2' => $request->street2,
            'city' => $request->city,
            'state' => $request->state,
            'zip' => $request->zip,
            'country' => $request->country,
            'phone' => $request->phone,
        ]);
    }
}