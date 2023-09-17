<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Exception;
use Symfony\Component\HttpFoundation\Response;

class HandleExceptions
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        try {
            return $next($request);
        } catch (Exception $exception) {
            return redirect()->back()->with([
                'message' => $exception->getMessage(),
                'alert-type' => 'error',
            ]);
        }
    }
}