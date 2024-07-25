<?php 
    include '../conection/conection.php';
?>

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
        <h4 class="mt-4">CAMBIAR CONTRASEÑA</h4>
        <div class="p-3" >
            <form action="procesar_cambio_contrasena.php" method="POST" id="formulario">
                <div class="form-group">
                    <label for="correo">Correo electrónico</label>
                    <input type="email" class="form-control" id="correo" name="correo" required>
                </div>
                <div class="form-group">
                    <label for="contrasena_nueva">Contraseña nueva</label>
                    <input type="password" class="form-control" id="contrasena_nueva" name="contrasena_nueva" required>
                </div>
                <div class="form-group">
                    <label for="confirmar_contrasena">Confirmar contraseña</label>
                    <input type="password" class="form-control" id="confirmar_contrasena" name="confirmar_contrasena" required>
                </div>
                <button class="mt-3 btn btn-primary" type="submit" name="cambiar_contrasena">
                    <span id="spinner" style="display: none;" class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>        
                    Aceptar
                </button>
            </form>
        </div>
    </div>

    <footer style="position: fixed; bottom: 0; width:100%; height: 45px;" class="mt-4">
        <a href="https://www.facebook.com/autobuseshalconoficial?mibextid=ZbWKwL" target="_blank">
            <img src="../assets/images/icon-facebook-480.png" width="30px" alt="">
        </a>
        <a href="https://www.instagram.com/autobuseshalcon_oax?igsh=ZThic29ra2pkcW85" target="_blank">
            <img src="../assets/images/icon-instagram-480.png" width="30px" alt="">
        </a>
    </footer>

    <script>
        document.getElementById('formulario').onsubmit = function(event) {
            event.preventDefault();
            document.getElementById('spinner').style.display = 'inline-block';
            
            var formData = new FormData(this);
            fetch('procesar_cambio_contrasena.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.text())
            .then(data => {
                document.getElementById('spinner').style.display = 'none';
                alert(data);
                if (!data.includes('Error: ')) {
                    window.location.href = '../index.php';
                }
            })
            .catch(error => {
                console.error('Error:', error);
                document.getElementById('spinner').style.display = 'none';
            });
        };
    </script>
</body>
</html>