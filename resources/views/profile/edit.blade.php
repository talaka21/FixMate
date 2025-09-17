<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <title>تعديل الملف الشخصي</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <div class="card mx-auto" style="max-width: 600px;">
        <div class="card-header">
            <h4>تعديل الملف الشخصي</h4>
        </div>
        <div class="card-body">

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- الاسم الأول -->
                <div class="mb-3">
                    <label for="first_name" class="form-label">الاسم الأول</label>
                    <input type="text" name="first_name" id="first_name" class="form-control"
                           value="{{ $user->first_name }}" required>
                </div>

                <!-- اسم العائلة -->
                <div class="mb-3">
                    <label for="last_name" class="form-label">اسم العائلة</label>
                    <input type="text" name="last_name" id="last_name" class="form-control"
                           value="{{ $user->last_name }}" required>
                </div>

                <!-- رقم الهاتف -->
                <div class="mb-3">
                    <label for="phone_number" class="form-label">رقم الهاتف</label>
                    <input type="text" name="phone_number" id="phone_number" class="form-control"
                           value="{{ $user->phone_number }}" required>
                </div>

                <!-- الدولة -->
                <div class="mb-3">
                    <label for="state" class="form-label">الدولة</label>
                    <select name="state_id" id="state" class="form-select" required>
                        <option value="">اختر الدولة</option>
                        @foreach($states as $state)
                            <option value="{{ $state->id }}"
                                {{ $user->state_id == $state->id ? 'selected' : '' }}>
                                {{ $state->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- المدينة -->
                <div class="mb-3">
                    <label for="city" class="form-label">المدينة</label>
                    <select name="city_id" id="city" class="form-select" required>
                        <option value="">اختر المدينة</option>
                        @if($user->state_id && isset($cities[$user->state_id]))
                            @foreach($cities[$user->state_id] as $city)
                                <option value="{{ $city->id }}"
                                    {{ $user->city_id == $city->id ? 'selected' : '' }}>
                                    {{ $city->name }}
                                </option>
                            @endforeach
                        @endif
                    </select>
                </div>

                <!-- صورة الملف الشخصي -->
                <div class="mb-3">
                    <label for="profile_image" class="form-label">صورة الملف الشخصي</label>
                    <input type="file" name="image" id="profile_image" class="form-control">
                    <img id="preview_image"
                         src="{{ $user->image ? asset($user->image) : '' }}"
                         alt="صورة الملف الشخصي"
                         class="mt-2"
                         style="width:100px; height:100px; object-fit:cover; {{ $user->image ? '' : 'display:none;' }}">
                </div>

                <!-- زر الحفظ -->
                <button type="submit" class="btn btn-primary w-100">حفظ</button>
            </form>
        </div>
    </div>
</div>

<script>
    // معاينة الصورة قبل التحميل
    const profileInput = document.getElementById('profile_image');
    const previewImage = document.getElementById('preview_image');
    profileInput.addEventListener('change', function() {
        const file = this.files[0];
        if(file){
            const reader = new FileReader();
            reader.onload = function(e){
                previewImage.src = e.target.result;
                previewImage.style.display = 'block';
            }
            reader.readAsDataURL(file);
        }
    });

    // تحديث المدن ديناميكيًا عند اختيار الدولة
    const citiesByState = @json($cities); // جلب المدن من الكنترولر كمصفوفة JSON

    document.getElementById('state').addEventListener('change', function(){
        const stateId = this.value;
        const citySelect = document.getElementById('city');
        citySelect.innerHTML = '<option value="">اختر المدينة</option>';

        if(citiesByState[stateId]){
            citiesByState[stateId].forEach(city => {
                const option = document.createElement('option');
                option.value = city.id;
                option.textContent = city.name;
                citySelect.appendChild(option);
            });
        }
    });
</script>
</body>
</html>
