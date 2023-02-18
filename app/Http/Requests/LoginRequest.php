<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Auth\Events\Lockout;
use Illuminate\Support\Str;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\ValidationException;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'email' => 'required|email',
            'password' => 'required',
        ];
    }

    public function authenticate() : void
    {
        $this->checkRateLimit();

        if(!$this->attempt()) {
            RateLimiter::hit($this->throttleKey());

            throw ValidationException::withMessages([
                'password' => trans('auth.password'),
            ]);
        }

        RateLimiter::clear($this->throttleKey());
    }

    /**
     * Check if the user can be authenticated.
     * 
     * @throws \Illuminate\Validation\ValidationException
     */
    private function attempt(string $guard = null) : bool
    {
        $user = User::query()
            ->where('email', $this->input('email'))
            ->first(['id','email']);

        if(is_null($user)) {
            throw ValidationException::withMessages([
                'email' => trans('auth.failed'),
            ]);
        }

        return Auth::guard($guard)->attempt(
            credentials: $this->validated(),
            remember: $this->boolean('remember'),
        );
    }

    /**
     * Check if the request is rate limiting.
     * 
     * @throws \Illuminate\Validation\ValidationException
     */
    private function checkRateLimit() : void
    {
        if(RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            event(new Lockout($this));

            $seconds = RateLimiter::availableIn($this->throttleKey());

            throw ValidationException::withMessages([
                'email' => trans('auth.throttle', ['seconds' => $seconds]),
            ]);
        }
    }

    /**
     * Get the rate limiting throttle key.
     */
    private function throttleKey() : string
    {
        return Str::transliterate(
            string: $this->ip().':'.Str::lower($this->input('email'))
        );
    }
}
