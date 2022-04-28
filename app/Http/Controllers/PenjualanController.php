<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use App\Models\Customer;
use App\Models\HistoryPiutang;
use App\Models\PendapatanBank;
use App\Models\PendapatanLangsung;
use App\Models\Penjualan;
use App\Models\PenjualanKredit;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;
use PDF;

class PenjualanController extends Controller
{
    public function index()
    {
        $penjualan_langsung = Penjualan::where('metode_pembayaran', 'Cash')->orderBy('created_at', 'desc')->get();
        $penjualan_bank = Penjualan::where('metode_pembayaran', '!=', 'Cash')->orderBy('created_at', 'desc')->get();
        $awal = date('Y-m-d');
        $akhir =  date('Y-m-d', strtotime('+1 days'));
        $total_penjualan = Penjualan::whereDate('created_at', '>=', $awal)->whereDate('created_at', '<=', $akhir)->sum('grand_total');

        return view('master.penjualan.index', compact('penjualan_langsung', 'penjualan_bank','awal','akhir'));
    }

    public function filter(Request $request)
    {
        $awal = date('Y-m-d', strtotime($request->awal));
        $akhir = date('Y-m-d', strtotime($request->akhir));
        $total_penjualan_langsung = Penjualan::whereDate('created_at', '>=', $awal)->whereDate('created_at', '<=', $akhir)->where('metode_pembayaran', 'Cash')->sum('grand_total');
        $total_penjualan_kredit = Penjualan::whereDate('created_at', '>=', $awal)->whereDate('created_at', '<=', $akhir)->where('metode_pembayaran', '!=', 'Cash')->sum('grand_total');
        $penjualan_langsung = Penjualan::whereDate('created_at', '>=', $awal)->whereDate('created_at', '<=', $akhir)->where('metode_pembayaran', 'Cash')->orderBy('created_at', 'desc')->get();
        $penjualan_bank = Penjualan::whereDate('created_at', '>=', $awal)->whereDate('created_at', '<=', $akhir)->where('metode_pembayaran', '!=', 'Cash')->orderBy('created_at', 'desc')->get();
        return view('master.penjualan.filter', compact('penjualan_langsung', 'penjualan_bank','awal','akhir','total_penjualan_langsung','total_penjualan_kredit'));
    }

    public function detailPenjualanLangsung($id)
    {

        $penjualan_langsung = Penjualan::find($id);
        return view('master.penjualan.detailPenjualanLangsung', compact('penjualan_langsung'));
    }
    public function detailPenjualanKredit($id)
    {
        $bank = Bank::get();
        $penjualan_kredit = PenjualanKredit::find($id);
        return view('master.penjualan.detailPenjualanKredit', compact('penjualan_kredit', 'bank'));
    }

    public function deletePenjualanLangsung($id)
    {
        DB::table('penjualan')->where('id', $id)->delete();
        Session::flash('delete');
        return redirect()->back();
    }
    public function deletePenjualanKredit($id)
    {
        DB::table('penjualan_kredit')->where('id', $id)->delete();
        Session::flash('delete');
        return redirect()->back();
    }


    public function update(Request $request)
    {
        $customer = $request->customer;
        $nama_customer = Customer::find($customer);
        $metode = $request->metode;
        $bank = $request->bank;
        $total_sisa = $request->total_sisa;
        $bayar_sementara = $request->bayar;
        $bayar = str_replace([".", "Rp", " "], '', $bayar_sementara);
        $id_piutang = $request->id;

        // Kode inv
        $firstInvoiceID = HistoryPiutang::whereDay('created_at', date('d'))->count('id');
        $secondInvoiceID = $firstInvoiceID + 1;
        $nomor = sprintf("%03d", $secondInvoiceID);
        $tanggal = date('Ymd');
        $kode_piutang = "MPMP1/INV/PNJ-K/$tanggal/$nomor";

        if (!$bayar) {
            return response()->json(['status' => 'Bayar Dulu Dong!']);
        }
        if (!$metode) {
            return response()->json(['status' => 'Masukan Metode Pembayaran Dulu YA!']);
        }
        if ($metode != 'Cash' && $bank == '') {
            return response()->json(['status' => 'Mau ' . $metode . ' Kemana? Isi Bank-nya Dulu Dong!']);
        }
        $pj = PenjualanKredit::find($id_piutang);
        $sisa = $pj->sisa;
        $data = $sisa - $bayar;
        if ($bayar > $sisa) {
            return response()->json(['status' => 'Kelebihan Bayarnya...']);
        }
        PenjualanKredit::where('id', $id_piutang)->update([
            'sisa' => $data
        ]);
        HistoryPiutang::insert([
            'penjualan_kredit' => $id_piutang,
            'kode_piutang' =>  $kode_piutang,
            'metode' => $metode,
            'total_pembayaran' =>  $bayar,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        if ($metode != 'Cash') {
            PendapatanBank::insert([
                'kode_pendapatan_bank' => $kode_piutang,
                'tanggal' => date('Y-m-d'),
                'jenis_pendapatan' => "Pendapatan Piutang",
                'keterangan' => 'Transfer ' . $nama_customer->nama,
                'customer_id' => $customer,
                'bank' => $bank,
                'jumlah_pendapatan' =>  $bayar,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]);
        } else {
            PendapatanBank::insert([
                'kode_pendapatan_bank' => $kode_piutang,
                'tanggal' => date('Y-m-d'),
                'jenis_pendapatan' => "Pendapatan Piutang",
                'keterangan' => 'Cash ' . $nama_customer->nama,
                'customer_id' => $customer,
                'bank' => '',
                'jumlah_pendapatan' =>  $bayar,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]);
        }
        return response()->json(['success' => 200]);
    }

    public function printpenjualan($id)
    {
        $penjualan_kredit = PenjualanKredit::find($id);
        $inv = $penjualan_kredit->no_struk;
        $pdf = \PDF::loadView('master.penjualan.print', compact('penjualan_kredit','inv'));
        return $pdf->stream($inv.'.pdf');
    }
}
