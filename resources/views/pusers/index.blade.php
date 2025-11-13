@extends('layouts.app')

@section('title', 'Index')

@section('content')

    <a href="{{ route('pusers.create') }}" class="btn btn-primary mb-3">Register New User</a>

@endsection