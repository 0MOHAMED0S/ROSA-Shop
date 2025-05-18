<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;
class googleAuthController extends Controller
{
    public function redirectToGoogle(): RedirectResponse
    {
        return Socialite::driver('google')->redirect();
    }
    public function handleGoogleCallback(): RedirectResponse
    {
        try {
            $googleUser = Socialite::driver('google')->user();
            // Check if user already exists
            $existingUser = User::where('google_id', $googleUser->id)
                                ->orWhere('email', $googleUser->email)
                                ->first();
            if ($existingUser) {
                Auth::login($existingUser);
            } else {
                // Create a new user
                $newUser = User::create([
                    'name' => $googleUser->name,
                    'email' => $googleUser->email,
                    'email_verified_at'=>now(),
                    'google_id' => $googleUser->id,
                    'password' => bcrypt(uniqid()), // Generate a random password
                    'status' => 0,
                ]);
                Auth::login($newUser);
            }
            // Redirect to intended URL or fallback to home
            return redirect()->intended(route('Home'));
        } catch (\Exception $e) {
            return redirect()->route('Home')->with('error', 'Authentication Failed');
        }
    }

public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('Home')->with('status', 'You have been logged out successfully.');
    }
}
