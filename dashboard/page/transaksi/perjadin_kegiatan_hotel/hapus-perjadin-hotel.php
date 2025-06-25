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
    $sql = mysqli_query($myConnection, "select * from tb_kegiatan where  id_keg = '$id'");
    if (mysqli_num_rows($sql) > 0) {
        $peg = mysqli_fetch_array($sql); ?>
        <form action="setDocumentHotel" method="post" role="form" enctype="multipart/form-data" autocomplete="off">
            <div class="modal-header">
                <h4><i class="bx bx-folder-plus"></i> Hapus Dokumen SPJ Hotel</h4>
            </div>
            <div class="modal-body">
                <p>Apakah anda yakin akan menghapus kegiatan <strong><?= $peg['nama_keg'] ?></strong></p>

                <div class="">
                    <div class="form-check">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="form-check-input" id="hapus_akun" name="cek">
                            <label class="form-check-label" for="hapus_akun">Saya yakin akan menghapus <strong>Data Kegiatan ini</strong>.</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <input type="hidden" value="<?= encrypt($id) ?>" name="_token">
                <button type="submit" name="delDocumentHotel" class="btn btn-info" id="delAkun" disabled>Hapus</button>
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal" aria-label="Close">Batal</button>
            </div>
        </form>
        <script type="text/javascript">
            $(document).ready(function() {
                $('#guru_karyawan').selectpicker();
            });
            $('#hapus_akun').click(function() {
                if ($(this).is(':checked')) {

                    $('#delAkun').removeAttr('disabled');

                } else {
                    $('#delAkun').attr('disabled', true);
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