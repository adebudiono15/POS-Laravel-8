<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PembelianLine extends Model
{
    use HasFactory;

    protected $table = 'pembelian_line';
    protected $guarded = [];

    public function namas(){
        return $this->belongsTo(Barang::class, 'nama');
    }

    public function supplier(){
        return $this->belongsTo(Supplier::class, 'supplier_id');
    }
}
