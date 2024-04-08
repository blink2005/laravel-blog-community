<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function create()
    {
        return view('register.register');
    }

    public function store(Request $request)
    {
        if($this->validateForm($request))
        {
            $user = $this->createUser($request);
            $this->authUser($user);
            return redirect()->route('welcome');
        }
        else
        {
            return view('register.passwords_error');
        }
    }

    public function validateForm($request)
    {
        $request->validate([
            'username' => ['required', 'regex:/^[A-Za-z][A-Za-z0-9]*$/', 'max:16', 'unique:App\Models\User,username'],
            'password' => ['required', 'max:32'],
            'retry_password' => ['required', 'max:32'],
        ]);

        if ($request->password === $request->retry_password)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function createUser($request)
    {
        $user = User::create([
            'username' => $request->username,
            'password' => $request->password,
            'is_admin' => 0,
        ]);

        return $user;
    }

    public function authUser($user)
    {
        event(new Registered($user));
        Auth::login($user);
    }
}
