<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')
            ->stateless()
            ->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $user = Socialite::driver('google')
                ->stateless()
                ->user();

            $finduser = User::where('google_id', $user->id)
                ->first();

            if ($finduser) {
                Auth::login($finduser);

                return redirect()->intended('/');
            } else {
                $newUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'google_id' => $user->id,
                    'password' => encrypt('eoptionpasswd')
                ]);

                Auth::login($newUser);

                return redirect()->intended('/');
            }
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }

    public function login(Request $request)
    {
        if ($request->post()) {
            $credentials = $request->validate([
                'email' => ['required'],
                'password' => ['required'],
            ]);

            if (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'is_admin' => 1])) {
                $request->session()
                    ->regenerate();

                return redirect()->intended('admin');
            } elseif (Auth::attempt($credentials)) {
                $request->session()
                    ->regenerate();

                return redirect(url('/trade'));
            }

            return back()
                ->withErrors([
                    'email' => 'The provided credentials do not match our record.',
                ])
                ->onlyInput('email');
        }

//        return view('auth.login');
        return view('user-site.login');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()
            ->invalidate();

        $request->session()
            ->regenerateToken();

        return redirect('login');
    }

    public function register(Request $request)
    {
        if ($request->post()) {
            $validator = Validator::make($request->all(), [
                'name' => 'required | max:50',
                'email' => 'required | email | max:200 | unique:users',
                'password' => 'required | min:8'
            ]);

            if ($validator->fails()) {
                return back()->withErrors($validator);
            }
            try {
                $newUser = new User();
                $newUser->email = preg_replace('/\s+/', '', strtolower($request->email));
                $newUser->password = password_hash($request->password, PASSWORD_DEFAULT);
                $newUser->name = $request->name;
                $newUser->country = $request->country;
                $newUser->save();
            } catch (\Exception $e) {
                return redirect('register');
            }

            if ($newUser) {
                if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
                    $request->session()
                        ->regenerate();

                    return redirect(url('/trade'));
                }
            }
        }

        return view('user-site.register');
    }

    public function forgot()
    {
        return view('user-site.forgot');
    }

    public function reset()
    {
        return view('user-site.reset');
    }
}
