<!DOCTYPE html>
<html lang="es">
<head>
    <?php include 'components/head_meta.php'; ?>
</head>
<body>
    <?php include 'components/navbar.php'; ?>
    <div class="container mt-3 bg-form">
        <h2 class="text-center">Registrar nuevo autobús</h2>
        <form id="formAutobus" method="post">
            <div class="mb-3">
                <label for="numero_autobus" class="form-label">Número del Autobús:</label>
                <input type="text" class="form-control" id="numero_autobus" name="numero_autobus" required>
            </div>
            <div class="mb-3">
                <label for="asientos" class="form-label">Asientos:</label>
                <input type="number" class="form-control" id="asientos" name="asientos" required>
            </div>
            <div class="mb-3">
                <label for="modelo_autobus" class="form-label">Modelo del Autobús:</label>
                <input type="text" class="form-control" id="modelo_autobus" name="modelo_autobus" required>
            </div>
            <div class="d-flex justify-content-center">
                <button type="button" class="btn btn-primary" onclick="enviarDatosAutobus()">Registrar</button>
            </div>

        </form>


    </div>
    <?php include 'components/footer.php'; ?>

    <script>
        function enviarDatosAutobus() {
            var xhr = new XMLHttpRequest();
            var url = "new_forms/insertar_autobus.php";
            xhr.open("POST", url, true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    console.log(xhr.responseText);
                    if (xhr.responseText.includes("exitoso")) {
                        Swal.fire({
                            title: '¡Éxito!',
                            text: 'El autobús ha sido registrado correctamente.',
                            icon: 'success',
                            confirmButtonText: 'Cerrar'
                        });
                        document.getElementById('formAutobus').reset();
                    } else {
                        Swal.fire({
                            title: 'Error',
                            text: 'No se pudo registrar el autobús.',
                            icon: 'error',
                            confirmButtonText: 'Cerrar'
                        });
                    }
                }
            };

            var formData = new FormData(document.getElementById('formAutobus'));
            var params = new URLSearchParams(formData).toString();
            xhr.send(params);
        }
    </script>




</body>
</html>
