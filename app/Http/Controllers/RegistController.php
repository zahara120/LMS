<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Training;
use App\Models\Regist;
use Illuminate\Support\Facades\Auth;
use Laravel\Ui\Presets\React;

class RegistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $regist = Regist::all();
        return view('registTrainingRecord',compact('regist'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($training_id)
    {
        $training = Training::find($training_id);
        return view('detailTraining',compact('training'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $training_id)
    {
        //dd($training_id);
        $request->request->add(['user_id' => Auth::user()->id]);
        $request->request->add(['training_id' => $training_id]);
        $regist = Regist::create($request->all());

        $regist_id = $regist->id;

        // $registration = Regist::find($regist_id);
        // $registration->training()->attach($training_id); //buat ngisi table registration_training
        return redirect('/regist')->with('succes','succes regist Training');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($training_id, $regist_id)
    {
        $training = Training::findOrFail($training_id);
        $regist = $regist_id;
        return view('registrationDetail', compact('training', 'regist'));
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
    public function update(Request $request, $regist_id)
    {
        $regist = Regist::findOrFail($regist_id);
        $request->request->add(['status' => $request->status]);
        $input = $request->all();
        $regist->fill($input)->save();
        return redirect('/regist');
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
