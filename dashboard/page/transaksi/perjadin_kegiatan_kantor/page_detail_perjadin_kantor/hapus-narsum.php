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
if (isset($_POST['id']) && isset($_POST['token'])) {
    $id_keg = decrypt($_POST['token']);
    $id_narsum_keg_kantor = decrypt($_POST['id']);
    $sqlPeserta = mysqli_query($myConnection, "select tb_narsum_keg_kantor.*, tb_kabkota.name as nama_kab
    from tb_narsum_keg_kantor
    left join tb_kabkota on tb_kabkota.id = tb_narsum_keg_kantor.id_kabkota_unit_kerja
    where tb_narsum_keg_kantor.id_keg = '$id_keg' and tb_narsum_keg_kantor.id_narsum_keg_kantor = '$id_narsum_keg_kantor'");
    if (mysqli_num_rows($sqlPeserta) > 0) {
        $viewPeserta = mysqli_fetch_array($sqlPeserta);
        $idKabKota = $viewPeserta['id_kabkota_unit_kerja'];
        $viewSBM = mysqli_fetch_array(mysqli_query($myConnection, "select besaran from tb_kabkota where id = '$idKabKota'"));
?>
        <form action="setDocumentOffice" method="post" role="form" enctype="multipart/form-data" autocomplete="off">

            <div class="modal-body">
                <h4><i class="bx bx-data"></i> Hapus Data Narasumber</h4>
                <div class="mb-2 fw-bold">
                    <p><?= $viewPeserta['nama'] . '<br>' . $viewPeserta['unit_kerja'] . '<br>' . str_replace(["Kabupaten ", "Kota "], ["Kab. ", "Kota "], ucwords($viewPeserta['nama_kab'])) . '</span>' ?></p>
                </div>
                <div class="pt-2">
                    <div class="form-check">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="form-check-input" id="del_narsum" name="cek">
                            <label class="form-check-label" for="del_narsum">Saya yakin menghapus Peserta.</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <input type="hidden" value="<?= encrypt($id_keg) ?>" name="_token">
                <input type="hidden" value="<?= encrypt($id_narsum_keg_kantor) ?>" name="_id">
                <button type="submit" name="delInformantOffice" class="btn btn-info" id="delNarsum" disabled>Hapus</button>
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal" aria-label="Close">Batal</button>
            </div>
        </form>
        <script type="text/javascript">
            $('#del_narsum').click(function() {
                if ($(this).is(':checked')) {

                    $('#delNarsum').removeAttr('disabled');

                } else {
                    $('#delNarsum').attr('disabled', true);
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