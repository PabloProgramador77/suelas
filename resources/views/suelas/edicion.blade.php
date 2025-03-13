<x-adminlte-modal id="editarMaterial" title="Editar Material" size="md" theme="primary" icon="fas fa-edit" v-centered static-backdrop scrollable>
    <div class="container-fluid row">
        <div class="col-lg-12 border-bottom p-1">
            <small class="text-danger"><i class="fas fa-info-circle"></i> Todos los campos con * son obligatorios</small>
        </div>
        <div class="col-lg-12 p-1">
            <form class="form-group">
                <x-adminlte-select type="text" id="materialEditar" name="materialEditar" >
                    <x-slot name="prependSlot">
                        <div class="input-group-text">
                            <i class="fas fa-box"></i>
                        </div>
                    </x-slot>
                    <option value="default">Elige un material para la suela</option>
                    @foreach( $materiales as $material )
                        <option value="{{ $material->id }}">{{ $material->nombre }}</option>
                    @endforeach
                </x-adminlte-select>
                <x-adminlte-input type="text" id="cantidadEditar" name="cantidadEditar" placeholder="*Cantidad de suela(s) por material">
                    <x-slot name="prependSlot">
                        <div class="input-group-text">
                            <i class="fas fa-slack-hashtag">*</i>
                        </div>
                    </x-slot>
                </x-adminlte-input>
                <x-adminlte-input type="textarea" id="descripcionMaterialEditar" name="descripcionMaterialEditar" placeholder="Descripción (OPCIONAL)">
                    <x-slot name="prependSlot">
                        <div class="input-group-text">
                            <i class="fas fa-edit"></i>
                        </div>
                    </x-slot>
                </x-adminlte-input>
                <input type="hidden" name="idMaterialSuela" id="idMaterialSuela">
            </form>
        </div>
        <x-slot name="footerSlot">
            <button class="btn btn-primary shadow" id="editar"><i class="fas fa-plus" title="Editar material de suela"></i> </button>
            <button class="btn btn-outline-danger shadow" data-dismiss="modal"><i class="fas fa-window-close"></i> Cancelar</button>
        </x-slot>
    </div>
</x-adminlte-modal>