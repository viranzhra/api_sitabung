<?php
function koneksi_database() {
    
    $host = "localhost"; 
    $username = "root"; 
    $password = ""; 
    $database = "proyek2_app"; 

    $koneksi = mysqli_connect($host, $username, $password, $database);

    // Cek koneksi
    if (!$koneksi) {
        die("Koneksi gagal: " . mysqli_connect_error());
    }

    return $koneksi;
}
?>
