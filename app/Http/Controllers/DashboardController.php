<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Penjualan;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $penjualanHarian = Penjualan::whereDate('created_at', date('Y-m-d'))->sum('keuntungan');
        $penjualanHarianCash = Penjualan::whereDate('created_at', date('Y-m-d'))->where('metode_pembayaran', 'Cash')->sum('keuntungan');
        $penjualanHarianBank = Penjualan::whereDate('created_at', date('Y-m-d'))->where('metode_pembayaran','!=', 'Cash')->sum('keuntungan');
        $penjualanBulanan = Penjualan::whereMonth('created_at', date('m'))->sum('keuntungan');
        $penjualanTimeLine = Penjualan::orderby('created_at', 'desc')->take(5)->get();
        $chartBulanan = DB::select('select sum(grand_total) AS jumlah, MONTH(created_at) AS bulan FROM penjualan GROUP BY MONTH(created_at) ORDER BY created_at DESC LIMIT 12');
        $chartHarian = DB::select('select sum(grand_total) AS jumlah, DAY(created_at) AS tanggal FROM penjualan GROUP BY DAY(created_at) ORDER BY created_at ASC');
        return View('dashboard', compact('chartBulanan','chartHarian','penjualanHarian','penjualanBulanan','penjualanTimeLine','penjualanHarianCash','penjualanHarianBank'));
    }
}
