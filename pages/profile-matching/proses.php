<?php

include '../../config/koneksi.php';

$scoring = "SELECT nilai_ppdb, nilai_ipa, nilai_ips, nilai_mtk, nilai_bindo, nilai_psikotes, nilai_minat_siswa, nilai_minat_ortu FROM scoring";
$target_ipa = "SELECT nilai_target FROM nilai_target WHERE kelas = 'IPA'";
$target_ips = "SELECT nilai_target FROM nilai_target WHERE kelas = 'IPS'";


$data_scoring = mysqli_query($konek, $scoring);
$data_target_ipa = mysqli_query($konek, $target_ipa);
$data_target_ips = mysqli_query($konek, $target_ips);

$hasil_scoring = array();
while ($data = mysqli_fetch_assoc($data_scoring)) {
    $hasil_scoring[] = $data;
}

$target_ipa = array();
while ($a = mysqli_fetch_assoc($data_target_ipa)) {
    $target_ipa[] = $a;
}

$target_ips = array();
while ($b = mysqli_fetch_assoc($data_target_ips)) {
    $target_ips[] = $b;
}

for ($i=0; $i < count($target_ipa) ; $i++) { 
    $data_nilai_target_ipa[] = $target_ipa[$i]['nilai_target'];
}

for ($i=0; $i < count($target_ips) ; $i++) {
    $data_nilai_target_ips[] = $target_ips[$i]['nilai_target'];
}

foreach ($hasil_scoring as $key => $value) {
    $data_nilai[] = $value['nilai_ppdb'];
    $data_nilai[] = $value['nilai_ipa'];
    $data_nilai[] = $value['nilai_ips'];
    $data_nilai[] = $value['nilai_mtk'];
    $data_nilai[] = $value['nilai_bindo'];
    $data_nilai[] = $value['nilai_psikotes'];
    $data_nilai[] = $value['nilai_minat_siswa'];
    $data_nilai[] = $value['nilai_minat_ortu'];
}


//melakukan pengurangan hasil scoring dengan target
// insert kedalam table sementara

for ($i=0; $i < count($data_nilai) ; $i++) {
    $data_normalisasi_ipa[$i] = $data_nilai[$i] - $data_nilai_target_ipa[$i];
}

for ($i=0; $i < count($data_nilai) ; $i++) {
    $data_normalisasi_ips[$i] = $data_nilai[$i] - $data_nilai_target_ips[$i];
}

$nilai_gap_ipa = array();
for ($i=0; $i <count($data_normalisasi_ipa) ; $i++) { 
    if ($data_normalisasi_ipa[$i] == 0) {
        $nilai_gap_ipa[] = 5;
    } elseif ($data_normalisasi_ipa[$i] == 1) {
        $nilai_gap_ipa[] = 4.5;
    } elseif ($data_normalisasi_ipa[$i] == -1) {
        $nilai_gap_ipa[] = 4;
    } elseif ($data_normalisasi_ipa[$i] == 2) {
        $nilai_gap_ipa[] = 3.5;
    } elseif ($data_normalisasi_ipa[$i] == -2) {
        $nilai_gap_ipa[] = 3;
    } elseif ($data_normalisasi_ipa[$i] == 3) {
        $nilai_gap_ipa[] = 2.5;
    } elseif ($data_normalisasi_ipa[$i] == -3) {
        $nilai_gap_ipa[] = 2;
    } elseif ($data_normalisasi_ipa[$i] == 4) {
        $nilai_gap_ipa[] = 1.5;
    } elseif ($data_normalisasi_ipa[$i] == -4) {
        $nilai_gap_ipa[] = 1;
    }
}

$nilai_gap_ips = array();
for ($i=0; $i <count($data_normalisasi_ips) ; $i++) {
    if ($data_normalisasi_ips[$i] == 0) {
        $nilai_gap_ips[] = 5;
    } elseif ($data_normalisasi_ips[$i] == 1) {
        $nilai_gap_ips[] = 4.5;
    } elseif ($data_normalisasi_ips[$i] == -1) {
        $nilai_gap_ips[] = 4;
    } elseif ($data_normalisasi_ips[$i] == 2) {
        $nilai_gap_ips[] = 3.5;
    } elseif ($data_normalisasi_ips[$i] == -2) {
        $nilai_gap_ips[] = 3;
    } elseif ($data_normalisasi_ips[$i] == 3) {
        $nilai_gap_ips[] = 2.5;
    } elseif ($data_normalisasi_ips[$i] == -3) {
        $nilai_gap_ips[] = 2;
    } elseif ($data_normalisasi_ips[$i] == 4) {
        $nilai_gap_ips[] = 1.5;
    } elseif ($data_normalisasi_ips[$i] == -4) {
        $nilai_gap_ips[] = 1;
    }
}

//inset nilai bobot gap kedalam table sementara
$kode = array();
$angka = 0;
for ($i=0; $i <count($data_nilai) ; $i++) { 
    $kode[$i] = "C".++$angka;

    //cek apakaha ada data didalam table nilai_bobot_gap
    $cek = "SELECT * FROM `nilai_bobot_gap`";

    $cek = $konek->query($cek);
    
    //jika ada data hapus dulu

    if ($cek->num_rows > 0) {

        $query = "DELETE FROM `nilai_bobot_gap`";
    } else {
        $query = "INSERT INTO nilai_bobot_gap (kode, bobot_ipa, bobot_ips, student_id) VALUES ('$kode[$i]', '$nilai_gap_ipa[$i]', '$nilai_gap_ips[$i]', '25')";
        $konek->query($query);
    }


}


//hitung ncf dan nsf ipa

$get_bobot = "SELECT bobot.*, sk.faktor, k.nama_kriteria FROM `nilai_bobot_gap` AS bobot
JOIN sub_kriteria AS sk ON bobot.kode = sk.kode
JOIN kriteria as k ON sk.kriteria_id = k.id
ORDER BY bobot.kode ASC";

$get_bobot = $konek->query($get_bobot);

while ($data = $get_bobot->fetch_assoc()) {
    $data_bobot[] = $data;
}

//cek data $kriteria[] dengan nilai yang sama
$total_bobot_akademik_ncf_ipa = 0;
$total_bobot_akademik_ncf_ips = 0;
$total_bobot_akademik_nsf_ipa = 0;
$total_bobot_akademik_nsf_ips = 0;
$total_bobot_non_akademik_ncf_ipa = 0;
$total_bobot_non_akademik_ncf_ips = 0;
$total_bobot_non_akademik_nsf_ipa = 0;
$total_bobot_non_akademik_nsf_ips = 0;
$jumlah_ncf_akademik = 0;
$jumlah_nsf_akademik = 0;
$jumlah_ncf_non_akademik = 0;
$jumlah_nsf_non_akademik = 0;

foreach ($data_bobot as $item) {
    if ($item['nama_kriteria'] == 'Akademik' && $item['faktor'] == 'NCF') {
        $jumlah_ncf_akademik++;
        $total_bobot_akademik_ncf_ipa += $item['bobot_ipa'];
        $total_bobot_akademik_ncf_ips += $item['bobot_ips'];
    } elseif ($item['nama_kriteria'] == 'Akademik' && $item['faktor'] == 'NSF') {
        $jumlah_nsf_akademik++;
        $total_bobot_akademik_nsf_ipa += $item['bobot_ipa'];
        $total_bobot_akademik_nsf_ips += $item['bobot_ips'];
    } elseif ($item['nama_kriteria'] == 'Non Akademik' && $item['faktor'] == 'NCF') {
        $jumlah_ncf_non_akademik++;
        $total_bobot_non_akademik_ncf_ipa += $item['bobot_ipa'];
        $total_bobot_non_akademik_ncf_ips += $item['bobot_ips'];
    } elseif ($item['nama_kriteria'] == 'Non Akademik' && $item['faktor'] == 'NSF') {
        $jumlah_nsf_non_akademik++;
        $total_bobot_non_akademik_nsf_ipa += $item['bobot_ipa'];
        $total_bobot_non_akademik_nsf_ips += $item['bobot_ips'];
    }
}

//hitung kriteria akademik untuk nilai ncf dan nsf ipa

$ncf_akademik_ipa = $total_bobot_akademik_ncf_ipa / $jumlah_ncf_akademik;
$ncf_akademik_ips = $total_bobot_akademik_ncf_ips / $jumlah_ncf_akademik;
$nsf_akademik_ipa = $total_bobot_akademik_nsf_ipa / $jumlah_nsf_akademik;
$nsf_akademik_ips = $total_bobot_akademik_nsf_ips / $jumlah_nsf_akademik;

$ncf_non_akademik_ipa = $total_bobot_non_akademik_ncf_ipa / $jumlah_ncf_non_akademik;
$ncf_non_akademik_ips = $total_bobot_non_akademik_ncf_ips / $jumlah_ncf_non_akademik;
$nsf_non_akademik_ipa = $total_bobot_non_akademik_nsf_ipa / $jumlah_nsf_non_akademik;
$nsf_non_akademik_ips = $total_bobot_non_akademik_nsf_ips / $jumlah_nsf_non_akademik;

$n1_ipa = ($ncf_akademik_ipa + $nsf_akademik_ipa)/2;
$n2_ipa = ($ncf_non_akademik_ipa + $nsf_non_akademik_ipa)/2;
$n1_ips = ($ncf_akademik_ips + $nsf_akademik_ips)/2;
$n2_ips = ($ncf_non_akademik_ips + $nsf_non_akademik_ips)/2;

$hasil_ipa = $n1_ipa + $n2_ipa;
$hasil_ips = $n1_ips + $n2_ips;

if ($hasil_ipa > $hasil_ips) {
    $jurusan = 'IPA';
} else {
    $jurusan = 'IPS';
}

echo json_encode(
    [
        'hasil_scoring' => $data_nilai,
        'data_nilai_target_ipa' => $data_nilai_target_ipa,
        'data_nilai_target_ips' => $data_nilai_target_ips,
        'data_normalisasi_ipa' => $data_normalisasi_ipa,
        'data_normalisasi_ips' => $data_normalisasi_ips,
        'nilai_gap_ipa' => $nilai_gap_ipa,
        'nilai_gap_ips' => $nilai_gap_ips,
        // 'data_bobot' => $data_bobot,
        // 'kriteria' => $kriteria,
        // 'faktor' => $faktor,
        // 'bobot' => $bobot,
        // 'bobot_ips' => $bobot_ips
        // 'total_ncf_ipa_akademik' => $total_ncf_ipa_akademik,
        // 'total_ncf_ips_akademik' => $total_ncf_ips_akademik,
        'ncf_akademik_ipa' => $ncf_akademik_ipa,
        'ncf_akademik_ips' => $ncf_akademik_ips,
        'nsf_akademik_ipa' => $nsf_akademik_ipa,
        'nsf_akademik_ips' => $nsf_akademik_ips,
        'n1_ipa' => $n1_ipa,
        'n1_ips' => $n1_ips,
        'n2_ipa' => $n2_ipa,
        'n2_ips' => $n2_ips,
        'hasil_ipa' => $hasil_ipa,
        'hasil_ips' =>$hasil_ips,
        'jurusan' => $jurusan
        // 'kode' => $kode,
        // 'total_ncf' => $total_ncf,
        // 'total_nsf' => $total_nsf,
        // 'total_bobot_akademik_ncf_ipa'=> $total_bobot_akademik_ncf_ipa,
        // 'total_bobot_akademik_nsf_ipa'=> $total_bobot_akademik_nsf_ipa,
        // 'total_bobot_akademik_ncf_ips'=> $total_bobot_akademik_ncf_ips,
        // 'total_bobot_akademik_nsf_ips'=> $total_bobot_akademik_nsf_ips,
        // 'total_bobot_non_akademik_ncf_ipa'=> $total_bobot_non_akademik_ncf_ipa,
        // 'total_bobot_non_akademik_nsf_ipa'=> $total_bobot_non_akademik_nsf_ipa,
        // 'total_bobot_non_akademik_ncf_ips'=> $total_bobot_non_akademik_ncf_ips,
        // 'total_bobot_non_akademik_nsf_ips'=> $total_bobot_non_akademik_nsf_ips,
        // 'jumlah_ncf_akademik' => $jumlah_ncf_akademik,
        // 'jumlah_nsf_akademik' => $jumlah_nsf_akademik,
        // 'jumlah_ncf_non_akademik' => $jumlah_ncf_non_akademik,
        // 'jumlah_nsf_non_akademik' => $jumlah_nsf_non_akademik,
    ]);
// echo json_encode($hasil);

?>

<!-- SELECT SUM(jumlah_NCF) AS total_jumlah_NCF, SUM(jumlah_NSF) AS total_jumlah_NSF
FROM (
    SELECT sk.*, 
           SUM(CASE WHEN faktor = 'NCF' THEN 1 ELSE 0 END) AS jumlah_NCF, 
           SUM(CASE WHEN faktor = 'NSF' THEN 1 ELSE 0 END) AS jumlah_NSF 
    FROM sub_kriteria AS sk 
    JOIN kriteria AS k ON sk.kriteria_id = k.id 
    WHERE kriteria_id = 1 
    GROUP BY sk.id
) AS subquery; -->