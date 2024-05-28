<?php

include '../../config/koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Sanitasi input menggunakan prepared statements
    $fullName = $_POST['fullName'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $roleId = $_POST['roleId'];

    // Jika data yang dikirim kosong
    if (empty($fullName) || empty($username) || empty($password) || empty($roleId)) {
        $response = array(
            'status' => 'error',
            'message' => 'Data tidak boleh ada yang kosong'
        );
    } else {

        // Menggunakan prepared statements untuk keamanan
        $stmt = $konek->prepare("INSERT INTO user (name, username, password, role_id) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("sssi", $fullName, $username, $password, $roleId);

        if ($stmt->execute()) {
            $response = array(
                'status' => 'success',
                'message' => 'Data sub kriteria berhasil ditambahkan',
            );
        } else {
            $response = array(
                'status' => 'error',
                'message' => 'Data sub kriteria gagal ditambahkan'
            );
        }
        $stmt->close();
    }
    $konek->close();

    header('Content-Type: application/json');
    echo json_encode($response);
}
?>