<?php
    include 'conection/conection.php';
    session_start();

    $is_admin = isset($_SESSION['admin_id']);
    
    $sql = "SELECT id, titulo, resumen, contenido, fecha, imagen FROM noticias ORDER BY fecha DESC";
    $result = $conection->query($sql);

    $news_items = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $news_items[] = $row;
        }
    } else {
        echo "<script>
                alert('0 resultados.');
                window.location.href = 'index.php';
              </script>";
        exit;  
    }

    $sql_origen = "SELECT DISTINCT origen FROM trayecto ORDER BY origen";
    $result_origen = $conection->query($sql_origen);

    $sql_destino = "SELECT DISTINCT destino FROM trayecto ORDER BY destino";
    $result_destino = $conection->query($sql_destino);
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include 'components/head_meta.php'; ?>
        <style>
            h4 {
                font-family: 'Inter', sans-serif;
                font-weight: 800;
            }
            .fondo {
                background: url('assets/images/Fondo_inicio.jpg') no-repeat center center fixed;
                background-size: cover;
                height: 200px;
                position: relative;
                display: flex;
                justify-content: center;
                align-items: center;
                opacity: 0.8;
            }
            .bg-cards {
                background-color: #C9D8F5;
                border-radius: 20px;
                padding: 20px;
                margin-top: 20px;
                height: 260px;
               
            }
            .card-custom {
                height: 60%;
                width: 95%;
                border: none;
                border-radius: 15px;
                display: flex;
                flex-direction: column;
                overflow: hidden;
                margin-bottom: 20px;
            }
            .card-custom img {
                width: 100%;
                height: auto;
                object-fit: cover;
            }
            .card-custom .card-body {
                height: 70%;
                overflow-y: auto;
                padding: 15px;
            }
            
            .select {
                
                border-radius: 20px;
                padding: 14px 10px;
                border: 1px solid #ccc;
                opacity: 0.9;
                border: none;
                margin: 20px;
                margin-top: 50px;
                margin-left: 40px;
                width: 310px;;
            }
            .in {
                margin-left: 40px;
                margin: 10px 0;
                padding: 14px;
                border-radius: 20px;
                border: 1px solid #ccc;
                border: none;
                opacity: 0.9;
            }
            .boton_buscar {
                margin-top: -5px;
                border-radius: 20px;
                padding: 10px 20px;
                opacity: 0.9;
                margin-left: 210px;
            }
           
            @media (max-width: 768px) {
    .bg-cards {
        margin-bottom: 70px;
        margin-top: 20px;
        padding: 10px;
        width: 80%;
        height: auto;
    }
    .card-custom {
        margin-left:10px;
        flex-direction: row; /* Cambia la dirección de la flexbox a fila */
        align-items: center; /* Alinea los elementos en el centro verticalmente */
    }
    .card-custom img {
        order: 2; /* Cambia el orden para que la imagen aparezca después del texto */
        margin-left: 0;
        width: 50%;
        height: auto;
    }
    .card-body {
        
        order: 1; /* Cambia el orden para que el texto aparezca antes de la imagen */
        padding: 10px;
        width: 100%;
    }
    .fondo {
        height: 400px;
        justify-content: flex-start;
        align-items: flex-start;
        padding-top: 20px;
    }
    .formm {
        text-align: center;
        width: 100%;
        margin-top: 40px;
    }
    .select, .in {
        border-radius: 20px;
        margin-top: 40px;
        width: 80%;
        margin: 5px auto;
    }
    .boton_buscar {
        margin-top: 30px;
        width: 40%;
    }
}

        </style>
    </head>
    <body>
        <?php include 'components/navbar.php'; ?>
        <div class="fondo">
            <form class="formm" action="<?php echo $is_admin ? 'admin_r_b.php' : 'resultado_busqueda.php'; ?>" method="GET">
                <select style="margin-left: -200px;" class="select" id="origen" name="origen">
                    <?php
                    if ($result_origen->num_rows > 0): 
                        while($row = $result_origen->fetch_assoc()): 
                    ?>
                            <option value="<?php echo htmlspecialchars($row['origen']); ?>">
                                <?php echo htmlspecialchars($row['origen']); ?>
                            </option>
                    <?php 
                        endwhile; 
                    else: 
                    ?>
                        <option>No hay orígenes disponibles</option>
                    <?php endif; ?>
                </select>
                <select class="select" id="destino" name="destino">
                    <?php
                    if ($result_destino->num_rows > 0): 
                        while($row = $result_destino->fetch_assoc()): 
                    ?>
                            <option value="<?php echo htmlspecialchars($row['destino']); ?>">
                                <?php echo htmlspecialchars($row['destino']); ?>
                            </option>
                    <?php 
                        endwhile; 
                    else: 
                    ?>
                        <option>No hay destinos disponibles</option>
                    <?php endif; ?>
                </select>
                <input style="margin-left: 60px;" class="in" type="text" id="fecha" name="fecha" placeholder="Fecha" required>
                <button  type="submit" class="btn btn-light btn-lg mx-4 boton_buscar">Buscar</button>
            </form>
        </div>
        <h4 class="mt-4 text-center mb-3">DESTACADO</h4>
        <div class="container bg-cards">
            <div class="row">
                <?php foreach ($news_items as $item): ?>
                    <?php 
                        $image_path = $_SERVER['DOCUMENT_ROOT'] . '/' . $item['imagen'];
                        $image_path = str_replace(".png.png", ".png", $image_path);
                        if (file_exists($image_path)): 
                    ?>
                        <div class="col-12 col-md-4 d-flex align-items-stretch">
                            <a href="noticia.php?id=<?php echo $item['id']; ?>" class="text-decoration-none text-dark"> 
                                <div class="card mb-4 mt-4 card-custom p-3">
                                    <div class="row g-0">
                                        <div class="col-12 col-md-7">
                                            <div class="card-body">
                                                <h5 class="fw-bold"><?php echo htmlspecialchars($item['titulo']); ?></h5>
                                                <p style="font-size: 15px;"><?php echo htmlspecialchars($item['resumen']); ?></p>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-5">
                                            <img src="/<?php echo htmlspecialchars($item['imagen']); ?>" class="img-fluid rounded" alt="Imagen">
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
        </div>
    </body>
    <?php include 'components/footer.php'; ?>
    <script>
        $(document).ready(function() {
            $("#fecha").datepicker({
                dateFormat: "yy-mm-dd"
            });
        });
    </script>
</html>
