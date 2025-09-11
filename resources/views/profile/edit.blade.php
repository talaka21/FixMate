<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>الملف الشخصي</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="card shadow p-4">
        <h3 class="mb-4 text-center">الملف الشخصي</h3>

        <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

        <div class="container mt-5">
    <div class="card shadow p-4">
        <h3 class="mb-4 text-center">{{ __('profile') }}</h3>

        <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">{{ __('first_name') }}</label>
                <input type="text" name="first_name" class="form-control" value="{{ old('first_name', $user->first_name) }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">{{ __('last_name') }}</label>
                <input type="text" name="last_name" class="form-control" value="{{ old('last_name', $user->last_name) }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">{{ __('phone_number') }}</label>
                <input type="text" class="form-control" value="{{ $user->phone }}" readonly>
            </div>

            <div class="mb-3">
                <label class="form-label">{{ __('profile_image') }}</label>
                <input type="file" name="image" class="form-control">
                @if($user->image)
                    <img src="{{ asset('storage/' . $user->image) }}" alt="profile" class="mt-2 rounded-circle" width="100">
                @endif
            </div>

            <div class="mb-3">
                <label class="form-label">{{ __('state') }}</label>
                <select id="state" name="state_id" class="form-select" required>
                    <option value="">{{ __('select_state') }}</option>
                    @foreach($states as $state)
                        <option value="{{ $state->id }}" {{ $user->state_id == $state->id ? 'selected' : '' }}>
                            {{ $state->getTranslation('name', 'ar') }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">{{ __('city') }}</label>
                <select id="city" name="city_id" class="form-select" required>
                    <option value="">{{ __('select_city') }}</option>
                    @foreach($cities[$user->state_id] ?? [] as $city)
                        <option value="{{ $city->id }}" {{ $user->city_id == $city->id ? 'selected' : '' }}>
                            {{ $city->name['ar'] }}
                        </option>
                    @endforeach
                </select>
            </div>

            <button type="submit" id="saveBtn" class="btn btn-primary w-100" disabled>{{ __('save') }}</button>
        </form>
    </div>
</div>


<script>
    // البيانات من Laravel
    const cities = @json($cities);

    const stateSelect = document.getElementById('state');
    const citySelect = document.getElementById('city');
    const saveBtn = document.getElementById('saveBtn');
    const form = document.querySelector('form');

    // عند تغيير المحافظة
    stateSelect.addEventListener('change', function() {
        let stateId = this.value;
        citySelect.innerHTML = '<option value="">اختر المدينة</option>';

        if (cities[stateId]) {
            cities[stateId].forEach(city => {
                let option = document.createElement('option');
                option.value = city.id;
                option.textContent = city.name.ar;
                citySelect.appendChild(option);
            });
        }
    });

    // تفعيل زر الحفظ عند أي تعديل
    form.addEventListener('input', () => {
        saveBtn.disabled = false;
    });
</script>

</body>
</html>
