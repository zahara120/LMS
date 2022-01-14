<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Test;
use App\Models\QuestionOption;
use App\Models\Question;

class AnswerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($test_id)
    {
        $test = Test::find($test_id);
        $questionoption = QuestionOption::all();
        $question = Question::all();
        $correct = QuestionOption::where('test_id', $test_id)->where('correct', '=', 1)->count();
        // $correct = QuestionOption::select('question_id')->where('test_id', $test_id)->where('correct', '=', 1)->get();
        
        // $question_id = '';
        // foreach($correct as $item){
        //     $question_id .= $item.','; //1,3,
        // }
        // $arrQuestion = explode(',',$question_id);//{1, 3}
        // dd($question_id);    
        return view('setting.createAnswer',compact('question','questionoption','test','correct'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $test_id)
    {
        $request->validate([
            'option_text' => 'required'
        ],
        [
            'option_text.required' => 'Answer Option is required'
        ]);

        $request->request->add(['test_id' => $test_id]);
        QuestionOption::create($request->all());
        return back()->with('success','success input question option');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, $test_id)
    {
        $answer = QuestionOption::findorfail($id);
        return view ('setting.editAnswer',compact('answer', 'test_id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, $test)
    {
        $answer = QuestionOption::findorfail($id);
        if(!$request->correct){
            $request->request->add(['correct' => 0]);
        }
        $answer->update($request->all());
        // dd($request);
        return redirect()->route('answer.create', ['id' => $test]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $answer = QuestionOption::find($id);
        $answer->delete();
        return back();
    }
}
