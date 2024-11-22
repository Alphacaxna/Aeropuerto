<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "aeropuerto";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener datos del formulario
$matricula = $_POST['matricula'];
$tipo_de_avion = $_POST['tipo_de_avion'];
$aerolinea = $_POST['aerolinea'];
$calificador = $_POST['calificador'];

// Insertar datos
$sql = "INSERT INTO aviones (matricula, tipo_de_avion, aerolinea, calificador) VALUES ('$matricula', '$tipo_de_avion', '$aerolinea', '$calificador')";

if ($conn->query($sql) === TRUE) {
    echo "Nuevo avión registrado con éxito";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
