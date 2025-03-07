@extends('home')
@section('contenido')
    <div class="container-fluid overflow-auto">
        <div class="container-fluid row rounded mb-2">
            <div class="col-lg-5">
                <h4 class="fw-semibold mt-3"><i class="fas fa-users"></i> Usuarios</h4>
                <small class="fw-semibold p-1 m-0 text-secondary">Elige el usuario a gestionar o agrega uno nuevo con el botón <b class="text-primary border rounded bg-success p-1"><i class="fas fa-user-plus"></i></b></small>
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
                        
                        <li class="breadcrumb-item active">
                            Usuarios
                            <i class="fas fa-users"></i>
                        </li>
                    </ol>
                </nav>
            </div>
            <div class="col-lg-1">
                <button class="btn btn-success mt-3 shadow" data-toggle="modal" data-target="#nuevoUsuario"><i class="fas fa-user-plus" ></i></button>
            </div>
        </div>
        <div class="container-fluid row rounded bg-white mt-1 p-2">
            <div class="col-lg-12 col-md-6 col-sm-6">
                @php
                    $heads = ['Usuario', 'Correo electrónico', 'Rol de usuario', 'Opciones'];
                @endphp
                <x-adminlte-datatable id="contenedorUsers" theme="light" head-theme="dark" :heads="$heads" compressed striped hoverable beautify>
                    @if( count( $usuarios) > 0 )
                        @foreach( $usuarios as $usuario )
                            <tr>
                                <td>{{ $usuario->name }}</td>
                                <td>{{ $usuario->email }}</td>
                                <td><span class="px-2 text-center rounded bg-purple">{{ $usuario->getRoleNames()->first() }}</span></td>
                                <td>
                                    <button class="btn shadow border border-primary editar" data-value="{{ $usuario->id }}, {{ $usuario->name }}, {{ $usuario->email }}, {{ $usuario->getRoleNames()->first() }}" data-toggle="modal" data-target="#editarUsuario" title="Editar usuario"><i class="fas fa-user-edit"></i></button>
                                    <button class="btn shadow border border-danger borrar" data-value="{{ $usuario->id }}, {{ $usuario->name }}"><i class="fas fa-user-minus" title="Eliminar usuario"></i></button>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="5" class="text-info fw-bold text-center">No hay usuarios registrados <i class="fas fa-exclamation-circle"></i></td>
                        </tr>
                    @endif
                </x-adminlte-datatable>
            </div>
        </div>
    </div>

    @include('usuarios.nuevo')
    @include('usuarios.editar')

    <script src="{{ asset('js/jquery-3.7.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/sweetAlert.js') }}" type="text/javascript"></script>
    <script src="{{ asset('/js/usuarios/create.js') }}" type="text/javascript"></script>
    <script src="{{ asset('/js/usuarios/read.js') }}" type="text/javascript"></script>
    <script src="{{ asset('/js/usuarios/update.js') }}" type="text/javascript"></script>
    <script src="{{ asset('/js/usuarios/delete.js') }}" type="text/javascript"></script>
@stop