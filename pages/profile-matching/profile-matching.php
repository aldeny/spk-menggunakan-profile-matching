<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <title>SPK - Profile Matching</title>

    <link rel="stylesheet" href="../../vendor/select2/select2-bootstrap4.css">
    <link rel="stylesheet" href="../../vendor/select2/select2-bootstrap4.min.css">

    <!-- Custom fonts for this template-->
    <link href="../../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css" />
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet" />

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
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="../../index.php">
                <div class="sidebar-brand-text mx-3">SPK</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0" />

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="../../index.php">
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
                        <a class="collapse-item" href="../kriteria/kriteria.php">Kriteria</a>
                        <a class="collapse-item" href="../sub-kriteria/sub-kriteria.php">Sub Kriteria</a>
                        <a class="collapse-item" href="../target/target.php">Nilai Target</a>
                        <a class="collapse-item" href="../gap/gap.php">Nilai GAP</a>
                    </div>
                </div>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider" />

            <!-- Heading -->
            <div class="sidebar-heading">Pages</div>

            <!-- Nav Item - Charts -->
            <li class="nav-item">
                <a class="nav-link" href="../siswa/siswa.php">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Data Siswa</span></a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="profile-matching.php">
                    <i class="fas fa-fw fa-certificate"></i>
                    <span>Profile Matching</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="../laporan/laporan.php">
                    <i class="fas fa-fw fa-chart-bar"></i>
                    <span>Laporan Profile Matching</span></a>
            </li>
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
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Douglas McGee</span>
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
                    <h1 class="h3 mb-0 text-gray-800 mb-2">Profile Matching</h1>
                    <span class="mb-2 text-danger">Nb: Gunakan tandan titik (.) jika menginputkan nilai berkoma</span>

                    <div class="card shadow mt-2">
                        <div class="card-body">
                            <form id="form-profile">
                                <div class="form-group">
                                    <label for="id_siswa">Nama Siswa</label>
                                    <select name="id_siswa" id="id_siswa" class="form-control select2-siswa" required>
                                        <option value="" selected disabled>-- Pilih Siswa --</option>
                                        <?php
                                    include '../../config/koneksi.php';

                                    $sql = "SELECT * FROM students";

                                    $query = mysqli_query($konek, $sql);

                                    while ($data = mysqli_fetch_array($query)) {
                                ?>
                                        <option value="<?= $data['id'] ?>"><?= $data['nis'] ?> -
                                            <?= $data['nama_siswa'] ?></option>
                                        <?php
                                    }
                                ?>
                                    </select>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="ppdb">Nilai PPDB</label>
                                            <input type="hidden" id="id" name="id">
                                            <input type="hidden" id="action" name="action">
                                            <input type="number" class="form-control" id="ppdb" name="ppdb"
                                                placeholder="ex: 90" required step="0.01">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="ipa">Nilai IPA</label>
                                            <input type="number" class="form-control" id="ipa" name="ipa"
                                                placeholder="ex: 90" required step="0.01">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="ips">Nilai IPS</label>
                                            <input type="number" class="form-control" id="ips" name="ips"
                                                placeholder="ex: 90" required step="0.01">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="mtk">Nilai MTK</label>
                                            <input type="number" class="form-control" id="mtk" name="mtk"
                                                placeholder="ex: 90" required step="0.01">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="bindo">Nilai B.Indonesia</label>
                                            <input type="number" class="form-control" id="bindo" name="bindo"
                                                placeholder="ex: 90" required step="0.01">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="psikotes">Nilai Psikotes</label>
                                            <select class="form-control" id="psikotes" name="psikotes"
                                                placeholder="ex: 90" required>
                                                <option value="" selected disabled>-- Pilih Nilai --</option>
                                                <option value="5">Bernilai IPA</option>
                                                <option value="4">Bernilai IPA/IPS</option>
                                                <option value="3">Bernilai IPS/IPA</option>
                                                <option value="2">Bernilai IPS</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="minat">Nilai Minat Siswa</label>
                                            <select class="form-control" id="minat" name="minat" placeholder="ex: 90"
                                                required>
                                                <option value="" selected disabled>-- Pilih Nilai --</option>
                                                <option value="5">Jika == Psikotes</option>
                                                <option value="2">Jika != Psikotes</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="minat_ortu">Nilai Minat Orang Tua</label>
                                            <select class="form-control" id="minat_ortu" name="minat_ortu"
                                                placeholder="ex: 90" required>
                                                <option value="" selected disabled>-- Pilih Nilai --</option>
                                                <option value="5">Jika == Siswa</option>
                                                <option value="2">Jika != Psikotes</option>
                                                <option value="1">Jika Terserah</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="reset" class="btn btn-secondary">Reset</button>
                                    <button type="submit" class="btn btn-primary">Proses</button>
                                </div>
                            </form>
                            <div id="loading" style="display: none;">Processing...</div>
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

        <!-- Result Modal -->
        <div class="modal fade" id="resultModal" data-backdrop="static" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-success">
                        <h5 class="modal-title text-white" id="resultModalLabel">Hasil Profile Matching</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <table class="table table-borderless table-responsive" id="table_result">
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
                        <div class="d-flex flex-column justify-content-center p-4">
                            <h6 class="text-center">Berdasarkan data atau nilai yang telah di inputkan maka hasil
                                akhirnya adalah jurusan
                            </h6>
                            <h4 class="text-center font-weight-bold py-4" id="hasil_jurusan"></h4>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" id="btn-lihat" data-id="">Lihat Detail</button>
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">
                            Close
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <!-- End of Result Modal -->

        <!-- Detail Proses Profile Matching Modal -->
        <div class="modal fade" id="detailModal" data-backdrop="static" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-info">
                        <h5 class="modal-title text-white" id="resultModalLabel">Detail Proses Profile Matching</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <table class="table table-borderless table-responsive" id="table_result">
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

                        <div class="table-responsive">
                            <h6>Nilai Siswa</h6>
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
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">
                            Close
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <!-- End of Detail Proses Profile Matching Modal -->

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
                setTimeout(function () {
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

            $(document).ready(function () {
                // tbl_siswa();

                // $("#detailModal").modal('show');

                $("#id_siswa").select2({
                    theme: "bootstrap4",
                });

                $("#form-profile").on("submit", function (e) {
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
                        success: function (response) {
                            if (response.status == "success") {

                                console.log(response.data);

                                $("#resultModal").modal('show');
                                $("#nis").html(response.data.nis);
                                $("#nama_siswa").html(response.data.nama_siswa);
                                $("#kelas").html(response.data.kelas);
                                $("#tahun_ajaran").html(response.data.tahun_ajaran);
                                $("#hasil_jurusan").html(response.data.jurusan);

                                $("#btn-lihat").attr("data-id", response.data.id_siswa);

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
                        error: function (xhr, status, error) {
                            var errorMessage = xhr.responseJSON ? xhr.responseJSON.message :
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

            $(document).on("click", "#btn-lihat", function () {
                const id = $(this).data("id");

                $.ajax({
                    url: "detail-pmById.php?id=" + id,
                    data: {
                        id: id,
                    },
                    method: "POST",
                    dataType: "JSON",
                    success: function (data) {
                        console.log(data.ppdb);

                        $("#resultModal").modal("hide");
                        $("#detailModal").modal("show");

                        $("#nilai_ppdb").html(data.ppdb);
                        $("#nilai_ipa").html(data.ipa);
                        $("#nilai_ips").html(data.ips);
                        $("#nilai_mtk").html(data.mtk);
                        $("#nilai_bindo").html(data.bindo);
                        $("#nilai_psikotes").html(data.psikotes);
                        $("#nilai_minat_siswa").html(data.minat_siswa);
                        $("#nilai_minat_orang_tua").html(data.minat_ortu);

                    },
                    error: function (xhr, status, error) {
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

            $(document).on("click", "#btn-edit", function () {
                const id = $(this).data("id");

                $.ajax({
                    url: "edit-siswa.php?id=" + id,
                    data: {
                        id: id,
                    },
                    method: "post",
                    dataType: "json",
                    success: function (data) {
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
                            '[name="jenis_kelamin"] option[value="' + data.jenis_kelamin + '"]'
                        ).prop("selected", true);
                        $('[name="tahun_ajaran"] option[value="' + data.tahun_ajaran + '"]').prop(
                            "selected",
                            true
                        );
                        $("#action").val("edit");
                    },
                    error: function (data) {
                        alert("Error");
                    },
                });
            });

            $(document).on("click", "#btn-hapus", function () {
                const id = $(this).data("id");

                var tableSiswa = $("#tblSiswa").DataTable();

                Swal.fire({
                    title: "Anda yakin?",
                    text: "Data siswa akan dihapus!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Ya, hapus!",
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: "POST",
                            url: "hapus-siswa.php?id=" + id,
                            data: {
                                id: id,
                            },
                            dataType: "json",
                            success: function (response) {
                                if (response.success) {
                                    // Tampilkan pesan sukses atau lakukan tindakan lainnya
                                    Toast.fire({
                                        icon: "success",
                                        title: "Data siswa berhasil dihapus",
                                    });
                                    tableSiswa.ajax.reload();
                                } else {
                                    // Tampilkan pesan error jika diperlukan
                                    Toast.fire({
                                        icon: "error",
                                        title: "Data siswa gagal dihapus",
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


            // function tbl_pm() {
            //     $("#tbl_pm").DataTable({
            //         lengthChange: true,
            //         processing: true,
            //         ajax: {
            //             url: "list-siswa.php",
            //         },
            //         columns: [{
            //                 data: null,
            //                 sortable: false,
            //                 render: function (data, type, row, meta) {
            //                     return meta.row + meta.settings._iDisplayStart + 1;
            //                 },
            //             },
            //             {
            //                 data: "nis",
            //                 name: "nis",
            //             },
            //             {
            //                 data: "nama_siswa",
            //                 name: "nama_siswa",
            //             },
            //             {
            //                 data: "jenis_kelamin",
            //                 name: "jenis_kelamin",
            //             },
            //             {
            //                 data: "kelas",
            //                 name: "kelas",
            //             },
            //             {
            //                 data: "tahun_ajaran",
            //                 name: "tahun_ajaran",
            //             },
            //             {
            //                 data: "aksi",
            //                 name: "aksi",
            //             },
            //         ],
            //     });
            // }
        </script>
</body>

</html>