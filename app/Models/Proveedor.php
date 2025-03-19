<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    
    protected $table = 'proveedores';
    protected $fillable = ['nombre', 'direccion', 'telefono', 'email', 'rfc', 'saldo'];

    public function materiales()
    {
        return $this->belongsToMany(Material::class, 'proveedor_has_materiales', 'idProveedor', 'idMaterial');
    }
}
