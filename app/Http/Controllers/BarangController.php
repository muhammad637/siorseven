<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\MerkBarang;
use App\Models\Notifikasi;
use App\Models\TipeBarang;
use App\Models\JenisBarang;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class BarangController extends Controller
{
    public function index()
    {
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
    public function store(Request $request)
    {
        //membuat notifikasi
        // $notif = Notifikasi::notif('produk', 'data produk berhasil ditambahkan', 'tambah', 'berhasil');
        // validasi requestan

        // jika requestan tidak falid 
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
            // membuat pesan pada produk
            // membuat data pesan pada semua admin
            Barang::create([
                'jenis_id' => $jenis_id,
                'merk_id' => $merk_id,
                'tipe_id' => $tipe_id
            ]);
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
            'tipe_id' => 'required',
            'jenis_id' => 'required',
            'merk_id' => 'required',
        ]);
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
        $barang->update(['jenis_id' => $jenis_id, 'tipe_id' => $tipe_id, 'merk_id' => $merk_id]);
        return redirect()->back()->with('success', 'Barang berhasil di updated');
    }
    public function nonaktif(Barang $barang)
    {
        //code...
        $status = 'nonaktif';
        // Barang::where('id', $barang->id)->update(['status' => $status]);
        $barang->update(['status' => $status]);
        return redirect()->back()->with('toast_success', 'berhasil nonaktifkan barang' . $barang->jenis->jenis . ' ' . $barang->merk->merk . '' . $barang->tipe->tipe);
    }
    public function aktif(Barang $barang)
    {
        $status = 'aktif';
        // Barang::where('id', $barang->id)->update(['status' => $status]);
        $barang->update(['status' => $status]);
        return redirect()->back()->with('toast_success', 'berhasil nonaktifkan barang' . $barang->jenis->jenis . ' ' . $barang->merk->merk . '' . $barang->tipe->tipe);
    }

    public function jenisAktif(JenisBarang $jenis)
    {
        $status = 'aktif';
        // Barang::where('id', $barang->id)->update(['status' => $status]);
        $jenis->update(['status' => $status]);
        return redirect()->back()->with('toast_success', 'berhasil nonaktifkan barang' . $jenis->jenis );
    }
    public function merkAktif(MerkBarang $merk)
    {
        $status = 'aktif';
        // Barang::where('id', $barang->id)->update(['status' => $status]);
        $merk->update(['status' => $status]);
        return redirect()->back()->with('toast_success', 'berhasil nonaktifkan barang' . $merk->merk );
    }
    public function tipeAktif(TipeBarang $tipe)
    {
        $status = 'nonaktif';
        // Barang::where('id', $barang->id)->update(['status' => $status]);
        $tipe->update(['status' => $status]);
        return redirect()->back()->with('toast_success', 'berhasil nonaktifkan barang' . $tipe->tipe );
    }
    public function jenisNonaktif(JenisBarang $jenis)
    {
        $status = 'nonaktif';
        // Barang::where('id', $barang->id)->update(['status' => $status]);
        $jenis->update(['status' => $status]);
        return redirect()->back()->with('toast_success', 'berhasil nonaktifkan barang' . $jenis->jenis );
    }
    public function merkNonaktif(MerkBarang $merk)
    {
        $status = 'nonaktif';
        // Barang::where('id', $barang->id)->update(['status' => $status]);
        $merk->update(['status' => $status]);
        return redirect()->back()->with('toast_success', 'berhasil nonaktifkan barang' . $merk->merk );
    }
    public function tipeNonaktif(TipeBarang $tipe)
    {
        $status = 'nonaktif';
        // Barang::where('id', $barang->id)->update(['status' => $status]);
        $tipe->update(['status' => $status]);
        return redirect()->back()->with('toast_success', 'berhasil nonaktifkan barang' . $tipe->tipe );
    }

    
}
