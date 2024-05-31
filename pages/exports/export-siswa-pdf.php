<?php

// memanggil library FPDF
require('../../library/fpdf/fpdf.php');
include '../../config/koneksi.php';

// intance object dan memberikan pengaturan halaman PDF

$pdf = new FPDF('P', 'mm', 'LEGAL');
$pdf->AddPage();

$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(0, 10, 'DATA SISWA', 0, 1, 'C');
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
$pdf->Cell(35, 6, 'TAHUN AJARAN', 1, 1, 'C');

$pdf->SetFont('Arial', '', 10);
$no = 1;

if (isset($_GET['tahun'])) {
    $tahun = $_GET['tahun'];
    $sql = mysqli_query(
        $konek,
        "SELECT * FROM students WHERE tahun_ajaran = '$tahun' ORDER BY id DESC"
    );

    while ($d = mysqli_fetch_array($sql)) {
        $pdf->Cell(10, 6, $no++, 1, 0, 'C');
        $pdf->Cell(30, 6, $d['nis'], 1, 0, 'C');
        $pdf->Cell(65, 6, $d['nama_siswa'], 1, 0, 'C');
        $pdf->Cell(30, 6, $d['jenis_kelamin'], 1, 0, 'C');
        $pdf->Cell(20, 6, $d['kelas'], 1, 0, 'C');
        $pdf->Cell(35, 6, $d['tahun_ajaran'], 1, 1, 'C');
    }
}

$pdf->Output();
