<?php

namespace App\Http\Middleware;

use App\Http\Controllers\SubscriptionController;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class isSubscribedMiddleWare
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(!Auth::check()){
            return redirect()->route('login');
        }
        if(SubscriptionController::checkForSub(Auth::id())===null||\request()->isMethod('DELETE')){
            return $next($request);
        }
        return redirect()->back()->with('unauthorised');
    }
}
