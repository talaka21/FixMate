<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Awesome CDN for social icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-50 text-gray-800">

    <div class="container mx-auto py-8 px-4">
        <h1 class="text-3xl font-bold mb-6 text-center">About Us</h1>

        <div class="prose max-w-none mb-6 text-center">
            {!! nl2br(e($about?->content ?? 'No About Us content available')) !!}
        </div>

        <div class="flex justify-center items-center gap-6 mt-4">
            {{-- Phone (click to call, digits hidden visually) --}}
            @if($about?->phone)
                <a href="tel:{{ $about->phone }}"
                   class="px-5 py-3 bg-purple-600 text-white rounded-lg shadow hover:bg-purple-700 transition">
                    📞 Call Us
                </a>
            @endif

            {{-- Facebook --}}
            @if($about?->facebook)
                <a href="{{ $about->facebook }}" target="_blank"
                   class="text-blue-600 text-3xl hover:text-blue-800 transition">
                    <i class="fab fa-facebook"></i>
                </a>
            @endif

            {{-- Instagram --}}
            @if($about?->instagram)
                <a href="{{ $about->instagram }}" target="_blank"
                   class="text-pink-500 text-3xl hover:text-pink-700 transition">
                    <i class="fab fa-instagram"></i>
                </a>
            @endif
        </div>
    </div>

</body>
</html>
