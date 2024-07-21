<?php
    session_start(); // Asegúrate de iniciar la sesión al principio del archivo
    include '../conection/conection.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
        $nombre_usuario = htmlspecialchars($_POST['nombre_usuario']);
        $correo_electronico = htmlspecialchars($_POST['correo_electronico']);
        $contrasena = password_hash($_POST['contrasena'], PASSWORD_DEFAULT); // Encriptar la contraseña
    
        if (!empty($nombre_usuario) && !empty($correo_electronico) && !empty($contrasena)) {
        
            $sql = "INSERT INTO usuarios (nombre_usuario, correo_electronico, contrasena)
                VALUES (?, ?, ?)";
        
            $stmt = $conection->prepare($sql);
            $stmt->bind_param("sss", $nombre_usuario, $correo_electronico, $contrasena);
        
            if ($stmt->execute()) {
                // Una vez registrado, obtener el ID del usuario recién insertado
                $user_id = $stmt->insert_id;

                // Configurar las variables de sesión para el nuevo usuario
                $_SESSION['user_id'] = $user_id;
                $_SESSION['nombre_usuario'] = $nombre_usuario; // Opcional, según necesidad de la aplicación

                // Redireccionar a la página de bienvenida o al perfil del usuario
                header("Location: ../profile.php"); // Ajusta esta ruta según necesites
                exit;
            } else {
                echo "Error: al registrar el usuario: " . $stmt->error;
            }
        
            $stmt->close();
        
        } else {
            echo "Todos los campos son requeridos.";
        }
    }

    $conection->close();
?>
