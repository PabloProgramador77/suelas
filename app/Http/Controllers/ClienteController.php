<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;
use App\Http\Requests\Cliente\Create;
use App\Http\Requests\Cliente\Update;
use App\Http\Requests\Cliente\Delete;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            
            $clientes = Cliente::all();

            return view('clientes.index', compact('clientes'));

        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Create $request)
    {
        try {
            
            $cliente = Cliente::create([
                'nombre' => $request->nombre,
                'direccion' => $request->direccion,
                'telefono' => $request->telefono,
                'email' => $request->email,
                'rfc' => $request->rfc,
            ]);

            if( $cliente && $cliente->id ) {

                $datos['exito'] = true;

            }

        } catch (\Throwable $th) {
            
            $datos['exito'] = false;
            $datos['mensaje'] = $th->getMessage();

        } finally {

            return response()->json($datos);

        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Cliente $cliente)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cliente $cliente)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Update $request)
    {
        try {
            
            $cliente = Cliente::where('id', $request->id)->update([
                'nombre' => $request->nombre,
                'direccion' => $request->direccion,
                'telefono' => $request->telefono,
                'email' => $request->email,
                'rfc' => $request->rfc,
            ]);

            if( $cliente ) {

                $datos['exito'] = true;

            }

        } catch (\Throwable $th) {
            
            $datos['exito'] = false;
            $datos['mensaje'] = $th->getMessage();

        } finally {

            return response()->json($datos);

        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Delete $request)
    {
        try {
            
            $cliente = Cliente::find( $request->id);

            if( $cliente && $cliente->id){
                
                $cliente->delete();

                $datos['exito'] = true;

            }

        } catch (\Throwable $th) {
            
            $datos['exito'] = false;
            $datos['mensaje'] = $th->getMessage();

        } finally {

            return response()->json($datos);

        }
    }
}
