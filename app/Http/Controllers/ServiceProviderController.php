<?php

namespace App\Http\Controllers;

use App\Http\Requests\ServiceProviderRequest;
use App\Models\AboutUs;
use App\Models\Category;
use App\Models\City;
use App\Models\State;
use App\Models\Subcategory;
use App\Models\Tag;
use App\Models\ServiceProvider;
use App\Services\ServiceProviderService;
use Illuminate\Http\Request;

class ServiceProviderController extends Controller
{
    private ServiceProviderService $service;

    public function __construct(ServiceProviderService $service)
    {
        $this->service = $service;
    }

    public function index(Request $request)
    {
        $providers = $this->service->getProviders(12);

        return view('service_providers.index', [
            'providers' => $providers,
            'categories' => Category::all(),
            'subcategories' => Subcategory::all(),
            'states' => State::all(),
            'cities' => City::all(),
        ]);
    }

    public function create(Request $request)
    {
        $states = State::all();
        $cities = City::all();

        $subcategory = $request->filled('subcategory_id') ? Subcategory::find($request->subcategory_id) : null;
        $category = $subcategory ? $subcategory->category : null;

        return view('service_providers.create', [
            'states' => $states,
            'cities' => $cities,
            'subcategory' => $subcategory,
            'category' => $category,
            'categories' => $subcategory ? collect([$category]) : Category::all(),
            'subcategories' => $subcategory ? collect([$subcategory]) : Subcategory::all(),
        ]);
    }

    public function store(ServiceProviderRequest $request)
    {
        $provider = $this->service->createProvider(
            $request->validated(),
            $request->file('image')
        );

        return redirect()->route('subcategories.providers', $provider->subcategory_id)
                         ->with('success', 'Your request has been submitted successfully!');
    }

    public function show(ServiceProvider $serviceProvider)
    {
        $serviceProvider = $this->service->getProvider($serviceProvider);
        return view('service_providers.show', compact('serviceProvider'));
    }

    public function bySubcategory($id)
    {
        $providers = $this->service->getProvidersBySubcategory($id);
        $subcategory = Subcategory::findOrFail($id);

        return view('service_providers.index', compact('providers', 'subcategory'));
    }

    public function search(Request $request)
    {
        $about = AboutUs::first();
        $serviceProviders = $this->service->searchProviders($request->all());

        return view('welcome', [
            'serviceProviders' => $serviceProviders,
            'categories' => Category::all(),
            'subcategories' => Subcategory::all(),
            'tags' => Tag::all(),
            'about' => $about,
        ]);
    }

    public function getSubcategories($categoryId)
    {
        return response()->json($this->service->getSubcategories($categoryId));
    }

    public function getCities($stateId)
    {
        return response()->json($this->service->getCities($stateId));
    }

    public function list(Request $request)
    {
        $serviceProviders = $this->service->listProviders($request->session());

        return view('service_providers.list', compact('serviceProviders'));
    }
}
