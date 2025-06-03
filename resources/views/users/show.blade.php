@extends('layouts.app')

@section('contents')
<div class="container">
    <h1>User Details: {{ $user->name }}</h1>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">User Information</h5>
            <p class="card-text"><strong>ID:</strong> {{ $user->id }}</p>
            <p class="card-text"><strong>Name:</strong> {{ $user->name }}</p>
            <p class="card-text"><strong>Email:</strong> {{ $user->email }}</p>
            <p class="card-text"><strong>Role:</strong> {{ $user->role }}</p>
            <p class="card-text"><strong>Created At:</strong> {{ $user->created_at->format('M d, Y H:i') }}</p>
            <p class="card-text"><strong>Updated At:</strong> {{ $user->updated_at->format('M d, Y H:i') }}</p>
        </div>
    </div>

    <div class="mt-3">
        <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning">Edit User</a>
        <a href="{{ route('users.index') }}" class="btn btn-secondary">Back to Users List</a>
    </div>
</div>
@endsection