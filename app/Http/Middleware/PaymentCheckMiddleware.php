<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\Payment;

class PaymentCheckMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(Auth::user()->type == 'user')
        {
            if(!Payment::where('user_id', Auth::user()->id)->first())
            {
                return redirect()->route('user.payment');
            }
        }
        return $next($request);
    }
}
