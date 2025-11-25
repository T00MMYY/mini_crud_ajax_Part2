<?php
declare(strict_types=1);

session_start();

if (isset($_SESSION['id'])) {
    if ($_SESSION['rol'] === 'admin') {
        header('Location: index_ajax.html');
    } else {
        header('Location: sociograma.php');
    }
    exit;
}

const RUTA_DATOS_JSON = 'data.json';
$mensaje_error = '';

/**
 * Carga los usuarios desde el archivo JSON (similar a getUsers() de api.php, pero sin envoltura JSON).
 * @return array Array de usuarios.
 */
function cargarUsuarios(): array
{
    if (!file_exists(RUTA_DATOS_JSON)) {
        return [];
    }
    $json_content = file_get_contents(RUTA_DATOS_JSON);
    $users = json_decode($json_content, true);
    return is_array($users) ? $users : [];
}

// 3. PROCESAR LOGIN
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email_ingresado = trim($_POST['email'] ?? '');
    $password_ingresada = $_POST['password'] ?? '';
    $usuarios = cargarUsuarios();
    $usuario_autenticado = null;

    // Buscar el usuario por email
    foreach ($usuarios as $usuario) {
        if (mb_strtolower($usuario['email'] ?? '') === mb_strtolower($email_ingresado)) {
            $usuario_autenticado = $usuario;
            break;
        }
    }

    if ($usuario_autenticado && password_verify($password_ingresada, $usuario_autenticado['password'] ?? '')) {
        
        $_SESSION['id'] = $usuario_autenticado['id'] ?? uniqid(); 
        $_SESSION['nombre'] = $usuario_autenticado['nombre'] ?? 'Invitado';
        $_SESSION['email'] = $usuario_autenticado['email'];
        $_SESSION['rol'] = $usuario_autenticado['rol'] ?? 'usuario'; 

        if ($_SESSION['rol'] === 'admin') {

            header('Location: index_ajax.html');
        } else {

            header('Location: sociograma.php');
        }
        exit;
    } else {
        $mensaje_error = "Email o contraseña incorrectos.";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login de Usuario</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/styles.css"> 
    <style>
        /* Estilos mínimos para el login, asumiendo que styles.css ya existe */
        body { font-family: sans-serif; background-color: #f4f4f4; display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0; }
        .login-container { background: white; padding: 20px; border-radius: 8px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); width: 300px; }
        .login-container h2 { text-align: center; margin-bottom: 20px; }
        .login-container label { display: block; margin-bottom: 5px; font-weight: bold; }
        .login-container input[type="email"], .login-container input[type="password"] { width: 100%; padding: 10px; margin-bottom: 15px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; }
        .login-container button { width: 100%; padding: 10px; background-color: #007bff; color: white; border: none; border-radius: 4px; cursor: pointer; }
        .login-container button:hover { background-color: #0056b3; }
        .error-msg { color: #dc3545; text-align: center; margin-bottom: 15px; }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Inicio de Sesión</h2>
        <?php if ($mensaje_error): ?>
            <p class="error-msg"><?php echo $mensaje_error; ?></p>
        <?php endif; ?>
        <form method="POST" action="login.php">
            <div>
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div>
                <label for="password">Contraseña:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit">Entrar</button>
        </form>
    </div>
</body>
</html>