<?php
include '../db/db.php'; // Menghubungkan ke database

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ambil data dari form
    $kode_barang = $_POST['itemCode'];
    $nama_barang = $_POST['itemName'];
    $jumlah = $_POST['itemQuantity'];

    // Proses upload foto
    $target_dir = "../uploads/"; // Ganti dengan path yang benar
    $foto_bukti = basename($_FILES["itemPhoto"]["name"]);
    $target_file = $target_dir . $foto_bukti;
    $uploadOk = 1;
    
    // Cek apakah file benar-benar gambar
    $check = getimagesize($_FILES["itemPhoto"]["tmp_name"]);
    if ($check === false) {
        echo "File is not an image.";
        $uploadOk = 0;
    }

    // Cek jika ada error pada upload
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    } else {
        if (move_uploaded_file($_FILES["itemPhoto"]["tmp_name"], $target_file)) {
            // Insert data ke database
            $stmt = $conn->prepare("INSERT INTO datalaporan (kode_barang, nama_barang, jumlah, foto_bukti) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("ssis", $kode_barang, $nama_barang, $jumlah, $foto_bukti);

            if ($stmt->execute()) {
                echo "Data has been saved successfully.";
                header("Location: ../pages/DataLaporan.php"); // Redirect ke halaman data
                exit();
            } else {
                echo "Error: " . $stmt->error;
            }
            $stmt->close();
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }

    $conn->close();
}
