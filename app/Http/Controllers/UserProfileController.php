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
            'no_telephone' => 'required|min:10|regex:/^([0-9\s\-\+\(\)]*)$/',
        ]);
       
        try {
            
            User::where('id', $user->id)->update($validatedData);
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