# 🚀 Mini-CRUD AJAX con Login y Sesiones (PHP & JSON)

Este proyecto representa la implementación completa de un sistema CRUD (Create, Read, Update, Delete) de usuarios, integrando autenticación, gestión de sesiones y comunicación asíncrona (AJAX). El objetivo principal es simular una aplicación web moderna y funcional sin depender de una base de datos relacional, utilizando archivos JSON para la persistencia de datos.

---

## ✨ Características Principales

* **Autenticación Segura:** Sistema de Login/Logout con gestión de sesiones PHP y cifrado de contraseñas (`password_hash`).
* **Gestión de Roles:** Diferenciación entre usuarios con rol `admin` (acceso al CRUD completo) y rol `usuario` (solo vista restringida, ej: Sociograma).
* **CRUD Completo y Asíncrono:** Operaciones de Crear, Listar, **Editar** y Eliminar usuarios sin recargar la página, utilizando `fetch()` y respuestas JSON.
* **Persistencia de Datos:** Todos los datos de usuario se almacenan y gestionan en el archivo `data.json`.
* **Arquitectura API:** Un único *endpoint* en PHP (`api.php`) maneja todas las acciones y devuelve respuestas estructuradas en formato JSON.

---

## 🛠️ Tecnologías Utilizadas

| Componente | Tecnología | Uso |
| :--- | :--- | :--- |
| **Backend** | PHP 8.x + Apache | Lógica de negocio, gestión de sesiones y API. |
| **Frontend** | HTML, CSS, JavaScript | Interfaz de usuario, manejo de eventos y peticiones asíncronas (`fetch()`). |
| **Entorno** | Docker / Docker Compose | Contenedorización del ambiente de desarrollo. |
| **Datos** | JSON | Formato de almacenamiento y transferencia de datos.

---

## ⚙️ Estructura del Proyecto

La estructura del proyecto sigue un diseño coherente para separar las preocupaciones (presentación, lógica pública y persistencia):

---

## 🔑 Implementación de Seguridad y Persistencia

### Modelo de Usuario

El archivo `data.json` almacena un array de usuarios con la siguiente estructura, garantizando la seguridad de la contraseña:

```json
[
  {
    "id": 1,
    "nombre": "tommyAdmin",
    "email": "tommy@example.com",
    "password": "$2y$10$...", // Contraseña cifrada con password_hash()
    "rol": "admin"
  }
]

https://github.com/T00MMYY/mini_crud_ajax_Part2.git