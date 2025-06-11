<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SuelaHasNumeraciones extends Model
{
    protected $table = 'suela_has_numeraciones';

    protected $fillable = [
        'idSuela',
        'idNumeracion',
    ];

    public function suela(){
        return $this->belongsTo( Suela::class, 'id', 'idSuela');
    }

    public function numeracion(){
        return $this->belongsTo( Numeracion::class, 'id', 'idNumeracion' );
    }
}
