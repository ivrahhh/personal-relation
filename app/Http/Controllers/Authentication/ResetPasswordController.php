<?php

namespace App\Http\Controllers\Authentication;

use App\Http\Controllers\Controller;
use App\Http\Requests\ResetPasswordRequest;
use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;
use Inertia\Response;

class ResetPasswordController extends Controller
{
    /**
     * Render the reset password application.
     */
    public function create(Request $request) : Response
    {
        return Inertia::render('Authentication/ResetPassword', [
            'email' => $request->query('email'),
            'token' => $request->token, 
        ]);
    }

    /**
     * Reset the user's password
     * 
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(ResetPasswordRequest $request) : RedirectResponse
    {
        $status = Password::reset(
            credentials: $request->validated(),
            callback: function (User $user, string $password) {
                $user->forceFill([
                    'password' => Hash::make($password),
                    'remember_token' => Str::random(60),
                ]);

                $user->save();

                event(new PasswordReset($user));
            }
        );

        if($status === Password::PASSWORD_RESET) {
            return to_route('login')->with([
                'success' => trans($status),
            ]);
        }

        throw ValidationException::withMessages([
            'email' => trans($status),
        ]);

    }
}
