<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ __('Available Categories') }}</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: #fdfcff;
        }

        .category-card {
            transition: 0.3s ease-in-out;
            border: 2px solid #f0e6f0;
        }

        .category-card:hover {
            transform: translateY(-5px);
            box-shadow: 0px 6px 20px rgba(135, 43, 135, 0.3);
        }

        .category-title {
            color: #872b87;
            font-weight: bold;
        }

        .btn-primary {
            background-color: #872b87;
            border-color: #872b87;
        }

        .btn-primary:hover {
            background-color: #6b226b;
            border-color: #6b226b;
        }

        .page-title {
            color: #872b87;
            font-weight: bold;
        }

        .category-img {
            max-height: 200px;
            object-fit: cover;
            border-radius: 10px;
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-light bg-light mb-4">
        <div class="container">
            <span class="navbar-brand mb-0 h1">{{ config('app.name', 'My App') }}</span>
        </div>
    </nav>

    <!-- Categories -->
    <div class="container py-5">
        <h2 class="mb-4 text-center page-title">{{ __('Available Categories') }}</h2>

        <div class="row">
            @foreach($categories as $category)
                <div class="col-md-4 col-sm-6 mb-4">
                    <div class="card category-card h-100 text-center shadow-sm">

                        {{-- صورة الكاتيجوري --}}
                        @if($category->getFirstMediaUrl('thumbnails'))
                            <img src="{{ $category->getFirstMediaUrl('thumbnails') }}"
                                 class="img-fluid mb-3 category-img"
                                 alt="{{ $category->name }}">
                        @else
                            <img src="{{ asset('images/default.png') }}"
                                 class="img-fluid mb-3 category-img"
                                 alt="default">
                        @endif

                        <div class="card-body">
                            {{-- عنوان الكاتيجوري --}}
                            <h5 class="card-title category-title">
                                {{ $category->getTranslation('name', app()->getLocale()) }}
                            </h5>

                            {{-- وصف الكاتيجوري --}}
                            <p class="card-text">
                                {{ Str::limit($category->getTranslation('description', app()->getLocale()), 100) }}
                            </p>

                            {{-- زر التفاصيل --}}
                            <a href="{{ route('categories.show', $category->id) }}"
                               class="btn btn-primary">
                                {{ __('View Details') }}
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Footer -->
    <footer class="text-center py-4 bg-light mt-5">
        <p class="mb-0">&copy; {{ date('Y') }} {{ config('app.name', 'My App') }}</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
