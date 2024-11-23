<?php
require '../config/conexion.php';

// Recibir datos del formulario o asignarlos manualmente
$nombre = $_POST['nombre'];
$correo = $_POST['correo'];
$password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Encripta la contraseña

// Prepara la consulta SQL
$stmt = $conn->prepare("INSERT INTO usuarios (nombre, correo, password) VALUES (?, ?, ?)");

// Vincula los parámetros (s = string, i = integer, d = double, b = blob)
$stmt->bind_param("sss", $nombre, $correo, $password); // 'ss' indica que ambos parámetros son cadenas de texto

// Ejecuta la consulta
$stmt->execute();

// Verifica si la inserción fue exitosa
if ($stmt->affected_rows > 0) {
    echo '<scirpt>
		alert("Usuario creado exitosamente.");
		window.location = "../index.php";
	</script>';
} else {
    echo '<script>
		alert("Error al registrar.");
		window.location = "../index.php";
	</script>';
}

// Cierra la declaración y la conexión
$stmt->close();
$conn->close();
?>
