<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Kreator;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class trackVisitor
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        dd($request->all());
        // Kreator::increment('visitors_count');
        return $next($request);
    }
}
