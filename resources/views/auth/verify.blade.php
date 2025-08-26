<style>
    .verify-container {
        max-width: 500px;
        margin: 60px auto;
        padding: 40px;
        background-color: #fff;
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.1);
        font-family: Arial, sans-serif;
        text-align: center;
    }

    .verify-container h2 {
        color: #a864a8;
        font-size: 24px;
        margin-bottom: 20px;
    }

    .verify-container p {
        font-size: 16px;
        margin-bottom: 30px;
        color: #333;
    }

    .verify-container input[type="text"] {
        width: 100%;
        padding: 12px 15px;
        font-size: 16px;
        border: 1px solid #ccc;
        border-radius: 8px;
        margin-bottom: 20px;
        transition: border-color 0.3s;
        text-align: center;
    }

    .verify-container input[type="text"]:focus {
        border-color: #a864a8;
        outline: none;
    }

    .verify-container button {
        width: 100%;
        padding: 12px;
        background-color: #a864a8;
        color: #fff;
        border: none;
        border-radius: 8px;
        font-size: 16px;
        cursor: pointer;
        transition: background 0.3s;
        margin-top: 10px;
    }

    .verify-container button:hover {
        background-color: #872b87;
    }

    .verify-container .note {
        font-size: 14px;
        color: #777;
        margin-top: 15px;
        display: block;
    }

    .disabled-btn {
        background-color: #ccc !important;
        cursor: not-allowed !important;
    }
</style>

<div class="verify-container">
    <h2>Verify Your Phone</h2>
    <p>We sent a verification code to: <strong>{{ $phone }}</strong></p>

    <!-- Success Message -->
    @if(session('success'))
        <p style="color: green">{{ session('success') }}</p>
    @endif

    <!-- Submit form -->
    <form method="POST" action="{{ route('verify.code') }}">
    @csrf
    <!-- مهم: رقم الهاتف حتى نعرف أي مستخدم نتحقق منه -->
    <input type="hidden" name="phone" value="{{ $phone }}">

    <input type="text" name="verification_code" placeholder="أدخل رمز التحقق"
           required maxlength="4" inputmode="numeric" pattern="[0-9]*">
    <button type="submit">✔️ تأكيد</button>
</form>

    <!-- Error Message -->
    @if($errors->has('verification_code'))
        <p style="color:red">{{ $errors->first('verification_code') }}</p>
    @endif

    <!-- Resend button -->
    <button id="resendBtn" type="button" onclick="resendCode()">🔄 Resend Code</button>
    <small id="timerMsg" class="note"></small>

    <!-- Back button -->
    <button type="button" onclick="window.history.back()">🔙 Back</button>
</div>

<script>
    let resendTimeout = 120; // ثواني (دقيقتين)
    let isResendBlocked = false;

    function resendCode() {
        if (isResendBlocked) return;

        fetch("{{ route('verify.resend') }}", {
            method: "POST",
            headers: {
                "X-CSRF-TOKEN": "{{ csrf_token() }}",
                "Content-Type": "application/json"
            },
            body: JSON.stringify({ phone: "{{ $phone }}" })
        })
        .then(res => res.json())
        .then(data => {
            document.getElementById("timerMsg").innerText = data.message || "New code sent to your phone.";
        });

        // تعطيل الزر دقيقتين
        isResendBlocked = true;
        const btn = document.getElementById("resendBtn");
        btn.classList.add("disabled-btn");
        btn.disabled = true;

        let counter = resendTimeout;
        const timerMsg = document.getElementById("timerMsg");

        const interval = setInterval(() => {
            counter--;
            timerMsg.innerText = "يمكنك إعادة الإرسال بعد " + counter + " ثانية";

            if (counter <= 0) {
                clearInterval(interval);
                isResendBlocked = false;
                btn.classList.remove("disabled-btn");
                btn.disabled = false;
                timerMsg.innerText = "";
            }
        }, 1000);
    }
</script>
