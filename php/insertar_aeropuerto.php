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
$ruta = $_POST['ruta'];
$tipo = $_POST['tipo'];
$nombre = $_POST['nombre'];

// Insertar datos
$sql = "INSERT INTO aeropuertos (ruta, tipo, nombre) VALUES ('$ruta', '$tipo', '$nombre')";

if ($conn->query($sql) === TRUE) {
    echo "Nuevo aeropuerto registrado con éxito";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
