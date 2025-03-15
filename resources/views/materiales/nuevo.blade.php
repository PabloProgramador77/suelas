<x-adminlte-modal id="nuevoMaterial" title="Nuevo Material" size="md" theme="success" icon="fas fa-plus" v-centered static-backdrop scrollable>
    <div class="container-fluid row">
        <div class="col-lg-12 border-bottom p-1">
            <small class="text-danger"><i class="fas fa-info-circle"></i> Todos los campos con * son obligatorios</small>
        </div>
        <div class="col-lg-12 p-1">
            <form class="form-group">
                <x-adminlte-input type="text" id="nombre" name="nombre" placeholder="*Nombre de material">
                    <x-slot name="prependSlot">
                        <div class="input-group-text">
                            <i class="fas fa-box"></i>
                        </div>
                    </x-slot>
                </x-adminlte-input>
                <x-adminlte-input type="text" id="precio" name="precio" placeholder="*Precio de material">
                    <x-slot name="prependSlot">
                        <div class="input-group-text">
                            <i class="fas fa-dollar-sign"></i>
                        </div>
                    </x-slot>
                </x-adminlte-input>
                <x-adminlte-select id="unidad" name="unidad">
                    <x-slot name="prependSlot">
                        <div class="input-group-text">
                            <i class="fas fa-list">*</i>
                        </div>
                    </x-slot>
                    <x-slot name="slot">
                        <option value="0">Selecciona una opción</option>
                        <option value="Pieza">Pieza</option>
                        <option value="Kilogramo">Kilogramo</option>
                        <option value="Miligramo">Miligramo</option>
                        <option value="Litro">Litro</option>
                        <option value="Mililitro">Mililitro</option>
                        <option value="Metro">Metro</option>
                        <option value="Milimetro">Milimetro</option>
                        <option value="Centimetro">Centimetro</option>
                    </x-slot>
                </x-adminlte-select>
                <x-adminlte-input type="textarea" id="descripcion" name="descripcion" placeholder="Descripción de material (OPCIONAL)">
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