<?php
// Conexión a la base de datos (debes configurar tus propios datos de conexión)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "aeropuerto";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener la ruta desde la URL
$ruta = $_GET['ruta'];

// Consulta SQL para obtener el tipo de aeropuerto basado en la ruta
$sql = "SELECT Tipo FROM aeropuertos WHERE RUTA = '$ruta'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Devolver el tipo de aeropuerto como JSON
    $row = $result->fetch_assoc();
    echo json_encode($row);
} else {
    // Si no se encontraron resultados, devolver un JSON vacío o un mensaje de error
    echo json_encode(array()); // Opcional: podrías manejar un mensaje de error aquí
}

// Cerrar la conexión
$conn->close();
?>
