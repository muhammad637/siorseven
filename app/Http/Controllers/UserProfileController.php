<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserProfileController extends Controller
{
    public function show()
    {
        return view('pages.user-profile');
    }
    // public function edit(User $user)
    // {
    //     //
    //     // return $user->ruangan;
    //     return response(view('pages/user-profile', [
    //         'user' => $user,
    //         'title' => 'Edit User',
    //         // 'ruanganUser' => $ruanganUser
    //     ]));
    // }

    public function update(Request $request, User $user)
    {
        $validatedData = $request->validate([
            'nama' => 'required',
            'username' => 'required | ' . Rule::unique('users') ->ignore($user->id),
            'password' => '',
            'nik' => 'required|max:16'. Rule::unique('users,nik')->ignore($user->id),
            'cekLevel' => 'required',
            'no_telephone' => 'required|min:10|regex:/^([0-9\s\-\+\(\)]*)$/',
        ]);
        // $attributes = $request->validate([
        //     'username' => ['required','max:255', 'min:2'],
        //     'firstname' => ['max:100'],
        //     'lastname' => ['max:100'],
        //     'email' => ['required', 'email', 'max:255',  Rule::unique('users')->ignore(auth()->user()->id),],
        //     'address' => ['max:100'],
        //     'city' => ['max:100'],
        //     'country' => ['max:100'],
        //     'postal' => ['max:100'],
        //     'about' => ['max:255']
        // ]);

        // auth()->user()->edit([
        //     'username' => $request->get('username'),
        //     'firstname' => $request->get('firstname'),
        //     'lastname' => $request->get('lastname'),
        //     'email' => $request->get('email') ,
        //     'address' => $request->get('address'),
        //     'city' => $request->get('city'),
        //     'country' => $request->get('country'),
        //     'postal' => $request->get('postal'),
        //     'about' => $request->get('about')
        // ]);
        // return back()->with('succes', 'Profile succesfully updated');
        try {
            //code...
            if ($validatedData['password']  == null) {
                $validatedData['password'] = $user->password;
            } else {
                // $validatedData['password'] = Hash::make($validatedData['password']);
            }

            User::where('id', $user->id)->update($validatedData);
            // $notif = Notifikasi::notif('user', "user: $request->nama berhasil diupdate by " . auth()->user()->nama, 'update', 'berhasil');
            // Notifikasi::create($notif)->user()->sync(User::adminId());
            foreach ($user->ruangan as $item) {
                // Ruangan::where('id', $item->id)->update(['user_id' => null]);
            }
            if ($validatedData['cekLevel'] == 'admin') {
                # kosongkan request->ruangan = []
                // return redirect(route('user.index'))->with('toast_success', $notif['msg']);
            } else {
                // $cek = count($request->ruangan) >= 1;
                if ($request->ruangan > 0) {
                    $user->ruangan()->sync($request->ruangan);
                    // foreach ($request->ruangan as $index => $id) {
                    //     Ruangan::where('id', $id)->update(['user_id' => $user->id]);
                    //     // return Ruangan::where('id', $val)->get();
                    // }
                }
            }
            // return redirect(route('user.index'))->with('toast_success', $notif['msg']);
        } catch (\Throwable $th) {
            //throw $th;
            $notif['msg'] = 'data user ' . $user->nama . ' gagal diupdate';
            $notif['status'] = 'gagal';
            // Notifikasi::create($notif);
            return redirect()->back()->with('toast_error', $th->getMessage());
        }
}
}