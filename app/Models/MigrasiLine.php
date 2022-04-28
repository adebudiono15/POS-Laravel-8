<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MigrasiLine extends Model
{
    use HasFactory;
    protected $table = 'migrasi_line';
    protected $guarded = [];

    public function divisi(){
        return $this->belongsTo(Divisi::class, 'divisi_id');
        }

        public function barang(){
            return $this->belongsTo(Barang::class, 'nama_barang_id');
            }
}
