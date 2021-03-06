<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Survey;
use App\Models\Questionnaire;

class QuestionnaireController extends Controller
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
        $questionnaire = Questionnaire::all();
        //$answer = QuestionOption::all();
        return view('setting.createQuestionnaire',compact('questionnaire','survey'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $survey_id)
    {
        $request->validate([
            'question' => 'required',
            'typeAnswer' => 'required'
        ],
        [
            'question.required' => 'Questionnaire is required',
            'typeAnswer.required' => 'Type Answer is required'
        ]);
        // $request->request->add(['test_id' => $survey_id]);
        // foreach ($request->question as $value) {
        //     Questionnaire::create([
        //         'question' => $value,
        //         'survey_id' => $request->survey_id
        //     ]);
        // }
        
        $request->request->add(['survey_id' => $survey_id]);
        Questionnaire::create($request->all());
        return back()->with('succes','succes add data');
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
    public function edit($id, $survey_id)
    {
        $questionnaire = Questionnaire::findorfail($id);
        return view ('setting.editQuestionnaire',compact('questionnaire','survey_id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, $survey_id)
    {
        $questionnaire = Questionnaire::findorfail($id);
        $questionnaire->update($request->all());
        return redirect()->route('questionnaire.create', ['id' => $survey_id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $questionnaire = Questionnaire::find($id);
        $questionnaire->delete();
        return back()->with('succes','succes delete data');
    }
}
