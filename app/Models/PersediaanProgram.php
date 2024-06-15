<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PersediaanProgram extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'persediaan_program';
    protected $guarded = ['id'];
}
