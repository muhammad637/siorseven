<?php

namespace App\Http\Controllers;

use App\Models\Ruangan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;

class RuanganController extends Controller
{
    //
    public function index(){
        $ruangan = Ruangan::all();
        return view('auth.admin.master.ruangan', [
            'ruangans' => Ruangan::orderBy('nama', 'asc')->get(),
        ]);
    }
    public function store(Request $request){
        $validateData = $request->validate([
            'nama' => 'required',
            'no_ruangan' => '',
        ]);
        try {
            //code...
            Ruangan::create($validateData);
            Alert::success('berhasil menambahkan data');
            return redirect()->back();
        } catch (\Throwable $th) {
            //throw $th;
            return $th->getMessage();
        }
    }
    public function update(Request $request, Ruangan $ruangan){
        $validateData = $request->validate([
            'nama' => 'required',
            'no_hp' => 'required',
        ]);
        try {
            //code...
            $ruangan->update($validateData);
            Alert::success('berhasil update data');
            return redirect()->back();
        } catch (\Throwable $th) {
            //throw $th;
            return $th->getMessage();
        }
    }
    public function ruanganAktif(Ruangan $ruangan)
    {
        $status = 'aktif';
        // Barang::where('id', $ruangan->id)->update(['status' => $status]);
        $ruangan->update(['status' => $status]);
        return redirect()->back()->with('toast_success', 'berhasil aktifkan ruangan' . $ruangan->nama );
    }
    public function ruanganNonaktif(Ruangan $ruangan)
    {
        $status = 'nonaktif';
        // Barang::where('id', $ruangan->id)->update(['status' => $status]);
        $ruangan->update(['status' => $status]);
        return redirect()->back()->with('toast_success', 'berhasil nonaktifkan ruangan' . $ruangan->nama );
    }
}
