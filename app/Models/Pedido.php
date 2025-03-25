<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    protected $table = 'pedidos';

    protected $fillable = [
        'idCliente',
        'total',
        'estado',
    ];

    public function suelas(){
        
        return $this->belongsToMany( Suela::class, 'pedido_has_suelas', 'idPedido', 'idSuela')->withPivot('pares', 'importe');

    }

    public function cliente(){

        return $this->belongsTo( Cliente::class, 'idCliente');
        
    }
}
