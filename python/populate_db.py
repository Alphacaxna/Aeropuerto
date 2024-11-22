import mysql.connector
import csv

# Configuración de la conexión a la base de datos
db = mysql.connector.connect(
    host="localhost",
    user="tu_usuario",
    password="tu_contraseña",
    database="aeropuerto_cco"
)

cursor = db.cursor()

# Crear la tabla si no existe
cursor.execute("""
CREATE TABLE IF NOT EXISTS matriculas (
    MATRICULA VARCHAR(10) PRIMARY KEY,
    `Aircraft Type (ICAO)` VARCHAR(10),
    `Aircraft Type (IATA)` VARCHAR(10),
    AEROLINEA VARCHAR(50),
    NOMBRE VARCHAR(50),
    CALIFICADOR VARCHAR(10),
    `TIPO DE OPERACIÓN` VARCHAR(50)
)
""")

# Leer el archivo CSV e insertar los datos
with open('ruta/a/tu/archivo.csv', mode='r', encoding='utf-8-sig') as file:
    reader = csv.DictReader(file)
    for row in reader:
        cursor.execute("""
        INSERT INTO matriculas (MATRICULA, `Aircraft Type (ICAO)`, `Aircraft Type (IATA)`, AEROLINEA, NOMBRE, CALIFICADOR, `TIPO DE OPERACIÓN`)
        VALUES (%s, %s, %s, %s, %s, %s, %s)
        ON DUPLICATE KEY UPDATE 
        `Aircraft Type (ICAO)` = VALUES(`Aircraft Type (ICAO)`),
        `Aircraft Type (IATA)` = VALUES(`Aircraft Type (IATA)`),
        AEROLINEA = VALUES(AEROLINEA),
        NOMBRE = VALUES(NOMBRE),
        CALIFICADOR = VALUES(CALIFICADOR),
        `TIPO DE OPERACIÓN` = VALUES(`TIPO DE OPERACIÓN`)
        """, (row['MATRICULA'], row['Aircraft Type (ICAO)'], row['Aircraft Type (IATA)'], row['AEROLINEA'], row['NOMBRE'], row['CALIFICADOR'], row['TIPO DE OPERACIÓN']))

db.commit()
cursor.close()
db.close()
