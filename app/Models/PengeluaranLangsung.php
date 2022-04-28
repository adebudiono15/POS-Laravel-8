<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengeluaranLangsung extends Model
{
    use HasFactory;
    protected $table = 'pengeluaran_tunai';
    protected $guarded = [];

    public function supplier(){
        return $this->belongsTo(Supplier::class, 'supplier_id');
    }
}
