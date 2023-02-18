<?php

namespace App\Http\Controllers\Authentication;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;
use Inertia\Response;

class ForgotPasswordController extends Controller
{
    /**
     * Render the application's password reset request page.
     */
    public function create() : Response
    {
        return Inertia::render('Authentication/ForgotPassword');
    }

    /**
     * Send the password reset request to the user.
     * 
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request) : RedirectResponse
    {
        $email = $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink($email);

        if($status === Password::RESET_LINK_SENT) {
            return back()->with(['success' => trans($status)]);
        }

        throw ValidationException::withMessages([
            'email' => trans($status),
        ]);
    }
}
