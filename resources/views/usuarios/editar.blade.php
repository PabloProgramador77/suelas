<x-adminlte-modal id="editarUsuario" title="Editar Usuario" size="md" theme="info" icon="fas fa-user-edit" v-centered static-backdrop scrollable>
    <div class="container-fluid row">
        <div class="col-lg-12 border-bottom p-1">
            <small class="text-danger"><i class="fas fa-info-circle"></i> Edita los datos como lo necesites. Todos los campos son obligatorios</small>
        </div>
        <div class="col-lg-12 p-1">
            <form class="form-group">
                <x-adminlte-input type="text" id="nombreEditar" name="nombreEditar" placeholder="*Nombre de usuario">
                    <x-slot name="prependSlot">
                        <div class="input-group-text">
                            <i class="fas fa-user"></i>
                        </div>
                    </x-slot>
                </x-adminlte-input>
                <x-adminlte-input type="email" id="emailEditar" name="emailEditar" placeholder="*Email de usuario">
                    <x-slot name="prependSlot">
                        <div class="input-group-text">
                            <i class="fas fa-envelope"></i>
                        </div>
                    </x-slot>
                </x-adminlte-input>
                <x-adminlte-select name="roleEditar" id="roleEditar">
                    <x-slot name="prependSlot">
                        <div class="input-group-text">
                            <i class="fas fa-user-tag"></i>
                        </div>
                    </x-slot>
                    @foreach( $roles as $rol )
                        <option value="{{ $rol->name }}">{{ $rol->name }}</option>
                    @endforeach
                </x-adminlte-select>
                <input type="hidden" name="idUsuario" id="idUsuario">
            </form>
        </div>
        <x-slot name="footerSlot">
            <button class="btn btn-primary shadow" id="actualizar"><i class="fas fa-sync" title="Guardar cambios"></i></button>
            <button class="btn btn-outline-danger shadow" data-dismiss="modal"><i class="fas fa-window-close"></i> Cancelar</button>
        </x-slot>
    </div>
</x-adminlte-modal>