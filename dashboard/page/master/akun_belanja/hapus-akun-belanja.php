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
if (isset($_POST['id']) && isset($_POST['token'])) {
    $id = decrypt($_POST['id']);
    $token = decrypt($_POST['token']);
    $sql = mysqli_query($myConnection, "select * from tb_akun_belanja where id = '$id' and id_akun_belanja = '$token'");
    if (mysqli_num_rows($sql) > 0) {
        $belanja = mysqli_fetch_array($sql); ?>
        <form action="setShopping" method="post" role="form" enctype="multipart/form-data" autocomplete="off">
            <div class="modal-header">
                <h4><i class="mdi mdi-tag-edit-outline"></i> Hapus Akun Belanja</h4>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label">Kode Akun Belanja</label>
                    <input type="text" class="form-control" value="<?= $belanja['id_akun_belanja'] ?>" disabled required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Nama Akun Belanja</label>
                    <input type="text" class="form-control" value="<?= $belanja['nama_akun_belanja'] ?>" disabled required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Jenis Akun Belanja</label>
                    <input type="text" class="form-control" value="<?= $belanja['jenis'] ? 'Honor' : 'Transport' ?>" disabled required>
                </div>
                <small class="text-danger fw-bold">Note : Menghapus data akun belanja akan mempengaruhi data transaksi yang sudah tercatat.</small>

                <div class="mt-3">
                    <div class="form-check">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="form-check-input" id="del_akun_belanja" name="cek">
                            <label class="form-check-label" for="del_akun_belanja">Saya yakin akan menghapus <strong>Data Akun Belanja</strong>.</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <input type="hidden" value="<?= encrypt($belanja['id']) ?>" name="_token">
                <input type="hidden" value="<?= encrypt($belanja['id_akun_belanja']) ?>" name="_key">
                <button type="submit" name="delShopping" class="btn btn-info" id="delAkunBelanja" disabled>Hapus</button>
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal" aria-label="Close">Batal</button>
            </div>
        </form>
        <script type="text/javascript">
            $('#del_akun_belanja').click(function() {
                if ($(this).is(':checked')) {

                    $('#delAkunBelanja').removeAttr('disabled');

                } else {
                    $('#delAkunBelanja').attr('disabled', true);
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