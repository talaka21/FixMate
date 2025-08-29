<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $serviceProvider->shop_name }}</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: #fdfcff;
        }
        .page-header {
            color: #872b87;
            font-weight: bold;
        }
        .card-title {
            color: #872b87;
            font-weight: bold;
        }
        .badge {
            font-size: 0.75rem;
        }
        .gallery img {
            max-height: 150px;
            object-fit: cover;
        }
        .contact-icons a {
            margin: 0 5px;
            font-size: 1.5rem;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-light bg-light mb-4">
        <div class="container">
            <a class="navbar-brand" href="{{ route('service_providers.index') }}">
                ← {{ __('Back to Service Providers') }}
            </a>
        </div>
    </nav>

    @php
        $locale = app()->getLocale();
        // Category name
        $categoryName = is_array($serviceProvider->category?->name)
            ? ($serviceProvider->category?->name[$locale] ?? $serviceProvider->category?->name['en'] ?? '')
            : $serviceProvider->category?->name;

        // Subcategory name
        $subcategoryName = is_array($serviceProvider->subcategory?->name)
            ? ($serviceProvider->subcategory?->name[$locale] ?? $serviceProvider->subcategory?->name['en'] ?? '')
            : $serviceProvider->subcategory?->name;
    @endphp

    <div class="container py-5">
        <!-- Shop Name -->
        <h2 class="mb-3 page-header">{{ $serviceProvider->shop_name }}</h2>

        <!-- Thumbnail -->
        @if($serviceProvider->image)
            <div class="mb-4">
                <img src="{{ asset('storage/' . $serviceProvider->image) }}" class="img-fluid rounded shadow-sm" alt="Shop">
            </div>
        @endif

        <!-- Related Category & Subcategory -->
        <p>
            <strong>{{ __('Category:') }}</strong>
            @if($serviceProvider->category)
                <a href="{{ route('categories.show', $serviceProvider->category->id) }}">
                    {{ $categoryName }}
                </a>
            @else
                {{ __('N/A') }}
            @endif
        </p>

        <p>
            <strong>{{ __('Subcategory:') }}</strong>
            @if($serviceProvider->subcategory)
                <a href="{{ route('subcategories.show', $serviceProvider->subcategory->id) }}">
                    {{ $subcategoryName }}
                </a>
            @else
                {{ __('N/A') }}
            @endif
        </p>

        <!-- Gallery -->
        @if($serviceProvider->gallery && count($serviceProvider->gallery) > 0)
            <h5 class="mt-4">{{ __('Gallery') }}</h5>
            <div class="row gallery">
                @foreach($serviceProvider->gallery as $image)
                    <div class="col-md-3 col-6 mb-3">
                        <img src="{{ asset('storage/' . $image) }}" class="img-fluid rounded shadow-sm" alt="Gallery">
                    </div>
                @endforeach
            </div>
        @endif

        <!-- Description -->
        <h5 class="mt-4">{{ __('Description') }}</h5>
        <p>{{ $serviceProvider->description }}</p>

        <!-- Location -->
        <p><strong>{{ __('State:') }}</strong> {{ $serviceProvider->state?->name ?? __('N/A') }}</p>
        <p><strong>{{ __('City:') }}</strong> {{ $serviceProvider->city?->name ?? __('N/A') }}</p>

        <!-- Tags -->
        @if($serviceProvider->tags && $serviceProvider->tags->count() > 0)
            <h5 class="mt-4">{{ __('Tags') }}</h5>
            <div>
                @foreach($serviceProvider->tags as $tag)
                    <span class="badge bg-info text-dark">{{ $tag->name }}</span>
                @endforeach
            </div>
        @endif

        <!-- Contact Details -->
        <h5 class="mt-4">{{ __('Contact Details') }}</h5>
        <div class="contact-icons">
            @if($serviceProvider->phone)
                <a href="tel:{{ $serviceProvider->phone }}" class="btn btn-outline-primary"> 📞 {{ __('Call') }} </a>
            @endif
            @if($serviceProvider->whatsapp)
                <a href="https://wa.me/{{ $serviceProvider->whatsapp }}?text=Welcome%20to%20FixMate%20App!" target="_blank" class="btn btn-outline-success"> 💬 WhatsApp </a>
            @endif
            @if($serviceProvider->facebook)
                <a href="{{ $serviceProvider->facebook }}" target="_blank" class="btn btn-outline-primary"> 📘 Facebook </a>
            @endif
            @if($serviceProvider->instagram)
                <a href="{{ $serviceProvider->instagram }}" target="_blank" class="btn btn-outline-danger"> 📷 Instagram </a>
            @endif
        </div>

        <!-- Offers -->
        @if($serviceProvider->offers && $serviceProvider->offers->count() > 0)
            <h5 class="mt-4">{{ __('Offers') }}</h5>
            <div class="row">
                @foreach($serviceProvider->offers as $offer)
                    @if($offer->is_active)
                        <div class="col-md-4 col-sm-6 mb-3">
                            <div class="card shadow-sm h-100">
                                <img src="{{ asset('storage/' . $offer->image) }}" class="card-img-top" alt="Offer">
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        @endif
    </div>

    <!-- Footer -->
    <footer class="text-center py-4 bg-light mt-5">
        <p class="mb-0">&copy; {{ date('Y') }} {{ config('app.name', 'My App') }}</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
