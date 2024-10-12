<?php
// Connect to the database
include '../db/db.php';

// Check if size filter is set via GET parameter
$ukuran = isset($_GET['ukuran']) ? $_GET['ukuran'] : '';

// Handle size filtering
if ($ukuran == 'Custom') {
    // Fetch all items where the size is not "S", "M", "L", or "XL"
    $stmt = $conn->prepare("
        SELECT b.kode_barang, b.nama_barang, bu.ukuran, bu.jumlah_tersedia, b.harga_barang, b.foto 
        FROM barang b
        JOIN barang_ukuran bu ON b.kode_barang = bu.kode_barang
        WHERE bu.ukuran NOT IN ('S', 'M', 'L', 'XL')
    ");
} elseif (!empty($ukuran)) {
    // Fetch items where size matches the selected size
    $stmt = $conn->prepare("
        SELECT b.kode_barang, b.nama_barang, bu.ukuran, bu.jumlah_tersedia, b.harga_barang, b.foto 
        FROM barang b
        JOIN barang_ukuran bu ON b.kode_barang = bu.kode_barang
        WHERE bu.ukuran = ?
    ");
    $stmt->bind_param("s", $ukuran);
} else {
    // Show all items if no size is selected
    $stmt = $conn->prepare("
        SELECT b.kode_barang, b.nama_barang, bu.ukuran, bu.jumlah_tersedia, b.harga_barang, b.foto 
        FROM barang b
        JOIN barang_ukuran bu ON b.kode_barang = bu.kode_barang
    ");
}

// Execute the query
$stmt->execute();
$result = $stmt->get_result();

// Output the filtered results as table rows
while($row = $result->fetch_assoc()): ?>
    <tr>
        <td><?php echo $row['kode_barang']; ?></td>
        <td><?php echo $row['nama_barang']; ?></td>
        <td><?php echo $row['ukuran']; ?></td>  
        <td><?php echo $row['jumlah_tersedia']; ?></td>
        <td><?php echo $row['harga_barang']; ?></td> <!-- Tampilkan harga barang -->
        <td><img class="img-tr" src="../uploads/<?php echo $row['foto']; ?>" alt=""></td>
        <td><button class="btn-delete" onclick="deleteItem('<?php echo $row['kode_barang']; ?>', '<?php echo $row['ukuran']; ?>')">Delete</button></td>
    </tr>
<?php endwhile; ?>

<?php
// Close the statement and connection
$stmt->close();
$conn->close();
