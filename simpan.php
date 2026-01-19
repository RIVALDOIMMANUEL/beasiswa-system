<?php
// Koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "beasiswa");

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

// Menangkap data dari form
$nama = mysqli_real_escape_string($conn, $_POST['nama']);
$email = mysqli_real_escape_string($conn, $_POST['email']);
$hp = mysqli_real_escape_string($conn, $_POST['hp']);
$semester = mysqli_real_escape_string($conn, $_POST['semester']);
$ipk = mysqli_real_escape_string($conn, $_POST['ipk']);
$pilihan = mysqli_real_escape_string($conn, $_POST['pilihan']);
$jenjang = mysqli_real_escape_string($conn, $_POST['jenjang']);

// Cek apakah email sudah terdaftar
$query = "SELECT * FROM pendaftar WHERE email = ?";
$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, 's', $email);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

// Jika sudah terdaftar
if (mysqli_num_rows($result) > 0) {
    $status = "Email sudah terdaftar. Gunakan email lain.";
    $success = false;
} else {

    // Validasi file upload
    $namaFile = $_FILES['berkas']['name'];
    $tmp = $_FILES['berkas']['tmp_name'];
    $tipeFile = $_FILES['berkas']['type'];
    $ukuranFile = $_FILES['berkas']['size'];
    $maxUkuran = 5 * 1024 * 1024; // 5MB

    // Validasi type
    $validTypes = ['application/pdf', 'image/jpeg', 'image/png', 'application/zip'];
    if (!in_array($tipeFile, $validTypes)) {
        $status = "Hanya file PDF, JPEG, PNG, atau ZIP yang diperbolehkan.";
        $success = false;
    }
    // Validasi ukuran
    elseif ($ukuranFile > $maxUkuran) {
        $status = "File terlalu besar. Maksimal ukuran file adalah 5MB.";
        $success = false;
    } else {
        // Membuat folder upload jika belum ada
        if (!is_dir("uploads")) {
            mkdir("uploads");
        }

        // Upload file
        $targetFile = "uploads/" . basename($namaFile);
        if (!move_uploaded_file($tmp, $targetFile)) {
            $status = "Gagal mengunggah berkas.";
            $success = false;
        } else {
            // Simpan ke database
            $sql = "INSERT INTO pendaftar (nama, email, hp, semester, ipk, pilihan, jenjang, berkas)
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param(
                $stmt,
                'ssssssss',
                $nama,
                $email,
                $hp,
                $semester,
                $ipk,
                $pilihan,
                $jenjang,
                $namaFile
            );

            if (mysqli_stmt_execute($stmt)) {
                $status = "Pendaftaran berhasil!";
                $success = true;
            } else {
                $status = "Terjadi kesalahan saat menyimpan data.";
                $success = false;
            }
        }
    }
}

mysqli_stmt_close($stmt);
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Hasil Registrasi</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <div class="<?= $success ? 'success-box' : 'error-box' ?>">
        <h2><?= $status ?></h2>
        <br>
        <a href="daftar.php">Kembali ke formulir</a>
    </div>

</body>

</html>