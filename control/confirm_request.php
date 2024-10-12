<?php
include '../db/db.php';

if (isset($_GET['action']) && isset($_GET['id'])) {
    $action = $_GET['action'];
    $request_id = $_GET['id'];

    // Ambil data request berdasarkan ID
    $query = "SELECT * FROM requests WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $request_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $request = $result->fetch_assoc();

        // Pindahkan data ke tabel history
        $insertQuery = "INSERT INTO history (nama_barang, kode_barang, ukuran, nama_pemesan, tanggal, nama_pengirim, jumlah, foto_barang, status, action_date)
                        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())";
        $stmtInsert = $conn->prepare($insertQuery);
        $status = $action == 'approve' ? 'approved' : 'rejected';
        $stmtInsert->bind_param('ssisssiss', $request['nama_barang'], $request['kode_barang'], $request['ukuran'], $request['nama_pemesan'], $request['tanggal'], $request['nama_pengirim'], $request['jumlah'], $request['foto_barang'], $status);
        $stmtInsert->execute();

        // Hapus data dari tabel requests setelah berhasil dipindahkan ke history
        if ($stmtInsert) {
            $deleteQuery = "DELETE FROM requests WHERE id = ?";
            $stmtDelete = $conn->prepare($deleteQuery);
            $stmtDelete->bind_param("i", $request_id);
            $stmtDelete->execute();
        }
    }

    $stmt->close();
    $conn->close();
}
