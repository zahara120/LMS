<?php

namespace App\Http\Controllers;

use App\Exports\CategoryExport;
use App\Models\CategoryTraining;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;

class CategoryTrainingController extends Controller
{

    // protected function validator(array $request)
    // {
    //     return CategoryTraining::make($request, [
    //         'nameCategory' => ['required', 'string', 'max:255', 'unique:category_trainings'],
    //     ]);
    // }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $category = CategoryTraining::all();
        // $category = CategoryTraining::with('subcategory')->get();
        // $category = CategoryTraining::with('subcategory')->simplePaginate(5);
        $category = CategoryTraining::paginate(1);
        return view('setting.indexCategory',compact('category'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //return view('setting.addCategory');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([

            'nameCategory' => ['required', 'string', 'max:255', 'unique:category_trainings'],

	    ], [
            'nameCategory.unique' => 'The name category already registered',
	        'nameCategory.required' => 'The name category field is required',

	    ]);

        //return $request->all();

        CategoryTraining::create($request->all());

        return redirect('/categorytraining')->with('succes','succes add data');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = CategoryTraining::find($id);

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
        $category = CategoryTraining::find($id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    
    public function destroy($id)
    {
        $category = CategoryTraining::find($id);
        $category->delete();
        return redirect('/lesson')->with('succes','succes delete data');
    }

    public function categoryExport(){
        return Excel::download(new CategoryExport,'CategoryTraining.xlsx');
    }
}