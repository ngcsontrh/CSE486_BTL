@extends('layouts.app')
@section('content')

<div class="container my-5">
    <h1 class="text-center mb-4">Create New User</h1>

    <form action="{{ route('admin.users.store') }}" method="POST">
        @csrf

        <!-- Username Input -->
        <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" name="username" id="username" value="{{ old('username') }}"
                   class="form-control @error('username') is-invalid @enderror" placeholder="Enter username" required>
            @error('username')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Email Input -->
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" id="email" value="{{ old('email') }}"
                   class="form-control @error('email') is-invalid @enderror" placeholder="Enter email" required>
            @error('email')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Password Input -->
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" placeholder="Enter password" required>
            @error('password')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Password Confirm Input -->
        <div class="mb-3">
            <label for="password_confirmation" class="form-label">Confirm Password</label>
            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" placeholder="Confirm password" required>
            @error('password_confirmation')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" name="name" id="username" value="{{ old('name') }}"
                   class="form-control @error('name') is-invalid @enderror" placeholder="Enter name" required>
            @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Address Input -->
        <div class="mb-3">
            <label for="address" class="form-label">Address</label>
            <input type="text" name="address" id="address" value="{{ old('address') }}"
                   class="form-control @error('address') is-invalid @enderror" placeholder="Enter address">
            @error('address')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Phone Number Input -->
        <div class="mb-3">
            <label for="phone" class="form-label">Phone Number</label>
            <input type="text" name="phone" id="phone" value="{{ old('phone') }}"
                   class="form-control @error('phone') is-invalid @enderror" placeholder="Enter phone number">
            @error('phone')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Role Dropdown -->
        <div class="mb-3">
            <label for="role" class="form-label">Role</label>
            <select name="role" id="role" class="form-select @error('role') is-invalid @enderror" required>
                <option value="" disabled selected>Select a role</option>
                @foreach ($roles as $role)
                    <option value="{{ $role->name }}" {{ old('role') == $role->name ? 'selected' : '' }}>{{ $role->name }}</option>
                @endforeach
            </select>
            @error('role')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Submit Button -->
        <div class="d-flex justify-content-end">
            <button type="submit" class="btn btn-primary">Create User</button>
        </div>
    </form>
</div>
@endsection
