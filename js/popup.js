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

// Fungsi untuk menampilkan popup
function showPopup() {
    document.getElementById("popupForm").style.display = "block";
}

// Fungsi untuk menutup popup
function closePopup() {
    document.getElementById("popupForm").style.display = "none";
}
