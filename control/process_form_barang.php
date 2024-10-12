<?php
// Include database connection
include '../db/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $itemCode = $_POST['itemCode_barang'];
    $itemName = $_POST['itemName_barang'];
    $itemQuantity = $_POST['itemQuantity_barang'];
    $itemPrice = $_POST['itemPrice_barang'];  // Tambahkan harga barang

    // Handle item size (if custom is selected, use the custom input)
    if ($_POST['itemSize_barang'] == 'Custom') {
        $itemSize = $_POST['customSize_barang'];  // Custom size input
    } else {
        $itemSize = $_POST['itemSize_barang'];  // Standard size (S, M, L, XL)
    }

    $itemPhoto = $_FILES['itemPhoto_barang'];

    // Process the photo upload
    $targetDir = "../uploads/";
    if (!is_dir($targetDir)) {
        mkdir($targetDir, 0777, true);  // Create the uploads directory if it doesn't exist
    }
    $targetFile = $targetDir . basename($itemPhoto["name"]);
    move_uploaded_file($itemPhoto["tmp_name"], $targetFile);

    // Check if the item already exists in the 'barang' table
    $stmt = $conn->prepare("SELECT id FROM barang WHERE kode_barang = ?");
    $stmt->bind_param("s", $itemCode);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        // The item already exists, update logic could be handled here
    } else {
        // The item doesn't exist, insert it into the 'barang' table along with harga
        $stmtInsertBarang = $conn->prepare("INSERT INTO barang (kode_barang, nama_barang, jumlah, foto, harga_barang) VALUES (?, ?, ?, ?, ?)");
        $stmtInsertBarang->bind_param("ssisd", $itemCode, $itemName, $itemQuantity, $targetFile, $itemPrice); // Harga disertakan
        $stmtInsertBarang->execute();

        // Get the newly inserted item ID
        $barangId = $stmtInsertBarang->insert_id;

        // Add the size to the 'barang_ukuran' table
        $stmtInsertUkuran = $conn->prepare("INSERT INTO barang_ukuran (kode_barang, ukuran, jumlah_tersedia) VALUES (?, ?, ?)");
        $stmtInsertUkuran->bind_param("ssi", $itemCode, $itemSize, $itemQuantity);
        $stmtInsertUkuran->execute();
    }

    // Redirect to index.php after saving
    header("Location: /pages/DataBarang.php");
    exit();  // Stop further script execution
}