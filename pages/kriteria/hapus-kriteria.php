<?php

include '../../config/koneksi.php';

$id = $_POST['id'];

$sql = "DELETE FROM kriteria WHERE id = '$id'";

if ($konek->query($sql) === TRUE) {
    $response = array(
        'status' => 'success',
        'message' => 'Data kriteria berhasil dihapus'
    );

    header('Content-Type: application/json');
    echo json_encode($response);
} else {
    $response = array(
        'status' => 'error',
        'message' => 'Data kriteria gagal dihapus'
    );

    header('Content-Type: application/json');
    echo json_encode($response);
}

$konek->close();

?>