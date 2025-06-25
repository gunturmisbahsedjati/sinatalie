<?php
session_start();
include_once '../../../../inc/inc.koneksi.php';
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
    $id = decrypt($_POST['id']);
    $status = decrypt($_POST['status']);
    $sql = mysqli_query($myConnection, "select * from tb_kegiatan where soft_delete = 0 and id_keg = '$id'");
    if (mysqli_num_rows($sql) > 0) {
        $peg = mysqli_fetch_array($sql); ?>
        <form action="setDocumentOffice" method="post" role="form" enctype="multipart/form-data" autocomplete="off">
            <div class="modal-header">
                <h4><i class='bx bx-message-rounded-check'></i> Update Status</h4>
            </div>
            <div class="modal-body">
                <?php
                if ($status == 0) {
                    echo "<h5>Anda yakin akan mengakhiri kegiatan ini ?</h5>";
                } elseif ($status == 1) {
                    echo "<h5>Anda yakin akan mengaktifkan kegiatan ini ?</h5>";
                }
                ?>

                <div class="">
                    <div class="form-check">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="form-check-input" id="status_tahun" name="cek">
                            <label class="form-check-label" for="status_tahun">Saya yakin akan melakukan perubahan.</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <input type="hidden" name="_token" value="<?= $_POST['id'] ?>">
                <input type="hidden" name="_key" value="<?= $_POST['status'] ?>">
                <button type="submit" name="documentOfficeStatus" class="btn btn-info" id="update_thn" disabled>Update</button>
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal" aria-label="Close">Batal</button>
            </div>
        </form>
        <script type="text/javascript">
            $('#status_tahun').click(function() {
                if ($(this).is(':checked')) {

                    $('#update_thn').removeAttr('disabled');

                } else {
                    $('#update_thn').attr('disabled', true);
                }
            });
        </script>
    <?php } else { ?>
        <div class="modal-header">
            <h3 class="modal-title" id="exampleModalLabel">Error</h3>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <h2 class="text-center">Data Tidak Ditemukan</h2>
        </div>
<?php }
} else {
    echo '<script type="text/javascript">
    window.location = "../"
    </script>';
} ?>