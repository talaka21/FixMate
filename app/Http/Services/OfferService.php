<?php

namespace App\Services;

use App\Models\Offer;
use Illuminate\Pagination\LengthAwarePaginator;

class OfferService
{
    /**
     * Get paginated offers with optional shop name search
     
     */
    public function getOffers(?string $shopName = null, int $perPage = 12): LengthAwarePaginator
    {
        $query = Offer::with('serviceProvider');

        if ($shopName) {
            $query->whereHas('serviceProvider', function($q) use ($shopName) {
                $q->where('shop_name', 'like', '%' . $shopName . '%');
            });
        }

        return $query->latest()->paginate($perPage);
    }

    /**
     * Get a single offer with related service provider
     */
    public function getOffer(Offer $offer): Offer
    {
        return $offer->load('serviceProvider');
    }
}
