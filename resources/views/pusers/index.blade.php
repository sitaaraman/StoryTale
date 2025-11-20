@extends('layouts.app')

@section('title', 'Index')

@section('content')

    <div class="container p-5">
        <h2 class="mb-4">Registered Users</h2>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

    </div>
    
    <a href="{{ route('pusers.create') }}" class="btn btn-primary mb-3">Register New User</a>

@endsection