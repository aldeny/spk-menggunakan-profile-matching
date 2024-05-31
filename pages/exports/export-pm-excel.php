<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

    <title>Export Data Profile Matching</title>
</head>

<body>
    <div class="container d-flex justify-content-center align-items-center py-5">
        <div class="card shadow" style="width: 18rem;">
            <div class="card-header text-center bg-info text-white">
                <h4>Success!</h4>
            </div>
            <div class="card-body text-center">
                <p>Data berhasil di export</p>
                <a href="export-siswa.php" class="btn btn-sm bg-secondary w-100 text-white">Back</a>
            </div>
        </div>
    </div>


    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous">
    </script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script>
    -->
</body>

</html>

<?php
include '../../config/koneksi.php';
require '../../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

$sheet->setCellValue('A1', 'NO');
$sheet->setCellValue('B1', 'NIS');
$sheet->setCellValue('C1', 'NAMA SISWA');
$sheet->setCellValue('D1', 'JENIS KELAMIN');
$sheet->setCellValue('E1', 'KELAS');
$sheet->setCellValue('F1', 'TAHUN AJARAN');
$sheet->setCellValue('G1', 'NILAI IPA');
$sheet->setCellValue('H1', 'NILAI IPS');
$sheet->setCellValue('I1', 'JURUSAN');

$i = 2;
$no = 1;

if (isset($_GET['tahun'])) {
    $tahun = $_GET['tahun'];

    $datas = mysqli_query(
        $konek,
        "SELECT pm.n_total_ipa, pm.n_total_ips, st.* 
        FROM `profile_matching` as pm
        JOIN students as st ON pm.students_id = st.id 
        WHERE st.tahun_ajaran = '$tahun' ORDER BY st.id DESC"
    );

    while ($data = mysqli_fetch_assoc($datas)) {
        $sheet->setCellValue('A' . $i, $no++);
        $sheet->setCellValue('B' . $i, $data['nis']);
        $sheet->setCellValue('C' . $i, $data['nama_siswa']);
        $sheet->setCellValue('D' . $i, $data['jenis_kelamin']);
        $sheet->setCellValue('E' . $i, $data['kelas']);
        $sheet->setCellValue('F' . $i, $data['tahun_ajaran']);
        $sheet->setCellValue('G' . $i, $data['n_total_ipa']);
        $sheet->setCellValue('H' . $i, $data['n_total_ips']);
        if ($data['n_total_ipa'] > $data['n_total_ips']) {
            $sheet->setCellValue('I' . $i, 'IPA');
        } else {
            $sheet->setCellValue('I' . $i, 'IPS');
        }
        $i++;
    }

    $writer = new Xlsx($spreadsheet);
    $writer->save('Data Profile Matching.xlsx');
    echo "<script>window.location = 'Data Profile Matching.xlsx'</script>";
}

// $datas = mysqli_query(
//     $koneksi,
//     "SELECT tp.id, tp.kode_transaksi, tp.tanggal, u.nama, tp.keterangan, p.nama_obat, p.kode_obat, s.nama_satuan, tp.harga, tp.stock_in, tp.total_harga
//     FROM transaksi_pembelian AS tp 
//     INNER JOIN produk AS p ON tp.produk_id = p.id
//     INNER JOIN user AS u ON tp.user_id = u.id
//     INNER JOIN satuan AS s ON tp.satuan_id = s.id
//     INNER JOIN supplier AS sup ON tp.sup_id = sup.id
//     GROUP BY tp.kode_transaksi
//     ORDER BY tp.tanggal DESC"
// );

// while ($data = mysqli_fetch_assoc($datas)) {
//     $sheet->setCellValue('A' . $i, $no++);
//     $sheet->setCellValue('B' . $i, $data['kode_transaksi']);
//     $sheet->setCellValue('C' . $i, $data['user']);
//     $sheet->setCellValue('D' . $i, $data['kode_produk']);
//     $sheet->setCellValue('E' . $i, $data['nama_produk']);
//     $sheet->setCellValue('F' . $i, $data['satuan']);
//     $sheet->setCellValue('G' . $i, $data['harga']);
//     $sheet->setCellValue('H' . $i, $data['stock_in']);
//     $sheet->setCellValue('I' . $i, $data['total_harga']);
//     $sheet->setCellValue('J' . $i, $data['tanggal']);
//     $i++;
// }

// $writer = new Xlsx($spreadsheet);
// $writer->save('Data Pembelian Seluruh.xlsx');
// echo "<script>window.location = 'Data Pembelian Seluruh.xlsx'</script>";

?>