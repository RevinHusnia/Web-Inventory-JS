<!-- partials/head.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fadilah Inventory</title>
    <link rel="stylesheet" href="/css/styles.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Immediately apply theme from localStorage
        if (localStorage.getItem('theme') === 'dark') {
            document.documentElement.classList.add('dark-mode');
        }
    </script>
</head>
<body>
<div class="sidebar">
        <div class="sidebar-header">
            <h2>Fadilah Inventory</h2>
            <div class="toggle-theme">
                <input type="checkbox" id="theme-switch" />
                <label for="theme-switch" class="theme-label">
                    <img src="/assets/sun.png" alt="Light Mode" class="light-icon">
                    <img src="/assets/half-moon.png" alt="Dark Mode" class="dark-icon">
                </label>
            </div>
        </div>
        <ul class="nav">
            <li><a href="/pages/dashboard.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'dashboard.php' ? 'active' : ''; ?>"><img src="/assets/dashboard.png" alt="Dashboard Icon"> Dashboard</a></li>
            <li><span>Component</span></li>
            <li><a href="/pages/DataUser.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'DataUser.php' ? 'active' : ''; ?>"><img src="/assets/team.png" alt="Data User Icon"> Data User</a></li>
            <li><a href="/pages/DataBarang.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'DataBarang.php' ? 'active' : ''; ?>"><img src="/assets/box.png" alt="Data Barang Icon"> Data Barang</a></li>
            <li><a href="/pages/DataPeminjaman.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'DataPeminjaman.php' ? 'active' : ''; ?>"><img src="/assets/signing.png" alt="Data Peminjaman Icon"> Data Peminjaman</a></li>
            <li><a href="/pages/DataLaporan.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'DataLaporan.php' ? 'active' : ''; ?>"><img src="/assets/document.png" alt="Data Laporan Icon"> Data Laporan</a></li>
            <li><a href="/Login.html"><img src="/assets/logout.png" alt="Logout Icon"> Logout</a></li>
        </ul>
    </div>