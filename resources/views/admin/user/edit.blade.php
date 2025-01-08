<!-- resources/views/users/edit.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h1 class="text-3xl font-semibold mb-4">Edit User</h1>

        <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Name Field -->
            <div class="mb-4">
                <label for="name" class="form-label">Name</label>
                <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}"
                       class="form-control @error('name') is-invalid @enderror" placeholder="Enter the user's name">
                @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Email Field -->
            <div class="mb-4">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}"
                       class="form-control @error('email') is-invalid @enderror" placeholder="Enter the user's email">
                @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Phone Number Field -->
            <div class="mb-4">
                <label for="phone_number" class="form-label">Phone number</label>
                <input type="tel" name="phone_number" id="phone_number" value="{{ old('phone_number', $user->phone_number) }}"
                       class="form-control @error('phone_number') is-invalid @enderror" placeholder="Enter the user's phone number">
                @error('phone_number')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Address Field -->
            <div class="mb-4">
                <label for="address" class="form-label">Address</label>
                <input type="text" name="address" id="address" value="{{ old('address', $user->address) }}"
                       class="form-control @error('address') is-invalid @enderror" placeholder="Enter the user's address">
                @error('address')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Submit Button -->
            <div class="mb-4">
                <button type="submit" class="btn btn-primary w-100">
                    Update User
                </button>
                <a href="{{ route('admin.users.index') }}" class="btn btn-secondary w-100 mt-1">
                    Cancel
                </a>
            </div>
        </form>
    </div>
@endsection
