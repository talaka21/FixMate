<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('offers') }} - FixMate</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: #fdfcff;
        }
        h1 {
            color: #8b4b8b;
            font-weight: bold;
        }
        .offer-card {
            border-radius: 12px;
            overflow: hidden;
            transition: transform 0.2s ease-in-out;
        }
        .offer-card:hover {
            transform: scale(1.03);
        }
        .btn-back {
            background-color: #8b4b8b;
            color: #fff;
            border-radius: 30px;
        }
        .btn-back:hover {
            background-color: #733a73;
        }
    </style>
</head>
<body>
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>🎁 {{ __('available_offers') }}</h1>
        <a href="{{ url('/') }}" class="btn btn-back">⬅ {{ __('back') }}</a>
    </div>

    <!-- Search Form -->
    <form method="GET" action="{{ route('offers.index') }}" class="mb-4">
        <div class="input-group">
            <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="{{ __('search_shop') }}">
            <button class="btn btn-back" type="submit">🔍 {{ __('search') }}</button>
        </div>
    </form>

    <div class="row">
        @forelse($offers as $offer)
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm offer-card h-100">
                    @if($offer->image)
                        <img src="{{ asset('storage/' . $offer->image) }}" class="card-img-top" alt="{{ __('offer_image') }}">
                    @else
                        <img src="https://via.placeholder.com/400x250?text=No+Image" class="card-img-top" alt="{{ __('no_image') }}">
                    @endif
                    <div class="card-body text-center">
                        <h5 class="card-title">{{ $offer->title }}</h5>
                        <p class="text-muted">
                            🏪 {{ $offer->serviceProvider->shop_name ?? __('unknown_shop') }}
                        </p>
                        <a href="{{ route('service_providers.show', $offer->serviceProvider->id) }}"
                           class="btn btn-sm"
                           style="background-color:#8b4b8b; color:#fff; border-radius:30px;">
                           {{ __('view_provider') }}
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <p class="text-center text-muted">{{ __('no_offers') }}</p>
        @endforelse
    </div>
</div>
</body>
</html>
