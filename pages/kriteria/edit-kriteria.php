<?php

include '../../config/koneksi.php';

//get data

$id = $_GET['id'];

$sql = "SELECT * FROM kriteria WHERE id = '$id'";

$query = mysqli_query($konek, $sql);

$kriteria = mysqli_fetch_array($query);

//kirim data sebagai json

echo json_encode($kriteria);

?>