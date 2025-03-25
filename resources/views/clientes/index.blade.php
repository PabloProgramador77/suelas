@extends('home')
@section('contenido')
    <div class="container-fluid overflow-auto">
        <div class="container-fluid row rounded mb-2">
            <div class="col-lg-5">
                <h4 class="fw-semibold mt-3"><i class="fas fa-smile"></i> Clientes</h4>
                <small class="fw-semibold p-1 m-0 text-secondary">Elige el cliente a gestionar o agrega uno nuevo con el botón <b class="text-primary border rounded bg-success p-1"><i class="fas fa-plus"></i></b></small>
            </div>
            <div class="col-lg-6 p-1">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-chevron p-3 bg-body-tertiary">
                        <li class="breadcrumb-item">
                            <a class="link-body-emphasis" href="/home">
                                Inicio
                                <i class="fas fa-home"></i>
                            </a>
                        </li>
                        
                        <li class="breadcrumb-item active">
                            Clientes
                            <i class="fas fa-smile"></i>
                        </li>
                    </ol>
                </nav>
            </div>
            <div class="col-lg-1">
                <button class="btn btn-success mt-3 shadow" data-toggle="modal" data-target="#nuevoCliente"><i class="fas fa-plus" ></i></button>
            </div>
        </div>
        <div class="container-fluid row rounded bg-white mt-1 p-2">
            <div class="col-lg-12 col-md-6 col-sm-6">
                @php
                    $heads = ['Cliente', 'Correo electrónico', 'Telefono', 'RFC', 'Saldo', 'Opciones'];
                @endphp
                <x-adminlte-datatable id="contenedorClientes" theme="light" head-theme="dark" :heads="$heads" compressed striped hoverable beautify>
                    @if( count( $clientes) > 0 )
                        @foreach( $clientes as $cliente )
                            <tr>
                                <td>{{ $cliente->nombre }}</td>
                                <td>{{ ($cliente->email ? $cliente->email : 'Sin email') }}</td>
                                <td>{{ $cliente->telefono ? $cliente->telefono : 'Sin telefono' }}</td>
                                <td>{{ $cliente->rfc ? $cliente->rfc : 'Sin RFC' }}</td>
                                <td><span class="bg-success rounded p-1">$ {{ number_format( $cliente->saldo, 1 ) }}</span></td>
                                <td>
                                    <button class="btn shadow border border-primary editar" data-value="{{ $cliente->id }}, {{ $cliente->nombre }}, {{ $cliente->email }}, {{ $cliente->telefono }}, {{ $cliente->direccion }}, {{ $cliente->rfc }}" data-toggle="modal" data-target="#editarCliente" title="Editar cliente"><i class="fas fa-edit"></i></button>
                                    <button class="btn shadow border border-danger borrar" data-value="{{ $cliente->id }}, {{ $cliente->nombre }}"><i class="fas fa-trash" title="Eliminar cliente"></i></button>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="5" class="text-info fw-bold text-center">No hay clientes registrados <i class="fas fa-exclamation-circle"></i></td>
                        </tr>
                    @endif
                </x-adminlte-datatable>
            </div>
        </div>
    </div>

    @include('clientes.nuevo')
    @include('clientes.editar')

    <script src="{{ asset('js/jquery-3.7.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/sweetAlert.js') }}" type="text/javascript"></script>
    <script src="{{ asset('/js/clientes/create.js') }}" type="text/javascript"></script>
    <script src="{{ asset('/js/clientes/read.js') }}" type="text/javascript"></script>
    <script src="{{ asset('/js/clientes/update.js') }}" type="text/javascript"></script>
    <script src="{{ asset('/js/clientes/delete.js') }}" type="text/javascript"></script>
@stop