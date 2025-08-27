<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
  <meta charset="UTF-8">
  <title>إعادة تعيين كلمة المرور</title>
  <style>
    body {
      background-color: #f5f5f5;
      font-family: Arial, sans-serif;
    }

    .reset-container {
      max-width: 400px;
      margin: 80px auto;
      padding: 30px;
      background-color: #fff;
      border-radius: 12px;
      box-shadow: 0 4px 15px rgba(0,0,0,0.1);
      text-align: center;
    }

    h2 {
      color: #a864a8;
      margin-bottom: 15px;
    }

    .error-msg {
      color: red;
      margin-bottom: 10px;
    }

    .success-msg {
      color: green;
      margin-bottom: 10px;
    }

    input {
      width: 100%;
      padding: 12px;
      font-size: 16px;
      border: 1px solid #ccc;
      border-radius: 8px;
      margin-bottom: 15px;
      transition: border-color 0.3s;
    }

    input:focus {
      border-color: #a864a8;
      outline: none;
    }

    button {
      width: 100%;
      padding: 12px;
      font-size: 16px;
      border: none;
      border-radius: 8px;
      margin-top: 10px;
      cursor: pointer;
      transition: 0.3s;
    }

    .btn-primary {
      background-color: #a864a8;
      color: #fff;
    }

    .btn-primary:hover {
      background-color: #872b87;
    }
  </style>
</head>
<body>

<div class="reset-container">
  <h2>إعادة تعيين كلمة المرور</h2>

  @if ($errors->any())
      <p class="error-msg">{{ $errors->first() }}</p>
  @endif

  @if (session('success'))
      <p class="success-msg">{{ session('success') }}</p>
  @endif

  <form method="POST" action="{{ route('auth.passwordReset.update') }}">
    @csrf

    <!-- phone جاي من URL /reset-password/{phone} -->
    <input type="hidden" name="phone" value="{{ $phone }}">

    <input type="password" name="password" placeholder="كلمة المرور الجديدة" required>
    <input type="password" name="password_confirmation" placeholder="تأكيد كلمة المرور" required>

    <button type="submit" class="btn-primary">حفظ كلمة المرور</button>
  </form>
</div>

</body>
</html>
