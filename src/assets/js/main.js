// -----------------------------------------------------------------------------
// Mini CRUD AJAX — Lado cliente (sin librerías)

// Archivo: /assets/js/main.js (VERSIÓN CON EDITAR - CORREGIDA Y SEGURA)
// -----------------------------------------------------------------------------

/** URL absoluta o relativa del endpoint PHP (API del servidor) */
const URL_API_SERVIDOR = "/api.php";

/** Elementos del DOM */
const nodoCuerpoTablaUsuarios = document.getElementById("tbody");
const nodoFilaEstadoVacio = document.getElementById("fila-estado-vacio");
const formularioAltaUsuario = document.getElementById("formCreate");
const nodoZonaMensajesEstado = document.getElementById("msg");
const nodoBotonAgregarUsuario = document.getElementById("boton-agregar-usuario");
const nodoIndicadorCargando = document.getElementById("indicador-cargando");

// Índice del usuario que se está editando (o null si estamos creando)
let indiceEditando = null;

// -----------------------------------------------------------------------------
// Mensajes de estado
// -----------------------------------------------------------------------------
function mostrarMensajeDeEstado(tipoEstado, textoMensaje) {
  nodoZonaMensajesEstado.className = tipoEstado;
  nodoZonaMensajesEstado.textContent = textoMensaje;
  if (tipoEstado !== "") {
    setTimeout(() => {
      nodoZonaMensajesEstado.className = "";
      nodoZonaMensajesEstado.textContent = "";
    }, 2000);
  }
}

// -----------------------------------------------------------------------------
// Indicadores de carga
// -----------------------------------------------------------------------------
function activarEstadoCargando() {
  if (nodoBotonAgregarUsuario) nodoBotonAgregarUsuario.disabled = true;
  if (nodoIndicadorCargando) nodoIndicadorCargando.hidden = false;
}
function desactivarEstadoCargando() {
  if (nodoBotonAgregarUsuario) nodoBotonAgregarUsuario.disabled = false;
  if (nodoIndicadorCargando) nodoIndicadorCargando.hidden = true;
}

// -----------------------------------------------------------------------------
// Sanitización HTML
// -----------------------------------------------------------------------------
function convertirATextoSeguro(texto) {
  return String(texto)
    .replaceAll("&", "&amp;")
    .replaceAll("<", "&lt;")
    .replaceAll(">", "&gt;")
    .replaceAll('"', "&quot;")
    .replaceAll("'", "&#39;");
}

// -----------------------------------------------------------------------------
// Renderizado de tabla
// -----------------------------------------------------------------------------
function renderizarTablaDeUsuarios(arrayUsuarios) {
  nodoCuerpoTablaUsuarios.innerHTML = "";

  if (!Array.isArray(arrayUsuarios) || arrayUsuarios.length === 0) {
    nodoFilaEstadoVacio.hidden = false;
    return;
  }
  nodoFilaEstadoVacio.hidden = true;

  arrayUsuarios.forEach((usuario, pos) => {
    const fila = document.createElement("tr");
    fila.innerHTML = `
td>${pos + 1}</td>
<td>${convertirATextoSeguro(usuario?.nombre ?? "")}</td>
<td>${convertirATextoSeguro(usuario?.email ?? "")}</td>
<td>${convertirATextoSeguro(usuario?.rol ?? "")}</td>
<td>
 <button type="button" class="btn-editar" data-posicion="${pos}">
 Editar
</button>
<button type="button" class="btn-eliminar" data-posicion="${pos}">
Eliminar
 </button>
 </td>
`;
    nodoCuerpoTablaUsuarios.appendChild(fila);
  });
}

// -----------------------------------------------------------------------------
// GET list
// -----------------------------------------------------------------------------
async function obtenerYMostrarListadoDeUsuarios() {
  try {
    const r = await fetch(`${URL_API_SERVIDOR}?action=list`);
    const json = await r.json();
    if (!json.ok) throw new Error(json.error);

    renderizarTablaDeUsuarios(json.data);
  } catch (err) {
    mostrarMensajeDeEstado("error", err.message);
  }
}

// -----------------------------------------------------------------------------
// SUBMIT (crear o editar)
// -----------------------------------------------------------------------------
formularioAltaUsuario?.addEventListener("submit", async (e) => {
  e.preventDefault();

  const datos = new FormData(formularioAltaUsuario);
  const usuario = {
    nombre: String(datos.get("nombre") || "").trim(),
    email: String(datos.get("email") || "").trim(),
    password: String(datos.get("password") || "").trim(),
    rol: String(datos.get("rol") || "").trim(),
  };

  if (!usuario.nombre || !usuario.email || !usuario.rol) {
    mostrarMensajeDeEstado("error", "El nombre, email y rol son obligatorios.");
    return;
  }

  if (indiceEditando === null && !usuario.password) {
    mostrarMensajeDeEstado(
      "error",
      "La contraseña es obligatoria al crear un usuario."
    );
    return;
  }

  let action = indiceEditando === null ? "create" : "update";
  let body =
    indiceEditando === null ? usuario : { index: indiceEditando, ...usuario };

  try {
    activarEstadoCargando();

    const r = await fetch(`${URL_API_SERVIDOR}?action=${action}`, {
      method: "POST",
      headers: { "Content-Type": "application/json" },
      body: JSON.stringify(body),
    });

    const json = await r.json();
    if (!json.ok) throw new Error(json.error);

    renderizarTablaDeUsuarios(json.data);
    formularioAltaUsuario.reset();

    if (indiceEditando !== null) {
      mostrarMensajeDeEstado("ok", "Usuario actualizado correctamente.");
      nodoBotonAgregarUsuario.textContent = "Agregar usuario";
      indiceEditando = null;
    } else {
      mostrarMensajeDeEstado("ok", "Usuario agregado correctamente.");
    }
  } catch (err) {
    mostrarMensajeDeEstado("error", err.message);
  } finally {
    desactivarEstadoCargando();
  }
});

// -----------------------------------------------------------------------------
// Delegación de eventos para EDITAR y ELIMINAR
// -----------------------------------------------------------------------------
nodoCuerpoTablaUsuarios?.addEventListener("click", async (e) => {
  const boton = e.target.closest("button[data-posicion]");
  if (!boton) return;

  const index = parseInt(boton.dataset.posicion, 10);
  if (!Number.isInteger(index)) return; // ---------------------------- // EDITAR // ----------------------------

  if (boton.classList.contains("btn-editar")) {
    try {
      const r = await fetch(`${URL_API_SERVIDOR}?action=list`);
      const json = await r.json();
      if (!json.ok) throw new Error(json.error);

      const usuario = json.data[index];
      if (!usuario) return;

      formularioAltaUsuario.nombre.value = usuario.nombre;
      formularioAltaUsuario.email.value = usuario.email;
      formularioAltaUsuario.rol.value = usuario.rol;

      indiceEditando = index;
      nodoBotonAgregarUsuario.textContent = "Guardar cambios";
    } catch (err) {
      mostrarMensajeDeEstado("error", err.message);
    }

    return;
  }
  // ---------------------------- // ELIMINAR // ----------------------------

  if (boton.classList.contains("btn-eliminar")) {
    if (!confirm("¿Deseas eliminar este usuario?")) return;

    try {
      const r = await fetch(`${URL_API_SERVIDOR}?action=delete`, {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ index }),
      });

      const json = await r.json();
      if (!json.ok) throw new Error(json.error);

      renderizarTablaDeUsuarios(json.data);
      mostrarMensajeDeEstado("ok", "Usuario eliminado correctamente.");
    } catch (err) {
      mostrarMensajeDeEstado("error", err.message);
    }
  }
});

// -----------------------------------------------------------------------------
// Inicialización
// -----------------------------------------------------------------------------
obtenerYMostrarListadoDeUsuarios();