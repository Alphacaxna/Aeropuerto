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

// Obtener la matrícula desde la URL
$matricula = $_GET['matricula'];

// Consulta SQL para obtener los datos de la matrícula
$sql = "SELECT Tipo_de_avion, aerolinea, calificador, Max_Pax FROM matriculas WHERE matricula = '$matricula'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Devolver los datos como un array asociativo en formato JSON
    $row = $result->fetch_assoc();
    echo json_encode($row);
} else {
    // Si no se encontraron resultados, devolver un JSON vacío o un mensaje de error
    echo json_encode(array()); // Opcional: podrías manejar un mensaje de error aquí
}

// Cerrar la conexión
$conn->close();
?>
