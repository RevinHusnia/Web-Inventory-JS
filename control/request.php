<?php
include '../db/db.php'; // Koneksi ke database
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $request_id = $_POST['request_id'];
    $action = $_POST['action'];

    if ($action === 'approve') {
        $query = "UPDATE requests SET status = 'approved' WHERE id = '$request_id'";
    } elseif ($action === 'reject') {
        $query = "UPDATE requests SET status = 'rejected' WHERE id = '$request_id'";
    }

    if (mysqli_query($conn, $query)) {
        echo "Status berhasil diperbarui.";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
