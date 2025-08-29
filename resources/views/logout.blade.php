<div>
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
    <button class="yes" onclick="logout()">نعم، تسجيل الخروج</button>
    <button class="no" onclick="stay()">لا</button>
  </div>

  <script>
    function logout() {
      // هنا امسح بيانات الجلسة أو التوكن
      localStorage.clear();
      sessionStorage.clear();

      // توجيه المستخدم إلى صفحة تسجيل الدخول
      window.location.href = "login.html";
    }

    function stay() {
      // ببساطة إغلاق النافذة أو الرجوع للصفحة السابقة
      window.history.back();
    }
  </script>
</body>
</html>

</div>
