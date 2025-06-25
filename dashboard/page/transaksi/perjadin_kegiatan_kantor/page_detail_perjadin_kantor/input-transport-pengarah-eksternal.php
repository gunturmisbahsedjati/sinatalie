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
    where tb_pengarah_keg_kantor.id_keg = '$id_keg' and tb_pengarah_keg_kantor.id_pengarah_keg_kantor = '$id_pengarah_keg_kantor' and tb_pengarah_keg_kantor.jenis_pengarah = 'eksternal'");
    if (mysqli_num_rows($sqlPengarah) > 0) {
        $viewPengarah = mysqli_fetch_array($sqlPengarah);
        $idKabKota = $viewPengarah['id_kabkota_unit_kerja'];
        $arrayKepulauan = [3529, 3525];
        $pulau = in_array($idKabKota, $arrayKepulauan) ? true : false;
        $viewSBM = mysqli_fetch_array(mysqli_query($myConnection, "select besaran from tb_kabkota where id = '$idKabKota'"));
?>
        <form action="setDocumentOffice" method="post" role="form" enctype="multipart/form-data" autocomplete="off">

            <div class="modal-body">
                <h4><i class="bx bx-data"></i> Input Transport Pengarah Eksternal</h4>
                <div class="mb-2 fw-bold">
                    <p><?= $viewPengarah['nama'] . '<br>' . $viewPengarah['unit_kerja'] . '<br>' . str_replace(["Kabupaten ", "Kota "], ["Kab. ", "Kota "], ucwords($viewPengarah['nama_kab'])) . '<br> SBM Kota Surabaya - ' . str_replace(["Kabupaten ", "Kota "], ["Kab. ", "Kota "], ucwords($viewPengarah['nama_kab'])) . ' : <span class="text-primary">' . format_angka($viewSBM['besaran'] * 2) . '</span>' ?></p>
                </div>
                <div class="row">
                    <span class="fw-bold">Kehadiran</span>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label class="form-label">Tanggal Awal</label>
                            <input class="form-control border border-secondary" id="tgl_mulai_pengarah_input" placeholder="dd-mm-yyyy" name="tgl_mulai" value="<?= $viewPengarah['tgl_mulai'] == '' || $viewPengarah['tgl_mulai'] == '0000-00-00' ? '' : tanggal($viewPengarah['tgl_mulai']); ?>">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label class="form-label">Tanggal Akhir</label>
                            <input class="form-control border border-secondary" id="tgl_selesai_pengarah_input" placeholder="dd-mm-yyyy" name="tgl_selesai" value="<?= $viewPengarah['tgl_selesai'] == '' || $viewPengarah['tgl_selesai'] == '0000-00-00' ? '' : tanggal($viewPengarah['tgl_selesai']); ?>">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label class="form-label">Jumlah Jam Mengisi</label>
                            <input type="number" class="form-control border border-secondary" placeholder="ex. 1" name="jml_jam" id="jml_jam" value="<?= $viewPengarah['jml_jam'] ?>">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label class="form-label">Tiket Pesawat</label>
                            <input type="number" class="form-control border border-secondary" placeholder="ex. 410000" name="tiket_pesawat" id="tiket_pesawat" value="<?= $viewPengarah['tiket_pesawat'] ?>">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label class="form-label">Tiket Kapal</label>
                            <input type="number" class="form-control border border-secondary" placeholder="ex. 410000" name="tiket_kapal" id="tiket_kapal" value="<?= $viewPengarah['tiket_kapal'] ?>">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label class="form-label">Tiket</label>
                            <input type="number" class="form-control border border-secondary" placeholder="ex. 410000" name="tiket" id="tiket" value="<?= $viewPengarah['tiket'] ?>">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label class="form-label">Transport Lokal</label>
                            <input type="number" class="form-control border border-secondary" placeholder="ex. 410000" name="lokal" id="lokal" value="<?= $viewPengarah['lokal'] ?>">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label class="form-label">Taksi/Grab/Gojek</label>
                            <input type="number" class="form-control border border-secondary" placeholder="ex. 410000" name="taksi" id="taksi" value="<?= $viewPengarah['taksi'] ?>">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label class="form-label">Toll</label>
                            <input type="number" class="form-control border border-secondary" placeholder="ex. 410000" name="toll" id="toll" value="<?= $viewPengarah['toll'] ?>">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label class="form-label">BBM</label>
                            <input type="number" class="form-control border border-secondary" placeholder="ex. 410000" name="bbm" id="bbm" value="<?= $viewPengarah['bbm'] ?>">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label class="form-label">DPR 1</label>
                            <input type="number" class="form-control border border-secondary" placeholder="ex. 410000" name="dpr1" id="dpr1" value="<?= $viewPengarah['dpr1'] ?>">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label class="form-label">DPR 2</label>
                            <input type="number" class="form-control border border-secondary" placeholder="ex. 410000" name="dpr2" id="dpr2" value="<?= $viewPengarah['dpr2'] ?>">
                        </div>
                    </div>
                </div>
                <?php
                if ($pulau) {
                    if ($viewPengarah['status_kabkota_unit_kerja'] == "Kepulauan") {
                        echo '<div class="mb-3">
                                <label class="form-label">Status Lokasi Unit Kerja</label>
                                <select class="form-select border border-secondary" name="status_kabkota_unit_kerja" required>
                                    <option value="">Pilih Status Lokasi</option>
                                    <option value="Kepulauan" selected>Kepulauan</option>
                                    <option value="Daratan">Daratan</option>
                                </select>
                            </div>';
                    } elseif ($viewPengarah['status_kabkota_unit_kerja'] == "Daratan") {
                        echo '<div class="mb-3">
                                <label class="form-label">Status Lokasi Unit Kerja</label>
                                <select class="form-select border border-secondary" name="status_kabkota_unit_kerja" required>
                                    <option value="">Pilih Status Lokasi</option>
                                    <option value="Kepulauan">Kepulauan</option>
                                    <option value="Daratan" selected>Daratan</option>
                                </select>
                            </div>';
                    } else {
                        echo '<div class="mb-3">
                        <label class="form-label">Status Lokasi Unit Kerja</label>
                        <select class="form-select border border-secondary" name="status_kabkota_unit_kerja" required>
                            <option value="">Pilih Status Lokasi</option>
                            <option value="Kepulauan">Kepulauan</option>
                            <option value="Daratan">Daratan</option>
                        </select>
                    </div>';
                    }
                } else {
                    echo '<input type="hidden" value="Daratan" name="status_kabkota_unit_kerja">';
                }
                ?>
                <div class="pt-2">
                    <div class="form-check">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="form-check-input" id="input_transpor_pengarah" name="cek">
                            <label class="form-check-label" for="input_transpor_pengarah">Saya yakin Data Keuangan sudah benar.</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <input type="hidden" value="<?= encrypt($id_keg) ?>" name="_token">
                <input type="hidden" value="<?= encrypt($id_pengarah_keg_kantor) ?>" name="_id">
                <button type="submit" name="inputDirectorTransportOffice" class="btn btn-info" id="inputTransportPengarah" disabled>Simpan</button>
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
            $('#input_transpor_pengarah').click(function() {
                if ($(this).is(':checked')) {

                    $('#inputTransportPengarah').removeAttr('disabled');

                } else {
                    $('#inputTransportPengarah').attr('disabled', true);
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