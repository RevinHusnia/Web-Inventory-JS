<?php 
include '../db/db.php'; // Koneksi ke database
include '../partials/TU-header.php'; 
include '../control/delete_laporan.php'; 
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
        <div class="table-container">
        <button class="btn-edit" onclick="showPopup()">Edit</button>
            <h1>Data Laporan</h1>
            <table class="data-table">
            <thead>
                

                <tr>
                <th>Kode Barang</th>
                <th>Nama Barang</th>
                <th>Jumlah</th>
                <th>Foto Bukti</th>
                <th>Menu</th>
            </tr>
        </thead>
                
        <tbody>    
                
                <?php
include '../db/db.php'; // Koneksi ke database
include '../control/form_handler_laporan.php'; // Pastikan ini benar dan relevan

// Query untuk mengambil data dari tabel datalaporan
$sql = "SELECT kode_barang, nama_barang, jumlah, foto_bukti FROM datalaporan";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['kode_barang'] . "</td>";
        echo "<td>" . $row['nama_barang'] . "</td>";
        echo "<td>" . $row['jumlah'] . "</td>";
        echo "<td><img class='img-tr' src='../uploads/" . $row['foto_bukti'] . "' alt=''></td>";
        echo "<td><button class='btn-delete' onclick='deleteLaporan(\"" . $row['kode_barang'] . "\")'>Delete</button></td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='5'>No data found</td></tr>";
}

$conn->close();
?>

                </tbody>
            </table>
        </div>

        <div id="popupForm" class="popup">
    <div  class="popup-content">
        <span class="closee" onclick="closePopup()">&times;</span>
        <h2>Form Input</h2>
        <form action="../control/form_handler_laporan.php" method="POST" enctype="multipart/form-data">
    <label for="itemCode">Kode Barang:</label><br>
    <input type="text" id="itemCode" name="itemCode" class="input-request" required><br><br>

    <label for="itemName">Nama Barang:</label><br>
    <input type="text" id="itemName" name="itemName" class="input-request" required><br><br>

    <label for="itemQuantity">Jumlah:</label><br>
    <input type="number" id="itemQuantity" name="itemQuantity" class="input-request" required><br><br>

    <label for="itemPhoto">Foto Barang:</label><br>
    <input type="file" id="itemPhoto" name="itemPhoto" class="input-request" accept="image/*" required><br><br>

    <button type="submit">Submit</button>
</form>

    </div>
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
            // Jika pengguna menekan "OK"
            alert("Logout berhasil!");
            // Aksi logout bisa ditambahkan di sini, seperti redirect ke halaman login
            window.location.href = '/Login.php';
        } else {
            // Jika pengguna menekan "Cancel"
            alert("Logout dibatalkan.");
        }
    });

    // Menutup modal gambar saat diklik
    document.getElementsByClassName("close")[0].onclick = function() {
        document.getElementById("imageModal").style.display = "none";
    }
    function showPopup() {
    document.getElementById("popupForm").style.display = "block";
}

// Fungsi untuk menutup popup
function closePopup() {
    document.getElementById("popupForm").style.display = "none";
}


function deleteLaporan(kodeLaporan) {
    if (confirm('Are you sure you want to delete this report?')) {
        window.location.href = '../control/delete_laporan.php?id=' + kodeLaporan;
    }
}



</script>

<?php include '../partials/footer.php'; ?>
