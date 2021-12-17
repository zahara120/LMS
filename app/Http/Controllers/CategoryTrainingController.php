<?php

namespace App\Http\Controllers;

use App\Exports\CategoryExport;
use App\Exports\CategoryTemplate;
use App\Imports\CategoryTrainingImport;
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
        $category = CategoryTraining::paginate(10);
        //$category = CategoryTraining::all();
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
        $category = categoryTraining::find($id);
        return view('setting.viewCategory', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = CategoryTraining::findorfail($id);
        //dd($category);
        return view ('setting.editCategory',compact('category'));
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
        //return $id;
        $category = CategoryTraining::findorfail($id);
        $category->update($request->all());
        return redirect('/categorytraining')->with('succes','succes edit data');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    
    public function destroy($id)
    {
        //$category = CategoryTraining::findorfail($id)->delete();
        $category = categoryTraining::find($id);
        $category->delete();
        return redirect('/categorytraining')->with('succes','succes delete data');
    }

    public function categoryExport()
    {
        return Excel::download(new CategoryExport,'CategoryTraining.xlsx');
    }
    
    public function categoryImport(Request $request)
    {
        $file = $request->file('file');
        $nameFile = $file->getClientOriginalName();
        $file->move('dataCategoryTraining', $nameFile);
        
        Excel::import(new CategoryTrainingImport, public_path('/dataCategoryTraining/'.$nameFile));
        return redirect()->route('category.index');
    }

    public function templateCategory()
    {
        return Excel::download(new CategoryTemplate,'TemplateCategoryTraining.xlsx');
    }
}