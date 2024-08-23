<?php include '../partials/header.php' ?>

    <div class="content">
        <div class="header">
            <div class="user-info" id="userInfo">
                <div class="admin-clickable">
                    <img src="/assets/user.png" alt="Admin" class="admin-img">
                    <span class="admin-text">admin ▼</span>
                </div>
            </div>

            <!-- Popup Konfirmasi Logout -->
            <div id="logoutModal" class="centered-modal">
                <div class="modal-content">
                    <p>Apakah Anda ingin logout?</p>
                    <button id="confirmLogout" class="btn-confirm">Yes</button>
                    <button id="cancelLogout" class="btn-cancel">No</button>
                </div>
            </div>
            <div id="logoutOverlay" class="centered-modal-overlay"></div>
        </div>
    </div>

    <div class="dashboard">
        <h1>Dashboard</h1>
        <div class="cards">

            <a href="/pages/DataUser.html" class="card">
                <div class="card-content">
                    <img src="/assets/team.png" alt="Data User">
                    <h3>Data User</h3>
                    <p>112.000</p>
                </div>
            </a>
            
            <a href="/pages/DataBarang.html" class="card">
                <div class="card-content">
                    <img src="/assets/box.png" alt="Data Barang">
                    <h3>Data Barang</h3>
                    <p>112.000</p>
                </div>
            </a>

            <a href="/pages/DataPeminjaman.html" class="card">
                <div class="card-content">
                    <img src="/assets/signing.png" alt="Data Peminjaman">
                    <h3>Data Peminjaman</h3>
                    <p>112.000</p>
                </div>
            </a>
        </div>
    </div>

<?php include '../partials/footer.php';  ?>
