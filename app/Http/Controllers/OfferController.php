<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use Illuminate\Http\Request;

class OfferController extends Controller
{ public function index(Request $request)
    {
        $query = Offer::with('serviceProvider');

        // البحث باسم المتجر (shop_name)
        if ($request->filled('shop_name')) {
            $query->whereHas('serviceProvider', function($q) use ($request) {
                $q->where('shop_name', 'like', '%' . $request->shop_name . '%');
            });
        }

        $offers = $query->latest()->paginate(12);

        return view('offers.index', compact('offers'));
    }

    // عرض تفاصيل عرض محدد
    public function show(Offer $offer)
    {
        $offer->load('serviceProvider'); // جلب معلومات المزود

        return view('offers.show', compact('offer'));
    }
}
