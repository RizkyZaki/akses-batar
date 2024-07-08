<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Formularium extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'formularium';
    protected $guarded = ['id'];
}