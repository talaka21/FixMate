<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <title>{{ __('notifications.settings_title') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <div class="card mx-auto" style="max-width: 500px;">
        <div class="card-header">
            <h4>{{ __('notifications.settings_title') }}</h4>
        </div>
        <div class="card-body">

            @if(session('success'))
                <div class="alert alert-success">{{ __('notifications.success_message') }}</div>
            @endif

            <form action="{{ route('notifications.settings.update') }}" method="POST">
                @csrf

                <div class="form-check form-switch mb-3">
                    <input class="form-check-input" type="checkbox" id="notifications_enabled" name="notifications_enabled" value="1"
                        {{ $user->notifications_enabled ? 'checked' : '' }}>
                    <label class="form-check-label" for="notifications_enabled">{{ __('notifications.enable') }}</label>
                </div>

                <button type="submit" class="btn btn-primary w-100">{{ __('notifications.save') }}</button>
            </form>
        </div>
    </div>
</div>
</body>
</html>
