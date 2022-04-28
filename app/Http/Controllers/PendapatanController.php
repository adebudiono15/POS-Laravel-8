<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\PendapatanBank;
use App\Models\PendapatanLangsung;
use Illuminate\Http\Request;

class PendapatanController extends Controller
{
    public function index(){
        $pendapatanlangsung = PendapatanLangsung::orderBy('created_at', 'desc')->get();
        $pendapatanbank = PendapatanBank::orderBy('created_at', 'desc')->get();

        return view('master.pendapatan.index',compact('pendapatanlangsung', 'pendapatanbank'));
    }

    public function detailpendapatanlangsung($id){
        $pendapatanlangsung = PendapatanLangsung::find($id);
        $kode_customer = $pendapatanlangsung->customer_id;
        $customer = Customer::find($kode_customer);
        return view('master.pendapatan.detailpendapatanlangsung', compact('pendapatanlangsung','customer'));
    }

    public function detailpendapatanbank ($id){
        $pendapatanbank = PendapatanBank::find($id);
        $kode_customer = $pendapatanbank->customer_id;
        $customer = Customer::find($kode_customer);
        return view('master.pendapatan.detailpendapatanbank', compact('pendapatanbank','customer'));
    }
}
