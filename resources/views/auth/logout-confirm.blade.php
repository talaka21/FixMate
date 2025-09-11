<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('yes_logout') }}</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Arial, sans-serif;
            background-color: #f4f6f9;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .box {
            background: #fff;
            border: 1px solid #e5e7eb;
            padding: 35px 25px;
            border-radius: 14px;
            text-align: center;
            box-shadow: 0 6px 18px rgba(0,0,0,0.08);
            width: 90%;
            max-width: 420px;
        }
        h2 {
            margin-bottom: 30px;
            font-size: 22px;
            font-weight: 600;
            color: #111827;
        }
        form {
            display: inline-block;
        }
        button {
            margin: 10px;
            padding: 12px 28px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 15px;
            font-weight: 500;
            transition: all 0.3s ease;
        }
        .yes {
            background: #ef4444; /* red-500 */
            color: #fff;
        }
        .yes:hover {
            background: #dc2626; /* red-600 */
        }
        .no {
            background: #3b82f6; /* blue-500 */
            color: #fff;
        }
        .no:hover {
            background: #2563eb; /* blue-600 */
        }
    </style>
</head>
<body>
    <div class="box">
        <h2>{{ __('logout_confirm') }}</h2>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="yes">{{ __('yes_logout') }}</button>
        </form>
        <button class="no" onclick="window.history.back()">{{ __('no_stay') }}</button>
    </div>
</body>
</html>
