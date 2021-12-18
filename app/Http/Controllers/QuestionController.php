<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Test;
use App\Models\Question;
use App\Models\QuestionOption;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($test_id)
    {
        $test = Test::find($test_id);
        $question = Question::all();
        $answer = QuestionOption::all();
        return view('setting.createQuestion',compact('question','test','answer'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $test_id)
    {
        // dd($request);
        $request->validate([
            'question' => 'required'
        ],
        [
            'question.required' => 'Question is required',
        ]);
        $request->request->add(['test_id' => $test_id]);
        Question::create($request->all());
        return back()->with('succes','succes add data');

    }

    /**
     * Display the specified resource.
     * @param  int  $id
     *
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
    public function edit($id)
    {
         $question = Question::findorfail($id);
        return view ('setting.editQuestion',compact('question'));
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
         $question = Question::findorfail($id);
        $question->update($request->all());
        return back()->with('succes','succes edit data');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $question = Question::find($id);
        $question->delete();
        return back()->with('succes','succes delete data');
    }
}
