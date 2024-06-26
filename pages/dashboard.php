<?php
session_start();

// Check if user is not logged in, redirect to login page
if (!isset($_SESSION['username'])) {
    header("Location: ../index.php");
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

    <title>SPK - Dashboard</title>

    <!-- Custom fonts for this template-->
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css" />
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet" />

    <!-- Custom styles for this template-->
    <link href="../css/sb-admin-2.min.css" rel="stylesheet" />

    <!-- Custom styles for this page -->
    <link href="../vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" />

    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.8/dist/sweetalert2.min.css">
</head>

<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">
        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
                <div class="sidebar-brand-text mx-3">SPK</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0" />

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="dashboard.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider" />

            <!-- Heading -->
            <div class="sidebar-heading">Data Master</div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#master" aria-expanded="true"
                    aria-controls="master">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Data Master</span>
                </a>
                <div id="master" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Settings Data Master:</h6>
                        <a class="collapse-item" href="kriteria/kriteria.php">Kriteria</a>
                        <a class="collapse-item" href="sub-kriteria/sub-kriteria.php">Sub Kriteria</a>
                        <a class="collapse-item" href="target/target.php">Nilai Target</a>
                        <!-- <a class="collapse-item" href="pages/gap/gap.php">Nilai GAP</a> -->
                        <!-- <a class="collapse-item" href="pages/skala/skala.php">Nilai Skala</a> -->
                    </div>
                </div>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider" />

            <!-- Heading -->
            <div class="sidebar-heading">Pages</div>

            <!-- Nav Item - Charts -->
            <li class="nav-item">
                <a class="nav-link" href="siswa/siswa.php">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Data Siswa</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="profile-matching/profile-matching.php">
                    <i class="fas fa-fw fa-certificate"></i>
                    <span>Profile Matching</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="laporan/laporan.php">
                    <i class="fas fa-fw fa-chart-bar"></i>
                    <span>Laporan Profile Matching</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block" />

            <!-- Heading -->
            <div class="sidebar-heading">Account</div>

            <li class="nav-item">
                <a class="nav-link" href="user/user.php">
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
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span
                                    class="mr-2 d-none d-lg-inline text-gray-600 small text-capitalize"><?php echo $_SESSION['username']; ?></span>
                                <img class="img-profile rounded-circle" src="../img/undraw_profile.svg" />
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
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
                        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
                    </div>

                    <?php
                    include '../config/koneksi.php';

                    $sql = "SELECT * FROM students";

                    $result = mysqli_query($konek, $sql);

                    $total = mysqli_num_rows($result);

                    ?>

                    <!-- Content Row -->
                    <div class="row">
                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Total Siswa Terdaftar
                                            </div>
                                            <div class="h2 mb-4 font-weight-bold text-gray-800">
                                                <?php echo $total ?>
                                            </div>
                                            <a href="siswa/siswa.php" class="btn btn-sm btn-primary">Cek Detail</a>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-user-graduate fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <?php
                        include '../config/koneksi.php';

                        $sql = "SELECT 
                                        COUNT(*) AS jumlah_ipa
                                    FROM 
                                        `profile_matching` AS pm
                                    WHERE 
                                        pm.n_total_ipa > pm.n_total_ips;
                                    ";

                        $result = mysqli_query($konek, $sql);

                        $total = mysqli_fetch_assoc($result);
                        ?>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Total Siswa IPA
                                            </div>
                                            <div class="h2 mb-4 font-weight-bold text-gray-800">
                                                <?php echo $total['jumlah_ipa'] ?>
                                            </div>
                                            <!-- <a href="#" class="btn btn-sm btn-success">Cek Detail</a> -->
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-microscope fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <?php
                        include '../config/koneksi.php';

                        $sql = "SELECT 
                                        COUNT(*) AS jumlah_ips
                                    FROM 
                                        `profile_matching` AS pm
                                    WHERE 
                                        pm.n_total_ipa < pm.n_total_ips;
                                    ";

                        $result = mysqli_query($konek, $sql);

                        $total = mysqli_fetch_assoc($result);
                        ?>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                                Total Siswa IPS
                                            </div>
                                            <div class="h2 mb-4 font-weight-bold text-gray-800">
                                                <?php echo $total['jumlah_ips'] ?>
                                            </div>
                                            <!-- <a href="#" class="btn btn-sm btn-info">Cek Detail</a> -->
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-people-arrows fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <?php
                        include '../config/koneksi.php';

                        $sql = "SELECT 
                                        COUNT(*) AS jumlah_ips
                                    FROM 
                                        `profile_matching` AS pm
                                    WHERE 
                                        pm.n_total_ipa = pm.n_total_ips;
                                    ";

                        $result = mysqli_query($konek, $sql);

                        $total = mysqli_fetch_assoc($result);
                        ?>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-danger shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                                Total Siswa Nilai Sama
                                            </div>
                                            <div class="h2 mb-4 font-weight-bold text-gray-800">
                                                <?php echo $total['jumlah_ips'] ?>
                                            </div>
                                            <div class="text-danger">
                                                <small><strong>Nb:</strong> Harapa Ditinjau Kembali</small>
                                            </div>
                                            <!-- <a href="#" class="btn btn-sm btn-warning">Cek Detail</a> -->
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-question-circle fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Profile Matching Siswa</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="tbl_pm_siswa" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>NIS</th>
                                            <th>Nama Siswa</th>
                                            <th>Tahun Ajaran</th>
                                            <th>Nilai IPA</th>
                                            <th>Nilai IPS</th>
                                            <th>Hasil</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                    <tfoot>
                                        <tr>
                                            <th>No</th>
                                            <th>NIS</th>
                                            <th>Nama Siswa</th>
                                            <th>Tahun Ajaran</th>
                                            <th>Nilai IPA</th>
                                            <th>Nilai IPS</th>
                                            <th>Hasil</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; - Dibuat dengan
                            <i class="fas fa-heart text-danger"></i> By Yulia Merry Anjani
                        </span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->
        </div>
        <!-- End of Content Wrapper -->
    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
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
                    <a class="btn btn-danger" href="auth/logout.php">Logout <i class="fas fa-sign-out-alt"></i></a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="../vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="../js/demo/chart-area-demo.js"></script>
    <script src="../js/demo/chart-pie-demo.js"></script>

    <!-- Page level plugins -->
    <script src="../vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="../vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- sweetalert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.8/dist/sweetalert2.all.min.js"></script>

    <script>
        $(document).ready(function () {
            tbl_pm_siswa();
        })

        function tbl_pm_siswa() {
            $("#tbl_pm_siswa").DataTable({
                lengthChange: true,
                processing: true,
                ajax: {
                    url: "laporan/list-siswa-jurusan.php",
                },
                columns: [{
                        data: null,
                        sortable: false,
                        render: function (data, type, row, meta) {
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
                        data: "n_total_ipa",
                        name: "n_total_ipa",
                    },
                    {
                        data: "n_total_ips",
                        name: "n_total_ips",
                    },
                    {
                        data: "jurusan",
                        name: "jurusan",
                    },
                ],
            });
        }
    </script>

</body>

</html>