<?php

namespace App\Http\Controllers;

use App\Exports\VenueExport;
use App\Exports\VenueTemplate;
use App\Imports\VenueImport;
use App\Models\Venue;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class VenueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $venue = Venue::all();
        return view('setting.indexVenue',compact('venue'));
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

            'nameVenue' => ['required', 'string', 'max:255', 'unique:venues'],

	    ], [
            'nameVenue.unique' => 'The name venue already registered',
	        'nameVenue.required' => 'The name venue field is required',

	    ]);

        //return $request->all();
        Venue::create($request->all());

        return redirect('/venue')->with('succes','succes add data');
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
        $venue = Venue::findorfail($id);
        return view ('setting.editVenue',compact('venue'));
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
        $venue = Venue::findorfail($id);
        $venue->update($request->all());
        return redirect('/venue')->with('succes','succes edit data');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $venue = Venue::find($id);
        $venue->delete();
        return redirect('/room')->with('succes','succes delete data');
    }

    public function venueExport()
    {
        return Excel::download(new VenueExport,'Venue.xlsx');
    }
    
    public function venueImport(Request $request)
    {
        $file = $request->file('file');
        $nameFile = $file->getClientOriginalName();
        $file->move('dataVenue', $nameFile);
        
        Excel::import(new VenueImport, public_path('/dataVenue/'.$nameFile));
        return redirect()->route('venue.index');
    }

    public function templateVenue()
    {
        return Excel::download(new VenueTemplate,'TemplateVenue.xlsx');
    }
}