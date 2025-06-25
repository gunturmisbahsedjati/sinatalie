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
    $id_narsum_keg_hotel = decrypt($_POST['id']);
    $sqlNarsum = mysqli_query($myConnection, "select tb_narsum_keg_hotel.*, tb_kabkota.name as nama_kab
    from tb_narsum_keg_hotel
    left join tb_kabkota on tb_kabkota.id = tb_narsum_keg_hotel.id_kabkota_unit_kerja
    where tb_narsum_keg_hotel.id_keg = '$id_keg' and tb_narsum_keg_hotel.id_narsum_keg_hotel = '$id_narsum_keg_hotel' and tb_narsum_keg_hotel.jenis_narsum = 'eksternal'");
    if (mysqli_num_rows($sqlNarsum) > 0) {
        $viewNarsum = mysqli_fetch_array($sqlNarsum);
        $idKabKota = $viewNarsum['id_kabkota_unit_kerja'];
        $arrayKepulauan = [3529, 3525];
        $pulau = in_array($idKabKota, $arrayKepulauan) ? true : false;
        $viewSBM = mysqli_fetch_array(mysqli_query($myConnection, "select besaran from tb_kabkota where id = '$idKabKota'"));
        $viewNarsum['bbm'] = $viewNarsum['bbm'] == '' ? '' : number_format($viewNarsum['bbm'], 0);
        $viewNarsum['tiket_pesawat'] = $viewNarsum['tiket_pesawat'] == '' ? '' :  number_format($viewNarsum['tiket_pesawat'], 0);
        $viewNarsum['tiket'] = $viewNarsum['tiket'] == '' ? '' :  number_format($viewNarsum['tiket'], 0);
        $viewNarsum['tiket_kapal'] = $viewNarsum['tiket_kapal'] == '' ? '' :  number_format($viewNarsum['tiket_kapal'], 0);
        $viewNarsum['lokal'] = $viewNarsum['lokal'] == '' ? '' :   number_format($viewNarsum['lokal'], 0);
        $viewNarsum['lokal_jakarta'] = $viewNarsum['lokal_jakarta'] == '' ? '' :   number_format($viewNarsum['lokal_jakarta'], 0);
        $viewNarsum['taksi'] = $viewNarsum['taksi'] == '' ? '' :  number_format($viewNarsum['taksi'], 0);
        $viewNarsum['toll'] = $viewNarsum['toll'] == '' ? '' :  number_format($viewNarsum['toll'], 0);
        $viewNarsum['dpr1'] = $viewNarsum['dpr1'] == '' ? '' :  number_format($viewNarsum['dpr1'], 0);
?>
        <form action="setDocumentHotel" method="post" role="form" enctype="multipart/form-data" autocomplete="off">

            <div class="modal-body">
                <h4><i class="bx bx-data"></i> Input Transport Narasumber</h4>
                <div class="mb-2 fw-bold">
                    <p><?= $viewNarsum['nama'] . '<br>' . $viewNarsum['unit_kerja'] . '<br>' . str_replace(["Kabupaten ", "Kota "], ["Kab. ", "Kota "], ucwords($viewNarsum['nama_kab'])) . '<br> SBM Kota Surabaya - ' . str_replace(["Kabupaten ", "Kota "], ["Kab. ", "Kota "], ucwords($viewNarsum['nama_kab'])) . ' : <span class="text-primary">' . format_angka($viewSBM['besaran'] * 2) . '</span>' ?></p>
                </div>
                <div class="row">
                    <span class="fw-bold">Kehadiran</span>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label class="form-label">Tanggal Awal</label>
                            <input class="form-control border border-secondary" id="tgl_mulai_narsum_input" placeholder="dd-mm-yyyy" name="tgl_mulai" value="<?= $viewNarsum['tgl_mulai'] == '' || $viewNarsum['tgl_mulai'] == '0000-00-00' ? '' : tanggal($viewNarsum['tgl_mulai']); ?>">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label class="form-label">Tanggal Akhir</label>
                            <input class="form-control border border-secondary" id="tgl_selesai_narsum_input" placeholder="dd-mm-yyyy" name="tgl_selesai" value="<?= $viewNarsum['tgl_selesai'] == '' || $viewNarsum['tgl_selesai'] == '0000-00-00' ? '' : tanggal($viewNarsum['tgl_selesai']); ?>">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label class="form-label">Jumlah Jam Mengajar</label>
                            <input type="number" class="form-control border border-secondary" placeholder="ex. 1" name="jml_jam" id="jml_jam" value="<?= $viewNarsum['jml_jam'] ?>">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label class="form-label">Tiket Pesawat</label>
                            <input type="text" oninput="seprator(this)" step="any" class="form-control border border-secondary" placeholder="ex. 410000" name="tiket_pesawat" id="tiket_pesawat" value="<?= $viewNarsum['tiket_pesawat'] ?>">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label class="form-label">Tiket Kapal</label>
                            <input type="text" oninput="seprator(this)" step="any" class="form-control border border-secondary" placeholder="ex. 410000" name="tiket_kapal" id="tiket_kapal" value="<?= $viewNarsum['tiket_kapal'] ?>">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label class="form-label">Tiket</label>
                            <input type="text" oninput="seprator(this)" step="any" class="form-control border border-secondary" placeholder="ex. 410000" name="tiket" id="tiket" value="<?= $viewNarsum['tiket'] ?>">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label class="form-label">Transport Lokal</label>
                            <input type="text" oninput="seprator(this)" step="any" class="form-control border border-secondary" placeholder="ex. 410000" name="lokal" id="lokal" value="<?= $viewNarsum['lokal'] ?>">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label class="form-label">Transport Lokal Jakarta</label>
                            <input type="text" oninput="seprator(this)" step="any" class="form-control border border-secondary" placeholder="ex. 410000" name="lokal_jakarta" id="lokal_jakarta" value="<?= $viewNarsum['lokal_jakarta'] ?>">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label class="form-label">Taksi/Grab/Gojek</label>
                            <input type="text" oninput="seprator(this)" step="any" class="form-control border border-secondary" placeholder="ex. 410000" name="taksi" id="taksi" value="<?= $viewNarsum['taksi'] ?>">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label class="form-label">Toll</label>
                            <input type="text" oninput="seprator(this)" step="any" class="form-control border border-secondary" placeholder="ex. 410000" name="toll" id="toll" value="<?= $viewNarsum['toll'] ?>">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label class="form-label">BBM</label>
                            <input type="text" oninput="seprator(this)" step="any" class="form-control border border-secondary" placeholder="ex. 410000" name="bbm" id="bbm" value="<?= $viewNarsum['bbm'] ?>">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label class="form-label">DPR</label>
                            <input type="text" oninput="seprator(this)" step="any" class="form-control border border-secondary" placeholder="ex. 410000" name="dpr1" id="dpr1" value="<?= $viewNarsum['dpr1'] ?>">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label class="form-label">Penginapan</label>
                            <input type="text" oninput="seprator(this)" step="any" class="form-control border border-secondary" placeholder="ex. 410000" name="penginapan" id="penginapan" value="<?= $viewNarsum['penginapan'] ?>">
                        </div>
                    </div>
                </div>
                <?php
                if ($pulau) {
                    if ($viewNarsum['status_kabkota_unit_kerja'] == "Kepulauan") {
                        echo '<div class="mb-3">
                                <label class="form-label">Status Lokasi Unit Kerja</label>
                                <select class="form-select border border-secondary" name="status_kabkota_unit_kerja" required>
                                    <option value="">Pilih Status Lokasi</option>
                                    <option value="Kepulauan" selected>Kepulauan</option>
                                    <option value="Daratan">Daratan</option>
                                </select>
                            </div>';
                    } elseif ($viewNarsum['status_kabkota_unit_kerja'] == "Daratan") {
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
                            <input type="checkbox" class="form-check-input" id="input_transpor_narsum" name="cek">
                            <label class="form-check-label" for="input_transpor_narsum">Saya yakin Data Keuangan sudah benar.</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <input type="hidden" value="<?= encrypt($id_keg) ?>" name="_token">
                <input type="hidden" value="<?= encrypt($id_narsum_keg_hotel) ?>" name="_id">
                <button type="submit" name="inputTransportInformant" class="btn btn-info" id="inputTransportNarsum" disabled>Simpan</button>
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal" aria-label="Close">Batal</button>
            </div>
        </form>
        <script type="text/javascript">
            $('#tgl_mulai_narsum_input').datepicker({
                uiLibrary: 'bootstrap5',
                format: 'dd-mm-yyyy'
            });
            $('#tgl_selesai_narsum_input').datepicker({
                uiLibrary: 'bootstrap5',
                format: 'dd-mm-yyyy'
            });
            $('#input_transpor_narsum').click(function() {
                if ($(this).is(':checked')) {

                    $('#inputTransportNarsum').removeAttr('disabled');

                } else {
                    $('#inputTransportNarsum').attr('disabled', true);
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