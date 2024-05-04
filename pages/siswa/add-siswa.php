<?php

include '../../config/koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nis = $_POST['nis'];
    $nama_siswa = $_POST['nama_siswa'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $kelas = $_POST['kelas'];
    $tahun_ajaran = $_POST['tahun_ajaran'];

    //jika yang di kirim kosong
    if (empty($nis) || empty($nama_siswa) || empty($jenis_kelamin) || empty($kelas) || empty($tahun_ajaran)) {
        $response = array(
            'status' => 'error',
            'message' => 'Data tidak boleh ada yang kosong'
        );

        header('Content-Type: application/json');
        echo json_encode($response);
    } else {

        $sql = "INSERT INTO students (nis, nama_siswa, jenis_kelamin, kelas, tahun_ajaran) VALUES ('$nis', '$nama_siswa', '$jenis_kelamin', '$kelas', '$tahun_ajaran')";

        if ($konek->query($sql) === TRUE) {
            $response = array(
                'status' => 'success',
                'message' => 'Data siswa berhasil ditambahkan'
            );
        } else {
            $response = array(
                'status' => 'error',
                'message' => 'Data siswa gagal ditambahkan'
            );
        }

    }
    $konek->close();

    header('Content-Type: application/json');
    echo json_encode($response);
}


?>