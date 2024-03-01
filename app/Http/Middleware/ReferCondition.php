<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\GeneralSetting;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ReferCondition
{
    public function handle(Request $request, Closure $next)
    {
        $general = GeneralSetting::first();
        // return redirect()->route('activate');

        $user = Auth::user();

        if ($user->activeRefferals->count() < $general->refer_need) {
            $notify[] = ['warning', "You need to reffer total $general->refer_need active user"];
            return back()->withNotify($notify);
        }

        return $next($request);
    }
}
