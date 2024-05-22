<?php

include '../../config/koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $kriteria_id = $_POST['kriteria_id'];
    $sub_kriteria = $_POST['sub_kriteria'];
    $factor = $_POST['factor'];
    $kode = $_POST['kode'];
    $keterangan = $_POST['keterangan'];

    //jika yang di kirim kosong
    if (empty($kriteria_id) || empty($sub_kriteria) || empty($factor) || empty($kode)) {
        $response = array(
            'status' => 'error',
            'message' => 'Data tidak boleh ada yang kosong'
        );

        header('Content-Type: application/json');
        echo json_encode($response);
    } else {

        $sql = "INSERT INTO sub_kriteria (sub_kriteria, faktor, kode, kriteria_id, keterangan) VALUES ('$sub_kriteria', '$factor', '$kode', '$kriteria_id', '$keterangan')";

        if ($konek->query($sql) === TRUE) {

            //cek kode terakhir dari sub kriteria

            $sql = "SELECT MAX(kode) AS kodeTerbesar FROM sub_kriteria";
            $query = mysqli_query($konek, $sql);
            
            // Inisialisasi urutan dengan nilai awal
            $urutan = 1;

            if ($query) {
                $data = mysqli_fetch_array($query);
                $kodeTerbesar = $data['kodeTerbesar'];
                
                // Jika ada data, maka urutan diambil dari kode terbesar
                if ($kodeTerbesar) {
                    // Mengonversi huruf ke nilai angka dan menambahkan 1
                    $urutan = ord(substr($kodeTerbesar, 0, 1)) - 64;
                    $urutan++;
                }
            }
            
            // Mengonversi urutan ke huruf dan format yang diinginkan
            $kodeBaru = chr($urutan + 64);

            $response = array(
                'status' => 'success',
                'message' => 'Data sub kriteria berhasil ditambahkan',
                'kode' => $kodeBaru
            );
        } else {
            $response = array(
                'status' => 'error',
                'message' => 'Data sub kriteria gagal ditambahkan'
            );
        }

    }
    $konek->close();

    header('Content-Type: application/json');
    echo json_encode($response);
}


?>