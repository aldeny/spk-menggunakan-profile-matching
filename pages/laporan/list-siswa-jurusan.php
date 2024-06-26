<?php

// Include file koneksi.php untuk menghubungkan ke database
include '../../config/koneksi.php';

// Query untuk mengambil data siswa
$sql = "SELECT pm.*, st.nis, st.nama_siswa, st.tahun_ajaran FROM `profile_matching` AS pm
JOIN students AS st ON pm.students_id = st.id
ORDER BY pm.id DESC;";
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
        if ($row['n_total_ipa'] > $row['n_total_ips']) {
            $jurusan = '<span class="badge badge-pill badge-success">IPA</span>';
        } else {
            $jurusan = '<span class="badge badge-pill badge-info">IPS</span>';
        }

        $data[] = array(
            'nis' => $row['nis'],
            'nama_siswa' => $row['nama_siswa'],
            'tahun_ajaran' => $row['tahun_ajaran'],
            'jurusan' => $jurusan,
            'n_total_ipa' => $row['n_total_ipa'],
            'n_total_ips' => $row['n_total_ips'],
            'aksi' => '<a href="javascript:void(0)" id="btn-detail" class="btn btn-sm btn-outline-info btn-sm mr-2" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Detail" data-id="' . $row['students_id'] . '"><i class="fas fa-eye"></i></a>' .
                '<a href="javascript:void(0)" id="btn-hapus" class="btn btn-sm btn-outline-danger btn-sm mr-2" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Hapus" data-id="' . $row['students_id'] . '"><i class="fas fa-trash"></i></a>'

        );
    }

    // Mengirimkan data dalam format JSON
    header('Content-Type: application/json');
    echo json_encode(array('data' => $data));
} else {
    // Jika tidak ada permintaan Ajax, tampilkan halaman dengan data siswa
    $students = array();
    while ($row = mysqli_fetch_assoc($query)) {
        $students[] = $row;
    }
    include 'laporan.php'; // Ganti dengan lokasi file halaman yang sesuai
}

// Menutup koneksi
mysqli_close($konek);
