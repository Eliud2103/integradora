<?php
    session_start();
    include 'conection/conection.php';

    if (!isset($_SESSION['user_id'])) {
        header('Location: auth/login.php');
        exit;
    }

    $origen = $_GET['origen'];
    $destino = $_GET['destino'];
    $fecha = $_GET['fecha'];

    $sql = "SELECT t.id_trayecto, t.origen, t.destino, t.fecha, h.hora_salida, h.hora_llegada
            FROM trayecto t
            JOIN horario h ON t.id_trayecto = h.id_trayecto
            WHERE t.origen = ? AND t.destino = ? AND t.fecha = ?";
    $stmt = $conection->prepare($sql);
    $stmt->bind_param("sss", $origen, $destino, $fecha);
    $stmt->execute();
    $result = $stmt->get_result();
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <?php include 'components/head_meta.php'; ?>
        <style>
            .result-card {
                background-color: #f1f1f1;
                border-radius: 10px;
                margin-bottom: 20px;
                padding: 20px;
            }
            .result-card img {
                width: 100px;
            }
            .result-card .btn {
                background-color: #2c3e50;
                color: white;
                border-radius: 20px;
            }
            .result-card .btn:hover {
                background-color: #1a252f;
            }
            .result-card .price {
                background-color: #bce5e5;
                padding: 10px 20px;
                border-radius: 10px;
                font-size: 1.2rem;
            }
        </style>
    </head>
    <body>
        <?php include 'components/navbar.php'; ?>
        <div class="container mt-4">
            <h3 class="text-center">RESULTADOS DE BUSQUEDA</h3>
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '
                    <div class="row result-card">
                        <div class="col-md-2">
                            <img src="assets/images/autobus.png" alt="Bus">
                        </div>
                        <div class="col-md-6">
                            <ul class="">
                                <li>
                                    <div class="-badge"><i class="glyphicon glyphicon-check"></i></div>
                                    <div class="-panel">
                                        <div class="-body">
                                            <p><strong>' . $row['hora_salida'] . ' h</strong> ' . $row['origen'] . '</p>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="-badge"><i class="glyphicon glyphicon-check"></i></div>
                                    <div class="-panel">
                                        <div class="-body">
                                            <p><strong>' . $row['hora_llegada'] . ' h</strong> ' . $row['destino'] . '</p>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-3 text-center">
                            <div class="price">$100 MXN</div>
                        </div>
                        <div class="col-md-1 text-right">';
                    
                    if (isset($_SESSION['user_id'])) {
                        echo '<form action="apartar_boleto.php" method="POST">
                                  <input type="hidden" name="id_trayecto" value="' . $row['id_trayecto'] . '">
                                  <input type="hidden" name="origen" value="' . $row['origen'] . '">
                                  <input type="hidden" name="destino" value="' . $row['destino'] . '">
                                  <input type="hidden" name="fecha" value="' . $row['fecha'] . '">
                                  <input type="hidden" name="hora" value="' . $row['hora_salida'] . '">
                                  <input type="hidden" name="monto_pagar" value="100">
                                  <button type="submit" class="btn btn-primary">Continuar</button>
                              </form>';
                    } else {
                        echo '<button onclick="location.href=\'auth/login.php\'" class="btn btn-primary">Continuar</button>';
                    }
                    echo '</div>
                    </div>';
                }
            } else {
                echo '<p>No se encontraron resultados para su búsqueda.</p>';
            }
            ?>
        </div>
        <?php include 'components/footer.php'; ?>
    </body>
</html>
