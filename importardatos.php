<?php
// Datos de conexión a la base de datos
$servidor = "localhost";
$usuario = "root";
$password = "";
$basedatos = "aeropuerto";

// Crear conexión
$conexion = new mysqli($servidor, $usuario, $password, $basedatos);

// Verificar conexión
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

echo "Conexión establecida correctamente.<br>";

// Ruta al archivo CSV
$archivo_csv = 'C:\Users\psp-c\OneDrive\Escritorio\aeropuerto\matriculas.csv';

// Verificar si el archivo CSV existe y se puede abrir
if (!file_exists($archivo_csv) || !is_readable($archivo_csv)) {
    die("Error: El archivo CSV no existe o no se puede leer.");
}

echo "Archivo CSV encontrado y accesible.<br>";

// Abre el archivo en modo lectura
if (($gestor = fopen($archivo_csv, 'r')) !== FALSE) {
    // Itera sobre cada línea del archivo
    while (($fila = fgetcsv($gestor, 1000, ',')) !== FALSE) {
        // Verifica si la fila tiene el número correcto de columnas (en este caso 7)
        if (count($fila) != 7) {
            // Omitir esta fila si no tiene los datos correctos
        
        }

        // Escapa cada valor para evitar inyecciones SQL (mejor usar sentencias preparadas)
        $matricula = trim($fila[0]); // Asegúrate de limpiar espacios en blanco alrededor
        $icao = $fila[1];
        $iata = $fila[2];
        $aerolinea = $fila[3];
        $nombre = $fila[4];
        $calificador = $fila[5];
        $tipo_operacion = $fila[6];

        // Verifica si la matricula no está vacía antes de intentar insertar
        if (!empty($matricula)) {
            // Prepara la consulta con sentencias preparadas para seguridad
            $consulta = $conexion->prepare("INSERT INTO matriculas (matricula, aircraft_type_icao, aircraft_type_iata, aerolinea, nombre, calificador, tipo_operacion) 
                                            VALUES (?, ?, ?, ?, ?, ?, ?)");
            if ($consulta === false) {
                die('Error al preparar la consulta: ' . $conexion->error);
            }

            // Vincula los parámetros y ejecuta la consulta
            $resultado = $consulta->bind_param("sssssss", $matricula, $icao, $iata, $aerolinea, $nombre, $calificador, $tipo_operacion);
            if ($resultado === false) {
                die('Error al vincular los parámetros: ' . $consulta->error);
            }

            $resultado = $consulta->execute();
            if ($resultado === false) {
                die('Error al ejecutar la consulta: ' . $consulta->error);
            }

            echo "Datos insertados correctamente para la matrícula: $matricula<br>";
        } else {
            echo "Error: La matrícula está vacía o no válida.<br>";
        }
    }
    fclose($gestor);
    echo "Importación completada correctamente.";
} else {
    echo "Error al abrir el archivo CSV.";
}

// Cierra la conexión
$conexion->close();
?>
