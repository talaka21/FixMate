<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>FixMate - Your Trusted Partner</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
  <style>
    body { font-family: 'Segoe UI', sans-serif; background: linear-gradient(to right, #fdfcff, #f6edf9); color: #333; }
    .hero { padding: 120px 20px; text-align: center; background: linear-gradient(135deg, #a864a8, #6c63ff); color: white; position: relative; border-bottom: 6px solid #8b4b8b; }
    .hero h1 { font-size: 3rem; font-weight: bold; }
    .hero p { font-size: 1.2rem; margin-top: 15px; }
    .btn-custom { padding: 12px 35px; font-size: 1.1rem; border-radius: 50px; transition: all 0.3s ease-in-out; margin: 8px; font-weight: 600; text-decoration: none; box-shadow: 0 4px 10px rgba(0,0,0,0.1); }
    .btn-offers { background-color:#8b4b8b; color:#fff; border:2px solid #8b4b8b; }
    .btn-offers:hover { background-color: #732f73; border-color: #732f73; }
    .btn-government { background-color: #fff; color: #a864a8; border: 2px solid #a864a8; }
    .btn-government:hover { background-color: #a864a8; color: white; }
    .card { border: none; border-radius: 15px; transition: transform 0.3s ease, box-shadow 0.3s ease; }
    .card:hover { transform: translateY(-5px); box-shadow: 0 8px 20px rgba(0,0,0,0.15); }
    .card-title { color: #a864a8; font-weight: 600; }
    footer { background-color: #f6edf9; color: #6c757d; padding: 20px 0; font-size: 0.9rem; border-top: 2px solid #e0d1e8; }
  </style>
  @php
    use Illuminate\Support\Str;
    $categories = $categories ?? collect(); // fallback إذا رجعتي على الصفحة بدون تمرير المتغير
  @endphp
</head>
<body>

  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
    <div class="container">
      <a class="navbar-brand fw-bold text-primary" href="{{ url('/') }}">FixMate</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item"><a class="nav-link" href="{{ route('categories.index') }}">Categories</a></li>
          <li class="nav-item"><a class="nav-link" href="{{ route('offers.index') }}">Offers</a></li>
          <li class="nav-item"><a class="nav-link" href="{{ route('government-entities.index') }}">Government</a></li>

          @guest
            <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Login</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('register.form') }}">Register</a></li>
          @else
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                {{ Auth::user()->name }}
              </a>
              <ul class="dropdown-menu">
                <li>
                  <a class="dropdown-item" href="#"
                     onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    Logout
                  </a>
                  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">
                    @csrf
                  </form>
                </li>
              </ul>
            </li>
          @endguest
        </ul>
      </div>
    </div>
  </nav>

  <!-- Hero Section -->
  <section class="hero d-flex flex-column align-items-center justify-content-center">
    <h1>Boost Your Business with Confidence</h1>
    <p>Professional solutions crafted just for you</p>

    <div class="mt-3">
      <a href="{{ route('offers.index') }}" class="btn-custom btn-offers">🎁 View Offers</a>
      <a href="{{ route('government-entities.index') }}" class="btn-custom btn-government">Government Entities</a>
    </div>
  </section>

  <!-- Features Section -->
  <section class="py-5 text-center">
    <div class="container">
      <h2 class="mb-4" style="color:#872b87; font-weight:bold;">Why Choose FixMate?</h2>
      <div class="row">
        <div class="col-md-4 mb-4">
          <div class="card shadow-sm h-100">
            <div class="card-body">
              <h5 class="card-title">Expertise</h5>
              <p class="card-text">Our experienced team delivers fast and effective solutions tailored to your needs.</p>
            </div>
          </div>
        </div>
        <div class="col-md-4 mb-4">
          <div class="card shadow-sm h-100">
            <div class="card-body">
              <h5 class="card-title">24/7 Support</h5>
              <p class="card-text">Our dedicated team is always here to ensure you have the best experience.</p>
            </div>
          </div>
        </div>
        <div class="col-md-4 mb-4">
          <div class="card shadow-sm h-100">
            <div class="card-body">
              <h5 class="card-title">Flexible Pricing</h5>
              <p class="card-text">Affordable plans designed for small startups and large enterprises alike.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Categories Section -->
  <section class="py-5">
    <div class="container text-center">
      <h2 class="mb-4" style="color:#872b87; font-weight:bold;">{{ __('Our Categories') }}</h2>
      <div class="row">
        @foreach(($categories ?? collect())->take(6) as $category)
          <div class="col-md-4 col-sm-6 mb-4">
            <div class="card h-100 text-center">
              <img src="{{ $category->thumbnail_url }}" class="card-img-top" alt="{{ $category->name }}" style="height:200px; object-fit:cover; border-top-left-radius:15px; border-top-right-radius:15px;">
              <div class="card-body">
                <h5 class="card-title">{{ $category->getTranslation('name', app()->getLocale()) }}</h5>
                <p class="card-text">{{ \Illuminate\Support\Str::limit($category->getTranslation('description', app()->getLocale()), 100) }}</p>
                <a href="{{ route('categories.show', $category->id) }}" class="btn btn-sm btn-offers">View Details</a>
              </div>
            </div>
          </div>
        @endforeach
      </div>

      <div class="mt-4">
        <a href="{{ route('categories.index') }}" class="btn btn-outline-primary" style="border-color:#872b87; color:#872b87; border-radius:30px;">
          {{ __('View All Categories') }}
        </a>
      </div>
    </div>
  </section>

  <!-- Testimonials Section -->
  <section class="py-5 bg-light">
    <div class="container text-center">
      <h2 class="mb-4">What Our Clients Say</h2>
      <div class="row">
        <div class="col-md-6 mb-4">
          <blockquote class="blockquote">
            <p>"Excellent service and great communication! Highly recommended."</p>
            <footer class="blockquote-footer">Ahmad from Riyadh</footer>
          </blockquote>
        </div>
        <div class="col-md-6 mb-4">
          <blockquote class="blockquote">
            <p>"The website design is beautiful and easy to use. Great experience!"</p>
            <footer class="blockquote-footer">Layla from Dubai</footer>
          </blockquote>
        </div>
      </div>
    </div>
  </section>

  <!-- Footer -->
  <footer class="text-center">
    <p>© 2025 FixMate. All rights reserved.</p>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
