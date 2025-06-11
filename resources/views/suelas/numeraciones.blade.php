<x-adminlte-modal id="numeracionesSuela" title="Numeraciones de suela" size="md" theme="info" icon="fas fa-hashtag" v-centered static-backdrop scrollable>
    <div class="container-fluid row">
        <div class="col-lg-12 border-bottom p-1">
            <small class="text-danger"><i class="fas fa-info-circle"></i> Elige las numeraciones que tendrá este modelo de suela</small>
        </div>
        <div class="col-lg-12 p-1">
            @php
                $heads = ['[]', 'Numeración/Talla', 'Descripción'];
                $numeracionesSuela = $suela->numeraciones->pluck('numeracion')->toArray();
            @endphp
            <x-adminlte-datatable id="contenedornumeracions" theme="light" head-theme="dark" :heads="$heads" compressed striped hoverable beautify>
                @if( count( $numeraciones ) > 0 )
                    @foreach( $numeraciones as $numeracion )
                        <tr>
                            <td><input type="checkbox" id="numeracion{{ $numeracion->id }}" name="numeracion" value="{{ $numeracion->id }}" {{ in_array($numeracion->numeracion, $numeracionesSuela) ? 'checked' : '' }}></td>
                            <td>{{ $numeracion->numeracion }}</td>
                            <td>{{ ( $numeracion->descripcion ? $numeracion->descripcion : 'Sin descripción' ) }}</td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="5" class="text-info fw-bold text-center">No hay numeraciones agregados a la suela<i class="fas fa-exclamation-circle"></i></td>
                    </tr>
                @endif
            </x-adminlte-datatable>
        </div>
        <x-slot name="footerSlot">
            <button class="btn btn-primary shadow" id="numerar" title="Agregar a suela"><i class="fas fa-save"></i> </button>
            <button class="btn btn-outline-danger shadow" data-dismiss="modal"><i class="fas fa-window-close"></i> Cancelar</button>
        </x-slot>
    </div>
</x-adminlte-modal>