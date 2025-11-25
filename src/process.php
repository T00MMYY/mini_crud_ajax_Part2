<?php
require __DIR__ . '/includes/functions.php';

// 1) Aceptamos solo POST. Si no, volvemos al formulario.
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php');
    exit;
}

// 2) Recoger y limpiar lo mínimo (trim para quitar espacios)
$input = [
    'nombre' => trim($_POST['nombre'] ?? ''),
    'apellido' => trim($_POST['apellido'] ?? ''),
    'apellido2' => trim($_POST['apellido2'] ?? ''),
    'fecha_nac' => trim($_POST['fecha_nac'] ?? ''),
    'genero' => trim($_POST['genero'] ?? ''),
    'email' => trim($_POST['email'] ?? ''),
    'grupo' => trim($_POST['grupo'] ?? ''),
    'preferencia' => trim($_POST['preferencia'] ?? ''),
    'colaborar' => trim($_POST['colaborar'] ?? ''),
    'evitar' => trim($_POST['evitar'] ?? ''),
    'motivo_evitar' => trim($_POST['motivo_evitar'] ?? ''),
    'participacion' => trim($_POST['participacion'] ?? ''),
    'estilo_trabajo' => trim($_POST['estilo_trabajo'] ?? ''),
    'comunicacion' => trim($_POST['comunicacion'] ?? ''),
    'rol_habitual' => trim($_POST['rol_habitual'] ?? ''),
    'rol_fuerte' => trim($_POST['rol_fuerte'] ?? ''),
    'puntuacion' => trim($_POST['puntuacion'] ?? ''),
    'tiempo' => trim($_POST['tiempo'] ?? ''),
    'estres_proyecto' => trim($_POST['estres_proyecto'] ?? ''),
    'dispositivo' => trim($_POST['dispositivo'] ?? ''),
    'navegador' => trim($_POST['navegador'] ?? ''),
    'preferido' => trim($_POST['preferido'] ?? '')
];

// 3) Validar (muy básico)
$errors = [];

// 4) Si hay errores: rehidratar (volver a index con $old_field y $errors)
$obligatorios = ['nombre', 'apellido', 'fecha_nac', 'genero', 'grupo', 'preferencia', 'participacion', 'dispositivo'];

foreach ($obligatorios as $campo) {
    if ($input[$campo] === '') {
        $errors[$campo] = "El campo '$campo' es obligatorio.";
    }
}

// Validaciones específicas
if (!empty($input['email']) && !filter_var($input['email'], FILTER_VALIDATE_EMAIL)) {
    $errors['email'] = "El email no tiene un formato válido.";
}

if (!empty($input['puntuacion']) && ($input['puntuacion'] < 0 || $input['puntuacion'] > 10)) {
    $errors['puntuacion'] = "La puntuación debe estar entre 0 y 10.";
}

// Si hay errores: volver al formulario con los datos y errores
if ($errors) {
    $old_field = $input;
    include __DIR__ . '/includes/header.php';
    include __DIR__ . '/index.php'; // reutilizamos tu formulario
    include __DIR__ . '/includes/footer.php';
    exit;
}

// Si no hay errores → guardar en JSON
$file = __DIR__ . '/data/sociograma.json';
$todo = load_json($file);

$nuevo = $input;
$nuevo['fecha_envio'] = date('Y-m-d H:i:s');

$todo[] = $nuevo;

// Guardar el archivo
if (!save_json($file, $todo)) {
    http_response_code(500);
    echo "<p style='color:red;'>Error al guardar los datos. Intenta más tarde.</p>";
    exit;
}

// Confirmación final
include __DIR__ . '/includes/header.php';
?>
<main class="container">
    <div class="formularioEnviado">
        <h2>Gracias, <?= htmlspecialchars($input['nombre']) ?>. Tu respuesta se ha guardado
            correctamente.</h2>
        <p>Total de respuestas recogidas: <strong><?= count($todo) ?></strong></p>
        <p><a href="index.php">Volver al formulario</a></p>
    </div>
</main>
<?php include __DIR__ . '/includes/footer.php'; ?>