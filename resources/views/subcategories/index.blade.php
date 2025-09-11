<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <title>{{ __('subcategories') }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f7f7f7;
            color: #333;
            direction: {{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }};
            text-align: {{ app()->getLocale() == 'ar' ? 'right' : 'left' }};
        }
        h1 {
            color: #a864a8;
            text-align: center;
            margin-top: 20px;
        }
        .language-switcher {
            text-align: center;
            margin: 15px 0;
        }
        .language-switcher a {
            padding: 8px 16px;
            background-color: #a864a8;
            color: white;
            text-decoration: none;
            border-radius: 8px;
            margin: 0 5px;
        }
        .subcategory-card {
            background: #fff;
            border: 2px solid #a864a8;
            border-radius: 12px;
            padding: 15px;
            margin: 15px auto;
            max-width: 600px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }
        .subcategory-card h2 {
            margin: 0;
            color: #a864a8;
        }
        .subcategory-card p {
            margin: 5px 0;
        }
    </style>
</head>
<body>
    <h1>{{ __('subcategories_list') }}</h1>

    <!-- Language Switch -->
    <div class="language-switcher">
        <a href="{{ url('locale/ar') }}">{{ __('arabic') }}</a>
        <a href="{{ url('locale/en') }}">{{ __('english') }}</a>
    </div>

   @foreach($subcategories as $subcategory)
    <div class="subcategory-card">
        {{-- Thumbnail --}}
        @if($subcategory->hasMedia('thumbnails'))
            <img src="{{ $subcategory->getFirstMediaUrl('thumbnails') }}"
                 alt="{{ $subcategory->getTranslation('name', app()->getLocale()) }}"
                 style="max-width: 100%; height: auto; border-radius: 8px; margin-bottom: 10px;">
        @endif

        {{-- Name --}}
        <h2>{{ $subcategory->getTranslation('name', app()->getLocale()) }}</h2>

        {{-- Description --}}
        <p><strong>{{ __('description') }}:</strong> {{ $subcategory->getTranslation('description', app()->getLocale()) }}</p>
    </div>
   @endforeach

</body>
</html>
