<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PersediaanPelayanan extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'persediaan_pelayanan';
    protected $guarded = ['id'];
    public function stock_out()
    {
        return $this->belongsTo(StokKeluar::class, 'persediaan_pelayanan_id');
    }
}
