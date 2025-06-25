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
        $viewPanitia = mysqli_fetch_array($sqlPanitia);
        $id_kabkota_unit_kerja = $viewPanitia['id_kabkota_unit_kerja'];
        $id_pangkat_gol = $viewPanitia['id_pangkat_gol'];
?>
        <style>
            /* .gj-picker .gj-picker-bootstrap .datepicker .gj-unselectable {
                top: 457px !important;
                left: 40px !important;
            } */
        </style>
        <form action="setDocumentHotel" method="post" role="form" enctype="multipart/form-data" autocomplete="off">
            <div class="modal-header">
                <h4><i class="bx bx-data"></i> Edit Panitia Eksternal</h4>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label">Nama</label>
                    <input type="text" class="form-control border border-secondary" value="<?= $viewPanitia['nama'] ?>" placeholder="Nama Lengkap Panitia" name="nama" id="nama">
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">NIP</label>
                            <input type="text" class="form-control border border-secondary" value="<?= $viewPanitia['nip'] ?>" placeholder="NIP Panitia" name="nip" id="nip">
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
                            <input type="text" class="form-control border border-secondary" value="<?= $viewPanitia['no_hp'] ?>" placeholder="No. HP" name="no_hp" id="no_hp">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Jabatan</label>
                            <input type="text" class="form-control border border-secondary" value="<?= $viewPanitia['jabatan'] ?>" placeholder="Jabatan di Unit Kerja" name="jabatan" id="jabatan">
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Unit Kerja</label>
                    <input type="text" class="form-control border border-secondary" value="<?= $viewPanitia['unit_kerja'] ?>" placeholder="Unit Kerja Panitia" name="unit_kerja" id="unit_kerja">
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Alamat Unit Kerja</label>
                            <textarea rows="3" class="form-control border border-secondary" placeholder="Alamat Lengkap Unit Kerja" name="alamat_unit_kerja"><?= $viewPanitia['alamat_unit_kerja'] ?></textarea>
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
                <div class="mb-3">
                    <label for="defaultSelect" class="form-label">Sebagai</label>
                    <select id="defaultSelect" class="form-select border border-secondary" name="jabatan_kegiatan" required>
                        <?php
                        if ($viewPanitia['id_jab_st'] == 1) {
                            echo '<option value="">Pilih Jabatan Kegiatan...</option>
                        <option value="' . encrypt(1) . '" selected>Penanggungjawab</option>
                        <option value="' . encrypt(3) . '">Ketua</option>
                        <option value="' . encrypt(12) . '">Anggota</option>';
                        } elseif ($viewPanitia['id_jab_st'] == 3) {
                            echo '<option value="">Pilih Jabatan Kegiatan...</option>
                        <option value="' . encrypt(1) . '" >Penanggungjawab</option>
                        <option value="' . encrypt(3) . '" selected>Ketua</option>
                        <option value="' . encrypt(12) . '">Anggota</option>';
                        } elseif ($viewPanitia['id_jab_st'] == 12) {
                            echo '<option value="">Pilih Jabatan Kegiatan...</option>
                            <option value="' . encrypt(1) . '" >Penanggungjawab</option>
                            <option value="' . encrypt(3) . '">Ketua</option>
                            <option value="' . encrypt(12) . '" selected>Anggota</option>';
                        } else {
                            echo '<option value="">Pilih Jabatan Kegiatan...</option>
                            <option value="' . encrypt(1) . '">Penanggungjawab</option>
                            <option value="' . encrypt(3) . '">Ketua</option>
                            <option value="' . encrypt(12) . '">Anggota</option>';
                        }
                        ?>
                    </select>
                </div>
                <div class="pt-2">
                    <div class="form-check">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="form-check-input" id="edit_panitia" name="cek">
                            <label class="form-check-label" for="edit_panitia">Saya yakin mengubah Data Panitia.</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <input type="hidden" value="<?= encrypt($id_keg) ?>" name="_token">
                <input type="hidden" value="<?= encrypt($id_panitia_keg_hotel) ?>" name="_id">
                <button type="submit" name="editCommitteeExternal" class="btn btn-info" id="editPanitia" disabled>Ubah</button>
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal" aria-label="Close">Batal</button>
            </div>
        </form>
        <script type="text/javascript">
            $('#kabkota_unitkerja_edit').selectpicker();
            $('#edit_panitia').click(function() {
                if ($(this).is(':checked')) {
                    $('#editPanitia').removeAttr('disabled');
                } else {
                    $('#editPanitia').attr('disabled', true);
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