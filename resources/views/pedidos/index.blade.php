@extends('home')
@section('contenido')
    <div class="container-fluid overflow-auto">
        <div class="container-fluid row rounded mb-2">
            <div class="col-lg-5">
                <h4 class="fw-semibold mt-3"><i class="fas fa-store"></i> Pedidos</h4>
                <small class="fw-semibold p-1 m-0 text-secondary">Elige el pedido o agrega una nuevo con el botón <b class="text-primary border rounded bg-success p-1"><i class="fas fa-plus"></i></b></small>
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
                            Pedidos
                            <i class="fas fa-store"></i>
                        </li>
                    </ol>
                </nav>
            </div>
            <div class="col-lg-1">
                <button class="btn btn-success mt-3 shadow" data-toggle="modal" data-target="#nuevoPedido"><i class="fas fa-plus" ></i></button>
            </div>
        </div>
        <div class="container-fluid row rounded bg-white mt-1 p-2">
            <div class="col-lg-12 col-md-6 col-sm-6">
                @php
                    $heads = ['Folio', 'Cliente', 'Total', 'Estado', 'Opciones'];
                    
                @endphp
                <x-adminlte-datatable id="contenedorPedidos" theme="light" head-theme="dark" :heads="$heads" compressed striped hoverable beautify>
                    @if( count( $pedidos) > 0 )
                        @foreach( $pedidos as $pedido )
                            @php
                                switch ($pedido->estado) {
                                    case 'Pendiente':
                                        $bgClass = 'bg-warning';
                                        break;
                                    case 'Terminado':
                                        $bgClass = 'bg-success';
                                        break;
                                    default:
                                        $bgClass = 'bg-primary';
                                        break;
                                }
                            @endphp
                            @if ( $pedido->estado !== 'Cerrado')
                            
                                <tr>
                                    <td>{{ $pedido->id }}</td>
                                    <td>{{ $pedido->cliente->nombre }}</td>
                                    <td><b>$ {{ number_format( $pedido->total, 1 ) }}</b></td>
                                    <td><span class="{{ $bgClass }} rounded p-1">{{ ucfirst( $pedido->estado ) }}<span></td>
                                    <td>
                                        @php
                                            switch ($pedido->estado) {
                                                case 'Pendiente':
                                                    @endphp
                                                    <button class="btn shadow border border-secondary produccion" data-value="{{ $pedido->id }}" data-estado="Produccion" title="Producir pedido"><i class="fas fa-industry"></i></button>
                                                    @php
                                                    break;
                                                case 'Terminado':
                                                    @endphp
                                                    <button class="btn shadow border border-danger cerrar" data-value="{{ $pedido->id }}" data-estado="Cerrado" title="Cerrar pedido"><i class="fas fa-ban"></i></button>
                                                    @php
                                                    break;
                                                default:
                                                    @endphp
                                                    <button class="btn shadow border border-warning terminado" data-value="{{ $pedido->id }}" data-estado="Terminado" title="Terminar pedido"><i class="fas fa-stop"></i></button>
                                                    @php
                                                    break;
                                            }
                                        @endphp
                                        
                                        <button class="btn shadow border border-danger borrar" data-value="{{ $pedido->id }}, {{ $pedido->cliente->nombre }}"><i class="fas fa-trash" title="Eliminar pedido"></i></button>
                                        <button class="btn shadow border border-info ver" data-value="{{ $pedido->id }}, {{ $pedido->cliente->nombre }}, {{ $pedido->total }}, {{ $pedido->observaciones }}, {{$pedido->fecha_entrega}}, {{ $pedido->lote }}, {{ $pedido->acomodo }}" data-toggle="modal" data-target="#verPedido"><i class="fas fa-info-circle" title="Ver pedido"></i></button>
                                    </td>
                                </tr>

                            @endif
                            
                        @endforeach
                    @else
                        <tr>
                            <td colspan="5" class="text-info fw-bold text-center">No hay pedidos registrados <i class="fas fa-exclamation-circle"></i></td>
                        </tr>
                    @endif
                </x-adminlte-datatable>
            </div>
        </div>
    </div>

    @include('pedidos.nuevo')
    @include('pedidos.pedido')

    <script src="{{ asset('js/jquery-3.7.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/sweetAlert.js') }}" type="text/javascript"></script>
    <script src="{{ asset('/js/pedidos/create.js') }}" type="text/javascript"></script>
    <script src="{{ asset('/js/pedidos/read.js') }}" type="text/javascript"></script>
    <script src="{{ asset('/js/pedidos/update.js') }}" type="text/javascript"></script>
    <script src="{{ asset('/js/pedidos/delete.js') }}" type="text/javascript"></script>
    <script src="{{ asset('/js/pedidos/imprimir.js') }}" type="text/javascript"></script>
    <script src="{{ asset('/js/pedidos/produccion.js') }}" type="text/javascript"></script>
@stop