<?php

include '../../config/koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $gap = $_POST['gap'];
    $bobot = $_POST['bobot'];

    if ($_POST['gap'] === '' || empty($_POST['bobot'])) {
        
        $response = array(
            'status' => 'error',
            'message' => 'Data tidak boleh ada yang kosong'
        );

        header('Content-Type: application/json');
        echo json_encode($response);

    } else {
        $sql = "UPDATE nilai_gap SET gap = '$gap', bobot = '$bobot' WHERE id = '$id'";

        if ($konek->query($sql) === TRUE) {

            $response = array(
                'status' => 'success',
                'message' => 'Data gap berhasil diperbarui'
            );

            header('Content-Type: application/json');
            echo json_encode($response);
        } else {
            
            $response = array(
                'status' => 'error',
                'message' => 'Data gap gagal diperbarui'
            );

            header('Content-Type: application/json');
            echo json_encode($response);
        }
    }
} else {
    $response = array(
        'status' => 'error',
        'message' => 'Permintaan tidak valid'
    );

    header('Content-Type: application/json');
    echo json_encode($response);
}
?>