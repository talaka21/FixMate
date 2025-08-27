<?php

namespace App\Http\Controllers;

use App\Models\ServiceProvider;
use Illuminate\Http\Request;

class ServiceProviderController extends Controller
{
 public function create()
    {
        // جلب القوائم الجاهزة للفئات والمدن من قاعدة البيانات
        $categories = \App\Models\Category::all();
        $subcategories = \App\Models\Subcategory::all();
        $states = \App\Models\State::all();
        $cities = \App\Models\City::all();

        return view('service_providers.create', compact('categories', 'subcategories', 'states', 'cities'));
    }

    public function store(Request $request)
    {
        // التحقق من الحقول
        $request->validate([
            'provider_name' => 'required|string|max:255',
            'shop_name'     => 'required|string|max:255',
            'description'   => 'required|string',
            'phone'         => 'required|string|max:10',
            'whatsapp'      => 'nullable|string|max:10',
            'facebook'      => 'nullable|url',
            'instagram'     => 'nullable|url',
            'image'         => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'category_id'   => 'required|exists:categories,id',
            'subcategory_id'=> 'required|exists:subcategories,id',
            'state_id'      => 'required|exists:states,id',
            'city_id'       => 'required|exists:cities,id',
        ]);

        // رفع الصورة إذا وجدت
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('providers', 'public');
        }

        // حفظ البيانات
        ServiceProvider::create([
            'provider_name' => $request->provider_name,
            'shop_name'     => $request->shop_name,
            'description'   => $request->description,
            'phone'         => $request->phone,
            'whatsapp'      => $request->whatsapp,
            'facebook'      => $request->facebook,
            'instagram'     => $request->instagram,
            'image'         => $imagePath,
            'category_id'   => $request->category_id,
            'subcategory_id'=> $request->subcategory_id,
            'state_id'      => $request->state_id,
            'city_id'       => $request->city_id,
            'status'        => 'inactive', // الطلبات الجديدة بتكون غير مفعلة
        ]);

        return redirect()->route('service_providers.create')->with('success', 'تم إرسال طلبك بنجاح وسيتم مراجعته من قبل الإدارة.');
    }
}
