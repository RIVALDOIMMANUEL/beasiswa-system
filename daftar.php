<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Form Beasiswa</title>
    <link rel="stylesheet" href="style.css">

    <script>
        // Function to auto-fill IPK based on the selected semester
        function autoFillIpk() {
            let semester = document.getElementById("semester").value;
            let ipkField = document.getElementById("ipk");

            // Example: Set default IPK based on semester
            switch (semester) {
                case "1":
                    ipkField.value = 2.9;
                    break;
                case "2":
                    ipkField.value = 3.10;
                    break;
                case "3":
                    ipkField.value = 3.20;
                    break;
                case "4":
                    ipkField.value = 3.30;
                    break;
                case "5":
                    ipkField.value = 3.40;
                    break;
                case "6":
                    ipkField.value = 3.50;
                    break;
                case "7":
                    ipkField.value = 3.60;
                    break;
                case "8":
                    ipkField.value = 3.70;
                    break;
                default:
                    ipkField.value = "";
            }
            cekIpk(); // Re-check IPK validation after auto-filling
        }

        // Function to check the IPK value and enable/disable fields
        function cekIpk() {
            let ipk = parseFloat(document.getElementById("ipk").value);
            let pilihan = document.getElementById("pilihan");
            let berkas = document.getElementById("berkas");

            if (!isNaN(ipk) && ipk >= 2.95) {
                pilihan.disabled = false;
                berkas.disabled = false;
            } else {
                pilihan.disabled = true;
                berkas.disabled = true;
                pilihan.value = "";
                berkas.value = "";
            }
        }
    </script>
</head>

<body>
    <div class="container">
        <h2>Form Beasiswa</h2>

        <form action="simpan.php" method="POST" enctype="multipart/form-data">
            <label>Nama</label>
            <input name="nama" required>

            <label>Email</label>
            <input type="email" name="email" required>

            <label>No HP</label>
            <input name="hp" required>

            <label>Semester</label>
            <select name="semester" id="semester" required onchange="autoFillIpk()">
                <option value="">Pilih Semester</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
                <option value="7">7</option>
                <option value="8">8</option>
            </select>

            <label>Jenjang Pendidikan</label>
            <select name="jenjang" required>
                <option value="">Pilih Jenjang</option>
                <option value="S1">S1</option>
                <option value="S2">S2</option>
                <option value="S3">S3</option>
            </select>

            <label>IPK Terakhir</label>
            <input type="number" name="ipk" id="ipk" min="2.9" max="4.00" step="0.01" required readonly>

            <label>Pilihan Beasiswa</label>
            <select name="pilihan" id="pilihan" required disabled>
                <option value="">Pilih Beasiswa</option>
                <option value="Beasiswa KJP">Beasiswa KJP</option>
                <option value="Beasiswa Tidak Mampu">Beasiswa Tidak Mampu</option>
                <option value="Beasiswa Prestasi">Beasiswa Prestasi</option>
            </select>

            <label>Upload Berkas</label>
            <input type="file" name="berkas" id="berkas" accept=".pdf,.jpg,.jpeg,.png,.zip" required disabled>

            <button type="submit">Daftar</button>
        </form>

        <!-- New Button to Check Registration Status -->
        <p><a href="status_pendaftaran.php">Lihat Status Pendaftaran</a></p>

        <!-- Link to go back to login page -->
        <p><a href="index.php">Kembali ke Login</a></p>
    </div>
</body>

</html>