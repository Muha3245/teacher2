<?php

namespace App\Http\Controllers\Front;

use App\Models\User;
use App\Mail\verifyemail;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    /**
     * Display the login page.
     */
    public function LoginPage()
    {
        return view('pages.auth.loginpage');
    }

    /**
     * Redirect the user to the Google authentication page.
     */
    public function GoogleLogin()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Handle the callback from Google.
     */
    public function GoogleAuth()
    {
        try {
            $googleUser = Socialite::driver('google')->user();

            // Find user by email (safer than ID if they registered manually first)
            $user = User::where('email', $googleUser->email)->first();

            if (!$user) {
                // Create a new user if they don't exist
                $user = User::create([
                    'name'            => $googleUser->name,
                    'email'           => $googleUser->email,
                    'google_id'       => $googleUser->id,
                    'password'        => Hash::make(Str::random(16)), // Secure random password
                    'profile_picture' => $googleUser->avatar,
                    'is_blocked'      => false,
                    'person'          => 'student',
                ]);
            } else {
                // Update google_id if it's not already linked
                if (empty($user->google_id)) {
                    $user->update(['google_id' => $googleUser->id]);
                }
            }

            // Verification Logic
            $this->sendVerificationEmail($user);

            Auth::login($user);
            return redirect()->route('welcome');

        } catch (\Exception $e) {
            Log::error('Google Auth Error: ' . $e->getMessage());
            return redirect()->route('loginpage')->with('error', 'Authentication failed.');
        }
    }

    /**
     * Handle manual registration.
     */
    public function Register(Request $request)
    {
        $request->validate([
            'name'            => 'required|string|max:255',
            'email'           => 'required|email|unique:users,email',
            'password'        => 'required|string|min:6',
            'person'          => 'required',
            'profile_picture' => 'nullable',
        ]);

        $user = User::create([
            'name'            => $request->input('name'),
            'email'           => $request->input('email'),
            'password'        => Hash::make($request->input('password')), // Hashed for security
            'profile_picture' => $request->input('profile_picture'),
            'is_blocked'      => false,
            'person'          => $request->input('person'),
        ]);

        $this->sendVerificationEmail($user);

        Auth::login($user);
        return redirect()->route('welcome');
    }

    /**
     * Handle manual login.
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            
            $this->sendVerificationEmail($user);

            return redirect()->intended(route('welcome'));
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    /**
     * Helper function to handle email verification logic.
     */
    private function sendVerificationEmail($user)
    {
        if ($user->email_verified_at == null) {
            $verification_key = Str::random(64);
            $verificationLink = route('createprofile', ['key' => $verification_key]);

            try {
                Mail::to($user->email)->send(new verifyemail($user, $verificationLink));
                
                // IMPORTANT: In your current logic, you mark them verified immediately.
                // Usually, you should only do this inside the 'createprofile' controller method.
                $user->email_verified_at = now();
                $user->save();
            } catch (\Exception $e) {
                Log::error('Verification email failed: ' . $e->getMessage());
            }
        }
    }

    /**
     * Log the user out.
     */
    public function Logout()
    {
        Auth::logout();
        return redirect()->route('loginpage');
    }
}