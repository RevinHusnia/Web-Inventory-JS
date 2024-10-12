<?php
include '../db/db.php'; // Koneksi ke database

if (isset($_GET['id'])) {
    $kodeLaporan = $_GET['id'];

    // Hapus record dari tabel datalaporan
    $sql = "DELETE FROM datalaporan WHERE kode_barang = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $kodeLaporan);

    if ($stmt->execute()) {
        header("Location: /pages/DataLaporan.php?deleted=true"); // Redirect setelah sukses
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
