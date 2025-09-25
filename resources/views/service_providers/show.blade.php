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

        /* اللون الأساسي */
        :root {
            --primary-color: #8b4b8b;
        }

        .page-header {
            color: var(--primary-color);
            font-weight: bold;
        }

        .card-title {
            color: var(--primary-color);
            font-weight: bold;
        }

        .badge {
            font-size: 0.85rem;
        }

        .gallery img {
            max-height: 150px;
            object-fit: cover;
            border-radius: 8px;
            transition: transform 0.2s;
        }

        .gallery img:hover {
            transform: scale(1.05);
        }

        .contact-icons a {
            margin: 5px 5px 5px 0;
            font-size: 1rem;
        }

        .btn-primary-custom {
            background-color: var(--primary-color);
            color: #fff;
            border-radius: 30px;
        }

        .btn-primary-custom:hover {
            background-color: #733a73;
            color: #fff;
        }

        .offer-card img {
            height: 200px;
            object-fit: cover;
        }
    </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-light bg-light mb-4 shadow-sm">
    <div class="container">
        <a class="navbar-brand btn btn-outline-secondary btn-sm px-3" href="{{ route('service_providers.index') }}">
            ← {{ __('back_to_providers') }}
        </a>
    </div>
</nav>

<div class="container py-5">

    <!-- Shop Name -->
    <h2 class="mb-3 page-header">{{ $serviceProvider->shop_name }}</h2>

    <!-- Thumbnail -->
    @if($serviceProvider->hasMedia('image'))
        <div class="mb-4">
            <img src="{{ $serviceProvider->getFirstMediaUrl('image') }}" class="img-fluid rounded shadow-sm" alt="{{ __('shop_image') }}">
        </div>
    @endif

    <!-- Category & Subcategory -->
    <p><strong>{{ __('category') }}:</strong>
        @php
            $categoryName = $serviceProvider->category?->name;
            if (is_array($categoryName)) {
                $categoryName = $categoryName[app()->getLocale()] ?? $categoryName['en'] ?? __('na');
            } else {
                $categoryName = $categoryName ?? __('na');
            }
        @endphp
        @if($serviceProvider->category)
            <a href="{{ route('categories.show', $serviceProvider->category->id) }}">
                {{ $categoryName }}
            </a>
        @else
            {{ __('na') }}
        @endif
    </p>

    <p><strong>{{ __('subcategory') }}:</strong>
        @php
            $subcategoryName = $serviceProvider->subcategory?->name;
            if (is_array($subcategoryName)) {
                $subcategoryName = $subcategoryName[app()->getLocale()] ?? $subcategoryName['en'] ?? __('na');
            } else {
                $subcategoryName = $subcategoryName ?? __('na');
            }
        @endphp
        @if($serviceProvider->subcategory)
            <a href="{{ route('subcategories.show', $serviceProvider->subcategory->id) }}">
                {{ $subcategoryName }}
            </a>
        @else
            {{ __('na') }}
        @endif
    </p>

    <!-- Gallery -->
    @if($serviceProvider->hasMedia('gallery'))
        <h5 class="mt-4">{{ __('gallery') }}</h5>
        <div class="row gallery">
            @foreach($serviceProvider->getMedia('gallery') as $image)
                <div class="col-md-3 col-6 mb-3">
                    <img src="{{ $image->getUrl() }}" class="img-fluid rounded shadow-sm" alt="{{ __('gallery_image') }}">
                </div>
            @endforeach
        </div>
    @endif

    <!-- Description -->
    <h5 class="mt-4">{{ __('description') }}</h5>
    <p>{{ $serviceProvider->description }}</p>

    <!-- Location -->
    <p><strong>{{ __('state') }}:</strong> {{ $serviceProvider->state?->name ?? __('na') }}</p>
    <p><strong>{{ __('city') }}:</strong> {{ $serviceProvider->city?->name ?? __('na') }}</p>

    <!-- Tags -->
    @if($serviceProvider->tags && $serviceProvider->tags->count() > 0)
        <h5 class="mt-4">{{ __('tags') }}</h5>
        <div>
            @foreach($serviceProvider->tags as $tag)
                <span class="badge bg-info text-dark">{{ $tag->name }}</span>
            @endforeach
        </div>
    @endif

    <!-- Contact -->
    <h5 class="mt-4">{{ __('contact_details') }}</h5>
    <div class="contact-icons">
        @if($serviceProvider->phone)
            <a href="tel:{{ $serviceProvider->phone }}" class="btn btn-primary-custom btn-sm">📞 {{ __('call') }}</a>
        @endif
        @if($serviceProvider->whatsapp)
            <a href="https://wa.me/{{ $serviceProvider->whatsapp }}?text=Welcome%20to%20FixMate%20App!" target="_blank" class="btn btn-success btn-sm">💬 WhatsApp</a>
        @endif
        @if($serviceProvider->facebook)
            <a href="{{ $serviceProvider->facebook }}" target="_blank" class="btn btn-primary btn-sm">📘 Facebook</a>
        @endif
        @if($serviceProvider->instagram)
            <a href="{{ $serviceProvider->instagram }}" target="_blank" class="btn btn-danger btn-sm">📷 Instagram</a>
        @endif
    </div>

    <!-- Offers -->
    @if($serviceProvider->offers && $serviceProvider->offers->count() > 0)
        <h5 class="mt-4">{{ __('offers') }}</h5>
        <div class="row">
            @foreach($serviceProvider->offers as $offer)
                @if($offer->is_active)
                    <div class="col-md-4 col-sm-6 mb-3">
                        <div class="card shadow-sm offer-card h-100">
                            <img src="{{ $offer->getFirstMediaUrl('image') }}" class="card-img-top" alt="{{ __('offer_image') }}">
                            <div class="card-body text-center">
                                <h6 class="card-title">{{ $offer->title }}</h6>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    @endif

</div>

<!-- Footer -->
<footer class="text-center py-4 bg-light mt-5 shadow-sm">
    <p class="mb-0">&copy; {{ date('Y') }} {{ config('app.name', 'FixMate') }}</p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
