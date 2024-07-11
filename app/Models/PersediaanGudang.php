<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PersediaanGudang extends Model
{
  use HasFactory, SoftDeletes;
  protected $table = 'persediaan_gudang';
  protected $guarded = ['id'];

  public function persediaan_pelayanan()
  {
    return $this->hasMany(PersediaanPelayanan::class, 'persediaan_gudang_id');
  }
}
