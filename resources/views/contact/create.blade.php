<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>{{ __('contact_us') }} - FixMate</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#f6edf9] flex items-center justify-center min-h-screen">

  <div class="w-full max-w-lg bg-white rounded-xl shadow-lg p-8">
    <h2 class="text-3xl font-bold text-[#872b87] mb-6 text-center">{{ __('contact_us') }}</h2>

    @if(session('success'))
      <div class="bg-green-100 text-green-700 p-3 rounded mb-4 text-center">
        {{ session('success') }}
      </div>
    @endif

    <form method="POST" action="{{ route('contact.send') }}" id="contactForm">
      @csrf

      <label class="block mb-2 font-semibold">{{ __('name') }}</label>
      <input type="text" name="user_name" value="{{ auth()->user()?->name ?? '' }}"
             class="mb-4 p-2 border rounded w-full" required>

      <label class="block mb-2 font-semibold">{{ __('phone_number') }}</label>
      <input type="text" name="phone_number" value="{{ auth()->user()?->phone ?? '' }}"
             maxlength="10" class="mb-4 p-2 border rounded w-full" required>

      <label class="block mb-2 font-semibold">{{ __('message') }}</label>
      <textarea name="message" class="mb-4 p-2 border rounded w-full" required></textarea>

      <button type="submit"
              class="bg-purple-600 text-white py-2 px-6 rounded disabled:opacity-50 w-full"
              disabled id="sendBtn">{{ __('send') }}</button>
    </form>
  </div>

  <script>
    const form = document.getElementById('contactForm');
    const sendBtn = document.getElementById('sendBtn');

    form.addEventListener('input', () => {
        const name = form.user_name.value.trim();
        const phone = form.phone_number.value.trim();
        const message = form.message.value.trim();
        sendBtn.disabled = !(name && phone && message && phone.length <= 10);
    });
  </script>

</body>
</html>
