<?php
include '../db/db.php'; // Koneksi ke database

if (isset($_GET['id'])) {
    $id = intval($_GET['id']); // Mengambil ID dari URL

    // Memastikan ID valid dan aman
    if ($id > 0) {
        // Update status permintaan menjadi 'approved' dengan prepared statement
        $stmt = $conn->prepare("UPDATE requests SET status = ? WHERE id = ?");
        $status = 'approved';
        $stmt->bind_param("si", $status, $id); // "si" berarti string dan integer

        if ($stmt->execute()) {
            $stmt->close();
            // Redirect kembali ke halaman riwayat setelah berhasil
            header("Location: ../pages/History.php?message=Request approved successfully."); 
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }
    } else {
        echo "Invalid request.";
    }
} else {
    echo "Invalid request.";
}
