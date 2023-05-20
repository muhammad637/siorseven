<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Order;
use App\Models\Barang;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Exports\OrderExport;
use Maatwebsite\Excel\Facades\Excel;


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
            session()->flash('header', " History Bulan $byBulan");
        }
        return redirect()->back();
        // return 'tes';
    }
    public function historyBarang(Request $request)
    {
        $barang = Barang::find($request->barang_id);
        $merk = $barang->merk->merk;
        $history = Order::where('status', 'selesai')->where('barang_id', $request->barang_id)->get();
        session()->flash('header', " History Barang $barang->jenis $merk $barang->tipe");
        // session()->flash('teks', "orderan di ruangan $request->nama_ruangan masih kosong");
        session()->flash('history', 'tidak ada');
        if (count($history) > 0) {
            # code...
            // $header = $history[0]->ruangan->nama_ruangan;
            session()->flash('history', $history);
        }
        session()->flash('pageTitle', 'ruangan');
        return redirect()->back();
    }


    public function exportAll()
    {
        $data = $this->dataLaporan(Order::whereNotNull('status')->orderBy('updated_at', 'desc')->get(), 'LIST LAPORAN');
        return $data;
    }
    public function exportBulan(Request $request)
    {
        $byBulan = Carbon::parse($request->bulan)->format('M Y');
        $bulan = Carbon::parse($request->bulan)->format('m');
        $tahun = Carbon::parse($request->bulan)->format('Y');
        $data = $this->dataLaporan(
            Order::whereMonth('created_at', $bulan)
                ->whereYear('created_at', $tahun)
                ->whereNotNull('status')
                ->get(),
            "LIST LAPORAN BULAN $byBulan"
        );
        return $data;
    }
    public function exportBarang(Request $request)
    {
        $order = Barang::find($request->barang_id);
        $namaBarang = $order->jenis.'-'.$order->merk->merk.''.$order->tipe;
        $data = $this->dataLaporan(
            Order::whereNotNull('status')->where('barang_id', $request->barang_id)->get(),
            "LIST LAPORAN BY RUANGAN $order->barang-"
        );
        return $data;
    }

    private function dataLaporan($orders, $judul = 'LIST LAPORAN')
    {

        $dataLaporan = [];
        foreach ($orders as $order) {
            array_push($dataLaporan, [
                'tanggal order' => Carbon::parse($order->tanggal_order)->format('d/M/Y'),
                'tanggal selesai' => Carbon::parse($order->tanggal_selesai)->format('d/M/Y'),
                'nama Teknisi' => $order->user->nama,
                'nama Barang' => $order->barang->jenis . "-" . $order->barang->merk->merk . " " . $order->barang->tipe,
                'pesan kerusakan' => $order->pesan_kerusakan,
                ($order->status == null) ? "pending" : "$order->status | $order->status_selesai",
                'pesan satus' => $order->pesan_status,
                // 'jumlah order' => $order->jumlah_order

            ]);
        }
        $laporan = new OrderExport([
            [$judul],
            ['tanggal order', 'tanggal selesai', 'nama Teknisi', 'nama barang', 'kerusakan', 'status', 'pesan status',],
            [...$dataLaporan]
        ]);
        return Excel::download($laporan, 'laporan.xlsx');
    }
}
