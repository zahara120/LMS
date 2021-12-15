<?php

namespace App\Http\Controllers;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\SubcategoryExport;
use App\Exports\SubcategoryTemplate;
use App\Imports\SubCategoryImport;
use App\Models\CategoryTraining;
use App\Models\SubcategoryTraining;
use Illuminate\Http\Request;

class SubcategoryTrainingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subcategory = SubcategoryTraining::all();
        $category = CategoryTraining::all();
        return view('setting.indexSubcategory',compact('subcategory','category'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $category = CategoryTraining::all();
        // return view('setting.indexSubcategory',compact('category'));
        
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

            'nameSubcategory' => ['required', 'string', 'max:255'],
            'category_trainings_id' => ['required'],

	    ], [
	        'nameSubcategory.required' => 'The name subcategory field is required',
            'category_trainings_id.required' => 'The name category field is required',
	    ]);

        $subcategory = new SubcategoryTraining;
        $subcategory->nameSubcategory = $request->nameSubcategory;
        $subcategory->category_trainings_id = $request->category_trainings_id;
        $subcategory->description = $request->description;
        $subcategory->save();

        //return $request->all();

        //SubcategoryTraining::create($request->all());

        return redirect('/subcategorytraining')->with('succes','succes add data');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $subcategory = subcategoryTraining::findOrFail($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = CategoryTraining::all();
        // $subcategory = SubcategoryTraining::all();
        $subcategory = SubcategoryTraining::findorfail($id);

        //dd($subcategory);
        //$category = CategoryTraining::findorfail($id);
        return view ('setting.editSubcategory',compact('subcategory','category'));
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
        $subcategory = SubcategoryTraining::findorfail($id);
        $subcategory->update($request->all());
        return redirect('/subcategorytraining')->with('succes','succes edit data');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $subcategory = subcategoryTraining::find($id);
        $subcategory->delete();
        return redirect('/subcategorytraining')->with('succes','succes delete data');
    }

    public function subcategoryExport()
    {
        return Excel::download(new SubcategoryExport,'SubcategoryTraining.xlsx');
    }
    
    public function subcategoryImport(Request $request)
    {
        $file = $request->file('file');
        $nameFile = $file->getClientOriginalName();
        $file->move('dataSubCategoryTraining', $nameFile);
        
        Excel::import(new SubCategoryImport, public_path('/dataSubCategoryTraining/'.$nameFile));
        return redirect()->route('subcategory.index');
    }

    public function templateSubcategory()
    {
        return Excel::download(new SubcategoryTemplate,'TemplateSubcategoryTraining.xlsx');
    }
}