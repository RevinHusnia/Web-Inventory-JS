<?php
// Include database connection
include '../db/db.php';

// Get request ID and action (approve/reject)
$id = $_GET['id'];
$action = $_GET['action']; // Expected to be 'approve' or 'reject'

// Update request status based on action
$status = $action == 'approve' ? 'approved' : 'rejected';
$sql = "UPDATE requests SET status = '$status' WHERE id = $id";

if ($conn->query($sql) === TRUE) {
    // Re-query the pending requests count
    $countSql = "SELECT COUNT(*) AS count FROM requests WHERE status = 'pending'";
    $result = $conn->query($countSql);

    $pendingRequests = 0;
    if ($result && $row = $result->fetch_assoc()) {
        $pendingRequests = $row['count'];
    }

    // Return the updated count to the frontend
    echo json_encode(['status' => 'success', 'pendingRequests' => $pendingRequests]);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Failed to update request']);
}

$conn->close();
