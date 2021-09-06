<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EnsureTokenIsValid
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if ($request->input('secret') !== 'LtUJ2WG3SymTpAe2WPdDGyiVubzv6BIuh6j4OKG6As') {
            return redirect('error');
        }

        return $next($request);
    }
}
