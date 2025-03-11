<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Suela extends Model
{
    protected $table = 'suelas';
    protected $fillable = ['nombre', 'precio', 'descripcion'];
}
