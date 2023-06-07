<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\MerkBarang;
use App\Models\Notifikasi;
use App\Models\TipeBarang;
use App\Models\JenisBarang;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Response;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;
// use Illuminate\Support\Facades\Validator;

class BarangController extends Controller
{
    public function index()
    {
        // $url = 'https://www.google.com';
        // $script = "<script>window.open('$url', '_blank');</script>";
        // return Response::make($script);
        return view(
            'auth.admin.master.barang',
            [
                'barangs' => Barang::orderBy('merk_id', 'asc')->get(),
                'jenis' => JenisBarang::orderBy('jenis', 'asc')->get(),
                'merks' => MerkBarang::orderBy('merk', 'asc')->get(),
                'tipes' => TipeBarang::orderBy('tipe', 'asc')->get(),
            ]
        );
    }

    public function rules(Request $request, $id)
    {
        // $id = $this->update('barang'); 
        // $id = Route::current()->parameter('barang');
        // Mengambil ID data barang dari URL
        return [
            'tipe_id' => [
                'required',
                Rule::unique('barangs')->ignore($id)->where(function ($query) use ($request) {
                    return $query->where('merk_id', $request->merk_id)
                        ->where('jenis_id', $request->jenis_id);
                }),
            ],
            'merk_id' => 'required',
            'jenis_id' => 'required',
        ];
    }


    public function store(Request $request)
    {

        try {
            $jenis_id = $request->jenis_id;
            $merk_id = $request->merk_id;
            $tipe_id = $request->tipe_id;
            if ($request->jenis_id == 'jenis_other') {
                $jenisData = $request->validate(['jenis' => 'required|unique:jenis_barangs']);
                JenisBarang::create($jenisData);
                $jenis_id = JenisBarang::latest()->first()->id;
            }
            if ($request->merk_id == 'merk_other') {
                $merkData = $request->validate(['merk' => 'required|unique:merk_barangs']);
                MerkBarang::create($merkData);
                $merk_id = MerkBarang::latest()->first()->id;
            }
            if ($request->tipe_id == 'tipe_other') {
                $tipeData = $request->validate(['tipe' => 'required|unique:tipe_barangs']);
                TipeBarang::create($tipeData);
                $tipe_id = MerkBarang::latest()->first()->id;
            }
            $barangs = Barang::all();
            foreach ($barangs as $b) {
                if ($b->tipe_id == $request->tipe_id && $b->jenis_id == $request->jenis_id && $b->merk_id == $request->merk_id) {
                    return redirect()->back()->with('error', 'barang sudah ada');
                }
            }
            // if($request->jenis_id == ){}
            Barang::create([
                'jenis_id' => $jenis_id,
                'merk_id' => $merk_id,
                'tipe_id' => $tipe_id
            ]);
            return redirect()->back()->with('success', 'data barang berhasil dibuat');
            // proses membuat product
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
            // peanganan jika error pada column tabel 
        }
    }
    public function update(Request $request, Barang $barang)
    {
        $jenis_id = $request->jenis_id;
        $merk_id = $request->merk_id;
        $tipe_id = $request->tipe_id;
        if ($request->jenis_id == 'jenis_other') {
            $jenisData = $request->validate(['jenis' => 'required|unique:jenis_barangs']);
            JenisBarang::create($jenisData);
            $jenis_id = JenisBarang::latest()->first()->id;
        }
        if ($request->merk_id == 'merk_other') {
            $merkData = $request->validate(['merk' => 'required|unique:merk_barangs']);
            MerkBarang::create($merkData);
            $merk_id = MerkBarang::latest()->first()->id;
        }
        if ($request->tipe_id == 'tipe_other') {
            $tipeData = $request->validate(['tipe' => 'required|unique:tipe_barangs']);
            TipeBarang::create($tipeData);
            $tipe_id = TipeBarang::latest()->first()->id;
        }

        // $validatedData = Validator::make(['jenis_id','merk_id','tipe_id'],[
        //     'jenis_id' 
        // ]);
        // if($request->current_barang == $barang->id){
        //     return 'sama';
        // }

        $validator = Validator::make($request->all(), $this->rules($request, $barang->id));

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $barang->update(['jenis_id' => $jenis_id, 'tipe_id' => $tipe_id, 'merk_id' => $merk_id]);
        return redirect()->back()->with('success', 'Barang berhasil di updated');
    }
}
