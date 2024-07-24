<?php
    include 'conection/conection.php';

    $origen = $_POST['origen'];
    $destino = $_POST['destino'];
    $fecha = $_POST['fecha'];

    $sql = "SELECT * FROM trayecto WHERE origen = ? AND destino = ? AND fecha = ?";
    $stmt = $conection->prepare($sql);
    $stmt -> bind_param("sss", $origen, $destino, $fecha);
    $stmt -> execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        header("Location: resultado_busqueda.php?origen=$origen&destino=$destino&fecha=$fecha");
        exit();
    } else {
        // echo "origen: $origen, destino: $destino, fecha: $fecha";
        echo "<script>
                alert('No se encontraron resultados para su búsqueda.');
                window.location.href = 'index.php';
              </script>";
        exit;
    }

    $conection -> close();
?>
