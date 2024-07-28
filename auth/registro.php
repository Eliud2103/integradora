<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>TicketOax</title>
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <link rel="stylesheet" href="../styles/style.css">
    </head>
    <style>
        input[type="password"], input[type="email"], input[type="text"] {
                border: none;
                border-radius: 12px;
                box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
                padding: 20px 15px;
                background-color: #FFFFFF;
                width: 60%;
                display: block;
                margin: 0px auto 0px;
            }

            .form-control:focus {
                box-shadow: 0 0 0 0.2rem rgba(109, 160, 237, 0.25);
                border-color: #6DA0ED;
            }

            label {
                color: #465772;
                display: block;
                margin-bottom: 0px;
                font-size: 20px;
            }

            .bg-form {
                padding: 10px 30px 10px;
                border-radius: 20px;
                background-color: #d6e1f7;
                max-width: 60%;
                margin: 20px auto 30px;
            }

            .texto_italic {
                font-family: italic;
            }

            .btn-primary{
                background-color: #6DA0ED;
                border-radius: 20px;
                padding: 10px 60px;
            }

            @media (max-width: 768px) {
                .bg-form {
                    padding: 0px;
                    margin-top: 5% auto;
                    max-width: 90%;
                    border-radius: 10px;
                }

                .btn {
                    width: 100%;
                    margin: 10px 0;
                }
                
                input[type="password"], input[type="email"], input[type="text"] {
                    border-radius: 10px;
                    width: 100%;
                    margin: 10px 0;
                    background-color: #FFFFFF;
                    padding: 22px 15px;
                }

                .btn-primary {
                    font-size: 16px;
                    border-radius: 15px;
                }

                label {
                    font-size: 14px;
                }
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
        <h4 class="mt-4 text-center">REGISTRO</h4>
        <div class="container text-center bg-form mt-5 mx-auto mb-5">   
            <div class="p-3" >
                <form action="auth/procesar_registro.php" method="POST" id="formulario">
                    <div class="form-group">
                        <label for="">Nombre completo</label>
                        <input type="text" class="form-control" id="nombre_usuario" name="nombre_usuario" required>
                    </div>
                    <div class="form-group">
                        <label for="">Correo electrónico</label>
                        <input type="email" class="form-control" id="correo_electronico" name="correo_electronico" required>
                    </div>
                    <div class="form-group">
                        <label for="">Contraseña</label>
                        <input type="password" class="form-control" id="contrasena" name="contrasena" required>
                    </div>
                    <button class=" btn btn-primary" type="submit" name="registrarse" >Registrarse</button>
                </form>
            </div>
        </div>
   <script>
        document.getElementById('formulario').onsubmit = function(event) {
            event.preventDefault();

            var formData = new FormData(this);

            fetch('procesar_registro.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.text())
            .then(data => {
                if (data.includes('Error:')) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: data,
                    });
                } else {
                    Swal.fire({
                        icon: 'success',
                        title: 'Registrado',
                        text: 'Se ha registrado el usuario exitosamente.',
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

<footer>
<img src="../assets/images/icon-facebook-480.png" width="30px" alt="">
<img src="../assets/images/icon-instagram-480.png" width="30px" alt="">
</footer>
</html>