<x-adminlte-modal id="editarNumeracion" title="Editar Numeración" size="md" theme="primary" icon="fas fa-edit" v-centered static-backdrop scrollable>
    <div class="container-fluid row">
        <div class="col-lg-12 border-bottom p-1">
            <small class="text-danger"><i class="fas fa-info-circle"></i> Edita los datos como creas necesario. Todos los campos con * son obligatorios</small>
        </div>
        <div class="col-lg-12 p-1">
            <form class="form-group">
                <x-adminlte-input type="text" id="numeracionEditar" name="numeracionEditar" placeholder="*Numeración/Talla">
                    <x-slot name="prependSlot">
                        <div class="input-group-text">
                            <i class="fas fa-box"></i>
                        </div>
                    </x-slot>
                </x-adminlte-input>
                <x-adminlte-input type="textarea" id="descripcionEditar" name="descripcionEditar" placeholder="Descripción de numeración (OPCIONAL)">
                    <x-slot name="prependSlot">
                        <div class="input-group-text">
                            <i class="fas fa-edit"></i>
                        </div>
                    </x-slot>
                </x-adminlte-input>
                <input type="hidden" name="idNumeracion" id="idNumeracion">
            </form>
        </div>
        <x-slot name="footerSlot">
            <button class="btn btn-primary shadow" id="actualizar" title="Guardar cambios"><i class="fas fa-sync"></i></button>
            <button class="btn btn-outline-danger shadow" data-dismiss="modal"><i class="fas fa-window-close"></i> Cancelar</button>
        </x-slot>
    </div>
</x-adminlte-modal>