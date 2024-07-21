<?php
    session_start();
    include '../conection/conection.php';

    function limpiarDatos($dato) {
        global $conection;
        $dato = trim($dato);
        $dato = stripslashes($dato);
        $dato = htmlspecialchars($dato);
        return $conection->real_escape_string($dato);
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['cambio_contraseña']) || isset($_POST['cerrar_sesion'])) {
            $nombre_completo = limpiarDatos($_POST['nombre_usuario']);
            $correo_electronico = limpiarDatos($_POST['correo_electronico']);
            $sql = "SELECT * FROM usuarios WHERE nombre_usuario = '$nombre_completo' AND correo_electronico = '$correo_electronico'";
            $result = $conection->query($sql);

            if ($result->num_rows > 0) {
                if (isset($_POST['cambio_contraseña'])) {
                    header("Location: cambio_contrasena.php");
                    exit();
                } elseif (isset($_POST['cerrar_sesion'])) {
                    session_destroy();
                    header("Location: ../index.php");
                    exit();
                }
            } else {
                echo "<script>alert('El nombre o correo electrónico no existen'); window.location.href='user.php';</script>";
                exit();
            }
        }
    }
    $conection->close();
?>
