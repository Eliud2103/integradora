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
            WHERE t.origen = ? AND t.destino = ? AND h.fecha_salida = ?";
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
                background-color: #C9D8F5;
                border-radius: 25px;
                margin-bottom: 20px;
                padding: 40px;
                height: 200px;
            }
            .result-card img {
                width: 200px;
                height: auto;
                margin-left: -23px;

            }
            .result-card .btn {
                background-color: #2c3e50;
                color: white;
                border-radius: 20px;
                width: 100px;
                    margin-top: 40px;
                
            }
            .result-card .btn:hover {
                background-color: #1a252f;
            }
            .result-card .price {
                background-color: #bce5e5;
                padding: 18px 20px;
                border-radius: 20px;
                font-size: 1.2rem;
                width: 200px;
                margin-left: 80px;
            }
            .price{
                    color:white;
                }
          
            @media (max-width: 768px) {
                .result-card {
                    background-color: #C9D8F5;
                    border-radius: 20px;
                    margin-bottom: 30px;
                    padding: 40px;
                    height: 400px;
                    width: 400px;
                    
                }
                .background_button{
                    background-color: #f8f9fa;
                    
                    }
                .result-card .price {
                    background-color: #bce5e5;
                    padding: 10px 5px;
                    border-radius: 10px;
                    font-size: 15px;
                }
                /*.result-card .btn {
                    background-color: #2c3e50;
                    color: white;
                    border-radius: 20px;
                    margin-left: 30px;
                    height: 50px;
                    
                }*/
                .result-card{
                    margin-left:5px;
                }
                .result-card .price{
                    color:white;
                    margin-top: 40px;
                    margin-left: -4px;
                    width: 150px;
                    height: 50px;
                    border-radius: 20px;

                }
                .result-card .btn{
                    margin-top: 25px;
                    margin-left: -10px;
                    width: 150px;
                    height: 50px;
                }
                .result-card img {
                width: 100px;
                height: auto;
                margin-left: -4px;

            }
               
                

            }
        </style>
    </head>
    <body>
        <?php include 'components/navbar.php'; ?>
        <div class="container mt-4 mb-5">
            <h3 class="text-center">RESULTADOS DE BUSQUEDA  </h3>
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '
                    <div  class=" mt-5 row result-card">
                        <div class="col-12 col-md-2 col-lg-2">
                            <img src="assets/images/autobus.png" alt="Bus">
                        </div>
                        <div class="col-12 col-md-6 col-lg-6 bg-light rounded-10">
                            <ul class="mt-3">
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
                                            <p>' . $row['hora_llegada'] . ' h ' . $row['destino'] . '</p>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class=" col-6 col-md-2 col-lg-3 text-center bg-light  pt-4">
                            <div class="price mt-2">$520 MXN</div>
                        </div>
                        <div class="col-6 col-md-3 col-lg-1 text-right pt-2 background_button ">';
                    
                    if (isset($_SESSION['user_id'])) {
                        echo '<form action="apartar_boleto.php" method="POST">
                                  <input type="hidden" name="id_trayecto" value="' . $row['id_trayecto'] . '">
                                  <input type="hidden" name="origen" value="' . $row['origen'] . '">
                                  <input type="hidden" name="destino" value="' . $row['destino'] . '">
                                  <input type="hidden" name="fecha" value="' . $row['fecha'] . '">
                                  <input type="hidden" name="hora" value="' . $row['hora_salida'] . '">
                                  <input class="price"type="hidden" name="monto_pagar" value="100">
                                  <button type="submit" class="btn btn-primary  py-2 px-3 mb-3">Apartar</button>
                              </form>';
                    } else {
                        echo '<button onclick="location.href=\'auth/login.php\'" class="btn btn-primary mt-2">Continuar</button>';
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
