<!-- components/navbar.php -->
<nav class="navbar navbar-expand-lg">
    <div class="container-fluid">
        <img class="logoTicket" style="width: 200px;" src="assets/images/logoTicket.png" alt="">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            </div>
            <ul class="navbar-nav ms-auto">
                <li class="nav-item mx-3">
                    <a class="nav-link" href="index.php" style="color: white">INICIO</a>
                </li>
                <li class="nav-item mx-3">
                    <a class="nav-link" href="contact.php" style="color: white">CONTACTO</a>
                </li>
            </ul>

        <?php
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        ?>
        <a class="mx-3" href="<?php echo isset($_SESSION['user_id']) ? 'user.php' : 'auth/login.php'; ?>">
            <img style="width: 45px;" class="logoUser" src="assets/images/user.png" alt="Perfil del usuario">
        </a>
    </div>
</nav>