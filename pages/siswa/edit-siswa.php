<?php

include '../../config/koneksi.php';

$id = $_GET['id'];

$sql = "SELECT * FROM students WHERE id = '$id'";

$query = mysqli_query($konek, $sql);

$siswa = mysqli_fetch_array($query);

//kirim data sebagai json

echo json_encode($siswa);
?>