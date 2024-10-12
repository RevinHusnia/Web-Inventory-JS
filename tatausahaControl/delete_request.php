<?php
include '../db/db.php'; // Koneksi ke database

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Siapkan query untuk menghapus data
    $query = "DELETE FROM requests WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id); // Bind parameter (i untuk integer)

    if ($stmt->execute()) {
        // Jika berhasil, redirect kembali ke halaman sebelumnya
        header("Location: ../tatausaha/TU-DataRequest.php"); 
        exit(); // Pastikan untuk menghentikan skrip setelah header redirect
    } else {
        // Jika gagal, tampilkan pesan error
        echo "Error deleting record: " . $conn->error;
    }

    $stmt->close();
}

$conn->close();