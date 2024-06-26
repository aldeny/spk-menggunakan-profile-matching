<?php
session_start();

// Check if user is not logged in, redirect to login page
if (!isset($_SESSION['username'])) {
    header("Location: ../../index.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <title>SPK - Laporan Profile Matching</title>

    <link rel="stylesheet" href="../../vendor/select2/select2-bootstrap4.css">
    <link rel="stylesheet" href="../../vendor/select2/select2-bootstrap4.min.css">

    <!-- Custom fonts for this template-->
    <link href="../../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet" />

    <!-- Custom styles for this template-->
    <link href="../../css/sb-admin-2.min.css" rel="stylesheet" />

    <!-- Custom styles for this page -->
    <link href="../../vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" />

    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.8/dist/sweetalert2.min.css">

    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet">

    <link rel="stylesheet" href="../../css/loading.css">

</head>

<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">
        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" <?php if ($_SESSION['role'] == 1) { ?> href="../dashboard-kepsek.php" <?php } else { ?> href="../dashboard.php" <?php } ?>>
                <div class="sidebar-brand-text mx-3">SPK</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0" />

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" <?php if ($_SESSION['role'] == 1) { ?> href="../dashboard-kepsek.php" <?php } else { ?> href="../dashboard.php" <?php } ?>> <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <?php
            if ($_SESSION['role'] == 2) {
                echo '
                    <hr class="sidebar-divider" />
        
                    <div class="sidebar-heading">Data Master</div>
        
                    <li class="nav-item">
                        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#master" aria-expanded="true" aria-controls="master">
                            <i class="fas fa-fw fa-cog"></i>
                            <span>Data Master</span>
                        </a>
                        <div id="master" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                            <div class="bg-white py-2 collapse-inner rounded">
                                <h6 class="collapse-header">Settings Data Master:</h6>
                                <a class="collapse-item" href="../kriteria/kriteria.php">Kriteria</a>
                                <a class="collapse-item" href="../sub-kriteria/sub-kriteria.php">Sub Kriteria</a>
                                <a class="collapse-item" href="../target/target.php">Nilai Target</a>
                                <!-- <a class="collapse-item" href="../gap/gap.php">Nilai GAP</a> -->
                            </div>
                        </div>
                    </li>

                    <hr class="sidebar-divider" />

                <div class="sidebar-heading">Pages</div>

                <li class="nav-item">
                    <a class="nav-link" href="../siswa/siswa.php">
                        <i class="fas fa-fw fa-chart-area"></i>
                        <span>Data Siswa</span></a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link" href="../profile-matching/profile-matching.php">
                        <i class="fas fa-fw fa-certificate"></i>
                        <span>Profile Matching</span></a>
                </li>
                    ';
            } else {
                echo '
                <hr class="sidebar-divider" />

                <div class="sidebar-heading">Pages</div>
                ';
            }
            ?>


            <li class="nav-item active">
                <a class="nav-link" href="#">
                    <i class="fas fa-fw fa-chart-bar"></i>
                    <span>Laporan Profile Matching</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block" />

            <!-- Heading -->
            <div class="sidebar-heading">Account</div>

            <li class="nav-item">
                <a class="nav-link" href="../user/user.php">
                    <i class="fas fa-fw fa-user"></i>
                    <span>Users</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block" />

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>
        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">
                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small text-capitalize"><?php echo $_SESSION['username']; ?></span>
                                <img class="img-profile rounded-circle" src="../../img/undraw_profile.svg" />
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>
                    </ul>
                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Data Profile Matching</h1>
                        <div class="d-sm-flex align-items-center justify-content-between ">
                            <a href="../exports/export-pm.php" target="_blank" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate
                                Report</a>
                        </div>
                    </div>

                    <div class="card shadow">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="table_result" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>NIS</th>
                                            <th>Nama Siswa</th>
                                            <th>Tahun Ajaran</th>
                                            <th>Jurusan</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>No</th>
                                            <th>NIS</th>
                                            <th>Nama Siswa</th>
                                            <th>Tahun Ajaran</th>
                                            <th>Jurusan</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                        <!-- /.container-fluid -->
                    </div>
                    <!-- End of Main Content -->

                    <!-- Footer -->
                    <footer class="sticky-footer bg-white">
                        <div class="container my-auto">
                            <div class="copyright text-center my-auto">
                                <span>Copyright &copy; Your Website 2021</span>
                            </div>
                        </div>
                    </footer>
                    <!-- End of Footer -->
                </div>
                <!-- End of Content Wrapper -->
            </div>
            <!-- End of Page Wrapper -->
        </div>
    </div>

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- detail Modal -->
    <div class="modal fade" id="detailModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header bg-info">
                    <h5 class="modal-title text-white" id="detailModalLabel">Proses Profile Matching</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table class="table table-borderless table-responsive" id="table_detail">
                        <tr>
                            <td>NIS</td>
                            <td>:</td>
                            <td class="text-capitalize font-weight-bold" id="nis"></td>
                        </tr>
                        <tr>
                            <td>Nama Siswa</td>
                            <td>:</td>
                            <td class="text-capitalize font-weight-bold" id="nama_siswa"></td>
                        </tr>
                        <tr>
                            <td>Kelas</td>
                            <td>:</td>
                            <td id="kelas"></td>
                        </tr>
                        <tr>
                            <td>Tahun Ajaran</td>
                            <td>:</td>
                            <td id="tahun_ajaran"></td>
                        </tr>
                    </table>

                    <hr>

                    <div class="table-responsive">
                        <h6 class="my-2 font-weight-bold text-primary">Nilai Siswa</h6>
                        <table class="table table-bordered" id="table_result" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>PPDB</th>
                                    <th>IPA</th>
                                    <th>IPS</th>
                                    <th>MTK</th>
                                    <th>B.Indonesia</th>
                                    <th>Psikotes</th>
                                    <th>Minat Siswa</th>
                                    <th>Minat Orang Tua</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td id="nilai_ppdb"></td>
                                    <td id="nilai_ipa"></td>
                                    <td id="nilai_ips"></td>
                                    <td id="nilai_mtk"></td>
                                    <td id="nilai_bindo"></td>
                                    <td id="nilai_psikotes"></td>
                                    <td id="nilai_minat_siswa"></td>
                                    <td id="nilai_minat_orang_tua"></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="table-responsive">
                        <h6 class="my-2 font-weight-bold text-primary">Nilai Normalisasi</h6>
                        <table class="table table-bordered" id="table_result" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>C1</th>
                                    <th>C2</th>
                                    <th>C3</th>
                                    <th>C4</th>
                                    <th>C5</th>
                                    <th>C6</th>
                                    <th>C7</th>
                                    <th>C8</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td id="normalisasi_ppdb"></td>
                                    <td id="normalisasi_ipa"></td>
                                    <td id="normalisasi_ips"></td>
                                    <td id="normalisasi_mtk"></td>
                                    <td id="normalisasi_bindo"></td>
                                    <td id="normalisasi_psikotes"></td>
                                    <td id="normalisasi_minat_siswa"></td>
                                    <td id="normalisasi_minat_orang_tua"></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="table-responsive">
                        <h6 class="my-2 font-weight-bold text-primary">Perhitungan NCF, NSF dan Nilai Total Jurusan IPA
                        </h6>
                        <table class="table table-bordered" id="table_result" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>NCF Akademik</th>
                                    <th>NSF Akademik</th>
                                    <th>N1</th>
                                    <th>NCF Non Akademik</th>
                                    <th>NSF Non Akademik</th>
                                    <th>N2</th>
                                    <th>N1 + N2</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td id="ncf_akademik_ipa"></td>
                                    <td id="nsf_akademik_ipa"></td>
                                    <td id="n1_ipa"></td>
                                    <td id="ncf_non_akademik_ipa"></td>
                                    <td id="nsf_non_akademik_ipa"></td>
                                    <td id="n2_ipa"></td>
                                    <td id="n1_plus_n2_ipa"></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="table-responsive">
                        <h6 class="my-2 font-weight-bold text-primary">Perhitungan NCF, NSF dan Nilai Total Jurusan IPS
                        </h6>
                        <table class="table table-bordered" id="table_result" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>NCF Akademik</th>
                                    <th>NSF Akademik</th>
                                    <th>N1</th>
                                    <th>NCF Non Akademik</th>
                                    <th>NSF Non Akademik</th>
                                    <th>N2</th>
                                    <th>N1 + N2</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td id="ncf_akademik_ips"></td>
                                    <td id="nsf_akademik_ips"></td>
                                    <td id="n1_ips"></td>
                                    <td id="ncf_non_akademik_ips"></td>
                                    <td id="nsf_non_akademik_ips"></td>
                                    <td id="n2_ips"></td>
                                    <td id="n1_plus_n2_ips"></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="table-responsive">
                        <h6 class="my-2 font-weight-bold text-primary">Hasil Akhir
                        </h6>
                        <table class="table table-bordered" id="table_result" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Nilai IPA</th>
                                    <th>Nilai IPS</th>
                                    <th>Hasil</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td id="nilai_ipa_akhir"></td>
                                    <td id="nilai_ips_akhir"></td>
                                    <td id="kesimpulan"></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">
                        Close
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!-- End of detail Modal -->

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-danger">
                    <h5 class="modal-title text-white" id="exampleModalLabel">Yakin Ingin Keluar?</h5>
                    <button class="close text-white" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    Pilih "Logout" dibawah jika kamu yakin ingin mengakhiri sesi ini.
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">
                        Cancel
                    </button>
                    <a class="btn btn-danger" href="../auth/logout.php">Logout <i class="fas fa-sign-out-alt"></i></a>
                </div>
            </div>
        </div>
    </div>
    <!-- End of Logout Modal -->

    <!-- Bootstrap core JavaScript-->
    <script src="../../vendor/jquery/jquery.min.js"></script>
    <script src="../../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../../vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../../js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="../../vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="../../vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- sweetalert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.8/dist/sweetalert2.all.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>

    <script>
        function resetFormAndSelect2(formId, select2Id) {
            $(formId)[0].reset(); // Reset semua elemen form
            setTimeout(function() {
                $(select2Id).val(null).trigger('change'); // Reset nilai Select2
            }, 0);
        }

        function resetForm() {
            $('#ppdb').val('');
            $('#ipa').val('');
            $('#ips').val('');
            $('#mtk').val('');
            $('#bindo').val('');
            $('#psikotes').val('');
            $('#minat').val('');
            $('#minat_ortu').val('');
        }

        $(document).ready(function() {

            tbl_result();

            $("#id_siswa").select2({
                theme: "bootstrap4",
            });

            $("#form-profile").on("submit", function(e) {
                e.preventDefault();

                var formData = new FormData(this);

                $('#loading').show();

                $.ajax({
                    url: "add-pm.php",
                    method: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    dataType: "json",
                    success: function(response) {
                        if (response.status == "success") {

                            console.log(response.data);

                            $("#resultModal").modal('show');
                            $("#nama_siswa").html(response.data.students_id);
                            $("#hasil_jurusan").html(response.data.jurusan);

                            // Toast.fire({
                            //     icon: "success",
                            //     title: response.message,
                            // });
                            $('#loading').hide();
                            resetForm();
                            resetFormAndSelect2('#form-profile', '#id_siswa');
                        } else {
                            $('#loading').hide();
                            Toast.fire({
                                icon: "error",
                                title: response.message,
                            });
                        }
                    },
                    error: function(xhr, status, error) {
                        var errorMessage = xhr.responseJSON ? xhr.responseJSON
                            .message :
                            "Terjadi kesalahan saat memproses permintaan.";
                        $('#loading').hide();

                        Toast.fire({
                            icon: "error",
                            title: errorMessage,
                        });

                    },
                });
            });
        });

        $(document).on("click", "#btn-detail", function() {

            const id = $(this).data("id");

            $.ajax({
                url: "../profile-matching/detail-pmById.php?id=" + id,
                data: {
                    id: id,
                },
                method: "POST",
                dataType: "JSON",
                success: function(data) {

                    $("#detailModal").modal("show");

                    $("#nis").html(data.nis);
                    $("#nama_siswa").html(data.nama_siswa);
                    $("#kelas").html(data.kelas);
                    $("#tahun_ajaran").html(data.tahun_ajaran);

                    $("#nilai_ppdb").html(data.ppdb);
                    $("#nilai_ipa").html(data.ipa);
                    $("#nilai_ips").html(data.ips);
                    $("#nilai_mtk").html(data.mtk);
                    $("#nilai_bindo").html(data.bindo);

                    $("#nilai_psikotes").html(data.psikotes);

                    $("#nilai_minat_siswa").html(data.minat_siswa);

                    $("#nilai_minat_orang_tua").html(data.minat_ortu);

                    $("#normalisasi_ppdb").html(data.nilai_ppdb);
                    $("#normalisasi_ipa").html(data.nilai_ipa);
                    $("#normalisasi_ips").html(data.nilai_ips);
                    $("#normalisasi_mtk").html(data.nilai_mtk);
                    $("#normalisasi_bindo").html(data.nilai_bindo);
                    $("#normalisasi_psikotes").html(data.nilai_psikotes);
                    $("#normalisasi_minat_siswa").html(data.nilai_minat_siswa);
                    $("#normalisasi_minat_orang_tua").html(data.nilai_minat_ortu);

                    $("#ncf_akademik_ipa").html(data.ncf_akademik_ipa);
                    $("#nsf_akademik_ipa").html(data.nsf_akademik_ipa);
                    $("#n1_ipa").html(data.n1_ipa);
                    $("#ncf_non_akademik_ipa").html(data.ncf_nonakademik_ipa);
                    $("#nsf_non_akademik_ipa").html(data.nsf_nonakademik_ipa);
                    $("#n2_ipa").html(data.n2_ipa);
                    $("#n1_plus_n2_ipa").html(data.n_total_ipa);

                    $("#ncf_akademik_ips").html(data.ncf_akademik_ips);
                    $("#nsf_akademik_ips").html(data.nsf_akademik_ips);
                    $("#n1_ips").html(data.n1_ips);
                    $("#ncf_non_akademik_ips").html(data.ncf_nonakademik_ips);
                    $("#nsf_non_akademik_ips").html(data.nsf_nonakademik_ips);
                    $("#n2_ips").html(data.n2_ips);
                    $("#n1_plus_n2_ips").html(data.n_total_ips);

                    $("#nilai_ipa_akhir").html(data.n_total_ipa);
                    $("#nilai_ips_akhir").html(data.n_total_ips);

                    if (data.n_total_ipa > data.n_total_ips) {
                        $("#kesimpulan").html("IPA");
                    } else {
                        $("#kesimpulan").html("IPS");
                    }


                },
                error: function(xhr, status, error) {
                    // Tangani error dan tampilkan pesan kesalahan yang sesuai
                    var errorMessage = xhr.responseJSON ? xhr.responseJSON.message :
                        "Terjadi kesalahan saat memproses permintaan.";
                    Toast.fire({
                        icon: "error",
                        title: errorMessage,
                    });
                },
            })
        })

        $(document).on("click", "#btn-edit", function() {
            const id = $(this).data("id");

            $.ajax({
                url: "edit-siswa.php?id=" + id,
                data: {
                    id: id,
                },
                method: "post",
                dataType: "json",
                success: function(data) {
                    $("#siswaModal").modal("show");
                    $("#ModalLabel").html("Edit Data Siswa");
                    $(".modal-header").addClass("bg-info");
                    $(".btn-submit").html("Update");
                    $("#id").val(data.id);
                    $("#nis").val(data.nis);
                    $("#nama_siswa").val(data.nama_siswa);
                    $('[name="kelas"] option[value="' + data.kelas + '"]').prop(
                        "selected",
                        true
                    );
                    $(
                        '[name="jenis_kelamin"] option[value="' + data.jenis_kelamin +
                        '"]'
                    ).prop("selected", true);
                    $('[name="tahun_ajaran"] option[value="' + data.tahun_ajaran + '"]')
                        .prop(
                            "selected",
                            true
                        );
                    $("#action").val("edit");
                },
                error: function(data) {
                    alert("Error");
                },
            });
        });

        $(document).on("click", "#btn-hapus", function() {
            const id = $(this).data("id");

            var tablePM = $("#table_result").DataTable();

            Swal.fire({
                title: "Anda yakin?",
                text: "Data profile matching akan dihapus!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Ya, hapus!",
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "POST",
                        url: "hapus-laporan-pm.php?id=" + id,
                        data: {
                            id: id,
                        },
                        dataType: "json",
                        success: function(response) {
                            if (response.status == "success") {
                                // Tampilkan pesan sukses atau lakukan tindakan lainnya
                                Toast.fire({
                                    icon: "success",
                                    title: "Data profile matching berhasil dihapus",
                                });
                                tablePM.ajax.reload();
                            } else {
                                // Tampilkan pesan error jika diperlukan
                                Toast.fire({
                                    icon: "error",
                                    title: "Data profile matching gagal dihapus",
                                });
                            }
                        },
                    });
                }
            });
        });

        const Toast = Swal.mixin({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.onmouseenter = Swal.stopTimer;
                toast.onmouseleave = Swal.resumeTimer;
            },
        });



        function tbl_result() {
            $("#table_result").DataTable({
                lengthChange: true,
                processing: true,
                ajax: {
                    url: "list-siswa-jurusan.php",
                },
                columns: [{
                        data: null,
                        sortable: false,
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        },
                    },
                    {
                        data: "nis",
                        name: "nis",
                    },
                    {
                        data: "nama_siswa",
                        name: "nama_siswa",
                    },
                    {
                        data: "tahun_ajaran",
                        name: "tahun_ajaran",
                    },
                    {
                        data: "jurusan",
                        name: "jurusan",
                    },
                    {
                        data: "aksi",
                        name: "aksi",
                    },
                ],
            });
        }
    </script>
</body>

</html>