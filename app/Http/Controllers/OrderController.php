<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Barang;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        //
        return view('auth.admin.pages.order', [
            
        ]);
    }
    public function createorder(){
        return view('auth.admin.pages.order', [
            'barangs' => Barang::all(),
            'title' => 'createOrder',
            'users' => User::where('cekLevel', 'teknisi')->get(),
      
        ]);
    }
    public function store(Request $request)
    {
        //membuat notifikasi
        // $notif = Notifikasi::notif('produk', 'data produk berhasil ditambahkan', 'tambah', 'berhasil');
        // validasi requestan
        
        $validatedData = $request->validate([
            'barang_id' => 'required',
            'pesan_kerusakan' => 'required',
            'user_id' => 'required',
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
}
