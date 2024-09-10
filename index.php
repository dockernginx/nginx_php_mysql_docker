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
    $host = 'db';  // Este es el nombre del servicio en docker-compose.yml
    $user = 'myuser';
    $pass = 'mypassword';
    $db = 'myapp';

    $conn = new mysqli($host, $user, $pass, $db);

    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    } else {
        echo "<p>Conexión exitosa a MySQL!</p>";
    }

    $conn->close();
    ?>

    <p>¡Gracias por visitar nuestra página!</p>
</body>
</html>
