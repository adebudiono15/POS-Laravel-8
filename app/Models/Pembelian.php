<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembelian extends Model
{
    use HasFactory;
    protected $table = 'pembelian';
    protected $guarded = [];


    public function lines(){
        return $this->hasMany('App\Models\PembelianLine','pembelian');
     }

     public function riwayat(){
        return $this->hasMany('App\Models\HistotyHutang','pembelian');
     }

     public function supplier(){
        return $this->belongsTo(Supplier::class, 'supplier_id');
     }
}
