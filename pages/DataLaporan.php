<?php 
include '../partials/header.php'; 

?>
    
    <div class="form-overlay" id="formOverlay"></div>
    <div class="content">
        <div class="header">
            <div class="user-info" id="userInfo">
                <div class="admin-clickable">
                    <img src="/assets/user.png" alt="Admin" class="admin-img">
                    <span class="admin-text">admin ▼</span>
                </div>
            </div>

            <!-- Popup Konfirmasi Logout -->
            <div id="logoutModal" class="modal">
                <div class="modal-content">
                    <p>Apakah Anda ingin logout?</p>
                    <button id="confirmLogout" class="btn-confirm">Yes</button>
                    <button id="cancelLogout" class="btn-cancel">No</button>
                </div>
            </div>
        </div>

        <div class="data-barang">
            <div class="table-container">
                <h1>Data Laporan</h1>
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>Kode Barang</th>
                            <th>Nama Barang</th>
                            <th>Jumlah</th>
                         
                            <th>Foto Laporan/Temuan</th>
                            <th>Menu</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Barang 1</td>
                            <td>10</td>
                            
                            <td><img class="img-tr" src="/assets/box.png" alt=""></td>
                            <td><button class="btn-delete">Delete</button></td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Barang 2</td>
                            <td>15</td>
                            
                            <td><img class="img-tr" src="/assets/box.png" alt=""></td>
                            <td><button class="btn-delete">Delete</button></td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>Barang 3</td>
                            <td>20</td>
                           
                            <td><img class="img-tr" src="/assets/box.png" alt=""></td>
                            <td><button class="btn-delete">Delete</button></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="form-container">
                <h2>FORM</h2>
                <form>
                    <label for="kode-barang">Kode Barang:</label>
                    <input type="text" id="kode-barang" name="kode-barang">

                    <label for="nama-barang">Nama Barang:</label>
                    <input type="text" id="nama-barang" name="nama-barang">

                    <label for="jumlah">Jumlah:</label>
                    <input type="number" id="jumlah" name="jumlah">

                    <label for="harga">Harga:</label>
                    <input type="number" id="harga" name="harga">

                    <label for="foto-input">Foto Input:</label>
                    <input type="file" id="foto-input" name="foto-input">

                    <button type="submit">Tambah</button>
                </form>
            </div>
        </div>
    </div>
    <div id="imageModal" class="modal">
        <span class="close">&times;</span>
        <img class="modal-content" id="modalImage">
    </div>

    <?php include '../partials/footer.php'; ?>
