<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Approval;
use App\Models\CategoryTraining;
use App\Models\Provider;
use App\Models\Lesson;
use App\Models\Training;
use App\Models\Room;
use App\Models\SubcategoryTraining;
use App\Models\Venue;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $approval = Approval::all();
        $category = CategoryTraining::all();
        $lesson = Lesson::all();
        $subcategory = SubcategoryTraining::all();
        $training = Training::all();
        $provider = Provider::all();
        $venue = Venue::all();
        return view('home-page',compact('training','approval','provider','venue','category','subcategory','lesson','approval'));
    }
}
