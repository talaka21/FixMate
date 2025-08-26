<div>
    <style>
    body {
        margin: 0;
        padding: 0;
        min-height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
        background: url('https://source.unsplash.com/1600x900/?abstract,technology') no-repeat center center;
        background-size: cover;
        font-family: Arial, sans-serif;
    }

    .form-container {
        width: 90%;
        max-width: 400px;
        padding: 30px;
        background: rgba(255, 255, 255, 0.95);
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.2);
    }

    h2 {
        text-align: center;
        margin-bottom: 20px;
        color: #333;
    }

    .alert-success {
        background: #d4edda;
        color: #155724;
        padding: 12px;
        border-radius: 8px;
        margin-bottom: 15px;
        border: 1px solid #c3e6cb;
    }

    .alert-error {
        background: #f8d7da;
        color: #721c24;
        padding: 12px;
        border-radius: 8px;
        margin-bottom: 15px;
        border: 1px solid #f5c6cb;
    }

    input {
        width: 100%;
        padding: 12px 15px;
        margin: 10px 0;
        border: 1px solid #ccc;
        border-radius: 8px;
        font-size: 14px;
        transition: border-color 0.3s;
    }

    input:focus {
        border-color: #a864a8;
        outline: none;
    }

    .btn {
        width: 100%;
        padding: 12px;
        background: #a864a8;
        color: #fff;
        border: none;
        border-radius: 8px;
        font-size: 16px;
        cursor: pointer;
        transition: background 0.3s;
        margin-top: 10px;
    }

    .btn:hover {
        background: #872b87;
    }

    .btn-secondary {
        background: #6c757d;
    }

    .btn-secondary:hover {
        background: #565e64;
    }

    @media (max-width: 500px) {
        .form-container {
            padding: 20px;
        }
    }
</style>

<div class="form-container">

    <h2>نسيت كلمة المرور</h2>

    {{-- ✅ رسالة النجاح --}}
    @if(session('success'))
        <div class="alert-success">
            {{ session('success') }}
        </div>
    @endif

    {{-- ✅ عرض الأخطاء --}}
    @if ($errors->any())
        <div class="alert-error">
            <ul style="margin: 0; padding-left: 20px;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('password.phone') }}">
        @csrf
        <input type="text" name="phone_number" placeholder="أدخل رقم الهاتف" maxlength="10" required>

        <button type="submit" class="btn">إعادة تعيين</button>
        <a href="{{ route('login') }}">
            <button type="button" class="btn btn-secondary">رجوع</button>
        </a>
    </form>
</div>

</div>
