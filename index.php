<?php
// ---- PASO 1: INICIAR LA SESIÓN ----
// También debe ser lo primero aquí para poder leer las variables de sesión.
session_start();

require_once 'conexion.php';
$db = new Conexion();
$conn = $db->getConexion();
$stmt = $conn->query("SELECT id, nombre FROM paises ORDER BY nombre ASC");
$paises = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscripción al Evento iTECH</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
    <div class="form-container">
        <h1>Formulario de Inscripción iTECH</h1>
        
        <?php
        // ---- PASO 2: MOSTRAR Y BORRAR EL MENSAJE FLASH ----
        if (isset($_SESSION['flash_message'])) {
            // Obtenemos el tipo de mensaje (exito o error) para la clase CSS
            $tipo_mensaje = $_SESSION['flash_message']['type'];
            $texto_mensaje = $_SESSION['flash_message']['text'];
            
            // Mostramos el mensaje
            echo "<p class='mensaje $tipo_mensaje'>$texto_mensaje</p>";
            
            // Borramos el mensaje de la sesión para que no se muestre de nuevo
            unset($_SESSION['flash_message']);
        }
        ?>

        <form action="procesar.php" method="POST">
            <!-- El resto del formulario no cambia -->
            <div class="form-group"><label for="nombre">Nombre:</label><input type="text" id="nombre" name="nombre" required></div>
            <div class="form-group"><label for="apellido">Apellido:</label><input type="text" id="apellido" name="apellido" required></div>
            <div class="form-group"><label for="edad">Edad:</label><input type="number" id="edad" name="edad" required></div>
            <div class="form-group"><label>Sexo:</label><div class="inline-group"><input type="radio" id="masculino" name="sexo" value="Masculino" required> <label for="masculino">Masculino</label></div><div class="inline-group"><input type="radio" id="femenino" name="sexo" value="Femenino"> <label for="femenino">Femenino</label></div></div>
            <div class="form-group"><label for="pais_residencia">País de Residencia:</label><select id="pais_residencia" name="pais_residencia" required><option value="">-- Seleccione un país --</option><?php foreach ($paises as $pais): ?><option value="<?php echo $pais['id']; ?>"><?php echo htmlspecialchars($pais['nombre']); ?></option><?php endforeach; ?></select></div>
            <div class="form-group"><label for="nacionalidad">Nacionalidad:</label><input type="text" id="nacionalidad" name="nacionalidad" required></div>
            <div class="form-group"><label for="correo">Correo Electrónico:</label><input type="email" id="correo" name="correo" placeholder="tu.correo@ejemplo.com" required></div>
            <div class="form-group"><label for="telefono">Teléfono:</label><input type="tel" id="telefono" name="telefono" placeholder="6000-0000" required></div>
            <div class="form-group">
                <label>Temas de Interés (selecciona los que te gusten):</label>
                <div class="inline-group"><input type="checkbox" id="datos" name="temas[]" value="Análisis de Datos"> <label for="datos">Análisis de Datos</label></div>
                <div class="inline-group"><input type="checkbox" id="cuantica" name="temas[]" value="Computación Cuántica"> <label for="cuantica">Computación Cuántica</label></div>
                <div class="inline-group"><input type="checkbox" id="diseno" name="temas[]" value="Diseño Web"> <label for="diseno">Diseño Web</label></div>
                <div class="inline-group"><input type="checkbox" id="pruebas" name="temas[]" value="Pruebas de Software"> <label for="pruebas">Pruebas de Software</label></div>
                <div class="inline-group"><input type="checkbox" id="ciber" name="temas[]" value="Ciberseguridad"> <label for="ciber">Ciberseguridad</label></div>
            </div>
            <div class="form-group"><label for="observaciones">Observaciones o Consulta sobre el evento:</label><textarea id="observaciones" name="observaciones" rows="4"></textarea></div>
            <button type="submit">Enviar Inscripción</button>
        </form>
    </div>
    <footer><p>&copy; <?php echo date('Y'); ?> iTECH. All rights reserved. | Contacto: fernando.jimenez@itech.com</p></footer>
</body>
</html>