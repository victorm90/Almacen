<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function index()
    {
        return view("modules.auth.login");
    }

    public function logear(Request $request)
    {
        $credenciales = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return back()->withErrors(['email' => 'Credenciales incorrectas'])->withInput();
        }

        if (!$user->activo) {
            return back()->withErrors(['email' => 'Tu cuenta esta inactiva']);
        }

        Auth::login($user);
        $request->session()->regenerate();

        return to_route('home');
    }

    public function logout()
    {
        Auth::logout();
        return to_route('login');
    }

    public function crearAdmin()
    {
        User::create([
            'name' => 'Victor Manuel Henriquez',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin'),
            'activo' => true,
            'rol' => 'admin'
        ]);

        return "Admin creado con exito !!!";
    }
}