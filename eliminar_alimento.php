<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar Alimento</title>
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
            margin-bottom: 10px;
        }

        h2 {
            color: var(--verde-oscuro);
            text-align: center;
            font-size: 2rem;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            background-color: var(--verde-medio);
        }

        th, td {
            border: 1px solid var(--verde-oscuro);
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: var(--verde-oscuro);
            color: var(--crema);
        }

        td button {
            background-color: var(--verde-oscuro);
            color: var(--crema);
            border: none;
            padding: 5px 10px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        td button:hover {
            background-color: var(--verde-medio);
        }
    </style>
    <script>
        // Función para eliminar un alimento basado en el ID
        function eliminarAlimento(id) {
            if (confirm("¿Estás seguro de que quieres eliminar este alimento?")) {
                // Crear un objeto FormData para enviar la solicitud POST
                const formData = new FormData();
                formData.append('id', id);

                // Hacer la solicitud a ApiEliminarAlimento.php
                fetch('ApiEliminarAlimento.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.text())
                .then(data => {
                    alert(data); // Mostrar respuesta del servidor
                    location.reload(); // Recargar la página para actualizar la lista
                })
                .catch(error => {
                    alert("Error al eliminar el alimento: " + error);
                });
            }
        }
    </script>
</head>
<body>

    <h1>Nutrishare</h1>
    <h2>Eliminar Alimentos</h2>
    
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Cantidad</th>
                <th>Fecha de Caducidad</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Conexión a la base de datos
            $host = 'localhost';
            $db = 'bdalimentos';
            $user = 'root';
            $pass = '';

            $conn = new mysqli($host, $user, $pass, $db);

            // Verificar conexión
            if ($conn->connect_error) {
                die("Conexión fallida: " . $conn->connect_error);
            }

            // Consulta para obtener los alimentos
            $sql = "SELECT id_alimento, nombre, descripcion, cantidad, fecha_caducidad FROM alimentos";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // Mostrar los datos en la tabla
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['id_alimento'] . "</td>";
                    echo "<td>" . $row['nombre'] . "</td>";
                    echo "<td>" . $row['descripcion'] . "</td>";
                    echo "<td>" . $row['cantidad'] . "</td>";
                    echo "<td>" . $row['fecha_caducidad'] . "</td>";
                    echo "<td><button onclick=\"eliminarAlimento(" . $row['id_alimento'] . ")\">Eliminar</button></td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='6'>No hay alimentos registrados.</td></tr>";
            }

            $conn->close();
            ?>
        </tbody>
    </table>

</body>
</html>
