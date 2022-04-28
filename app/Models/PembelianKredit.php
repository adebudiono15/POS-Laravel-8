<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PembelianKredit extends Model
{
    use HasFactory;
    protected $table = 'pembelian_kredit';
    protected $guarded = [];

    public function lines(){
        return $this->hasMany('App\Models\PembelianKreditLine','pembelian_kredit');
     }

     public function riwayat(){
        return $this->hasMany('App\Models\HistoryHutang','pembelian_kredit');
     }

     public function supplier(){
      return $this->belongsTo(Supplier::class, 'supplier_id');
   }
}
