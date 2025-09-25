<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Services\Auth\RegisterService;

class RegisterController extends Controller
{
    private RegisterService $registerService;

    public function __construct(RegisterService $registerService)
    {
        $this->registerService = $registerService;
    }

    public function showRegistrationForm()
    {
        $states = $this->registerService->getStates();
        return view('auth.register', compact('states'));
    }

    public function getCities($stateId)
    {
        return response()->json($this->registerService->getCities($stateId));
    }

    public function register(RegisterRequest $request)
    {
        $data = $request->validated();

        $user = $this->registerService->registerUser($data);

        return redirect()->route('verify.form', ['phone' => $user->phone_number]);
    }
}
