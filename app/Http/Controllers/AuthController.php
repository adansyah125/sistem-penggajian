<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Notifications\SendResetLink;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;

class AuthController extends Controller
{
    public function index()
    {
        return view('page.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('dashboard');
        }

        Alert::toast('Email atau password salah', 'error');
        return back();
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        Alert::toast('Berhasil Logout', 'success');
        return redirect('/');
    }

    public function showForgotForm()
    {
        return view('page.forgot-password');
    }

    public function sendResetLink(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);

        $token = Str::random(64);

        DB::table('password_reset_tokens')->updateOrInsert(
            ['email' => $request->email],
            ['token' => $token, 'created_at' => now()]
        );

        $user = User::where('email', $request->email)->first();
        $user->notify(new SendResetLink($token));

        Alert::toast('Link reset password telah dikirim ke email Anda', 'success');
        return back();
    }

    public function showResetForm($token)
    {
        $email = request('email');
        return view('page.reset-password', compact('token', 'email'));
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email|exists:users,email',
            'password' => 'required|min:8|confirmed',
        ]);

        $record = DB::table('password_reset_tokens')
            ->where('email', $request->email)
            ->where('token', $request->token)
            ->first();

        if (!$record) {
            Alert::toast('Token reset password tidak valid', 'error');
            return back()->withInput();
        }

        if (now()->diffInMinutes($record->created_at) > 60) {
            DB::table('password_reset_tokens')->where('email', $request->email)->delete();
            Alert::toast('Token reset password telah kadaluwarsa', 'error');
            return redirect()->route('password.request');
        }

        User::where('email', $request->email)->update([
            'password' => Hash::make($request->password),
        ]);

        DB::table('password_reset_tokens')->where('email', $request->email)->delete();

        Alert::toast('Password berhasil direset. Silakan login.', 'success');
        return redirect()->route('login');
    }
}
