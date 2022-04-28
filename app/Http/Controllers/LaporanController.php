<?php

namespace App\Http\Controllers;

use App\Models\PenjualanLine;
use App\Models\Penjualan;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
   public function penjualan()
   {
       $penjualan_langsung = PenjualanLine::get();
       return view('laporan.penjualan', compact('penjualan_langsung'));
   }
}
