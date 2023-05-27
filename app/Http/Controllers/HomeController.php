<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Order;
use App\Models\Barang;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;
use NunoMaduro\Collision\Adapters\Phpunit\Printer;


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
        $barang = Barang::all()->count();
        $order = Order::where('status','on progress')->orWhere('status',null)->count();
        // return $komputer;
        return view('pages.dashboard', [
            'jumlahBarang' => $barang,
            'orderOnprogress' => $order,
            'users' => $user,
            'orders' => Order::orderBy('created_at','desc')->limit(10)->get(),
            'parse' => function ($date) {
                return Carbon::parse($date)->format('d-M-Y');}
        ]);
    }
}
