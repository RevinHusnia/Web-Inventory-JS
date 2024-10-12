<?php
include '../db/db.php';

if (isset($_GET['id'])) {
    $itemCode = $_GET['id'];

    // Prepared statement untuk mencegah SQL injection
    $stmt = $conn->prepare("DELETE FROM datapeminjaman WHERE kode_barang = ?");
    $stmt->bind_param("s", $itemCode);

    if ($stmt->execute()) {
        echo "Record deleted successfully";
        // Redirect ke halaman data setelah berhasil menghapus
        header("Location: ../pages/DataPeminjaman.php?deleted=true");
        exit(); // Pastikan untuk mengakhiri script setelah redirect
    } else {
        echo "Error deleting record: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
