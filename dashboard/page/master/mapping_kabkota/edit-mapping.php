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
}
if (isset($_POST['id'])) {
    $id = decrypt($_POST['id']);
    $sql = mysqli_query($myConnection, "select * from tb_kabkota where id = '$id'");
    if (mysqli_num_rows($sql) > 0) {
        $wil = mysqli_fetch_array($sql); ?>
        <form action="setMapping" method="post" role="form" enctype="multipart/form-data" autocomplete="off">
            <div class="modal-header">
                <h4><i class="bx bx-map"></i> Edit Mapping Wilayah</h4>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label">Nama Provinsi</label>
                    <input type="text" class="form-control" value="Jawa Timur" readonly>
                </div>
                <div class="mb-3">
                    <label class="form-label">Nama Kab / Kota</label>
                    <input type="text" class="form-control" value="<?= ucwords($wil['name']) ?>" aria-describedby="defaultFormControlHelp" readonly>
                </div>
                <div class="mb-3">
                    <label class="form-label">Wilayah</label>
                    <select name="wilayah" class="form-select" id="">
                        <option value="" disabled selected>Pilih Wilayah</option>
                        <?php
                        $sqlWil = mysqli_query($myConnection, "select * from tb_mapping_wilayah");
                        while ($viewWil = mysqli_fetch_array($sqlWil)) {
                            $id_wil = $wil['mapping'];
                            $select = $viewWil['id'] == $id_wil ? 'selected' : '';
                            echo '<option value="' . encrypt($viewWil['id']) . '" ' . $select . '>' . $viewWil['wilayah'] . '</option>';
                        }
                        ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Besaran Biaya</label>
                    <small class="text-danger"><i>*dihitung dari Kota Surabaya</i></small>
                    <input type="number" class="form-control" name="besaran" value="<?= ucwords($wil['besaran']) ?>" aria-describedby="defaultFormControlHelp">
                </div>
                <div class="">
                    <div class="form-check">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="form-check-input" id="editWil" name="cek">
                            <label class="form-check-label" for="editWil">Saya yakin akan melakukan perubahan <strong>Data Mapping Wilayah</strong>.</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <input type="hidden" value="<?= encrypt($wil['id']) ?>" name="_token">
                <button type="submit" name="updateMapping" class="btn btn-info" id="updateWil" disabled>Update</button>
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal" aria-label="Close">Batal</button>
            </div>
        </form>
        <script type="text/javascript">
            $('#editWil').click(function() {
                if ($(this).is(':checked')) {

                    $('#updateWil').removeAttr('disabled');

                } else {
                    $('#updateWil').attr('disabled', true);
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