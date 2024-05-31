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

    <title>SPK - Data Siswa</title>

    <!-- Custom fonts for this template-->
    <link href="../../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet" />

    <!-- Custom styles for this template-->
    <link href="../../css/sb-admin-2.min.css" rel="stylesheet" />

    <!-- Custom styles for this page -->
    <link href="../../vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" />

    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.8/dist/sweetalert2.min.css">

</head>

<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4 mt-5">
                        <h1 class="h3 mb-0 text-gray-800">Export Data Siswa</h1>
                    </div>

                    <form action="" method="GET">
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <select name="tahun" id="tahun" class="form-control">
                                        <option value="0" disabled selected>-- Pilih Tahun Ajaran --</option>
                                        <?php
                                        include '../../config/koneksi.php';

                                        $query = "SELECT tahun_ajaran FROM students GROUP BY tahun_ajaran";
                                        $result = mysqli_query($konek, $query);
                                        while ($data = mysqli_fetch_array($result)) {
                                            echo '<option value="' . $data['tahun_ajaran'] . '">' . $data['tahun_ajaran'] . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <?php
                            include '../../config/koneksi.php';

                            if (isset($_GET['tahun'])) {
                                $tahun = $_GET['tahun'];
                                $query = "SELECT * FROM students WHERE tahun_ajaran = '$tahun' ORDER BY nis ASC";
                            } else {
                                $query = "SELECT * FROM students ORDER BY nis ASC";
                            }
                            ?>

                            <div class="col">
                                <div class="mb-3">
                                    <button type="submit" class="btn btn-sm btn-primary">Cari</button>
                                    <a href="export-siswa.php" class="btn btn-sm btn-dark text-white">Reset</a>
                                    <a href="export-siswa-excel.php?tahun=<?= $tahun ?>" class="btn btn-sm btn-success text-white"><i class="bi bi-file-earmark-spreadsheet"></i>
                                        Export Excel</a>
                                    <a href="export-siswa-pdf.php?tahun=<?= $tahun ?>" class="btn btn-sm btn-dark text-white" target="_blank"><i class="bi bi-filetype-pdf"></i>
                                        Export Pdf</a>
                                </div>
                            </div>
                        </div>
                    </form>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Data Siswa</h6>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="tblSiswa" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>NIS</th>
                                            <th>Nama Siswa</th>
                                            <th>Jenis Kelamin</th>
                                            <th>Kelas</th>
                                            <th>Tahun Ajaran</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        $result = mysqli_query($konek, $query);
                                        while ($data = mysqli_fetch_array($result)) {
                                        ?>
                                            <tr>
                                                <td><?= $no++ ?></td>
                                                <td><?= $data['nis'] ?></td>
                                                <td><?= $data['nama_siswa'] ?></td>
                                                <td><?= $data['jenis_kelamin'] ?></td>
                                                <td><?= $data['kelas'] ?></td>
                                                <td><?= $data['tahun_ajaran'] ?></td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>No</th>
                                            <th>NIS</th>
                                            <th>Nama Siswa</th>
                                            <th>Jenis Kelamin</th>
                                            <th>Kelas</th>
                                            <th>Tahun Ajaran</th>
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
                        <span>Copyright &copy; Your Website 2021</span>
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

    <script>
        $(document).ready(function() {
            $('#tblSiswa').DataTable();
        });
    </script>
</body>

</html>