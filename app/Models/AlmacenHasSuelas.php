<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AlmacenHasSuelas extends Model
{
    protected $table = 'almacen_has_suelas';

    protected $fillable = [
        'idSuela',
        'idNumeracion',
        'stock',
    ];

    public function suela(){

        return $this->belongsTo( Suela::class, 'idSuela' );

    }

    /*public function stock( $idSuela, $idNumeracion ){

        return $this->belongsToMany( Numeracion::class, 'almacen_has_suelas', 'idSuela', 'idNumeracion')
                    ->wherePivot('idSuela', $idSuela)
                    ->wherePivot('idNumeracion', $idNumeracion)
                    ->withPivot('stock');
                    
    }*/

}
