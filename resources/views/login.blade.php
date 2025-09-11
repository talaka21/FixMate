<div>
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
        width: 100%;
        padding: 12px;
        background: #a864a8;
        color: #fff;
        border: none;
        border-radius: 8px;
        font-size: 16px;
        cursor: pointer;
    }

    button:hover {
        background: #872b87;
    }

    .show-password {
        margin: 5px 0 15px;
        display: flex;
        align-items: center;
        font-size: 13px;
    }

    .links {
        margin-top: 10px;
        display: flex;
        justify-content: space-between;
        font-size: 14px;
    }

    .links a {
        color: #a864a8;
        text-decoration: none;
    }
  </style>

  <div class="form-container">
      <h2>{{ __('login') }}</h2>

      {{-- Display Errors --}}
      @if ($errors->any())
          <div class="alert-error">
              <ul style="margin: 0; padding-left: 20px;">
                  @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                  @endforeach
              </ul>
          </div>
      @endif

      <form method="POST" action="{{ route('login.submit') }}">
          @csrf
          <input type="text" name="phone" placeholder="{{ __('phone_number') }}" required maxlength="10">

          <input type="password" name="password" placeholder="{{ __('password') }}" id="password" required>
          <label class="show-password">
              <input type="checkbox" onclick="togglePassword()"> {{ __('show_password') }}
          </label>

          <button type="submit">{{ __('sign_in') }}</button>
      </form>

      <div class="links">
          <a href="{{ route('forgot-password.form') }}">{{ __('forgot_password') }}</a>
          <a href="{{ route('service_providers.create') }}">{{ __('become_seller') }}</a>
      </div>
  </div>

  <script>
      function togglePassword() {
          var x = document.getElementById("password");
          x.type = x.type === "password" ? "text" : "password";
      }
  </script>
</div>
