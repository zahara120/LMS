<?php

namespace App\Http\Controllers;

use App\Models\Regist;
use App\Models\RegistTraining;
use App\Models\Training;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TraineeController extends Controller
{
    public function index(Training $training)
    {
        // buat nampilin user sesuai training
        $regists = Regist::where('training_id', $training->id)->get();

        $users='';
        foreach ($regists as $r) {
            $users .= $r->user_id.',';
        }
        $arrUserId = explode(',',$users);
        // dd($arrUserId);
        $users = User::whereNotIn('id', $arrUserId)->get();
        $date = Carbon::today()->toDateString();
        return view('userDetail', compact('training','users','date'));
    }

    public function store(Request $request, Training $training)
    {
        $validated = $request->validate([

        ]);
        
        // dd($request);
        // store ke regist
        $request->request->add(['user_id' => $request->user_id]);
        $request->request->add(['status' => 1]);
        $request->request->add(['training_id' => $training->id]);
        $regist = Regist::create($request->all());

        $regist_id = $regist->id;

        $request->request->add(['regist_id' => $regist_id]);
        $request->request->add(['training_id' => $training->id]);
        RegistTraining::create($request->all());

        return redirect()->route('training.user.index', compact('training'));
    }

    public function destroy(Regist $regist)
    {
        // delete peserta training
        $regist->delete();
        $training = $regist->training_id;
        return redirect()->route('training.user.index', compact('training'));
    }
}
