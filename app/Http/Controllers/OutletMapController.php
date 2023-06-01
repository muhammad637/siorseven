<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OutletMapController extends Controller
{
    //
    public function index(Request $request)
    {
        return view('outlets.map');
    }

}
