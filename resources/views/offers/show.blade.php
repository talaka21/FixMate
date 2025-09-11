<div>
  <h1>{{ $offer->title }}</h1>
  <img src="{{ asset('storage/'.$offer->image) }}" alt="{{ $offer->title }}" width="300">

  <p>{{ __('shop') }}: {{ $offer->serviceProvider->shop_name ?? '-' }}</p>
  <p>{{ __('start_date') }}: {{ $offer->start_date->format('Y-m-d') }}</p>
  <p>{{ __('end_date') }}: {{ $offer->expire_date->format('Y-m-d') }}</p>
</div>
