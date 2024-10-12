<?php
include '../db/db.php'; // Include your database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $nama_barang = $_POST['name'];
    $kode_barang = $_POST['kode_barang'];
    $ukuran = $_POST['ukuran'];
    $nama_pemesan = $_POST['nama_pemesan'];
    $tanggal = $_POST['tanggal'];
    $nama_pengirim = $_POST['nama_pengirim'];
    $jumlah = $_POST['jumlah'];

    // Handle file upload
    $target_dir = "../uploads/"; // Ensure this directory exists and is writable
    $target_file = $target_dir . basename($_FILES["foto_barang"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if image file is a actual image or fake image
    if (isset($_POST["submit"])) {
        $check = getimagesize($_FILES["foto_barang"]["tmp_name"]);
        if ($check !== false) {
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }
    }

    // Check file size
    if ($_FILES["foto_barang"]["size"] > 500000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // Allow certain file formats
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
        echo "Sorry, only JPG, JPEG, PNG files are allowed.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["foto_barang"]["tmp_name"], $target_file)) {
            echo "The file " . htmlspecialchars(basename($_FILES["foto_barang"]["name"])) . " has been uploaded.";

            // Cek apakah file benar-benar ada di lokasi yang diharapkan
            if (file_exists($target_file)) {
                echo "File successfully uploaded and exists at: " . $target_file;
            } else {
                echo "File upload failed or file not found at: " . $target_file;
            }
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }

    // Insert data into database
    $query = "INSERT INTO requests (nama_barang, kode_barang, ukuran, nama_pemesan, tanggal, nama_pengirim, jumlah, foto_barang, status) 
              VALUES (?, ?, ?, ?, ?, ?, ?, ?, 'pending')";  // 'pending' status by default
    $stmt = $conn->prepare($query);
    $stmt->bind_param('ssisssis', $nama_barang, $kode_barang, $ukuran, $nama_pemesan, $tanggal, $nama_pengirim, $jumlah, $target_file);

    if ($stmt->execute()) {
        echo "Request submitted successfully!";
        header("Location: /tatausaha/TU-DataRequest.php"); // Redirect after submission
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
