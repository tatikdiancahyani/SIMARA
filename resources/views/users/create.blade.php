@extends('layouts.app')

@section('contents')
<div class="container">
    <h1>Create New User</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('users.store') }}" method="POST">
        @csrf
        <div class="form-group mb-3">
            <label for="name">Name:</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
        </div>
        <div class="form-group mb-3">
            <label for="email">Email:</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
        </div>
        <div class="form-group mb-3">
            <label for="password">Password:</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <div class="form-group mb-3">
            <label for="password_confirmation">Confirm Password:</label>
            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
        </div>
        <div class="form-group mb-3">
            <label for="role">Role:</label>
            <select class="form-control" id="role" name="role" required>
                <option value="">Select Role</option>
                <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                <option value="karyawan" {{ old('role') == 'karyawan' ? 'selected' : '' }}>Karyawan</option>
            </select>
        </div>
        <button type="submit" class="btn btn-success">Buat User</button>
        <a href="{{ route('users.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection