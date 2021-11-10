<?php

namespace App\Http\Controllers;

use App\Models\CategoryTraining;
use App\Models\Approval;
use App\Models\SubcategoryTraining;
use Illuminate\Http\Request;

class ApprovalRecordController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $approval = Approval::all();
        return view('approvalRecord',compact('approval'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = CategoryTraining::all();
        return view('trainingSubmission',compact('category'));
    }

    public function getSubcategory(Request $request)
    {
        // $data['states'] = State::where("country_id",$request->country_id)->get();
        // return response()->json($data);

        $data['subcategory_trainings'] = SubcategoryTraining::where("category_id",$request->category_id)->get(["id","nameSubcategory"]);
        // ->get(["nameRoom","id"]);
        return response()->json($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $approval = new Approval;
        // $approval->training_id = $request->training_id;
        $approval->user_id = $request->user()->id;
        $approval->titleTraining = $request->titleTraining;
        $approval->category_id = $request->category_id;
        $approval->subcategory_id = $request->subcategory_id;
        $approval->quota = $request->quota;
        $approval->description = $request->description;
        $approval->objectiveTraining = $request->objectiveTraining;
        $approval->backgroundTraining = $request->backgroundTraining;
        $approval->save();

        //return $request->all();

        //approvalTraining::create($request->all());

        return redirect('/approval')->with('succes','succes add data');
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
        $approval = Approval::all();
        return view('approvalRecord',compact('approval'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function update(Request $request, $id)
    // {
    //     $approval = Approval::find($id)->update(['status' => $request->status]);
    //     // $approval = Approval::find($id);
    //     return back();
    // }

    public function update(Request $request, $id)
    {
        //$id = \Request::segment(3);
        $application = Approval::find($id)->update(['status' => $request->status]);
        if ($application->status == 1) 
        {
        $application->status = 2;
        $msg = 'User UnApproved successfully';
        }
        else {
            $application->status = 1;   
            $msg = 'User Approved successfully';
                }
        $application->save();
        //return Redirect::back()->with('message',$msg);
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