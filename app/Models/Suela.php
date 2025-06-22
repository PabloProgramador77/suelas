<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Suela extends Model
{
    protected $table = 'suelas';
    protected $fillable = ['nombre', 'precio', 'descripcion', 'color', 'corrida', 'marca'];

    public function materiales()
    {
        return $this->belongsToMany(Material::class, 'suela_has_materiales', 'idSuela', 'idMaterial')->withPivot('cantidad', 'descripcion', 'id', 'idMaterial');
    }

    public function pedidos(){

        return $this->belongsToMany( Pedido::class, 'pedido_has_suelas', 'idPedido', 'idSuela');

    }

    public function numeraciones(){

        return $this->belongsToMany( Numeracion::class, 'suela_has_numeraciones', 'idSuela', 'idNumeracion');
        
    }

    public function paresNumeraciones( $idPedido, $idSuela, $idNumeracion ){

        return $this->belongsToMany( Numeracion::class, 'pedido_has_numeraciones', 'idSuela', 'idNumeracion')
                    ->wherePivot('idPedido', $idPedido)
                    ->wherePivot('idSuela', $idSuela)
                    ->wherePivot('idNumeracion', $idNumeracion)
                    ->withPivot('cantidad', 'idPedido');

    }
    
}
