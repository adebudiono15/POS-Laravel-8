<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penjualan extends Model
{
    use HasFactory;
    protected $table = 'penjualan';
    protected $guarded = [];


    public function lines()
    {
        return $this->hasMany('App\Models\PenjualanLine', 'penjualan');
    }

    public function riwayat()
    {
        return $this->hasMany('App\Models\HistoryPiutang', 'penjualan');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
