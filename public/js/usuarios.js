
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


// Modal de confirmación de eliminación
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
            await axios.delete(`eliminarUsuario/${usuarioIdAEliminar}`);
            
            mostrarMensaje('Usuario eliminado correctamente');
            
            setTimeout(() => {
                location.reload();
            }, 3000);  
            
            closeDeleteModal();
        } catch (error) {
            console.error("Error al eliminar:", error);
            mostrarMensaje('Error al eliminar usuario', 'error');
        }
    }
}


//Modal de confirmación de deshabilitación
let usuarioIdADeshabilitar = null;
function closeDeshabilitarModal() {
    document.getElementById("dehabilitarConfirmModal").style.display = "none";
}
function mostrarConfirmacionDeshabilitar(id) {
    usuarioIdADeshabilitar = id;
    
    // Obtén el estado actual del usuario correctamente
    const botonEstado = document.querySelector(`.action-btn.toggle-btn[onclick="mostrarConfirmacionDeshabilitar(${id})"]`);
    const estadoActual = botonEstado.classList.contains('enabled');
    
    const tituloModal = document.getElementById('disable-content');
    const botonModal = document.getElementById('disable-button');
    
    if (estadoActual) {
        // Usuario habilitado, preparar para deshabilitar
        tituloModal.innerHTML = '<h3>¿Estás seguro de deshabilitar este usuario?</h3>';
        botonModal.innerHTML = '<i class="fas fa-user-slash"></i> Deshabilitar';
    } else {
        // Usuario deshabilitado, preparar para habilitar
        tituloModal.innerHTML = '<h3>¿Estás seguro de habilitar este usuario?</h3>';
        botonModal.innerHTML = '<i class="fas fa-user-check"></i> Habilitar';
    }
    
    document.getElementById("dehabilitarConfirmModal").style.display = "block";
}

async function confirmarDeshabilitar() {
    if (!usuarioIdADeshabilitar) return;

    try {
        const response = await axios.post(`/deshabilitarUsuario/${usuarioIdADeshabilitar}`);
        const { message, estado } = response.data;

        // Mostrar mensaje de éxito
        mostrarMensaje(message);

        location.reload();

        // Cerrar el modal
        closeDeshabilitarModal();
    } catch (error) {
        console.error("Error al deshabilitar:", error);
        mostrarMensaje('Error al deshabilitar usuario', 'error');
    }
}



// FUNCIONES CRUD 


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



function mostrarMensaje(mensaje, tipo = 'success') {
    // Remover cualquier mensaje anterior
    const mensajeAnterior = document.getElementById('mensaje-notificacion');
    if (mensajeAnterior) {
        mensajeAnterior.remove();
    }

    // Crear elemento de mensaje
    const mensajeElemento = document.createElement('div');
    mensajeElemento.id = 'mensaje-notificacion';
    mensajeElemento.style.cssText = `
        position: fixed;
        top: 20px;
        left: 50%;
        transform: translateX(-50%);
        background-color: ${tipo === 'success' ? '#28a745' : '#dc3545'};
        color: white;
        padding: 10px 20px;
        border-radius: 5px;
        box-shadow: 0 2px 5px rgba(0,0,0,0.2);
        z-index: 1000;
        text-align: center;
    `;

    mensajeElemento.textContent = mensaje;

    // Agregar al body
    document.body.appendChild(mensajeElemento);

    // Ocultar después de 3 segundos
    setTimeout(() => {
        mensajeElemento.style.transition = 'opacity 0.5s';
        mensajeElemento.style.opacity = '0';
        
        // Remover del DOM después de la transición
        setTimeout(() => {
            mensajeElemento.remove();
        }, 500);
    }, 3000);
}

    
async function filtrarUsuarios() {
    try {
        // Obtener valores de los filtros
        const nombre = document.getElementById('nombreFiltro').value;
        const rut = document.getElementById('rutFiltro').value;
        const rol = document.getElementById('rolFiltro').value;
        const estado = document.getElementById('estadoFiltro').value;

        // Realizar petición al servidor con los parámetros de filtro
        const response = await axios.get('/usuarios', {
            params: { nombre, rut, rol, estado }
        });

        // La respuesta debe ser un HTML completo que reemplazará el contenido actual
        document.body.innerHTML = response.data;

    } catch (error) {
        console.error("Error al filtrar:", error);
        mostrarMensaje('Error al filtrar usuarios', 'error');
    }
}


