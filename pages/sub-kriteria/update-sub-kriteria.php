<?php

include '../../config/koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $kriteria_id = $_POST['kriteria_id'];
    $sub_kriteria = $_POST['sub_kriteria'];
    $sub_kriteria_lama = $_POST['sub_kriteria_lama'];
    $factor = $_POST['factor'];
    $keterangan = $_POST['keterangan'];

    if (empty($kriteria_id) || empty($sub_kriteria) || empty($factor)) {
        $response = array(
            'status' => 'error',
            'message' => 'Data tidak boleh ada yang kosong'
        );

        header('Content-Type: application/json');
        echo json_encode($response);
    } else {
        if ($sub_kriteria == $sub_kriteria_lama) {
            $sql = "UPDATE sub_kriteria SET kriteria_id = '$kriteria_id', sub_kriteria = '$sub_kriteria', faktor = '$factor', keterangan = '$keterangan' WHERE id = '$id'";

            $query = mysqli_query($konek, $sql);

            if ($query) {

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
                    'message' => 'Data sub kriteria berhasil diperbarui',
                    'kode' => $kodeBaru
                );

                header('Content-Type: application/json');
                echo json_encode($response);
            } else {
                $response = array(
                    'status' => 'error',
                    'message' => 'Data sub kriteria gagal diperbarui'
                );

                header('Content-Type: application/json');
                echo json_encode($response);
            }
        } else {
            $sql = "UPDATE sub_kriteria SET kriteria_id = '$kriteria_id', sub_kriteria = '$sub_kriteria', faktor = '$factor', keterangan = '$keterangan' WHERE id = '$id'";

            $query = mysqli_query($konek, $sql);

            if ($query) {

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
                    'message' => 'Data sub kriteria berhasil diperbarui',
                    'kode' => $kodeBaru
                );

                header('Content-Type: application/json');
                echo json_encode($response);
            } else {
                $response = array(
                    'status' => 'error',
                    'message' => 'Data sub kriteria gagal diperbarui'
                );

                header('Content-Type: application/json');
                echo json_encode($response);
            }
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