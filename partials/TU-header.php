<!-- partials/head.php -->
<?php
// Include your database connection
include '../db/db.php';

// Query to count the number of pending requests
$sql = "SELECT COUNT(*) AS count FROM requests WHERE status = 'pending'";
$result = $conn->query($sql);

// Fetch the result
$pendingRequests = 0; // Default value
if ($result && $row = $result->fetch_assoc()) {
    $pendingRequests = $row['count'];
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fadilah Inventory</title>
    <link rel="stylesheet" href="/css/tatausaha.css">
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
        <li><a href="/tatausaha/TU-dashboard.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'TU-dashboard.php' ? 'active' : ''; ?>"><img src="/assets/dashboard.png" alt="Dashboard Icon"> Dashboard</a></li>
        <li><span>Component</span></li>
        <li><a href="/tatausaha/TU-DataBarang.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'TU-DataBarang.php' ? 'active' : ''; ?>"><img src="/assets/box.png" alt="Data Barang Icon"> Data Barang</a></li>
        <li>
            <a href="/tatausaha/TU-DataRequest.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'TU-DataRequest.php' ? 'active' : ''; ?>">
                <img src="/assets/email.png" alt="Request Icon"> Request
                <?php if ($pendingRequests > 0): ?>
                    <span class="badge"><?php echo $pendingRequests; ?></span>
                <?php endif; ?>
            </a>
        </li>
        <li><a href="/tatausaha/TU-DataLaporan.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'TU-DataLaporan.php' ? 'active' : ''; ?>"><img src="/assets/document.png" alt="Data Laporan Icon"> Data Laporan</a></li>
        <li><a href="/tatausaha/TU-History.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'TU-History.php' ? 'active' : ''; ?>"><img src="/assets/clock.png" alt="History Icon"> History</a></li>
    </ul>
</div>

<style>
    /* CSS untuk badge notifikasi */
    .badge {
        background-color: red;
        color: white;
        padding: 3px 10px;
        border-radius: 50%;
        font-size: 12px;
        position: absolute;
        top: 33%; /* Sesuaikan posisi vertikal */
        right: 20px; /* Sesuaikan posisi horizontal */
        transform: translate(-50%, -50%); /* Agar badge terpusat */
    }
</style>
