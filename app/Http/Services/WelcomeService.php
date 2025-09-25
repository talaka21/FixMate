<?php

namespace App\Services;

use App\Models\AboutUs;
use App\Models\Category;
use App\Models\Offer;
use App\Models\ServiceProvider;
use App\Models\Subcategory;
use App\Models\Tag;
use Illuminate\Pagination\LengthAwarePaginator;

class WelcomeService
{
    /**
     * Get all necessary data for the homepage
     *
    
     */
    public function getData(?string $search = null, int $perPage = 12): array
    {
        $about = AboutUs::first();
        $categories = Category::all();
        $subcategories = Subcategory::all();
        $tags = Tag::all();

        $query = ServiceProvider::query();

        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('shop_name', 'like', "%{$search}%")
                  ->orWhereHas('category', fn($q2) => $q2->where('name', 'like', "%{$search}%"))
                  ->orWhereHas('subcategory', fn($q2) => $q2->where('name', 'like', "%{$search}%"))
                  ->orWhereHas('tags', fn($q2) => $q2->where('name', 'like', "%{$search}%"));
            });
        }

        $serviceProviders = $query->orderByDesc('views')->paginate($perPage);
        $offers = Offer::latest()->take(6)->get();

        return compact(
            'about',
            'categories',
            'subcategories',
            'tags',
            'serviceProviders',
            'offers'
        );
    }
}
