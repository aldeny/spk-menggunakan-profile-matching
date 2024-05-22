<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <title>SPK - Profile Matching</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css" />
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet" />

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet" />

    <!-- Custom styles for this page -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" />

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
            <li class="nav-item">
                <a class="nav-link" href="index.html">
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
                        <a class="collapse-item" href="pages/kriteria/kriteria.php">Kriteria</a>
                        <a class="collapse-item" href="pages/sub-kriteria/sub-kriteria.php">Sub Kriteria</a>
                        <a class="collapse-item" href="pages/target/target.php">Nilai Target</a>
                        <a class="collapse-item" href="pages/gap/gap.php">Nilai GAP</a>
                        <!-- <a class="collapse-item" href="pages/skala/skala.php">Nilai Skala</a> -->
                        <a class="collapse-item" href="buttons.html">Buttons</a>
                        <a class="collapse-item" href="cards.html">Cards</a>
                    </div>
                </div>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider" />

            <!-- Heading -->
            <div class="sidebar-heading">Pages</div>

            <!-- Nav Item - Charts -->
            <li class="nav-item">
                <a class="nav-link" href="pages/siswa/siswa.php">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Data Siswa</span></a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="pages/siswa/siswa.php">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Profile Matching</span></a>
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
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Admin</span>
                                <img class="img-profile rounded-circle" src="img/undraw_profile.svg" />
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Settings
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Activity Log
                                </a>
                                <div class="dropdown-divider"></div>
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
                        <h1 class="h3 mb-0 text-gray-800">Profile Matching</h1>
                    </div>

                    <!-- Content Row -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Data Alternatif (Nilai Siswa)</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="tbl_aspek" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Siswa</th>
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
                                            <td>1</td>
                                            <td>M Sulthan Athallah K</td>
                                            <td>74.44</td>
                                            <td>92.00</td>
                                            <td>92.00</td>
                                            <td>95.00</td>
                                            <td>92.00</td>
                                            <td>IPS</td>
                                            <td>IPA</td>
                                            <td>IPA</td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>Rifqy Ismail An Naufal</td>
                                            <td>74.44</td>
                                            <td>92.00</td>
                                            <td>90.00</td>
                                            <td>91.00</td>
                                            <td>85.00</td>
                                            <td>IPA/IPS</td>
                                            <td>IPA</td>
                                            <td>TRS</td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td>Rohiqul Anwar</td>
                                            <td>45.50</td>
                                            <td>92.00</td>
                                            <td>80.00</td>
                                            <td>88.00</td>
                                            <td>84.00</td>
                                            <td>IPA</td>
                                            <td>IPS</td>
                                            <td>TRS</td>
                                        </tr>
                                        <tr>
                                            <td>4</td>
                                            <td>Dwi Aisyiyah Putri</td>
                                            <td>60.00</td>
                                            <td>92.00</td>
                                            <td>90.00</td>
                                            <td>94.00</td>
                                            <td>91.00</td>
                                            <td>IPA/IPS</td>
                                            <td>IPA</td>
                                            <td>TRS</td>
                                        </tr>
                                        <tr>
                                            <td>5</td>
                                            <td>Rahmanisa Arifin</td>
                                            <td>68.89</td>
                                            <td>91.00</td>
                                            <td>87.00</td>
                                            <td>97.00</td>
                                            <td>87.00</td>
                                            <td>IPA/IPS</td>
                                            <td>IPA</td>
                                            <td>TRS</td>
                                        </tr>
                                        <tr>
                                            <td>6</td>
                                            <td>Moh. Raffy Suardi</td>
                                            <td>45.56</td>
                                            <td>82.00</td>
                                            <td>85.00</td>
                                            <td>83.00</td>
                                            <td>88.00</td>
                                            <td>IPA/IPS</td>
                                            <td>IPS</td>
                                            <td>IPA</td>
                                        </tr>
                                        <tr>
                                            <td>7</td>
                                            <td>Naufal Muhammad Fauzan</td>
                                            <td>45.56</td>
                                            <td>80.00</td>
                                            <td>88.00</td>
                                            <td>77.00</td>
                                            <td>86.00</td>
                                            <td>IPS</td>
                                            <td>IPS</td>
                                            <td>IPS</td>
                                        </tr>
                                        <tr>
                                            <td>8</td>
                                            <td>Athira Khanza</td>
                                            <td>46.67</td>
                                            <td>77.00</td>
                                            <td>86.00</td>
                                            <td>78.00</td>
                                            <td>88.00</td>
                                            <td>IPS/IPA</td>
                                            <td>IPS</td>
                                            <td>IPS</td>
                                        </tr>
                                        <tr>
                                            <td>9</td>
                                            <td>Jehan Anisa Humairah</td>
                                            <td>60.00</td>
                                            <td>81.00</td>
                                            <td>88.00</td>
                                            <td>80.00</td>
                                            <td>89.00</td>
                                            <td>IPS/IPA</td>
                                            <td>IPS</td>
                                            <td>TRS</td>
                                        </tr>
                                        <tr>
                                            <td>10</td>
                                            <td>Sayida Salima</td>
                                            <td>68.89</td>
                                            <td>87.00</td>
                                            <td>87.00</td>
                                            <td>80.00</td>
                                            <td>87.00</td>
                                            <td>IPS</td>
                                            <td>IPS</td>
                                            <td>TRS</td>
                                        </tr>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Siswa</th>
                                            <th>C1</th>
                                            <th>C2</th>
                                            <th>C3</th>
                                            <th>C4</th>
                                            <th>C5</th>
                                            <th>C6</th>
                                            <th>C7</th>
                                            <th>C8</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Data Normalisasi</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="tbl_aspek" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Siswa</th>
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
                                            <td>1</td>
                                            <td>M Sulthan Athallah K</td>
                                            <td>5</td>
                                            <td>4</td>
                                            <td>4</td>
                                            <td>5</td>
                                            <td>4</td>
                                            <td>2</td>
                                            <td>2</td>
                                            <td>5</td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>Rifqy Ismail An Naufal</td>
                                            <td>5</td>
                                            <td>4</td>
                                            <td>4</td>
                                            <td>4</td>
                                            <td>3</td>
                                            <td>3</td>
                                            <td>2</td>
                                            <td>1</td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td>Rohiqul Anwar</td>
                                            <td>2</td>
                                            <td>4</td>
                                            <td>2</td>
                                            <td>4</td>
                                            <td>3</td>
                                            <td>5</td>
                                            <td>5</td>
                                            <td>1</td>
                                        </tr>
                                        <tr>
                                            <td>4</td>
                                            <td>Dwi Aisyiyah Putri</td>
                                            <td>5</td>
                                            <td>4</td>
                                            <td>4</td>
                                            <td>5</td>
                                            <td>4</td>
                                            <td>4</td>
                                            <td>5</td>
                                            <td>1</td>
                                        </tr>
                                        <tr>
                                            <td>5</td>
                                            <td>Rahmanisa Arifin</td>
                                            <td>5</td>
                                            <td>4</td>
                                            <td>4</td>
                                            <td>5</td>
                                            <td>4</td>
                                            <td>4</td>
                                            <td>2</td>
                                            <td>1</td>
                                        </tr>
                                        <tr>
                                            <td>6</td>
                                            <td>Moh. Raffy Suardi</td>
                                            <td>2</td>
                                            <td>3</td>
                                            <td>3</td>
                                            <td>3</td>
                                            <td>4</td>
                                            <td>4</td>
                                            <td>2</td>
                                            <td>2</td>
                                        </tr>
                                        <tr>
                                            <td>7</td>
                                            <td>Naufal Muhammad Fauzan</td>
                                            <td>2</td>
                                            <td>2</td>
                                            <td>4</td>
                                            <td>2</td>
                                            <td>3</td>
                                            <td>2</td>
                                            <td>5</td>
                                            <td>2</td>
                                        </tr>
                                        <tr>
                                            <td>8</td>
                                            <td>Athira Khanza</td>
                                            <td>2</td>
                                            <td>2</td>
                                            <td>3</td>
                                            <td>2</td>
                                            <td>4</td>
                                            <td>3</td>
                                            <td>5</td>
                                            <td>5</td>
                                        </tr>
                                        <tr>
                                            <td>9</td>
                                            <td>Jehan Anisa Humairah</td>
                                            <td>4</td>
                                            <td>2</td>
                                            <td>4</td>
                                            <td>2</td>
                                            <td>4</td>
                                            <td>3</td>
                                            <td>5</td>
                                            <td>1</td>
                                        </tr>
                                        <tr>
                                            <td>10</td>
                                            <td>Sayida Salima</td>
                                            <td>5</td>
                                            <td>4</td>
                                            <td>3</td>
                                            <td>2</td>
                                            <td>3</td>
                                            <td>2</td>
                                            <td>5</td>
                                            <td>1</td>
                                        </tr>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Siswa</th>
                                            <th>C1</th>
                                            <th>C2</th>
                                            <th>C3</th>
                                            <th>C4</th>
                                            <th>C5</th>
                                            <th>C6</th>
                                            <th>C7</th>
                                            <th>C8</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Profile Matching Siswa</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="tbl_aspek" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Siswa</th>
                                            <th>Nilai IPA</th>
                                            <th>Nilai IPS</th>
                                            <th>Hasil</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>M Sulthan Athallah K</td>
                                            <td>7.30</td>
                                            <td>7.10</td>
                                            <td>IPA</td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>Rifqy Ismail An Naufal</td>
                                            <td>8.40</td>
                                            <td>8.10</td>
                                            <td>IPA</td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td>Rohiqul Anwar</td>
                                            <td>8.15</td>
                                            <td>7.55</td>
                                            <td>IPA</td>
                                        </tr>
                                        <tr>
                                            <td>4</td>
                                            <td>Dwi Aisyiyah Putri</td>
                                            <td>8.35</td>
                                            <td>8.25</td>
                                            <td>IPA</td>
                                        </tr>
                                        <tr>
                                            <td>5</td>
                                            <td>Rahmanisa Arifin</td>
                                            <td>8.50</td>
                                            <td>8.40</td>
                                            <td>IPA</td>
                                        </tr>
                                        <tr>
                                            <td>6</td>
                                            <td>Moh. Raffy Suardi</td>
                                            <td>8.10</td>
                                            <td>8.40</td>
                                            <td>IPS</td>
                                        </tr>
                                        <tr>
                                            <td>7</td>
                                            <td>Naufal Muhammad Fauzan</td>
                                            <td>6.95</td>
                                            <td>7.25</td>
                                            <td>IPS</td>
                                        </tr>
                                        <tr>
                                            <td>8</td>
                                            <td>Athira Khanza</td>
                                            <td>6.25</td>
                                            <td>6.55</td>
                                            <td>IPS</td>
                                        </tr>
                                        <tr>
                                            <td>9</td>
                                            <td>Jehan Anisa Humairah</td>
                                            <td>7.15</td>
                                            <td>6.70</td>
                                            <td>IPA</td>
                                        </tr>
                                        <tr>
                                            <td>10</td>
                                            <td>Sayida Salima</td>
                                            <td>7.65</td>
                                            <td>7.35</td>
                                            <td>IPA</td>
                                        </tr>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Siswa</th>
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
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    Select "Logout" below if you are ready to end your current session.
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">
                        Cancel
                    </button>
                    <a class="btn btn-primary" href="login.html">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- sweetalert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.8/dist/sweetalert2.all.min.js"></script>

</body>

</html>