@extends('home')
@section('contenido')
    <div class="container-fluid overflow-auto">
        <div class="container-fluid row rounded mb-2">
            <div class="col-lg-5">
                <h4 class="fw-semibold mt-3"><i class="fab fa-product-hunt"></i> Producto Terminado</h4>
                <small class="fw-semibold p-1 m-0 text-secondary">Elige la suela a sacar, captura los pares y finaliza con el botón <b class="text-primary border rounded bg-warning p-1"><i class="fas fa-minus"></i></b></small>
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
                            Producto Terminado
                            <i class="fab fa-product-hunt"></i>
                        </li>
                    </ol>
                </nav>
            </div>
            <div class="col-lg-1">
                <button class="btn btn-warning mt-3 shadow" data-toggle="modal" data-target="#nuevoSalida"><i class="fas fa-minus" ></i></button>
            </div>
        </div>
        <div class="container-fluid row rounded bg-white mt-1 p-2">
            <div class="col-lg-12 col-md-6 col-sm-6">
                @php
                    $heads = ['Suela', 'Descripción', 'Color', 'Tallas', 'Existencia', 'Pares'];
                    
                @endphp
                <x-adminlte-datatable id="contenedorsuelas" theme="light" head-theme="dark" :heads="$heads" compressed striped hoverable beautify>
                    @if( count( $suelas) > 0 )
                        @foreach( $suelas as $suela )
                            
                            <tr>
                                <td><b>{{ $suela->nombre }}</b></td>
                                <td>{{ ($suela->descripcion ? $suela->descripcion : 'Sin descripción') }}</td>
                                <td>{{ $suela->color }}</td>
                                <td><span class="bg-info p-1 rounded">#{{ $suela->numeracion }}</span></td>
                                <td><b>{{ $suela->stock }}</b></td>
                                <td><input type="text" class="pares col-lg-1 col-md-1 col-sm-1" name="pares" id="{{ $suela->idNumeracion }}" placeholder="#{{ $suela->numeracion }}" data-id="{{ $suela->id }}" data-value="{{ $suela->precio }}" /></td>
                            </tr>
                            
                        @endforeach

                    @else
                        <tr>
                            <td colspan="5" class="text-info fw-bold text-center">No hay producto terminado registrado <i class="fas fa-exclamation-circle"></i></td>
                        </tr>
                    @endif
                </x-adminlte-datatable>
            </div>
        </div>
    </div>

    @include('pedidos.salida')

    <script src="{{ asset('js/jquery-3.7.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/sweetAlert.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/suelas/almacen.js') }}" type="text/javascript"></script>
    
@stop