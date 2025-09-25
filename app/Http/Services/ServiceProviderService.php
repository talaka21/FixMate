<?php

namespace App\Services;

use App\Mail\NewProviderRequest;
use App\Models\AboutUs;
use App\Models\Category;
use App\Models\City;
use App\Models\ServiceProvider;
use App\Models\State;
use App\Models\Subcategory;
use App\Models\Tag;
use Illuminate\Support\Facades\Mail;

class ServiceProviderService
{
    
    public function getProviders(int $perPage = 12)
    {
        return ServiceProvider::with(['category', 'subcategory', 'state', 'city'])
                              ->paginate($perPage);
    }


    public function getProvidersBySubcategory(int $subcategoryId, int $perPage = 12)
    {
        return ServiceProvider::with(['category', 'subcategory', 'state', 'city'])
                              ->where('subcategory_id', $subcategoryId)
                              ->latest()
                              ->paginate($perPage);
    }


    public function getProvider(ServiceProvider $provider): ServiceProvider
    {
        $provider->increment('views');
        return $provider->load(['category', 'subcategory', 'state', 'city']);
    }


    public function createProvider(array $data, $image = null): ServiceProvider
    {
        $provider = ServiceProvider::create($data);

        if ($image) {
            $provider->addMedia($image)->toMediaCollection('image');
        }

        $adminEmail = config('mail.admin_email');
        Mail::to($adminEmail)->queue(new NewProviderRequest($provider));

        return $provider;
    }

    public function searchProviders(array $filters, int $perPage = 12)
    {
        $query = ServiceProvider::query();

        if (!empty($filters['shop_name'])) {
            $query->where('shop_name', 'like', "%{$filters['shop_name']}%");
        }
        if (!empty($filters['category_id'])) {
            $query->where('category_id', $filters['category_id']);
        }
        if (!empty($filters['subcategory_id'])) {
            $query->where('subcategory_id', $filters['subcategory_id']);
        }
        if (!empty($filters['tags'])) {
            $tags = explode(',', $filters['tags']);
            $query->whereHas('tags', fn($q) => $q->whereIn('id', $tags));
        }

        return $query->paginate($perPage);
    }


    public function getSubcategories(int $categoryId)
    {
        return Subcategory::where('category_id', $categoryId)->get()->map(fn($sub) => [
            'id' => $sub->id,
            'name' => $sub->getTranslation('name', app()->getLocale()),
        ]);
    }

    public function getCities(int $stateId)
    {
        return City::where('state_id', $stateId)->get()->map(fn($city) => [
            'id' => $city->id,
            'name' => $city->getTranslation('name', app()->getLocale()),
        ]);
    }

    /**
     * List providers for homepage with session-based ordering
     */
    public function listProviders($session, int $perPage = 12)
    {
        $query = ServiceProvider::with(['tags']);

        if ($session->has('visited_before')) {
            $query->orderByDesc('views');
        } else {
            $query->inRandomOrder();
            $session->put('visited_before', true);
        }

        return $query->paginate($perPage);
    }
}
