<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tag;

class TagsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $tags = Tag::select('id', 'tag_name', 'subject');
        $userTags = Tag::where('subject', 0)->get();
        $jobTags = Tag::where('subject', 1)->get();
        return view('admin.tags.index', compact('userTags', 'jobTags'));
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
            'tag_name' => ['required', 'string', 'not_regex:/^(\s|　)|(\s|　)$/'],
            'subject' => ['required', 'integer'],
        ]);
        Tag::create([
            'tag_name' => $request->tag_name,
            'subject' => $request->subject
        ]);

        return redirect()->route('admin.tags.index')->with(['message' => 'タグを新規登録しました。', 'status' => 'info']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        if ($request->tags) {
            foreach ($request->tags as $tag) {
                $tag = Tag::findOrFail($tag)->delete();
            }
            return redirect()->route('admin.tags.index')->with(['message' => 'タグを削除しました。', 'status' => 'info']);
        } else {
            return back()->with(['message' => '削除するタグを選択してください', 'status' => 'alert']);
        };
    }
}
