<?php

include '../../config/koneksi.php';

    $kriteria = $_POST['kriteria'];
    $keterangan = $_POST['keterangan'];

    if (empty($kriteria) || empty($keterangan)) {
        $response = array(
            'status' => 'error',
            'message' => 'Data tidak boleh ada yang kosong'
        );

        header('Content-Type: application/json');
        echo json_encode($response);
    } else {

        //cek apakah kriteria sudah ada

        $sql = "SELECT * FROM kriteria WHERE nama_kriteria = '$kriteria'";

        $query = mysqli_query($konek, $sql);

        if (mysqli_num_rows($query) > 0) {

            $response = array(
                'status' => 'error',
                'message' => 'Data kriteria sudah ada'
            );

            header('Content-Type: application/json');
            echo json_encode($response);
        } else {

            $sql = "INSERT INTO kriteria (nama_kriteria, keterangan) VALUES ('$kriteria', '$keterangan')";

            if ($konek->query($sql) === TRUE) {

                $response = array(
                    'status' => 'success',
                    'message' => 'Data kriteria berhasil ditambahkan'
                );

                header('Content-Type: application/json');
                echo json_encode($response);
            }
        }
    }

// $konek->close();

?>