<?php 
session_start();
include '../partials/header.php';
include '../db/db.php';


// Cek apakah pengguna sudah login dan role-nya administrator
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'administrator') {
    header("Location: Login.php");
    exit();
}

?>

<div class="content">
    <div class="header">
        <div class="user-info" id="userInfo">
            <div class="admin-clickable" id="adminClickable">
                <img src="/assets/user.png" alt="Admin" class="admin-img">
                <span class="admin-text">admin ▼</span>
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

        <a href="/pages/DataUser.php" class="card">
            <div class="card-content">
                <img src="/assets/team.png" alt="Data User">
                <h3>Data User</h3>
                <p>112.000</p>
            </div>
        </a>

        <a href="/pages/DataBarang.php" class="card">
            <div class="card-content">
                <img src="/assets/box.png" alt="Data Barang">
                <h3>Data Barang</h3>
                <p>112.000</p>
            </div>
        </a>

        <a href="/pages/DataPeminjaman.php" class="card">
            <div class="card-content">
                <img src="/assets/signing.png" alt="Data Peminjaman">
                <h3>Data Peminjaman</h3>
                <p>112.000</p>
            </div>
        </a>
    </div>
</div>
<!-- Popup untuk Notifikasi -->
<div id="notificationModal" class="modal">
    <span class="close" onclick="document.getElementById('notificationModal').style.display='none'">&times;</span>
    <h2>Notifikasi</h2>
    <ul id="notificationList">
        <?php foreach ($notifications as $notification): ?>
            <li><?php echo $notification['message']; ?></li>
        <?php endforeach; ?>
    </ul>
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

 // Tampilkan modal notifikasi saat halaman di-load jika ada notifikasi baru
 window.onload = function() {
        <?php if (count($notifications) > 0): ?>
            document.getElementById('notificationModal').style.display = 'block';
        <?php endif; ?>
    };
</script>

<?php include '../partials/footer.php'; ?>
