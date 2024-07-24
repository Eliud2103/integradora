<?php
    session_start();
    include 'conection/conection.php';

    if (!isset($_SESSION['user_id'])) {
        header("Location: auth/login.php");
        exit;
    }

    // Preparar y ejecutar la consulta para obtener los datos del usuario
    $stmt = $conection->prepare("SELECT nombre_usuario, correo_electronico FROM usuarios WHERE id_usuario = ?");
    $stmt->bind_param("i", $_SESSION['user_id']);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
    } else {
        // echo "No se encontraron datos del usuario.";
        echo "<script>
                alert('No se encontraron datos del usuario.');
                window.location.href = 'index.php';
              </script>";
        exit;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'components/head_meta.php'; ?>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .bg-form {
            background-color: #d6e1f7;
            border-radius: 10px;
            padding: 20px;
        }
        .btn-primary{
            background-color: #6DA0ED;
            border-radius: 20px
        }
        .btn-danger{
            background-color: #B6357B;
            border-radius: 20px
        }
    </style>
</head>
<body>
    <?php include 'components/navbar.php'; ?>
    <div class="container text-center">
        <h4 class="mt-4">MI PERFIL</h4>
        <div class="bg-form mx-auto" style="max-width: 100%;">
            <div class="p-3">
                <form action="auth/procesar_perfil.php" method="POST" id="formulario">
                    <img class="img-fluid" src="assets/images/user.png" style="width: 50px; height: 50px;" alt="">
                    <div class="form-group mt-3">
                        <label for="nombre_usuario">Nombre completo</label>
                        <input type="text" class="form-control" id="nombre_usuario" name="nombre_usuario" value="<?php echo htmlspecialchars($user['nombre_usuario']); ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="correo_electronico">Correo electrónico</label>
                        <input type="email" class="form-control" id="correo_electronico" name="correo_electronico" value="<?php echo htmlspecialchars($user['correo_electronico']); ?>" required>
                    </div>
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <button class="btn btn-primary w-100 mt-3"type="submit" name="cambio_contraseña">Cambiar contraseña</button>
                        </div>
                        <div class="col-12 col-md-6">
                            <button class="btn btn-danger w-100 mt-3" type="submit" name="cerrar_sesion">Cerrar sesión</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php include 'components/footer.php'; ?>
</body>
</html>
