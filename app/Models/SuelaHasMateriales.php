<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SuelaHasMateriales extends Model
{
    protected $table = 'suela_has_materiales';
    
    protected $fillable = [
        'idSuela',
        'idMaterial',
        'cantidad',
        'descripcion',
    ];
    
    public function suela()
    {
        return $this->belongsTo(Suela::class, 'idSuela', 'id');
    }
    
    public function material()
    {
        return $this->belongsTo(Material::class, 'idMaterial', 'id');
    }
}
