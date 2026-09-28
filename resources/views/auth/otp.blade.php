<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify OTP</title>
</head>
<body>
    <h2>Two-Factor Authentication (OTP)</h2>

    @if (session('success'))
        <div style="color: green; margin-bottom: 15px;">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div style="color: red; margin-bottom: 15px;">
            {{ session('error') }}
        </div>
    @endif

    <form action="{{ route('otp.verify') }}" method="POST">
        @csrf
        <label for="otp">Enter OTP :</label>
        <input type="text" name="otp" id="otp" required>
        @error('otp')
            <span style="color: red;">{{ $message }}</span>
        @enderror

        <br><br>

        <button type="submit">Verify OTP</button>
    </form>
</body>
</html>