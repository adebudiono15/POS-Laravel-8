<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Divisi;
use App\Models\Migrasi;
use App\Models\MigrasiLine;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;

class MigrasiController extends Controller
{
    public function index()
    {
        $migrasi = Request::create('api/migrasi', 'GET');
        $response = json_decode(Route::dispatch($migrasi)->getContent());
        $migrasimasuk = Request::create('api/migrasimasuk', 'GET');
        $responsemigrasimasuk = json_decode(Route::dispatch($migrasimasuk)->getContent());
        $migrasikeluar = Request::create('api/migrasikeluar', 'GET');
        $responsemigrasikeluar = json_decode(Route::dispatch($migrasikeluar)->getContent());
        $divisi = Divisi::get();
        $barang = Barang::get();
        return view('master.migrasi.index', compact('response', 'divisi', 'barang', 'responsemigrasimasuk', 'responsemigrasikeluar'));
    }

    public function savemigrasi(Request $request)
    {
        try {
            $nama = $request->nama;
            $divisi = $request->divisi;
            $qty = $request->qty;

            // Find barang
            $barang = Barang::find($nama);

            // Kode
            $tanggal = date('Ymd');
            $nomor = date('sh');
            $kode = "M/$tanggal/$nomor";


            foreach ($nama as $e => $nm) {
                $data = [
                    'migrasi' => $kode,
                    'dari' => 'Marhaban Perfume 1',
                    'ke' => $divisi,
                    'nama' => $nm,
                    'qty' => $qty[$e],
                    'status' => 0,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ];
                DB::connection('mysql2')->table('migrasi_line')
                ->insert($data);
            }
            \Session()->flash('success');
            return redirect()->back();
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    public function updatesetuju(Request $request, $id)
    {
        DB::connection('mysql2')->table('migrasi_line')
        ->where('id',$id)
        ->update([
            'status'=> 1,
        ]);
        \Session()->flash('setujumigrasi');
        return redirect()->back();
    }
}
