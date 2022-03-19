<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Jobs;
use Illuminate\Support\Facades\Auth;

class EnsureJobsCompany
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
        $id = $request->route()->parameter('job'); //jobのid取得
        if (!is_null($id)) {
            $jobCompanyId = Jobs::findOrFail($id)->companies->id;
            $jobId = (int)$jobCompanyId; // キャスト 文字列→数値に型変換
            $companyId = Auth::id();
            if ($jobId !== $companyId) {
                abort(404); // 404画面表示 }
            }

            return $next($request);
        }
    }
}
