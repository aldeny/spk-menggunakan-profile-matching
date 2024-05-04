<?php

// Pastikan file koneksi.php sudah di-include
include '../../config/koneksi.php';

// Periksa apakah ada data yang dikirimkan melalui metode POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data yang dikirimkan melalui AJAX
    $id = $_POST['id'];
    $nis = $_POST['nis'];
    $nama_siswa = $_POST['nama_siswa'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $kelas = $_POST['kelas'];
    $tahun_ajaran = $_POST['tahun_ajaran'];

    // Lakukan pembaruan data siswa dalam database
    $sql = "UPDATE students SET nama_siswa = '$nama_siswa', jenis_kelamin = '$jenis_kelamin', kelas = '$kelas', tahun_ajaran = '$tahun_ajaran', nis = '$nis' WHERE id = '$id'";
    
    // Jalankan kueri SQL
    $query = mysqli_query($konek, $sql);

    // Periksa apakah kueri berhasil dijalankan
    if ($query) {
        // Jika berhasil, kirim respons JSON yang menunjukkan sukses
        $response = array('success' => true);
    } else {
        // Jika gagal, kirim respons JSON yang menunjukkan kegagalan
        $response = array('success' => false);
    }

    // Kirim respons dalam format JSON
    header('Content-Type: application/json');
    echo json_encode($response);
} else {
    // Jika metode yang digunakan bukan POST, kembalikan respons kosong
    http_response_code(405); // Method Not Allowed
    exit();
}

?>