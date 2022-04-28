<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/migrasi', function(){
    $data = DB::connection('mysql2')->table('migrasi_line')->where('dari', 'Marhaban Perfume 1')->latest()->get();
    return $data;
});

Route::get('/migrasimasuk', function(){
    $data = DB::connection('mysql2')->table('migrasi_line')->where('ke', 'Marhaban Perfume 1')->where('status', 0)->latest()->get();
    return $data;
});

Route::get('/migrasikeluar', function(){
    $data = DB::connection('mysql2')->table('migrasi_line')->where('status', 1)->latest()->get();
    return $data;
});
