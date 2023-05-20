<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\MerkBarang;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    public function index()
    {
        return view(
            'auth.admin.master.barang',
            [
                'barangs' => Barang::orderBy('tipe', 'asc')->get(),
                'merks' => MerkBarang::orderBy('merk', 'asc')->get()
            ]
        );
    }
    public function store(Request $request)
    {
        //membuat notifikasi
        // $notif = Notifikasi::notif('produk', 'data produk berhasil ditambahkan', 'tambah', 'berhasil');
        // validasi requestan
        $validatedData = $request->validate([
            'tipe' => 'required',
            'jenis' => 'required',
        ]);
        // jika requestan tidak falid 
        try {
            $merk_id = $request->merk_id;
            if($request->merk_id == 'other'){
                $merkData = $request->validate(['merk' => 'required|unique:merk_barangs']);
                MerkBarang::create($merkData);
                $merk_id = MerkBarang::latest()->first()->id;
            }
            // membuat pesan pada produk
            // membuat data pesan pada semua admin
            Barang::create([...$validatedData, 'merk_id' => $merk_id]);
            return redirect()->back();
            // proses membuat product
        } catch (\Throwable $th) {
            return $th->getMessage();
            // peanganan jika error pada column tabel 
        }
    }
    public function update(Request $request, Barang $barang)
    {
       $validatedData =  $request->validate([
            'tipe' => 'required',
            'jenis' => 'required',
        ]);
        $merk_id = $request->merk_id;
        if($request->merk_id == 'other'){
            $merkData = $request->validate(['merk' => 'required|unique:merk_barangs']);
            MerkBarang::create($merkData);
            $merk_id = MerkBarang::latest()->first()->id;
        }
        $barang->update([...$validatedData, 'merk_id' => $merk_id]);
        return redirect()->back()->with('success', 'Company Has Been updated successfully');
    }
    public function nonaktif(Barang $barang)
    {
        //code...

        $status = 'nonaktif';

        Barang::where('id', $barang->id)->update(['status' => $status]);
        return redirect()->back()->with('toast_success');
    }
    public function aktif(Barang $barang)
    {
        $status = 'aktif';
        $barang->update(['status' => $status]);
        return redirect()->back()->with('toast_success');
    }
}
