<?php

include '../../config/koneksi.php';

$id = $_POST['id'];

$sql = "DELETE FROM nilai_target WHERE id = '$id'";

if ($konek->query($sql) === TRUE) {
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

$konek->close();

?>