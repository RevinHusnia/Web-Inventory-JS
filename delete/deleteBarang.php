<?php
// Include database connection
include '../db/db.php';

// Check if POST data is set
if (isset($_POST['kode_barang']) && isset($_POST['ukuran'])) {
    $kode_barang = $_POST['kode_barang'];
    $ukuran = $_POST['ukuran'];

    // Start transaction to ensure both deletions happen together
    $conn->begin_transaction();

    try {
        // First, delete from barang_ukuran where kode_barang and ukuran match
        $stmt1 = $conn->prepare("DELETE FROM barang_ukuran WHERE kode_barang = ? AND ukuran = ?");
        $stmt1->bind_param("ss", $kode_barang, $ukuran);
        $stmt1->execute();
        $stmt1->close();

        // Then, delete from barang where kode_barang matches
        $stmt2 = $conn->prepare("DELETE FROM barang WHERE kode_barang = ?");
        $stmt2->bind_param("s", $kode_barang);
        $stmt2->execute();
        $stmt2->close();

        // If both queries succeed, commit the transaction
        $conn->commit();

        // Return success response
        echo json_encode(['status' => 'success', 'message' => 'Item deleted successfully']);
    } catch (Exception $e) {
        // If there's an error, rollback the transaction
        $conn->rollback();
        echo json_encode(['status' => 'error', 'message' => 'Failed to delete item']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request']);
}

// Close the connection
$conn->close();
