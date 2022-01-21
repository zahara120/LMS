<?php

namespace App\Http\Controllers;

use App\Models\CategoryTraining;
use App\Models\Approval;
use App\Models\ApprovalDetail;
use App\Models\Approver;
use App\Models\Role;
use App\Models\RoleUser;
use App\Models\SubcategoryTraining;
use App\Models\Training;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
        $approval_detail = ApprovalDetail::all();
        $user_id = ApprovalDetail::where('user_id', Auth::user()->id)->value('user_id');
        $trainings = Training::all();

        $approver_satu = Approver::where('approversatu_id', Auth::user()->id)->value('approversatu_id');
        $approver_dua = Approver::where('approverdua_id', Auth::user()->id)->value('approverdua_id');
        $approver_tiga = Approver::where('approvertiga_id', Auth::user()->id)->value('approvertiga_id');
        return view('approvalRecord',compact('approval', 'trainings', 'approval_detail','user_id','approver_satu','approver_dua','approver_tiga'));
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
        $request->validate([
            //approval
            'category_trainings_id' =>  'required',
            'subcategory_trainings_id' => 'required',
            'titleTraining' => 'required',
            'quota' => 'required',
            'objectiveTraining' => 'required',
            'backgroundTraining' => 'required',
            'description' => 'required'
        ],
        [
            'category_trainings_id.required' =>  'Category Training is required',
            'subcategory_trainings_id.required' => 'Subcategory Training is required',
            'titleTraining.required' => 'Title Training is required',
            'quota.required' => 'Jumlah Peserta is required',
            'objectiveTraining.required' => 'Objective Training is required',
            'backgroundTraining.required' => 'Background Training is required',
            'description.required' => 'Catatan is required',
        ]
        );

        $approval = Approval::create($request->all());
        $approval_id = $approval->id;
        
        //store approval detail table
        $request->request->add(['approval_id' => $approval_id]);
        $approver_id = Approver::where('user_id', Auth::user()->id)->value('id');
        if(!$approver_id){
            return back()->with('error', 'you don\'t have an approver');
        }
        $request->request->add(['approver_id' => $approver_id]);
        $request->request->add(['user_id' => Auth::user()->id]);
        
        $approver_satu = Approver::where('user_id', Auth::user()->id)->value('approversatu_id');
        $approver_dua = Approver::where('user_id', Auth::user()->id)->value('approverdua_id');
        $approver_tiga = Approver::where('user_id', Auth::user()->id)->value('approvertiga_id');

        $request->request->add(['approversatu_id' => $approver_satu]);
        $request->request->add(['approverdua_id' => $approver_dua]);
        $request->request->add(['approvertiga_id' => $approver_tiga]);
        
        if(auth()->user()->role()->where('role_id', '=', 1)->exists()){
            $request->request->add(['status_tiga' => 1]);
        }

        ApprovalDetail::create($request->all());

        if(auth()->user()->role()->where('role_id', '=', 1)->exists()){
            // return ke detail training
            return redirect()->action(
                [TrainingController::class, 'create'], ['id' => $approval_id]
            );
        }else{
            return redirect('/approval')->with('succes','succes add data');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Approval $approval, $approvalDetail_id)
    {
        $approval_detail = ApprovalDetail::findOrFail($approvalDetail_id);
        return view('approvalDetail', compact('approval', 'approval_detail'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Approval $approval)
    {
        $category = CategoryTraining::all();
        return view('approvalEdit', compact('approval', 'category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function update(Request $request, $approval_id)
    // {
    //     $approval = Approval::findOrFail($approval_id);
    //     $request->request->add(['status' => 0]);
    //     $input = $request->all();
    //     $approval->fill($input)->save();
    //     return redirect('/approval');
    // }

    public function updateStatus(Request $request, $approvalDetail_id)
    {
        $approval_detail = ApprovalDetail::findOrFail($approvalDetail_id);
        // dd($approval_detail);
        $approver_satu = Approver::where('approversatu_id', Auth::user()->id)->value('approversatu_id');
        $approver_dua = Approver::where('approverdua_id', Auth::user()->id)->value('approverdua_id');
        $approver_tiga = Approver::where('approvertiga_id', Auth::user()->id)->value('approvertiga_id');

        if($approver_satu == Auth::user()->id){
            $request->request->add(['status_satu' => $request->status]);
            $request->request->add(['alasan_satu' => $request->alasan]);
        }
        elseif($approver_dua == Auth::user()->id){
            $request->request->add(['status_dua' => $request->status]);
            $request->request->add(['alasan_dua' => $request->alasan]);
        }
        elseif($approver_tiga == Auth::user()->id){
            $request->request->add(['status_tiga' => $request->status]);
            $request->request->add(['alasan_tiga' => $request->alasan]);
        }

        $input = $request->all();
        // dd($request);
        $approval_detail->fill($input)->save();
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