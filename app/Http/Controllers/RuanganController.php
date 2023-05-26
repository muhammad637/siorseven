<?php

namespace App\Http\Controllers;

use App\Models\Ruangan;
use Illuminate\Http\Request;

class RuanganController extends Controller
{
    //
    public function index(){
        return 'ini index ruangan';
    }
    public function store(Request $request){
        return 'ini post ruangan';
    }
    public function ruanganAktif(Request $request, Ruangan $ruangan){
        return 'ini index ruangan';
    }
    public function ruanganNonaktf(Request $request, Ruangan $ruangan){
        return 'ini index ruangan';
    }
}
