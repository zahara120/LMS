<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Approval;
use App\Models\CategoryTraining;
use App\Models\Provider;
use App\Models\Lesson;
use App\Models\Regist;
use App\Models\RegistTraining;
use App\Models\Training;
use App\Models\Room;
use App\Models\SubcategoryTraining;
use App\Models\Venue;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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
        $registTrainings = RegistTraining::all();
        // dd($registTrainings);
        $approval = Approval::all();
        $category = CategoryTraining::all();
        $lesson = Lesson::all();
        $subcategory = SubcategoryTraining::all();
        $training = Training::all();
        $provider = Provider::all();
        $venue = Venue::all();
        $total_user = User::count();
        $total_training = Training::count();
        $date = Carbon::today()->toDateString();
        $password = Hash::check('hris9090', Auth::user()->password);
        // dd($password);
        // $quota = Approval::select('id', 'titleTraining', 'quota', 'user_id');
        // $count = count($quota);

        return view('home-page',compact('password' ,'training','approval','provider','venue','category','subcategory','lesson','approval','date','total_training','total_user','registTrainings'));
    }
}
