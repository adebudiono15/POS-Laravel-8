<?php

namespace App\Http\Controllers\master;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Validator;

class KategoriController extends Controller
{
    public function index()
    {
        $kategori = Kategori::get();
        return view('master.kategori.index', compact('kategori'));
    }

    public function listkategori(){
        $kategori = Kategori::orderBy("nama", "asc")->get();
        return response()->json([
            'data'=> $kategori
           ]);
    }

    public function save(Request $request)
    {
        $validator = Validator::make($request->all(), 
        [
            'nama' => 'required',
        ]);
        if($validator->passes()){
        $kategori = new Kategori;
        $kategori->nama = $request->nama;
        $kategori->save();
        return response()->json(['success'=>200]);
    }
    return response()->json(['error'=>$validator->errors()->all()]);
    }

    public function delete($id)
    {
        $data = Kategori::find($id);
        $nama = $data->nama;
        if($nama == 'Refil Parfum'){
            return response()->json(['error'=>'']);
        }else{
            DB::table('kategori')->where('id', $id)->delete();
            return response()->json(['success'=>200]);
        }
    }

    public function edit($id)
    {
        $kategori = Kategori::find($id);
        return view('master.kategori.edit', compact('kategori'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), 
        [
            'nama' => 'required',
        ]);
        if($validator->passes())
        if($request->old == 'Refil Parfum'){
            return  response()->json(['error'=>'']);
        }else{
            Kategori::where('id', $id)->update([
                'nama' => $request->nama,
            ]);
            return response()->json(['success'=>200]);
        }
        return response()->json(['error'=>$validator->errors()->all()]);
    }
}
