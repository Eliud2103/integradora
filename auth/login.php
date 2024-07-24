<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>TicketOax</title>
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <link rel="stylesheet" href="../styles/style.css">
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
        <nav class="navbar navbar-expand-lg">
            <img class="logoTicket" style="width: 200px;" src="../assets/images/logoTicket.png" alt="">
            <div class="container-fluid">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0"></ul>
                    <div class="d-flex">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link" href="../index.php" tabindex="-1" style="color: white" aria-disabled="true">Inicio</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="../contact.php" tabindex="-1" style="color: white" aria-disabled="true">Contacto</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <a href="../user.php">
                    <img style="width: 45px;" class="logoUser" src="../assets/images/user.png" alt="">
                </a>
            </div>
        </nav>
        <div id="mensaje"></div>
        <div class="container text-center bg-form mt-5 mx-auto"  style="max-width: 60%">   
            <h4 class="mt-4">INICIAR SESIÓN</h4>
            <div class="p-3" >
                <form action="procesar_login.php" method="POST" id="formulario">
                    <div class="form-group">
                        <label for="correo">Correo electrónico</label>
                        <input type="email" class="form-control" id="correo_electronico" name="correo_electronico" required>
                    </div>
                    <div class="form-group">
                        <label for="contrasena_nueva">Contraseña</label>
                        <input type="password" class="form-control" id="contrasena" name="contrasena" required>
                    </div>
                    <p class="mt-4">¿Olvidaste tu contraseña?</p> 
                    <button class="boton btn btn-primary" type="submit" name="iniciar_sesion">Iniciar sesión</button>
                    <p>¿No tienes una cuenta? <a style="color: #FF4081" href="registro.php  ">Registráte</a></p>
                </form>
            </div>
        </div>
        <script>
            document.getElementById('formulario').onsubmit = function(event) {
                event.preventDefault(); // Prevenir la recarga de la página
                var formData = new FormData(this);
                fetch('procesar_login.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.text())
                .then(data => {
                    if (data.includes('Error:')) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error al iniciar sesión',
                            text: data,
                            confirmButtonText: 'Intentar de nuevo'
                        });
                    } else {
                        Swal.fire({
                            icon: 'success',
                            title: 'Inicio de sesión exitoso',
                            text: 'Redirigiendo al inicio.',
                            confirmButtonText: 'Aceptar'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = '../index.php';
                            }
                        });
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error de comunicación',
                        text: 'No se pudo establecer comunicación con el servidor.'
                    });
                });
            };
            </script>

    </body>
    <footer style="position: fixed; bottom: 0; width:100%; height: 45px;" class="mt-4">
        <a href="https://www.facebook.com/autobuseshalconoficial?mibextid=ZbWKwL" target="_blank">
            <img src="../assets/images/icon-facebook-480.png" width="30px" alt="">
        </a>
        <a href="https://www.instagram.com/autobuseshalcon_oax?igsh=ZThic29ra2pkcW85" target="_blank">
            <img src="../assets/images/icon-instagram-480.png" width="30px" alt="">
        </a>
    </footer>
</html>