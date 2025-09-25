<?php

namespace App\Services\Auth;

use App\Models\City;
use App\Models\State;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegisterService
{
    /**

     */
    public function getStates()
    {
        return State::all();
    }

    /**
     *
     */
    public function getCities(int $stateId)
    {
        return City::where('state_id', $stateId)
            ->get()
            ->map(fn($city) => [
                'id' => $city->id,
                'name' => $city->getTranslation('name', app()->getLocale()),
            ]);
    }

    /**
    
     */
    public function registerUser(array $data): User
    {
        return User::create([
            'first_name'   => $data['first_name'],
            'last_name'    => $data['last_name'],
            'phone_number' => $data['phone_number'],
            'email'        => $data['email'],
            'state_id'     => $data['state_id'],
            'city_id'      => $data['city_id'],
            'password'     => Hash::make($data['password']),
            'status'       => 'active',
            'verify_code'  => rand(1000, 9999),
        ]);
    }


    public function checkPhoneExists(string $phone): bool
    {
        return User::where('phone_number', $phone)->exists();
    }
}
