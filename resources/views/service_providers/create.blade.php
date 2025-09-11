<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <title>{{ __('register_provider') }}</title>
    <style>
        body {
            font-family: "Tahoma", sans-serif;
            background: #f9f9f9;
            direction: ltr;
            padding: 20px;
        }
        h1 { color: #a864a8; }
        form {
            background: #fff;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            max-width: 600px;
        }
        label { display: block; margin-top: 10px; font-weight: bold; color: #333; }
        input, textarea, select {
            width: 100%; padding: 8px; margin-top: 5px;
            border: 1px solid #ccc; border-radius: 8px; font-size: 14px;
        }
        button {
            background: #a864a8; color: #fff; border: none;
            padding: 10px 20px; border-radius: 8px;
            margin-top: 20px; font-size: 16px; cursor: pointer; transition: 0.3s;
        }
        button:hover { background: #8b4b8b; }
        p { font-size: 14px; }
        .error { color: red; font-size: 13px; }
        .success { color: green; font-weight: bold; }
    </style>
</head>
<body>
    <h1>{{ __('register_provider') }}</h1>

    {{-- Success Message --}}
    @if(session('success'))
        <p class="success">{{ __('success_message') }}</p>
    @endif

    {{-- Form Start --}}
    <form action="{{ route('service_providers.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <label>{{ __('provider_name') }}</label>
        <input type="text" name="provider_name" value="{{ old('provider_name') }}">
        @error('provider_name') <p class="error">{{ $message }}</p> @enderror

        <label>{{ __('shop_name') }}</label>
        <input type="text" name="shop_name" value="{{ old('shop_name') }}">
        @error('shop_name') <p class="error">{{ $message }}</p> @enderror

        <label>{{ __('description') }}</label>
        <textarea name="description">{{ old('description') }}</textarea>
        @error('description') <p class="error">{{ $message }}</p> @enderror

        <label>{{ __('phone') }}</label>
        <input type="text" name="phone" value="{{ old('phone') }}">
        @error('phone') <p class="error">{{ $message }}</p> @enderror

        <label>{{ __('whatsapp') }}</label>
        <input type="text" name="whatsapp" value="{{ old('whatsapp') }}">

        <label>{{ __('facebook') }}</label>
        <input type="url" name="facebook" value="{{ old('facebook') }}">

        <label>{{ __('instagram') }}</label>
        <input type="url" name="instagram" value="{{ old('instagram') }}">

        <label>{{ __('image') }}</label>
        <input type="file" name="image">

        <label>{{ __('category') }}</label>
        <select name="category_id" id="category">
            <option value="">{{ __('select_category') }}</option>
            @foreach($categories as $cat)
                <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected':'' }}>{{ $cat->name }}</option>
            @endforeach
        </select>
        @error('category_id') <p class="error">{{ $message }}</p> @enderror

        <label>{{ __('subcategory') }}</label>
        <select name="subcategory_id" id="subcategory">
            <option value="">{{ __('select_subcategory') }}</option>
        </select>
        @error('subcategory_id') <p class="error">{{ $message }}</p> @enderror

        <label>{{ __('state') }}</label>
        <select name="state_id" id="state">
            <option value="">{{ __('select_state') }}</option>
            @foreach($states as $state)
                <option value="{{ $state->id }}" {{ old('state_id') == $state->id ? 'selected':'' }}>{{ $state->name }}</option>
            @endforeach
        </select>
        @error('state_id') <p class="error">{{ $message }}</p> @enderror

        <label>{{ __('city') }}</label>
        <select name="city_id" id="city">
            <option value="">{{ __('select_city') }}</option>
        </select>
        @error('city_id') <p class="error">{{ $message }}</p> @enderror

        <button type="submit">{{ __('submit_request') }}</button>
    </form>
    {{-- Form End --}}

    {{-- jQuery AJAX --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        // Fetch Subcategories based on Category
        $('#category').on('change', function () {
            let categoryId = $(this).val();
            if (categoryId) {
                $.get('/get-subcategories/' + categoryId, function (data) {
                    $('#subcategory').empty().append('<option value="">' + "{{ __('select_subcategory') }}" + '</option>');
                    $.each(data, function (key, sub) {
                        $('#subcategory').append('<option value="' + sub.id + '">' + sub.name + '</option>');
                    });
                });
            }
        });

        // Fetch Cities based on State
        $('#state').on('change', function () {
            let stateId = $(this).val();
            if (stateId) {
                $.get('/get-cities/' + stateId, function (data) {
                    $('#city').empty().append('<option value="">' + "{{ __('select_city') }}" + '</option>');
                    $.each(data, function (key, city) {
                        $('#city').append('<option value="' + city.id + '">' + city.name + '</option>');
                    });
                });
            }
        });
    </script>
</body>
</html>
