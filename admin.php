<?php
session_start();
if (!isset($_SESSION['login'])) {
    header("Location:index.php");
    exit;
}

$conn = mysqli_connect("localhost", "root", "", "beasiswa");

// Menangani aksi untuk memperbarui status pendaftar
if (isset($_GET['action']) && isset($_GET['id'])) {
    $id = $_GET['id'];
    $status = $_GET['action'] == 'diterima' ? 'diterima' : 'tidak diterima';
    $query = "UPDATE pendaftar SET status = ? WHERE id = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, 'si', $status, $id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
}

// Menangani aksi untuk menghapus data pendaftar
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    $delete_query = "DELETE FROM pendaftar WHERE id = ?";
    $stmt_delete = mysqli_prepare($conn, $delete_query);
    mysqli_stmt_bind_param($stmt_delete, 'i', $delete_id);
    mysqli_stmt_execute($stmt_delete);
    mysqli_stmt_close($stmt_delete);
    header("Location: admin.php"); // Redirect ke halaman admin setelah penghapusan
    exit;
}

// Mengambil data pendaftar dari database
$data = mysqli_query($conn, "SELECT * FROM pendaftar");

?>
<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="admin style.css">
</head>

<body>
    <h2>Data Pendaftar</h2>
    <a href="logout.php">Logout</a>
    <table border="1" cellpadding="6">
        <tr>
            <th>Nama</th>
            <th>Email</th>
            <th>Jenjang</th>
            <th>IPK</th>
            <th>Pilihan</th>
            <th>Berkas</th>
            <th>Status</th>
            <th>Action</th>
            <th>Hapus</th>
        </tr>
        <?php while ($r = mysqli_fetch_assoc($data)) { ?>
            <tr>
                <td><?= htmlspecialchars($r['nama']) ?></td>
                <td><?= htmlspecialchars($r['email']) ?></td>
                <td><?= htmlspecialchars($r['jenjang']) ?></td>
                <td><?= htmlspecialchars($r['ipk']) ?></td>
                <td><?= htmlspecialchars($r['pilihan']) ?></td>
                <td><a href="uploads/<?= htmlspecialchars($r['berkas']) ?>" target="_blank">Download</a></td>
                <td><?= htmlspecialchars($r['status']) ?></td>
                <td>
                    <!-- Tombol untuk mengubah status 'Diterima' -->
                    <a href="admin.php?action=diterima&id=<?= $r['id'] ?>" style="color: green;">Diterima</a>
                    |
                    <!-- Tombol untuk mengubah status 'Tidak Diterima' -->
                    <a href="admin.php?action=tidak diterima&id=<?= $r['id'] ?>" style="color: red;">Tidak Diterima</a>
                </td>
                <td>
                    <!-- Tombol untuk menghapus data dengan emoji 🗑️ -->
                    <a href="admin.php?delete_id=<?= $r['id'] ?>" style="color: red;" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
                        🗑️
                    </a>
                </td>
            </tr>
        <?php } ?>
    </table>
</body>

</html>