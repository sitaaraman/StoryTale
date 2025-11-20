@extends('layouts.app')

@section('title', 'User Show')

@section('content')

    <div class="container d-flex justify-content-center pb-5">
            <div class="card m-5" style="width: 20rem;">
                <div class="card-header bg-primary text-white">
                    <h3>{{ $puser->fullname }}'s Profile</h3>
                </div>
                <img src="{{ asset('uploads/profiles/' . $puser->profile) }}" class="card-img-top" alt="User Profile">
                <div class="card-body">
                    <h5 class="card-title"><strong>Name: </strong>{{ $puser->fullname }}</h5>
                    <p class="card-text"><strong>Email: </strong>{{ $puser->email }}</p>
                    <p class="card-text"><strong>Phone: </strong>{{ $puser->phone_number }}</p> 
                    <p class="card-text"><strong>DOB: </strong>{{ $puser->dateofbirth }}</p>
                    <p class="card-text"><strong>Gender: </strong>{{ $puser->gender }}</p>
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('pusers.edit', [$puser->slug]) }}" class="btn btn-warning">Edit</a>
                        <div>
                            <form action="{{ route('pusers.destroy', [$puser->slug]) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this user?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </div>
                        <a href="{{ route('pusers.index') }}" class="btn btn-secondary">Back to Home</a>
                    </div>
                </div>
            </div> 
        </div>  

@endsection