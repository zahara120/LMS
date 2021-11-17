<?php

namespace App\Http\Controllers;

use App\Models\CategoryTraining;
use App\Models\Lesson;
use Illuminate\Http\Request;

class LessonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lesson = Lesson::all();
        $category = CategoryTraining::all();
        return view('setting.indexLesson',compact('lesson','category'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            // 'file'=> 'mimetypes:video/avi,video/mpeg,video/quicktime',
            'file' => 'required|mimes:mp4,ogx,oga,ogv,ogg,webm',
        ]);

        $lesson = new Lesson();
        $lesson->category_id = $request->category_id;
        $lesson->subcategory_id = $request->subcategory_id;
        $lesson->nameLesson = $request->nameLesson;
        $lesson->url = $request->url;
        $lesson->description = $request->description;
        //upload video
        $file=$request->file;
		        
        $filename=time().'.'.$file->getClientOriginalExtension();
    
        $request->file->move('videos',$filename);
    
        $lesson->file=$filename;
        // if($request->hasFile('video')){
        //     $video_tmp = $request->file('video');
        //     //$video_tmp = Input::file('video');
        //     //mendapatkan nama file
        //     $video_name = $video_tmp->getClientOriginalName();
        //     //proses upload 
        //     $video_path = 'videos/';
        //     $video_tmp->move($video_path,$video_name);
        //     //$product->image=$fileName;
        // }

        $lesson->save();
        
        return redirect('/lesson')->with('succes','succes add data');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $lesson = Lesson::find($id);
        return view('setting.viewLesson', compact('lesson'));
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
    public function destroy($id)
    {
        $lesson = Lesson::find($id);
        $lesson->delete();
        return redirect('/lesson')->with('succes','succes delete data');
    }
}