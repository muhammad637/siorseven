<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Barang;
use App\Models\Notifikasi;
use App\Models\Order;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Carbon\Carbon;


class OrderController extends Controller
{
    public function index()
    {
        // Alert::alert('Title', 'Message', 'Type');
        return view('auth.admin.pages.order', [
            'barangs' => Barang::all(),
            'users' => User::where('cekLevel', 'teknisi')->get(),
            'orders' => Order::where('status', null)->orWhere('status', 'on progress')->get(),
            'parse' => function ($date) {
                return Carbon::parse($date)->format('d-m-Y');
            }
        ])->with('success', 'tes');
    }

    public function store(Request $request)
    {


        $validatedData = $request->validate([
            'barang_id' => 'required',
            'pesan_kerusakan' => 'required',
            'user_id' => 'required',
            'tanggal_order' => ''
        ]);
        $validatedData['tanggal_order'] = now()->format('d-m-Y');
        $barang = Barang::find($request->barang_id);
        $teknisi = User::find($request->user_id);
        try {
            Order::create($validatedData);
            Notifikasi::create(['pesan' => "orderan dari " . auth()->user()->nama . "berhasil dibuat untuk teknisi : $request->id"]);
            Alert::success('success',"orderan barang $barang->jenis ".$barang->merk->merk." $barang->tipe dari " . auth()->user()->nama . " berhasil dibuat untuk teknisi : $teknisi->nama dengan pesan kerusakan $request->pesan_kerusakan");
            return redirect()->back();
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    public function update(Request $request, Order $order)
    {
        $validatedData = $request->validate([
            'status' => 'required',
            'pesan_status' => 'required',
            'tanggal_selesai' => 'required',
        ]);
        // $validatedData = ['tanggal_selesai' => Carbon::parse('25-8-2022')->format('d-m-Y')];
        try {
            //code...
            $order->update($validatedData);
            return redirect()->back();
        } catch (\Throwable $th) {
            //throw $th;
            return $th->getMessage();
        }
    }
}
