<?php

namespace App\Http\Controllers\Companies;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Jobs;
use Illuminate\Support\Facades\Auth;

class JobsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:companies');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jobs = Jobs::where('companies_id', Auth::id())->get();
        return view('company.job.index', compact('jobs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('company.job.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'job_name' => ['required', 'string', 'max:255'],
            'detail' => ['required', 'string'],
            'conditions' => ['string', 'max:255'],
            'duty_hours' => ['string', 'max:255'],
            'low_salary' => ['integer'],
            'high_salary' => ['integer'],
            'holiday' => ['string', 'max:255'],
            'benefits' => ['string', 'max:255']
        ]);

        Jobs::create([
            'companies_id' => Auth::id(),
            'job_name' => $request->job_name,
            'detail' => $request->detail,
            'conditions' => $request->conditions,
            'duty_hours' => $request->duty_hours,
            'low_salary' => $request->low_salary,
            'high_salary' => $request->high_salary,
            'holiday' => $request->holiday,
            'benefits' => $request->benefits,
        ]);


        return redirect()->route('company.jobs.index')->with(['message' => '求人登録しました。', 'status' => 'info']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $this->correctCompany();
        $job = Jobs::findOrFail($id);
        return view('company.job.show', compact('job'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->correctCompany();
        $job = Jobs::findOrFail($id);
        return view('company.job.edit', compact('job'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->correctCompany();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->correctCompany();
    }

    // 企業が登録した求人一覧以外は編集できないようにする
    private function correctCompany()
    {
        $this->middleware(function ($request, $next) {
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
        });
    }
}
