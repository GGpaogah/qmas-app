<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\Hash;

class ProfileAdminController extends Controller
{
    /**
     * Display the admin gudang's profile form.
     */
    public function edit(Request $request): View
    {
        // Menampilkan view admin profile
        return view('admin.akun.userprofile', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the admin gudang's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        // Mengisi data yang di-submit dari form profil
        $request->user()->fill($request->validated());

        // Jika email diubah, verifikasi ulang email
        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        // Menyimpan perubahan profil
        $request->user()->save();

        return Redirect::route('admin.profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Update the admin gudang's password.
     */
    public function updatePassword(Request $request): RedirectResponse
    {
        // Validasi password yang lama dan baru
        $request->validate([
            'current_password' => ['required', 'current_password'],
            'new_password' => ['required', 'min:8', 'confirmed'],
        ]);

        // Update password
        $user = $request->user();
        $user->password = Hash::make($request->new_password);
        $user->save();

        return Redirect::route('admin.profile.edit')->with('status', 'password-updated');
    }

    /**
     * Delete the admin gudang's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        // Validasi penghapusan akun
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        // Logout dan hapus akun
        Auth::logout();

        $user->delete();

        // Invalidate session setelah akun dihapus
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('login');
    }
}
