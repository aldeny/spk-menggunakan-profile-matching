<?php

include '../../config/koneksi.php';

$id = $_GET['id'];

$query1 = "DELETE FROM profile_matching WHERE students_id = '$id'";
$query2 = "DELETE FROM nilai_murni WHERE students_id = '$id'";
$query3 = "DELETE FROM scoring WHERE students_id = '$id'";

if ($konek->query($query1) === TRUE && $konek->query($query2) === TRUE && $konek->query($query3) === TRUE) {
    $response = array(
        'status' => 'success',
        'message' => 'Data target berhasil dihapus'
    );

    header('Content-Type: application/json');
    echo json_encode($response);
} else {
    $response = array(
        'status' => 'error',
        'message' => 'Data target gagal dihapus'
    );

    header('Content-Type: application/json');
    echo json_encode($response);
}

?>