<?php

namespace App\Http\Controllers;

use App\Models\Approval;
use App\Models\RegistTraining;
use App\Models\CategoryTraining;
use App\Models\Provider;
use App\Models\Lesson;
use App\Models\Test;
use App\Models\Room;
use App\Models\SubcategoryTraining;
use App\Models\Training;
use App\Models\Venue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class TrainingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $registTrainings = RegistTraining::all();
        $approval = Approval::all();
        $category = CategoryTraining::all();
        $lesson = Lesson::all();
        $subcategory = SubcategoryTraining::all();
        //$approval = Approval::all();
        //$room = Room::all();
        $training = Training::orderBy('created_at', 'DESC')->get();
        $provider = Provider::all();
        // $data['venue'] = Venue::get(["nameVenue","id"]);
        $venue = Venue::all();
        return view('recordTraining',compact('training','approval','provider','venue','category','subcategory','lesson','approval','registTrainings'));
    }

    public function createtraining()
    {
        $category = CategoryTraining::all();
        $lesson = Lesson::all();
        $survey = Survey::all();
        $category = CategoryTraining::all();
        $subcategory = SubcategoryTraining::all();
        $costtype = CostType::all();
        $provider = Provider::all();
        $venue = Venue::all();
        $providerinternal_id = Provider::select("*")->where("typeProvider","=","Internal")->get();
        $providerexternal_id = Provider::select("*")->where("typeProvider","=","External")->get();
        $posttest_id = Test::select("*")->where("typeTest","=","PostTest")->get();
        $pretest_id = Test::select("*")->where("typeTest","=","PreTest")->get();
        return view('createTraining',compact('category','provider','venue','category','subcategory','survey','lesson','costtype','posttest_id','pretest_id','providerinternal_id','providerexternal_id'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($approval_id)
    {
        $approval = Approval::find($approval_id);
        $category = CategoryTraining::all();
        $lesson = Lesson::all();
        $subcategory = SubcategoryTraining::all();
        //$room = Room::all();
        $provider = Provider::all();
        // $data['venue'] = Venue::get(["nameVenue","id"]);
        $venue = Venue::all();
        $posttest_id = Test::select("*")->where("typeTest","=","PostTest")->get();
        $pretest_id = Test::select("*")->where("typeTest","=","PreTest")->get();
        return view('setting.createTraining',compact('approval','provider','venue','category','subcategory','lesson','approval','posttest_id','pretest_id'));
    }

    public function getRoom(Request $request)
    {
        // $data['states'] = State::where("country_id",$request->country_id)->get();
        // return response()->json($data);

        $data['rooms'] = Room::where("venue_id",$request->venue_id)->get(["id","nameRoom"]);
        // ->get(["nameRoom","id"]);
        return response()->json($data);
    }

    public function getLesson(Request $request)
    {
        $data['lessons'] = Lesson::where("subcategory_trainings_id",$request->subcategory_trainings_id)->get(["id","nameLesson"]);
        // ->get(["nameRoom","id"]);
        return response()->json($data);
    }

    public function getSubcategory(Request $request)
    {
        // $data['states'] = State::where("country_id",$request->country_id)->get();
        // return response()->json($data);

        $data['subcategory_trainings'] = SubcategoryTraining::where("category_trainings_id",$request->category_trainings_id)->get(["id","nameSubcategory"]);
        // ->get(["nameRoom","id"]);
        return response()->json($data);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $approval_id)
    {
        // dd($request);
        $this->validate($request, [
            'lesson_id' => 'required',
            'posttest_id' => 'required',
            'pretest_id' => 'required',
            'mandatory' => 'required',
            'mandatoryTraining' => 'required',
            'start_date'  => 'required|date',
            'end_date'    => 'required|date|after:start_date',
        ],
        [
            'lesson_id.required' => 'Lesson Training is required',
            'posttest_id.required' => 'Post Test is required',
            'pretest_id.required' => 'Pre Test is required',
            'mandatory.required' => 'Mandatory for Employee is required',
            'mandatoryTraining.required' => 'Metode Training is required',
            'start_date.required'  => 'Start Date is required',
            'end_date.required'    => 'End Date is required'
        ]);

        $request->request->add(['approval_id' => $approval_id]);
        Training::create($request->all());
        return redirect('/training')->with('succes','succes add data');
    }

    public function storetraining(Request $request)
    {

        $request->validate([
            'category_id' =>  'required',
            'subcategory_id' => 'required',
            'titleTraining' => 'required',
            'quota' => 'required',
            'objectiveTraining' => 'required',
            'backgroundTraining' => 'required',
            'description' => 'required',
            'lesson_id' => 'required',
            'posttest_id' => 'required',
            'pretest_id' => 'required',
            'methodTraining' => 'required',
            'mandatoryTraining' => 'required',
            'startDate'  => 'required|date',
            'endDate'    => 'required|date|after:startDate',
        ],
        [
            'category_id.required' =>  'Category Training is required',
            'subcategory_id.required' => 'Subcategory Training is required',
            'titleTraining.required' => 'Title Training is required',
            'quota.required' => 'Jumlah Peserta is required',
            'objectiveTraining.required' => 'Objective Training is required',
            'backgroundTraining.required' => 'Background Training is required',
            'description.required' => 'Catatan is required',
        'lesson_id.required' => 'Lesson Training is required',
            'posttest_id.required' => 'Post Test is required',
            'pretest_id.required' => 'Pre Test is required',
            'methodTraining.required' => 'Mandatory for Employee is required',
            'mandatoryTraining.required' => 'Metode Training is required',
            'startDate.required'  => 'Start Date is required',
            'endDate.required'    => 'End Date is required'

        ]
        );
        //store ke approval
        $request->request->add(['user_id' => $request->user()->id]);
        //$request->request->add(['status' => 1]);
        $approval = Approval::create($request->all());
        $approval_id = $approval->id;
//store ke training
$training = new Training;
    $training ->approval_id = $approval_id;
    $training ->venue_id = $request->venue_id;
    $training ->room_id = $request->room_id;
    $training ->lesson_id = $request->lesson_id;
    $training ->surveysatu_id = $request ->surveysatu_id ;
    $training ->surveydua_id = $request ->surveydua_id;
    $training ->posttest_id = $request ->posttest_id;
    $training ->pretest_id = $request ->pretest_id;
    $training ->url = $request->url;
    $training ->description = $request->description;
    $training ->mandatoryTraining = $request->mandatoryTraining;
    $training ->publish = $request ->publish;
    $training ->methodTraining = $request->methodTraining;
    $training ->startDate = $request ->startDate;
    $training ->endDate = $request ->endDate;
    $training->save();

    $training_id = $training->id;
    
    $data = $request->all();

    //store detail training
        foreach($request->get('costtype_id') as $item=>$value){
            $databudget = array(
                'training_id' => $training_id,
                'budget' => $data['budget'][$item],
                'costtype_id' => $data['costtype_id'][$item],
            );
            DetailTraining::create($databudget);
        }

    foreach ($request->get('starttime') as $key => $value) {
        $datasession = array(
            'training_id' => $training_id,
            'trainer' => $data['trainer'][$key],
            'startDateEvent' => $data['starttime'][$key],
            'endDateEvent' => $data['endtime'][$key],
        );
        DetailSessionTraining::create($datasession);

    }
        return redirect('/training')->with('succes','succes add data');
        // return 'ini user';
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
    public function edit(Training $training, Approval $approval)
    {
        // dd($training);
        $venue = Venue::all();
        $room = Room::all();
        $lesson = Lesson::all();
        $posttest_id = Test::select("*")->where("typeTest","=","PostTest")->get();
        $pretest_id = Test::select("*")->where("typeTest","=","PreTest")->get();
        return view('editTraining', compact('training', 'approval', 'venue', 'room', 'lesson','posttest_id','pretest_id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $training_id, $approval_id)
    {
        // dd($request);
        $training = Training::findOrFail($training_id);
        $request->request->add(['approval_id' => $approval_id]);
        $input = $request->all();
        $training->fill($input)->save();

        $approval = Approval::findOrFail($approval_id);
        $request->request->add(['titleTraining' => $request->titleTraining]);
        $input = $request->all();
        $approval->fill($input)->save();
        return redirect()->route('training.index');
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