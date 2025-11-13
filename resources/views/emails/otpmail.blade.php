@component('mail::message')
# Hello {{ $mailOtpSend['username'] }},

We received your registration request.  
Please use the OTP below to verify your email address:

@component('mail::panel')
**Your OTP:** {{ $mailOtpSend['otp'] }}
@endcomponent

This OTP will expire in **10 minutes**.  
If you didn’t request this, you can safely ignore this email.

Thanks,  
**{{ config('app.name') }}** Team
@endcomponent
