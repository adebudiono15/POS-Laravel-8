<?php

namespace App\Http\Controllers\master;

use App\Http\Controllers\Controller;
use App\Models\Satuan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;
use Validator;

class SatuanController extends Controller
{
    public function index(){
        $satuan = Satuan::get();
        return view('master.satuan.index', compact('satuan'));
    }
    public function listsatuan(){
        $satuan = Satuan::orderBy("nama", "asc")->get();
        return response()->json([
            'data'=> $satuan
           ]);
    }

    public function save(Request $request)
    {
        $validator = Validator::make($request->all(), 
        [
            'nama' => 'required',
        ]);
        if($validator->passes()){
            $satuan = new Satuan;
            $satuan->nama = $request->nama;
            $satuan->save();
            return response()->json(['success'=>200]);
        }
        return response()->json(['error'=>$validator->errors()->all()]);
    }

    public function delete($id)
    {
        DB::table('satuan')->where('id', $id)->delete();
        return response()->json(['success'=>200]);
    }

    public function edit($id)
    {
        $satuan = Satuan::find($id);
        return view('master.satuan.edit', compact('satuan'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), 
        [
            'nama' => 'required',
        ]);

        if($validator->passes()){
            Satuan::where('id', $id)->update([
                'nama' => $request->nama,
            ]);
            return response()->json(['success'=>200]);
        }
        return response()->json(['error'=>$validator->errors()->all()]);
    }
}
