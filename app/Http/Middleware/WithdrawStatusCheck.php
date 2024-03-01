<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\GeneralSetting;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class WithdrawStatusCheck
{
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();

        if ($user->withdrawStatus != 1) {
            $notify[] = ['error', "Forbidden"];
            return back()->withNotify($notify);
        }

        return $next($request);
    }
}
