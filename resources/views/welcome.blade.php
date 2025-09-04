<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>FixMate - Your Trusted Partner</title>
  <!-- Tailwind CSS -->
  <script src="https://cdn.tailwindcss.com"></script>
  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
  <!-- FontAwesome for icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <style>
    body {
      font-family: 'Inter', sans-serif;
    }
  </style>
  @php
    use Illuminate\Support\Str;
    $categories = $categories ?? collect();
  @endphp
</head>
<body class="bg-[#f6edf9] text-gray-800">

  <!-- Navbar -->
  <nav class="bg-white shadow-md rounded-b-xl p-4 sticky top-0 z-50">
    <div class="container mx-auto flex justify-between items-center">
      <a class="text-2xl font-bold text-[#a864a8]" href="{{ url('/') }}">FixMate</a>
      <div class="hidden md:flex space-x-6 items-center">
        <a class="text-gray-600 hover:text-[#8b4b8b]" href="{{ route('categories.index') }}">Categories</a>
        <a class="text-gray-600 hover:text-[#8b4b8b]" href="{{ route('offers.index') }}">Offers</a>
        <a class="text-gray-600 hover:text-[#8b4b8b]" href="{{ route('government-entities.index') }}">Government</a>

        @guest
          <a class="bg-[#8b4b8b] text-white py-2 px-4 rounded-full hover:bg-[#732f73]" href="{{ route('login') }}">Login</a>
          <a class="bg-gray-200 text-[#a864a8] py-2 px-4 rounded-full hover:bg-gray-300" href="{{ route('register.form') }}">Register</a>
        @else
          <div class="relative group">
            <button class="flex items-center space-x-1 focus:outline-none">
              <span class="text-gray-600">{{ Auth::user()->name }}</span>
              <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
            </button>
            <ul class="absolute right-0 mt-2 w-48 bg-white border border-gray-200 rounded-md shadow-lg opacity-0 group-hover:opacity-100 transition-opacity duration-300 transform scale-95 group-hover:scale-100 origin-top-right">
              <li>
                <a class="block px-4 py-2 text-gray-700 hover:bg-gray-100" href="{{ route('logout.confirm') }}">
                  Logout
                </a>
              </li>
            </ul>
          </div>
        @endguest
      </div>
      <button class="md:hidden text-gray-600 focus:outline-none">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path></svg>
      </button>
    </div>
  </nav>


  <!-- Hero Section -->
  <section class="bg-gradient-to-r from-[#a864a8] to-[#6c63ff] text-white text-center py-20 md:py-32 rounded-b-3xl shadow-xl">
    <div class="container mx-auto px-4">
      <h1 class="text-4xl md:text-6xl font-extrabold mb-4">Boost Your Business with Confidence</h1>
      <p class="text-lg md:text-xl mb-8 opacity-90">Professional solutions crafted just for you</p>
    </div>
  </section>

  <!-- Features Section -->
  <section class="py-16 bg-gray-50">
    <div class="container mx-auto px-4 text-center">
      <h2 class="text-3xl font-bold text-[#872b87] mb-10">Why Choose FixMate?</h2>
      <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <div class="bg-white rounded-2xl shadow-lg p-6 hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2">
          <div class="text-[#a864a8] mb-4">
            <svg class="w-12 h-12 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m1.414 16.97l.707-.707M16 4.072V3.5a1.5 1.5 0 00-3 0v.572m-4.5 9.428V14a2 2 0 01-2-2v-2a2 2 0 012-2h1.5a2 2 0 012 2v2a2 2 0 01-2 2h-1.5z"></path></svg>
          </div>
          <h5 class="text-xl font-bold mb-2 text-[#a864a8]">Expertise</h5>
          <p class="text-gray-600">Our experienced team delivers fast and effective solutions tailored to your needs.</p>
        </div>
        <div class="bg-white rounded-2xl shadow-lg p-6 hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2">
          <div class="text-[#a864a8] mb-4">
            <svg class="w-12 h-12 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
          </div>
          <h5 class="text-xl font-bold mb-2 text-[#a864a8]">24/7 Support</h5>
          <p class="text-gray-600">Our dedicated team is always here to ensure you have the best experience.</p>
        </div>
        <div class="bg-white rounded-2xl shadow-lg p-6 hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2">
          <div class="text-[#a864a8] mb-4">
            <svg class="w-12 h-12 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 8h6m-5 0v4m0 0h2m-2 0h-2m2 0H9m-1 0a2 2 0 01-2-2V8a2 2 0 012-2h4a2 2 0 012 2v4a2 2 0 01-2 2h-4z"></path></svg>
          </div>
          <h5 class="text-xl font-bold mb-2 text-[#a864a8]">Flexible Pricing</h5>
          <p class="text-gray-600">Affordable plans designed for small startups and large enterprises alike.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- Categories Section -->
  <section class="py-16 bg-white">
    <div class="container mx-auto px-4 text-center">
      <h2 class="text-3xl font-bold text-[#872b87] mb-10">Our Categories</h2>
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
        @foreach(($categories ?? collect())->take(6) as $category)
          <div class="bg-white rounded-xl shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2">
            <img src="{{ $category->thumbnail_url }}" class="w-full h-48 object-cover rounded-t-xl" alt="{{ $category->name }}">
            <div class="p-6">
              <h5 class="text-xl font-bold text-[#a864a8] mb-2">{{ $category->getTranslation('name', app()->getLocale()) }}</h5>
              <p class="text-gray-600 mb-4">{{ Str::limit($category->getTranslation('description', app()->getLocale()), 100) }}</p>
              <a href="{{ route('categories.show', $category->id) }}" class="inline-block bg-[#8b4b8b] text-white py-2 px-6 rounded-full font-semibold hover:bg-[#732f73] transition-colors duration-300">View Details</a>
            </div>
          </div>
        @endforeach
      </div>
      <div class="mt-12">
        <a href="{{ route('categories.index') }}" class="inline-block border border-[#872b87] text-[#872b87] py-3 px-8 rounded-full font-semibold hover:bg-[#872b87] hover:text-white transition-colors duration-300">
          View All Categories
        </a>
      </div>
    </div>
  </section>


<!-- About Us Section (Interactive Buttons) -->
<section class="py-16 bg-[#f6edf9]">
  <div class="container mx-auto px-4 text-center">
    <h2 class="text-3xl font-bold text-[#872b87] mb-6">About Us</h2>

    <div class="prose max-w-3xl mx-auto mb-8">
      {!! nl2br(e($about?->content ?? 'No About Us content available')) !!}
    </div>

    <div class="flex justify-center items-center gap-6 mt-4">
      @if($about?->phone)
        <a href="tel:{{ $about->phone }}"
           class="px-5 py-3 bg-purple-600 text-white rounded-lg shadow hover:bg-purple-700 flex items-center gap-2">
           📞 Call Us
        </a>
      @endif

      @if($about?->facebook)
        <a href="{{ $about->facebook }}" target="_blank"
           class="px-5 py-3 bg-blue-600 text-white rounded-lg shadow hover:bg-blue-700 flex items-center gap-2">
           <i class="fab fa-facebook"></i> Facebook
        </a>
      @endif

      @if($about?->instagram)
        <a href="{{ $about->instagram }}" target="_blank"
           class="px-5 py-3 bg-pink-500 text-white rounded-lg shadow hover:bg-pink-600 flex items-center gap-2">
           <i class="fab fa-instagram"></i> Instagram
        </a>
      @endif
    </div>
  </div>
</section>
<!-- Contact Us Section -->
<section class="py-16 bg-white">
  <div class="container mx-auto px-4 max-w-xl text-center">
    <h2 class="text-3xl font-bold text-[#872b87] mb-6">Contact Us</h2>

    <!-- Show Form Button -->
    <button id="showContactBtn"
            class="bg-purple-600 text-white px-6 py-2 rounded hover:bg-purple-700 mb-6">
      Contact Us
    </button>

    <!-- Form initially hidden -->
    <div id="contactFormContainer" class="hidden">
      @if(session('success'))
        <div class="bg-green-100 text-green-700 p-3 rounded mb-4">{{ session('success') }}</div>
      @endif

      <form method="POST" action="{{ route('contact.send') }}" id="contactForm">
        @csrf

        <label class="block mb-2 font-semibold text-left">Name</label>
        <input type="text" name="user_name" value="{{ auth()->user()?->name ?? '' }}"
               class="mb-4 p-2 border rounded w-full" required>

        <label class="block mb-2 font-semibold text-left">Phone Number</label>
        <input type="text" name="phone_number" value="{{ auth()->user()?->phone ?? '' }}"
               maxlength="10" class="mb-4 p-2 border rounded w-full" required>

        <label class="block mb-2 font-semibold text-left">Message</label>
        <textarea name="message" class="mb-4 p-2 border rounded w-full" required></textarea>

        <button type="submit"
                class="bg-purple-600 text-white py-2 px-6 rounded disabled:opacity-50 w-full"
                disabled id="sendBtn">Send</button>
      </form>
    </div>
  </div>

  <script>
    const showBtn = document.getElementById('showContactBtn');
    const formContainer = document.getElementById('contactFormContainer');
    const form = document.getElementById('contactForm');
    const sendBtn = document.getElementById('sendBtn');

    // Toggle form display when clicking the button
    showBtn.addEventListener('click', () => {
      formContainer.classList.toggle('hidden');
      showBtn.textContent = formContainer.classList.contains('hidden') ? 'Contact Us' : 'Close Form';
    });

    // Enable submit button when all fields are filled correctly
    form.addEventListener('input', () => {
        const name = form.user_name.value.trim();
        const phone = form.phone_number.value.trim();
        const message = form.message.value.trim();
        sendBtn.disabled = !(name && phone && message && phone.length <= 10);
    });
  </script>
</section>




  <!-- Footer -->
  <footer class="text-center py-6 text-gray-500 text-sm border-t border-gray-200">
    <p>
      © 2025 FixMate. All rights reserved. |
      <a href="{{ route('privacy-policy') }}" class="text-[#872b87] hover:underline">Privacy Policy</a>
    </p>
  </footer>

</body>
</html>
