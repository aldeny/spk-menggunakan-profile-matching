<?php

include '../../config/koneksi.php';

$id = $_GET['id'];

$query = mysqli_query($konek, "SELECT * FROM nilai_murni WHERE students_id = '$id'");

$data = mysqli_fetch_array($query);

if ($data) {
    echo json_encode($data);
} else {
    echo json_encode(array('status' => 'error', 'message' => 'Data not found!'));
}

?>