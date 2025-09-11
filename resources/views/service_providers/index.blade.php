<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Service Providers</title>
    <style>
        body {
            font-family: "Tahoma", sans-serif;
            background: #f9f9f9;
            padding: 20px;
            margin: 0;
        }
        h1 {
            color: #8b4b8b;
            text-align: center;
            margin-bottom: 30px;
        }
        .back-btn {
            display: inline-block;
            background: #8b4b8b;
            color: #fff;
            padding: 10px 16px;
            border-radius: 10px;
            text-decoration: none;
            font-size: 15px;
            margin-bottom: 20px;
            transition: 0.3s;
        }
        .back-btn:hover {
            background: #733a73;
        }
        .providers {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 20px;
        }
        .card {
            background: #fff;
            padding: 15px;
            border-radius: 12px;
            box-shadow: 0 0 10px rgba(0,0,0,0.08);
            border-top: 5px solid #8b4b8b;
            transition: 0.3s;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(139,75,139,0.2);
        }
        .card img {
            width: 100%;
            height: 180px;
            object-fit: cover;
            border-radius: 8px;
            margin-bottom: 12px;
        }
        .card h3 {
            margin: 0 0 8px 0;
            color: #8b4b8b;
            font-size: 18px;
        }
        .card p {
            font-size: 14px;
            color: #555;
            margin: 0 0 10px 0;
            flex-grow: 1;
        }
        .meta {
            font-size: 13px;
            color: #333;
            line-height: 1.5;
            margin-bottom: 10px;
        }
        .empty {
            background: #fff;
            border-left: 5px solid #8b4b8b;
            padding: 18px;
            border-radius: 10px;
            margin-top: 16px;
            text-align: center;
            font-weight: bold;
            color: #555;
        }
        .btn {
            display: inline-block;
            background: #8b4b8b;
            color: #fff;
            padding: 8px 14px;
            border-radius: 8px;
            text-decoration: none;
            font-size: 14px;
            margin-top: 10px;
            transition: 0.3s;
        }
        .btn:hover {
            background: #733a73;
        }
        .pager {
            margin-top: 30px;
            text-align: center;
        }
    </style>
</head>
<body>
<a href="{{ route('welcome') }}" class="back-btn">{{ __('back_home') }}</a>

<h1>{{ __('service_providers', ['count' => $providers->count()]) }}</h1>

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
        <a href="{{ route('service_providers.show', $provider->id) }}" class="btn">{{ __('view_details') }}</a>
    </div>

    @if ($loop->last) </div> @endif
@empty
    <div class="empty">
        {{ __('no_providers') }}
    </div>
@endforelse


    @if(method_exists($providers,'links'))
        <div class="pager">{{ $providers->links() }}</div>
    @endif

</body>
</html>
