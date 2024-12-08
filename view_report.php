<?php
// Koneksi ke database
$koneksi = new mysqli("localhost", "root", "", "uts");

// Cek koneksi
if ($koneksi->connect_error) {
    die("Koneksi gagal: " . $koneksi->connect_error);
}

// Query untuk mengambil data
$sql = "
SELECT 
    m.nama_member AS Member,
    m.level AS Level,
    CONCAT(m.diskon_member, '%') AS Diskon_Member,
    CONCAT(k.diskon_kategori, '%') AS Diskon_Barang,
    t.total_harga AS Total_Pembelian,
    t.total_diskon AS Total_Diskon,
    (t.total_harga - t.total_diskon) AS Total_Transaksi
FROM transaksi t
JOIN member m ON t.id_member = m.id_member
JOIN barang b ON t.id_barang = b.id_barang
JOIN kategori k ON b.id_kategori = k.id_kategori;
";

$result = $koneksi->query($sql);

// Tampilkan data
if ($result->num_rows > 0) {
    echo "<table border='1'>
            <tr>
                <th>Member</th>
                <th>Level</th>
                <th>Diskon Member</th>
                <th>Diskon Barang</th>
                <th>Total Pembelian</th>
                <th>Total Diskon</th>
                <th>Total Transaksi</th>
            </tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['Member']}</td>
                <td>{$row['Level']}</td>
                <td>{$row['Diskon_Member']}</td>
                <td>{$row['Diskon_Barang']}</td>
                <td>{$row['Total_Pembelian']}</td>
                <td>{$row['Total_Diskon']}</td>
                <td>{$row['Total_Transaksi']}</td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "Tidak ada data.";
}

// Tutup koneksi
$koneksi->close();


?>

<a href="index.php">Back</a>