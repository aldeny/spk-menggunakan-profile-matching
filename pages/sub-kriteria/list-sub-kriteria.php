<?php

// Include file koneksi.php untuk menghubungkan ke database
include '../../config/koneksi.php';

// Query untuk mengambil data siswa
$sql = "SELECT sub.*, k.nama_kriteria FROM sub_kriteria as sub
JOIN kriteria as k on sub.kriteria_id = k.id ORDER BY id DESC";
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
            'nama_kriteria' => $row['nama_kriteria'],
            'sub_kriteria' => $row['sub_kriteria'],
            'faktor' => $row['faktor'],
            'kode' => $row['kode'],
            'keterangan' => $row['keterangan'],
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
    $students = array();
    while ($row = mysqli_fetch_assoc($query)) {
        $students[] = $row;
    }
    include 'kriteria.php'; // Ganti dengan lokasi file halaman yang sesuai
}

// Menutup koneksi
mysqli_close($konek);

?>