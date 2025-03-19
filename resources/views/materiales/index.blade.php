@extends('home')
@section('contenido')
    <div class="container-fluid overflow-auto">
        <div class="container-fluid row rounded mb-2">
            <div class="col-lg-5">
                <h4 class="fw-semibold mt-3"><i class="fas fa-box"></i> Materiales</h4>
                <small class="fw-semibold p-1 m-0 text-secondary">Elige el material a gestionar o agrega uno nuevo con el botón <b class="text-primary border rounded bg-success p-1"><i class="fas fa-plus"></i></b></small>
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
                            <a class="link-body-emphasis" href="/proveedores">
                                Proveedores
                                <i class="fas fa-people-carry"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item active">
                            Materiales
                            <i class="fas fa-box"></i>
                        </li>
                    </ol>
                </nav>
            </div>
            <div class="col-lg-1">
                <button class="btn btn-success mt-3 shadow" data-toggle="modal" data-target="#nuevoMaterial"><i class="fas fa-plus" ></i></button>
            </div>
        </div>
        <div class="container-fluid row rounded bg-white mt-1 p-2">
            <div class="col-lg-12 col-md-6 col-sm-6">
                @php
                    $heads = ['Material', 'Precio', 'Unidad de Medida', 'Descripción', 'Opciones'];
                @endphp
                <x-adminlte-datatable id="contenedorMateriales" theme="light" head-theme="dark" :heads="$heads" compressed striped hoverable beautify>
                    @if( count( $materiales) > 0 )
                        @foreach( $materiales as $material )
                            <tr>
                                <td>{{ $material->nombre }}</td>
                                <td>$ {{ $material->precio }}</td>
                                <td>{{ $material->unidad }}</td>
                                <td>{{ ($material->descripcion ? $material->descripcion : 'Sin descripción') }}</td>
                                <td>
                                    <button class="btn shadow border border-primary editar" data-value="{{ $material->id }}, {{ $material->nombre }}, {{ $material->precio }}, {{ $material->descripcion }}, {{ $material->unidad }}, {{ $material->proveedores()->first()->id }}, {{ $material->proveedores()->first()->nombre }}" data-toggle="modal" data-target="#editarMaterial" title="Editar material"><i class="fas fa-edit"></i></button>
                                    <button class="btn shadow border border-danger borrar" data-value="{{ $material->id }}, {{ $material->nombre }}"><i class="fas fa-trash" title="Eliminar material"></i></button>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="5" class="text-info fw-bold text-center">No hay materiales registrados <i class="fas fa-exclamation-circle"></i></td>
                        </tr>
                    @endif
                </x-adminlte-datatable>
            </div>
        </div>
    </div>

    @include('materiales.nuevo')
    @include('materiales.editar')

    <script src="{{ asset('js/jquery-3.7.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/sweetAlert.js') }}" type="text/javascript"></script>
    <script src="{{ asset('/js/materiales/create.js') }}" type="text/javascript"></script>
    <script src="{{ asset('/js/materiales/read.js') }}" type="text/javascript"></script>
    <script src="{{ asset('/js/materiales/update.js') }}" type="text/javascript"></script>
    <script src="{{ asset('/js/materiales/delete.js') }}" type="text/javascript"></script>
@stop