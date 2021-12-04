<?php

namespace App\Http\Controllers;

use App\Models\Training;
use Illuminate\Http\Request;

class TraineeController extends Controller
{
    public function index(Training $training)
    {
        // buat nampilin user sesuai training
        return view('userDetail', compact('training'));
    }

    public function create()
    {
        # code...
    }

    public function store()
    {
        # code...
    }
}
