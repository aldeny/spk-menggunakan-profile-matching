<?php 

include '../../config/koneksi.php';

$id = $_GET['id'];

$sql = "DELETE FROM nilai_gap WHERE id = '$id'";

if ($konek->query($sql) === TRUE) {

    $response = array(
        'status' => 'success',
        'message' => 'Data nilai gap berhasil di hapus',
    );

    echo json_encode($response);

} else {

    $response = array(
        'status' => 'error',
        'message' => 'Data nilai gapgagal di hapus'
    );

    echo json_encode($response);
}

?>