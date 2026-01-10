<?php
session_start();
if (!isset($_SESSION['login'])) {
    header("Location:index.php");
    exit;
}
$conn = mysqli_connect("localhost", "root", "", "beasiswa");
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
        </tr>
        <?php while ($r = mysqli_fetch_assoc($data)) { ?>
            <tr>
                <td><?= $r['nama'] ?></td>
                <td><?= $r['email'] ?></td>
                <td><?= $r['jenjang'] ?></td>
                <td><?= $r['ipk'] ?></td>
                <td><?= $r['pilihan'] ?></td>
                <td><a href="uploads/<?= $r['berkas'] ?>" target="_blank">Download</a></td>
            </tr>
        <?php } ?>
    </table>
</body>

</html>