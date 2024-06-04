<?php
// Koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "proyek2_app");

// Periksa koneksi
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

// Ambil ID user yang login
$user_id = $_SESSION['id'];

// Query untuk mengambil nama user
$query = "SELECT * FROM murid WHERE id = '$user_id'";
$result = mysqli_query($conn, $query);

// Periksa hasil query
if (!$result) {
    die("Query gagal: " . mysqli_error($conn));
}

// Ambil data dari hasil query
$data = array();
while ($row = mysqli_fetch_assoc($result)) {
    $data[] = $row;
}

// Tutup koneksi
mysqli_close($conn);

// Kembalikan data dalam bentuk JSON
echo json_encode($data);
?>