<?php

include "../../config/koneksi.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $id = $_POST['id'];
    $fullName = $_POST['fullName'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $roleId = $_POST['roleId'];

    if (empty($fullName) || empty($username) || empty($password) || empty($roleId)) {
        $response = array(
            'status' => 'error',
            'message' => 'Data tidak boleh ada yang kosong'
        );

        header('Content-Type: application/json');
        echo json_encode($response);
    } else {
        
        $sql = "UPDATE user SET name = '$fullName', username = '$username', password = '$password', role_id = '$roleId' WHERE id = '$id'";

        if ($konek->query($sql) === TRUE) {
            $response = array(
                'status' => 'success',
                'message' => 'Data user berhasil diperbarui'
            );

            header('Content-Type: application/json');
            echo json_encode($response);
        } else {
            $response = array(
                'status' => 'error',
                'message' => 'Data user gagal diperbarui'
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