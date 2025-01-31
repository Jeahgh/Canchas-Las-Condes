@extends('layouts.app')
 
@section('content')



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
            <td class="user-table-cell">{{ $usuario->estado }}</td>
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


<script>
    // Funciones para el CRUD
    let usuarioIdEditando = null;
    
    // Abrir el modal
    // function openModalAgregar() {
    //     document.getElementById("userModal").style.display = "block";  // Muestra el modal
    // }
    
    // Cerrar el modal
    // function closeModalAgregar() {
    //     document.getElementById("userModal").style.display = "none";   // Oculta el modal
    // }

    // function openModalEdit() {
    //     document.getElementById("userModalEdit").style.display = "block";  // Muestra el modal
    // }
    
    // Cerrar el modal
    // function closeModalEdit() {
    //     document.getElementById("userModalEdit").style.display = "none";   // Oculta el modal
    // }
    // function openModalVer() {
    //     document.getElementById("userModalVer").style.display = "block";  // Muestra el modal
    // }
    
    // Cerrar el modal
    // function closeModalVer() {
    //     document.getElementById("userModalVer").style.display = "none";   // Oculta el modal
    // }

    
    // Cargar usuarios
    async function cargarUsuarios() {
        try {
            const response = await axios.get('/getUsuarios');
            let data = response.data;
            console.log("Esta es mi informacion:: ",data);
            
            // actualizarTablaUsuarios(usuarios);
        } catch (error) {
            console.error("Error al cargar usuarios:", error);
        }
    }

    
    // Crear o actualizar usuario
    async function guardarUsuario(event) {
        event.preventDefault();
        const formData = new FormData(event.target);
        const datos = Object.fromEntries(formData);
        
        try {
            await axios.post('/createUser', datos);
            closeModalAgregar();
            location.reload();
        } catch (error) {
            console.error("Error al guardar:", error);
        }
    }
    
    //Editar usuario
    async function editarUsuario(id) {
        usuarioIdEditando = id; // Guardamos el ID
        openModalEdit();
        try {
            const response = await axios.post(`/editarUsuario/${id}`);
             // Guardamos los datos del usuario que nos devolvió el servidor
            const usuario = response.data;
            
            // Llena los campos del formulario
            document.querySelector('#nameEdit').value = usuario.name;
            document.querySelector('#emailEdit').value = usuario.email;
            document.querySelector('#telefonoEdit').value = usuario.telefono;
        } catch (error) {
            console.error("Error al cargar los datos del usuario:", error);
            // Y mostramos una alerta al usuario
            alert("No se pudo cargar la información del usuario.");
        }
    }


    async function deshabilitarUsuario(id) {
        try {
            const response = await axios.post(`/deshabilitarUsuario/${id}`);
            alert(response.data.message);
            window.location.reload(); // Recarga inmediata después de cerrar la alerta
        } catch (error) {
            console.error("Error al cambiar estado del usuario:", error);
            alert("Error al cambiar el estado del usuario");
        }
    }

    async function actualizarUsuario(event) {
        event.preventDefault();
        
        if (!usuarioIdEditando) return;

        // Creamos un objeto con todos los datos del formulario
        const formData = new FormData(event.target);
        const datos = Object.fromEntries(formData);
        
        try {
            await axios.put(`/usuarios/${usuarioIdEditando}`, datos);
            closeModalEdit();
            location.reload(); // Recarga la página para ver los cambios
        } catch (error) {
            console.error("Error al actualizar:", error);
            alert("Error al actualizar el usuario: le fatla un campo por asignar");
        }
    }

    async function verUsuario(id) {
        openModalVer();
        try {
            // Obtén los datos del usuario desde el backend
            const response = await axios.get(`/getUsuarios/${id}`);
            const usuario = response.data;
            console.log('usuarios:: ', usuario);
            
            // Llena los campos del formulario del modal
            document.querySelector('#nameVer').value = usuario.name;
            document.querySelector('#emailVer').value = usuario.email;
            document.querySelector('#telefonoVer').value = usuario.telefono;


            // Muestra el modal
        } catch (error) {
            console.error("Error al cargar los datos del usuario:", error);
            alert("No se pudo cargar la información del usuario.");
        }
    }
        
    // Eliminar usuario
    async function eliminarUsuario(id) {
        if (confirm('¿Estás seguro de eliminar este usuario?')) {
            try {
                await axios.delete(`/usuarios/${id}`);
            } catch (error) {
                console.error("Error al eliminar:", error);
            }
        }
    }

    // funciones para eliminar al usuario


    let usuarioIdAEliminar = null;

    function closeDeleteModal() {
        document.getElementById("deleteConfirmModal").style.display = "none";
    }

    function mostrarConfirmacionEliminar(id) {
        usuarioIdAEliminar = id;
        document.getElementById("deleteConfirmModal").style.display = "block";
    }

    async function confirmarEliminacion() {
        if (usuarioIdAEliminar) {
            try {
                await axios.delete(`/usuarios/${usuarioIdAEliminar}`);
                cargarUsuarios();
                closeDeleteModal();
                location.reload()
            } catch (error) {
                console.error("Error al eliminar:", error);
            }
         }
    }

    function eliminarUsuario(id) {
    mostrarConfirmacionEliminar(id);
    }

    
    // Event Listeners
    document.getElementById('userForm').addEventListener('submit', guardarUsuario);
    document.addEventListener('DOMContentLoaded', cargarUsuarios);
    document.getElementById('userFormEdit').addEventListener('submit', actualizarUsuario);
</script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

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

</style>


@endsection