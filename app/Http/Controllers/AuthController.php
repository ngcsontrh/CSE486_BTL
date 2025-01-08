<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function handleLogin(Request $request)
    {
        $validator = $request->validate([
            'username' => 'required|string|max:255',
            'password' => 'required|string',
        ]);
        $username = $request->input('username');
        $password = $request->input('password');

        $userInDb = DB::select('SELECT * FROM dbo.fn_get_login_information (?)', [$username]);
        if (empty($userInDb) || !Hash::check($password, $userInDb[0]->password)) {
            return redirect('/')->withErrors(['credentials' => 'Username or password is incorrect']);
        }

        $userId = $userInDb[0]->id;
        Auth::loginUsingId($userId);
        $request->session()->regenerate();
        return redirect('/');
    }

    public function register()
    {
        return view('auth.register');
    }

    public function handleRegister(Request $request)
    {
        $validator = $request->validate([
            'username' => 'required|string|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'email' => 'required|string|email|max:255|unique:users',
            'phone_number' => 'string|max:10',
            'address' => 'string|max:255',
        ]);

        DB::statement(
            'EXEC sp_create_user
            @username = ?,
            @password = ?,
            @email = ?,
            @phone_number = ?,
            @address = ?', [
            $request->input('username'),
            Hash::make($request->input('password')),
            $request->input('email'),
            $request->input('phone_number'),
            $request->input('address'),
        ]);

        $userInDb = DB::select('SELECT * FROM dbo.fn_get_login_information (?)', [$request->input('username')]);
        if (!empty($userInDb)) {
            Auth::loginUsingId($userInDb[0]->id);
            $request->session()->regenerate();
        }

        return redirect('/');
    }

    public function handleLogout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
