<?php

namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller {
    public function login(Request $request) {
        if ($request->method() === 'POST') {
            $success = auth()->attempt(
                $request->only(['email', 'password']),
                $request->boolean('remember')
            );
            if ($success) {
                return redirect()->route('dashboard');
            } else {
                return view('auth.login', [
                    'error' => 'Je inloggegevens kloppen niet.',
                    'email' => $request->get('email'),
                ]);
            }
        } else if (User::query()->doesntExist()) {
            return redirect()->route('initialize');
        } else {
            return view('auth.login');
        }
    }

    public function logout() {
        auth()->logout();
        return redirect()->route('dashboard');
    }

    public function initialize(Request $request) {
        if (User::query()->exists()) {
            return redirect()->route('login');
        } else if ($request->method() === 'POST') {
            User::create(array_merge(
                $request->only(['name', 'email', 'password']),
                ['role' => 'admin']
            ));
            auth()->attempt($request->only(['email', 'password']));
            return redirect()->route('dashboard');
        } else {
            return view('auth.initialize');
        }
    }
}
