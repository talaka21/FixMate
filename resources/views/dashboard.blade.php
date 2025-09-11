<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('fixmate_dashboard') }}</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
        }
        .sidebar {
            width: 250px;
            min-height: 100vh;
        }
        .content {
            flex: 1;
            padding: 20px;
        }
    </style>
</head>
<body>
    <!-- Main Layout -->
    <div class="d-flex">
        <!-- Sidebar -->
        <div class="sidebar bg-dark text-white p-3">
            <h4 class="mb-4">FixMate</h4>
            <ul class="nav flex-column">
                <li class="nav-item mb-2"><a class="nav-link text-white" href="#">{{ __('home') }}</a></li>
                <li class="nav-item mb-2"><a class="nav-link text-white" href="#">{{ __('devices') }}</a></li>
                <li class="nav-item mb-2"><a class="nav-link text-white" href="#">{{ __('messages') }}</a></li>
                <li class="nav-item mb-2"><a class="nav-link text-white" href="#">{{ __('campaigns') }}</a></li>
                <li class="nav-item mb-2"><a class="nav-link text-white" href="#">{{ __('settings') }}</a></li>
            </ul>
        </div>

        <!-- Main Content -->
        <div class="content">
            <!-- Navbar -->
            <nav class="navbar navbar-expand-lg navbar-light bg-light rounded mb-4 px-3 shadow-sm">
                <div class="container-fluid">
                    <span class="navbar-text ms-auto">
                        {{ __('welcome_user', ['name' => 'John Doe']) }}
                    </span>
                </div>
            </nav>

            <!-- Dashboard Content -->
            <h2 class="mb-4">{{ __('dashboard') }}</h2>
            <div class="card p-3">
                <p>{{ __('dashboard_intro') }}</p>
                <p>{{ __('dashboard_content') }}</p>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
