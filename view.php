<?php
// File: view.php

// Koneksi ke database
$koneksi = new mysqli("localhost", "root", "", "uts");

// Cek koneksi
if ($koneksi->connect_error) {
    die("Koneksi gagal: " . $koneksi->connect_error);
}

// Query untuk mengambil semua data
$sql = "SELECT * FROM member";
$result = $koneksi->query($sql);

// Tampilkan data dalam tabel
echo "<h2>Daftar Member</h2>";
echo "<table border='1'>
        <tr>
            <th>ID Member</th>
            <th>Nama Member</th>
            <th>Level</th>
            <th>Diskon Member</th>
        </tr>";

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['id_member']}</td>
                <td>{$row['nama_member']}</td>
                <td>{$row['level']}</td>
                <td>{$row['diskon_member']}%</td>
              </tr>";
    }
} else {
    echo "<tr><td colspan='4'>Tidak ada data.</td></tr>";
}
echo "</table>";

// Tutup koneksi
$koneksi->close();
?>
<br>
<a href="index.php">Back</a>