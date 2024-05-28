<?php

include "../../config/koneksi.php";

$id = $_GET['id'];

$sql = "SELECT * FROM user WHERE id = '$id'";

$query = mysqli_query($konek, $sql);

$data = mysqli_fetch_array($query);

echo json_encode($data);

?>