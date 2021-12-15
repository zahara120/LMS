<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\Training;
use App\Models\Test;
use App\Models\TestResult;
use App\Models\TestResultAnswer;
use App\Models\QuestionOption;
use Illuminate\Http\Request;

class TestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $questions = Question::inRandomOrder()->limit(10)->get();
        // foreach ($questions as &$question) {
        //     $question->options = QuestionOption::where('question_id', $question->id)->inRandomOrder()->get();
        // }
        // return view('tests', compact('questions'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function test($training_id)
    {
        $training = Training::find($training_id);
        $questions = Question::inRandomOrder()->limit(10)->get();
        //$test = Test::all();
        foreach ($questions as &$question) {
            $question->options = QuestionOption::where('question_id', $question->id)->inRandomOrder()->get();
        }

        $total_test = NULL;

        $pretest_result = NULL;
        $posttest_result = NULL;
        if ($training->posttest) {
            $posttest_result = TestResult::where('test_id', $training->posttest->id)
                ->where('user_id', \Auth::id())
                ->first();
                //dd($test_result);
        }if($training->pretest){
            $pretest_result = TestResult::where('test_id', $training->pretest->id)
                ->where('user_id', \Auth::id())
                ->first();
        }
        // dd($test_result);
        //$duration = DB::select("select * ");
        return view('layout.nav', compact('questions','training','pretest_result','posttest_result'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $test_id)
    {

        $answers = [];
        //dd($request);
        $test_score = 0;
        foreach ($request->get('answers') as $question_id => $answer_id) {
            $question = Question::find($question_id);
            //dd($answer_id);
            $correct = QuestionOption::where('question_id', $question_id)
                ->where('id', $answer_id)
                ->where('correct', 1)->count() > 0;
            //     dd($answer_id);
            $correct = QuestionOption::where('question_id', $question_id)->where('id', $answer_id)->where('correct', 1)->count();
            $answers[] = [
                'question_id' => $question_id,
                'option_id' => $answer_id,
                'correct' => $correct
            ];
            if ($correct) {
                $test_score += $question->score;
            }
            /*
             * Save the answer
             * Check if it is correct and then add points
             * Save all test result and show the points
             */
        }
        //dd($answers);
        $request->request->add(['test_id' => $test_id]);
        $test_result = TestResult::create([
            'test_id' => $test_id,
            'user_id' => \Auth::id(),
            'score' => $test_score
        ]);

        $test_result_id = $test_result->id;
        
        foreach ($request->get('answers') as $question_id => $answer_id) {
        TestResultAnswer::create([
            'question_id' => $question_id,
            'option_id' => $answer_id,
            'correct' => $correct,
            //'correct' => $score,
            'test_result_id' => $test_result_id
        ]);
        }
      
        return back()->with('succes','success');
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
        //
    }
}