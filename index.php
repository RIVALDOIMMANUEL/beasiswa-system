<?php session_start(); ?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin</title>

    <!-- Font Awesome untuk icon -->
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

    <!-- CSS Eksternal -->
    <link rel="stylesheet" href="index style.css">
</head>

<body>
    <div class="container">
        <!-- Logo -->
        <img src="Portal Beasiswa.png" alt="Beasiswa" class="logo">
        <h3>Halaman Login</h3>

        <?php if (isset($_SESSION['error'])) { ?>
            <p class="error"><?= $_SESSION['error'];
                                unset($_SESSION['error']); ?></p>
        <?php } ?>

        <form action="proses_login.php" method="POST">
            <!-- Email -->
            <div class="input-group">
                <input type="email" name="email" placeholder="Email" required>
                <i class="fas fa-user"></i>
            </div>

            <!-- Password -->
            <div class="input-group">
                <input type="password" name="password" id="password" placeholder="Password" required>
                <i class="fas fa-lock toggle-password" id="toggleIcon"></i>
            </div>

            <!-- Show password -->
            <label class="show-password">
                <input type="checkbox" id="showPassword"> Tampilkan kata sandi
            </label>

            <!-- Button -->
            <button type="submit">Masuk</button>

            <!-- Links -->
            <div class="links">
                <a href="#">Lupa Kata Sandi?</a>
                <a href="home.php">Daftar Beasiswa</a>
            </div>
        </form>

        <footer>
            © 2026 Portal Beasiswa. All rights reserved.
        </footer>
    </div>

    <!-- JS Eksternal -->
    <script src="script.js"></script>
</body>

</html>