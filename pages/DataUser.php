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
                <h1>Data User</h1>
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Nomor Telp</th>
                          
                            <th>Foto User</th>
                            <th>Menu</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Albar</td>
                            <td>12345678910111213</td>
                            
      
                            <td><img class="img-tr" src="/assets/user.png" alt=""></td>
                            <td><button class="btn-delete">Delete</button></td>
                        </tr>
                        <tr>
                            <td>Danar</td>
                            <td>12345678910111213</td>
                           
                            
                            <td><img class="img-tr" src="/assets/user.png" alt=""></td>
                            <td><button class="btn-delete">Delete</button></td>
                        </tr>
                        <tr>
                            <td>psy</td>
                            <td>12345678910111213</td>
                            
                           
                            <td><img class="img-tr" src="/assets/user.png" alt=""></td>
                            <td><button class="btn-delete">Delete</button></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="form-container">
                <h2>FORM USER</h2>
                <form>
                    <label for="kode-barang">Nama User:</label>
                    <input type="text" id="kode-barang" name="kode-barang">

                    <label for="nama-barang">Nomor Telephone:</label>
                    <input type="text" id="nama-barang" name="nama-barang">

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

    <?php include '../partials/footer.php' ?>