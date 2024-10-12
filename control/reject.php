<?php 
// reject.php
include '../db/db.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']); // Mengambil ID dari URL

    // Update status permintaan menjadi 'rejected'
    $query = "UPDATE requests SET status = 'rejected' WHERE id = $id";
    if ($conn->query($query) === TRUE) {
        echo "Permintaan berhasil di-reject.";
    } else {
        echo "Terjadi kesalahan saat meng-update: " . $conn->error;
    }
} else {
    echo "Invalid request.";
}

$conn->close();
