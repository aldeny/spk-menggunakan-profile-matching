<?php

include '../../config/koneksi.php';

$id = $_GET['id'];

$query = mysqli_query($konek, "SELECT nm.*, st.nis, st.nama_siswa, st.tahun_ajaran, st.kelas, sc.nilai_ppdb, sc.nilai_ipa, sc.nilai_ips, sc.nilai_mtk, sc.nilai_bindo, sc.nilai_psikotes, sc.nilai_minat_siswa, sc.nilai_minat_ortu, pm.ncf_akademik_ipa, pm.nsf_akademik_ipa, pm.ncf_nonakademik_ipa, pm.nsf_nonakademik_ipa, pm.n1_ipa, pm.n2_ipa, pm.n_total_ipa, pm.ncf_akademik_ips, pm.nsf_akademik_ips, pm.ncf_nonakademik_ips, pm.nsf_nonakademik_ips, pm.n1_ips, pm.n2_ips, pm.n_total_ips
FROM `nilai_murni` as nm
JOIN students as st on nm.students_id = st.id
JOIN scoring as sc on st.id = sc.students_id
JOIN profile_matching as pm ON sc.students_id = pm.students_id
WHERE nm.students_id = '$id'");

$data = mysqli_fetch_array($query);

if ($data) {
    echo json_encode($data);
} else {
    echo json_encode(array('status' => 'error', 'message' => 'Data not found!'));
}

?>