<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PersediaanRutin extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'persediaan_rutin';
    protected $guarded = ['id'];
}
