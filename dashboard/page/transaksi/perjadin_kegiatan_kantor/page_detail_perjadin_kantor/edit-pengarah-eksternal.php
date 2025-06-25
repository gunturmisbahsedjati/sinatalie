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
    $id_pengarah_keg_kantor = decrypt($_POST['id']);
    $sqlPengarah = mysqli_query($myConnection, "select tb_pengarah_keg_kantor.*, tb_kabkota.name as nama_kab
    from tb_pengarah_keg_kantor
    left join tb_kabkota on tb_kabkota.id = tb_pengarah_keg_kantor.id_kabkota_unit_kerja
    where tb_pengarah_keg_kantor.id_keg = '$id_keg' and tb_pengarah_keg_kantor.id_pengarah_keg_kantor = '$id_pengarah_keg_kantor'");
    if (mysqli_num_rows($sqlPengarah) > 0) {
        $viewPengarah = mysqli_fetch_array($sqlPengarah);
        $id_kabkota_unit_kerja = $viewPengarah['id_kabkota_unit_kerja'];
        $id_pangkat_gol = $viewPengarah['id_pangkat_gol'];
?>
        <form action="setDocumentOffice" method="post" role="form" enctype="multipart/form-data" autocomplete="off">

            <div class="modal-body">
                <h4><i class="bx bx-data"></i> Edit Data Narasumber</h4>
                <div class="mb-3">
                    <label class="form-label">Nama</label>
                    <input type="text" class="form-control border border-secondary" value="<?= $viewPengarah['nama'] ?>" placeholder="Nama Lengkap Narasumber" name="nama" id="nama">
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">NIP</label>
                            <input type="text" class="form-control border border-secondary" value="<?= $viewPengarah['nip'] ?>" placeholder="NIP Narasumber" name="nip" id="nip">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Pangkat/Gol</label>
                            <select name="pangkat" id="pangkat" class="form-select border border-secondary">
                                <option value="">Pilih Salah Satu....</option>
                                <?php
                                $sqlPangkat = mysqli_query($myConnection, "select * from tb_gol_pajak");
                                while ($viewPangkat = mysqli_fetch_array($sqlPangkat)) {
                                    $selected = $viewPangkat['id_pangkat'] == $id_pangkat_gol ? 'selected' : '';
                                    echo '<option value="' . encrypt($viewPangkat['id_pangkat']) . '" ' . $selected . '>' . $viewPangkat['jabatan_struktural'] . ' - ' . $viewPangkat['gol'] . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">No. HP</label>
                            <input type="text" class="form-control border border-secondary" value="<?= $viewPengarah['no_hp'] ?>" placeholder="No. HP" name="no_hp" id="no_hp">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Jabatan</label>
                            <input type="text" class="form-control border border-secondary" value="<?= $viewPengarah['jabatan'] ?>" placeholder="Jabatan di Unit Kerja" name="jabatan" id="jabatan">
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Unit Kerja</label>
                    <input type="text" class="form-control border border-secondary" value="<?= $viewPengarah['unit_kerja'] ?>" placeholder="Unit Kerja Narasumber" name="unit_kerja" id="unit_kerja">
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Alamat Unit Kerja</label>
                            <textarea rows="3" class="form-control border border-secondary" placeholder="Alamat Lengkap Unit Kerja" name="alamat_unit_kerja"><?= $viewPengarah['alamat_unit_kerja'] ?></textarea>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Kab/Kota Unit Kerja</label>
                            <select class="form-control border border-secondary" title="Pilih Salah Satu...." data-live-search="true" data-size="5" id="kabkota_unitkerja_edit" name="kabkota_unitkerja">
                                <?php
                                $sqlKabkota = mysqli_query($myConnection, "select tb_kabkota.*, tb_provinsi.name as provinsi from tb_kabkota left join tb_provinsi on tb_provinsi.id = tb_kabkota.province_id");
                                while ($viewKabkota = mysqli_fetch_array($sqlKabkota)) {
                                    $selected = $viewKabkota['id'] == $id_kabkota_unit_kerja ? 'selected' : '';
                                    echo '<option data-subtext="' . $viewKabkota['provinsi'] . '" value="' . $viewKabkota['id'] . '" ' . $selected . '>' . str_replace('Kabupaten', 'Kab.', ucwords($viewKabkota['name'])) . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="pt-2">
                    <div class="form-check">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="form-check-input" id="edit_pengarah" name="cek">
                            <label class="form-check-label" for="edit_pengarah">Saya yakin mengubah Data Narasumber.</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <input type="hidden" value="<?= encrypt($id_keg) ?>" name="_token">
                <input type="hidden" value="<?= encrypt($id_pengarah_keg_kantor) ?>" name="_id">
                <button type="submit" name="editDirectorExternalOffice" class="btn btn-info" id="editPengarah" disabled>Ubah</button>
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal" aria-label="Close">Batal</button>
            </div>
        </form>
        <script type="text/javascript">
            $('#kabkota_unitkerja_edit').selectpicker();
            $('#edit_pengarah').click(function() {
                if ($(this).is(':checked')) {

                    $('#editPengarah').removeAttr('disabled');

                } else {
                    $('#editPengarah').attr('disabled', true);
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