<?php
// Iniciar la sesión
session_start();

require_once 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php');
    exit;
}

// Validación de campos obligatorios
$required_fields = ['nombre', 'apellido', 'edad', 'sexo', 'pais_residencia', 'nacionalidad', 'correo', 'telefono'];
foreach ($required_fields as $field) {
    if (empty(trim($_POST[$field]))) {
        $_SESSION['flash_message'] = [
            'type' => 'error',
            'text' => 'Error: Revisa que todos los campos obligatorios estén llenos.'
        ];
        header('Location: index.php');
        exit;
    }
}

// Recolección y Formateo de Datos
$nombre = trim($_POST['nombre']);
$apellido = trim($_POST['apellido']);
$nombre_formateado = ucfirst(strtolower($nombre));
$apellido_formateado = ucfirst(strtolower($apellido));

$edad = (int)$_POST['edad'];
$sexo = $_POST['sexo'];
$id_pais_residencia = (int)$_POST['pais_residencia'];
$nacionalidad = $_POST['nacionalidad'];
$correo = $_POST['correo'];
$telefono = $_POST['telefono'];
$temas_interes = isset($_POST['temas']) ? implode(', ', $_POST['temas']) : null;
$observaciones = !empty($_POST['observaciones']) ? trim($_POST['observaciones']) : null;


// Guardado en la Base de Datos
try {
    $db = new Conexion();
    $conn = $db->getConexion();

    $sql = "INSERT INTO inscriptores (nombre, apellido, edad, sexo, id_pais_residencia, nacionalidad, correo, telefono, temas_interes, observaciones) VALUES (:nombre, :apellido, :edad, :sexo, :id_pais, :nacionalidad, :correo, :telefono, :temas, :obs)";

    $stmt = $conn->prepare($sql);
    
    // VINCULACIÓN DE PARÁMETROS (AQUÍ ESTÁ LA CORRECCIÓN)
    $stmt->bindParam(':nombre', $nombre_formateado);
    $stmt->bindParam(':apellido', $apellido_formateado); // <- LÍNEA CORREGIDA
    $stmt->bindParam(':edad', $edad);
    $stmt->bindParam(':sexo', $sexo);
    $stmt->bindParam(':id_pais', $id_pais_residencia);
    $stmt->bindParam(':nacionalidad', $nacionalidad);
    $stmt->bindParam(':correo', $correo);
    $stmt->bindParam(':telefono', $telefono);
    $stmt->bindParam(':temas', $temas_interes);
    $stmt->bindParam(':obs', $observaciones);
    
    $stmt->execute();

    // Crear el mensaje dinámico para la sesión
    $mensaje_exito = "¡Gracias, " . htmlspecialchars($nombre_formateado) . " " . htmlspecialchars($apellido_formateado) . "! Tus datos se guardaron correctamente.";
    
    $_SESSION['flash_message'] = [
        'type' => 'exito',
        'text' => $mensaje_exito
    ];

    // Redirigir sin parámetros en la URL
    header('Location: index.php');
    exit;

} catch (PDOException $e) {
    die("Error al guardar en la base de datos: " . $e->getMessage());
}
?>