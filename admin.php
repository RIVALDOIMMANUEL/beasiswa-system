<?php
session_start();
if (!isset($_SESSION['login'])) {
    header("Location:index.php");
    exit;
}

$conn = mysqli_connect("localhost", "root", "", "beasiswa");

// SEARCH
$keyword = '';
if (isset($_GET['search'])) {
    $keyword = mysqli_real_escape_string($conn, $_GET['search']);
}

// UPDATE STATUS
if (isset($_GET['action']) && isset($_GET['id'])) {
    $id = $_GET['id'];
    $status = ($_GET['action'] == 'diterima') ? 'diterima' : 'tidak diterima';

    $stmt = mysqli_prepare($conn, "UPDATE pendaftar SET status = ? WHERE id = ?");
    mysqli_stmt_bind_param($stmt, 'si', $status, $id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    header("Location: admin.php");
    exit;
}

// DELETE
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    $stmt_delete = mysqli_prepare($conn, "DELETE FROM pendaftar WHERE id = ?");
    mysqli_stmt_bind_param($stmt_delete, 'i', $delete_id);
    mysqli_stmt_execute($stmt_delete);
    mysqli_stmt_close($stmt_delete);

    header("Location: admin.php");
    exit;
}

// HITUNG DATA
$total_query = "SELECT COUNT(*) AS total FROM pendaftar";
$diterima_query = "SELECT COUNT(*) AS diterima FROM pendaftar WHERE status='diterima'";
$tidak_query = "SELECT COUNT(*) AS tidak FROM pendaftar WHERE status='tidak diterima'";

if ($keyword != '') {
    $total_query .= " WHERE nama LIKE '%$keyword%'";
    $diterima_query .= " AND nama LIKE '%$keyword%'";
    $tidak_query .= " AND nama LIKE '%$keyword%'";
}

$total = mysqli_fetch_assoc(mysqli_query($conn, $total_query))['total'];
$diterima = mysqli_fetch_assoc(mysqli_query($conn, $diterima_query))['diterima'];
$tidak_diterima = mysqli_fetch_assoc(mysqli_query($conn, $tidak_query))['tidak'];

// AMBIL DATA
$data_query = "SELECT * FROM pendaftar";
if ($keyword != '') {
    $data_query .= " WHERE nama LIKE '%$keyword%'";
}
$data = mysqli_query($conn, $data_query);
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Admin Panel - Beasiswa</title>
    <link rel="stylesheet" href="admin style.css">
</head>

<body>
    <h2>Data Pendaftar</h2>
    <a href="logout.php">Logout</a>

    <!-- SEARCH FORM -->
    <form method="get">
        <input type="text" name="search" placeholder="Cari nama..." value="<?= htmlspecialchars($keyword) ?>">
        <button type="submit">Cari</button>
        <?php if ($keyword != ''): ?>
            <a href="admin.php">Reset</a>
        <?php endif; ?>
    </form>

    <!-- SUMMARY BOX -->
    <div class="summary">
        <div class="total">Total: <?= $total ?></div>
        <div class="diterima">Diterima: <?= $diterima ?></div>
        <div class="tidak">Tidak: <?= $tidak_diterima ?></div>
    </div>

    <!-- DATA TABLE -->
    <table>
        <thead>
            <tr>
                <th>Nama</th>
                <th>Email</th>
                <th>Jenjang</th>
                <th>IPK</th>
                <th>Pilihan</th>
                <th>Berkas</th>
                <th>Status</th>
                <th>Aksi</th>
                <th>Hapus</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($r = mysqli_fetch_assoc($data)) { ?>
                <tr>
                    <td><?= htmlspecialchars($r['nama']) ?></td>
                    <td><?= htmlspecialchars($r['email']) ?></td>
                    <td><?= htmlspecialchars($r['jenjang']) ?></td>
                    <td><?= htmlspecialchars($r['ipk']) ?></td>
                    <td><?= htmlspecialchars($r['pilihan']) ?></td>
                    <td><a href="uploads/<?= htmlspecialchars($r['berkas']) ?>" target="_blank">Download</a></td>
                    <td>
                        <?php
                        if ($r['status'] == 'diterima') echo '<span style="color:green;">Diterima</span>';
                        elseif ($r['status'] == 'tidak diterima') echo '<span style="color:red;">Tidak Diterima</span>';
                        else echo 'Belum Diperiksa';
                        ?>
                    </td>
                    <td>
                        <a href="admin.php?action=diterima&id=<?= $r['id'] ?>" class="action diterima">Diterima</a>
                        <a href="admin.php?action=tidak diterima&id=<?= $r['id'] ?>" class="action tidak">Tidak</a>
                    </td>
                    <td>
                        <a href="admin.php?delete_id=<?= $r['id'] ?>" class="action tidak" onclick="return confirm('Yakin ingin menghapus data ini?');">🗑️</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

    <footer style="text-align:center; margin-top:20px; font-size:14px; color:#fff;">
        © <?= date("Y"); ?> Portal Beasiswa. All Rights Reserved.
    </footer>
</body>

</html>