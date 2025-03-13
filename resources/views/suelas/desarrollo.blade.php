@extends('home')
@section('contenido')
    <div class="container-fluid overflow-auto">
        <div class="container-fluid row rounded mb-2">
            <div class="col-lg-5">
                <h4 class="fw-semibold mt-3"><i class="fas fa-shoe-prints"></i> Desarrollo de suela {{ $suela->nombre }}</h4>
                <small class="fw-semibold p-1 m-0 text-secondary">Elige el material a gestionar o agrega uno nuevo con el botón <b class="text-primary border rounded bg-success p-1"><i class="fas fa-plus"></i></b></small>
                <input type="hidden" name="idSuela" id="idSuela" value="{{ $suela->id }}">
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
                            <a class="link-body-emphasis" href="/suelas">
                                Suelas
                                <i class="fas fa-shoe-prints"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item active">
                            Desarrollo de suela
                            <i class="fas fa-cogs"></i>
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
                    $heads = ['Material', 'Suela(s) por material', 'Descripción', 'Opciones'];
                @endphp
                <x-adminlte-datatable id="contenedorSuelas" theme="light" head-theme="dark" :heads="$heads" compressed striped hoverable beautify>
                    @if( count( $suela->materiales ) > 0 )
                        @foreach( $suela->materiales as $material )
                            <tr>
                                <td>{{ $material->nombre }}</td>
                                <td>{{ $material->pivot->cantidad }} suela(s)</td>
                                <td>{{ ( $material->pivot->descripcion ? $material->pivot->descripcion : 'Sin descripción' ) }}</td>
                                <td>
                                    <button class="btn shadow border border-primary editar" data-value="{{ $material->pivot->id }}, {{ $material->pivot->idMaterial }}, {{ $material->nombre }}, {{ $material->pivot->cantidad }}, {{ $material->pivot->descripcion }}" data-toggle="modal" data-target="#editarMaterial" title="Editar material de suela"><i class="fas fa-edit"></i></button>
                                    <button class="btn shadow border border-danger borrar" data-value="{{ $material->pivot->id }}, {{ $material->nombre }}"><i class="fas fa-trash" title="Eliminar material de suela"></i></button>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="5" class="text-info fw-bold text-center">No hay materiales registrados en la suela <i class="fas fa-exclamation-circle"></i></td>
                        </tr>
                    @endif
                </x-adminlte-datatable>
            </div>
        </div>
    </div>

    @include('suelas.material')
    @include('suelas.edicion')

    <script src="{{ asset('js/jquery-3.7.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/sweetAlert.js') }}" type="text/javascript"></script>
    <script src="{{ asset('/js/suelas/desarrollo/create.js') }}" type="text/javascript"></script>
    <script src="{{ asset('/js/suelas/desarrollo/read.js') }}" type="text/javascript"></script>
    <script src="{{ asset('/js/suelas/desarrollo/update.js') }}" type="text/javascript"></script>
    <script src="{{ asset('/js/suelas/desarrollo/delete.js') }}" type="text/javascript"></script>
@stop