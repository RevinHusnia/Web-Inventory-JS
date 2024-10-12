<?php
include '../db/db.php';
$sql = "SELECT COUNT(*) AS count FROM requests";
$result = $conn->query($sql);
$pendingRequests = 0;
if ($result && $row = $result->fetch_assoc()) {
    $pendingRequests = $row['count'];
}
echo $pendingRequests;
$conn->close();
