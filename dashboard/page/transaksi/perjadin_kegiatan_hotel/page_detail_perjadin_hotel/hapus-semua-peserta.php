<?php
session_start();
include_once '../../../../../inc/inc.koneksi.php';
include_once '../../../../../inc/config.php';
include_once '../../../../../inc/inc.library.php';
if (empty($_SESSION['username'])) {
    header('location:../../../../../');
} else {
    $username = $_SESSION['username'];
    $id = $_SESSION['id'];
    $level = $_SESSION['level'];
    $arrayAkses = explode(",", $_SESSION['level']);
}
if (!isset($_SESSION['status_login'])) {
    echo '<script type="text/javascript">
    window.location = "../../../../../"
    </script>';
    exit;
}
if (isset($_POST['id'])) {
    $id_keg = decrypt($_POST['id']);
    $sqlKegiatan = mysqli_query($myConnection, "select * from tb_kegiatan where id_keg = '$id_keg'");
    if (mysqli_num_rows($sqlKegiatan) > 0) {
        $viewKeg = mysqli_fetch_array($sqlKegiatan);
        $token = $viewKeg['id_st_siratu']
?>
        <form action="setDocumentHotel" method="post" role="form" enctype="multipart/form-data" autocomplete="off">
            <div class="modal-header">
                <h4><i class="bx bx-data"></i> Hapus Data Peserta</h4>
            </div>
            <div class="modal-body">
                <div class="mb-2 fw-bold">
                    <p>Apakah anda yakin akan menghapus semua data peserta yang ada ?<br><br><?= $viewKeg['nama_keg'] . '<br>' . Indonesia2Tgl($viewKeg['tgl_mulai']) . ' s.d ' . Indonesia2Tgl($viewKeg['tgl_selesai']) ?></p>
                </div>
                <p></p>
                <div class="pt-2">
                    <div class="form-check">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="form-check-input" id="hapus_semua_peserta" name="cek">
                            <label class="form-check-label" for="hapus_semua_peserta">Saya yakin akan menghapus Data Peserta.</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <input type="hidden" value="<?= encrypt($id_keg) ?>" name="_token">
                <button type="submit" name="delAllParticipant" class="btn btn-info" id="hapusSemuaPeserta" disabled>Hapus</button>
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal" aria-label="Close">Batal</button>
            </div>
        </form>
        <script type="text/javascript">
            $('#hapus_semua_peserta').click(function() {
                if ($(this).is(':checked')) {

                    $('#hapusSemuaPeserta').removeAttr('disabled');

                } else {
                    $('#hapusSemuaPeserta').attr('disabled', true);
                }
            });
        </script>
<?php
    } else {
        echo ' <div class="modal-header">
                    <h3 class="modal-title" id="exampleModalLabel">Error</h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h2 class="text-center">Data Tidak Ditemukan</h2>
                </div>';
    }
} else {
    echo '<script type="text/javascript">
    window.location = "../../../../../"
    </script>';
}
?>