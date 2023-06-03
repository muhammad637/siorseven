<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class MasterUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //


        return view(
            'auth.admin.master.user.index',
            [
                'users' => User::orderBy('created_at','desc')->get()
            ]
        );
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
        //
        $validatedData = $request->validate(
            [
                'nama' => 'required',
                'username' => 'required |unique:users,username',
                'password' => 'required',
                'nik' => 'required |unique:users,nik',
                'no_telephone' => 'required',
                'cekLevel' => 'required'
            ]
        );
        try{
            User::create($validatedData);
            return redirect()->back()->with('toast_success','data berhasil ditambahkan');
        }
        catch(\Throwable $th){
            return $th->getMessage();
        }
       
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('auth.admin.master.user.edit');
       
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
        $validatedData = $request->validate([
            'nama' => 'required',
            'username' => 'required |' . Rule::unique('users')->ignore($user->id),
            'password' => '',
            'nik' => 'required|max:16',
            'cekLevel' => 'required',
            'no_telephone' => 'required'
            // 'no_telephone' => 'required|min:10|regex:/^([0-9\s\-\+\(\)]*)$/',
        ]);
        try {
            //code...
            if (!$validatedData['password']) {
            
                $validatedData['password'] = $user->password;
            }
            $user->update($validatedData);
            return redirect()->back()->with('toast_success','data user berhasil diupdate');
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('error',$th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }

    public function aktif(Request $request, User $user){
        $user->update(['status' => 'aktif']);
        return redirect()->back();
    }
    public function nonaktif(User $user){
        $user->update(['status' => 'nonaktif']);
        return redirect()->back();
    }
}
