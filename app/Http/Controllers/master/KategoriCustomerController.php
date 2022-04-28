<?php

namespace App\Http\Controllers\master;

use App\Models\KategoriCustomer;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Validator;

class KategoriCustomerController extends Controller
{
    public function index()
    {
        $kategoriCustomer = KategoriCustomer::get();
        return view('master.kategoriCustomer.index', compact('kategoriCustomer'));
    }

    public function listkategoricustomer(){
        $kategoriCustomer = KategoriCustomer::orderBy("nama", "asc")->get();
        return response()->json([
            'data'=> $kategoriCustomer
           ]);
    }

    public function save(Request $request)
    {
        $validator = Validator::make($request->all(), 
        [
            'nama' => 'required',
            'diskon' => 'required',
        ]);
        if($validator->passes()){
        $kategori = new KategoriCustomer();
        $kategori->nama = $request->nama;
        $kategori->diskon = $request->diskon;
        $kategori->save();
        return response()->json(['success'=>200]);
    }
    return response()->json(['error'=>$validator->errors()->all()]);
    }

    public function delete($id)
    {
        KategoriCustomer::find($id);
        DB::table('kategori_customer')->where('id', $id)->delete();
        return response()->json(['success'=>200]);
    }

    public function edit($id)
    {
        $kategoriCustomer = KategoriCustomer::find($id);
        return view('master.kategoriCustomer.edit', compact('kategoriCustomer'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), 
        [
            'nama' => 'required',
        ]);
        if($validator->passes())
            KategoriCustomer::where('id', $id)->update([
                'nama' => $request->nama,
                'diskon' => $request->diskon,
            ]);
            return response()->json(['success'=>200]);
        return response()->json(['error'=>$validator->errors()->all()]);
    }
}
