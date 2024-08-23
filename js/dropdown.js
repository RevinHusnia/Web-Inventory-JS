// document.querySelector(".admin-clickable").addEventListener("click", function() {
//     document.getElementById("logoutModal").style.display = "block";
// });

// document.getElementById("cancelLogout").addEventListener("click", function() {
//     document.getElementById("logoutModal").style.display = "none";
// });

// document.getElementById("confirmLogout").addEventListener("click", function() {
//     // Logika untuk logout
//     window.location.href = "/logout.php"; // Misalnya, redirect ke halaman logout
// });
// Element-elemen
document.getElementById('cancelLogout').addEventListener('click', function() {
    document.getElementById('logoutModal').style.display = 'none';
    document.getElementById('formOverlay').style.display = 'none';
});

document.getElementById('userInfo').addEventListener('click', function() {
    document.getElementById('logoutModal').style.display = 'block';
    document.getElementById('formOverlay').style.display = 'block';
});

document.getElementById('confirmLogout').addEventListener('click', function() {
    // Proses logout di sini
    document.getElementById('logoutModal').style.display = 'none';
    document.getElementById('formOverlay').style.display = 'none';
});


// Menampilkan popup dan overlay saat tombol admin diklik
document.querySelector('.admin-clickable').addEventListener('click', function() {
    document.getElementById('logoutOverlay').style.display = 'block';
    document.getElementById('logoutModal').style.display = 'block';
});

// Menyembunyikan popup dan overlay saat tombol "No" diklik
document.getElementById('cancelLogout').addEventListener('click', function() {
    document.getElementById('logoutOverlay').style.display = 'none';
    document.getElementById('logoutModal').style.display = 'none';
});

// Anda bisa menambahkan fungsi logout pada tombol "Yes"
document.getElementById('confirmLogout').addEventListener('click', function() {
    // Fungsi logout di sini
});
