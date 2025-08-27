<style>
    body {
        margin: 0;
        padding: 0;
        min-height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
        background: url('https://source.unsplash.com/1600x900/?nature,abstract') no-repeat center center;
        background-size: cover;
        font-family: Arial, sans-serif;
    }

    .form-container {
        width: 90%;
        max-width: 450px;
        padding: 30px;
        background: rgba(255, 255, 255, 0.95);
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.2);
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
    }

    button {
        width: 48%;
        padding: 12px;
        background: #a864a8;
        color: #fff;
        border: none;
        border-radius: 8px;
        font-size: 16px;
        cursor: pointer;
        margin-top: 10px;
    }

    button:hover {
        background: #872b87;
    }

    h2 {
        text-align: center;
        margin-bottom: 20px;
    }

    .buttons {
        display: flex;
        justify-content: space-between;
    }
</style>

<div class="form-container">
    <h2>Forgot Password</h2>

    {{-- رسالة النجاح --}}
    @if(session('success'))
        <div class="alert-success">
            {{ session('success') }}
        </div>
    @endif

    {{-- عرض الأخطاء --}}
    @if ($errors->any())
        <div class="alert-error">
            <ul style="margin: 0; padding-left: 20px;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- فورم الهاتف --}}
<form method="POST" action="{{ route('forgot-password.send') }}">
    @csrf
    <input type="text" name="phone" placeholder="Enter your phone number" required maxlength="10">

    <div class="buttons">
        <a href="{{ route('login') }}" style="display:inline-block; width:48%; text-align:center; padding:12px; border-radius:8px; background:#ccc; color:#000; text-decoration:none; font-size:16px;">
            Back
        </a>
        <button type="submit" style="width:48%;">Reset</button>
    </div>
</form>

</div>
