<?php

namespace App\Http\Requests\Auth;

use Illuminate\Auth\Events\Lockout;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Log; // Pastikan Log diimpor
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use App\Models\User; // Tambahkan ini untuk memeriksa apakah pengguna terdaftar

class LoginRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ];
    }

    public function authenticate(): void
    {
        $this->ensureIsNotRateLimited();

        // Logging input email sebelum mencoba login
        Log::info('Mencoba login dengan email:', ['email' => $this->input('email')]);

        // Pengecekan apakah email terdaftar di dalam database
        $user = User::where('email', $this->input('email'))->first();
        
        if (!$user) {
            // Jika email tidak ditemukan, lemparkan exception dengan pesan khusus
            throw ValidationException::withMessages([
                'email' => 'Akun kamu belum terdaftar. Silahkan daftar dahulu.',
            ]);
        }

        // Jika email ditemukan, coba autentikasi
        if (!Auth::attempt($this->only('email', 'password'), $this->boolean('remember'))) {
            RateLimiter::hit($this->throttleKey());

            // Logging ketika login gagal
            Log::warning('Login gagal untuk email:', ['email' => $this->input('email')]);

            throw ValidationException::withMessages([
                'email' => 'Email atau password yang Anda masukkan salah.',
            ]);
        }

        // Logging ketika login berhasil
        Log::info('Login berhasil untuk email:', ['email' => $this->input('email')]);

        RateLimiter::clear($this->throttleKey());
    }

    public function ensureIsNotRateLimited(): void
    {
        if (!RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        event(new Lockout($this));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            'email' => trans('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    public function throttleKey(): string
    {
        return Str::transliterate(Str::lower($this->input('email')).'|'.$this->ip());
    }
}
