<x-adminlte-modal id="verPedido" title="Datos de Pedido" size="xl" theme="info" icon="fas fa-info-circle" v-centered static-backdrop scrollable>
    <div class="container-fluid row">
        <div class="col-lg-12 border-bottom p-1">
            <small class="text-primary float-start"><i class="fas fa-info-circle"></i> A continuación los datos del pedido</small>
        </div>
        <div class="col-lg-12 p-1">
            <form class="form-group">
                @php
                    $heads = ['Suela', 'Color', 'Precio', 'Corrida', 'Marca', 'Pares', 'Importe'];
                @endphp
                <x-adminlte-datatable id="contenedorPedido" theme="light" head-theme="dark" :heads="$heads" compressed striped hoverable beautify>
                    
                </x-adminlte-datatable>
                <input type="hidden" name="idPedidoImprimir" id="idPedidoImprimir">
            </form>
        </div>
        <x-slot name="footerSlot">
            <input type="text" name="clientePedido" id="clientePedido" readonly="readonly" class="form-control d-block float-start w-50">
            <p id="totalPedido" class="bg-success rounde shadow float-start px-2 py-1 mx-5 d-block"><b>$ 0.00</b></p>
            <button class="btn btn-primary shadow" id="imprimir"><i class="fas fa-print" title="Imprimir nota"></i> </button>
            <button class="btn btn-outline-danger shadow" data-dismiss="modal"><i class="fas fa-window-close"></i> Cancelar</button>
        </x-slot>
    </div>
</x-adminlte-modal>