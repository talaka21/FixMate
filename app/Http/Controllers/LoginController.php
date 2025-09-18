<?php

namespace App\Http\Controllers;

use App\Enum\UserEnum;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{

    // عرض صفحة تسجيل الدخول
    public function showForm()
    {
        return view('login'); // resources/views/login.blade.php
    }

    // تنفيذ عملية تسجيل الدخول
     // تنفيذ عملية تسجيل الدخول
   public function login(Request $request)
{
    // Validate input directly on the Request
    $data = $request->validate([
        'phone' => 'required|string|max:10',
        'password' => [
            'required',
            'string',
            'min:8',
            'regex:/[a-z]/',
            'regex:/[A-Z]/',
            'regex:/[0-9]/',
            'regex:/[@$!%*?&]/',
        ],
    ]);

    $phone = $data['phone'];
    $password = $data['password'];

    // Check if user exists
    $user = User::where('phone_number', $phone)->first();

    if (!$user) {
        return back()->withErrors(['phone' => 'Account does not exist']);
    }

    // Check password
    if (!Hash::check($password, $user->password)) {
        return back()->withErrors(['password' => 'Incorrect password']);
    }

    // Check account status
    if ($user->status === 'inactive') {
        return redirect()->route('verify.form', ['phone' => $user->phone_number]);
    }

    if ($user->status === 'suspended') {
        return back()->withErrors(['phone' => 'Account suspended, contact support']);
    }

    // Login successful
    Auth::login($user);
    return redirect()->intended(route('welcome'));
}


    }

