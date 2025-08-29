<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Service Providers</title>
    <style>
        body{font-family:"Tahoma",sans-serif;background:#f9f9f9;padding:20px;}
        h1{color:#8b4b8b;text-align:center}
        .providers{display:grid;grid-template-columns:repeat(auto-fill,minmax(280px,1fr));gap:20px;margin-top:20px;}
        .card{background:#fff;padding:15px;border-radius:12px;box-shadow:0 0 10px rgba(0,0,0,0.1);border-top:5px solid #8b4b8b;transition:.3s;display:flex;flex-direction:column;justify-content:space-between}
        .card:hover{transform:translateY(-5px);box-shadow:0 5px 15px rgba(139,75,139,.3)}
        .card img{width:100%;height:180px;object-fit:cover;border-radius:8px;margin-bottom:10px}
        .card h3{margin:0;color:#8b4b8b;font-size:18px}
        .card p{font-size:14px;color:#555;margin:8px 0;flex-grow:1}
        .meta{font-size:13px;color:#333;margin-top:8px;line-height:1.5}
        .empty{background:#fff;border-left:5px solid #8b4b8b;padding:16px;border-radius:10px;margin-top:16px;text-align:center}
        .pager{margin-top:20px;text-align:center}
        .btn{display:inline-block;background:#8b4b8b;color:#fff;padding:8px 14px;border-radius:8px;text-decoration:none;font-size:14px;margin-top:10px;transition:.3s}
        .btn:hover{background:#733a73}
    </style>
</head>
<body>

    <h1>🌟 Service Providers ({{ $providers->count() }})</h1>

    @forelse($providers as $provider)
        @if ($loop->first) <div class="providers"> @endif

        <div class="card">
            @if($provider->image)
                <img src="{{ asset('storage/'.$provider->image) }}" alt="{{ $provider->shop_name }}">
            @endif
            <h3>{{ $provider->shop_name }}</h3>
            <p>{{ \Illuminate\Support\Str::limit($provider->description, 100) }}</p>
            <div class="meta">
                📞 {{ $provider->phone }} <br>
                📍 {{ optional($provider->city)->name }}, {{ optional($provider->state)->name }} <br>
                🏷️ {{ optional($provider->category)->name }} → {{ optional($provider->subcategory)->name }}
            </div>
            <a href="{{ route('service_providers.show', $provider->id) }}" class="btn">عرض التفاصيل</a>
        </div>

        @if ($loop->last) </div> @endif
    @empty
        <div class="empty">
            لا يوجد مزودون في هذا التصنيف حتى الآن.
        </div>
    @endforelse

    @if(method_exists($providers,'links'))
        <div class="pager">{{ $providers->links() }}</div>
    @endif

</body>
</html>
