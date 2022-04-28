<?php

namespace App\Http\Controllers\master;

use App\Models\Customer;
use App\Http\Controllers\Controller;
use App\Models\KategoriCustomer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;
use Validator;

class CustomerController extends Controller
{
    public function index()
    {
        $customer = Customer::get();
        $kategoriCustomer = KategoriCustomer::get();
        return view('master.customer.index', compact('customer','kategoriCustomer'));
    }

    public function listcustomer(){
        $customer = Customer::orderBy("nama", "asc")->get();
        return response()->json([
            'data'=> $customer
           ]);
    }

    public function save(Request $request)
    {
        $kategoriCustomer = KategoriCustomer::find($request->kategori);
        $validator = Validator::make($request->all(), 
        [
            'nama' => 'required',
            'telepon' => 'required',
            'contact_person' => 'required',
            'alamat' => 'required',
            'kategori' => 'required',
            'email' => 'nullable',
        ]);

        // Kode inv
        $firstInvoiceID = Customer::whereDay('created_at', date('d'))->count('id');
        $secondInvoiceID = $firstInvoiceID + 1;
        $nomor = sprintf("%03d", $secondInvoiceID);
        $tanggal = date('Ymd');
        $kode_customer = "CSMP1/$tanggal/$nomor";

        if ($validator->passes()) {
            $customer = new Customer;
            $customer->nama = $request->nama;
            $customer->kode_customer = $kode_customer;
            $customer->alamat = $request->alamat;
            $customer->telepon = $request->telepon;
            $customer->email = $request->email;
            $customer->contact_person = $request->contact_person;
            $customer->kategori = $kategoriCustomer->nama;
            $customer->jumlah_diskon = $kategoriCustomer->diskon;
            $customer->save();
            return response()->json(['success'=>200]);
        }
        return response()->json(['error'=>$validator->errors()->all()]);
    }


    public function edit($id)
    {
        $customer = Customer::find($id);
        $kategoriCustomer = KategoriCustomer::get();
        return view('master.customer.edit', compact('customer','kategoriCustomer'));
    }

    public function update(Request $request, $id)
    {
        $kategoriCustomer = KategoriCustomer::find($request->kategori);
        $validator = Validator::make($request->all(), 
        [
            'nama' => 'required',
            'telepon' => 'required',
            'contact_person' => 'required',
            'alamat' => 'required',
            'email' => 'nullable',
        ]);
        if($validator->passes()){
            Customer::where('id', $id)->update([
                'nama' => $request->nama,
                'alamat' => $request->alamat,
                'telepon' => $request->telepon,
                'email' => $request->email,
                'contact_person' => $request->contact_person,
                'kategori' => $kategoriCustomer->nama,
                'jumlah_diskon' => $kategoriCustomer->diskon,
            ]);
            return response()->json(['success'=>200]);
        }
        return response()->json(['error'=>$validator->errors()->all()]);
    }

    public function detail($id)
    {
        $customer = Customer::find($id);
        return view('master.customer.detail', compact('customer'));
    }

    public function delete($id)
    {
        DB::table('customer')->where('id', $id)->delete();
        return response()->json(['success'=>200]);
    }
}
