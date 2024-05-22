<?php

include "../../config/koneksi.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

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
        $sql = "INSERT INTO nilai_gap (gap, bobot) VALUES ('$gap', '$bobot')";


        if ($konek->query($sql) === TRUE) {

            $response = array(
                'status' => 'success',
                'message' => 'Data gap berhasil ditambahkan'
            );

            header('Content-Type: application/json');
            echo json_encode($response);
        } else {
            
            $response = array(
                'status' => 'error',
                'message' => 'Data gap gagal ditambahkan'
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