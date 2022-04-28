<?php

namespace App\Http\Controllers;

use App\Models\PembelianKredit;
use Illuminate\Http\Request;

class HutangController extends Controller
{
   public function index(){
       $hutang = PembelianKredit::get();
       return view('master.hutang.index',compact('hutang'));
   }
}
