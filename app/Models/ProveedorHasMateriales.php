<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProveedorHasMateriales extends Model
{
    protected $table = 'proveedor_has_materiales';
    protected $fillable = ['idProveedor', 'idMaterial'];

    public function proveedor()
    {
        return $this->belongsTo(Proveedor::class, 'idProveedor');
    }

    public function material()
    {
        return $this->belongsTo(Material::class, 'idMaterial');
    }
}
