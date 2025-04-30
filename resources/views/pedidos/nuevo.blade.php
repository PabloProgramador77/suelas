<x-adminlte-modal id="nuevoPedido" title="Nuevo Pedido" size="xl" theme="success" icon="fas fa-plus" v-centered static-backdrop scrollable>
    <div class="container-fluid row">
        <div class="col-lg-12 border-bottom p-1">
            <small class="text-danger float-start"><i class="fas fa-info-circle"></i> Captura los pares de la suelas que serán parte del nuevo pedido</small>
        </div>
        <div class="col-lg-12 p-1">
            <form class="form-group">
                @php
                    $heads = ['Suela', 'Color', 'Precio', 'Corrida', 'Marca', 'Pares'];
                @endphp
                <x-adminlte-datatable id="contenedorSuelas" theme="light" head-theme="dark" :heads="$heads" compressed striped hoverable beautify>
                    @if( count( $suelas) > 0 )
                        @foreach( $suelas as $suela )
                            <tr>
                                <td>{{ $suela->nombre }}</td>
                                <td>{{ $suela->color }}</td>
                                <td>$ {{ number_format( $suela->precio, 1) }}</td>
                                <td>{{ $suela->corrida }}</td>
                                <td>{{ $suela->marca }}</td>
                                <td>
                                    <input type="text" name="pares" id="pares" class="form-control pares" placeholder="Pares" data-id="{{ $suela->id }}" data-value="{{ $suela->precio }}"/>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="5" class="text-info fw-bold text-center">No hay suelas registrados <i class="fas fa-exclamation-circle"></i></td>
                        </tr>
                    @endif
                </x-adminlte-datatable>
            </form>
        </div>
        <x-slot name="footerSlot">
            <div class="container-fluid row overflow-hidden">
                <div class="col-lg-4">
                    <select name="cliente" id="cliente" class="form-control">
                        <option value="default">Elige un cliente</option>
                        @foreach( $clientes as $cliente )
                            <option value="{{ $cliente->id }}">{{ $cliente->nombre }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-lg-4">
                    <input type="date" placeholder="Fecha de entrega" name="entrega" id="entrega" class="form-control">
                </div>
                <div class="col-lg-4">
                    <x-adminlte-input type="text" id="observaciones" name="observaciones" placeholder="Observaciones del pedido">
                        <x-slot name="prependSlot">
                            <div class="input-group-text">
                                <i class="fas fa-sticky-note"></i>
                            </div>
                        </x-slot>
                    </x-adminlte-input>
                </div>
                <!--<div class="col-lg-6">
                    <x-adminlte-input type="text" id="lote" name="lote" placeholder="N° de lote (OPCIONAL)">
                        <x-slot name="prependSlot">
                            <div class="input-group-text">
                                <i class="fas fa-hashtag"></i>
                            </div>
                        </x-slot>
                    </x-adminlte-input>
                </div>
                <div class="col-lg-6">
                    <x-adminlte-input type="text" id="acomodo" name="acomodo" placeholder="Especificación de pares: 20, 30, 10, etc.">
                        <x-slot name="prependSlot">
                            <div class="input-group-text">
                                <i class="fas fa-box"></i>
                            </div>
                        </x-slot>
                    </x-adminlte-input>
                </div>-->
            </div>
            <!--<p id="total" class="bg-success rounde shadow float-start px-2 py-1 mx-5 d-block"><b>$ 0.00</b></p>-->
            <button class="btn btn-primary shadow" id="registrar"><i class="fas fa-save" title="Guardar nuevo"></i> </button>
            <button class="btn btn-outline-danger shadow" data-dismiss="modal"><i class="fas fa-window-close"></i> Cancelar</button>
        </x-slot>
    </div>
</x-adminlte-modal>