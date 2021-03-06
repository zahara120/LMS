<?php

namespace App\Http\Controllers;

use App\Models\CategoryTraining;
use App\Models\SubcategoryTraining;
use App\Models\Lesson;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

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
        $validator = \Validator::make($request->all(),[
            // 'file'=> 'mimetypes:video/avi,video/mpeg,video/quicktime',
            // 'file' => 'required|mimes:jpg,png,mp4,ogx,oga,ogv,ogg,webm',
            'nameLesson' => 'required',
            'category_trainings_id' => 'required',
            'subcategory_trainings_id' => 'required',
            'url' => 'required'
        ],
        [
            'file.required' => 'Video is required',
            'nameLesson.required' => 'Name Lesson is required',
            'category_trainings_id.required' => 'Category Training is required',
            'subcategory_trainings_id.required' => 'Subcategory Training is required',
            'url.required' => 'Link Zoom is required'
        ]);
        // dd($request);
        if ($validator->fails())
        {
            return response()->json(['errors'=>$validator->errors()->all()]);
        }

        $lesson = new Lesson();
        $lesson->category_trainings_id = $request->category_trainings_id;
        $lesson->subcategory_trainings_id = $request->subcategory_trainings_id;
        $lesson->nameLesson = $request->nameLesson;
        $lesson->url = $request->url;
        $lesson->description = $request->description;

        //upload video
        if($request->hasFile('file')){
            $file = $request->file;
                    
            $filename = time().'.'.$file->getClientOriginalExtension();
        
            $request->file->move('videos',$filename);
        
            $lesson->file = $filename;
        }
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
        $lesson = Lesson::findorfail($id);
        $category = CategoryTraining::all();
        $subcategory =SubcategoryTraining::all();
        return view ('setting.editLesson',compact('lesson','subcategory','category'));
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
        $lesson = Lesson::findorfail($id);
        $lesson->update($request->all());
        return redirect('/lesson')->with('success','success edit data');
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

    public function lessonExport()
    {
        return Excel::download(new LessonExport,'Lesson.xlsx');
    }
}