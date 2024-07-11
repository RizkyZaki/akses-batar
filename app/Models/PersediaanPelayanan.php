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
  protected $with = ['persediaan_gudang'];
  public function persediaan_gudang()
  {
    return $this->belongsTo(PersediaanGudang::class, 'persediaan_gudang_id');
  }
  public function stock_out()
  {
    return $this->hasMany(StokKeluar::class, 'persediaan_pelayanan_id');
  }
}
