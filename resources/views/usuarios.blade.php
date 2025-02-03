@extends('layouts.app')
 
@section('content')

<!-- Botón para abrir el modal  -->
<button class="btn-primary create-user-btn" onclick="openModalAgregar()">
    <i class="fas fa-plus"></i> Agregar Usuario
</button>

<!-- Modal Agregar usuario-->
<div id="userModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h2>Crear Usuario</h2>
            <span class="close" onclick="closeModalAgregar()">&times;</span>
        </div>
        
        <form id="userForm" onsubmit="guardarUsuario(event)">
            <div class="form-section">
                <h3>Información del Usuario</h3>
                
                <div class="form-grid">
                    <div class="form-group">
                        <label for="rutCrear">RUT</label>
                        <input type="text" id="rutCrear" name="rut" required placeholder="Ej: 12345678-9">
                    </div>
                    
                    <div class="form-group">
                        <label for="nombreCrear">Nombre Completo</label>
                        <input type="text" id="nombreCrear" name="nombre" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="emailCrear">Correo Electrónico</label>
                        <input type="email" id="emailCrear" name="email" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="telefonoCrear">Teléfono</label>
                        <input type="tel" id="telefonoCrear" name="telefono" placeholder="+56">
                    </div>

                    <div class="form-group">
                        <label for="fecha_nacimiento_Crear">Fecha de Nacimiento</label>
                        <input type="date" id="fecha_nacimiento_Crear" name="fecha_nacimiento" required>
                    </div>

                    <div class="form-group">
                        <label for="generoCrear">Género</label>
                        <select id="generoCrear" name="genero" required>
                            <option value="">Seleccionar Género</option>
                            <option value="masculino">Masculino</option>
                            <option value="femenino">Femenino</option>
                            <option value="otro">Otro</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="passwordCrear">Contraseña</label>
                        <input type="password" id="passwordCrear" name="password" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="rolCrear">Rol</label>
                        <select id="rolCrear" name="rol" required>
                            <option value="">Seleccionar Rol</option>
                            <option value="1">Administrador</option>
                            <option value="2">Vecino</option>
                        </select>
                    </div>
                </div>
            </div>
            
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="closeModalAgregar()">Cancelar</button>
                <button type="submit" class="btn btn-primary">Guardar</button>
            </div>
        </form>
    </div>
</div>

 <!-- Modal editar usuario-->
<div id="userModalEdit" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h2>Editar Usuario</h2>
            <span class="close" onclick="closeModalEdit()">&times;</span>
        </div>
        
        <form id="userFormEdit" onsubmit="guardarUsuarioEdit(event)">
            <div class="form-section">
                <h3>Información del Usuario</h3>
                
                <div class="form-grid">
                    <div class="form-group">
                        <label for="rutEdit">RUT</label>
                        <input type="text" id="rutEdit" name="rut" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="nombreEdit">Nombre Completo</label>
                        <input type="text" id="nombreEdit" name="nombre" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="emailEdit">Correo Electrónico</label>
                        <input type="email" id="emailEdit" name="email" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="telefonoEdit">Teléfono</label>
                        <input type="tel" id="telefonoEdit" name="telefono" placeholder="+56">
                    </div>

                    <div class="form-group">
                        <label for="fecha_nacimiento_Edit">Fecha de Nacimiento</label>
                        <input type="date" id="fecha_nacimiento_Edit" name="fecha_nacimiento" required>
                    </div>

                    <div class="form-group">
                        <label for="generoEdit">Género</label>
                        <select id="generoEdit" name="genero" required>
                            <option value="">Seleccionar Género</option>
                            <option value="masculino">Masculino</option>
                            <option value="femenino">Femenino</option>
                            <option value="otro">Otro</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="passwordEdit">Contraseña</label>
                        <input type="password" id="passwordEdit" name="password" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="rolEdit">Rol</label>
                        <select id="rolEdit" name="rol" required>
                            <option value="">Seleccionar Rol</option>
                            <option value="1">Administrador</option>
                            <option value="2">Vecino</option>
                        </select>
                    </div>
                </div>
            </div>
            
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="closeModalEditar()">Cancelar</button>
                <button type="submit" class="btn btn-primary">Guardar</button>
            </div>
        </form>
    </div>
</div>

 <!-- Modal ver usuario-->
<div id="userModalVer" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h2>Ver Usuario</h2>
            <span class="close" onclick="closeModalVer()">&times;</span>
        </div>
        
        <form id="userFormVer">
            <div class="form-section">
                <h3>Información del Usuario</h3>
                
                <div class="form-grid">
                    <div class="form-group">
                        <label for="rutVer">RUT</label>
                        <input disabled type="text" id="rutVer" name="rut" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="nombreVer">Nombre Completo</label>
                        <input  disabled type="text" id="nombreVer" name="nombre" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="emailVer">Correo Electrónico</label>
                        <input  disabled type="email" id="emailVer" name="email" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="telefonoVer">Teléfono</label>
                        <input  disabled type="tel" id="telefonoVer" name="telefono" placeholder="+56">
                    </div>

                    <div class="form-group">
                        <label for="fecha_nacimiento_ver">Fecha de Nacimiento</label>
                        <input disabled type="date" id="fecha_nacimiento_ver" name="fecha_nacimiento" required>
                    </div>

                    <div class="form-group">
                        <label for="generoVer">Género</label>
                        <select id="generoVer" name="genero" required disabled>
                            <option value="">Seleccionar Género</option>
                            <option value="masculino">Masculino</option>
                            <option value="femenino">Femenino</option>
                            <option value="otro">Otro</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="passwordVer">Contraseña</label>
                        <input disabled type="password" id="passwordVer" name="password" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="rolVer">Rol</label>
                        <select id="rolVer" name="rol" required disabled>
                            <option value="">Seleccionar Rol</option>
                            <option value="1">Administrador</option>
                            <option value="2">Vecino</option>
                        </select>
                    </div>
                </div>
            </div>
            
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="closeModalVer()">Cancelar</button>
                <button type="submit" class="btn btn-primary">Guardar</button>
            </div>
        </form>
    </div>
</div>

<!-- Modal confirmación de eliminación -->
<div id="deleteConfirmModal" class="modal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-secundary rounded">
                <div class="modal-title text-grey h2">
                    Eliminar
                </div>
                <button type="button" class="btn-close" aria-label="Close" onclick="closeDeleteModal()"></button>
            </div>
            <div class="modal-body">
                <p style="font-size: 18px; margin-bottom: 20px;">¿Estás seguro que deseas eliminar este usuario de forma permanente?</p>
                <div style="display: flex; justify-content: flex-end; gap: 10px;">
                    <button onclick="closeDeleteModal()" class="btn-open" style="background-color: #004D99;">Cancelar</button>
                    <button onclick="confirmarEliminacion()" class="btn-open" style="background-color: #dc3545;">Eliminar</button>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Tabla de usuarios --}}
<table class="user-table">
    <thead>
        <tr>
            <th class="user-table-th">ID</th>
            <th class="user-table-th">Nombre</th>
            <th class="user-table-th">Rut</th>
            <th class="user-table-th">Correo</th>
            <th class="user-table-th">Teléfono</th>
            <th class="user-table-th">Rol</th>
            <th class="user-table-th">Estado</th>
            <th class="user-table-th">Última Conexión</th>
            <th class="user-table-th">Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($usuarios as $usuario)
        <tr class="user-table-row">
            <td class="user-table-cell">{{ $usuario->id }}</td>
            <td class="user-table-cell">{{ $usuario->nombre }}</td>
            <td class="user-table-cell">{{ $usuario->rut }}</td>
            <td class="user-table-cell">{{ $usuario->email }}</td>
            <td class="user-table-cell">{{ $usuario->telefono }}</td>
            <td class="user-table-cell">{{ $usuario->rol }}</td>
            <td class="user-table-cell">{{ $usuario->estado = true ? 'Habilitado' : 'Deshabilitado' }}</td>
            <td class="user-table-cell">{{ $usuario->fecha_registro }}</td>
            <td class="user-table-cell">
                <div class="action-buttons">
                    <button onclick="editarUsuario({{ $usuario->id }})" 
                        class="action-btn edit-btn"
                        title="Editar usuario">
                        <i class="fas fa-edit"></i>
                    </button>
                    <button onclick="verUsuario({{ $usuario->id }})"
                        class="action-btn view-btn"
                        title="Ver usuario">
                        <i class="fas fa-eye"></i>
                    </button>
                    <button onclick="eliminarUsuario({{ $usuario->id }})"
                        class="action-btn delete-btn"
                        title="Eliminar usuario">
                        <i class="fas fa-trash-alt"></i>
                    </button>
                    <button onclick="deshabilitarUsuario({{ $usuario->id }})" 
                        class="action-btn toggle-btn"
                        data-estado="{{ $usuario->estado }}"
                        title="{{ $usuario->estado === 1 ? 'Deshabilitar usuario' : 'Habilitar usuario' }}">
                    @if($usuario->estado === 1)
                        <i class="fas fa-user"></i>
                    @else
                        <i class="fas fa-user-slash"></i>
                    @endif
                </button>
                </div> 
            </td>
        </tr>
        @endforeach
    </tbody>
</table>


<script src="{{ asset('js/usuarios.js') }}"></script>

<style>
    /* Tabla */
    .user-table {
        width: 100%;
        border-collapse: collapse;
        background-color: #f5f5f5;
        }

    .user-table th,
    .user-table td {
        padding: 12px 16px;
        text-align: left;
        border-bottom: 1px solid #ddd;
        }

    .user-table th {
        background-color: #0e0d49;
        color: white;
        }

    .user-table tr:hover {
        background-color: #e6e6e6;
        }

    /* Botones de Acción */
    .btn {
        display: inline-block;
        padding: 8px 16px;
        border-radius: 4px;
        text-decoration: none;
        font-weight: bold;
        transition: background-color 0.3s ease;
        }

    .btn-primary {
        background-color: #00d1b2;
        color: white;
        }

    .btn-primary:hover {
        background-color: #00b29e;
        }

    .btn-danger {
        background-color: #ff3860;
        color: white;
        }

    .btn-danger:hover {
        background-color: #f14668;
        }

    /* Información del Usuario */
    .user-info {
        background-color: #f5f5f5;
        padding: 16px;
        border-radius: 4px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

    .user-info h3 {
        color: #2A2859;
        margin-bottom: 8px;
        }

    .user-info p {
    margin-bottom: 4px;
    }


        /* Contenedor principal de botones */
        .action-buttons {
        display: flex;          /* Hace que los botones se alineen horizontalmente */
        gap: 5px;              /* Espacio uniforme entre botones */
        justify-content: center; /* Centra los botones horizontalmente */
        align-items: center;    /* Centra los botones verticalmente */
    }

    /* Estilo base para todos los botones */
    .action-btn {
        width: 35px;           /* Ancho fijo para todos los botones */
        height: 35px;          /* Alto fijo para todos los botones */
        border: none;          /* Elimina los bordes */
        border-radius: 5px;    /* Esquinas redondeadas */
        display: flex;         /* Para centrar los íconos dentro del botón */
        align-items: center;   /* Centra el ícono verticalmente */
        justify-content: center; /* Centra el ícono horizontalmente */
        cursor: pointer;       /* Cambia el cursor a mano al hover */
        transition: opacity 0.3s; /* Animación suave al hover */
    }

    /* Efecto al pasar el mouse */
    .action-btn:hover {
        opacity: 0.8;          /* Hace el botón ligeramente transparente al hover */
    }

    /* Colores específicos para cada acción */
    .edit-btn {
        background-color: #e2ac09; /* Azul para editar */
    }

    .view-btn {
        background-color: #62676b; /* Azul oscuro para ver */
    }

    .delete-btn {
        background-color: #dc3545; /* Rojo para eliminar */
    }

    /* Colores diferentes para habilitar/deshabilitar */
    .toggle-btn[data-estado="1"] {
        background-color: #28a745; /* Verde para usuario habilitado */
    }

    .toggle-btn[data-estado="0"] {
        background-color: #e2ac09; /* Amarillo para usuario deshabilitado */
    }

    /* Estilo para los íconos */
    .action-btn i {
        color: white;         /* Color blanco para todos los íconos */
        font-size: 14px;      /* Tamaño uniforme para los íconos */
    }




    .create-user-btn {
        margin: 20px 0;
        padding: 10px 20px;
        background-color: #00d1b2;
        color: white;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .modal {
        display: none;
        position: fixed;
        z-index: 1000;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0,0,0,0.5);
    }

    .modal-content {
        background-color: #fff;
        margin: 5% auto;
        width: 80%;
        max-width: 800px;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }

    .modal-header {
        background-color: #181f47;
        color: white;
        padding: 15px 20px;
        border-radius: 8px 8px 0 0;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .close {
        color: white;
        font-size: 28px;
        cursor: pointer;
    }

    .form-section {
        padding: 20px;
    }

    .form-section h3 {
        color: #363636;
        margin-bottom: 20px;
        padding-bottom: 10px;
        border-bottom: 1px solid #dbdbdb;
    }

    .form-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 20px;
    }

    .form-group {
        margin-bottom: 15px;
    }

    .form-group label {
        display: block;
        margin-bottom: 5px;
        color: #363636;
        font-weight: 500;
    }

    .form-group input,
    .form-group select {
        width: 100%;
        padding: 8px 12px;
        border: 1px solid #dbdbdb;
        border-radius: 4px;
        font-size: 14px;
    }

    .modal-footer {
        padding: 15px 20px;
        background-color: #f5f5f5;
        border-radius: 0 0 8px 8px;
        display: flex;
        justify-content: flex-end;
        gap: 10px;
    }

    .btn {
        padding: 8px 16px;
        border-radius: 4px;
        border: none;
        cursor: pointer;
        font-weight: 500;
    }

    .btn-secondary {
        background-color: #b5b5b5;
        color: white;
    }

    .btn-primary {
        background-color: #181f47;
        color: white;
    }

    

</style>


<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

@endsection