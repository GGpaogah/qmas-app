<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class EmailVerificationNotificationController extends Controller
{
    /**
     * Send a new email verification notification.
     */
    public function store(Request $request): RedirectResponse
    {
        if ($request->user()->hasVerifiedEmail()) {

            
            {
                if ($request->user()->hasVerifiedEmail()) {
                    // Redirect based on usertype
                    if ($request->user()->usertype === 'superadmin') {
                        return redirect()->route('superadmin.dashboard');
                    } elseif ($request->user()->usertype === 'admin') {
                        return redirect()->route('admin.dashboard');
                    } elseif ($request->user()->usertype === 'user') {
                        return redirect()->route('user.dashboard');
                    } else {
                        return redirect()->route('login');
                    }
                }
        
            }
        }

        $request->user()->sendEmailVerificationNotification();

        return back()->with('status', 'verification-link-sent');
    }
}
