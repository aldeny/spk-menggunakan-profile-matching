<?php 

include '../../config/koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $id = $_POST['id'];
    $kriteria = $_POST['kriteria'];
    $keterangan = $_POST['keterangan'];
    $kriteriaLama = $_POST['kriteriaLama'];

    if (empty($kriteria) || empty($keterangan)) {
        $response = array(
            'status' => 'error',
            'message' => 'Data tidak boleh ada yang kosong'
        );

        header('Content-Type: application/json');
        echo json_encode($response);
    } else {
        if ($kriteria === $kriteriaLama) {

            $sql = "UPDATE kriteria SET nama_kriteria = '$kriteria', keterangan = '$keterangan' WHERE id = '$id'";
    
            if ($konek->query($sql) === TRUE) {
                $response = array(
                    'status' => 'success',
                    'message' => 'Data kriteria berhasil diubah'
                );
    
                header('Content-Type: application/json');
                echo json_encode($response);
            } else {
                $response = array(
                    'status' => 'error',
                    'message' => 'Data kriteria gagal diubah'
                );
    
                header('Content-Type: application/json');
                echo json_encode($response);
            }
        } else {
    
            $sql = "UPDATE kriteria SET nama_kriteria = '$kriteria', keterangan = '$keterangan' WHERE id = '$id'";
    
            if ($konek->query($sql) === TRUE) {
    
                $response = array(
                    'status' => 'success',
                    'message' => 'Data kriteria berhasil diubah'
                );
    
                header('Content-Type: application/json');
                echo json_encode($response);
            }
        }
    }

    

}

?>