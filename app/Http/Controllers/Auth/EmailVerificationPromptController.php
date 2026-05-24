<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class EmailVerificationPromptController extends Controller
{
    /**
     * Display the email verification prompt.
     */
    public function __invoke(Request $request): RedirectResponse|View
    {
        $redirectTo = $request->user()->isAdmin()
            ? route('dashboard', absolute: false)
            : route('customer.profile', absolute: false);

        return $request->user()->hasVerifiedEmail()
                    ? redirect()->intended($redirectTo)
                    : view('auth.verify-email');
    }
}
