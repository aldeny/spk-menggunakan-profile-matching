<?php 

include '../../config/koneksi.php';

$id = $_GET['id'];

$sql = "DELETE FROM sub_kriteria WHERE id = '$id'";

if ($konek->query($sql) === TRUE) {

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
        'message' => 'Data sub kriteria berhasil di hapus',
        'kode' => $kodeBaru
    );

    echo json_encode($response);

} else {

    $response = array(
        'status' => 'error',
        'message' => 'Data sub kriteria gagal di hapus'
    );

    echo json_encode($response);
}

?>