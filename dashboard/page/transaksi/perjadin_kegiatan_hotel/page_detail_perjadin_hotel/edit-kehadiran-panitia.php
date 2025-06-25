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
    $sqlPanitia = mysqli_query($myConnection, "select tb_panitia_keg_hotel.*, tb_kabkota.name as nama_kab
    from tb_panitia_keg_hotel
    left join tb_kabkota on tb_kabkota.id = tb_panitia_keg_hotel.id_kabkota_unit_kerja
    where tb_panitia_keg_hotel.id_keg = '$id_keg' and tb_panitia_keg_hotel.id_panitia_keg_hotel = '$id_panitia_keg_hotel'");
    if (mysqli_num_rows($sqlPanitia) > 0) {
        $viewPengarah = mysqli_fetch_array($sqlPanitia);
        $idKabKota = $viewPengarah['id_kabkota_unit_kerja'];
        $arrayKepulauan = [3529, 3525];
        $pulau = in_array($idKabKota, $arrayKepulauan) ? true : false;
        $viewSBM = mysqli_fetch_array(mysqli_query($myConnection, "select besaran from tb_kabkota where id = '$idKabKota'"));
?>
        <form action="setDocumentHotel" method="post" role="form" enctype="multipart/form-data" autocomplete="off">

            <div class="modal-body">
                <h4><i class="bx bx-data"></i> Edit Kehadiran Panitia</h4>
                <div class="mb-2 fw-bold">
                    <p><?= $viewPengarah['nama'] . '<br>' . $viewPengarah['unit_kerja'] . '<br>' . str_replace(["Kabupaten ", "Kota "], ["Kab. ", "Kota "], ucwords($viewPengarah['nama_kab'])) ?></p>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Tanggal Awal</label>
                            <input class="form-control border border-secondary" id="tgl_mulai_pengarah_input" placeholder="dd-mm-yyyy" name="tgl_mulai" value="<?= $viewPengarah['tgl_mulai'] == '' || $viewPengarah['tgl_mulai'] == '0000-00-00' ? '' : tanggal($viewPengarah['tgl_mulai']); ?>">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Tanggal Akhir</label>
                            <input class="form-control border border-secondary" id="tgl_selesai_pengarah_input" placeholder="dd-mm-yyyy" name="tgl_selesai" value="<?= $viewPengarah['tgl_selesai'] == '' || $viewPengarah['tgl_selesai'] == '0000-00-00' ? '' : tanggal($viewPengarah['tgl_selesai']); ?>">
                        </div>
                    </div>
                </div>
                <div class="mb-3 col-md-3">
                    <label class="form-label">Jumlah Jam</label>
                    <input type="number" class="form-control border border-secondary" placeholder="ex. 1" name="jml_jam" id="jml_jam" value="<?= $viewPengarah['jml_jam'] ?>">
                </div>
                <div class="pt-2">
                    <div class="form-check">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="form-check-input" id="kehadiran_panitia" name="cek">
                            <label class="form-check-label" for="kehadiran_panitia">Saya yakin Data Kehadiran sudah benar.</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <input type="hidden" value="<?= encrypt($id_keg) ?>" name="_token">
                <input type="hidden" value="<?= encrypt($id_panitia_keg_hotel) ?>" name="_id">
                <button type="submit" name="editAttendanceCommittee" class="btn btn-info" id="kehadiranPanitia" disabled>Simpan</button>
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal" aria-label="Close">Batal</button>
            </div>
        </form>
        <script type="text/javascript">
            $('#tgl_mulai_pengarah_input').datepicker({
                uiLibrary: 'bootstrap5',
                format: 'dd-mm-yyyy'
            });
            $('#tgl_selesai_pengarah_input').datepicker({
                uiLibrary: 'bootstrap5',
                format: 'dd-mm-yyyy'
            });
            $('#kehadiran_panitia').click(function() {
                if ($(this).is(':checked')) {

                    $('#kehadiranPanitia').removeAttr('disabled');

                } else {
                    $('#kehadiranPanitia').attr('disabled', true);
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