<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        return redirect()->intended(RouteServiceProvider::HOME);
    }
    
    public function loginApi(Request $request)
    {
        if (Auth::attempt($request->only('email', 'password'))) {
            $user = auth()->user();
            $token = $user->createToken(Str::random(16))->plainTextToken;
            session(['api_token' => $token]);
            $data = [
                'message' => 'User fetched successfully',
                'data' => ["user" => $user, "api_token" => $token],
                'status' => 200
            ];

            return response()->json($data);
        }
        return response()->json(['message' => 'Bad Request', 'status' => 400]);
    }
    
    public function logoutApi(Request $request)
    {
        $request->user()->tokens()->delete();
        Session::flush();
        return response()->json(['message' => 'logout successfully', 'status' => 200]);
    }
    
    public function hello()
    {
        return response()->json(['message' => 'logout successfully', 'status' => 200]);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
