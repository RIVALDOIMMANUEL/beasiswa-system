<?php
// Membuat koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "beasiswa");

// Mengecek apakah koneksi berhasil
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

// Ambil email dari form pencarian
$email = isset($_POST['email']) ? $_POST['email'] : ''; // Ambil email dari form jika ada

?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Status Pendaftaran</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <div class="container">
        <h2>Status Pendaftaran</h2>

        <!-- Form untuk mencari status berdasarkan email -->
        <form method="POST" action="">
            <label for="email">Masukkan Email Anda:</label>
            <input type="email" name="email" id="email" required>
            <button type="submit">Cari Status</button>
        </form>

        <?php
        // Jika email tidak kosong, lakukan pencarian di database
        if ($email != '') {
            // Menggunakan prepared statement untuk menghindari SQL injection
            $query = "SELECT * FROM pendaftar WHERE email = ?";
            $stmt = mysqli_prepare($conn, $query);
            mysqli_stmt_bind_param($stmt, 's', $email); // 's' untuk string
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

            // Jika data ditemukan
            if (mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);
                $status = $row['status']; // Misal kolom 'status' ada di database
                $beasiswa = $row['pilihan'];

                echo "<h3>Informasi Pendaftaran</h3>";
                echo "<p>Nama: " . htmlspecialchars($row['nama']) . "</p>";
                echo "<p>Email: " . htmlspecialchars($row['email']) . "</p>";
                echo "<p>Status Pendaftaran: " . ($status == 'diterima' ? 'Diterima' : 'Tidak Diterima') . "</p>";
                echo "<p>Beasiswa yang dipilih: " . htmlspecialchars($beasiswa) . "</p>";
            } else {
                echo "<p>Data pendaftaran tidak ditemukan. Pastikan Anda sudah mendaftar sebelumnya dengan email yang benar.</p>";
            }

            // Menutup prepared statement
            mysqli_stmt_close($stmt);
        } else {
            echo "<p>Silakan masukkan email untuk mencari status pendaftaran.</p>";
        }

        // Menutup koneksi
        mysqli_close($conn);
        ?>

        <!-- Tombol untuk kembali ke halaman pendaftaran -->
        <p><a href="daftar.php">Kembali ke Daftar</a></p>
        <p><a href="index.php">Login</a></p>
    </div>

</body>

</html>