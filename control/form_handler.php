<?php
include '../db/db.php'; // Menghubungkan ke database

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ambil data dari form
    $kode_barang = $_POST['itemCode'];
    $nama_barang = $_POST['itemName'];
    $jumlah = $_POST['itemQuantity'];

    // Proses upload foto
    $target_dir = "uploads/";
    $foto_bukti = basename($_FILES["itemPhoto"]["name"]);
    $target_file = $target_dir . $foto_bukti;
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Cek apakah file benar-benar gambar
    $check = getimagesize($_FILES["itemPhoto"]["tmp_name"]);
    if ($check !== false) {
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }

    // Cek jika ada error pada upload
    $target_dir = "../uploads/"; // Pastikan jalur relatif benar
    $foto_bukti = basename($_FILES["itemPhoto"]["name"]);
    $target_file = $target_dir . $foto_bukti;
    
    if (move_uploaded_file($_FILES["itemPhoto"]["tmp_name"], $target_file)) {
        // Proses insert ke database jika upload berhasil
        $stmt = $conn->prepare("INSERT INTO datapeminjaman (kode_barang, nama_barang, jumlah, foto_bukti) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssis", $kode_barang, $nama_barang, $jumlah, $foto_bukti);
    
        if ($stmt->execute()) {
            echo "Data has been saved successfully.";
            header("Location: ../pages/DataPeminjaman.php");
        } else {
            echo "Error: " . $stmt->error;
        }
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
    
    $conn->close();
}
