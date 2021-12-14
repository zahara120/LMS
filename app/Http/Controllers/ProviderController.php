<?php

namespace App\Http\Controllers;

use App\Exports\ProviderTemplate;
use App\Imports\ProviderImport;
use App\Models\Provider;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ProviderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $provider = Provider::all();
        return view('setting.indexProvider',compact('provider'));
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

            'nameProvider' => ['required', 'string', 'max:255', 'unique:providers'],
            'typeProvider' => ['required', 'string'],

	    ], [
            'nameProvider.unique' => 'The name provider already registered',
	        'nameProvider.required' => 'The name provider field is required',
            'typeProvider.required' => 'The type provider field is required',

	    ]);

        //return $request->all();

        Provider::create($request->all());

        return redirect('/provider')->with('succes','succes add data');
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
        $provider = Provider::findorfail($id);
        return view ('setting.editProvider',compact('provider'));
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
        $provider = Provider::findorfail($id);
        $provider->update($request->all());
        return redirect('/provider')->with('succes','succes edit data');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $provider = Provider::find($id);
        $provider->delete();
        return redirect('/provider')->with('succes','succes delete data');
    }

    public function ProviderExport()
    {
        return Excel::download(new ProviderExport,'Provider.xlsx');
    }

    public function ProviderImport(Request $request)
    {
        $file = $request->file('file');
        $nameFile = $file->getClientOriginalName();
        $file->move('dataProvider', $nameFile);

        Excel::import(new ProviderImport, public_path('/dataProvider/'.$nameFile));
        return redirect()->route('provider.index');
    }

    public function templateProvider()
    {
        return Excel::download(new ProviderTemplate,'TemplateProvider.xlsx');
    }
}