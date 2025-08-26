<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\state;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\stateController;
use App\Models\city;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        $states = state::all();
        return view('auth.register', compact('states'));
    }
 public function getCities($stateId)
{
    $cities = City::where('state_id', $stateId)->get()->map(function ($city) {
        return [
            'id' => $city->id,
            'name' => $city->getTranslation('name', app()->getLocale()), // ترجمة الاسم حسب اللغة الحالية
        ];
    });

    return response()->json($cities);
}


    public function register(Request $request)
    {
        // ✅ تحقق أولي من رقم الهاتف قبل أي شيء
        $existingUser = User::where('phone_number', $request->phone_number)->first();

        if ($existingUser) {
            // ✅ إذا الرقم مستخدم مسبقًا → رجوع مع رسالة خطأ
            return redirect()->back()->withErrors(['phone_number' => 'هذا الرقم مستخدم مسبقًا.']);
        }

        // ✅ تحقق من باقي البيانات
        $validated = $request->validate([
            'first_name' => 'required|string|max:50',
            'last_name' => 'required|string|max:50',
            'phone_number' => 'required|string|max:10|unique:users,phone_number',
            'email' => 'required|email|unique:users,email',
            'state_id' => 'required|exists:states,id',
            'city_id' => 'required|exists:cities,id',
            'password' => [
                'required',
                'confirmed',
                'min:8',
                 'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).+$/',
            ],
            'terms' => 'accepted',
        ]);

        // ✅ إنشاء المستخدم
        $user = User::create([
            'first_name' => $validated['first_name'],
            'last_name' => $validated['last_name'],
            'phone_number' => $validated['phone_number'],
            'email' => $validated['email'],
            'state_id' => $validated['state_id'],
            'city_id' => $validated['city_id'],
            'password' => Hash::make($validated['password']),
            'status' => 'active',
    'verify_code'   => rand(1000, 9999),
        ]);

        // ✅ توجيه لصفحة التحقق مع تمرير رقم الهاتف

return redirect()->route('verify.form', ['phone' => $user->phone_number]);

    }
}
