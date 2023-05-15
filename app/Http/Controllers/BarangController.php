<?php

namespace App\Http\Controllers;

use App\Models\Barang;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class BarangController extends Controller
{   public function index(){
    return view('auth.admin.master.barang', 
['barangs' => Barang::all()]);
}
    public function store(Request $request)
    {
        //membuat notifikasi
        // $notif = Notifikasi::notif('produk', 'data produk berhasil ditambahkan', 'tambah', 'berhasil');
        // validasi requestan
        $validatedData = $request->validate([
            'tipe' => 'required',
            'jenis' => 'required',
            'merk' => 'required',
        ]);
        // jika requestan tidak falid 

        try {
            // membuat pesan pada produk
            // membuat data pesan pada semua admin
           Barang::create($validatedData);
           return redirect()->back();
            // proses membuat product
        } catch (\Throwable $th) {
            return $th->getMessage();
            // peanganan jika error pada column tabel 
        }
    }
    public function update(Request $request, Barang $barang)
    {
        $request->validate([
            'tipe' => 'required',
            'jenis' => 'required',
            'merk' => 'required',
        ]);
        
        $barang->fill($request->post())->save();

        return redirect()->back()->with('success','Company Has Been updated successfully');
    }
  
    
}
