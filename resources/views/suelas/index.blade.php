@extends('home')
@section('contenido')
    <div class="container-fluid overflow-auto">
        <div class="container-fluid row rounded mb-2">
            <div class="col-lg-5">
                <h4 class="fw-semibold mt-3"><i class="fas fa-shoe-prints"></i> Suelas</h4>
                <small class="fw-semibold p-1 m-0 text-secondary">Elige la suela a gestionar o agrega una nueva con el botón <b class="text-primary border rounded bg-success p-1"><i class="fas fa-plus"></i></b></small>
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
                            Suelas
                            <i class="fas fa-shoe-prints"></i>
                        </li>
                    </ol>
                </nav>
            </div>
            <div class="col-lg-1">
                <button class="btn btn-success mt-3 shadow" data-toggle="modal" data-target="#nuevoSuela"><i class="fas fa-plus" ></i></button>
            </div>
        </div>
        <div class="container-fluid row rounded bg-white mt-1 p-2">
            <div class="col-lg-12 col-md-6 col-sm-6">
                @php
                    $heads = ['Suela', 'Color', 'Precio', 'Corrida', 'Marca', 'Opciones'];
                @endphp
                <x-adminlte-datatable id="contenedorSuelas" theme="light" head-theme="dark" :heads="$heads" compressed striped hoverable beautify>
                    @if( count( $suelas) > 0 )
                        @foreach( $suelas as $suela )
                            <tr>
                                <td>{{ $suela->nombre }}</td>
                                <td>{{ $suela->color }}</td>
                                <td>$ {{ $suela->precio }}</td>
                                <td>{{ $suela->corrida }}</td>
                                <td>{{ $suela->marca }}</td>
                                <td>
                                    <button class="btn shadow border border-primary editar" data-value="{{ $suela->id }}, {{ $suela->nombre }}, {{ $suela->precio }}, {{ $suela->descripcion }}, {{ $suela->color }}, {{ $suela->corrida }}, {{ $suela->marca }}" data-toggle="modal" data-target="#editarSuela" title="Editar suela"><i class="fas fa-edit"></i></button>
                                    <button class="btn shadow border border-danger borrar" data-value="{{ $suela->id }}, {{ $suela->nombre }}"><i class="fas fa-trash" title="Eliminar suela"></i></button>
                                    <a class="btn shadow border border-secondary configurar" href="{{ url('/suela/desarrollo')}}/{{ $suela->id }}" title="Desarrollo de suela"><i class="fas fa-cogs"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="5" class="text-info fw-bold text-center">No hay suelas registrados <i class="fas fa-exclamation-circle"></i></td>
                        </tr>
                    @endif
                </x-adminlte-datatable>
            </div>
        </div>
    </div>

    @include('suelas.nuevo')
    @include('suelas.editar')

    <script src="{{ asset('js/jquery-3.7.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/sweetAlert.js') }}" type="text/javascript"></script>
    <script src="{{ asset('/js/suelas/create.js') }}" type="text/javascript"></script>
    <script src="{{ asset('/js/suelas/read.js') }}" type="text/javascript"></script>
    <script src="{{ asset('/js/suelas/update.js') }}" type="text/javascript"></script>
    <script src="{{ asset('/js/suelas/delete.js') }}" type="text/javascript"></script>
@stop