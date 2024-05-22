<?php

include '../../config/koneksi.php';

$id = $_GET['id'];

$sql = "SELECT * FROM nilai_gap WHERE id = '$id'";

$query = mysqli_query($konek, $sql);

$gap = mysqli_fetch_array($query);

//kirim data sebagai json

echo json_encode($gap);
?>