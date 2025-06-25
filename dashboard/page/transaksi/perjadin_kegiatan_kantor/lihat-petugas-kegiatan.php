<?php
session_start();
include_once '../../../../inc/inc.koneksi.php';
include_once '../../../../inc/config.php';
include_once '../../../../inc/inc.library.php';
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
if (isset($_POST['id'])) {
    $token = $_POST['id'];
?>
    <div class="modal-header">
        <h3 class="modal-title" id="exampleModalLabel">Daftar Pegawai</h3>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">
        <ul>
            <?php
            $getDataPegSTPerjadin = getDataPegSTPerjadin($keySiratu, $token);
            $peg = http_request($getDataPegSTPerjadin);
            $getDataPegSTPerjadinView = json_decode($peg, true);
            if ($getDataPegSTPerjadinView['status']['code'] == '200') {
                $resultPeg = isset($getDataPegSTPerjadinView['results']) ? $getDataPegSTPerjadinView['results'] : array();
                foreach ($resultPeg as $arrPeg) {
                    $nama_peg = $arrPeg['nama_peg'];
                    $jabatan = $arrPeg['sebagai'];
                    echo '<li><strong>' . $jabatan . '</strong> - ' . $nama_peg . '</li>';
                }
            }
            ?>
        </ul>
    </div>
<?php
} else {
    echo '<script type="text/javascript">
    window.location = "../"
    </script>';
}
?>