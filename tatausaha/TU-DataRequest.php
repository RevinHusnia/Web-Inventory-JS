<?php 

include '../partials/TU-header.php';
include '../db/db.php';
include '../tatausahaControl/delete_request.php';
include '../tatausahaControl/submit_request.php';



// Mengambil hanya permintaan yang berstatus pending dari tabel requests
$query = "SELECT * FROM requests WHERE status = 'pending'";
$result = $conn->query($query);

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
            <h1>Data Request</h1>
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Kode Barang</th>
                        <th>Nama Barang</th>
                        <th>Jumlah</th>
                        <th>Ukuran</th>
                        <th>Nama Pemesan</th>
                        <th>Tanggal</th>
                        <th>Nama Pengirim</th>
                        <th>Foto Barang</th>
                        <th>Menu</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Only show pending requests for tatausaha
                    $query = "SELECT * FROM requests WHERE status = 'pending'";
                    $result = $conn->query($query);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row['kode_barang'] . "</td>";
                            echo "<td>" . $row['nama_barang'] . "</td>";
                            echo "<td>" . $row['jumlah'] . "</td>";
                            echo "<td>" . $row['ukuran'] . "</td>";
                            echo "<td>" . $row['nama_pemesan'] . "</td>";
                            echo "<td>" . $row['tanggal'] . "</td>";
                            echo "<td>" . $row['nama_pengirim'] . "</td>";
                            $file_path = '../uploads/' . basename($row['foto_barang']);
                            if (!file_exists($file_path)) {
                                echo '<td>File not found!</td>';
                            } else {
                                echo '<td><img class="img-tr" src="' . $file_path . '" alt="Foto Barang" style="width:50px;height:50px;"></td>';
                            }

                            // Tatausaha can delete requests, but not approve or reject
                            echo '<td><button class="btn-delete" onclick="deleteRequest(' . $row['id'] . ')">Delete</button></td>';
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='9'>No pending requests</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <!-- Popup Form -->
        <div id="popupForm" class="popup">
            <div class="popup-content">
                <span class="closee" onclick="closePopup()">&times;</span>
                <h2>Form Input</h2>
                <form action="../tatausahaControl/submit_request.php" method="POST" enctype="multipart/form-data">
                    <label for="name">Seragam:</label><br>
                    <input type="text" id="name" name="name" class="input-request"><br><br>

                    <label for="itemType">Kode Barang:</label><br>
                    <input type="text" id="itemType" name="kode_barang" class="input-request"><br><br>

                    <label for="itemWeight">Ukuran:</label><br>
                    <input type="text" id="itemWeight" name="ukuran" class="input-request"><br><br>

                    <label for="location">Nama Pemesan:</label><br>
                    <input type="text" id="location" name="nama_pemesan" class="input-request"><br><br>

                    <label for="date">Tanggal:</label><br>
                    <input type="date" id="date" name="tanggal" class="input-request"><br><br>

                    <label for="sender">Nama Pengirim:</label><br>
                    <input type="text" id="sender" name="nama_pengirim" class="input-request"><br><br>

                    <label for="foto">Foto:</label><br>
                    <input type="file" id="foto" name="foto_barang" class="input-request"><br><br>

                    <label for="jumlah">Jumlah:</label><br>
                    <input type="number" id="jumlah" name="jumlah" class="input-request"><br><br>

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
            window.location.href = '/login.php';
        } else {
            // Jika pengguna menekan "Cancel"
            alert("Logout dibatalkan.");
        }
    });

    // Menutup modal gambar saat diklik
    document.getElementsByClassName("close")[0].onclick = function() {
        document.getElementById("imageModal").style.display = "none";
    }

    // Fungsi untuk menampilkan popup
    function showPopup() {
        document.getElementById("popupForm").style.display = "block";
    }

    // Fungsi untuk menutup popup
    function closePopup() {
        document.getElementById("popupForm").style.display = "none";
    }

    // Fungsi untuk menghapus permintaan
    function deleteRequest(id) {
        var confirmation = confirm("Apakah Anda yakin ingin menghapus permintaan ini?");
        if (confirmation) {
            window.location.href = "../tatausahaControl/delete_request.php?id=" + id;
        }
    }

    function updateNotificationCount() {
    const xhr = new XMLHttpRequest();
    xhr.open('GET', '/pages/get_notification_count.php', true);
    xhr.onload = function() {
        if (xhr.status === 200) {
            document.querySelector('.badge').textContent = xhr.responseText;
        }
    };
    xhr.send();
}

// Call the function every 30 seconds
setInterval(updateNotificationCount, 30000);

function confirmAction(action, id) {
    var actionText = action === 'confirm' ? 'approve' : 'reject';
    if (confirm("Apakah Anda yakin ingin " + actionText + " request ini?")) {
        fetch('../tatausahaControl/confirm_request.php?id=' + id + '&action=' + action)
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    alert("Request " + actionText + " berhasil.");

                    // Memperbarui jumlah notifikasi
                    document.querySelector('.badge').textContent = data.pendingRequests;

                    location.reload(); // Reload halaman jika diperlukan
                } else {
                    alert("Gagal mengirim action " + actionText + ".");
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
    }
}


</script>

<?php include '../partials/footer.php'; ?>
