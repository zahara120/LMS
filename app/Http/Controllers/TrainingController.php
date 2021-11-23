<?php

namespace App\Http\Controllers;

use App\Models\Approval;
use App\Models\CategoryTraining;
use App\Models\Provider;
use App\Models\Lesson;
use App\Models\Room;
use App\Models\SubcategoryTraining;
use App\Models\Training;
use App\Models\Venue;
use Illuminate\Http\Request;

class TrainingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $approval = Approval::all();
        $category = CategoryTraining::all();
        $lesson = Lesson::all();
        $subcategory = SubcategoryTraining::all();
        //$approval = Approval::all();
        //$room = Room::all();
        $training = Training::all();
        $provider = Provider::all();
        // $data['venue'] = Venue::get(["nameVenue","id"]);
        $venue = Venue::all();
        return view('recordTraining',compact('training','approval','provider','venue','category','subcategory','lesson','approval'));
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
        return view('setting.createTraining',compact('approval','provider','venue','category','subcategory','lesson','approval'));
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
            'start_date'  => 'required|date',
            'end_date'    => 'required|date|after:start_date',
        ]);

        $request->request->add(['approval_id' => $approval_id]);
        Training::create($request->all());
        return redirect('/training')->with('succes','succes add data');;
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
        //
    }
}