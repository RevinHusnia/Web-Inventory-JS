<?php 
include '../partials/TU-header.php'; 
include '../db/db.php'; 

session_start();

// Cek apakah pengguna sudah login dan role-nya Tata Usaha
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'tatausaha') {
    header("Location: Login.php");
    exit();
}


?>

<div class="content">
    <div class="header">
        <div class="user-info" id="userInfo">
            <div class="admin-clickable" id="adminClickable">
                <img src="/assets/user.png" alt="Admin" class="admin-img">
                <span class="admin-text">TataUsaha ▼</span>
            </div>
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

<div class="dashboard">
    <h1>Dashboard</h1>
    <div class="cards">

        <a href="/tatausaha/TU-DataBarang.php" class="card">
            <div class="card-content">
                <img src="/assets/box.png" alt="Data User">
                <h3>Data Barang</h3>
                <p>112.000</p>
            </div>
        </a>

        <a href="/tatausaha/TU-DataRequest.php" class="card">
            <div class="card-content">
                <img src="/assets/email.png" alt="Data Barang">
                <h3>Data Request</h3>
                <p>112.000</p>
            </div>
        </a>

        <a href="/tatausaha/TU-History.php" class="card">
            <div class="card-content">
                <img src="/assets/clock.png" alt="Data Peminjaman">
                <h3> Data History</h3>
                <p>112.000</p>
            </div>
        </a>
    </div>
</div>

<script>
// Fungsi untuk menampilkan modal konfirmasi logout
document.getElementById('adminClickable').addEventListener('click', function() {
    var result = confirm("Apakah Anda yakin ingin logout?");
    if (result) {
        // Jika pengguna menekan "OK"
        alert("Logout berhasil!");
        // Aksi logout bisa ditambahkan di sini, seperti redirect ke halaman login
        window.location.href = '/login.php';
    } else {
        // Jika pengguna menekan "Cancel"
        alert("Logout dibatalkan.");
    }
});
</script>

<?php include '../partials/footer.php'; ?>
