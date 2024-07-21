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
        <link rel="stylesheet" href="../styles/style.css">
    </head>
    <style>
        .bg-form {
            background-color: #d6e1f7;
            border-radius: 10px;
            padding: 20px;
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
        <div class="container text-center bg-form mt-5 mx-auto"  style="max-width: 60%">   
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
                    <button class=" btn btn-primary mt-3" type="submit" name="registrarse" >Registrarse</button>
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
                document.getElementById('mensaje').innerHTML = data;
                if (data.includes('Error: ')) {
                    alert(data);
                } else {
                    alert('Se ha registrado el usuario exitosamente.');
                    window.location.href = '../index.php';
                }
            })
            .catch(error => console.error('Error:', error));
        };
    </script>
</body>

<footer>
<img src="img/icon-facebook-480.png" width="30px" alt="">
<img src="img/icon-instagram-480.png" width="30px" alt="">
</footer>
</html>