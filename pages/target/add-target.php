<?php

include '../../config/koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $kelas = $_POST['kelas'];
    $kode = $_POST['kode'];
    $nilai_target = $_POST['nilai_target'];

    if (empty($kelas) || empty($kode) || empty($nilai_target)) {
        $response = array(
            'status' => 'error',
            'message' => 'Data tidak boleh ada yang kosong'
        );

        header('Content-Type: application/json');
        echo json_encode($response);
    } else {

        $sql = "INSERT INTO nilai_target (kelas, sub_kriteria_id, nilai_target) VALUES ('$kelas', '$kode', '$nilai_target')";

        if ($konek->query($sql) === TRUE) {

            $response = array(
                'status' => 'success',
                'message' => 'Data target berhasil ditambahkan'
            );

            header('Content-Type: application/json');
            echo json_encode($response);
        } else {

            $response = array(
                'status' => 'error',
                'message' => 'Data target gagal ditambahkan'
            );
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