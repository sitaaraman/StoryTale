@section('content')
<h2>{{ $mailOtpSend['title'] }}</h2>

    <p>Hi <strong>{{ $mailOtpSend['username'] }}</strong>,</p>

    <p>Your OTP for email verification is:</p>

    <h3 style="color: #2c3e50;">{{ $mailOtpSend['otp'] }}</h3>

    <p>This OTP will expire in 10 minutes.</p>

    <br>
    <p>Thank you,<br><strong>StoryTale Team</strong></p>

@endsection

