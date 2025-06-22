<x-adminlte-modal id="nuevoSalida" title="Salida de Producto Terminado" size="lg" theme="warning" icon="fas fa-minus" v-centered static-backdrop scrollable>
    <div class="container-fluid row">
        <div class="col-lg-12 border-bottom p-1">
            <small class="text-danger float-start"><i class="fas fa-info-circle"></i> Captura los pares de la suelas que serán parte de la salida</small>
        </div>
        <x-slot name="footerSlot">
            <div class="container-fluid row overflow-hidden">
                <div class="col-lg-6 my-1">
                    <select name="cliente" id="cliente" class="form-control">
                        <option value="default">Elige un cliente</option>
                        @foreach( $clientes as $cliente )
                            <option value="{{ $cliente->id }}">{{ $cliente->nombre }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-lg-6 my-1">
                    <input type="date" placeholder="Fecha de entrega" name="entrega" id="entrega" class="form-control">
                </div>
                <div class="col-lg-6 my-1">
                    <x-adminlte-input type="text" id="observaciones" name="observaciones" placeholder="Observaciones de salida">
                        <x-slot name="prependSlot">
                            <div class="input-group-text">
                                <i class="fas fa-sticky-note"></i>
                            </div>
                        </x-slot>
                    </x-adminlte-input>
                </div>
                <div class="col-lg-6 my-1">
                    <x-adminlte-input type="text" id="lote" name="lote" placeholder="N° de lote (OPCIONAL)">
                        <x-slot name="prependSlot">
                            <div class="input-group-text">
                                <i class="fas fa-hashtag"></i>
                            </div>
                        </x-slot>
                    </x-adminlte-input>
                </div>
            </div>
            <button class="btn btn-primary shadow" id="salidaSuela" name="salidaSuela"><i class="fas fa-save" title="Guardar salida"></i> </button>
            <button class="btn btn-outline-danger shadow" data-dismiss="modal"><i class="fas fa-window-close"></i> Cancelar</button>
        </x-slot>
    </div>
</x-adminlte-modal>