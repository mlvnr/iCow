<?php
$koneksi = mysqli_connect("localhost", "root", "", "sistem_pakar_sapi");
if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>