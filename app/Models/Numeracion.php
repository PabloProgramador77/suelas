<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Numeracion extends Model
{
    protected $table = 'numeraciones';

    protected $fillable = [
        'numeracion',
        'descripcion',
    ];
}
