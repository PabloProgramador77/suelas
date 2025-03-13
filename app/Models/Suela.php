<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Suela extends Model
{
    protected $table = 'suelas';
    protected $fillable = ['nombre', 'precio', 'descripcion'];

    public function materiales()
    {
        return $this->belongsToMany(Material::class, 'suela_has_materiales', 'idSuela', 'idMaterial')->withPivot('cantidad', 'descripcion', 'id', 'idMaterial');
    }
}
