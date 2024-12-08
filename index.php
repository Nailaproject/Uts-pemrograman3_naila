<?php
// File: input.php
?>
<!DOCTYPE html>
<html>
<head>
    <title>Input Data</title>
</head>
<body>
    <h2>Tambah Member Baru</h2>
    <form action="proses_input.php" method="POST">
        <label for="nama">Nama Member:</label><br>
        <input type="text" id="nama" name="nama_member" required><br><br>

        <label for="level">Level:</label><br>
        <select id="level" name="level" required>
            <option value="Gold">Silver</option>
            <option value="Silver">Gold</option>
            <option value="Platinum">Platinum</option>
        </select><br><br>

        <label for="diskon">Diskon Member (%):</label><br>
        <input type="number" id="diskon" name="diskon_member" required><br><br>

        <button type="submit">Submit</button>
    </form>
    <br>
    <a href="view.php">Lihat Semua Data</a>
    <a href="view_report.php">Lihat Keseluruhan Transaksi</a>
</body>
</html>