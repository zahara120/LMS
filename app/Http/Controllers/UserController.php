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
            'newPassword' => ['required','confirmed'],
        ]);
        if(strcmp($request->password, $request->newPassword) == 0){
        //Current password and new password are same
        return redirect()->with("error","New Password cannot be same as your current password. Please choose a different password.");
        }
        
        //jika password yang di input tidak sama dengan passsword yang ada di db
        if (!(Hash::check($request->password, Auth::user()->password))) {
            // store the new password
            return redirect()->with("error","Incorect password.");
        }
        // to check the old password
        if (Hash::check($request->password, Auth::user()->password)) {
            // store the new password
            $request->user()->fill([
                'password' => Hash::make($request->newPassword)
            ])->save();
            return back();
        }
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