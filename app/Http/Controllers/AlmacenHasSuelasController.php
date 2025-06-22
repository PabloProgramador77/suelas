<?php

namespace App\Http\Controllers;

use App\Models\AlmacenHasSuelas;
use App\Models\Pedido;
use App\Models\Suela;
use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class AlmacenHasSuelasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            
            $suelas = Suela::select('suelas.id', 'suelas.nombre', 'suelas.color', 'suelas.descripcion', 'suelas.precio', 'almacen_has_suelas.idNumeracion', 'numeraciones.numeracion', 'almacen_has_suelas.stock')
                            ->join('almacen_has_suelas', 'suelas.id', '=', 'almacen_has_suelas.idSuela')
                            ->join('numeraciones', 'almacen_has_suelas.idNumeracion', '=', 'numeraciones.id')
                            ->where('almacen_has_suelas.stock', '>', 0)
                            ->get();

            $clientes = Cliente::all();

            return view('pedidos.almacen', compact('suelas', 'clientes'));

        } catch (\Throwable $th) {
            
            echo $th->getMessage();
            
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create( Request $request )
    {
        try {
            
            foreach( $request->suelas as $salida ){

                $registro = AlmacenHasSuelas::firstOrNew([

                    'idSuela' => $salida['suela'],
                    'idNumeracion' => $salida['numeracion'],

                ]);

                $registro->stock = $registro->stock - $salida['pares'];
                $registro->save();

            }

            return true;

        } catch (\Throwable $th) {
            
            echo $th->getMessage();

            return false;

        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            
            $pedido = Pedido::find($request->id);

            foreach ($pedido->suelas as $suela) {

                foreach ($suela->numeraciones as $numeracion) {

                    $relaciones = $suela->paresNumeraciones($pedido->id, $suela->id, $numeracion->id)->get();

                    $cantidad = $relaciones->sum(function ($item) {
                        return $item->pivot->cantidad;
                    });

                    if ($cantidad > 0) {
                        $registro = AlmacenHasSuelas::firstOrNew([
                            'idSuela' => $suela->id,
                            'idNumeracion' => $numeracion->id,
                        ]);

                        $registro->stock = ($registro->stock ? $registro->stock : 0) + $cantidad;
                        $registro->save();
                    }
                }
            }

        } catch (\Throwable $th) {
            
            echo $th->getMessage();

        }
    }

    /**
     * Display the specified resource.
     */
    public function show(AlmacenHasSuelas $almacenHasSuelas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AlmacenHasSuelas $almacenHasSuelas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AlmacenHasSuelas $almacenHasSuelas)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        try {
            


        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}
