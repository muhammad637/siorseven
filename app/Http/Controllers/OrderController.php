<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Barang;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        //
        return view('auth.admin.pages.order', [
            'barangs' => Barang::all(),
            'users' => User::where('cekLevel', 'teknisi')->get(),
            'orders' => Order::where('status','')->orWhere('status','on progress')->get(),
        ]);
    }
    public function createorder(){
        return view('auth.admin.pages.order', [
            'barangs' => Barang::first(),
            'title' => 'createOrder',
            'users' => User::where('cekLevel', 'teknisi')->get(),
      
        ]);
    }
    public function store(Request $request)
    {
        //membuat notifikasi
        // $notif = Notifikasi::notif('produk', 'data produk berhasil ditambahkan', 'tambah', 'berhasil');
        // validasi requestan
        // dd($request->all());
        
        $validatedData = $request->validate([
            'barang_id' => 'required',
            'pesan_kerusakan' => 'required',
            'user_id' => 'required',
        ]);
        // jika requestan tidak falid 

        try {
            // membuat pesan pada produk
            // membuat data pesan pada semua admin
        //    Barang::create($validatedData);
           Order::create([...$validatedData,'tanggal_order' => date('Y-m-d')]);
           return redirect()->back();
            // proses membuat product
        } catch (\Throwable $th) {
            return $th->getMessage();
            // peanganan jika error pada column tabel 
        }
    }
}
