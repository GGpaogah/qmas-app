<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Facades\Cache;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log; // Logging
use Illuminate\View\View;
use Illuminate\Validation\ValidationException;

class AuthenticatedSessionController extends Controller
{
    public function create(Request $request): View
    {
        // Ambil email yang diingat dari cache atau session
        $rememberedEmail = Cache::get('remember_me_email') ?? $request->session()->get('rememberedEmail');

        return view('auth.login', ['rememberedEmail' => $rememberedEmail]);
    }

    public function store(LoginRequest $request): RedirectResponse
    {
        try {
            Log::info('Proses autentikasi dimulai untuk email:', ['email' => $request->input('email')]);

            // Lakukan autentikasi
            $request->authenticate();
            $request->session()->regenerate();

            // Cek apakah Remember Me diaktifkan
            $remember = $request->has('remember');

            // Jika Remember Me dicentang, simpan email di cache dan autentikasi user dengan sesi yang panjang
            if ($remember) {
                Cache::put('remember_me_email', $request->input('email'), now()->addDays(30)); // Simpan selama 30 hari
                Auth::login($request->user(), true); // Ingat sesi user lebih lama
            } else {
                // Jika Remember Me tidak dicentang, hapus dari cache
                Cache::forget('remember_me_email');
            }

            // Simpan user ke dalam cache setelah login berhasil
            $user = $request->user();
            Cache::put('user_' . $user->id, $user, now()->addMinutes(30)); // Menyimpan data user ke dalam cache selama 30 menit

            // Redirect berdasarkan tipe user
            if ($user->usertype === 'superadmin') {
                return redirect()->route('superadmin.dashboard');
            } elseif ($user->usertype === 'admin') {
                return redirect()->route('admin.dashboard');
            } elseif ($user->usertype === 'user') {
                return redirect()->route('user.dashboard');
            }

            Log::warning('Tipe pengguna tidak dikenali:', ['email' => $request->input('email')]);
            return redirect()->route('login')->with('error', 'Tipe pengguna tidak dikenali.');
        } catch (ValidationException $e) {
            Log::error('Autentikasi gagal:', ['email' => $request->input('email'), 'errors' => $e->errors()]);
            return redirect()->route('login')->withErrors($e->errors())->withInput();
        }
    }

    public function destroy(Request $request): RedirectResponse
    {
        $userId = $request->user()->id;

        // Bersihkan cache yang terkait dengan user
        Cache::forget('user_' . $userId);

        Auth::guard('web')->logout();

        // Invalidate the session and regenerate token
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('login');
    }
}
