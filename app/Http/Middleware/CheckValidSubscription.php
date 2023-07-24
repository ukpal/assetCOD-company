<?php

namespace App\Http\Middleware;

use Closure;
use DateTime;
use DateTimeZone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CheckValidSubscription
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $s_date = DB::table('subscriptions')->first();

        $today = new DateTime("now", new DateTimeZone('America/New_York'));
        $today = $today->format('Y-m-d H:i:s');

        if (strtotime($today) > strtotime($s_date->tenure_to)) {
            Session::flush();
            // Auth::logout();
            return Redirect()->route('admin.login')->with('error', 'Your subscription has ended');
        }
        return $next($request);
    }
}
