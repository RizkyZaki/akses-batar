<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StokKeluar extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'persediaan_pelayanan_stok_keluar';
    protected $guarded = ['id'];
    public function persediaan_pelayanan()
    {
        return $this->belongsTo(PersediaanPelayanan::class, 'persediaan_pelayanan_id');
    }
}
