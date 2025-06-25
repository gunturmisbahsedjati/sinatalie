<?php
session_start();
include_once '../../../../inc/inc.koneksi.php';
include_once '../../../../inc/inc.library.php';
if (empty($_SESSION['username'])) {
    echo '<script type="text/javascript">
    window.location = "../../../../../"
    </script>';
    exit;
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
} ?>
<form action="setMapping" method="post" role="form" enctype="multipart/form-data" autocomplete="off">
    <div class="modal-header">
        <h4><i class="bx bx-map"></i> Sinkron Data Mapping Wilayah</h4>
    </div>
    <div class="modal-body">
        <h4>Apakah Anda yakin akan melakukan sinkronisasi <strong>Data Mapping Wilayah</strong> dengan DataBase SINADIN ?</h4>
        <div class="">
            <div class="form-check">
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="form-check-input" id="editMapWil" name="cek">
                    <label class="form-check-label" for="editMapWil">Saya yakin akan melakukan perubahan <strong>Data Mapping Wilayah</strong>.</label>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <input type="hidden" value="<?= encrypt('from') ?>" name="_token">
        <button type="submit" name="syncMapping" class="btn btn-info" id="updateMapWil" disabled>Sinkron</button>
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal" aria-label="Close">Batal</button>
    </div>
</form>
<script type="text/javascript">
    $('#editMapWil').click(function() {
        if ($(this).is(':checked')) {

            $('#updateMapWil').removeAttr('disabled');

        } else {
            $('#updateMapWil').attr('disabled', true);
        }
    });
</script>