@extends('home')
@section('contenido')
    <div class="container-fluid overflow-auto">
        <div class="container-fluid row rounded mb-2">
            <div class="col-lg-5">
                <h4 class="fw-semibold mt-3"><i class="fas fa-people-carry"></i> Proveedores</h4>
                <small class="fw-semibold p-1 m-0 text-secondary">Elige el proveedor a gestionar o agrega uno nuevo con el botón <b class="text-primary border rounded bg-success p-1"><i class="fas fa-plus"></i></b></small>
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
                        <li class="breadcrumb-item">
                            <a class="link-body-emphasis" href="/materiales">
                                Materiales
                                <i class="fas fa-box"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item active">
                            Proveedores
                            <i class="fas fa-people-carry"></i>
                        </li>
                    </ol>
                </nav>
            </div>
            <div class="col-lg-1">
                <button class="btn btn-success mt-3 shadow" data-toggle="modal" data-target="#nuevoProveedor"><i class="fas fa-plus" ></i></button>
            </div>
        </div>
        <div class="container-fluid row rounded bg-white mt-1 p-2">
            <div class="col-lg-12 col-md-6 col-sm-6">
                @php
                    $heads = ['Proveedor', 'Correo electrónico', 'Telefono', 'RFC', 'Opciones'];
                @endphp
                <x-adminlte-datatable id="contenedorProveedores" theme="light" head-theme="dark" :heads="$heads" compressed striped hoverable beautify>
                    @if( count( $proveedores) > 0 )
                        @foreach( $proveedores as $proveedor )
                            <tr>
                                <td>{{ $proveedor->nombre }}</td>
                                <td>{{ ($proveedor->email ? $proveedor->email : 'Sin email') }}</td>
                                <td>{{ $proveedor->telefono ? $proveedor->telefono : 'Sin telefono' }}</td>
                                <td>{{ $proveedor->rfc ? $proveedor->rfc : 'Sin RFC' }}</td>
                                <td>
                                    <button class="btn shadow border border-primary editar" data-value="{{ $proveedor->id }}, {{ $proveedor->nombre }}, {{ $proveedor->email }}, {{ $proveedor->telefono }}, {{ $proveedor->direccion }}, {{ $proveedor->rfc }}" data-toggle="modal" data-target="#editarProveedor" title="Editar proveedor"><i class="fas fa-edit"></i></button>
                                    <button class="btn shadow border border-danger borrar" data-value="{{ $proveedor->id }}, {{ $proveedor->nombre }}"><i class="fas fa-trash" title="Eliminar proveedor"></i></button>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="5" class="text-info fw-bold text-center">No hay proveedores registrados <i class="fas fa-exclamation-circle"></i></td>
                        </tr>
                    @endif
                </x-adminlte-datatable>
            </div>
        </div>
    </div>

    @include('proveedores.nuevo')
    @include('proveedores.editar')

    <script src="{{ asset('js/jquery-3.7.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/sweetAlert.js') }}" type="text/javascript"></script>
    <script src="{{ asset('/js/proveedores/create.js') }}" type="text/javascript"></script>
    <script src="{{ asset('/js/proveedores/read.js') }}" type="text/javascript"></script>
    <script src="{{ asset('/js/proveedores/update.js') }}" type="text/javascript"></script>
    <script src="{{ asset('/js/proveedores/delete.js') }}" type="text/javascript"></script>
@stop