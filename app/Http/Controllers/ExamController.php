<?php

namespace App\Http\Controllers;

use App\Imports\ExamImport;
use App\Models\SubcategoryTraining;
use App\Models\CategoryTraining;
use App\Models\Test;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ExamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $test = Test::all();
        $category = CategoryTraining::all();
        $subcategory = SubcategoryTraining::all();
        return view('setting.createTest',compact('test','category','subcategory'));
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
        // dd($request);
        // $request->request->add(['duration' => $request->]);
        $request->validate([
            'category_trainings_id' => 'required',
            'subcategory_trainings_id' => 'required',
            'lesson_id' => 'required',
            'typeTest' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            // 'duration' => 'required',
            'nameTest' => 'required',
        ],
        [
            'category_trainings_id.required' => 'Category Training  is required',
            'subcategory_trainings_id.required' => 'Subcategory Training  is required',
            'lesson_id.required' => 'Lesson is required',
            'typeTest.required' => 'Type Test is required',
            'start_date.required' => 'Start date is required',
            'end_date.required' => 'End date is required',
            // 'duration.required' => 'Duration  is required',
            'nameTest.required' => 'Name test is required',
        ]);
        
        $startTime = Carbon::parse($request->start_date);
        $endTime = Carbon::parse($request->end_date);

        $totalDuration =  $startTime->diff($endTime)->format('%H:%I:%S');
        // dd($totalDuration);
        // dd($request);
        $request->request->add(['duration' => $totalDuration]);
        Test::create($request->all());
        return redirect('/exam');
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
        $test = Test::find($id);
        $test->delete();
        return redirect('/exam')->with('succes','succes delete data');
    }

    public function examImport(Request $request)
    {
        $file = $request->file('file');
        $nameFile = $file->getClientOriginalName();
        $file->move('dataExam', $nameFile);

        Excel::import(new ExamImport, public_path('/dataExam/'.$nameFile));
        return redirect()->route('exam.index');
    }
}
