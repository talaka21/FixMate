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

    input, select {
        width: 100%;
        padding: 12px 15px;
        margin: 10px 0;
        border: 1px solid #ccc;
        border-radius: 8px;
        font-size: 14px;
        transition: border-color 0.3s;
    }

    input:focus, select:focus {
        border-color: #a864a8;
        outline: none;
    }

    label {
        display: flex;
        align-items: center;
        font-size: 14px;
        margin: 10px 0;
    }

    input[type="checkbox"] {
        margin-right: 10px;
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
        transition: background 0.3s;
    }

    button:hover {
        background: #872b87;
    }

    @media (max-width: 500px) {
        .form-container {
            padding: 20px;
        }
    }
</style>

<div class="form-container">

    {{-- ✅ رسالة النجاح --}}
    @if(session('success'))
        <div class="alert-success">
            {{ session('success') }}
        </div>
    @endif

    {{-- ✅ عرض الأخطاء --}}
    @if ($errors->any())
        <div class="alert-error">
            <ul style="margin: 0; padding-left: 20px;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if ($errors->has('phone_number'))
    <div class="alert-error">
        {{ $errors->first('phone_number') }}
    </div>
    @endif

    <form method="POST" action="{{ route('register.submit') }}">
        @csrf
        <input type="text" name="first_name" placeholder="First Name" required>
        <input type="text" name="last_name" placeholder="Last Name" required>
        <input type="text" name="phone_number" placeholder="Phone Number" maxlength="10" required>
        <input type="email" name="email" placeholder="Email" required>

        <select name="state_id" id="state" required>
            <option value="">Select State</option>
            @foreach($states as $state)
                <option value="{{ $state->id }}">{{ $state->name }}</option>
            @endforeach
        </select>

        <select name="city_id" id="city" required>
            <option value="">Select City</option>
        </select>

        <input type="password" name="password" placeholder="Password" required>
        <!-- رابط نسيان كلمة السر -->
{{-- <div style="text-align: right; margin-bottom: 10px;">
   <a href="{{ route('forgot-password.form') }}" style="font-size: 13px; color: #a864a8; text-decoration: none;">
    Forgot Password?
</a>
</div> --}}

<input type="password" name="password_confirmation" placeholder="Confirm Password" required>
    
        <label>
            <input type="checkbox" name="terms" required>
            I agree to the Terms and Conditions
        </label>

        <button type="submit">Register</button>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    $('#state').change(function() {
        var stateId = $(this).val();
        if(stateId) {
            $.ajax({
                url: '/cities/' + stateId,
                type: 'GET',
                success: function(data) {
                    $('#city').empty();
                    $('#city').append('<option value="">Select City</option>');
                    $.each(data, function(key, value) {
                        $('#city').append('<option value="'+ value.id +'">'+ value.name +'</option>');
                    });
                },
                error: function() {
                    $('#city').empty();
                    $('#city').append('<option value="">Select City</option>');
                }
            });
        } else {
            $('#city').empty();
            $('#city').append('<option value="">Select City</option>');
        }
    });
});
</script>
