<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use NunoMaduro\Collision\Adapters\Phpunit\Printer;
use RealRashid\SweetAlert\Facades\Alert;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        
        $user = User::where('cekLevel', 'teknisi')->get();
        $printer = Barang::where('jenis', 'printer')->get();
        $komputer = Barang::where('jenis', 'komputer')->get();
        $i = 0;
        $l = 0;
        foreach ($komputer as $sum) {
            # code...
            if (Order::where('status', 'on proccess')->where('barang_id',$sum->id)) {
                # code...
                $i += 1;
            }
        }
        foreach ($printer as $sam) {
            if (Order::where('status', 'on proccess')->where('barang_id',$sam->id)){
                $l +=1;
            }
        }
        // return $komputer;
        return view('pages.dashboard', [
            'komputers' => $i,
            'printers' => $l,
            'users' => $user,
            'orders' => Order::orderBy('created_at','desc')->limit(10)->get(),
            ['printer' => Barang::where('jenis', 'printer')->count()]
        ]);
    }
}
