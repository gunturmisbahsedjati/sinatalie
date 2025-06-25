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
?>
<form action="setShopping" method="post" role="form" enctype="multipart/form-data" autocomplete="off">
    <div class="modal-header">
        <h4><i class="mdi mdi-plus-box-outline"></i> Tambah Akun Belanja</h4>
    </div>
    <div class="modal-body">
        <div class="mb-3">
            <label class="form-label">Kode Akun Belanja</label>
            <input type="text" class="form-control" placeholder="contoh. 521211" name="id_akun_belanja" aria-describedby="defaultFormControlHelp" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Nama Akun Belanja</label>
            <input type="text" class="form-control" placeholder="contoh. Belanja Bahan" name="nama_akun_belanja" aria-describedby="defaultFormControlHelp" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Jenis Akun Belanja</label>
            <select class="form-select" name="jenis" id="exampleFormControlSelect1" required>
                <option value="">Pilih salah satu...</option>
                <option value="1">HONOR</option>
                <option value="2">TRANSPORT</option>
            </select>
        </div>
    </div>
    <div class="modal-footer">
        <button type="submit" name="addShopping" class="btn btn-success">Simpan</button>
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal" aria-label="Close">Batal</button>
    </div>
</form>