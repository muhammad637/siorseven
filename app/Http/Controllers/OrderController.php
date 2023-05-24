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
        // $user = User::with('notifikasi')->find(auth()->user()->id);
        // $notifikasi = $user->notifikasi()->orderBy('created_at','desc')->get();
        // return $notifikasi;
        // Alert::alert('Title', 'Message', 'Type');
        $orders =  Order::where('user_id', auth()->user()->id)->where('status', null)->orWhere('status', 'on progress')->get();
        if (auth()->user()->cekLevel == 'admin') {
            $orders =  Order::where('status', null)->orWhere('status', 'on progress')->get();
        }
        // return $orders;
        return view('auth.admin.pages.order', [
            'barangs' => Barang::all(),
            'users' => User::where('cekLevel', 'teknisi')->get(),
            'orders' => $orders,
            // 'parse' => function ($date) {
            //     return Carbon::parse($date)->format('d-m-Y');
            // }
        ]);
    }

    public function store(Request $request)
    {


        $validatedData = $request->validate([
            'barang_id' => 'required',
            'pesan_kerusakan' => 'required',
            'user_id' => 'required',
            'tanggal_order' => ''
        ]);
        $validatedData['tanggal_order'] = now()->format('Y-m-d');
        $barang = Barang::find($request->barang_id);
        $teknisi = User::find($request->user_id);
        try {
            Order::create($validatedData);
            $pesan = "orderan dari " . auth()->user()->nama . "berhasil dibuat untuk teknisi : $teknisi->nama";
            $notif = Notifikasi::notif('order', $pesan, 'buat', 'berhasil');
            // $notifikasi =  Notifikasi::create($notif);
            Notifikasi::create($notif)->user()->attach($request->user_id);
            Notifikasi::create($notif)->user()->sync(User::adminId());
            Alert::success('success', "orderan barang $barang->jenis " . $barang->merk->merk . " $barang->tipe dari " . auth()->user()->nama . " berhasil dibuat untuk teknisi : $teknisi->nama dengan pesan kerusakan $request->pesan_kerusakan");
            return redirect()->back();
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    public function update(Request $request, Order $order)
    {
        $barang = Barang::find($order->barang_id);
        $teknisi = User::find($order->user_id);
        $validatedData = $request->validate([
            'status' => 'required',
            'pesan_status' => 'required',
            'tanggal_selesai' => 'required',
        ]);
        // $validatedData = ['tanggal_selesai' => Carbon::parse('25-8-2022')->format('d-m-Y')];
        try {
            $pesan = ['pesan' => "orderan berhasil diupdate oleh $teknisi->nama dengan perubahan status : $request->status"];
            Notifikasi::create($pesan)->user()->attach($request->user_id);
            Notifikasi::create($pesan)->user()->sync(User::adminId());
            //code...
            $order->update($validatedData);
            if ($request->status == "selesai") {
                $order->update(['status_selesai' => $request->status_selesai]);
            }
            return redirect()->back();
        } catch (\Throwable $th) {
            //throw $th;
            return $th->getMessage();
        }
    }
}
