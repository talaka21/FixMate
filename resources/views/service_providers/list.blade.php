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

            <p class="text-sm text-gray-500 mb-2">
              👁️ {{ $provider->views }} {{ __('views') }}
            </p>

            <div class="flex flex-wrap gap-2 mb-4">
              @foreach($provider->tags as $tag)
                <span class="px-2 py-1 bg-[#f6edf9] text-[#872b87] text-xs rounded-full">
                  #{{ $tag->name }}
                </span>
              @endforeach
            </div>

            <a href="{{ route('service_providers.show', $provider->id) }}"
               class="inline-block bg-[#8b4b8b] text-white py-2 px-6 rounded-full font-semibold hover:bg-[#732f73] transition-colors duration-300">
              {{ __('view_details') }}
            </a>
          </div>
        </div>
      @endforeach
    </div>

    <div class="mt-8">
      {{ $serviceProviders->links() }}
    </div>
  </div>
</section>
