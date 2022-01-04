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
        // dd($approval);
        $approval_detail = ApprovalDetail::all();
        $trainings = Training::all();
        return view('approvalRecord',compact('approval', 'trainings', 'approval_detail'));
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
            'category_trainings_id' =>  'required',
            'subcategory_trainings_id' => 'required',
            'titleTraining' => 'required',
            'quota' => 'required',
            'objectiveTraining' => 'required',
            'backgroundTraining' => 'required',
            'description' => 'required',
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

        if(auth()->user()->role()->where('role_id', '=', 1)->exists()){
            $approval = Approval::create($request->all());
            $approval_id = $approval->id;
            //store approval detail table
            $request->request->add(['approval_id' => $approval_id]);
            //pake dummy data dulu
            $request->request->add(['approver_id' => 1]);
            $request->request->add(['user_id' => Auth::user()->id]);
            
            $approver_satu = Approver::where('user_id', Auth::user()->id)->value('approversatu_id');
            $approver_dua = Approver::where('user_id', Auth::user()->id)->value('approverdua_id');
            $approver_tiga = Approver::where('user_id', Auth::user()->id)->value('approvertiga_id');

            $request->request->add(['approversatu_id' => $approver_satu]);
            $request->request->add(['approverdua_id' => $approver_dua]);
            $request->request->add(['approvertiga_id' => $approver_tiga]);
            $request->request->add(['status_tiga' => 1]);

            ApprovalDetail::create($request->all());

            // return ke detail training
            return redirect()->action(
                [TrainingController::class, 'create'], ['id' => $approval_id]
            );
            // return 'ini admin';
        }else{
            Approval::create($request->all());
            return redirect('/approval')->with('succes','succes add data');
            // return 'ini user';
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Approval $approval)
    {
        return view('approvalDetail', compact('approval'));
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
    public function update(Request $request, $approval_id)
    {
        $approval = Approval::findOrFail($approval_id);
        $request->request->add(['status' => 0]);
        $input = $request->all();
        $approval->fill($input)->save();
        return redirect('/approval');
    }

    public function updateStatus(Request $request, $approval_id)
    {
        $validated = $request->validate([

        ]);
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