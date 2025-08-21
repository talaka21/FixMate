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
    }

    .verify-container button:hover {
        background-color: #872b87;
    }

    .verify-container .note {
        font-size: 14px;
        color: #777;
        margin-top: 15px;
    }
</style>

<div class="verify-container">
    <h2>Verify Your Phone</h2>
    <p>We sent a verification code to: <strong>{{ $phone }}</strong></p>

    <form method="POST" action="{{ route('verification.submit') }}">
        @csrf
        <input type="text" name="verification_code" placeholder="Enter verification code" required>
        <button type="submit">Confirm</button>
    </form>

    <p class="note">Didn't receive the code? <a href="#" style="color: #a864a8;">Resend</a></p>
</div>
