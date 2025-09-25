<?php

namespace App\Http\Controllers;

use App\Enum\UserEnum;
use App\Models\User;
use App\Services\AuthService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class LoginController extends Controller
{

       private AuthService $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function showForm()
    {
        return view('login');
    }



    public function login(Request $request)
    {
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

        $result = $this->authService->login($data['phone'], $data['password']);

        if ($result === null) {
            return back()->withErrors(['phone' => 'Account does not exist']);
        }

        if ($result === false) {
            return back()->withErrors(['password' => 'Incorrect password']);
        }

        if ($result === 'inactive') {
            return redirect()->route('verify.form', ['phone' => $data['phone']]);
        }

        if ($result === 'suspended') {
            return back()->withErrors(['phone' => 'Account suspended, contact support']);
        }

        // login successful
        return redirect()->intended(route('welcome'));
    }
    }

