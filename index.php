<?php
    include 'conection/conection.php';
    
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
            .fondo {
                background: url('assets/images/Fondo_inicio.jpg') no-repeat center center fixed;
                background-size: cover;
                opacity: 0.7;
                height: 200px;
                position: relative;
            }

            .bg-cards{
                background-color: #E9F0FF;
            }

            .card-custom {
                border: none;
                max-width: 500px;
                max-height: 190px;
                overflow: hidden;
                display: flex;
                flex-direction: column;
            }
            
            .card-custom img {
                max-height: 100%;
                max-width: 100%;
                object-fit: contain;
            }

        </style>
    </head>
    <body>
        <?php include 'components/navbar.php'; ?>
        <div class="fondo">
            <form class="" action="procesar_trayecto.php" method="POST">
            <select class="select mt-5" id="origen" name="origen">
                <?php if ($result_origen->num_rows > 0): ?>
                    <?php while($row = $result_origen->fetch_assoc()): ?>
                        <option value="<?php echo htmlspecialchars($row['origen']); ?>">
                            <?php echo htmlspecialchars($row['origen']); ?>
                        </option>
                    <?php endwhile; ?>
                <?php else: ?>
                    <option>No hay orígenes disponibles</option>
                <?php endif; ?>
            </select>
            <select class="select" id="destino" name="destino">
                <?php if ($result_destino->num_rows > 0): ?>
                    <?php while($row = $result_destino->fetch_assoc()): ?>
                        <option value="<?php echo htmlspecialchars($row['destino']); ?>">
                            <?php echo htmlspecialchars($row['destino']); ?>
                        </option>
                    <?php endwhile; ?>
                <?php else: ?>
                    <option>No hay destinos disponibles</option>
                <?php endif; ?>
            </select>
                <input type="date" name="fecha" required>
                <button type="submit" class="btn btn-light btn-lg mx-4">Buscar</button>
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
                        <div class="col-md-4 d-flex align-items-stretch">
                            <a href="noticia.php?id=<?php echo $item['id']; ?>" class="text-decoration-none text-dark"> 
                                <div class="card mb-4 mt-4 card-custom p-3">
                                    <div class="row g-0">
                                        <div class="col-md-7">
                                            <div class="card-body">
                                                <h5 class="fw-bold"><?php echo htmlspecialchars($item['titulo']); ?></h5>
                                                <p class="" style="font-size: 15px;"><?php echo htmlspecialchars($item['contenido']); ?></p>
                                            </div>
                                        </div>
                                        <div class="col-md-5">
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
</html>
