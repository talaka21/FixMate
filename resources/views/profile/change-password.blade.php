<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تغيير كلمة المرور</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f0f2f5; padding: 20px; }
        .container { max-width: 400px; margin: 50px auto; background: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.1); }
        h2 { text-align: center; margin-bottom: 20px; }
        label { display: block; margin-bottom: 5px; font-weight: bold; }
        input[type="password"] { width: 100%; padding: 10px; margin-bottom: 10px; border-radius: 5px; border: 1px solid #ccc; }
        button.show-hide { position: absolute; right: 10px; top: 10px; background: none; border: none; cursor: pointer; color: #555; }
        .field-wrapper { position: relative; }
        .btn-submit { width: 100%; padding: 12px; background: #007BFF; color: #fff; border: none; border-radius: 5px; cursor: pointer; font-size: 16px; }
        .btn-submit:hover { background: #0056b3; }
        .error { color: red; font-size: 14px; margin-bottom: 10px; }
        .success { color: green; font-size: 14px; margin-bottom: 10px; }
    </style>
</head>
<body>
    <div class="container">
        <h2>تغيير كلمة المرور</h2>

        @if(session('success'))
            <div class="success">{{ session('success') }}</div>
        @endif

        <form action="{{ route('profile.update-password') }}" method="POST">
            @csrf

            <!-- Current Password -->
            <div class="field-wrapper">
                <label for="current_password">كلمة المرور الحالية</label>
                <input id="current_password" type="password" name="current_password">
                <button type="button" class="show-hide" onclick="togglePassword('current_password')">عرض</button>
                @error('current_password')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <!-- New Password -->
            <div class="field-wrapper">
                <label for="new_password">كلمة المرور الجديدة</label>
                <input id="new_password" type="password" name="new_password">
                <button type="button" class="show-hide" onclick="togglePassword('new_password')">عرض</button>
                @error('new_password')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn-submit">تغيير كلمة المرور</button>
        </form>
    </div>

    <script>
        function togglePassword(id) {
            const field = document.getElementById(id);
            field.type = field.type === "password" ? "text" : "password";
        }
    </script>
</body>
</html>
