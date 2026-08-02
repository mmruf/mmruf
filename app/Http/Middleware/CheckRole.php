<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();

        // Mengecek apakah role user termasuk dalam list role yang diperbolehkan
        if (in_array($user->role, $roles)) {
            return $next($request);
        }

        // Jika guest mencoba akses halaman khusus admin
        abort(403, 'Anda tidak memiliki akses ke halaman ini.');
    }
}
