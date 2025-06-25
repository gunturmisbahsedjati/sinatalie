<?php
$time_start = microtime(true);
require_once './inc/inc.koneksi.php';
require_once './inc/inc.library.php';
if (empty($_SESSION['username'])) {
    header('location:../../../');
} else {
    $username = $_SESSION['username'];
    $id = $_SESSION['id'];
    $level = $_SESSION['level'];
    $arrayAkses = explode(",", $_SESSION['level']);
}
if (!isset($_SESSION['status_login'])) {
    echo '<script type="text/javascript">
    window.location = "./"
    </script>';
    exit;
}
if (isset($_SESSION['alert'])) : ?>
    <script>
        let Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true
        })
        <?php
        echo $_SESSION['alert'];
        unset($_SESSION['alert']);
        ?>
    </script>
<?php endif ?>
<?php
$arrayAkses = explode(",", $_SESSION['level']);
if (in_array(1, $arrayAkses) || in_array(12, $arrayAkses)) { ?>
    <div class="container-xxl flex-grow-1 container-p-y" id="data_akun_belanja">
        <div class="card ">
            <div class="card-header ">
                <div class="row">
                    <div class="col">
                        <h5 class="card-title">Data Master Akun Belanja</h5>
                    </div>
                    <div class="col text-end">
                        <button type="button" class="btn btn-sm btn-primary" title="Tambah Akun Belanja" accesskey="w" data-bs-toggle="modal" data-bs-target="#addShopping">
                            <span class="tf-icons mdi mdi-plus-circle-outline"></span> Tambah Akun Belanja
                        </button>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive text-nowrap">
                    <table id="shopping_table" class="table table table-bordered table-hover" width="100%">
                        <thead>
                            <tr>
                                <th class="text-center text-nowrap align-middle">Kode</th>
                                <th class="text-center text-nowrap align-middle">Nama Akun Belanja</th>
                                <th class="text-center text-nowrap align-middle">Jenis</th>
                                <th class="text-center text-nowrap align-middle">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            $sqlBelanja = mysqli_query($myConnection, "select * from tb_akun_belanja");
                            while ($viewBelanja = mysqli_fetch_array($sqlBelanja)) { ?>
                                <tr>
                                    <td><?= $viewBelanja['id_akun_belanja'] ?></td>
                                    <td><?= $viewBelanja['nama_akun_belanja'] ?></td>
                                    <td class="text-center"><?= $viewBelanja['jenis'] == 1 ? 'Honor' : 'Transport' ?></td>
                                    <td class="text-center">
                                        <button type="button" class="btn btn-sm btn-icon btn-info me-2" data-bs-toggle="modal" title="Edit Akun Belanja" data-bs-target="#editShopping" data-id="<?= encrypt($viewBelanja['id']) ?>" data-token="<?= encrypt($viewBelanja['id_akun_belanja']) ?>">
                                            <span class="tf-icons mdi mdi-square-edit-outline"></span>
                                        </button>
                                        <button type="button" class="btn btn-sm btn-icon btn-danger" data-bs-toggle="modal" title="Hapus Akun Belanja" data-bs-target="#delShopping" data-id="<?= encrypt($viewBelanja['id']) ?>" data-token="<?= encrypt($viewBelanja['id_akun_belanja']) ?>">
                                            <span class="tf-icons mdi mdi-delete-circle-outline"></span>
                                        </button>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                    <?= "Process took " . number_format(microtime(true) - $time_start, 2) . " seconds."; ?>
                </div>
            </div>
        </div>
        <div class="modal fade" id="addShopping" tabindex="-1" data-bs-backdrop="static" role="dialog" aria-labelledby="exampleEditModal" aria-hidden="true" aria-modal="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div id="load-add-shopping" style="display: none;">
                        <div class="modal-body">
                            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                            loading......
                        </div>
                    </div>
                    <div class="add-shopping" id="add-shopping"></div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="editShopping" tabindex="-1" data-bs-backdrop="static" role="dialog" aria-labelledby="exampleEditModal" aria-hidden="true" aria-modal="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div id="load-edit-shopping" style="display: none;">
                        <div class="modal-body">
                            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                            loading......
                        </div>
                    </div>
                    <div class="edit-shopping" id="edit-shopping"></div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="delShopping" tabindex="-1" data-bs-backdrop="static" role="dialog" aria-labelledby="exampledelModal" aria-hidden="true" aria-modal="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div id="load-del-shopping" style="display: none;">
                        <div class="modal-body">
                            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                            loading......
                        </div>
                    </div>
                    <div class="del-shopping" id="del-shopping"></div>
                </div>
            </div>
        </div>
    <?php } else { ?>
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="card border border-primary col-6">
                <div class="card-body">
                    <h2>Nyari apa.... 🤣</h2>
                    <p>Error 404<br>Object not found!<br>The requested URL was not found on this server.</p>
                </div>
            </div>
        </div>
    <?php } ?>