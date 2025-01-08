@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h1 class="text-3xl font-semibold mb-4">User Details</h1>

        <div class="card shadow-sm rounded-lg">
            <div class="card-body">
                <!-- Basic Information -->
                <div class="mb-4">
                    <h2 class="h5 font-semibold">Basic Information</h2>
                    <p><strong>Name:</strong> {{ $user->user_name }}</p>
                    <p><strong>Email:</strong> {{ $user->user_email }}</p>
                </div>

                <!-- Additional Information -->
                <div class="mb-4">
                    <h2 class="h5 font-semibold">Additional Information</h2>

                    <p><strong>Phone:</strong>
                        @if($user->user_phone_number)
                            {{ $user->user_phone_number }}
                        @else
                            <span class="text-muted">Not provided</span>
                        @endif
                    </p>

                    <p><strong>Address:</strong>
                        @if($user->user_address)
                            {{ $user->user_address }}
                        @else
                            <span class="text-muted">Not provided</span>
                        @endif
                    </p>

                    <p><strong>Role:</strong> {{ $user->role_name }}</p>
                </div>

                <!-- Action Buttons -->
                <div class="mb-4 d-flex justify-content-start gap-2">
                    <a href="{{ route('admin.users.edit', ['id' => $user->user_id]) }}" class="btn btn-primary mr-3">
                        Edit
                    </a>
                    <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">
                        Back
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
