<?php
require "config/conexion.php";

$sql = "SELECT * FROM usuarios";
$result = $conn->query($sql);

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="public/styles.css">
    <title>Registro</title>
</head>
<?php include 'component/header.php'?>
<body class = 'raleway'>
    <section>
        <h1>Formulario de Registro</h1>
        <form action="controller/registro.php" method="POST">
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" required>
            <br>
            <label for="correo">Correo:</label>
            <input type="email" id="correo" name="correo" required>
            <br>
            <label for="password">Contraseña:</label>
            <input type="password" id="password" name="password" required>
            <br>
            <button type="submit">Registrar</button>
        </form>
    </section>
    <section>
    <h1>Usuarios Registrados</h1>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Email</th>
                <th>Creacion</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>" . $row["id"] . "</td>
                            <td>" . $row["nombre"] . "</td>
                            <td>" . $row["correo"] . "</td>
                            <td>" . $row["created_at"] . "</td>
                            <td></td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='4'>No hay usuarios registrados.</td></tr>";
            }
            ?>
        </tbody>
    </table>
    </section>

    <?php include 'component/footer.php'?>
    <script>
        // Obtener elementos
        var modal = document.getElementById("calendarModal");
        var btn = document.getElementById("openModal");
        var span = document.getElementsByClassName("close")[0];

        // Abrir el modal cuando el usuario haga clic en el enlace del calendario
        btn.onclick = function() {
            modal.style.display = "block";
        }

        // Cerrar el modal cuando el usuario haga clic en la "X"
        span.onclick = function() {
            modal.style.display = "none";
        }

        // Cerrar el modal cuando el usuario haga clic fuera del contenido
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>
    <style>
        /* Estilos para el modal */
        .modal {
            display: none; 
            position: fixed; 
            z-index: 1; 
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.4); 
        }

        .modal-content {
            background-color: white;
            margin: 15% auto; 
            padding: 20px;
            border: 1px solid #888;
            width: 540px; /* Aumentado para el calendario */
            text-align: center;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
    </style>  
</body>
</html>
