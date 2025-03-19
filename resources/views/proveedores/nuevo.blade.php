<x-adminlte-modal id="nuevoProveedor" title="Nuevo proveedor" size="md" theme="success" icon="fas fa-plus" v-centered static-backdrop scrollable>
    <div class="container-fluid row">
        <div class="col-lg-12 border-bottom p-1">
            <small class="text-danger"><i class="fas fa-info-circle"></i> Todos los campos con * son obligatorios</small>
        </div>
        <div class="col-lg-12 p-1">
            <form class="form-group">
                <x-adminlte-input type="text" id="nombre" name="nombre" placeholder="*Nombre de proveedor">
                    <x-slot name="prependSlot">
                        <div class="input-group-text">
                            <i class="fas fa-user"></i>
                        </div>
                    </x-slot>
                </x-adminlte-input>
                <x-adminlte-input type="email" id="email" name="email" placeholder="Email de proveedor">
                    <x-slot name="prependSlot">
                        <div class="input-group-text">
                            <i class="fas fa-envelope"></i>
                        </div>
                    </x-slot>
                </x-adminlte-input>
                <x-adminlte-input type="text" id="telefono" name="telefono" placeholder="Telefono de proveedor">
                    <x-slot name="prependSlot">
                        <div class="input-group-text">
                            <i class="fas fa-phone"></i>
                        </div>
                    </x-slot>
                </x-adminlte-input>
                <x-adminlte-input type="text" id="domicilio" name="domicilio" placeholder="Domicilio de proveedor">
                    <x-slot name="prependSlot">
                        <div class="input-group-text">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                    </x-slot>
                </x-adminlte-input>
                <x-adminlte-input type="text" id="rfc" name="rfc" placeholder="RFC de proveedor">
                    <x-slot name="prependSlot">
                        <div class="input-group-text">
                            <i class="fas fa-hashtag"></i>
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