<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use App\Services\OfferService;
use Illuminate\Http\Request;

class OfferController extends Controller
{
    private OfferService $offerService;

    public function __construct(OfferService $offerService)
    {
        $this->offerService = $offerService;
    }

    public function index(Request $request)
    {
        $shopName = $request->get('shop_name', null);
        $offers = $this->offerService->getOffers($shopName, 12);

        return view('offers.index', compact('offers'));
    }

    public function show(Offer $offer)
    {
        $offer = $this->offerService->getOffer($offer);

        return view('offers.show', compact('offer'));
    }
}
