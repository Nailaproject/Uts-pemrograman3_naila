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
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Transaksi</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f9f9f9;
        }
        h2 {
            text-align: center;
        }
        .table-container {
            max-width: 90%;
            margin: 20px auto;
            overflow-x: auto;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            background-color: #fff;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ddd;
            text-align: center;
            padding: 10px;
            white-space: nowrap;
        }
        th {
            background-color: #4CAF50;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        tr:hover {
            background-color: #ddd;
        }
        a {
            display: inline-block;
            margin-top: 20px;
            text-decoration: none;
            color: #4CAF50;
            font-weight: bold;
        }
        a:hover {
            text-decoration: underline;
        }
        .back-link {
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <h2>Data Transaksi Member</h2>
    <div class="table-container">
        <?php
        if ($result->num_rows > 0) {
            echo "<table>
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
            echo "<p style='text-align: center;'>Tidak ada data.</p>";
        }
        $koneksi->close();
        ?>
    </div>
    <div class="back-link">
        <a href="index.php">Back</a>
    </div>
</body>
</html>
