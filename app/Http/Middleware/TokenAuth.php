<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TokenAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $token = $request->header('app-key');
        if (! $token) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }
        if (strlen($token) < 8) {
            return response()->json(['message' => 'Token must be longer than 8 characters'], 422);
        }
        $user = User::where('token', $token)->first();

        if (! $user) {
            $user = User::create([
                'token' => $token,
            ]);
        }
        auth()->login($user);

        return $next($request);
    }
}
