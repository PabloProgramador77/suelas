<x-adminlte-modal id="nuevoSuela" title="Nueva Suela" size="md" theme="success" icon="fas fa-plus" v-centered static-backdrop scrollable>
    <div class="container-fluid row">
        <div class="col-lg-12 border-bottom p-1">
            <small class="text-danger"><i class="fas fa-info-circle"></i> Todos los campos con * son obligatorios</small>
        </div>
        <div class="col-lg-12 p-1">
            <form class="form-group">
                <x-adminlte-input type="text" id="nombre" name="nombre" placeholder="*Nombre de suela">
                    <x-slot name="prependSlot">
                        <div class="input-group-text">
                            <i class="fas fa-box"></i>
                        </div>
                    </x-slot>
                </x-adminlte-input>
                <x-adminlte-input type="text" id="precio" name="precio" placeholder="*Precio de suela">
                    <x-slot name="prependSlot">
                        <div class="input-group-text">
                            <i class="fas fa-dollar-sign"></i>
                        </div>
                    </x-slot>
                </x-adminlte-input>
                <x-adminlte-input type="text" id="color" name="color" placeholder="Color de suela">
                    <x-slot name="prependSlot">
                        <div class="input-group-text">
                            <i class="fas fa-palette"></i>
                        </div>
                    </x-slot>
                </x-adminlte-input>
                <x-adminlte-input type="text" id="corrida" name="corrida" placeholder="Corrida de suela">
                    <x-slot name="prependSlot">
                        <div class="input-group-text">
                            <i class="fas fa-hashtag"></i>
                        </div>
                    </x-slot>
                </x-adminlte-input>
                <x-adminlte-input type="text" id="marca" name="marca" placeholder="Marca de suela">
                    <x-slot name="prependSlot">
                        <div class="input-group-text">
                            <i class="fas fa-copyright"></i>
                        </div>
                    </x-slot>
                </x-adminlte-input>
                <x-adminlte-input type="textarea" id="descripcion" name="descripcion" placeholder="Observaciones de suela (OPCIONAL)">
                    <x-slot name="prependSlot">
                        <div class="input-group-text">
                            <i class="fas fa-edit"></i>
                        </div>
                    </x-slot>
                </x-adminlte-input>
            </form>
        </div>
        <x-slot name="footerSlot">
            <button class="btn btn-primary shadow" id="registrar"><i class="fas fa-save" title="Guardar nuevo"></i> </button>
            <button class="btn btn-outline-danger shadow" data-dismiss="modal"><i class="fas fa-window-close"></i> Cancelar</button>
        </x-slot>
    </div>
</x-adminlte-modal>