<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Transaksi extends Model
{
    use HasFactory;

    protected $table = 'transaksi';
    protected $primaryKey = 'id_transaksi';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = ['id_pelanggan', 'id_kendaraan', 'tgl_sewa', 'lama_sewa', 'total_bayar', 'status_pembayaran'];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            if (empty($model->id_transaksi)) {
                $model->id_transaksi = (string) Str::uuid();
            }
        });
    }

    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class, 'id_pelanggan', 'id_pelanggan');
    }

    public function kendaraan()
    {
        return $this->belongsTo(Kendaraan::class, 'id_kendaraan', 'id_kendaraan');
    }

    public function pengembalian()
    {
        return $this->hasOne(Pengembalian::class, 'id_transaksi', 'id_transaksi');
    }
}
