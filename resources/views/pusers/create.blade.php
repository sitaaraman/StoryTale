@extends('layouts.app')

@section('title' , 'Register')

@section('content')
<div class="container p-5">

    {{-- ✅ If OTP is not sent yet, show registration form @if(!session('pending_puser'))@endif --}}

    
    <h3 class="mb-4">Register New Account</h3>

    <form action="{{ route('pusers.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label>Fullname</label>
            <input type="text" name="fullname" class="form-control" value="{{ old('fullname') }}">
            @error('fullname') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="mb-3">
            <label>Username</label>
            <input type="text" name="username" class="form-control" value="{{ old('username') }}">
            @error('username') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" value="{{ old('email') }}">
            @error('email') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="mb-3">
            <label>Gender</label><br>
            <label><input type="radio" name="gender" value="male" {{ old('gender') == 'male'?'checked':'' }}> Male</label>
            <label class="ms-3"><input type="radio" name="gender" value="female" {{ old('gender') == 'female'?'checked':'' }}> Female</label>
            <label class="ms-3"><input type="radio" name="gender" value="other" {{ old('gender') == 'other'?'checked':'' }}> Other</label>
            @error('gender') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label>Date of Birth</label>
            <input type="date" name="dateofbirth" class="form-control" value="{{ old('dateofbirth') }}">
            @error('dateofbirth') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="mb-3">
            <label>Phone Number</label>
            <input type="text" name="phone_number" class="form-control" value="{{ old('phone_number') }}">
            @error('phone_number') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="mb-3">
            <label>Profile Photo</label>
            <input type="file" name="profile" class="form-control" accept="image/*">
        </div>

        <div class="mb-3">
            <label>Password</label>
            <input type="password" name="password" class="form-control">
            @error('password') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="mb-3">
            <label>Confirm Password</label>
            <input type="password" name="password_confirmation" class="form-control">
            @error('password_confirmation') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <button type="submit" class="btn btn-primary w-100">Register</button>
    </form>
    
    

</div>
@endsection
