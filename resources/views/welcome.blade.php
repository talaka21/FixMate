<!DOCTYPE html>

<html lang="{{ app()->getLocale() }}" dir="ltr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>{{ __('fixmate_title') }}</title>
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
    <!-- Logo -->
    <a class="text-2xl font-bold text-[#a864a8]" href="{{ url('/') }}">{{ __('fixmate') }}</a>

    <!-- Desktop Menu -->
    <div class="flex space-x-6 items-center">
      <a class="text-gray-600 hover:text-[#8b4b8b]" href="{{ route('categories.index') }}">{{ __('categories') }}</a>
      <a class="text-gray-600 hover:text-[#8b4b8b]" href="{{ route('offers.index') }}">{{ __('offers') }}</a>
      <a class="text-gray-600 hover:text-[#8b4b8b]" href="{{ route('government-entities.index') }}">{{ __('government') }}</a>

      @guest
        <a class="bg-[#8b4b8b] text-white py-2 px-4 rounded-full hover:bg-[#732f73]" href="{{ route('login') }}">{{ __('login') }}</a>
        <a class="bg-gray-200 text-[#a864a8] py-2 px-4 rounded-full hover:bg-gray-300" href="{{ route('register.form') }}">{{ __('register') }}</a>
      @else
        <!-- Notifications Dropdown -->
        <div class="relative group">
          <button class="flex items-center space-x-1 focus:outline-none">
            <i class="fa-solid fa-bell text-gray-600"></i>
          </button>
          <div class="absolute right-0 mt-2 w-72 bg-white border border-gray-200 rounded-md shadow-lg opacity-0 group-hover:opacity-100 transition-opacity duration-300 transform scale-95 group-hover:scale-100 origin-top-right">
            <div class="p-4">
              <h5 class="font-semibold mb-2">{{ __('notifications') }}</h5>
              <form id="notifForm">
                @csrf
                <div class="form-check form-switch mb-2">
                  <input class="form-check-input" type="checkbox" id="notifications_enabled" name="notifications_enabled"
                         value="1" {{ auth()->user()->notifications_enabled ? 'checked' : '' }}>
                  <label class="form-check-label" for="notifications_enabled">{{ __('enable_notifications') }}</label>
                </div>
              </form>
              <hr class="my-2">
              <div class="max-h-48 overflow-y-auto">
                @foreach(auth()->user()->notifications()->latest()->take(5)->get() as $notif)
                  <div class="p-2 border-b last:border-b-0">
                    <p class="text-sm font-medium">{{ $notif->getTranslation('title', app()->getLocale()) }}</p>
                    <p class="text-xs text-gray-500">{{ $notif->send_at->format('Y-m-d H:i') }}</p>
                  </div>
                @endforeach
                @if(auth()->user()->notifications()->count() == 0)
                  <p class="text-xs text-gray-400">{{ __('no_notifications') }}</p>
                @endif
              </div>
            </div>
          </div>
        </div>

        <!-- User Dropdown -->
        <div class="relative group">
          <button class="flex items-center space-x-1 focus:outline-none">
            <span class="text-gray-600">{{ Auth::user()->name }}</span>
            <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
            </svg>
          </button>
          <ul class="absolute right-0 mt-2 w-48 bg-white border border-gray-200 rounded-md shadow-lg opacity-0 group-hover:opacity-100 transition-opacity duration-300 transform scale-95 group-hover:scale-100 origin-top-right">
            <li><a class="block px-4 py-2 text-gray-700 hover:bg-gray-100" href="{{ route('profile.edit') }}">{{ __('profile') }}</a></li>
            <li><a class="block px-4 py-2 text-gray-700 hover:bg-gray-100" href="{{ route('logout.confirm') }}">{{ __('logout') }}</a></li>
          </ul>
        </div>
      @endguest

      <!-- Language Switcher -->
      @php $currentLocale = app()->getLocale(); @endphp

      @if($currentLocale === 'ar')
        <a href="{{ route('change.lang', 'en') }}" class="px-3 py-1 border rounded hover:bg-gray-100 flex items-center gap-1">
            🌐 English
        </a>
      @else
        <a href="{{ route('change.lang', 'ar') }}" class="px-3 py-1 border rounded hover:bg-gray-100 flex items-center gap-1">
            🌐 العربية
        </a>
      @endif
    </div>
  </div>
</nav>

<!-- Search Form -->
<section class="bg-white py-8">
  <div class="container mx-auto px-4">
    <form method="GET" action="{{ route('service_providers.search') }}" class="flex flex-col md:flex-row gap-4 items-center">
      <!-- البحث حسب اسم المحل -->
      <input type="text" name="shop_name" value="{{ request('shop_name') }}" placeholder="{{ __('search_by_shop_name') }}" class="flex-1 p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#8b4b8b]">

      <!-- البحث حسب الفئة -->
      <select name="category_id" class="p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#8b4b8b]">
        <option value="">{{ __('select_category') }}</option>
        @foreach($categories ?? [] as $category)
          <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
            {{ $category->getTranslation('name', app()->getLocale()) }}
          </option>
        @endforeach
      </select>

      <!-- البحث حسب الفئة الفرعية -->
      <select name="subcategory_id" class="p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#8b4b8b]">
        <option value="">{{ __('select_subcategory') }}</option>
        @foreach($subcategories ?? [] as $subcategory)
          <option value="{{ $subcategory->id }}" {{ request('subcategory_id') == $subcategory->id ? 'selected' : '' }}>
            {{ $subcategory->getTranslation('name', app()->getLocale()) }}
          </option>
        @endforeach
      </select>

      <!-- البحث حسب الوسوم -->
      <input type="text" name="tags" value="{{ request('tags') }}" placeholder="{{ __('search_by_tags') }}" class="flex-1 p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#8b4b8b]">

      <!-- زر البحث -->
      <button type="submit" class="bg-[#8b4b8b] text-white py-3 px-6 rounded-lg font-semibold hover:bg-[#732f73] transition-colors">
        {{ __('search') }}
      </button>
    </form>
  </div>
</section>

<!-- Hero Section -->
<section class="bg-gradient-to-r from-[#a864a8] to-[#6c63ff] text-white text-center py-20 md:py-32 rounded-b-3xl shadow-xl">
  <div class="container mx-auto px-4">
    <h1 class="text-4xl md:text-6xl font-extrabold mb-4">{{ __('hero_title') }}</h1>
    <p class="text-lg md:text-xl mb-8 opacity-90">{{ __('hero_subtitle') }}</p>
  </div>
</section>

<!-- Features Section -->
<section class="py-16 bg-gray-50">
  <div class="container mx-auto px-4 text-center">
    <h2 class="text-3xl font-bold text-[#872b87] mb-10">{{ __('why_choose_fixmate') }}</h2>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
      <div class="bg-white rounded-2xl shadow-lg p-6 hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2">
        <div class="text-[#a864a8] mb-4">
          <svg class="w-12 h-12 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m1.414 16.97l.707-.707M16 4.072V3.5a1.5 1.5 0 00-3 0v.572m-4.5 9.428V14a2 2 0 01-2-2v-2a2 2 0 012-2h1.5a2 2 0 012 2v2a2 2 0 01-2 2h-1.5z"></path>
          </svg>
        </div>
        <h5 class="text-xl font-bold mb-2 text-[#a864a8]">{{ __('expertise') }}</h5>
        <p class="text-gray-600">{{ __('expertise_desc') }}</p>
      </div>

      <div class="bg-white rounded-2xl shadow-lg p-6 hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2">
        <div class="text-[#a864a8] mb-4">
          <svg class="w-12 h-12 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
          </svg>
        </div>
        <h5 class="text-xl font-bold mb-2 text-[#a864a8]">{{ __('support_24_7') }}</h5>
        <p class="text-gray-600">{{ __('support_24_7_desc') }}</p>
      </div>

      <div class="bg-white rounded-2xl shadow-lg p-6 hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2">
        <div class="text-[#a864a8] mb-4">
          <svg class="w-12 h-12 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 8h6m-5 0v4m0 0h2m-2 0h-2m2 0H9m-1 0a2 2 0 01-2-2V8a2 2 0 012-2h4a2 2 0 012 2v4a2 2 0 01-2 2h-4z"></path>
          </svg>
        </div>
        <h5 class="text-xl font-bold mb-2 text-[#a864a8]">{{ __('flexible_pricing') }}</h5>
        <p class="text-gray-600">{{ __('flexible_pricing_desc') }}</p>
      </div>
    </div>
  </div>
</section>

<!-- Categories Section -->
<section class="py-16 bg-white">
  <div class="container mx-auto px-4 text-center">
    <h2 class="text-3xl font-bold text-[#872b87] mb-10">{{ __('explore_categories') }}</h2>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
      @foreach(($categories ?? collect())->take(6) as $category)
        <div class="bg-white rounded-xl shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2">
          @php $currentLocale = app()->getLocale(); @endphp
          <img src="{{ $category->thumbnail_url }}" class="w-full h-48 object-cover rounded-t-xl" alt="{{ $category->getTranslation('name', $currentLocale) }}">
          <div class="p-6">
            <h5 class="text-xl font-bold text-[#a864a8] mb-2">{{ $category->getTranslation('name', $currentLocale) }}</h5>
            <p class="text-gray-600 mb-4">{{ Str::limit($category->getTranslation('description', $currentLocale), 120) }}</p>
            <a href="{{ route('categories.show', $category->id) }}" class="inline-block bg-[#8b4b8b] text-white py-2 px-6 rounded-full font-semibold hover:bg-[#732f73] transition-colors duration-300">{{ __('view_details') }}</a>
          </div>
        </div>
      @endforeach
    </div>
    <div class="mt-12">
      <a href="{{ route('categories.index') }}" class="inline-block border border-[#872b87] text-[#872b87] py-3 px-8 rounded-full font-semibold hover:bg-[#872b87] hover:text-white transition-colors duration-300">
        {{ __('view_all_categories') }}
      </a>
    </div>
  </div>
</section>

<!-- Service Providers Section -->
<section class="py-16 bg-gray-50">
  <div class="container mx-auto px-4 text-center">
    <h2 class="text-3xl font-bold text-[#872b87] mb-10">{{ __('service_providers') }}</h2>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
      @foreach($serviceProviders as $provider)
        <div class="bg-white rounded-xl shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2">
          <img src="{{ $provider->thumbnail_url }}"
               class="w-full h-48 object-cover rounded-t-xl"
               alt="{{ $provider->shop_name }}">

          <div class="p-6 text-left">
            <h5 class="text-xl font-bold text-[#a864a8] mb-2">{{ $provider->shop_name }}</h5>

            <!-- عدد المشاهدات -->
            <p class="text-sm text-gray-500 mb-2">
              👁️ {{ $provider->views }} {{ __('views') }}
            </p>

            <!-- الوسوم -->
            <div class="flex flex-wrap gap-2 mb-4">
              @foreach($provider->tags ?? [] as $tag)
                <span class="px-2 py-1 bg-[#f6edf9] text-[#872b87] text-xs rounded-full">
                  #{{ $tag->name }}
                </span>
              @endforeach
            </div>

            <!-- زر التفاصيل -->
            @auth
              <a href="{{ route('service_providers.show', $provider->id) }}"
                 class="inline-block bg-[#8b4b8b] text-white py-2 px-6 rounded-full font-semibold hover:bg-[#732f73] transition-colors duration-300">
                {{ __('view_details') }}
              </a>
            @else
              <a href="{{ route('login') }}"
                 class="inline-block bg-gray-200 text-[#a864a8] py-2 px-6 rounded-full font-semibold hover:bg-gray-300 transition-colors duration-300">
                {{ __('login_to_view') }}
              </a>
            @endauth
          </div>
        </div>
      @endforeach
    </div>

    <!-- زر "عرض جميع مزوّدي الخدمة" -->
    <div class="mt-12">
      <a href="{{ route('service_providers.index') }}"
         class="inline-block border border-[#872b87] text-[#872b87] py-3 px-8 rounded-full font-semibold hover:bg-[#872b87] hover:text-white transition-colors duration-300">
        {{ __('view_all_service_providers') }}
      </a>
    </div>
  </div>
</section>

<!-- About Us Section -->
<section class="py-16 bg-[#f6edf9]">
  <div class="container mx-auto px-4 text-center">
    <h2 class="text-3xl font-bold text-[#872b87] mb-6">{{ __('about_us') }}</h2>

    <div class="prose max-w-3xl mx-auto mb-8">
      {!! nl2br(e($about?->getTranslation('content', app()->getLocale()) ?? __('about_us_placeholder'))) !!}
    </div>

    <div class="flex justify-center items-center gap-6 mt-4">
      @if($about?->phone)
        <a href="tel:{{ $about->phone }}" class="px-5 py-3 bg-purple-600 text-white rounded-lg shadow hover:bg-purple-700 flex items-center gap-2">
          📞 {{ __('call_us') }}
        </a>
      @endif

      @if($about?->facebook)
        <a href="{{ $about->facebook }}" target="_blank" class="px-5 py-3 bg-blue-600 text-white rounded-lg shadow hover:bg-blue-700 flex items-center gap-2">
          <i class="fab fa-facebook"></i> Facebook
        </a>
      @endif

      @if($about?->instagram)
        <a href="{{ $about->instagram }}" target="_blank" class="px-5 py-3 bg-pink-500 text-white rounded-lg shadow hover:bg-pink-600 flex items-center gap-2">
          <i class="fab fa-instagram"></i> Instagram
        </a>
      @endif
    </div>
  </div>
</section>

<!-- Contact Us Section -->
<section class="py-16 bg-white">
  <div class="container mx-auto px-4 max-w-xl text-center">
    <h2 class="text-3xl font-bold text-[#872b87] mb-6">{{ __('contact_us') }}</h2>

    <!-- Show Form Button -->
    <button id="showContactBtn" class="bg-purple-600 text-white px-6 py-2 rounded hover:bg-purple-700 mb-6">
      {{ __('contact_us') }}
    </button>

    <!-- Form initially hidden -->
    <div id="contactFormContainer" class="hidden">
      @if(session('success'))
        <div class="bg-green-100 text-green-700 p-3 rounded mb-4">{{ session('success') }}</div>
      @endif

      <form method="POST" action="{{ route('contact.send') }}" id="contactForm">
        @csrf

        <label class="block mb-2 font-semibold text-left">{{ __('name') }}</label>
        <input type="text" name="user_name" value="{{ auth()->user()?->name ?? '' }}" class="mb-4 p-2 border rounded w-full" placeholder="{{ __('enter_name') }}" required>

        <label class="block mb-2 font-semibold text-left">{{ __('phone_number') }}</label>
        <input type="text" name="phone_number" value="{{ auth()->user()?->phone ?? '' }}" maxlength="10" class="mb-4 p-2 border rounded w-full" placeholder="{{ __('enter_phone') }}" required>

        <label class="block mb-2 font-semibold text-left">{{ __('message') }}</label>
        <textarea name="message" class="mb-4 p-2 border rounded w-full" placeholder="{{ __('type_message') }}" required></textarea>

        <button type="submit" class="bg-purple-600 text-white py-2 px-6 rounded disabled:opacity-50 w-full" disabled id="sendBtn">{{ __('send') }}</button>
      </form>
    </div>
  </div>

  <script>
    const showBtn = document.getElementById('showContactBtn');
    const formContainer = document.getElementById('contactFormContainer');
    const form = document.getElementById('contactForm');
    const sendBtn = document.getElementById('sendBtn');
    const notifCheckbox = document.getElementById('notifications_enabled');

    if (notifCheckbox) {
      notifCheckbox.addEventListener('change', function(){
        fetch("{{ route('notifications.settings.update') }}", {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
          },
          body: JSON.stringify({ notifications_enabled: this.checked ? 1 : 0 })
        }).then(res => res.json()).then(data => {
          alert('{{ __('notifications_updated') }}');
        }).catch(err => console.log(err));
      });
    }

    // Toggle form display
    showBtn.addEventListener('click', () => {
      formContainer.classList.toggle('hidden');
      showBtn.textContent = formContainer.classList.contains('hidden') ? '{{ __('contact_us') }}' : '{{ __('close_form') }}';
    });

    // Enable submit button when all fields are filled
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
    © 2025 FixMate. {{ __('all_rights_reserved') }} |
    <a href="{{ route('privacy-policy') }}" class="text-[#872b87] hover:underline">{{ __('view_privacy_policy') }}</a>
  </p>
</footer>

</body>
</html>
