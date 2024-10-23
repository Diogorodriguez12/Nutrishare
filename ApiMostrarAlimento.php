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

// Obtener todos los alimentos
$sql = "SELECT * FROM alimentos";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Alimentos Nutrishare</title>
    <style>
        /* Colores */
        :root {
            --verde-oscuro: #283618;
            --verde-medio: #606c38;
            --crema: #fefae0;
        }

        /* Estilos generales */
        body {
            font-family: Arial, sans-serif;
            background-color: var(--crema);
            color: var(--verde-oscuro);
            margin: 0;
            padding: 20px;
        }

        h1 {
            color: var(--verde-oscuro);
            text-align: center;
            font-size: 2.5rem;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 10px;
            text-align: left;
            border: 1px solid var(--verde-oscuro);
        }

        th {
            background-color: var(--verde-medio);
            color: var(--crema);
        }

        tr:nth-child(even) {
            background-color: #e2e2e2; /* Color de fondo alternativo para filas */
        }
    </style>
</head>
<body>
    <h1>Lista de Alimentos Nutrishare</h1>
    <table>
        <tr>
            <th>Nombre</th>
            <th>Descripción</th>
            <th>Cantidad</th>
            <th>Fecha de caducidad</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?php echo htmlspecialchars($row['nombre']); ?></td>
            <td><?php echo htmlspecialchars($row['descripcion']); ?></td>
            <td><?php echo htmlspecialchars($row['cantidad']); ?></td>
            <td><?php echo htmlspecialchars($row['fecha_caducidad']); ?></td>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>

<?php $conn->close(); ?>
