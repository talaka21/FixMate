<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
  <meta charset="UTF-8">
  <title>صفحة التحقق</title>
  <style>
    body {
      background-color: #f5f5f5;
      font-family: Arial, sans-serif;
    }

    .verify-container {
      max-width: 400px;
      margin: 80px auto;
      padding: 30px;
      background-color: #fff;
      border-radius: 12px;
      box-shadow: 0 4px 15px rgba(0,0,0,0.1);
      text-align: center;
    }

    .verify-container h2 {
      color: #a864a8;
      margin-bottom: 15px;
    }

    .verify-container p {
      color: #333;
      margin-bottom: 25px;
      font-size: 15px;
    }

    .verify-container input[type="text"] {
      width: 100%;
      padding: 12px;
      font-size: 18px;
      text-align: center;
      border: 1px solid #ccc;
      border-radius: 8px;
      margin-bottom: 20px;
      letter-spacing: 5px;
      transition: border-color 0.3s;
    }

    .verify-container input[type="text"]:focus {
      border-color: #a864a8;
      outline: none;
    }

    .verify-container button {
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

    .btn-secondary {
      background-color: #e0e0e0;
      color: #333;
    }

    .btn-secondary:hover {
      background-color: #bdbdbd;
    }

    .error-msg {
      color: red;
      margin-bottom: 10px;
    }

    .success-msg {
      color: green;
      margin-bottom: 10px;
    }
  </style>
</head>
<body>

<div class="verify-container">
  <h2>التحقق من رقم الهاتف</h2>
  <p>تم إرسال رمز التحقق إلى الرقم: <strong>{{ $phone }}</strong></p>

  <!-- الأخطاء -->
  @if ($errors->any())
      <p class="error-msg">❌ {{ $errors->first() }}</p>
  @endif

  <!-- رسالة نجاح -->
  @if (session('success'))
      <p class="success-msg">{{ session('success') }}</p>
  @endif

  <!-- إدخال الرمز -->
 <form method="POST" action="{{ route('auth.verificationPhone.check') }}">
    @csrf
    <input type="hidden" name="phone" value="{{ $phone }}">

    <input type="text" name="verification_code" placeholder="ادخل رمز التحقق" required>
    <button type="submit">تحقق</button>
</form>


  <!-- زر رجوع -->
  <button class="btn-secondary" onclick="window.history.back()">رجوع</button>
</div>

</body>
</html>
