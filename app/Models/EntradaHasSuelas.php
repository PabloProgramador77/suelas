<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EntradaHasSuelas extends Model
{
    protected $table = 'entrada_has_suelas';

    protected $fillable = [
        'idSuela',
        'idNumeracion',
        'cantidad',
    ];

    public function suela(){

        return $this->belongsTo( Suela::class, 'idSuela' );

    }

    public function numeracion(){

        return $this->belongsTo( Numeracion::class, 'idNumeracion' );
        
    }
}
