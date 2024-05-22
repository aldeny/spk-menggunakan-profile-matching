<?php

    include '../../config/koneksi.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $id_siswa = $_POST['id_siswa'];
        $ppdb = $_POST['ppdb'];
        $ipa = $_POST['ipa'];
        $ips = $_POST['ips'];
        $mtk = $_POST['mtk'];
        $bindo = $_POST['bindo'];
        $psikotes = $_POST['psikotes'];
        $minat = $_POST['minat'];
        $minat_ortu = $_POST['minat_ortu'];

        if (empty($id_siswa) || empty($ppdb) || empty($ipa) || empty($ips) || empty($mtk) || empty($bindo) || empty($psikotes) || empty($minat) || empty($minat_ortu)) {
            $response = array(
                'status' => 'error',
                'message' => 'Data tidak boleh ada yang kosong'
            );
    
            header('Content-Type: application/json');
            echo json_encode($response);
        } else {

            //lakuakan pengecekan jika id siswa sudah ada maka tidak bisa menambah data lagi
            $cek_idSiswa = "SELECT * FROM nilai_murni WHERE students_id = '$id_siswa'";

            $result = $konek->query($cek_idSiswa);

            if ($result->num_rows > 0) {
                $response = array(
                    'status' => 'error',
                    'message' => 'Data siswa sudah di proses'
                );
    
                header('Content-Type: application/json');
                echo json_encode($response);
                exit();
            }

            $save_nilai_murni = "INSERT INTO nilai_murni (students_id, ppdb, ipa, ips, mtk, bindo, psikotes, minat_siswa, minat_ortu) VALUES ('$id_siswa', '$ppdb', '$ipa', '$ips', '$mtk', '$bindo', '$psikotes', '$minat', '$minat_ortu')";

            if ($konek->query($save_nilai_murni) === TRUE) {

                if ($ppdb >= 61 && $ppdb <= 100) {
                    $ppdb = 5;
                }elseif ($ppdb >= 56 && $ppdb <= 60) {
                    $ppdb = 4;
                }elseif ($ppdb >= 51 && $ppdb <= 55) {
                    $ppdb = 3;
                }elseif ($ppdb >= 46 && $ppdb <= 50) {
                    $ppdb = 2;
                }elseif ($ppdb >= 0 && $ppdb <= 45) {
                    $ppdb = 1;
                }
    
                //kondisi untuk nilai ipa, ips, mtk, bindo
    
                if ($ipa >= 94 && $ipa <= 100) {
                    $ipa = 5;
                } elseif ($ipa >= 88 && $ipa <= 93) {
                    $ipa = 4;
                } elseif ($ipa >= 82 && $ipa <= 87) {
                    $ipa = 3;
                } elseif ($ipa >= 76 && $ipa <= 81) {
                    $ipa = 2;
                } elseif ($ipa >= 0 && $ipa <= 75) {
                    $ipa = 1;
                }
    
                // Untuk $ips
                if ($ips >= 94 && $ips <= 100) {
                    $ips = 5;
                } elseif ($ips >= 88 && $ips <= 93) {
                    $ips = 4;
                } elseif ($ips >= 82 && $ips <= 87) {
                    $ips = 3;
                } elseif ($ips >= 76 && $ips <= 81) {
                    $ips = 2;
                } elseif ($ips >= 0 && $ips <= 75) {
                    $ips = 1;
                }
    
                // Untuk $mtk
                if ($mtk >= 94 && $mtk <= 100) {
                    $mtk = 5;
                } elseif ($mtk >= 88 && $mtk <= 93) {
                    $mtk = 4;
                } elseif ($mtk >= 82 && $mtk <= 87) {
                    $mtk = 3;
                } elseif ($mtk >= 76 && $mtk <= 81) {
                    $mtk = 2;
                } elseif ($mtk >= 0 && $mtk <= 75) {
                    $mtk = 1;
                }
    
                // Untuk $bindo
                if ($bindo >= 94 && $bindo <= 100) {
                    $bindo = 5;
                } elseif ($bindo >= 88 && $bindo <= 93) {
                    $bindo = 4;
                } elseif ($bindo >= 82 && $bindo <= 87) {
                    $bindo = 3;
                } elseif ($bindo >= 76 && $bindo <= 81) {
                    $bindo = 2;
                } elseif ($bindo >= 0 && $bindo <= 75) {
                    $bindo = 1;
                }

                $save_nilai_score = "INSERT INTO scoring (students_id, nilai_ppdb, nilai_ipa, nilai_ips, nilai_mtk, nilai_bindo, nilai_psikotes, nilai_minat_siswa, nilai_minat_ortu) VALUES ('$id_siswa', '$ppdb', '$ipa', '$ips', '$mtk', '$bindo', '$psikotes', '$minat', '$minat_ortu')";

                if ($konek->query($save_nilai_score) === FALSE) {
                    $delete_nilai_murni = "DELETE FROM nilai_murni WHERE id_siswa = '$id_siswa'";
                    $konek->query($delete_nilai_murni);
                }

                //ambil data scroring berdasarkan id siswa
                $scoring = "SELECT nilai_ppdb, nilai_ipa, nilai_ips, nilai_mtk, nilai_bindo, nilai_psikotes, nilai_minat_siswa, nilai_minat_ortu FROM scoring WHERE students_id = '$id_siswa'";

                //ambil data target untuk IPA dan IPS
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

                //lakukan normalisasi nilai siswa
                for ($i=0; $i < count($data_nilai) ; $i++) {
                    $data_normalisasi_ipa[$i] = $data_nilai[$i] - $data_nilai_target_ipa[$i];
                }
                
                for ($i=0; $i < count($data_nilai) ; $i++) {
                    $data_normalisasi_ips[$i] = $data_nilai[$i] - $data_nilai_target_ips[$i];
                }

                //tentukan nilai bobot gap
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

                //cek apakaha ada data didalam table nilai_bobot_gap
                $cek_query = "SELECT * FROM `nilai_bobot_gap`";
                $cek_result = $konek->query($cek_query);

                if ($cek_result->num_rows > 0) {
                    // If there are existing records, delete them
                    $delete_query = "TRUNCATE TABLE `nilai_bobot_gap`";
                    $konek->query($delete_query);

                    $kode = array();
                    $angka = 0;
                    for ($i = 0; $i < count($data_nilai); $i++) {
                        $kode[$i] = "C" . ++$angka;
                        $nilai_ipa = $nilai_gap_ipa[$i];
                        $nilai_ips = $nilai_gap_ips[$i];
                        $insert_query = "INSERT INTO nilai_bobot_gap (kode, bobot_ipa, bobot_ips, students_id) VALUES ('$kode[$i]', '$nilai_ipa', '$nilai_ips', '$id_siswa')";
                        $konek->query($insert_query);
                    }
                } else {
                    // If there are no existing records, insert new records
                    $kode = array();
                    $angka = 0;
                    for ($i = 0; $i < count($data_nilai); $i++) {
                        $kode[$i] = "C" . ++$angka;
                        $nilai_ipa = $nilai_gap_ipa[$i];
                        $nilai_ips = $nilai_gap_ips[$i];
                        $insert_query = "INSERT INTO nilai_bobot_gap (kode, bobot_ipa, bobot_ips, students_id) VALUES ('$kode[$i]', '$nilai_ipa', '$nilai_ips', '$id_siswa')";
                        $konek->query($insert_query);
                    }
                }

                //hitung ncf dan nsf ipa

                $get_bobot = "SELECT bobot.*, sk.faktor, k.nama_kriteria 
                FROM `nilai_bobot_gap` AS bobot
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

                $n1_ipa = ($ncf_akademik_ipa * 0.6) + ($nsf_akademik_ipa * 0.4);
                $n2_ipa = ($ncf_non_akademik_ipa * 0.6) + ($nsf_non_akademik_ipa * 0.4);
                $n1_ips = ($ncf_akademik_ips * 0.6) + ($nsf_akademik_ips * 0.4);
                $n2_ips = ($ncf_non_akademik_ips * 0.6) + ($nsf_non_akademik_ips * 0.4);

                $hasil_ipa = $n1_ipa + $n2_ipa;
                $hasil_ips = $n1_ips + $n2_ips;

                if ($hasil_ipa > $hasil_ips) {
                    $jurusan = 'IPA';
                } else {
                    $jurusan = 'IPS';
                }

                $save_profile_matching = "INSERT INTO profile_matching (students_id, ncf_akademik_ipa, nsf_akademik_ipa, ncf_nonakademik_ipa, nsf_nonakademik_ipa, n1_ipa, n2_ipa, n_total_ipa, ncf_akademik_ips, nsf_akademik_ips, ncf_nonakademik_ips, nsf_nonakademik_ips, n1_ips, n2_ips, n_total_ips) VALUES ('$id_siswa', '$ncf_akademik_ipa', '$nsf_akademik_ipa', '$ncf_non_akademik_ipa', '$nsf_non_akademik_ipa', '$n1_ipa', '$n2_ipa', '$hasil_ipa', '$ncf_akademik_ips', '$nsf_akademik_ips', '$ncf_non_akademik_ips', '$nsf_non_akademik_ips', '$n1_ips', '$n2_ips', '$hasil_ips')";

                $konek->query($save_profile_matching);

                $get_siswaById = "SELECT * FROM students WHERE id = '$id_siswa'";
                $result = $konek->query($get_siswaById);

                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    $nis = $row['nis'];
                    $nama_siswa = $row['nama_siswa'];
                    $tahun_ajaran = $row['tahun_ajaran'];
                    $kelas = $row['kelas'];
                }

                $data = [
                    'id_siswa' => $id_siswa,
                    'nis' => $nis,
                    'nama_siswa' => $nama_siswa,
                    'tahun_ajaran' => $tahun_ajaran,
                    'kelas' => $kelas,
                    'jurusan' => $jurusan,
                ];

                //kirim response json
                $response = array(
                    'status' => 'success',
                    'message' => 'Data score berhasil ditambahkan',
                    'data' => $data
                );

                header('Content-Type: application/json');
                echo json_encode($response);

            } else {
                $response = array(
                    'status' => 'error',
                    'message' => 'Data score gagal ditambahkan'
                );

                header('Content-Type: application/json');
                echo json_encode($response);
            }
        }
    } else {
        $response = array(
            'status' => 'error',
            'message' => 'Request method not allowed'
        );

        header('Content-Type: application/json');
        echo json_encode($response);
    }

?>