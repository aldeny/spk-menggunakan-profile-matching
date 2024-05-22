<?php

include '../../config/koneksi.php';

$id = $_GET['id'];

$sql = "SELECT sk.*, k.nama_kriteria FROM sub_kriteria AS sk JOIN kriteria AS k ON sk.kriteria_id = k.id WHERE sk.id = '$id'";

$query = mysqli_query($konek, $sql);

$sub_kriteria = mysqli_fetch_array($query);

//kirim data sebagai json

echo json_encode($sub_kriteria);
?>