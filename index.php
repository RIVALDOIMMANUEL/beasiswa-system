<?php session_start(); ?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Login Admin</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container">
        <h2>Login Admin</h2>

        <!-- Jika ada pesan error -->
        <?php if (isset($_SESSION['error'])) { ?>
            <p style="color:red;"><?= $_SESSION['error'];
                                    unset($_SESSION['error']); ?></p>
        <?php } ?>

        <form action="proses_login.php" method="POST">
            <label>Email</label>
            <input type="email" name="email" required>

            <label>Password</label>
            <input type="password" name="password" required>

            <button type="submit">Masuk</button>
        </form>

        <p><a href="home.php">Daftar Beasiswa</a></p>
    </div>
</body>

</html>