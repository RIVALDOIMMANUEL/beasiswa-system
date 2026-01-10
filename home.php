<?php session_start(); ?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Home - Portal Beasiswa</title>
    <link rel="stylesheet" href="home style.css">
</head>

<body>

    <div class="card">
        <h2>Portal Beasiswa</h2>
        <p>Pilih menu di bawah:</p>

        <!-- Pilihan Jenjang untuk Pendaftar atau Admin -->
        <label for="jenjang">Pilih Jenjang Beasiswa:</label>
        <select name="jenjang" id="jenjang">
            <option value="S1">S1</option>
            <option value="S2">S2</option>
            <option value="S3">S3</option>
        </select>

        <br><br>

        <a href="index.php" class="btn-link">Login Admin</a>
        <a href="daftar.php" class="btn-link">Daftar Beasiswa</a>

        <?php if (isset($_SESSION['login'])): ?>
            <a href="admin.php" class="btn-link">Dashboard Admin</a>
        <?php endif; ?>
    </div>

    <footer>
        © <?php echo date('Y'); ?> Portal Beasiswa
    </footer>

</body>

</html>