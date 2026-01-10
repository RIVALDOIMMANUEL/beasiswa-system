<?php
$conn = mysqli_connect("localhost", "root", "", "beasiswa");

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

$nama = $_POST['nama'];
$email = $_POST['email'];
$hp = $_POST['hp'];
$semester = $_POST['semester'];
$ipk = $_POST['ipk'];
$pilihan = $_POST['pilihan'];
$jenjang = $_POST['jenjang'];  // Menambahkan jenjang
$namaFile = $_FILES['berkas']['name'];
$tmp = $_FILES['berkas']['tmp_name'];

// Membuat folder upload jika belum ada
if (!is_dir("uploads")) {
    mkdir("uploads");
}

// Memindahkan file berkas ke folder uploads
move_uploaded_file($tmp, "uploads/" . $namaFile);

// Query SQL untuk menyimpan data pendaftar, termasuk jenjang
$sql = "INSERT INTO pendaftar(nama, email, hp, semester, ipk, pilihan, jenjang, berkas)
        VALUES('$nama', '$email', '$hp', '$semester', '$ipk', '$pilihan', '$jenjang', '$namaFile')";

// Menjalankan query
if (mysqli_query($conn, $sql)) {
    echo "Pendaftaran berhasil! <a href='daftar.php'>Kembali</a>";
} else {
    echo "Terjadi kesalahan: " . mysqli_error($conn);
}

// Menutup koneksi
mysqli_close($conn);
