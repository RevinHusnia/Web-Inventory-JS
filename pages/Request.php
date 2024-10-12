<?php 
include '../partials/header.php'; 
include '../control/update_request.php'; 
include '../db/db.php'; // Koneksi ke database

// Ambil semua permintaan yang statusnya masih pending
$query = "SELECT * FROM requests WHERE status = 'pending'";
$result = mysqli_query($conn, $query);
?>

<div class="form-overlay" id="formOverlay"></div>
<div class="content">
    <div class="header">
        <div class="user-info" id="userInfo">
            <div class="admin-clickable" id="adminClickable">
                <img src="/assets/user.png" alt="Admin" class="admin-img">
                <span class="admin-text">admin ▼</span>
            </div>
        </div>

        <!-- Popup Konfirmasi Logout -->
        <div id="logoutModal" style="display: none;">
            <div>
                <p>Apakah Anda ingin logout?</p>
                <button id="confirmLogout">Yes</button>
                <button id="cancelLogout">No</button>
            </div>
        </div>
    </div>

    <div class="data-barang">
        <div class="table-container-history">
            <h1>Request</h1>
            <table class="data-table-history">
                <thead>
                    <tr>
                        <th>Seragam</th>
                        <th>Kode Barang</th>
                        <th>Ukuran</th>
                        <th>Nama Pemesan</th>
                        <th>Tanggal</th>
                        <th>Nama Pengirim</th>
                        <th>Jumlah</th>
                        <th>Foto Barang</th>
                        <th>Menu</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include '../control/approve.php';
                    include '../control/reject.php';
                    if (mysqli_num_rows($result) > 0) {
                        // Loop through each request and display in the table
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            echo "<td>" . $row['nama_barang'] . "</td>";
                            echo "<td>" . $row['kode_barang'] . "</td>";
                            echo "<td>" . $row['ukuran'] . "</td>";
                            echo "<td>" . $row['nama_pemesan'] . "</td>";
                            echo "<td>" . $row['tanggal'] . "</td>";
                            echo "<td>" . $row['nama_pengirim'] . "</td>";
                            echo "<td>" . $row['jumlah'] . "</td>";
                            $imagePath = '../uploads/' . $row['foto_barang'];
                            if (file_exists($imagePath)) {
                                echo "<td><img src='" . $imagePath . "' alt='Foto Barang' width='100' onclick='openImageModal(this.src)'></td>";
                            } else {
                                echo "<td>Image not found</td>";
                            }
                            
                            echo "<td>
                                    <button onclick=\"confirmAction('approve', " . $row['id'] . ")\">Approve</button>
                                    <button class=\"btn-delete\" onclick=\"confirmAction('reject', " . $row['id'] . ")\">Reject</button>
                                  </td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='9'>No pending requests</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div id="imageModal" class="modal" style="display: none;">
    <span class="close" onclick="closeImageModal()">&times;</span>
    <img class="modal-content" id="modalImage">
</div>

<script>
    // Fungsi untuk menampilkan modal konfirmasi logout
    document.getElementById('adminClickable').addEventListener('click', function() {
        var result = confirm("Apakah Anda yakin ingin logout?");
        if (result) {
            // Jika pengguna menekan "OK"
            alert("Logout berhasil!");
            window.location.href = '/Login.php';
        } else {
            alert("Logout dibatalkan.");
        }
    });

    // Fungsi untuk membuka modal gambar
    function openImageModal(src) {
        document.getElementById("modalImage").src = src;
        document.getElementById("imageModal").style.display = "block";
    }

    // Fungsi untuk menutup modal gambar
    function closeImageModal() {
        document.getElementById("imageModal").style.display = "none";
    }

    // Fungsi untuk konfirmasi approve/reject
    function confirmAction(action, id) {
        var actionText = action === 'approve' ? 'approve' : 'reject';
        if (confirm("Apakah Anda yakin ingin " + actionText + " request ini?")) {
            // Kirim permintaan ke server
            fetch('../control/' + action + '.php?id=' + id)
                .then(response => {
                    if (response.ok) {
                        alert("Action " + actionText + " berhasil dikirim ke TataUsaha.");
                        location.reload(); // Reload halaman untuk melihat data terbaru
                    } else {
                        alert("Gagal mengirim action " + actionText + ".");
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        }
    }
</script>

<?php include '../partials/footer.php'; ?>
