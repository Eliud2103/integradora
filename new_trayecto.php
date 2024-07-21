<!DOCTYPE html>
<html lang="es">
<head>
    <?php include 'components/head_meta.php'; ?>
</head>
<body>
    <?php include 'components/navbar.php'; ?>
    <div class="container mt-5">
        <h2 class="text-center">Registrar Viaje</h2>
        <form id="formTrayecto" method="POST">
            <div class="mb-3">
                <label for="origen" class="form-label">Origen:</label>
                <input type="text" class="form-control" id="origen" name="origen" required>
            </div>
            <div class="mb-3">
                <label for="destino" class="form-label">Destino:</label>
                <input type="text" class="form-control" id="destino" name="destino" required>
            </div>
            <div class="mb-3">
                <label for="fecha" class="form-label">Fecha:</label>
                <input type="date" class="form-control" id="fecha" name="fecha" required>
            </div>
            <div class="d-flex justify-content-center">
                <button type="button" class="btn btn-primary" onclick="enviarDatosViaje()">Registrar trayecto</button>
            </div>
        </form>

    </div>
    <script>
        function enviarDatosViaje() {
            var xhr = new XMLHttpRequest();
            var url = "new_forms/insertar_trayecto.php";
            xhr.open("POST", url, true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    console.log(xhr.responseText);
                    if (xhr.responseText.includes("exitoso")) {
                        Swal.fire({
                            title: '¡Éxito!',
                            text: 'El viaje ha sido registrado correctamente.',
                            icon: 'success',
                            confirmButtonText: 'Cerrar'
                        });
                        document.getElementById('formTrayecto').reset();
                    } else {
                        Swal.fire({
                            title: 'Error',
                            text: 'No se pudo registrar el viaje.',
                            icon: 'error',
                            confirmButtonText: 'Cerrar'
                        });
                    }
                }
            };

            var formData = new FormData(document.getElementById('formTrayecto'));
            var params = new URLSearchParams(formData).toString();
            xhr.send(params);
        }
        </script>
</body>
</html>
