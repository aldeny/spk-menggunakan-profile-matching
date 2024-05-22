<?php

// Include file koneksi.php untuk menghubungkan ke database
include '../../config/koneksi.php';

// Query untuk mengambil data siswa
$sql = "SELECT * FROM nilai_gap ORDER BY id DESC";

$query = mysqli_query($konek, $sql);

// Memeriksa jika query berhasil dieksekusi
if (!$query) {
    die("Gagal menjalankan query: " . mysqli_error($konek));
}

// Memeriksa apakah ada permintaan Ajax
if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest') {
    $data = array();
    while ($row = mysqli_fetch_assoc($query)) {
        // Memformat data sesuai kebutuhan Anda
        $data[] = array(
            'gap' => $row['gap'],
            'bobot' => $row['bobot'],
            'aksi' => '<a href="javascript:void(0)" id="btn-edit" class="btn btn-sm btn-outline-info btn-sm mr-2" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Edit" data-id="' . $row['id'] . '"><i class="fas fa-edit"></i></a>'.
            '<a href="javascript:void(0)" id="btn-hapus" class="btn btn-sm btn-outline-danger btn-sm mr-2" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Hapus" data-id="' . $row['id'] . '"><i class="fas fa-trash"></i></a>'
        );
    }

    // Mengirimkan data dalam format JSON
    header('Content-Type: application/json');
    echo json_encode(array('data' => $data));
}
else {
    // Jika tidak ada permintaan Ajax, tampilkan halaman dengan data siswa
    $target = array();
    while ($row = mysqli_fetch_assoc($query)) {
        $target[] = $row;
    }
    include 'gap.php'; // Ganti dengan lokasi file halaman yang sesuai
}

// Menutup koneksi
mysqli_close($konek);

?>