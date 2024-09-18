<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log; // Pastikan Log diimpor
use Illuminate\View\View;
use Illuminate\Validation\ValidationException; // Pastikan ValidationException diimpor

class AuthenticatedSessionController extends Controller
{
    public function create(): View
    {
        return view('auth.login');
    }

    public function store(LoginRequest $request): RedirectResponse
    {
        try {
            Log::info('Proses autentikasi dimulai untuk email:', ['email' => $request->input('email')]);

            $request->authenticate();
    
            $request->session()->regenerate();
    
            if ($request->user()->usertype === 'superadmin') {
                return redirect()->route('superadmin.dashboard');
            } elseif ($request->user()->usertype === 'admin') {
                return redirect()->route('admin.dashboard');
            } elseif ($request->user()->usertype === 'user') {
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
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('login');
    }
}
