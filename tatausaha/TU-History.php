<?php 
include '../partials/TU-header.php';
include '../db/db.php';  // Koneksi ke database

// Query to fetch approved and rejected requests, ordered by the latest date
$query = "SELECT * FROM requests WHERE status = 'approved' OR status = 'rejected' ORDER BY tanggal DESC";
$result = mysqli_query($conn, $query);
?>

<div class="form-overlay" id="formOverlay"></div>
<div class="content">
    <div class="header">
        <div class="user-info" id="userInfo">
            <div class="admin-clickable" id="adminClickable">
                <img src="/assets/user.png" alt="Admin" class="admin-img">
                <span class="admin-text">TataUsaha ▼</span>
            </div>
        </div>

        <!-- Logout Confirmation Popup -->
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
            <h1>Data Riwayat Request</h1>
            <table class="data-table-history">
                <thead>
                    <tr>
                        <th>Kode Barang</th>
                        <th>Nama Barang</th>
                        <th>Jumlah</th>
                        <th>Ukuran</th>
                        <th>Nama Pemesan</th>
                        <th>Tanggal</th>
                        <th>Nama Pengirim</th>
                        <th>Status</th>
                        <th>Foto Barang</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            echo "<td>" . $row['kode_barang'] . "</td>";
                            echo "<td>" . $row['nama_barang'] . "</td>";
                            echo "<td>" . $row['jumlah'] . "</td>";
                            echo "<td>" . $row['ukuran'] . "</td>";
                            echo "<td>" . $row['nama_pemesan'] . "</td>";
                            echo "<td>" . $row['tanggal'] . "</td>";
                            echo "<td>" . $row['nama_pengirim'] . "</td>";
                            echo "<td>" . ucfirst($row['status']) . "</td>";
                            $file_path = '../uploads/' . basename($row['foto_barang']);
                            if (!file_exists($file_path)) {
                                echo '<td>File tidak ditemukan!</td>';
                            } else {
                                echo '<td><img class="img-tr" src="' . $file_path . '" alt="Foto Barang" style="width:50px;height:50px;"></td>';
                            }
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='9'>Tidak ada permintaan yang di-approve atau di-reject</td></tr>";
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
    // Logout confirmation
    document.getElementById('adminClickable').addEventListener('click', function() {
        var result = confirm("Apakah Anda yakin ingin logout?");
        if (result) {
            alert("Logout berhasil!");
            window.location.href = '/login.php';
        } else {
            alert("Logout dibatalkan.");
        }
    });

    // Close the image modal
    document.getElementsByClassName("close")[0].onclick = function() {
        document.getElementById("imageModal").style.display = "none";
    }
</script>

<?php include '../partials/footer.php'; ?>
