<?php

namespace App\Http\Controllers;

use App\Models\CategoryTraining;
use App\Models\Approval;
use App\Models\SubcategoryTraining;
use App\Models\Training;
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
        $approval = Approval::orderBy('created_at', 'DESC')->get();
        $trainings = Training::all();
        return view('approvalRecord',compact('approval', 'trainings'));
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
        if(auth()->user()->role()->where('nameRole', '==', 'Admin')){
            $request->request->add(['user_id' => $request->user()->id]);
            $request->request->add(['status' => 1]);
            $approval = Approval::create($request->all());
            $approval_id = $approval->id;
            // return ke detail training
            return redirect()->action(
                [TrainingController::class, 'create'], ['id' => $approval_id]
            );
        }else{
            $request->request->add(['user_id' => $request->user()->id]);
            Approval::create($request->all());
            return redirect('/approval')->with('succes','succes add data');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $approval = Approval::findOrFail($id);
        return view('approvalDetail',compact('approval'));
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

    public function update(Request $request, $approval_id)
    {
        // dd($request->status);
        // dd($approval_id);
        $approval = Approval::findOrFail($approval_id);
        $request->request->add(['status' => $request->status]);
        $request->request->add(['alasan' => $request->alasan]);
        $input = $request->all();
        $approval->fill($input)->save();
        return redirect('/approval');
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