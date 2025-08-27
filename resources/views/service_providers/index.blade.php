<div>
   <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register as Service Provider</title>
    <style>
        body {
            font-family: "Tahoma", sans-serif;
            background: #f9f9f9;
            direction: ltr;
            padding: 20px;
        }

        h1 {
            color: #8b4b8b; /* اللون المعدل */
        }

        form {
            background: #fff;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            max-width: 600px;
        }

        label {
            display: block;
            margin-top: 10px;
            font-weight: bold;
            color: #333;
        }

        input, textarea, select {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 14px;
        }

        button {
            background: #8b4b8b; /* اللون المعدل */
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 8px;
            margin-top: 20px;
            font-size: 16px;
            cursor: pointer;
            transition: 0.3s;
        }

        button:hover {
            background: #733a73; /* درجة أغمق للهوفر */
        }

        p {
            font-size: 14px;
        }

        .error {
            color: red;
            font-size: 13px;
        }

        .success {
            color: green;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <h1>🌟 Register as Service Provider</h1>

    @if(session('success'))
        <p class="success">{{ session('success') }}</p>
    @endif

    <form action="{{ route('service_providers.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <label>Provider Name *</label>
        <input type="text" name="provider_name" value="{{ old('provider_name') }}">
        @error('provider_name') <p class="error">{{ $message }}</p> @enderror

        <label>Shop Name *</label>
        <input type="text" name="shop_name" value="{{ old('shop_name') }}">
        @error('shop_name') <p class="error">{{ $message }}</p> @enderror

        <label>Description *</label>
        <textarea name="description">{{ old('description') }}</textarea>
        @error('description') <p class="error">{{ $message }}</p> @enderror

        <label>Phone *</label>
        <input type="text" name="phone" value="{{ old('phone') }}">
        @error('phone') <p class="error">{{ $message }}</p> @enderror

        <label>WhatsApp</label>
        <input type="text" name="whatsapp" value="{{ old('whatsapp') }}">

        <label>Facebook</label>
        <input type="url" name="facebook" value="{{ old('facebook') }}">

        <label>Instagram</label>
        <input type="url" name="instagram" value="{{ old('instagram') }}">

        <label>Image</label>
        <input type="file" name="image">

        <label>Category *</label>
        <select name="category_id">
            <option value="">-- Select Category --</option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected':'' }}>{{ $category->name }}</option>
            @endforeach
        </select>
        @error('category_id') <p class="error">{{ $message }}</p> @enderror

        <label>Subcategory *</label>
        <select name="subcategory_id">
            <option value="">-- Select Subcategory --</option>
            @foreach($subcategories as $subcategory)
                <option value="{{ $subcategory->id }}" {{ old('subcategory_id') == $subcategory->id ? 'selected':'' }}>{{ $subcategory->name }}</option>
            @endforeach
        </select>
        @error('subcategory_id') <p class="error">{{ $message }}</p> @enderror

        <label>State *</label>
        <select name="state_id">
            <option value="">-- Select State --</option>
            @foreach($states as $state)
                <option value="{{ $state->id }}" {{ old('state_id') == $state->id ? 'selected':'' }}>{{ $state->name }}</option>
            @endforeach
        </select>
        @error('state_id') <p class="error">{{ $message }}</p> @enderror

        <label>City *</label>
        <select name="city_id">
            <option value="">-- Select City --</option>
            @foreach($cities as $city)
                <option value="{{ $city->id }}" {{ old('city_id') == $city->id ? 'selected':'' }}>{{ $city->name }}</option>
            @endforeach
        </select>
        @error('city_id') <p class="error">{{ $message }}</p> @enderror

        <button type="submit">🚀 Submit Request</button>
    </form>
</body>
</html>

</div>
