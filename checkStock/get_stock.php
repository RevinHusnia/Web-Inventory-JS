<?php
include '../db/db.php';

// Periksa apakah parameter kode_barang dan ukuran ada
if (isset($_GET['kode_barang']) && isset($_GET['ukuran'])) {
    $kodeBarang = $_GET['kode_barang'];
    $ukuran = $_GET['ukuran'];

    // Siapkan pernyataan untuk mendapatkan ketersediaan berdasarkan kode_barang dan ukuran
    $stmt = $conn->prepare("SELECT ketersediaan FROM barang WHERE kode_barang = ? AND ukuran = ?");
    $stmt->bind_param("ss", $kodeBarang, $ukuran);
    $stmt->execute();
    $stmt->bind_result($ketersediaan);
    $stmt->fetch();

    // Kembalikan ketersediaan dalam format JSON
    echo json_encode(['stock' => $ketersediaan]);
    $stmt->close();
} else {
    // Jika parameter tidak ada, kembalikan error dalam format JSON
}

if (isset($_GET['kode_barang']) && isset($_GET['ukuran'])) {
    $kodeBarang = $_GET['kode_barang'];
    $ukuran = $_GET['ukuran'];

    // Debugging sementara
    error_log("kode_barang: $kodeBarang, ukuran: $ukuran");

    // Siapkan pernyataan untuk mendapatkan ketersediaan berdasarkan kode_barang dan ukuran
    // ...
}