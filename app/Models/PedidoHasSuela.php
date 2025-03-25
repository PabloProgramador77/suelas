<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PedidoHasSuela extends Model
{
    protected $table = 'pedido_has_suelas';

    protected $fillable = [
        'idPedido',
        'idSuela',
        'pares',
        'importe',
    ];

    public function pedido(){

        return $this->belongsTo( Pedido::class, 'idPedido');
        
    }

    public function suela(){

        return $this->belongsTo(Suela::class, 'idSuela');

    }
}
