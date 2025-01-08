<!-- resources/views/admin/users/index.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-xl font-bold mb-4">User List</h1>
        <a href="{{ route('admin.users.create') }}" class="btn btn-success mb-4">Create New User</a>

        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Name</th>
                    <th>Role</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @forelse ($users as $user)
                    <tr>
                        <td>{{ $user->user_id }}</td>
                        <td>{{ $user->user_username }}</td>
                        <td>{{ $user->user_name }}</td>
                        <td>{{ $user->role_name }}</td>
                        <td>
                            <!-- Example Actions -->
                            <a href="{{ route('admin.users.show',['id' => $user->user_id]) }}" class="btn btn-primary btn-sm">View</a>
                            <a href="{{ route('admin.users.edit', $user->user_id) }}"
                               class="btn btn-secondary btn-sm">Edit</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">No users found.</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination Links -->
        <div class="mt-4">
            {{ $users->links() }}
        </div>
    </div>
@endsection
