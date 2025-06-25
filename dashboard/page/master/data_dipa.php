<?php
$time_start = microtime(true);
require_once './inc/inc.koneksi.php';
require_once './inc/inc.library.php';
require_once './inc/config.php';
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
    <div class="container-xxl flex-grow-1 container-p-y" id="data_dipa_list">
        <div class="card ">
            <div class="card-header ">
                <div class="row">
                    <div class="col">
                        <h5 class="card-title">Data DIPA</h5>
                        <small class="text-danger">Jika ada ketidaksamaan data, silahkan sinkronisasi untuk mengambil data dari Data SINADIN</small>
                    </div>
                    <div class="col text-end">
                        <form action="setDipa" method="post" role="form" enctype="multipart/form-data" autocomplete="off">
                            <button type="submit" name="syncDipa" class="btn btn-sm btn-primary" title="Sinkronisasi Data Pegawai SIRATU"><i class="mdi mdi-cog-refresh-outline"></i>&nbsp;Sinkron Data SINADIN</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive text-nowrap">
                    <table id="shopping_table" class="table table table-bordered table-hover" width="100%">
                        <thead>
                            <tr>
                                <th class="text-center text-nowrap align-middle">No</th>
                                <th class="text-center text-nowrap align-middle">Tahun</th>
                                <th class="text-center text-nowrap align-middle">Satker</th>
                                <th class="text-center text-nowrap align-middle">No. DIPA</th>
                                <th class="text-center text-nowrap align-middle">Klasifikasi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sql = mysqli_query($myConnection, "select * from tb_profil_sptjb where soft_delete = 0");
                            $no = 1;
                            while ($viewDIPAArray = mysqli_fetch_array($sql)) {
                                echo '<tr>';
                                echo '<td>' . $no++ . '</td>';
                                echo '<td class="text-center">' . $viewDIPAArray['thn_anggaran'] . '</td>';
                                echo '<td><span class="fw-bold">Kode : ' . $viewDIPAArray['kode_satker'] . '</span><br>' . $viewDIPAArray['nama_satker'] . '</td>';
                                echo '<td>' . $viewDIPAArray['no_dipa'] . '<br>' . Indonesia2Tgl($viewDIPAArray['tgl_dipa']) . '</td>';
                                echo '<td>' . $viewDIPAArray['klasifikasi'] . '</td>';
                                echo '</tr>';
                            }
                            ?>
                        </tbody>
                    </table>
                    <?= "Process took " . number_format(microtime(true) - $time_start, 2) . " seconds."; ?>
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