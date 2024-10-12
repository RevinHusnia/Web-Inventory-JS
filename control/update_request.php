<?php
include '../db/db.php';

if (isset($_POST['approve'])) {
    $request_id = $_POST['request_id'];
    
    // Perbarui status menjadi 'approved'
    $query = "UPDATE requests SET status = 'approved' WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $request_id);
    $stmt->execute();

    // Arahkan kembali atau tunjukkan konfirmasi
    header("Location: ../admin/requests.php");
    exit();
}

if (isset($_POST['reject'])) {
    $request_id = $_POST['request_id'];
    
    // Perbarui status menjadi 'rejected'
    $query = "UPDATE requests SET status = 'rejected' WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $request_id);
    $stmt->execute();

    // Kurangi jumlah notifikasi
    if (isset($_SESSION['notif_count'])) {
        $_SESSION['notif_count'] -= 1;
    }
    // Arahkan kembali atau tunjukkan konfirmasi
    header("Location: ../admin/requests.php");
    exit();

    
}
