<?php

include '../../config/koneksi.php';

$id = $_GET['id'];

$sql = "DELETE FROM user WHERE id = $id";

// kembalikan respon dalam beluk json

if (mysqli_query($konek, $sql)) {
    echo json_encode(array('success' => true));
} else {
    echo json_encode(array('success' => false));
}

?>