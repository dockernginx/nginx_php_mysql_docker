<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido a mi aplicación PHP con MySQL</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }
        h1 {
            color: #0066cc;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f4f4f4;
        }
    </style>
</head>
<body>
    <h1>Bienvenido a mi aplicación PHP con MySQL</h1>
    
    <?php
    $fecha_actual = date("d-m-Y H:i:s");
    echo "<p>Hoy es: $fecha_actual</p>";
    
    echo "<p>Esta página está siendo servida por PHP " . phpversion() . " y Nginx.</p>";
    
    echo "<h2>Información del servidor:</h2>";
    echo "<ul>";
    echo "<li>Nombre del servidor: " . $_SERVER['SERVER_NAME'] . "</li>";
    echo "<li>Puerto: " . $_SERVER['SERVER_PORT'] . "</li>";
    echo "<li>Dirección IP del servidor: " . $_SERVER['SERVER_ADDR'] . "</li>";
    echo "</ul>";

    // Intentar conectar a MySQL
    $host = 'db';  // Nombre del servicio en docker-compose.yml
    $user = 'myuser';
    $pass = 'mypassword';
    $db = 'myapp';

    // Conectar a la base de datos
    $conn = new mysqli($host, $user, $pass, $db);

    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    } else {
        echo "<p>Conexión exitosa a MySQL!</p>";

        // Ejecutar consulta para obtener los datos de la tabla personas
        $sql = "SELECT id, nombre, apellido, edad, email, fecha_registro FROM personas";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Mostrar los datos en una tabla HTML
            echo "<h2>Lista de Personas:</h2>";
            echo "<table>";
            echo "<tr><th>ID</th><th>Nombre</th><th>Apellido</th><th>Edad</th><th>Email</th><th>Fecha de Registro</th></tr>";
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["id"] . "</td>";
                echo "<td>" . $row["nombre"] . "</td>";
                echo "<td>" . $row["apellido"] . "</td>";
                echo "<td>" . $row["edad"] . "</td>";
                echo "<td>" . $row["email"] . "</td>";
                echo "<td>" . $row["fecha_registro"] . "</td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "<p>No se encontraron personas en la base de datos.</p>";
        }

        $conn->close();
    }
    ?>

    <p>¡Gracias por visitar nuestra página!</p>
</body>
</html>
