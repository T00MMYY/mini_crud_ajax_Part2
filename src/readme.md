Cómo funciona el botón “Editar”
El botón Editar permite modificar un usuario sin recargar la página.

Cada fila de la tabla tiene un botón “Editar” con un atributo data-posicion que indica el índice del usuario en la lista.

Detectar el clic: Se usa un eventListener en la tabla que detecta cuándo se hace clic en un botón “Editar”.

Cargar datos en el formulario:

Se obtienen los datos del usuario desde la lista.

Se rellenan los campos del formulario con esos datos.

Se cambia el botón a “Actualizar usuario” y el título del formulario a “Editar usuario”.

Guardar cambios: Al enviar el formulario, los datos actualizados se envían al servidor y la tabla se refresca automáticamente.

# PARTE 2 DEL MINI_CRUD
Resumen Ultra-Básico de la Práctica
Esta práctica es sobre cómo crear una aplicación web moderna y dinámica sin usar una base de datos tradicional, enfocándose en la interacción fluida entre el navegador y el servidor.

🧱 Los 3 Componentes Clave
Todo el proyecto se construye combinando tres tecnologías principales:

PHP (Servidor): Es el cerebro. Recibe lo que envía el usuario (formularios, acciones) y decide qué hacer. Se encarga de la lógica de negocio.

JSON (Almacenamiento): Es el disco duro temporal. Guarda los datos de los usuarios y todo lo demás en un archivo de texto simple (data.json).


JavaScript con fetch() (Navegador): Es la mano derecha del usuario. Envía y recibe datos de PHP de forma asíncrona. Esto permite que la página no se recargue con cada acción (Crear, Eliminar, etc.).



🔑 Funcionalidades Principales

Mini-CRUD (Gestión de Usuarios): Permite Crear, Leer, Editar y Eliminar usuarios.



Login y Sesiones: El sistema tiene una pantalla de inicio de sesión. Si el usuario se conecta, PHP usa las Sesiones (\$_SESSION) para recordar quién es y qué permisos tiene (Administrador o Usuario normal).




Seguridad: Las contraseñas se guardan de forma segura (cifradas) usando la función password_hash() de PHP.


↔️ Flujo de Trabajo (Asíncrono)
En lugar de recargar la página completa, el flujo es:


Acción del Usuario: El usuario hace clic en "Eliminar" o "Crear".


Cliente (JS): JavaScript usa fetch() para enviar los datos a un archivo PHP (api.php).


Servidor (PHP): api.php procesa la acción y actualiza el archivo data.json.



Respuesta: api.php devuelve la nueva lista de usuarios en formato JSON.


Cliente (JS): JavaScript recibe el JSON y actualiza solo la tabla en la pantalla sin recargar la página.