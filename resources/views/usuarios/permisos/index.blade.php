@extends('home')
@section('contenido')
    <div class="container-fluid overflow-auto">
        <div class="container-fluid row rounded mb-2">
            <div class="col-lg-5">
                <h4 class="fw-semibold mt-3"><i class="fas fa-user-cog"></i> Permisos de usuario</h4>
                <small class="fw-semibold p-1 m-0 text-secondary">Elige el permiso de usuario a gestionar o agrega uno nuevo con el botón <b class="text-primary border rounded bg-success p-1"><i class="fas fa-plus"></i></b></small>
            </div>
            <div class="col-lg-6 p-1">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-chevron p-3 bg-body-tertiary">
                        <li class="breadcrumb-item">
                            <a class="link-body-emphasis" href="/home">
                                Inicio
                                <i class="fas fa-home"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                            <a class="link-body-emphasis" href="/usuarios">
                                Usuarios
                                <i class="fas fa-users"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                            <a class="link-body-emphasis" href="/roles">
                                Roles de Usuarios
                                <i class="fas fa-user-tag"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item active">
                            Permisos de usuarios
                            <i class="fas fa-user-cog"></i>
                        </li>
                    </ol>
                </nav>
            </div>
            <div class="col-lg-1">
                <button class="btn btn-success mt-3 shadow" data-toggle="modal" data-target="#nuevoPermiso"><i class="fas fa-plus" ></i></button>
            </div>
        </div>
        <div class="container-fluid row rounded bg-white mt-1 p-2">
            <div class="col-lg-12 col-md-6 col-sm-6">
                @php
                    $heads = ['#', 'Permiso de usuario', 'Opciones'];
                @endphp
                <x-adminlte-datatable id="contenedorUsers" theme="light" head-theme="dark" :heads="$heads" compressed striped hoverable beautify>
                    @if( count( $permisos) > 0 )
                        @foreach( $permisos as $permiso )
                            <tr>
                                <td>{{ $permiso->id }}</td>
                                <td>{{ $permiso->name }}</td>
                                <td>
                                    <button class="btn shadow border border-primary editar" data-value="{{ $permiso->id }}, {{ $permiso->name }}" data-toggle="modal" data-target="#editarPermiso" title="Editar permiso"><i class="fas fa-edit"></i></button>
                                    <button class="btn shadow border border-danger borrar" data-value="{{ $permiso->id }}, {{ $permiso->name }}"><i class="fas fa-trash" title="Eliminar permiso"></i></button>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="5" class="text-info fw-bold text-center">No hay permisos de usuario registrados <i class="fas fa-exclamation-circle"></i></td>
                        </tr>
                    @endif
                </x-adminlte-datatable>
            </div>
        </div>
    </div>

    @include('usuarios.permisos.nuevo')
    @include('usuarios.permisos.editar')

    <script src="{{ asset('js/jquery-3.7.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/sweetAlert.js') }}" type="text/javascript"></script>
    <script src="{{ asset('/js/permisos/create.js') }}" type="text/javascript"></script>
    <script src="{{ asset('/js/permisos/read.js') }}" type="text/javascript"></script>
    <script src="{{ asset('/js/permisos/update.js') }}" type="text/javascript"></script>
    <script src="{{ asset('/js/permisos/delete.js') }}" type="text/javascript"></script>
@stop