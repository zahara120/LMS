<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Venue;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $room = Room::all();
        $venue = Venue::all();
        return view('setting.indexRoom',compact('room','venue'));
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
        $request->validate([

            'nameRoom' => ['required', 'string', 'max:255'],
            'venue_id' => ['required'],

	    ], [
	        'nameRoom.required' => 'The name room field is required',
            'venue_id.required' => 'The name venue field is required',
	    ]);

        $room = new Room;
        $room->nameRoom = $request->nameRoom;
        $room->venue_id = $request->venue_id;
        $room->save();

        //return $request->all();

        //roomTraining::create($request->all());

        return redirect('/room')->with('succes','succes add data');
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
        $venue = Venue::all();
        // $subcategory = SubcategoryTraining::all();
        $room = Room::findorfail($id);

        //dd($subcategory);
        //$category = CategoryTraining::findorfail($id);
        return view ('setting.editRoom',compact('room','venue'));
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
        $room = Room::findorfail($id);
        $room->update($request->all());
        return redirect('/room')->with('succes','succes edit data');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $room = Room::find($id);
        $room->delete();
        return redirect('/room')->with('succes','succes delete data');
    }

    public function RoomExport()
    {
        return Excel::download(new RoomExport,'Room.xlsx');
    }
}