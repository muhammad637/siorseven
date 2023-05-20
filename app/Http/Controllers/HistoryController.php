<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Order;
use App\Models\Barang;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HistoryController extends Controller
{
    //
    public function index()
    {
        $history = Order::where('status', 'selesai')->orderBy('updated_at', 'desc')->get();
        $barang = Barang::orderBy('jenis', 'asc')->get();
        if (auth()->user()->cekLevel == 'teknisi') {
            # code...
            $history = Order::where('user_id', auth()->user()->id)->where('status', 'selesai')->orderBy('updated_at', 'desc')->get();
        }

        if (session()->has('history')) {
            # code...
            $history = session()->get('history');
        }
        return view('auth.admin.pages.history', [
            'historys' => $history,
            'barangs' => $barang,
        ]);
    }

    public function historyBulan(Request $request)
    {
        $bulan = Carbon::parse($request->bulan)->format('m');
        $tahun = Carbon::parse($request->bulan)->format('Y');
        $history = Order::whereMonth('created_at', $bulan)
            ->whereYear('created_at', $tahun)
            ->where('status', 'selesai')
            ->get();
        session()->flash('pageTitle', 'bulan');
        $byBulan = Carbon::parse($request->bulan)->format('M - Y');
        session()->flash('header', " history  bulan $byBulan");
        session()->flash('teks', "history pada bulan $byBulan ini masih kosong");
        session()->flash('history', 'tidak ada');
        if (count($history) > 0) {
            # code...
            session()->flash('history', $history);
            session()->flash('header', " List history Bulan $byBulan");
        }
        return redirect()->back();
        // return 'tes';
    }
    public function historyBarang(Request $request)
    {
        $barang = Barang::find($request->barang);
        return $barang;
        // $history = Order::whereNotNull('status')->where('barang_id', $request)->get();
        // session()->flash('header', " List laporan Barang $request->nama_ruangan");
        // session()->flash('teks', "orderan di ruangan $request->nama_ruangan masih kosong");
        // session()->flash('orders', 'tidak ada');
        // if (count($orders) > 0) {
        //     # code...
        //     $header = $orders[0]->ruangan->nama_ruangan;
        //     session()->flash('orders', $orders);
        // }
        // session()->flash('pageTitle', 'ruangan');
        // return redirect()->back();
    }
}
