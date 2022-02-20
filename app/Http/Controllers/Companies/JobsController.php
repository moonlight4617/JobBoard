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
        // dd($request);
        $request->validate([
            'job_name' => ['required', 'string', 'max:255'],
            'detail' => ['required', 'string'],
            'conditions' => ['nullable', 'string', 'max:255'],
            'duty_hours' => ['nullable', 'string', 'max:255'],
            'low_salary' => ['nullable', 'integer'],
            'high_salary' => ['nullable', 'integer'],
            'holiday' => ['nullable', 'string', 'max:255'],
            'benefits' => ['nullable', 'string', 'max:255']
        ]);

        if ($request->imgpath1) {
            $filename1 = $request->imgpath1->getClientOriginalName();
            $request->imgpath1->storeAs('public/jobs', $filename1, 'public');
        }
        if ($request->imgpath2) {
            $filename2 = $request->imgpath2->getClientOriginalName();
            $request->imgpath2->storeAs('public/jobs', $filename2, 'public');
        }
        if ($request->imgpath3) {
            $filename3 = $request->imgpath3->getClientOriginalName();
            $request->imgpath3->storeAs('public/jobs', $filename3, 'public');
        }

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
            'image1' => $filename1,
            'image2' => $filename2,
            'image3' => $filename3,
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

        $request->validate([
            'job_name' => ['required', 'string', 'max:255'],
            'detail' => ['required', 'string'],
            'conditions' => ['nullable', 'string', 'max:255'],
            'duty_hours' => ['nullable', 'string', 'max:255'],
            'low_salary' => ['nullable', 'integer'],
            'high_salary' => ['nullable', 'integer'],
            'holiday' => ['nullable', 'string', 'max:255'],
            'benefits' => ['nullable', 'string', 'max:255']
        ]);

        $job = Jobs::findOrFail($id);
        $job->job_name = $request->job_name;
        $job->detail = $request->detail;
        $job->conditions = $request->conditions;
        $job->duty_hours = $request->duty_hours;
        $job->low_salary = $request->low_salary;
        $job->high_salary = $request->high_salary;
        $job->holiday = $request->holiday;
        $job->benefits = $request->benefits;

        $job->save();

        return redirect()->route('company.jobs.show', compact('job'))->with(['message' => '求人更新しました。', 'status' => 'info']);
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
        Jobs::findOrFail($id)->delete();
        return redirect()->route('company.jobs.index')->with(['message' => '求人を削除しました。', 'status' => 'alert']);
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
