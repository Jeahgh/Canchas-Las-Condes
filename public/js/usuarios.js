
// FUNCIONNES DE MODALES

// Abrir y cerrar el modal AGREGAR
function openModalAgregar() {
    document.getElementById("userModal").style.display = "block";
}
function closeModalAgregar() {
    document.getElementById("userModal").style.display = "none";
    document.getElementById("userForm").reset();
}

// Abrir y cerrar el modal EDITAR
function openModalEdit() {
        document.getElementById("userModalEdit").style.display = "block";
}
function closeModalEdit() {
        document.getElementById("userModalEdit").style.display = "none";
}

// Abrir y cerrar el modal VER
function openModalVer() {
    document.getElementById("userModalVer").style.display = "block";
}
function closeModalVer() {
    document.getElementById("userModalVer").style.display = "none"; 
}

// Confirmar eliminación
let usuarioIdAEliminar = null;
function mostrarConfirmacionEliminar(id) {
    usuarioIdAEliminar = id;
    document.getElementById("deleteConfirmModal").style.display = "block";
}
function closeDeleteModal() {
    document.getElementById("deleteConfirmModal").style.display = "none";
}






// FUNCIONES CRUD Y DEHASHABILITAR USUARIO
let usuarioIdEditando = null;

// Cerrar el modal si se hace clic fuera de él
window.onclick = function(event) {
    const modal = document.getElementById("userModal");
    if (event.target == modal) {
        closeModalAgregar();
    }
}

//Función guardar usuario
async function guardarUsuarioEdit(event) {
    event.preventDefault();
    const formData = new FormData(event.target);
    const datos = Object.fromEntries(formData);
    
    try {
        const response = await axios.post(`editarUsuario/${usuarioIdEditando}`, datos);
        closeModalEdit();
        location.reload();
    } catch (error) {
        console.error("Error al guardar:", error);
        if (error.response && error.response.data) {
            alert("Error: " + JSON.stringify(error.response.data));
        } else {
            alert("Error al guardar el usuario");
        }
    }
}

// Crear o actualizar usuario
async function guardarUsuario(event) {
    event.preventDefault();
    const formData = new FormData(event.target);
    const datos = Object.fromEntries(formData);
    
    try {
        const response = await axios.post('crearUsuario', datos);
        closeModalAgregar();
        location.reload();
    } catch (error) {
        console.error("Error al guardar:", error);
        if (error.response && error.response.data) {
            alert("Error: " + JSON.stringify(error.response.data));
        } else {
            alert("Error al guardar el usuario");
        }
    }
}

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
    
// Función para editar usuario
async function editarUsuario(id) {
    usuarioIdEditando = id; // Guardamos el ID
    openModalEdit();
    try {
        const response = await axios.get(`/editarUsuario/${id}`);
        const usuario = response.data;

        console.log("Datos de usuario recibidos:", usuario);
        
        // Autocompletar los campos del formulario de edición
        document.getElementById('rutEdit').value = usuario.rut;
        document.getElementById('nombreEdit').value = usuario.nombre;
        document.getElementById('emailEdit').value = usuario.email;
        document.getElementById('telefonoEdit').value = usuario.telefono;
        const fechaNacimiento = new Date(usuario.fecha_nacimiento);
        document.getElementById('fecha_nacimiento_Edit').value = fechaNacimiento.toISOString().slice(0, 10);
        document.getElementById('generoEdit').value = usuario.genero;
        document.getElementById('rolEdit').value = usuario.rol;
        console.log(usuario.fecha_nacimiento);
        
        // Nota: No autocompletamos la contraseña por seguridad
    } catch (error) {
        console.error("Error al cargar los datos del usuario:", error);
        alert("No se pudo cargar la información del usuario.");
    }
}

// Función para ver usuario
async function verUsuario(id) {
    openModalVer();
    try {
        const response = await axios.get(`verUsuario/${id}`);
        const usuario = response.data;
        
        // Autocompletar los campos del formulario de visualización
        document.getElementById('rutVer').value = usuario.rut;
        document.getElementById('nombreVer').value = usuario.nombre;
        document.getElementById('emailVer').value = usuario.email;
        document.getElementById('telefonoVer').value = usuario.telefono;
        const fechaNacimiento = new Date(usuario.fecha_nacimiento);
        document.getElementById('fecha_nacimiento_ver').value = fechaNacimiento.toISOString().slice(0, 10);
        document.getElementById('generoVer').value = usuario.genero;
        document.getElementById('rolVer').value = usuario.rol;
    } catch (error) {
        console.error("Error al cargar los datos del usuario:", error);
        alert("No se pudo cargar la información del usuario.");
    }
}   

// Función para deshabilitar usuario
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

// Funciones para eliminar usuario
async function eliminarUsuario(id) {
    if (confirm('¿Estás seguro de eliminar este usuario?')) {
        try {
            await axios.delete(`/eliminarUsuario/${id}`);
        } catch (error) {
            console.error("Error al eliminar:", error);
        }
    }
}

async function confirmarEliminacion() {
    if (usuarioIdAEliminar) {
        try {
            await axios.delete(`eliminarUsuario/${usuarioIdAEliminar}`);
            closeDeleteModal();
            location.reload(); // Recargar la página para reflejar los cambios
        } catch (error) {
            console.error("Error al eliminar:", error);
            alert("No se pudo eliminar el usuario");
        }
    }
}

function eliminarUsuario(id) {
    mostrarConfirmacionEliminar(id);
}

    


