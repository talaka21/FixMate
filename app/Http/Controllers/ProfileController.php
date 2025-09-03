<?php

namespace App\Http\Controllers;

use App\Models\city;
use App\Models\state;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
      public function edit()
    {
        $user = Auth::user();
        $states = state::where('active', 1)->get();
        $cities = city::where('state_id', $user->state_id)->get();

        return view('profile.edit', compact('user', 'states', 'cities'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'first_name' => 'required|string|max:100',
            'last_name'  => 'required|string|max:100',
            'phone'      => 'required|string',
            'state_id'   => 'required|exists:states,id',
            'city_id'    => 'required|exists:cities,id',
            'image'      => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
        ]);

        // تحديث البيانات
        $user->first_name = $request->first_name;
        $user->last_name  = $request->last_name;
        $user->state_id   = $request->state_id;
        $user->city_id    = $request->city_id;

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('profiles', 'public');
            $user->image = $path;
        }

        $user->save();

        return redirect()->route('profile.edit')->with('success', 'تم تحديث الملف الشخصي بنجاح ✅');
    }
}
