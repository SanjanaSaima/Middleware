<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;

class AuthController extends Controller
{
    public function signup()
    {
        return view('auth.signup');
    }

    public function signupStore(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => 'user', // Default role
        ]);

        return redirect()->route('login')->with('success', 'Account created successfully. Please login.');
    }

    public function login()
    {
        return view('auth.login');
    }

    public function loginStore(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        // 1. Check if email & password are correct (without logging in yet)
        if (Auth::validate($credentials)) {
            $user = User::where('email', $request->email)->first();

            // 2. Generate a 6-digit random OTP
            $otp = rand(100000, 999999);

            // 3. Save OTP and expiration time (5 minutes) in database
            $user->otp = $otp;
            $user->otp_expires_at = now()->addMinutes(5);
            $user->save();

            // 4. Store user ID in session so the OTP page knows who is logging in
            $request->session()->put('otp_user_id', $user->id);

            // 5. Redirect to OTP verification page
            return redirect()->route('otp')->with('success', 'OTP sent! (Your OTP: ' . $otp . ')');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    // Show the OTP form
    public function otp()
    {
        // If user hasn't entered credentials, redirect back to login
        if (!session()->has('otp_user_id')) {
            return redirect()->route('login');
        }

        return view('auth.otp');
    }

    // Verify the submitted OTP
    public function verifyOtp(Request $request)
    {
        $request->validate([
            'otp' => 'required',
        ]);

        $userId = session('otp_user_id');
        $user = User::find($userId);

        // 1. Check if user exists and OTP matches
        if (!$user || $user->otp !== $request->otp) {
            return back()->withErrors([
                'otp' => 'Invalid OTP code. Please try again.',
            ]);
        }

        // 2. Check if OTP has expired
        if ($user->otp_expires_at && now()->isAfter($user->otp_expires_at)) {
            return back()->withErrors([
                'otp' => 'This OTP has expired. Please login again.',
            ]);
        }

        // 3. Reset OTP fields in database
        $user->otp = null;
        $user->otp_expires_at = null;
        $user->save();

        // 4. Remove temporary session data
        $request->session()->forget('otp_user_id');

        // 5. Officially log the user in
        Auth::login($user);
        $request->session()->regenerate();

        // 6. Redirect based on user role
        if ($user->role === 'admin') {
            return redirect()->route('admin.index')->with('success', 'Logged in successfully.');
        }

        return redirect()->route('products.index')->with('success', 'Logged in successfully.');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Logged out successfully.');
    }
}
