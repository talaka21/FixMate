<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>FixMate - Your Trusted Partner</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background: linear-gradient(to right, #fdfcff, #f6edf9);
    }

    .hero {
      padding: 120px 20px;
      text-align: center;
      background-color: #a864a8;
      color: white;
      position: relative;
      border-bottom: 8px solid #9b4ca3;
    }

    .hero h1 {
      font-size: 3rem;
      font-weight: bold;
    }

    .hero p {
      font-size: 1.2rem;
      margin-top: 15px;
    }

    .btn-signup, .btn-signin {
      padding: 12px 30px;
      font-size: 1.1rem;
      border-radius: 50px;
      transition: 0.3s ease-in-out;
      margin-top: 10px;
      display: inline-block;
      text-decoration: none;
    }

    .btn-signup {
      background-color: #fff;
      color: #a864a8;
      border: 2px solid #a864a8;
    }

    .btn-signup:hover {
      background-color: #a864a8;
      color: white;
    }

    .btn-signin {
      background-color: #6c63ff;
      color: white;
      border: 2px solid #6c63ff;
    }

    .btn-signin:hover {
      background-color: #5750d4;
      border-color: #5750d4;
    }

    .card-title {
      color: #a864a8;
    }

    footer {
      background-color: #f6edf9;
      color: #6c757d;
      padding: 20px 0;
      font-size: 0.9rem;
    }
  </style>
</head>
<body>

  <!-- Hero Section -->
  <section class="hero d-flex flex-column align-items-center justify-content-center">
    <h1>Boost Your Business with Confidence</h1>
    <p>Professional solutions crafted just for you</p>

    <!-- Sign Up Button -->
    <a href="{{ route('register.form') }}" class="btn btn-signup">Sign Up Now</a>

    <!-- Sign In Button -->
    <a href="{{ route('login') }}" class="btn btn-signin">Sign In</a>
  </section>

  <!-- Features Section -->
  <section class="py-5 text-center">
    <div class="container">
      <h2 class="mb-4">Why Choose FixMate?</h2>
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
      <h2 class="mb-4" style="color:#872b87; font-weight:bold;">
        {{ __('Our Categories') }}
      </h2>
      <div class="row">
        @foreach($categories->take(6) as $category)
          <div class="col-md-4 col-sm-6 mb-4">
            <div class="card shadow-sm h-100 text-center">
              <div class="card-body">
                <h5 class="card-title" style="color:#a864a8;">
                  {{ $category->getTranslation('name', app()->getLocale()) }}
                </h5>
                <p class="card-text">
                  {{ Str::limit($category->getTranslation('description', app()->getLocale()), 100) }}
                </p>
                <a href="{{ route('categories.show', $category->id) }}"
                   class="btn btn-sm"
                   style="background-color:#872b87; color:#fff; border-radius:30px;">
                  {{ __('View Details') }}
                </a>
              </div>
            </div>
          </div>
        @endforeach
      </div>

      <div class="mt-4">
        <a href="{{ route('categories.index') }}"
           class="btn btn-outline-primary"
           style="border-color:#872b87; color:#872b87; border-radius:30px;">
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

</body>
</html>
