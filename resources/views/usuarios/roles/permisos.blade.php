<x-adminlte-modal id="modalPermisos" title="Permisos de Rol" size="lg" theme="info" icon="fas fa-user-cog" v-centered static-backdrop scrollable>
    <div class="container-fluid row">
        <div class="col-lg-12 border-bottom p-1">
            <small class="text-secondary"><i class="fas fa-info-circle"></i> Elige los permisos de usuario que deseas agregar al rol de usuario</small>
        </div>
        <div class="col-lg-12 p-1">
            <form class="form-group">
                <x-adminlte-input type="text" id="nombreRole" name="nombreRole" readonly="true">
                    <x-slot name="prependSlot">
                        <div class="input-group-text">
                            <i class="fas fa-user-tag"></i>
                        </div>
                    </x-slot>
                </x-adminlte-input>
                @if( count( $permisos ) > 0 )

                    <div class="container-fluid row border rounded m-1 px-1 py-2">
                        @foreach( $permisos as $permiso )
                            <div class="col-lg-3 col-md-4 col-sm-6 form-check form-check-inline">
                                <input class="form-check-input" name="permiso" type="checkbox" role="switch" id="permiso{{ $permiso->id }}" value="{{ $permiso->name }}">
                                <label class="form-check-label" for="permiso{{ $permiso->id }}">{{ $permiso->name }}</label>
                            </div>
                        @endforeach
                    </div>
                    
                @else
                    <div class="text-danger bg-danger text-center">No hay permisos de usuario registrados</div>
                @endif
                <input type="hidden" name="idRolePermiso" id="idRolePermiso">
            </form>
        </div>
        <x-slot name="footerSlot">
            <button class="btn btn-primary shadow" id="permitir"><i class="fas fa-save" title="Guardar permisos"></i> </button>
            <button class="btn btn-outline-danger shadow" data-dismiss="modal"><i class="fas fa-window-close"></i> Cancelar</button>
        </x-slot>
    </div>
</x-adminlte-modal>