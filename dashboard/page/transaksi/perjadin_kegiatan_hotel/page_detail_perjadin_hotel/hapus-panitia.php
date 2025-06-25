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
    $id_panitia_keg_hotel = decrypt($_POST['id']);
    $sqlPeserta = mysqli_query($myConnection, "select tb_panitia_keg_hotel.*, tb_kabkota.name as nama_kab
    from tb_panitia_keg_hotel
    left join tb_kabkota on tb_kabkota.id = tb_panitia_keg_hotel.id_kabkota_unit_kerja
    where tb_panitia_keg_hotel.id_keg = '$id_keg' and tb_panitia_keg_hotel.id_panitia_keg_hotel = '$id_panitia_keg_hotel'");
    if (mysqli_num_rows($sqlPeserta) > 0) {
        $viewPeserta = mysqli_fetch_array($sqlPeserta);
        $idKabKota = $viewPeserta['id_kabkota_unit_kerja'];
        $viewSBM = mysqli_fetch_array(mysqli_query($myConnection, "select besaran from tb_kabkota where id = '$idKabKota'"));
?>
        <form action="setDocumentHotel" method="post" role="form" enctype="multipart/form-data" autocomplete="off">

            <div class="modal-body">
                <h4><i class="bx bx-data"></i> Hapus Data Panitia</h4>
                <div class="mb-2 fw-bold">
                    <p><?= $viewPeserta['nama'] . '<br>' . $viewPeserta['unit_kerja'] . '<br>' . str_replace(["Kabupaten ", "Kota "], ["Kab. ", "Kota "], ucwords($viewPeserta['nama_kab'])) . '</span>' ?></p>
                </div>
                <div class="pt-2">
                    <div class="form-check">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="form-check-input" id="del_panitia" name="cek">
                            <label class="form-check-label" for="del_panitia">Saya yakin menghapus Panitia.</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <input type="hidden" value="<?= encrypt($id_keg) ?>" name="_token">
                <input type="hidden" value="<?= encrypt($id_panitia_keg_hotel) ?>" name="_id">
                <button type="submit" name="delCommittee" class="btn btn-info" id="delPanitia" disabled>Hapus</button>
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal" aria-label="Close">Batal</button>
            </div>
        </form>
        <script type="text/javascript">
            $('#del_panitia').click(function() {
                if ($(this).is(':checked')) {

                    $('#delPanitia').removeAttr('disabled');

                } else {
                    $('#delPanitia').attr('disabled', true);
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