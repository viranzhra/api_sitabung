<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include 'koneksi.php';

// Mendapatkan koneksi ke database
$koneksi = koneksi_database();

// Cek apakah data username dan password dikirimkan melalui metode POST
if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Melakukan query untuk memeriksa keberadaan username dan password dalam database
    $query = "SELECT * FROM murid WHERE nama_murid = '$username' AND password = '$password'";
    $result = mysqli_query($koneksi, $query);

    // Jika data ditemukan, berikan respon 'success', jika tidak, berikan respon 'error'
    if (mysqli_num_rows($result) == 1) {
        echo "success";
    } else {
        echo "error";
    }
} else {
    echo "error"; // Jika username atau password tidak dikirim
}

// Menutup koneksi database
mysqli_close($koneksi);
?>

