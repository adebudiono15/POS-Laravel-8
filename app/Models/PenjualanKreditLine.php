<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenjualanKreditLine extends Model
{
    use HasFactory;
    protected $table = 'penjualan_kredit_line';
    protected $guarded = [];

    public function namas(){
        return $this->belongsTo(Barang::class, 'nama');
    }
}
