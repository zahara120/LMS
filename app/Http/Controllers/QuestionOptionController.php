<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Answer;
use App\Models\Survey;
use App\Models\Questionnaire;

class QuestionOptionController extends Controller
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
    public function create($survey_id)
    {
        $survey = Survey::find($survey_id);
        $answer = Answer::all();
        $questionnaire = Questionnaire::all();
        return view('setting.createQuestionOption',compact('questionnaire','answer','survey'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $survey_id)
    {
        $request->request->add(['survey_id' => $survey_id]);
        Answer::create($request->all());
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
    public function edit($id)
    {
        $questionoption = Answer::findorfail($id);
        return view ('setting.editQuestionOption',compact('questionoption'));
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
        $questionoption = Answer::findorfail($id);
        $questionoption->update($request->all());
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
        $questionoption = Answer::find($id);
        $questionoption->delete();
        //return redirect('/answer')->with('succes','succes delete data');
        return back();
    }
}
