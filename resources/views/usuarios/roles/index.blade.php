@extends('home')
@section('contenido')
    <div class="container-fluid overflow-auto">
        <div class="container-fluid row rounded mb-2">
            <div class="col-lg-5">
                <h4 class="fw-semibold mt-3"><i class="fas fa-user-tag"></i> Roles de usuario</h4>
                <small class="fw-semibold p-1 m-0 text-secondary">Elige el rol de usuario a gestionar o agrega uno nuevo con el botón <b class="text-primary border rounded bg-success p-1"><i class="fas fa-plus"></i></b></small>
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
                            <a class="link-body-emphasis" href="/permisos">
                                Permisos de usuario
                                <i class="fas fa-user-cog"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item active">
                            Roles de usuario
                            <i class="fas fa-user-tag"></i>
                        </li>
                    </ol>
                </nav>
            </div>
            <div class="col-lg-1">
                <button class="btn btn-success mt-3 shadow" data-toggle="modal" data-target="#nuevoRole"><i class="fas fa-plus" ></i></button>
            </div>
        </div>
        <div class="container-fluid row rounded bg-white mt-1 p-2">
            <div class="col-lg-12 col-md-6 col-sm-6">
                @php
                    $heads = ['#', 'Rol de usuario', 'Opciones'];
                @endphp
                <x-adminlte-datatable id="contenedorUsers" theme="light" head-theme="dark" :heads="$heads" compressed striped hoverable beautify>
                    @if( count( $roles) > 0 )
                        @foreach( $roles as $rol )
                            <tr>
                                <td>{{ $rol->id }}</td>
                                <td>{{ $rol->name }}</td>
                                <td>
                                    <button class="btn shadow border border-primary editar" data-value="{{ $rol->id }}, {{ $rol->name }}" data-toggle="modal" data-target="#editarRole" title="Editar rol"><i class="fas fa-edit"></i></button>
                                    <button class="btn shadow border border-danger borrar" data-value="{{ $rol->id }}, {{ $rol->name }}"><i class="fas fa-trash" title="Eliminar usuario"></i></button>
                                    <button class="btn shadow border border-info permisos" data-value="{{ $rol->id }}, {{ $rol->name }}, {{ json_encode( $rol->permissions ) }}" data-toggle="modal" data-target="#modalPermisos" title="Permisos de rol"><i class="fas fa-user-cog"></i></button>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="5" class="text-info fw-bold text-center">No hay roles de usuario registrados <i class="fas fa-exclamation-circle"></i></td>
                        </tr>
                    @endif
                </x-adminlte-datatable>
            </div>
        </div>
    </div>

    @include('usuarios.roles.nuevo')
    @include('usuarios.roles.editar')
    @include('usuarios.roles.permisos')

    <script src="{{ asset('js/jquery-3.7.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/sweetAlert.js') }}" type="text/javascript"></script>
    <script src="{{ asset('/js/roles/create.js') }}" type="text/javascript"></script>
    <script src="{{ asset('/js/roles/read.js') }}" type="text/javascript"></script>
    <script src="{{ asset('/js/roles/update.js') }}" type="text/javascript"></script>
    <script src="{{ asset('/js/roles/delete.js') }}" type="text/javascript"></script>
    <script src="{{ asset('/js/roles/permisos.js') }}" type="text/javascript"></script>
@stop