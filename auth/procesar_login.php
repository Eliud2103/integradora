<?php
    session_start();
    include '../conection/conection.php';

    $email = $_POST['correo_electronico'];
    $password = $_POST['contrasena'];

    $sql = "SELECT * FROM usuarios WHERE correo_electronico = ?";
    $stmt = $conection->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['contrasena'])) {
            $_SESSION['user_id'] = $user['id_usuario'];
            echo "Login exitoso"; // Mensaje de éxito
        } else {
            echo "Error: Contraseña incorrecta"; // Mensaje de error
        }
    } else {
        echo "Error: No existe una cuenta con ese correo electrónico"; // Mensaje de error
    }
    ?>
