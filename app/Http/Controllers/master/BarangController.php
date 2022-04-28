<?php

namespace App\Http\Controllers\master;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Models\Kategori;
use App\Models\Satuan;
use App\Models\Supplier;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;
use Validator;

class BarangController extends Controller
{
    public function index()
    {
        $barang = Barang::get();
        $supplier = Supplier::get();
        $satuan = Satuan::get();
        $kategori = Kategori::get();

        return view('master.barang.index', compact('barang', 'satuan', 'supplier', 'kategori'));
    }

    public function listbarang(){
        $barang = Barang::orderBy("kategori_id", "asc")->get();
        return response()->json([
            'data'=> $barang
           ]);
    }

    public function save(Request $request)
    {
        $validator = Validator::make($request->all(), 
        [
            'nama' => 'required',
            'satuan' => 'required',
            'kategori' => 'required',
            'supplier' => 'required',
            'harga_beli' => 'required',
            'harga_jual' => 'required',
            'stock' => 'required',
        ]);
        // Co harga beli
        $hargabelisementara = $request->harga_beli;
        $harga_beli = str_replace([".", "Rp", " "], '', $hargabelisementara);
        // co harga jual
        $hargajualsementara = $request->harga_jual;
        $harga_jual = str_replace([".", "Rp", " "], '', $hargajualsementara);
        $stock_sem = $request->stock;
        $stock = str_replace([".", "Rp", " "], '', $stock_sem);
        // kode barang
        $firstInvoiceID = Barang::count('id');
        $secondInvoiceID = $firstInvoiceID + 1;
        $nomor = sprintf("%05d", $secondInvoiceID);
        $kode = "BMP1$nomor";

        if ($validator->passes()) {
            if ($request->kategori == "Refil Parfum") {   
                    DB::table('barang')->insertGetId([
                    'nama_barang' => $request->nama,
                    'kode_barang' => $kode,
                    'kategori_id' =>  $request->kategori,
                    'satuan_id' => $request->satuan,
                    'stock' => $stock,
                    'supplier_id' =>  $request->supplier,
                    'harga_beli' => 0,
                    'harga_jual' => 0,
                    'hb1' => $harga_beli,
                    'hb100' => $harga_beli * 100,
                    'hb250' => $harga_beli * 250,
                    'hb500' => $harga_beli * 500,
                    'hb1l' => $harga_beli * 1000,
                    'hj1' => $harga_jual,
                    'hj100' => $harga_jual * 100,
                    'hj250' => $harga_jual * 250 - 10000,
                    'hj500' => $harga_jual * 500 - 25000,
                    'hj1l' => $harga_jual * 1000 - 50000,
                    'status' => 1,
                ]);
            } else {
                DB::table('barang')->insertGetId([
                    'nama_barang' => $request->nama,
                    'kode_barang' => $kode,
                    'satuan_id' => $request->satuan,
                    'stock' => $stock,
                    'kategori_id' =>  $request->kategori,
                    'supplier_id' => $request->supplier,
                    'harga_beli' => $harga_beli,
                    'harga_jual' => $harga_jual,
                    'hb1' => 0,
                    'hb100' => 0,
                    'hb250' => 0,
                    'hb500' => 0,
                    'hb1l' => 0,
                    'hj1' => 0,
                    'hj100' => 0,
                    'hj250' => 0,
                    'hj500' => 0,
                    'hj1l' => 0,
                    'status' => 2,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]);
            }
            return response()->json(['success'=>200]);
        }
        return response()->json(['error'=>$validator->errors()->all()]);
    }

    public function delete($id)
    {
        DB::table('barang')->where('id', $id)->delete();
        return response()->json(['success'=>200]);
    }

    public function edit($id)
    {
        $barang = Barang::find($id);
        $satuan = Satuan::get();
        $supplier = Supplier::get();
        return view('master.barang.edit', compact('barang','satuan','supplier'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), 
        [
            'nama_barang' => 'required',
            'harga_beli' => 'required',
            'harga_jual' => 'required',
            'stock' => 'required',
            'satuan' => 'required',
            'supplier' => 'required',
        ]);
        // Co harga beli
        $hargabelisementara = $request->harga_beli;
        $harga_beli = str_replace([".", "Rp", " "], '', $hargabelisementara);
        // co harga jual
        $hargabelisementara = $request->harga_jual;
        $harga_jual = str_replace([".", "Rp", " "], '', $hargabelisementara);
        // stok
        $stock_sem = $request->stock;
        $stock = str_replace([".", "Rp", " "], '', $stock_sem);

        if ($validator->passes()) {
            if ($request->kategori_id == "Refil Parfum") {
                Barang::where('id', $id)->update([
                    'nama_barang' => $request->nama_barang,
                    'hb1' => $harga_beli,
                    'hb100' => $harga_beli * 100,
                    'hb250' => $harga_beli * 250,
                    'hb500' => $harga_beli * 500,
                    'hb1l' => $harga_beli * 1000,
                    'hj1' => $harga_jual,
                    'hj100' => $harga_jual * 100,
                    'hj250' => $harga_jual * 250 - 10000,
                    'hj500' => $harga_jual * 500 - 25000,
                    'hj1l' => $harga_jual * 1000 - 50000,
                    'stock' => $stock,
                    'satuan_id' => $request->satuan,
                    'supplier_id' => $request->supplier
                ]);
            } else {
                Barang::where('id', $id)->update([
                    'nama_barang' => $request->nama_barang,
                    'harga_beli' => $harga_beli,
                    'harga_jual' => $harga_jual,
                    'stock' => $stock,
                    'satuan_id' => $request->satuan,
                    'supplier_id' => $request->supplier
                ]);
            }
            return response()->json(['success'=>200]);
        }
        return response()->json(['error'=>$validator->errors()->all()]);
    }
}
