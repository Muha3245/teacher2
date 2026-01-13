<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function LoginPage()
    {
        return view('pages.auth.loginpage');
    }
    public function GoogleLogin()
    {
        return Socialite::driver('google')
            ->stateless()
            ->redirect();
    }

    public function GoogleAuth()
    {
        try {
            $googleUser = Socialite::driver('google')
                ->stateless()
                ->user();

            $user = User::where('google_id', $googleUser->id)->first();

            if ($user) {
                Auth::login($user);
                return redirect()->route('welcome');
            }

            $user = User::create([
                'name' => $googleUser->name,
                'email' => $googleUser->email,
                'google_id' => $googleUser->id,
                'password' => Hash::make(uniqid()), // better than 123456
                'profile_picture' => $googleUser->avatar,
                'is_blocked' => false,
                'person' => 'student',
            ]);

            Auth::login($user);
            return redirect()->route('welcome');

        } catch (\Exception $e) {
            return redirect()->route('login')->with('error', $e->getMessage());
        }
    }

    public function Register(request $request)
    {
        // dd($request->all());
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'profile_picture' => 'null',
            'person' => 'required',
        ]);
        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => $request->input('password'),
            'profile_picture' => $request->input('profile_picture') ?? null,
            'is_blocked' => false,
            'person' => $request->input('person'),
        ]);

        Auth::login($user);
        return redirect()->route('welcome');
    }
    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            Auth::login($user);
            return redirect()->route('welcome');
        }

        return back()->withErrors([
            'email' => 'Invalid email or password',
        ]);
    }

    public function Logout()
    {
        Auth::logout();
        return redirect()->route('loginpage');
    }

    


}
