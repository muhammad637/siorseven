<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Order;
use App\Models\Barang;
use App\Models\Ruangan;
use App\Models\Notifikasi;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;
use RealRashid\SweetAlert\Facades\Alert;


class OrderController extends Controller
{
    public function index()
    {
        $orders =  Order::where('user_id', auth()->user()->id)->where('status', null)->orWhere('status', 'on progress')->orderBy('created_at','desc')->get();
        $ruangans =  Ruangan::all();
        if (auth()->user()->cekLevel == 'admin') {
            $orders =  Order::where('status', null)->orWhere('status', 'on progress')->orderBy('created_at','desc')->get();
        }
        // return $orders;
        return view('auth.admin.pages.order', [
            'barangs' => Barang::all(),
            'users' => User::where('cekLevel', 'teknisi')->get(),
            'orders' => $orders,
            'ruangans' => $ruangans,
            'parse' => function ($date) {
                return Carbon::parse($date)->format('d-M-Y');
            }
        ]);
    }

    public function store(Request $request)
    {
        // validasi data
        $validatedData = $request->validate([
            'barang_id' => 'required',
            'pesan_kerusakan' => 'required',
            'user_id' => 'required',
            'tanggal_order' => '',
            'ruangan_id' => 'required'
        ]);
        $validatedData['tanggal_order'] = now()->format('Y-m-d');
        // ambil data barang dan teknisi
        $barang = Barang::find($request->barang_id);
        $teknisi = User::find($request->user_id);
        try {
            // create order
            Order::create($validatedData);

            // ambil data yang telah dibuat tadi
            $order = Order::latest()->first();

            // membuat pesan untuk notifikasi
            $pesan = "orderan dari dengan id $order->id : barang ".$order->barang->jenis->jenis." ".$order->barang->merk->merk." " . $order->barang->merk->merk." dari" .auth()->user()->nama . "berhasil dibuat untuk teknisi : $teknisi->nama";
            // pembuatan dan emanggilan fungsi notif di kelas Notifikasi
            $notif = Notifikasi::notif('order', $pesan, 'buat', 'berhasil');
            // create notifikasi buat teknisi dan admin
            Notifikasi::create($notif)->user()->attach($request->user_id);
            Notifikasi::create($notif)->user()->sync(User::adminId());
            // memunculkan sweetalert
            Alert::success('success', "orderan barang  ".$barang->jenis->jenis." " . $barang->merk->merk . " ".$barang->tipe->tipe. "dari " . auth()->user()->nama . " berhasil dibuat untuk teknisi : $teknisi->nama dengan pesan kerusakan $request->pesan_kerusakan");
            return redirect()->back();
            // return $order->user;
            // membuat langsung redirect ke whatsapp
            // $nohp = $order->user->no_telephone;
            // if (substr(trim($nohp), 0, 1) == '0') {
            //     $nohp = '62' . substr(trim($nohp), 1);
            // }
            // $url = "https://wa.me/".$nohp."/?text=SIORSEVEN%0Auntuk : ".$order->ruangan->nama."%0Aorderan barang dari barang ". $order->barang->jenis->jenis ." ". $order->barang->merk->merk ." ".  $order->barang->tipe->tipe ." mohon diambil ke ruang IT RSUD Blambangan Banyuwangi%0Adari Admin SIORSEVEN: " .auth()->user()->nama;
            // $script = "<script>window.open('$url', '_blank');</script>";
            // return Response::make($script);
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
            $pesan = "orderan dengan id $order->id barang ".$barang->jenis->jenis. " " . $barang->merk->merk ." " .$barang->tipe->tipe." berhasil diupdate oleh $teknisi->nama dengan perubahan status : $request->status";
            $notif = Notifikasi::notif('order', $pesan, 'update', 'berhasil');
            Notifikasi::create($notif)->user()->attach(auth()->user()->id);
            Notifikasi::create($notif)->user()->sync(User::adminId());
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
