<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PedidoHasNumeraciones extends Model
{
    protected $table = 'pedido_has_numeraciones';

    protected $fillable = [
        'idPedido',
        'idSuela',
        'idNumeracion',
        'cantidad',
    ];
}
