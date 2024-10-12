<?php 
include '../partials/header.php';
include '../control/process_form.php'; // Make sure the path is correct
include '../control/delete_user.php'; // Correct the path if necessary
include '../db/db.php';


$sql = "SELECT * FROM users";
$result = $conn->query($sql);

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
            <div class="table-container">
            <button class="btn-edit" onclick="showPopup()">Edit</button>
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
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['name']); ?></td>
                            <td><?php echo htmlspecialchars($row['phone_number']); ?></td>
                            <td><img class="img-tr" src="<?php echo $row['photo']; ?>" alt="User Photo" /></td>
                            <td><button class="btn-delete" onclick="deleteUser(<?php echo $row['id']; ?>)">Delete</button></td>

                            <script>
                            function deleteUser(userId) {
                                if (confirm('Are you sure you want to delete this user?')) {
                                    window.location.href = '../control/delete_user.php?id=' + userId;
                                }
                            }
                            </script>
                        
                    </tr>
                    
                    <?php endwhile; ?>
                </tbody>
            </table>

            <?php
            $conn->close();
            ?>


            </div>
            
            <div id="popupForm" class="popup">
    <div  class="popup-content">
        <span class="closee" onclick="closePopup()">&times;</span>
        <h2>Form Input</h2>


        <form action="../control/process_form.php" method="POST" enctype="multipart/form-data">
    <label for="itemCode">Nama:</label><br>
    <input type="text" id="itemCode" name="itemCode" class="input-request" required><br><br>

    <label for="itemName">Nomor Telp:</label><br>
    <input type="text" id="itemName" name="itemName" class="input-request" required><br><br>

    <label for="itemPhoto">Foto User:</label><br>
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
</script>

<?php include '../partials/footer.php'; ?>
