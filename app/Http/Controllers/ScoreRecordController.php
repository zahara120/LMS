<?php

namespace App\Http\Controllers;

use App\Models\Regist;
use App\Models\Test;
use App\Models\TestResult;
use App\Models\Training;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ScoreRecordController extends Controller
{
    public function index()
    {
        $trainings = Training::all();
        $regist = Regist::all();
        // dd($regist);
        $test_result = TestResult::all();
        $test = Test::all();
        $users = User::all();
        return view('scoreRecord.index', compact('regist','test_result','trainings','test','users'));
    }
}