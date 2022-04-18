<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Companies;
use Illuminate\Support\Facades\Auth;


class EnsureCompany
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
        $id = $request->route()->parameter('company');
        if (!is_null($id)) {
            $companyId = Companies::findOrFail($id)->id;
            if ($companyId !== Auth::id()) {
                abort(404); // 404画面表示 }
            }
            return $next($request);
        }
        return $next($request);
    }
}
