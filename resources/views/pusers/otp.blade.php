@extends('layouts.app')

@section('title' , 'OTP Verification')

@section('content')

<div class="container mt-5">

    <h3 class="mb-4">Verify Your Email</h3>
    <p class="text-muted">
        An OTP has been sent to your registered email address. Please enter it below to verify your account.
    </p>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <form action="{{ route('otp.verify') }}" method="POST">
        @csrf
        {{-- Include email or username from session --}}
        <input type="hidden" name="email" value="{{ session('pending_puser.email') }}">

        <div class="mb-3">
            <label>Enter OTP</label>
            <input type="text" name="otp" class="form-control" placeholder="6-digit OTP" required>
            @error('otp') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <button type="submit" class="btn btn-success w-100 mb-2">Verify OTP</button>
    </form>

    {{-- Resend OTP --}}
    <form action="{{ route('otp.resend') }}" method="GET">
        <button type="submit" class="btn btn-secondary w-100">Resend OTP</button>
    </form>

</div>

@endsection
