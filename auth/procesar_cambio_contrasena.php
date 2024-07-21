<?php
    include '../conection/conection.php';
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $correo = $_POST['correo'];
        $contrasena_nueva = $_POST['contrasena_nueva'];
        $confirmar_contrasena = $_POST['confirmar_contrasena'];

        if ($contrasena_nueva !== $confirmar_contrasena) {
            echo "Error: Las contraseñas no coinciden. Intenta de nuevo.";
            exit();
        }
        $stmt = $conection->prepare("SELECT * FROM usuarios WHERE correo_electronico = ?");
        $stmt->bind_param("s", $correo);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $hashed_password = password_hash($contrasena_nueva, PASSWORD_DEFAULT);

            $update_stmt = $conection->prepare("UPDATE usuarios SET contrasena = ? WHERE correo_electronico = ?");
            $update_stmt->bind_param("ss", $hashed_password, $correo);

            if ($update_stmt->execute()) {
                echo "Contraseña actualizada correctamente.";
            } else {
                echo "Error: al actualizar la contraseña: " . $conection->error;
            }
        } else {
            echo "Error: Correo electrónico no encontrado en la base de datos.";
        }

        $stmt->close();
        $update_stmt->close();
        $conection->close();
    } else {
        echo "Acceso denegado.";
    }
?>
