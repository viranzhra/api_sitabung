<?php
header('Content-Type: application/json');

include 'koneksi.php';

$koneksi = koneksi_database();
$input = json_decode(file_get_contents('php://input'), true);

$username = $input['username'];
$password = $input['password'];

// Mengambil nama siswa dan saldo mereka
$query = "
    SELECT m.nama_murid, IFNULL(SUM(a.saldo), 0) as total
    FROM murid m
    LEFT JOIN arsip_tabungan_bulanan a ON m.id = a.id_murid
    WHERE m.username = ? AND m.password = ?
    GROUP BY m.id
";
$stmt = mysqli_prepare($koneksi, $query);
mysqli_stmt_bind_param($stmt, 'ss', $username, $password);
mysqli_stmt_execute($stmt);
mysqli_stmt_bind_result($stmt, $nama, $total);
mysqli_stmt_fetch($stmt);

if ($nama && isset($total)) {
    echo json_encode(['nama' => $nama, 'total' => $total]);
} else {
    http_response_code(404);
    echo json_encode(['error' => 'Pengguna tidak ditemukan atau kredensial salah']);
}

mysqli_stmt_close($stmt);
mysqli_close($koneksi);
?>
