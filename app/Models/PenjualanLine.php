<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenjualanLine extends Model
{
    use HasFactory;
    protected $table = 'penjualan_line';
    protected $guarded = [];

    public function namas(){
        return $this->belongsTo(Barang::class, 'nama');
    }

    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }
}
