<?php

namespace App\Http\Controllers;

use App\Models\User;
// use Dotenv\Exception\ValidationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Validation\ValidationException as ValidationException;

class LoginController extends Controller
{
    public function index()
    {
        return view('login.index');
    }

    public function username()
    {
    $login = request()->input('username'); // Mengambil input dengan nama 'username' dari permintaan
    $field = is_numeric($login) ? 'nip' : 'username'; // Menentukan jenis input berdasarkan apakah numerik atau tidak

    // Menggabungkan input ke dalam permintaan dengan field yang sesuai
    request()->merge([$field => $login]);

    return $field; // Mengembalikan field yang akan digunakan untuk otentikasi
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials) || Auth::attempt([$this->username() => $credentials['username'], 'password' => $credentials['password']])) {
            $request->session()->regenerate();

            return redirect()->intended('/');
        }

        return back()->with('loginError', 'Login Failed!');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
