<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Migrasi extends Model
{
    use HasFactory;
    protected $table = 'migrasi';
    protected $guarded = [];

    public function divisi(){
    return $this->belongsTo(Divisi::class, 'divisi_id');
    }

    public function barang(){
    return $this->belongsTo(Barang::class, 'barang_id');
    }
}
