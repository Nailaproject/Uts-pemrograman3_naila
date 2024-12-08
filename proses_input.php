<?php

// Koneksi ke database
$koneksi = new mysqli("localhost", "root", "", "uts");

// Cek koneksi
if ($koneksi->connect_error) {
    die("Koneksi gagal: " . $koneksi->connect_error);
}

// Tangkap data dari form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['nama_member'];
    $level = $_POST['level'];
    $diskon = $_POST['diskon_member'];

    // Query untuk menambahkan data baru
    $sql = "INSERT INTO member (nama_member, level, diskon_member) VALUES ('$nama', '$level', '$diskon')";

    if ($koneksi->query($sql) === TRUE) {
        // Redirect ke halaman view_report.php setelah berhasil
        header("Location: view.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $koneksi->error;
    }

    // Tutup koneksi
    $koneksi->close();
}
?>