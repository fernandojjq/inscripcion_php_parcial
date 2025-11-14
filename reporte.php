<?php
require_once 'conexion.php';
try {
    $db = new Conexion();
    $conn = $db->getConexion();
    
    // La consulta SQL ahora trae las columnas correctas
    $sql = "SELECT i.*, p.nombre AS nombre_pais 
            FROM inscriptores i 
            JOIN paises p ON i.id_pais_residencia = p.id 
            ORDER BY i.id DESC";
    
    $stmt = $conn->query($sql);
    $registros = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    die("Error al obtener los registros: " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reporte de Inscriptores - iTECH</title>
    <link rel="stylesheet" href="estilos.css">
    <style>
        .report-container { max-width: 1200px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { padding: 12px; border: 1px solid #ddd; text-align: left; }
        th { background-color: #2c3e50; color: white; }
        tr:nth-child(even) { background-color: #f9f9f9; }
        a { color: #4A90E2; text-decoration: none; }
        a:hover { text-decoration: underline; }
    </style>
</head>
<body>
    <div class="form-container report-container">
        <h1>Reporte de Datos Guardados</h1>
        <p><a href="index.php">&larr; Volver al formulario</a></p>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Correo</th>
                    <th>Teléfono</th>
                    <th>País Res.</th>
                    <th>Temas de Interés</th>
                    <th>Observaciones</th>
                    <th>Fecha</th>
                </tr>
            </thead>
            <tbody>
                <?php if (count($registros) > 0): ?>
                    <?php foreach ($registros as $row): ?>
                        <tr>
                            <!-- Actualizamos las celdas para que coincidan con las columnas -->
                            <td><?php echo htmlspecialchars($row['id']); ?></td>
                            <td><?php echo htmlspecialchars($row['nombre']); ?></td>
                            <td><?php echo htmlspecialchars($row['apellido']); ?></td>
                            <td><?php echo htmlspecialchars($row['correo']); ?></td>
                            <td><?php echo htmlspecialchars($row['telefono']); ?></td>
                            <td><?php echo htmlspecialchars($row['nombre_pais']); ?></td>
                            <td><?php echo htmlspecialchars($row['temas_interes'] ?? ''); ?></td>
                            <td><?php echo htmlspecialchars($row['observaciones'] ?? ''); ?></td>
                            <td><?php echo htmlspecialchars($row['fecha_registro']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="9">Aún no hay registros guardados.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>
</html>