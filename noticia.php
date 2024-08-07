<?php
include 'conection/conection.php';

$id = $_GET['id'];

$sql = "SELECT titulo, resumen, contenido, fecha, imagen FROM noticias WHERE id = ?";
$stmt = $conection->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $noticia = $result->fetch_assoc();
} else {
    echo "<script>
            alert('Noticia no encontrada.');
            window.location.href = 'index.php';
          </script>";
    exit;
}

$conection->close();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <?php include 'components/head_meta.php'; ?>
    <style>
        h4 {
            font-family: 'Inter', sans-serif;
            font-weight: 800;
        }
        .bg-cards {
            background-color: #E9F0FF;
            padding: 15px;
            border-radius: 15px;
        }
        .news-image {
            border-radius: 10px;
        }
        .card {
            border-radius: 15px;
        }
        @media (max-width: 768px) {
            .news-image {
                width: 100%;
                margin: 0 auto;
                display: block;
            }
            .bg-cards {
                padding: 10px;
            }
            .card-body {
                padding: 10px;
            }
        }
    </style>
</head>
<body>
    <?php include 'components/navbar.php'; ?>
    <div class="container mt-4">
        <h1 class="fw-bold text-center"><?php echo htmlspecialchars($noticia['titulo']); ?></h1>
        <div class="bg-cards p-3">
            <div class="card card-custom">
                <div class="row g-0">
                    <div class="col-md-7">
                        <div class="card-body">
                            <p><?php echo nl2br(htmlspecialchars($noticia['resumen'])); ?></p>
                        </div>
                        <div class="card-body">
                            <p><?php echo nl2br(htmlspecialchars($noticia['contenido'])); ?></p>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <?php
                        $image_path = '/' . $noticia['imagen'];
                        if (file_exists($_SERVER['DOCUMENT_ROOT'] . $image_path)) {
                            echo '<img class="my-3 img-fluid rounded news-image" src="' . htmlspecialchars($image_path) . '" alt="' . htmlspecialchars($noticia['titulo']) . '">';
                        } else {
                            echo 'Archivo no encontrado: ' . $_SERVER['DOCUMENT_ROOT'] . $image_path;
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include 'components/footer.php'; ?>
</body>
</html>
