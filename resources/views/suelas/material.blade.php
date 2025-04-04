<x-adminlte-modal id="nuevoMaterial" title="Nuevo Material" size="md" theme="success" icon="fas fa-plus" v-centered static-backdrop scrollable>
    <div class="container-fluid row">
        <div class="col-lg-12 border-bottom p-1">
            <small class="text-danger"><i class="fas fa-info-circle"></i> Todos los campos con * son obligatorios</small>
        </div>
        <div class="col-lg-12 p-1">
            <form class="form-group">
                <x-adminlte-select type="text" id="material" name="material" >
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
                <x-adminlte-input type="text" id="cantidad" name="cantidad" placeholder="*Cantidad de material para par de suelas">
                    <x-slot name="prependSlot">
                        <div class="input-group-text">
                            <i class="fas fa-hashtag">*</i>
                        </div>
                    </x-slot>
                </x-adminlte-input>
                <x-adminlte-input type="textarea" id="descripcionMaterial" name="descripcionMaterial" placeholder="Observaciones (OPCIONAL)">
                    <x-slot name="prependSlot">
                        <div class="input-group-text">
                            <i class="fas fa-edit"></i>
                        </div>
                    </x-slot>
                </x-adminlte-input>
            </form>
        </div>
        <x-slot name="footerSlot">
            <button class="btn btn-primary shadow" id="agregar"><i class="fas fa-plus" title="Agregar a suela"></i> </button>
            <button class="btn btn-outline-danger shadow" data-dismiss="modal"><i class="fas fa-window-close"></i> Cancelar</button>
        </x-slot>
    </div>
</x-adminlte-modal>