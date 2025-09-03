<!DOCTYPE html>
<html lang="ar">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>تسجيل الخروج</title>
  <style>
    body { font-family: Tahoma, Arial; text-align: center; padding: 50px; }
    .box { border: 1px solid #ddd; padding: 30px; border-radius: 10px; display: inline-block; }
    button { margin: 10px; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer; }
    .yes { background: #d9534f; color: white; }
    .no { background: #5bc0de; color: white; }
  </style>
</head>
<body>

  <div class="box">
    <h2>هل أنت متأكد أنك تريد تسجيل الخروج؟</h2>

    <!-- زر نعم (خروج) -->
    <form method="POST" action="{{ route('logout') }}" style="display:inline;">
        @csrf
        <button type="submit" class="yes">نعم، تسجيل الخروج</button>
    </form>

    <!-- زر لا (رجوع) -->
    <button class="no" onclick="window.history.back()">لا</button>
  </div>

</body>
</html>
