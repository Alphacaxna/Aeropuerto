<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "aeropuerto";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Preparar y vincular
$stmt = $conn->prepare("INSERT INTO vuelos (
    consecutivo, fecha, aeropuerto, inicioFinOps, horaItinerario, hora, matricula, 
    aeronave, origen, destino, aerolinea, tipoMov, pista, vuelo, maxPax, factorOcup, 
    calf, tipoLlegada, tipoSalida, posicion, adultosNac, adultosInt, infantesNac, 
    infantesInt, transitoNac, transitoInt, conexionNac, conexionInt, exentosNac, 
    exentosInt, totalNac, totalInt, totalPax, pzasEquipaje, kgsEquipaje, kgsCarga, 
    correo, mostrador, banda, ptaAbordaje, observaciones) 
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

// Verificar si hubo un error al preparar la consulta
if (!$stmt) {
    die('Error al preparar la consulta: ' . $conn->error);
}

// Vincular los parámetros usando bind_param
$stmt->bind_param("issssssssssssssssssiiiiiiiiiiiiiiiiiiiiis", 
    $_POST['consecutivo'], $_POST['fecha'], $_POST['aeropuerto'], $_POST['inicioFinOps'], 
    $_POST['horaItinerario'], $_POST['hora'], $_POST['matricula'], $_POST['aeronave'], 
    $_POST['origen'], $_POST['destino'], $_POST['aerolinea'], $_POST['tipoMov'], 
    $_POST['pista'], $_POST['vuelo'], $_POST['maxPax'], $_POST['factorOcup'], $_POST['calf'], 
    $_POST['tipoLlegada'], $_POST['tipoSalida'], $_POST['posicion'], $_POST['adultosNac'], 
    $_POST['adultosInt'], $_POST['infantesNac'], $_POST['infantesInt'], $_POST['transitoNac'], 
    $_POST['transitoInt'], $_POST['conexionNac'], $_POST['conexionInt'], $_POST['exentosNac'], 
    $_POST['exentosInt'], $_POST['totalNac'], $_POST['totalInt'], $_POST['totalPax'], 
    $_POST['pzasEquipaje'], $_POST['kgsEquipaje'], $_POST['kgsCarga'], $_POST['correo'], 
    $_POST['mostrador'], $_POST['banda'], $_POST['ptaAbordaje'], $_POST['observaciones']);

// Ejecutar la declaración
if ($stmt->execute()) {
    echo "Nuevo vuelo registrado con éxito";
    header("Location: ../index.html");
    exit(); // Asegúrate de terminar el script después de redirigir
} else {
    echo "Error al registrar el vuelo: " . $stmt->error;
}

// Cerrar la conexión
$stmt->close();
$conn->close();
?>
