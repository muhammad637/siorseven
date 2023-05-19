<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HistoryController extends Controller
{
    //
    public function index(){
        $history = Order::where('status','selesai')->orderBy('updated_at','desc')->get();
        if (auth()->user()->cekLevel == 'teknisi') {
            # code...
            $history = Order::where('user_id', auth()->user()->id)->where('status','selesai')->orderBy('updated_at','desc')->get();
        }
        return $history;
    }
}
