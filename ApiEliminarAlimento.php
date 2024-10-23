<?php
// Datos de la base de datos
$host = 'localhost';
$db = 'bdalimentos';
$user = 'root';
$pass = '';

// Crear conexión
$conn = new mysqli($host, $user, $pass, $db);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Verificar si el formulario fue enviado y si la clave 'id' existe en $_POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['id'])) {
        // Obtener el ID del alimento
        $id = $_POST['id'];

        // Crear la consulta para eliminar el alimento con el ID proporcionado
        $sql = "DELETE FROM alimentos WHERE id_alimento = '$id'";

        if ($conn->query($sql) === TRUE) {
            echo "Alimento eliminado correctamente";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Error: Falta el ID del alimento.";
    }
} else {
    echo "Método incorrecto. Usa POST para eliminar datos.";
}

$conn->close();
?>
