<?php
    session_start();
    include '../conection/conection.php';

    if (isset($_POST['id_boleto'])) {
        $id_boleto = $_POST['id_boleto'];
        $tiempo_maximo = 60 * 60;
        $tiempo_actual = time();

        $stmt = $conection->prepare("SELECT fecha_creacion, id_reservacion FROM reservacion WHERE asiento_reservado = ?");
        $stmt->bind_param("s", $id_boleto);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $fecha_reservacion = strtotime($row['fecha_creacion']);

            if (($tiempo_actual - $fecha_reservacion) > $tiempo_maximo) {
                $stmt_delete = $conection->prepare("DELETE FROM reservacion WHERE asiento_reservado = ?");
                $stmt_delete->bind_param("s", $id_boleto);
                $stmt_delete->execute();
                
                if ($stmt_delete->affected_rows > 0) {
                    echo "Reservación eliminada exitosamente.";
                } else {
                    echo "Error al eliminar la reservación.";
                }
                $stmt_delete->close();
            } else {
                $estado_reserva = 'ocupado';
                $stmt_update = $conection->prepare("UPDATE reservacion SET estado_reserva = ? WHERE id_reservacion = ?");
                $stmt_update->bind_param("ss", $estado_reserva, $id_boleto);
                $stmt_update->execute();

                if ($stmt_update->affected_rows > 0) {
                    echo "Reservación actualizada a estado: " . $estado_reserva;
                } else {
                    echo "No se pudo actualizar la reservación.";
                }
                $stmt_update->close();
            }
        } else {
            echo "No se encontró la reservación con el ID proporcionado.";
        }
        $stmt->close();
        $conection->close();
    }
?>
