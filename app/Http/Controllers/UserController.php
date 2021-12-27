<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Training;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return User::with(['role'])->get();
        $user = User::with(['role'])->get();
        $roles = Role::all();

        return view('setting.indexUser', compact('user','roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // User::insert([
        //     'name' =>$request->get('name'),
        //     'nip' =>$request->get('nip')
        // ])

        // $user = User::create($request->all());
        // $user->roles()->sync($request->input('roles', []));

        // return redirect()->route('admin.users.index');
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updatePassword(Request $request)
    {
        // dd($request);
        //validate
        $request->validate([
            'password' => 'required',
            'newPassword' => 'required|same:password'
        ]);
        // to check the old password
        if (Hash::check($request->password, Auth::user()->password)) {
            // store the new password
            $request->user()->fill([
                'password' => Hash::make($request->newPassword)
            ])->save();
            return back();
        }
        else if(!Hash::check($request->password, Auth::user()->password)){
            return back()->with('error', 'Incorrect Password!');
        }

        // if(Hash::check($request->password, $request->newPassword)){
        //     return back()->with('error', 'password cannot be same!');
        // }else{
        //     return back()->with('error', 'success!');
        // }
        // if (Hash::check($request->password, $request->newPassword)) {
        //     return 'password cannot be same';
        // }
        // if($request->password == $request->newPassword){
        //     // return back()->with('error', 'Password cannot be same!');
        //     return 'password cannot be same';
        // }
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