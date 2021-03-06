<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\Forum;
use App\Models\Training;
use App\Models\Test;
use App\Models\TestResult;
use App\Models\TestResultAnswer;
use App\Models\QuestionOption;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Sentinel;

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
        // //$duration = DB::select("select * ");
        // return view('tests', compact('questions'));

        // coba
        //return view('layout.nav');
        // $scoreposttest = DB::table('us')
        // ->join('contacts', 'users.id', '=', 'contacts.user_id')
        // ->join('orders', 'users.id', '=', 'orders.user_id')->get();
        $result = TestResult::all();
        return view('scoreRecord',compact('result'));

    }

    public function test($training_id)
    {
        $training = Training::find($training_id);
        // $questions = Question::inRandomOrder()->limit(10)->get();
        // //$test = Test::all();
        // foreach ($questions as &$question) {
        //     $question->options = QuestionOption::where('question_id', $question->id)->inRandomOrder()->get();
        // }
        
        //$forum = Forum::where('training_id',$training->id)->get();

        $total_test = NULL;

        $pretest_result = NULL;
        $posttest_result = NULL;
        if ($training->posttest) {
            $posttest_result = TestResult::where('training_id',$training->id)
                ->where('posttest_id', $training->posttest->id)
                ->where('user_id', \Auth::id())
                ->first();
                //dd($test_result);
        }if($training->pretest){
            $pretest_result = TestResult::where('training_id',$training->id)
                ->where('pretest_id', $training->pretest->id)
                ->where('user_id', \Auth::id())
                ->first();
        }
        $result = TestResult::where('training_id',$training->id)->where('user_id', Auth::user()->id)->first();

        return view('layout.nav', compact('training','pretest_result','posttest_result','result'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createpretest($training_id)
    {
        $training = Training::find($training_id);
        $questions = Question::inRandomOrder()->limit(10)->get();
        //$test = Test::all();
        foreach ($questions as &$question) {
            $question->options = QuestionOption::where('question_id', $question->id)->inRandomOrder()->get();
        }

        $total_test = NULL;

        $test_result = NULL;
        if ($training->pretest) {
            $pretest_result = TestResult::where('test_id', $training->pretest->id)
                ->where('user_id', \Auth::id())
                ->first();
                //dd($test_result);
        }
        // dd($test_result);
        //$duration = DB::select("select * ");
        //return view('layout.nav', compact('questions','training','test_result'));
        return view('pretests', compact('questions','training','pretest_result','posttest_result'));

    }

    public function createposttest($training_id)
    {
        $training = Training::find($training_id);
        $questions = Question::inRandomOrder()->limit(10)->get();
        //$test = Test::all();
        foreach ($questions as &$question) {
            $question->options = QuestionOption::where('question_id', $question->id)->inRandomOrder()->get();
        }

        $total_test = NULL;

        $test_result = NULL;
        if ($training->posttest) {
            $test_result = TestResult::where('test_id', $training->posttest->id)
                ->where('user_id', \Auth::id())
                ->first();
                //dd($test_result);
        }
        // dd($test_result);
        //$duration = DB::select("select * ");
        return view('posttests', compact('questions','training','test_result'));
        //return view('test');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $training_id)
    {
        $training = Training::where('id', $training_id)->firstOrFail();
        $answers = [];
        // dd($request);
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

        $test_id = Test::find($request->test_id);
        $result = TestResult::where('training_id',$training->id)->where('user_id', Auth::user()->id)->first();

        $request->request->add(['training_id' => $training_id]);
        // $request->request->add(['test_id' => $request->test_id]);
        $request->request->add(['user_id' => Auth::user()->id]);
        
        if($result){
            $result_id = $result->id;
            $insert = TestResult::find($result_id);
        }

        // dd($test_score);
        // dd($result->pretestScore);

        if($test_id->typeTest == 'PreTest'){ //di cek dia tipe test nya apa?
            // $request->request->add(['pretestScore' => $test_score]);
            if($result){ //kalo table result nya udah ada  
                if($result->posttestScore){ //kalo post test score nya udah ada, user dah ngerjain post test
                    //kalo post test score nya udah ada, di update
                    $insert->pretest_id = $request->test_id;
                    $insert->pretestScore = $test_score;
                    $insert->save();
                }
            }else{
                $request->request->add(['pretestScore' => $test_score]);
                $request->request->add(['pretest_id' => $request->test_id]);
            }
        }elseif($test_id->typeTest == 'PostTest'){
            if($result){
                if($result->pretestScore){
                    //kalo pre test score nya udah ada
                    //update post test score nya 
                    $insert->posttest_id = $request->test_id;
                    $insert->posttestScore = $test_score;
                    $insert->save();
                }
            }else{
                $request->request->add(['posttestScore' => $test_score]);
                $request->request->add(['posttest_id' => $request->test_id]);
            }
        }
        if(!$result){
            TestResult::create($request->all());
        }

        return back()->with('succes','success');
    }
}