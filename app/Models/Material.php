<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    protected $table = 'materiales';
    protected $fillable = ['nombre', 'precio', 'descripcion', 'unidad'];

    public function proveedores()
    {
        return $this->belongsToMany(Proveedor::class, 'proveedor_has_materiales', 'idMaterial', 'idProveedor');
    }
}
