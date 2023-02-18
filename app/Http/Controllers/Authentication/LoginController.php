<?php

namespace App\Http\Controllers\Authentication;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

class LoginController extends Controller
{
    /**
     * Render the application's login page.
     */
    public function create() : Response
    {
        return Inertia::render('Authentication/Login');
    }

    /**
     * Start a new authenticated session.
     */
    public function store(LoginRequest $request) : RedirectResponse
    {
        $request->authenticate();
        $request->session()->regenerate();

        return redirect()->intended();
    }
}
