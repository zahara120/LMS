<?php

namespace App\Http\Controllers;

use App\Models\CategoryTraining;
use Illuminate\Http\Request;

class TrainingSubmissionController extends Controller
{
    public function index()
    {
        $category = CategoryTraining::all();
        return view('trainingSubmission',compact('category'));
    }
}