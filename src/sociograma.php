<?php

require __DIR__ . '/includes/functions.php';
include __DIR__ . '/includes/header.php';

$old_field = isset($old_field) ? $old_field : [];
$errors = isset($errors) ? $errors : [];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>


<body>
    <form method="POST" action="process.php" autocomplete="off">
        <h2 class="subtitulo">Formulario Sociograma</h2>

        <fieldset>
            <legend> Información personal</legend>

            <div class="form-group">
                <label for="nombre" class="label_titulo">Nombre</label>
                <input type="text" id="nombre" name="nombre" placeholder="Introduce tu nombre" required>
            </div>
            <div class="form-group ">
                <label for="apellido" class="label_titulo"> Primer apellido</label>
                <input type="text" id="apellido" name="apellido" placeholder="Introduce tu apellido" required>
            </div>
            <div class="form-group">
                <label for="apellido2" class="label_titulo">Segundo apellido</label>
                <input type="text" id="apellido2" name="apellido2" placeholder="Introduce tu segundo apellido">
            </div>
            <div class="form-group">
                <label for="fecha_nac" class="label_titulo">Fecha de nacimiento</label>
                <input type="date" id="fecha_nac" name="fecha_nac" required>
            </div>
            <div class="form-group">
                <label for="genero" class="label_titulo">Género</label>
                <select name="genero" id="genero" required>
                    <option value=""></option>
                    <option value="Hombre">Hombre</option>
                    <option value="Mujer">Mujer</option>
                    <option value="Otro">Otro</option>
                </select>
            </div>
            <div class="form-group">
                <label for="email" class="label_titulo">Email</label>
                <input type="email" id="email" name="email" placeholder="Introduce tu email">
            </div>
            <div class="form-group">
                <label for="grupo" class="label_titulo">Grupo</label>
                <select name="grupo" id="grupo" required>
                    <option value=""></option>
                    <option value="1DAW">1 DAW</option>
                    <option value="2DAW">2 DAW</option>
                </select>
            </div>
        </fieldset>

        <fieldset>
            <legend>Preferencia Colaboracion</legend>
            <div class="form-group">
                <label for="preferencia" class="label_titulo">Con quién te sientes más cercano/a?</label>
                <input type="text" id="preferencia" name="preferencia" required>
            </div>
            <div class="form-group">
                <label for="colaborar" class="label_titulo">Con quién prefieres trabajar?</label>
                <input type="text" id="colaborar" name="colaborar">
            </div>
            <div class="form-group">
                <label for="evitar" class="label_titulo">Con quién no te gustaría trabajar?</label>
                <input type="text" id="evitar" name="evitar">
            </div>
            <div class="form-group">
                <label for="motivo_evitar" class="label_titulo">Motivo</label>
                <textarea id="motivo_evitar" name="motivo_evitar" style="height: 50px; "></textarea>
            </div>
        </fieldset>
        <fieldset>
            <legend>Personalidad</legend>
            <div class="form-group">
                <label for="participacion" class="label_titulo">Que rol te considarias en un grupo de
                    trabajo?</label>
                <select name="participacion" id="participacion" required>
                    <option value=""></option>
                    <option value="lider">Lider</option>
                    <option value="seguidor">Seguidor</option>
                    <option value="observador">Observador</option>
                    <option value="mediador">Mediador</option>
                    <option value="iniciativa">Con Iniciativa</option>

                </select>
            </div>
            <div class="form-group">
                <label for="estilo_trabajo" class="label_titulo">Cual crees que es tu estilo de trabajo?</label>
                <select name="estilo_trabajo" id="estilo_trabajo">
                    <option value=""></option>
                    <option value="colaborativo">Colaborativo</option>
                    <option value="independiente">Independiente</option>
                    <option value="mixto">Mixto</option>
                </select>
            </div>
            <div class="form-group">
                <label for="comunicacion" class="label_titulo">Como prefieres comunicarte con tu grupo de
                    trabajo?</label>
                <select name="comunicacion" id="comunicacion">
                    <option value=""></option>
                    <option value="escrito">Escrito</option>
                    <option value="oral">Oral</option>
                    <option value="mixta">Mixta</option>
                </select>
            </div>
        </fieldset>
        <fieldset>
            <legend>Rol y habilidades</legend>
            <div class="form-group">
                <label class="label_titulo">Rol habitual</label>
                <label class="label_input"><input type="radio" name="rol_habitual" value="Frontend">
                    Frontend</label>
                <label class="label_input"><input type="radio" name="rol_habitual" value="Backend"> Backend</label>
                <label class="label_input"><input type="radio" name="rol_habitual" value="Fullstack">
                    Fullstack</label>
                <label class="label_input"><input type="radio" name="rol_habitual" value="DevOps"> DevOps</label>
            </div>
            <div class="form-group">
                <label class="label_titulo">Rol Fuerte</label>
                <label class="label_input"><input type="radio" name="rol_fuerte" value="Frontend"> Frontend</label>
                <label class="label_input"><input type="radio" name="rol_fuerte" value="Backend"> Backend</label>
                <label class="label_input"><input type="radio" name="rol_fuerte" value="Fullstack">
                    Fullstack</label>
                <label class="label_input"><input type="radio" name="rol_fuerte" value="DevOps"> DevOps</label>
            </div>
            <div class="form-group">
                <label for="puntuacion" class="label_titulo">Que puntuacion te darias del 1 al 10 en DAW?</label>
                <input type="number" id="puntuacion" name="puntuacion" min="0" max="10" style="padding: 0 10px;">
            </div>
        </fieldset>

        <fieldset>

            <legend>Organización y bienestar</legend>
            <div class="form-group">
                <label class="label_titulo">Tiempo</label>
                <select name="tiempo" id="tiempo">
                    <option value=""></option>
                    <option value="baja">Baja</option>
                    <option value="media">Media</option>
                    <option value="alta">Alta</option>
                </select>
            </div>
            <div class="form-group">
                <label class="label_titulo">Cuanto estres te provocan los proyectos ?</label>
                <input type="range" name="estres_proyecto" min="0" max="10" value="1">
            </div>
        </fieldset>

        <fieldset>
            <legend>Logistica</legend>
            <div class="form-group">
                <label for="dispositivo" class="label_titulo">Que dispositivo usas para trabajar?</label>
                <select name="dispositivo" id="dispositivo" required>
                    <option value=""></option>
                    <option value="portatil">Portatil</option>
                    <option value="sobremesa">Sobremesa</option>
                    <option value="tablet">Tablet</option>
                    <option value="telefono">Telefono</option>
                </select>
            </div>

            <div class="form-group">
                <label for="navegador" class="label_titulo">Que navegador prefieres?</label>
                <select name="navegador" id="navegador">
                    <option value=""></option>
                    <option value="chrome">Chrome</option>
                    <option value="firefox">Firefox</option>
                    <option value="edge">Edge</option>
                    <option value="otro">Otro</option>
                </select>
            </div>
            <div class="form-group">
                <label for="dispositivo_preferido" class="label_titulo">Que dispositivo prefieres usar?</label>
                <label><input type="radio" name="preferido" value="portatil">Portatil</label>
                <label><input type="radio" name="preferido" value="sobremesa">Sobremesa</label>
                <label><input type="radio" name="preferido" value="tablet">Tablet</label>
                <label><input type="radio" name="preferido" value="telefono">Telefono</label>
            </div>
        </fieldset>
        <button type="submit">Enviar</button>
    </form>
    <?php
    include __DIR__ . '/includes/footer.php';
    ?>
</body>

</html>
<style scoped>
    * {
        margin: 0;
        padding: 0;
        font-family: Arial, Helvetica, sans-serif;
        box-sizing: border-box;
    }

    body {
        min-height: 100vh;
        display: flex;
        flex-direction: column;
    }

    main {
        flex: 1;
        padding: 20px;
    }

    header {
        background-color: rgba(122, 122, 122, 0.651);
        padding: 30px;
        border-bottom: 2px solid black;
        color: #fff;
        font-size: 1.6rem;
        letter-spacing: 1px;
        display: flex;
        flex-direction: row;
        justify-content: space-between;
    }
    
    footer {
        background-color: rgba(122, 122, 122, 0.651);
        left: 0;
        right: 0;
        bottom: 0;
        z-index: 1000;
        padding: 30px;
        margin-top: 20px;
        text-align: center;
        color: #000000;

    }

    form {
        max-width: 1400px;
        margin: 40px auto;
        border-radius: 15px;
    }

    .subtitulo {
        text-align: center;
        margin-top: 35px;
        margin-bottom: 25px;
        color: #333;
        font-size: 32px;
    }

    fieldset {
        margin: 0 60px;
        margin-top: 20px;
        padding: 20px;
        border-radius: 12px;
        border: 1.7px solid #888888;
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1rem 2rem;
    }

    legend {
        font-weight: 600;
        color: #222;
        padding: 0 5px;
        font-size: 22px;
    }

    .form-group {
        display: flex;
        flex-direction: column;
    }

    .label_titulo {
        font-size: 18px;
        margin-bottom: 6px;
        color: #000000;
    }

    .label_input {
        margin-bottom: 3px;
        color: rgb(56, 56, 56);
    }

    input,
    select,
    textarea {
        border: 2px solid #d1d0d0;
        border-radius: 12px;
        padding: 6px 10px;
        font-size: 15px;
        transition: border-color 0.2s ease, box-shadow 0.2s ease;
    }

    input:focus,
    select:focus,
    textarea:focus {
        outline: none;
        border-color: #7993c4;
    }

    input[type="radio"] {
        margin-right: 6px;
        accent-color: #2668cc;
    }

    button {
        cursor: pointer;
        padding: 10px 25px;
        border-radius: 12px;
        border: 2px solid #8a8a8a;
        background-color: #e0e0e0;
        margin: 25px 55px;
        font-weight: bold;
        transition: background-color 0.3s ease, transform 0.2s ease;
    }

    button:hover {
        background-color: #5a8dee;
        color: white;
        border-color: #4a7ce0;
        transform: scale(1.05);
    }

    .formularioEnviado {
        text-align: center;
        margin-top: 30px;
    }

    .formularioEnviado h2 {
        color: #333;
        margin-bottom: 10px;
    }
</style>