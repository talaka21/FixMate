<div>
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ $category->getTranslation('name', app()->getLocale()) }}</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: #fdfcff;
        }
        .category-header {
            color: #872b87;
            font-weight: bold;
        }
        .card-title {
            color: #872b87;
            font-weight: bold;
        }
        .card a {
            text-decoration: none;
            color: inherit;
        }
    </style>
</head>
<body>

    <!-- Navbar بسيطة -->
    <nav class="navbar navbar-light bg-light mb-4">
        <div class="container">
            <a class="navbar-brand" href="{{ route('categories.index') }}">
                ← {{ __('Back to Categories') }}
            </a>
        </div>
    </nav>

    <!-- محتوى الصفحة -->
    <div class="container py-5">
        <h2 class="mb-3 category-header">
            {{ $category->getTranslation('name', app()->getLocale()) }}
        </h2>

        <p>{{ $category->getTranslation('description', app()->getLocale()) }}</p>

        {{-- التصنيفات الفرعية --}}
        @if($category->subcategories && $category->subcategories->count() > 0)
            <h4 class="mt-4">{{ __('Subcategories') }}</h4>
            <div class="row">
                @foreach($category->subcategories as $sub)
                    <div class="col-md-4 col-sm-6 mb-3">
                        <div class="card shadow-sm h-100 text-center">
                            <a href="{{ route('subcategories.show', $sub->id) }}">
                                @if($sub->thumbnail)
                                    <img src="{{ $sub->thumbnail }}" class="card-img-top" alt="Subcategory">
                                @endif
                                <div class="card-body">
                                    <h6 class="card-title">
                                        {{ $sub->getTranslation('name', app()->getLocale()) }}
                                    </h6>
                                </div>
                            </a>
                        </div>
                    </div>
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

</div>
