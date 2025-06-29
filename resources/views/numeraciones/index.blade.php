@extends('home')
@section('contenido')
    <div class="container-fluid overflow-auto">
        <div class="container-fluid row rounded mb-2">
            <div class="col-lg-5">
                <h4 class="fw-semibold mt-3"><i class="fas fa-hashtag"></i> Numeraciones</h4>
                <small class="fw-semibold p-1 m-0 text-secondary">Elige la numeración a gestionar o agrega una nueva con el botón <b class="text-primary border rounded bg-success p-1"><i class="fas fa-plus"></i></b></small>
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
                            Numeraciones
                            <i class="fas fa-hashtag"></i>
                        </li>
                    </ol>
                </nav>
            </div>
            <div class="col-lg-1">
                <button class="btn btn-success mt-3 shadow" data-toggle="modal" data-target="#nuevoNumeracion"><i class="fas fa-plus" ></i></button>
            </div>
        </div>
        <div class="container-fluid row rounded bg-white mt-1 p-2">
            <div class="col-lg-12 col-md-6 col-sm-6">
                @php
                    $heads = ['Folio', 'Numeración/Talla', 'Descripción', 'Opciones'];
                @endphp
                <x-adminlte-datatable id="contenedornumeraciones" theme="light" head-theme="dark" :heads="$heads" compressed striped hoverable beautify>
                    @if( count( $numeraciones) > 0 )
                        @foreach( $numeraciones as $numeracion )
                            <tr>
                                <td>{{ $numeracion->id }}</td>
                                <td><b>{{ $numeracion->numeracion }}</b></td>
                                <td>{{ $numeracion->descripcion ? $numeracion->descripcion : 'Sin descripción' }}</td>
                                <td>
                                    <button class="btn shadow border border-danger borrar" data-value="{{ $numeracion->id }}, {{ $numeracion->numeracion }}, {{ $numeracion->descripcion }}"><i class="fas fa-trash" title="Eliminar numeracion"></i></button>
                                    <button class="btn shadow border border-info editar" data-value="{{ $numeracion->id }}, {{ $numeracion->numeracion }}, {{ $numeracion->descripcion }}"><i class="fas fa-edit" title="Editar numeracion" data-toggle="modal" data-target="#editarNumeracion"></i></button>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="5" class="text-info fw-bold text-center">No hay numeraciones registradas <i class="fas fa-exclamation-circle"></i></td>
                        </tr>
                    @endif
                </x-adminlte-datatable>
            </div>
        </div>
    </div>

    @include('numeraciones.nuevo')
    @include('numeraciones.editar')

    <script src="{{ asset('js/jquery-3.7.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/sweetAlert.js') }}" type="text/javascript"></script>
    <script src="{{ asset('/js/numeraciones/create.js') }}" type="text/javascript"></script>
    <script src="{{ asset('/js/numeraciones/read.js') }}" type="text/javascript"></script>
    <script src="{{ asset('/js/numeraciones/update.js') }}" type="text/javascript"></script>
    <script src="{{ asset('/js/numeraciones/delete.js') }}" type="text/javascript"></script>
@stop