<?php

namespace App\Http\Controllers;

use App\Models\Lesson;
use App\Models\Trainer;
use App\Models\User;
use Illuminate\Http\Request;

class TrainerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lessons = Lesson::all();
        $trainers = Trainer::all();
        $users = User::all();
        // foreach($trainers->lesson as $item){
        //     dd($item->nameLesson);
        // }
        return view('setting.trainer.index', compact('lessons', 'trainers','users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $request->request->add(['lesson_id' => $request->lesson_id]);
        // $request->request->add(['trainer_id' => $request->trainer_id]);
        // foreach($request->trainer_id as $trainer){
        //     dd($trainer);
        // }
        // Trainer::create($request->all());

        $lesson_id = $request->lesson_id;
        $trainer_ids = $request->trainer_id;

        foreach($trainer_ids as $trainer_id) {
            Trainer::create([
                'lesson_id' => $lesson_id,
                'trainer_id' => $trainer_id
            ]);
        }
        return redirect('/trainers');
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
        $trainer = Trainer::findOrFail($id);
        $lessons = Lesson::all();
        $users = User::all();
        return view('setting.trainer.edit', compact('trainer', 'lessons', 'users'));
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
        dd($request);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($trainer_id)
    {
        $trainers = Trainer::findOrFail($trainer_id);
        $trainers->delete();
        return redirect('/trainers')->with('succes','succes delete data');
    }
}
