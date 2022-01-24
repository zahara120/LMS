<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lesson;
use App\Models\Forum;
use App\Models\SubcategoryTraining;
use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Like;
use Illuminate\Support\Facades\Auth;

class ForumController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function test()
    {
        $subcategory = SubcategoryTraining::all();
        return view ('TestAuto',compact('subcategory'));
    }

    public function index()
    {
        $subcategory = SubcategoryTraining::all();
        $forum = Forum::orderBy('created_at','desc')->paginate(10);
        return view ('forum',compact('forum','subcategory'));
    }

    public function autocomplete(Request $request)
    {
        $datas = SubcategoryTraining::select('nameSubcategory')->where('nameSubcategory', 'LIKE', "%{$request->input('query')}%")->get();
        $dataModified = array();
        foreach ($datas as $data)
        {
            $dataModified[] = $data->nameSubcategory;
        }

        return response()->json($dataModified);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
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
            'titleForum' => 'required',
            'subcategory_trainings_id' => 'required',
            'content' => 'required'
        ],
        [
            'titleForum.required' => 'Title Forum is required',
            'subcategory_trainings_id.required' => 'Subcategory Training is required',
            'content.required' => 'Content  is required'
        ]);
        // dd($request);
        $subcategory_id = SubcategoryTraining::where('nameSubcategory', $request->subcategory_trainings_id)->value('id');
        // dd($subcategory_id);
        $request->request->add(['user_id' => auth()->user()->id]);
        $request->request->add(['subcategory_trainings_id' => $subcategory_id]);
        Forum::create($request->all());
        return redirect()->back()->with('success','succes add forum');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $forum = Forum::find($id);
        $count = Like::where('forum_id', $id)->count();
        // dd($count);
        return view('viewforum',compact('forum', 'count'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($forum_id)
    {
        Forum::find($forum_id)->delete(); 

        return redirect('/forum');
    }

    public function toggle($forum_id)
    {
        $forum = Forum::findOrFail($forum_id);
        $attr = ['user_id' => Auth::user()->id];
        
        if($forum->likes()->where($attr)->exists()){
            $forum->likes()->where($attr)->delete();
            $msg = ['status' => 'Unlike'];
        }
        else{
            $forum->likes()->create($attr);
            $msg = ['status' => 'Like'];

        }
        return response()->json($msg);
    }

}
