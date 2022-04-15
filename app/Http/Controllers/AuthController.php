<?php

namespace App\Http\Controllers;

use App\Models\Guest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function indexRegister()
    {
        if (Auth::check()) {
            return redirect()->route('guest');
        }

        return view('/pages/register');
    }

    public function indexLogin()
    {
        if (Auth::check()) {
            return redirect()->route('guest');
        }

        return view('/pages/login');
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'username' => 'required|unique:users,username',
            'password' => 'required',
            'password_confirm' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('error', 'Pendaftaran akun telah gagal!');
        }

        if ($request->password == $request->password_confirm) {
            $user = User::create([
                "role" => "guest",
                "username" => $request->username,
                "password" => bcrypt($request->password)
            ]);

            Guest::create([
                "name" => $request->name,
                "user_id" => $user->id,
            ]);

            Auth::attempt($request->only('username', 'password'));

            if (Auth::check()) {
                return redirect()->route('guest')->with('success', 'Pendaftaran akun telah berhasil!');
            }
        } else {
            return redirect()->back()->with('error', 'Konfirmasi password salah');
        }
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required|string',
        ]);

        Auth::attempt($request->only('username', 'password'));

        if (Auth::check()) {
            return redirect()->route('guest')->with('success', 'Login telah berhasil!');
        }

        return redirect()->route('login')->with('error', 'Username atau Password salah!');
    }

    public function logout()
    {
        Auth::logout();

        return redirect()->route('login');
    }
}
