<?php
session_start();
include 'db/db.php';  // Pastikan path sudah sesuai dengan lokasi file db.php

// Cek apakah form telah dikirimkan dengan metode POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Ambil data dari form login
    $username = $_POST['username'] ?? '';  // Gunakan null coalescing untuk menghindari error
    $password = $_POST['password'] ?? '';

    // Pastikan username dan password tidak kosong
    if (!empty($username) && !empty($password)) {
        // Query untuk mencari user berdasarkan username dan password (password di-hash menggunakan SHA2)
        $sql = "SELECT * FROM roleuser WHERE username = ? AND password = SHA2(?, 256)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $username, $password);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            
            // Simpan role pengguna dalam session
            $_SESSION['role'] = $row['role'];
            $_SESSION['username'] = $row['username'];

            // Redirect pengguna sesuai dengan role
            if ($row['role'] === 'administrator') {
                header("Location: /pages/dashboard.php");  // Redirect ke halaman admin
            } elseif ($row['role'] === 'tatausaha') {
                header("Location: tatausaha/TU-dashboard.php");  // Redirect ke halaman Tata Usaha
            }
            exit();
        } else {
            // Jika login gagal, arahkan kembali ke halaman login dengan pesan error
            header("Location: Login.php?error=true");
            exit();
        }
    } else {
        // Jika username atau password kosong, arahkan kembali ke halaman login dengan pesan error
        header("Location: Login.php?error=true");
        exit();
    }
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="css/login.css">
</head>
<body>
    <div class="login-container">
        <div class="login-box">
            <h1>ADMINISTRATOR</h1>
            <p>Only ADMINISTRATOR</p>
            <form action="login.php" method="POST">
                <input type="text" name="username" placeholder="Username" required>
                <input type="password" name="password" placeholder="Password" required>
                <button type="submit">SIGN IN</button>
            </form> 
        </div>

        <!-- Tampilkan pesan error jika login gagal -->
        <?php if (isset($_GET['error']) && $_GET['error'] === 'true'): ?>
            <div class="popup error">
                <p>Invalid Username or Password</p>
            </div>
        <?php endif; ?>

    </div>
</body>
</html>
