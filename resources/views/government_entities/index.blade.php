<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Government Entities - FixMate</title>
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
        .entity-card {
            border-radius: 12px;
            overflow: hidden;
            transition: transform 0.2s ease-in-out;
        }
        .entity-card:hover {
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
        .icon-btn {
            border: none;
            background: transparent;
            font-size: 1.3rem;
            margin: 0 5px;
        }
        .icon-btn.facebook { color: #3b5998; }
        .icon-btn.instagram { color: #E1306C; }
    </style>
</head>
<body>
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Government Entities</h1>
        <a href="{{ url('/') }}" class="btn btn-back">← Back</a>
    </div>

    <!-- Search -->
    <form method="GET" action="{{ route('government-entities.index') }}" class="mb-4">
        <input type="text" name="search" class="form-control" placeholder="Search by Entity Name..." value="{{ request('search') }}">
    </form>

    <div class="row">
        @forelse($entities as $entity)
            <div class="col-md-4 mb-4">
                <div class="card entity-card shadow-sm h-100 text-center p-3">

                    <!-- Thumbnail -->
                    @if($entity->getFirstMediaUrl('thumbnails'))
                        <img src="{{ $entity->getFirstMediaUrl('thumbnails') }}" class="img-fluid mb-3" alt="{{ $entity->getTranslation('name', app()->getLocale()) }}" style="max-height:120px; object-fit:contain;">
                    @else
                        <img src="https://via.placeholder.com/150x100.png?text=No+Image" class="img-fluid mb-3" alt="No Image">
                    @endif

                    <!-- Name -->
                    <h5 class="mb-2" style="color:#8b4b8b;">
                        {{ $entity->getTranslation('name', app()->getLocale()) }}
                    </h5>

                    <!-- Description -->
                    @if($entity->description)
                        <p class="text-muted mb-3">
                            {{ Str::limit($entity->getTranslation('description', app()->getLocale()), 100) }}
                        </p>
                    @endif

                    <!-- Phones -->
                    <div class="mb-2">
                        @foreach(explode(',', $entity->phone) as $phone)
                            <a href="tel:{{ trim($phone) }}" class="btn btn-sm btn-outline-success m-1">📞 Call</a>
                        @endforeach
                    </div>

                    <!-- Social Links -->
                    <div>
                        @if($entity->facebook_url)
                            <a href="{{ $entity->facebook_url }}" target="_blank" class="icon-btn facebook"><i class="bi bi-facebook"></i></a>
                        @endif
                        @if($entity->instagram_url)
                            <a href="{{ $entity->instagram_url }}" target="_blank" class="icon-btn instagram"><i class="bi bi-instagram"></i></a>
                        @endif
                    </div>
                </div>
            </div>
        @empty
            <p class="text-muted text-center">No Government Entities Found</p>
        @endforelse
    </div>

    <!-- Pagination -->
    <div class="mt-4">
        {{ $entities->links() }}
    </div>
</div>

<!-- Bootstrap Icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
</body>
</html>
