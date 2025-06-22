<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SalidaHasSuelas extends Model
{
    protected $table = 'salida_has_suelas';

    protected $fillable = [
        'idSuela',
        'idNumeracion',
        'cantidad'
    ];

    public function suela(){

        return $this->belongsTo( Suela::class, 'idSuela', 'id' );
        
    }
}
