<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use function Laravel\Prompts\select;

class UserController extends Controller
{
    public function index()
    {
        // Ensure page and pageSize are set correctly
        $currentPage = max(request()->get('page', 1), 1);  // Make sure currentPage is >= 1
        $perPage = max(request()->get('pageSize', 10), 1); // Ensure perPage is >= 1

        // Calculate offset
        $offset = ($currentPage - 1) * $perPage;

        // Fetch paginated data using the SQL function
        $datas = DB::select('SELECT * FROM dbo.fn_get_user_page (?, ?)', [$currentPage, $perPage]);

        // Get the total count of users
        $total = DB::table('users')->count();

        // Create the LengthAwarePaginator instance
        $users = new \Illuminate\Pagination\LengthAwarePaginator(
            $datas, $total, $perPage, $currentPage, [
                'path' => url()->current(),
                'query' => request()->query()
            ]
        );

        return view('admin.user.index', compact('users'));
    }

    public function create()
    {
        $roles = DB::select('SELECT * FROM dbo.fn_get_all_roles()');
        return view('admin.user.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $validator = $request->validate([
            'username' => 'required|string|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'email' => 'required|string|email|max:255|unique:users',
            'phone_number' => 'nullable|string|max:15|regex:/^[0-9]{10,15}$/',
            'address' => 'nullable|string|max:255',
            'role' => 'required|string',
        ]);

        DB::statement(
            'EXEC sp_create_user
            @username = ?,
            @password = ?,
            @name = ?,
            @email = ?,
            @phone_number = ?,
            @address = ?,
            @role = ?', [
            $request->input('username'),
            Hash::make($request->input('password')),
            $request->input('name'),
            $request->input('email'),
            $request->input('phone_number'),
            $request->input('address'),
            $request->input('role'),
        ]);

        return redirect()->route('admin.users.index');
    }

    public function show(string $id)
    {
        $data = DB::select('SELECT * FROM vw_user_detail WHERE user_id = ?', [$id]);
        $user = $data[0];
        return view('admin.user.show', compact('user'));
    }

    public function edit(int $id)
    {
        $user = User::findOrFail($id);
        return view('admin.user.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'phone_number' => 'nullable|numeric|digits_between:1,10', // Ensure phone number is numeric and allows up to 10 digits
            'address' => 'nullable|string|max:255',
        ]);

        // Update the user data
        $a = $user->update($request->only(['name', 'email', 'phone_number', 'address'])); // Only update relevant fields
        // Redirect back to the users index
        return redirect()->route('admin.users.index');
    }

}
