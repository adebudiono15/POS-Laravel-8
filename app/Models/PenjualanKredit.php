<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenjualanKredit extends Model
{
    use HasFactory;
    protected $table = 'penjualan_kredit';
    protected $guarded = [];

    public function lines(){
        return $this->hasMany('App\Models\PenjualanKreditLine','penjualan_kredit');
     }

     public function riwayat(){
        return $this->hasMany('App\Models\HistoryPiutang','penjualan_kredit');
     }
}
