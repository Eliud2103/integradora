<!-- components/navbar.php -->
<nav class="navbar navbar-expand-lg">
    <img class="logoTicket" style="width: 200px;" src="assets/images/logoTicket.png" alt="">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0"></ul>
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="index.php" tabindex="-1" style="color: white" aria-disabled="true">Inicio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="contact.php" tabindex="-1" style="color: white" aria-disabled="true">Contacto</a>
                </li>
            </ul>
        </div>
        <?php
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        ?>
        <a href="<?php echo isset($_SESSION['user_id']) ? 'user.php' : 'auth/login.php'; ?>">
            <img style="width: 45px;" class="logoUser" src="assets/images/user.png" alt="Perfil del usuario">
        </a>
    </div>
</nav>
