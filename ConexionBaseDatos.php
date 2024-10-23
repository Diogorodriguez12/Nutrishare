<?php
// Conectar a la base de datos
$host = 'localhost';
$db = 'bdalimentos';
$user = 'root';
$pass = '';
$conn = new mysqli($host, $user, $pass, $db);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Recibir datos del formulario
$nombre = $_POST['nombre'];
$descripcion = $_POST['descripcion'];
$cantidad = $_POST['cantidad'];
$fecha_caducidad = $_POST['fecha_caducidad'];

// Consulta para insertar el alimento
$sql = "INSERT INTO alimentos (nombre, descripcion, cantidad, fecha_caducidad) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssis", $nombre, $descripcion, $cantidad, $fecha_caducidad);

if ($stmt->execute()) {
    // Respuesta de éxito
    echo "<script>
        alert('Alimento subido correctamente');
        window.location.href = 'index.html';
    </script>";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
