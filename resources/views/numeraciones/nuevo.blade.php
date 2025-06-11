<x-adminlte-modal id="nuevoNumeracion" title="Nueva Numeración" size="md" theme="success" icon="fas fa-plus" v-centered static-backdrop scrollable>
    <div class="container-fluid row">
        <div class="col-lg-12 border-bottom p-1">
            <small class="text-danger"><i class="fas fa-info-circle"></i> Todos los campos con * son obligatorios</small>
        </div>
        <div class="col-lg-12 p-1">
            <form class="form-group">
                <x-adminlte-input type="text" id="numeracion" name="numeracion" placeholder="*Numeración/Talla">
                    <x-slot name="prependSlot">
                        <div class="input-group-text">
                            <i class="fas fa-hashtag"></i>
                        </div>
                    </x-slot>
                </x-adminlte-input>
                <x-adminlte-input type="textarea" id="descripcion" name="descripcion" placeholder="Descripción de numeración (OPCIONAL)">
                    <x-slot name="prependSlot">
                        <div class="input-group-text">
                            <i class="fas fa-edit"></i>
                        </div>
                    </x-slot>
                </x-adminlte-input>
            </form>
        </div>
        <x-slot name="footerSlot">
            <button class="btn btn-primary shadow" id="registrar" title="Guardar"><i class="fas fa-save"></i> </button>
            <button class="btn btn-outline-danger shadow" data-dismiss="modal"><i class="fas fa-window-close"></i> Cancelar</button>
        </x-slot>
    </div>
</x-adminlte-modal>