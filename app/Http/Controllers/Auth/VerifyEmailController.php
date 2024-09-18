<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\RedirectResponse;

class VerifyEmailController extends Controller
{
    /**
     * Mark the authenticated user's email address as verified.
     */
    public function __invoke(EmailVerificationRequest $request): RedirectResponse
    {
        if ($request->user()->hasVerifiedEmail()) {
            // Redirect based on usertype
            return $this->redirectBasedOnUserType($request->user()->usertype);
        }

        if ($request->user()->markEmailAsVerified()) {
            event(new Verified($request->user()));
        }

        // Same redirection logic after email is verified
        return $this->redirectBasedOnUserType($request->user()->usertype);
    }

    /**
     * Handle redirection based on user type
     */
    private function redirectBasedOnUserType(string $usertype): RedirectResponse
    {
        if ($usertype === 'superadmin') {
            return redirect()->route('superadmin.dashboard');
        } elseif ($usertype === 'admin') {
            return redirect()->route('admin.dashboard');
        } elseif ($usertype === 'user') {
            return redirect()->route('user.dashboard');
        } else {
            return redirect()->route('login');
        }
    }
}
