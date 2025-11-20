@extends('layouts.app')

@section('title', 'User Edit')

@section('content')

    <div class="container d-flex justify-content-center pb-5">
            <div class="card m-5" style="width: 20rem;">
                <div class="card-header bg-primary text-white">
                    <h3>Edit {{ $puser->username }}'s Profile</h3>
                </div>
                <img src="{{ asset('uploads/profiles/' . $puser->profile) }}" class="card-img-top" alt="User Profile">
                <div class="card-body">
                    <form action="{{ route('pusers.update', [$puser->slug]) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="fullname" class="form-label">Full Name</label>
                            <input type="text" class="form-control" id="fullname" name="fullname" value="{{ $puser->fullname }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ $puser->email }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="phone_number" class="form-label">Phone Number</label>
                            <input type="text" class="form-control" id="phone_number" name="phone_number" value="{{ $puser->phone_number }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="dateofbirth" class="form-label">Date of Birth</label>
                            <input type="date" class="form-control" id="dateofbirth" name="dateofbirth" value="{{ $puser->dateofbirth }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="gender" class="form-label">Gender</label>  
                            <label><input type="radio" name="gender" value="male" {{ $puser->gender == 'male' ? 'checked' : '' }}> Male</label>
                            <label class="ms-3"><input type="radio" name="gender" value="female" {{ $puser->gender == 'female' ? 'checked' : '' }}>Female</label>
                            <label class="ms-3"><input type="radio" name="gender" value="other" {{ $puser->gender == 'other' ? 'checked' : '' }}> Other</label>
                        </div>
                        <div class="mb-3">
                            <label for="profile" class="form-label">Current Profile Photo</label>
                            <img src="{{ asset('uploads/profiles/' . $puser->profile) }}" alt="Current Profile" class="mt-3" style="width: 100px; height: 100px; object-fit: cover;">
                        </div>
                        <div class="mb-3">
                            <label for="profile" class="form-label">Update Profile Photo</label>
                            <input type="file" class="form-control" id="profile" name="profile" accept="image/*">  
                        </div>
                        <div class="mb-3">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control" value="{{ $puser->password }}">
                            @error('password') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label>Confirm Password</label>
                            <input type="password" name="password_confirmation" class="form-control" value="{{ $puser->password }}">
                            @error('password_confirmation') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        <button type="submit" class="btn btn-primary">Update Profile</button>
                    </form>
                </div>
            </div>
        </div>

@endsection