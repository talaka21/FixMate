<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateProfileRequest;
use App\Models\City;
use App\Models\State;
use App\Services\ProfileService;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    private ProfileService $profileService;

    public function __construct(ProfileService $profileService)
    {
        $this->profileService = $profileService;
    }

    public function edit()
    {
        $user = Auth::user();
        $states = State::all();
        $cities = City::all()->groupBy('state_id');

        return view('profile.edit', compact('user', 'states', 'cities'));
    }

    public function update(UpdateProfileRequest $request)
    {
        $user = Auth::user();
        $data = $request->validated();
        $image = $request->file('image');

        $this->profileService->updateProfile($user, $data, $image);

        return redirect()->route('welcome')->with('success', 'Profile updated successfully ✅');
    }
}
