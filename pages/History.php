<?php 
include '../partials/header.php'; 
include '../db/db.php'; 
include '../control/request.php'; 
 

// Query untuk mengambil semua request yang sudah di-approve atau di-reject
$query = "SELECT * FROM requests WHERE status IN ('approved', 'rejected')";
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
            <h1>History Permintaan yang Di-Approve/Reject</h1>
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
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    // Loop untuk menampilkan semua request yang sudah di-approve atau di-reject
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . $row['nama_barang'] . "</td>";
                        echo "<td>" . $row['kode_barang'] . "</td>";
                        echo "<td>" . $row['ukuran'] . "</td>";
                        echo "<td>" . $row['nama_pemesan'] . "</td>";
                        echo "<td>" . $row['tanggal'] . "</td>";
                        echo "<td>" . $row['nama_pengirim'] . "</td>";
                        echo "<td>" . $row['jumlah'] . "</td>";
                        echo "<td>" . ucfirst($row['status']) . "</td>";  // Menampilkan status
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div id="imageModal" class="modal">
    <span class="close">&times;</span>
    <img class="modal-content" id="modalImage">
</div>

<script>
    // Fungsi untuk menampilkan modal konfirmasi logout
    document.getElementById('adminClickable').addEventListener('click', function() {
        var result = confirm("Apakah Anda yakin ingin logout?");
        if (result) {
            alert("Logout berhasil!");
            window.location.href = '/Login.php';
        } else {
            alert("Logout dibatalkan.");
        }
    });

    // Menutup modal gambar saat diklik
    document.getElementsByClassName("close")[0].onclick = function() {
        document.getElementById("imageModal").style.display = "none";
    }
</script>

<?php include '../partials/footer.php'; ?>
