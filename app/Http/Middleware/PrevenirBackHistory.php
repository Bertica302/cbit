<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PrevenirBackHistory
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        return $response->header('Cache-Contro', 'nocacha, no-store, mas-age=0, must-revalidate')
                        ->header('Pragma', 'no-store')
                        ->header('Expires', 'Fri, 01 Jan 1990 00:00:00 GMT' );
    }
}
