<?php
include '../db/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $userId = $_POST['user_id'];

    // Update status notifikasi menjadi 'read'
    $query = "UPDATE notifications SET status = 'read' WHERE user_id = $userId AND status = 'unread'";
    mysqli_query($conn, $query);
}
