<?php

include '../../config/koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $id = $_POST['id'];
    $kelas = $_POST['kelas'];
    $kode = $_POST['kode'];
    $target = $_POST['nilai_target'];

    if (empty($kelas) || empty($kode) || empty($target)) {
        $response = array(
            'status' => 'error',
            'message' => 'Data tidak boleh ada yang kosong'
        );

        header('Content-Type: application/json');
        echo json_encode($response);
    } else {

        $sql = "UPDATE nilai_target SET kelas = '$kelas', nilai_target = '$target', sub_kriteria_id = '$kode' WHERE id = '$id'";

        $query = mysqli_query($konek, $sql);

        if ($query) {

            $response = array(
                'status' => 'success',
                'message' => 'Data target berhasil diperbarui'
            );

            header('Content-Type: application/json');
            echo json_encode($response);
        } else {

            $response = array(
                'status' => 'error',
                'message' => 'Data target gagal diperbarui'
            );

            header('Content-Type: application/json');
            echo json_encode($response);
        }
    }
} else {

    $response = array(
        'status' => 'error',
        'message' => 'Tidak ada request'
    );

    header('Content-Type: application/json');
    echo json_encode($response);
}

?>