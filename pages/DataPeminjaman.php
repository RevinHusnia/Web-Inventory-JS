<?php 
include '../partials/header.php';
include '../db/db.php';
include '../control/form_handler.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $itemCode = $_POST['itemCode'];
    $itemName = $_POST['itemName'];
    $itemQuantity = $_POST['itemQuantity'];
    
    // Handle image upload
    $itemPhoto = $_FILES['itemPhoto']['name'];
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["itemPhoto"]["name"]);

    // Move uploaded file to the server
    if (move_uploaded_file($_FILES["itemPhoto"]["tmp_name"], $target_file)) {
        echo "File uploaded successfully.";
    } else {
        echo "Error uploading file.";
    }

    // Insert data into 'barang' table
    $sql = "INSERT INTO barang (kode_barang, nama_barang, jumlah, foto_bukti) 
            VALUES ('$itemCode', '$itemName', '$itemQuantity', '$itemPhoto')";

    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
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
            <h1>Data Peminjaman</h1>
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
    include '../db/db.php';
    include '../control/form_handler.php'; // Pastikan ini benar dan relevan
    $sql = "SELECT kode_barang, nama_barang, jumlah, foto_bukti FROM datapeminjaman";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['kode_barang'] . "</td>";
            echo "<td>" . $row['nama_barang'] . "</td>";
            echo "<td>" . $row['jumlah'] . "</td>";
            echo "<td><img class='img-tr' src='../uploads/" . $row['foto_bukti'] . "' alt=''></td>";
            echo "<td><button class='btn-delete' onclick='deletePeminjaman(\"" . $row['kode_barang'] . "\")'>Delete</button></td>";
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
        <form action="../control/form_handler.php" method="POST" enctype="multipart/form-data">
            
        <label for="itemCode">Kode Barang:</label><br>
        <input type="text" id="itemCode" name="itemCode" class="input-request"><br><br>

        <label for="itemName">Nama Barang:</label><br>
        <input type="text" id="itemName" name="itemName" class="input-request"><br><br>

        <label for="itemQuantity">Jumlah:</label><br>
        <input type="number" id="itemQuantity" name="itemQuantity" class="input-request"><br><br>

        <label for="itemPhoto">Foto Barang:</label><br>
        <input type="file" id="itemPhoto" name="itemPhoto" class="input-request" accept="image/*"><br><br>

                    
            <button type="submit">Submit</button>
        </form>
    </div>
</div>
    </div>
</div>

<div id="imageModal" class="modal" style="display: none;">
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


    function deletePeminjaman(peminjamanId) {
        if (confirm('Apakah Anda yakin ingin menghapus data peminjaman ini?')) {
            window.location.href = '../control/delete_datapeminjaman.php?id=' + peminjamanId;
        }
    }


</script>

<?php include '../partials/footer.php'; ?>
