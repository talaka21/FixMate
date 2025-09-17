<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateProfileRequest;
use App\Models\city;
use App\Models\state;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
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

        // تحديث البيانات الأساسية
        $user->first_name = $request->first_name;
        $user->last_name  = $request->last_name;
      $user->phone_number = $request->phone_number;
        $user->state_id   = $request->state_id;
        $user->city_id    = $request->city_id;

        // التعامل مع رفع الصورة
        if ($request->hasFile('image')) {
            $file = $request->file('image');

            // حذف الصورة القديمة إذا موجودة
            if ($user->image && file_exists(public_path($user->image))) {
                unlink(public_path($user->image));
            }

            // إنشاء اسم فريد للملف الجديد
            $filename = uniqid() . '.' . $file->getClientOriginalExtension();

            // نقل الملف إلى مجلد public/profiles
            $file->move(public_path('profiles'), $filename);

            // حفظ المسار في قاعدة البيانات (نسبته إلى public)
            $user->image = 'profiles/' . $filename;
        }

        $user->save();

        return redirect()->route('welcome')->with('success', 'تم تحديث الملف الشخصي بنجاح ✅');
    }
}
