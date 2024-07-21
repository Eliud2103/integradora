<!DOCTYPE html>
<html lang="es">
<head>
    <?php include 'components/head_meta.php'; ?>
</head>
<body>
    <?php include 'components/navbar.php'; ?>
    <div class="container mt-5 mb-5">
        <h2 class="text-center">Agregar Nueva Noticia</h2>
        <form id="formNoticias" action="insertar_noticia.php" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="titulo" class="form-label">Título:</label>
                <input type="text" class="form-control" id="titulo" name="titulo" required>
            </div>
            <div class="mb-3">
                <label for="resumen" class="form-label">Resumen:</label>
                <textarea class="form-control" id="resumen" name="resumen" required></textarea>
            </div>
            <div class="mb-3">
                <label for="contenido" class="form-label">Contenido:</label>
                <textarea class="form-control" id="contenido" name="contenido" required></textarea>
            </div>
            <div class="mb-3">
                <label for="fecha" class="form-label">Fecha:</label>
                <input type="date" class="form-control" id="fecha" name="fecha" required>
            </div>
            <div class="mb-3">
                <label for="imagen" class="form-label">Imagen:</label>
                <input type="file" class="form-control" id="imagen" name="imagen" required>
            </div>
            <button type="submit" class="btn btn-primary">Agregar Noticia</button>
        </form>
    </div>
    <?php include 'components/footer.php'; ?>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var form = document.getElementById('formNoticias');
            form.addEventListener('submit', function(event) {
                event.preventDefault();
                enviarDatosNoticia();
            });
        });

        function enviarDatosNoticia() {
            var xhr = new XMLHttpRequest();
            var url = "new_forms/insertar_noticia.php";
            xhr.open("POST", url, true);

            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    console.log(xhr.responseText);
                    if (xhr.responseText.includes("exitoso")) {
                        Swal.fire({
                            title: '¡Éxito!',
                            text: 'La noticia ha sido registrada correctamente.',
                            icon: 'success',
                            confirmButtonText: 'Cerrar'
                        });
                        document.getElementById('formNoticias').reset();
                    } else {
                        Swal.fire({
                            title: 'Error',
                            text: 'No se pudo registrar la noticia.',
                            icon: 'error',
                            confirmButtonText: 'Cerrar'
                        });
                    }
                }
            };

            var formData = new FormData(document.getElementById('formNoticias'));
            xhr.send(formData);
        }
        </script>

</body>
</html>
