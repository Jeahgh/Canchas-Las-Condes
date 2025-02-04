
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
    document.getElementById("dehabilitarConfirmModal").style.display = "block";
}

async function confirmarDeshabilitar() {
    if (!usuarioIdADeshabilitar) return;

    try {
        const response = await axios.post(`/deshabilitarUsuario/${usuarioIdADeshabilitar}`);
        const { message, estado } = response.data;

        // Mostrar mensaje de éxito
        mostrarMensaje(message);

        // Buscar botón y actualizar estado
        const boton = document.querySelector(`button[onclick="mostrarConfirmacionDeshabilitar(${usuarioIdADeshabilitar})"]`);
        if (boton) {
            // Actualizar data-estado y clase del botón
            boton.setAttribute('data-estado', estado ? "1" : "0");
            boton.setAttribute('title', estado ? 'Deshabilitar usuario' : 'Habilitar usuario');
            boton.innerHTML = estado ? '<i class="fas fa-user-check"></i>' : '<i class="fas fa-user-slash"></i>';
            
            // Forzar actualización de estilos
            boton.className = `action-btn toggle-btn`;
        }

        // Actualizar el estado en la tabla
        const celdaEstado = boton.closest('tr')?.querySelector('.user-table-cell:nth-child(7)');
        if (celdaEstado) {
            celdaEstado.textContent = estado ? 'Habilitado' : 'Deshabilitado';
        }

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

// Función para deshabilitar usuario


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

        // Realizar petición al servidor
        const response = await axios.post('/filtrarUsuarios', {
            nombre: nombre,
            rut: rut,
            rol: rol,
            estado: estado
        });

        // Actualizar la tabla con los resultados
        actualizarTabla(response.data);

    } catch (error) {
        console.error("Error al filtrar:", error);
        mostrarMensaje('Error al filtrar usuarios', 'error');
    }
}

function actualizarTabla(usuarios) {
    const tbody = document.querySelector('.user-table tbody');
    tbody.innerHTML = ''; // Limpiar tabla

    usuarios.forEach(usuario => {
        const tr = document.createElement('tr');
        tr.className = 'user-table-row';
        
        // Convertir el estado a 1/0 si es necesario
        const estadoValue = typeof usuario.estado === 'boolean' ? (usuario.estado ? 1 : 0) : usuario.estado;
        
        tr.innerHTML = `
            <td class="user-table-cell">${usuario.id}</td>
            <td class="user-table-cell">${usuario.nombre}</td>
            <td class="user-table-cell">${usuario.rut}</td>
            <td class="user-table-cell">${usuario.email}</td>
            <td class="user-table-cell">${usuario.telefono}</td>
            <td class="user-table-cell">${usuario.rol}</td>
            <td class="user-table-cell">${estadoValue == 1 ? 'Habilitado' : 'Deshabilitado'}</td>
            <td class="user-table-cell">${usuario.fecha_registro}</td>
            <td class="user-table-cell">
                <div class="action-buttons">
                    <button onclick="editarUsuario(${usuario.id})" 
                        class="action-btn edit-btn" 
                        title="Editar usuario">
                        <i class="fas fa-edit"></i>
                    </button>
                    <button onclick="verUsuario(${usuario.id})" 
                        class="action-btn view-btn" 
                        title="Ver usuario">
                        <i class="fas fa-eye"></i>
                    </button>
                    <button onclick="mostrarConfirmacionEliminar(${usuario.id})" 
                        class="action-btn delete-btn" 
                        title="Eliminar usuario">
                        <i class="fas fa-trash-alt"></i>
                    </button>
                    <button onclick="mostrarConfirmacionDeshabilitar(${usuario.id})" 
                        class="action-btn toggle-btn" 
                        data-estado="${estadoValue}"
                        style="background-color: ${estadoValue == 1 ? '#28a745' : '#e2ac09'}"
                        title="${estadoValue == 1 ? 'Deshabilitar usuario' : 'Habilitar usuario'}">
                        <i class="fas fa-user-${estadoValue == 1 ? 'check' : 'slash'}"></i>
                    </button>
                </div>
            </td>
        `;
        tbody.appendChild(tr);
    });
}

