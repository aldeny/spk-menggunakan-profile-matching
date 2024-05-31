<?php

// memanggil library FPDF
require('../../library/fpdf/fpdf.php');
include '../../config/koneksi.php';

// intance object dan memberikan pengaturan halaman PDF

$pdf = new FPDF('L', 'mm', 'LEGAL');
$pdf->AddPage();

$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(0, 10, 'DATA PROFILE MATCHING', 0, 1, 'C');
$pdf->Cell(0, 5, '', 0, 1);

$pdf->Cell(35, 10, 'Tanggal Export', 0, 0,);
$pdf->Cell(3, 10, ':', 0, 0, 'C');
$pdf->Cell(30, 10, date('d-m-Y'), 0, 1,);

$pdf->Cell(35, 10, 'Tahun Ajaran', 0, 0,);
$pdf->Cell(3, 10, ':', 0, 0, 'C');
$pdf->Cell(30, 10, $_GET['tahun'], 0, 1,);


$pdf->Cell(0, 5, '', 0, 1);
$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(10, 6, 'NO', 1, 0, 'C');
$pdf->Cell(30, 6, 'NIS', 1, 0, 'C');
$pdf->Cell(65, 6, 'NAMA SISWA', 1, 0, 'C');
$pdf->Cell(30, 6, 'JENIS KELAMIN', 1, 0, 'C');
$pdf->Cell(20, 6, 'KELAS', 1, 0, 'C');
$pdf->Cell(35, 6, 'TAHUN AJARAN', 1, 0, 'C');
$pdf->Cell(35, 6, 'NILAI IPA', 1, 0, 'C');
$pdf->Cell(35, 6, 'NILAI IPS', 1, 0, 'C');
$pdf->Cell(35, 6, 'JURUSAN', 1, 1, 'C');

$pdf->SetFont('Arial', '', 10);
$no = 1;

if (isset($_GET['tahun'])) {
    $tahun = $_GET['tahun'];
    $sql = mysqli_query(
        $konek,
        "SELECT pm.n_total_ipa, pm.n_total_ips, st.* 
        FROM `profile_matching` as pm
        JOIN students as st ON pm.students_id = st.id 
        WHERE st.tahun_ajaran = '$tahun' ORDER BY st.id DESC"
    );

    while ($d = mysqli_fetch_array($sql)) {
        $pdf->Cell(10, 6, $no++, 1, 0, 'C');
        $pdf->Cell(30, 6, $d['nis'], 1, 0, 'C');
        $pdf->Cell(65, 6, $d['nama_siswa'], 1, 0, 'C');
        $pdf->Cell(30, 6, $d['jenis_kelamin'], 1, 0, 'C');
        $pdf->Cell(20, 6, $d['kelas'], 1, 0, 'C');
        $pdf->Cell(35, 6, $d['tahun_ajaran'], 1, 0, 'C');
        $pdf->Cell(35, 6, $d['n_total_ipa'], 1, 0, 'C');
        $pdf->Cell(35, 6, $d['n_total_ips'], 1, 0, 'C');
        if ($d['n_total_ipa'] > $d['n_total_ips']) {
            $pdf->Cell(35, 6, 'IPA', 1, 1, 'C');
        } else {
            $pdf->Cell(35, 6, 'IPS', 1, 1, 'C');
        }
    }
}

$pdf->Output();
