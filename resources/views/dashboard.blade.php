<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FixMate Dashboard</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    @extends('layouts.app')

    @section('content')
    <div class="d-flex">
        <!-- Sidebar -->
        <div class="bg-dark text-white p-3" style="width:250px; min-height:100vh;">
            <h4 class="mb-4">FixMate</h4>
            <ul class="nav flex-column">
                <li class="nav-item mb-2"><a class="nav-link text-white" href="{{ route('dashboard') }}">الرئيسية</a></li>
                <li class="nav-item mb-2"><a class="nav-link text-white" href="#">الأجهزة</a></li>
                <li class="nav-item mb-2"><a class="nav-link text-white" href="#">الرسائل</a></li>
                <li class="nav-item mb-2"><a class="nav-link text-white" href="#">الحملات</a></li>
                <li class="nav-item mb-2"><a class="nav-link text-white" href="#">إعدادات</a></li>
            </ul>
        </div>

        <!-- Main Content -->
        <div class="flex-fill p-4">
            <h2>مرحباً {{ Auth::user()->name }}</h2>
            <div class="card p-3 mt-3">
                <p>هذا مثال على لوحة تحكم تشبه اللي بالصورة 👌</p>
                <p>ممكن تحط جداول، Charts، أو أي محتوى هون.</p>
            </div>
        </div>
    </div>
    @endsection

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
