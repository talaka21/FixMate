<?php

namespace App\Http\Controllers;

use App\Http\Requests\ResetPasswordRequest;
use App\Models\PhonePasswordReset;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ResetPasswordController extends Controller
{
 public function showForm($phone)
    {
        // يعرض صفحة إعادة التعيين ويبعث رقم الهاتف للـ Blade
        return view('auth.passwordReset', compact('phone'));
    }

      public function reset(ResetPasswordRequest $request)
    {
        $data = $request->validated();

        $user = User::where('phone_number', $data['phone'])->firstOrFail();

        $user->password = Hash::make($data['password']);
        $user->save();

        PhonePasswordReset::where('phone_number', $data['phone'])->delete();

        return redirect()->route('login')
                         ->with('success', '✅ Password has been successfully reset, please login.');
    }
}
