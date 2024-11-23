<?php
// Conexión a la base de datos
$host = 'db';
$user = 'root';
$password = 'notSecureChangeMe';
$dbname = 'my_database';

$conn = new mysqli($host, $user, $password, $dbname);

// Verifica la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>
