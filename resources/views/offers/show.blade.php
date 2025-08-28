<div>
  <h1>{{ $offer->title }}</h1>
<img src="{{ asset('storage/'.$offer->image) }}" alt="{{ $offer->title }}" width="300">
<p>المتجر: {{ $offer->serviceProvider->shop_name ?? '-' }}</p>
<p>تاريخ البداية: {{ $offer->start_date->format('Y-m-d') }}</p>
<p>تاريخ الانتهاء: {{ $offer->expire_date->format('Y-m-d') }}</p>

</div>
