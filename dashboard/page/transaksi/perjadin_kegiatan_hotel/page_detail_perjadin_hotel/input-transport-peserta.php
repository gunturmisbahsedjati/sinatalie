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
    $id_peserta_keg_hotel = decrypt($_POST['id']);
    $sqlPeserta = mysqli_query($myConnection, "select tb_peserta_keg_hotel.*, tb_kabkota.name as nama_kab
    from tb_peserta_keg_hotel
    left join tb_kabkota on tb_kabkota.id = tb_peserta_keg_hotel.id_kabkota_unit_kerja
    where tb_peserta_keg_hotel.id_keg = '$id_keg' and tb_peserta_keg_hotel.id_peserta_keg_hotel = '$id_peserta_keg_hotel'");
    if (mysqli_num_rows($sqlPeserta) > 0) {
        $viewPeserta = mysqli_fetch_array($sqlPeserta);
        $idKabKota = $viewPeserta['id_kabkota_unit_kerja'];
        $arrayKepulauan = [3529, 3525];
        $pulau = in_array($idKabKota, $arrayKepulauan) ? true : false;
        $viewSBM = mysqli_fetch_array(mysqli_query($myConnection, "select besaran from tb_kabkota where id = '$idKabKota'"));
        $viewPeserta['bbm'] = $viewPeserta['bbm'] == '' ? '' : number_format($viewPeserta['bbm'], 0);
        $viewPeserta['tiket_pesawat'] = $viewPeserta['tiket_pesawat'] == '' ? '' :  number_format($viewPeserta['tiket_pesawat'], 0);
        $viewPeserta['tiket'] = $viewPeserta['tiket'] == '' ? '' :  number_format($viewPeserta['tiket'], 0);
        $viewPeserta['tiket_kapal'] = $viewPeserta['tiket_kapal'] == '' ? '' :  number_format($viewPeserta['tiket_kapal'], 0);
        $viewPeserta['lokal'] = $viewPeserta['lokal'] == '' ? '' :   number_format($viewPeserta['lokal'], 0);
        $viewPeserta['taksi'] = $viewPeserta['taksi'] == '' ? '' :  number_format($viewPeserta['taksi'], 0);
        $viewPeserta['toll'] = $viewPeserta['toll'] == '' ? '' :  number_format($viewPeserta['toll'], 0);
        $viewPeserta['dpr1'] = $viewPeserta['dpr1'] == '' ? '' :  number_format($viewPeserta['dpr1'], 0);
?>
        <form action="setDocumentHotel" method="post" role="form" enctype="multipart/form-data" autocomplete="off">

            <div class="modal-body">
                <h4><i class="bx bx-data"></i> Edit Data Peserta</h4>
                <div class="mb-2 fw-bold">
                    <p><?= $viewPeserta['nama'] . '<br>' . $viewPeserta['unit_kerja'] . '<br>' . str_replace(["Kabupaten ", "Kota "], ["Kab. ", "Kota "], ucwords($viewPeserta['nama_kab'])) . '<br> SBM Kota Surabaya - ' . str_replace(["Kabupaten ", "Kota "], ["Kab. ", "Kota "], ucwords($viewPeserta['nama_kab'])) . ' : <span class="text-primary">' . format_angka($viewSBM['besaran'] * 2) . '</span>' ?></p>
                </div>
                <div class="row">
                    <span class="fw-bold">Kehadiran</span>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Tanggal Awal</label>
                            <input class="form-control border border-secondary" id="tgl_mulai_peserta" placeholder="dd-mm-yyyy" name="tgl_mulai" value="<?= $viewPeserta['tgl_mulai'] == '' || $viewPeserta['tgl_mulai'] == '0000-00-00' ? '' : tanggal($viewPeserta['tgl_mulai']); ?>">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Tanggal Akhir</label>
                            <input class="form-control border border-secondary" id="tgl_selesai_peserta" placeholder="dd-mm-yyyy" name="tgl_selesai" value="<?= $viewPeserta['tgl_selesai'] == '' || $viewPeserta['tgl_selesai'] == '0000-00-00' ? '' : tanggal($viewPeserta['tgl_selesai']); ?>">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label class="form-label">Tiket Pesawat</label>
                            <input type="text" oninput="seprator(this)" step="any" class="form-control border border-secondary" placeholder="ex. 410000" name="tiket_pesawat" id="tiket_pesawat" value="<?= $viewPeserta['tiket_pesawat'] ?>">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label class="form-label">Tiket Kapal</label>
                            <input type="text" oninput="seprator(this)" step="any" class="form-control border border-secondary" placeholder="ex. 410000" name="tiket_kapal" id="tiket_kapal" value="<?= $viewPeserta['tiket_kapal'] ?>">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label class="form-label">Tiket</label>
                            <input type="text" oninput="seprator(this)" step="any" class="form-control border border-secondary" placeholder="ex. 410000" name="tiket" id="tiket" value="<?= $viewPeserta['tiket'] ?>">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label class="form-label">Transport Lokal</label>
                            <input type="text" oninput="seprator(this)" step="any" class="form-control border border-secondary" placeholder="ex. 410000" name="lokal" id="lokal" value="<?= $viewPeserta['lokal'] ?>">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label class="form-label">Taksi/Grab/Gojek</label>
                            <input type="text" oninput="seprator(this)" step="any" class="form-control border border-secondary" placeholder="ex. 410000" name="taksi" id="taksi" value="<?= $viewPeserta['taksi'] ?>">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label class="form-label">Toll</label>
                            <input type="text" oninput="seprator(this)" step="any" class="form-control border border-secondary" placeholder="ex. 410000" name="toll" id="toll" value="<?= $viewPeserta['toll'] ?>">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label class="form-label">BBM</label>
                            <input type="text" oninput="seprator(this)" step="any" class="form-control border border-secondary" placeholder="ex. 410000" name="bbm" id="bbm" value="<?= $viewPeserta['bbm'] ?>">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label class="form-label">DPR</label>
                            <input type="text" oninput="seprator(this)" step="any" class="form-control border border-secondary" placeholder="ex. 410000" name="dpr1" id="dpr1" value="<?= $viewPeserta['dpr1'] ?>">
                        </div>
                    </div>
                    <!-- <div class="col-md-4">
                        <div class="mb-3">
                            <label class="form-label">DPR 2</label>
                            <input type="number" class="form-control border border-secondary" placeholder="ex. 410000" name="dpr2" id="dpr2" value="<?= $viewPeserta['dpr2'] ?>">
                        </div>
                    </div> -->
                </div>
                <?php
                if ($pulau) {
                    if ($viewPeserta['status_kabkota_unit_kerja'] == "Kepulauan") {
                        echo '<div class="mb-3">
                                <label class="form-label">Status Lokasi Unit Kerja</label>
                                <select class="form-select border border-secondary" name="status_kabkota_unit_kerja" required>
                                    <option value="">Pilih Status Lokasi</option>
                                    <option value="Kepulauan" selected>Kepulauan</option>
                                    <option value="Daratan">Daratan</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Penginapan</label>
                                <input type="number" class="form-control border border-secondary" placeholder="ex. 410000" name="penginapan" id="penginapan" value="' . $viewPeserta['penginapan'] . '">
                            </div>';
                    } elseif ($viewPeserta['status_kabkota_unit_kerja'] == "Daratan") {
                        echo '<div class="mb-3">
                                <label class="form-label">Status Lokasi Unit Kerja</label>
                                <select class="form-select border border-secondary" name="status_kabkota_unit_kerja" required>
                                    <option value="">Pilih Status Lokasi</option>
                                    <option value="Kepulauan">Kepulauan</option>
                                    <option value="Daratan" selected>Daratan</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Penginapan</label>
                                <input type="number" class="form-control border border-secondary" placeholder="ex. 410000" name="penginapan" id="penginapan" value="' . $viewPeserta['penginapan'] . '">
                            </div>';
                    } else {
                        echo '<div class="mb-3">
                        <label class="form-label">Status Lokasi Unit Kerja</label>
                        <select class="form-select border border-secondary" name="status_kabkota_unit_kerja" required>
                            <option value="">Pilih Status Lokasi</option>
                            <option value="Kepulauan">Kepulauan</option>
                            <option value="Daratan">Daratan</option>
                        </select>
                    </div>
                    <div class="mb-3">
                                <label class="form-label">Penginapan</label>
                                <input type="number" class="form-control border border-secondary" placeholder="ex. 410000" name="penginapan" id="penginapan" value="' . $viewPeserta['penginapan'] . '">
                            </div>';
                    }
                } else {
                    echo '<input type="hidden" value="Daratan" name="status_kabkota_unit_kerja">
                    <input type="hidden" value="0" name="penginapan">';
                }
                ?>
                <div>
                    <small class="text-danger">*Catatan:
                        <ul>
                            <li>
                                Kolom DPR (Daftar Pengeluaran Riil) diisikan jika tidak ada bukti fisik dan digunakan sebagai trigger format kuitansi Daftar Pengeluaran Riil
                            </li>
                            <li>
                                Kolom Penginapan diisi jika Status Lokasi Unit Kerja berada di Kepulauan (Kab. Sumenep & Kab. Gresik)
                            </li>
                            <?php
                            if ($pulau) {
                                # code...
                            }
                            ?>
                        </ul>
                    </small>
                </div>
                <div class="pt-2">
                    <div class="form-check">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="form-check-input" id="input_transpor" name="cek">
                            <label class="form-check-label" for="input_transpor">Saya yakin Data Keuangan sudah benar.</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <input type="hidden" value="<?= encrypt($id_keg) ?>" name="_token">
                <input type="hidden" value="<?= encrypt($id_peserta_keg_hotel) ?>" name="_id">
                <button type="submit" name="inputTransportParticipant" class="btn btn-info" id="inputTranspor" disabled>Simpan</button>
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal" aria-label="Close">Batal</button>
            </div>
        </form>
        <script type="text/javascript">
            $('#tgl_mulai_peserta').datepicker({
                uiLibrary: 'bootstrap5',
                format: 'dd-mm-yyyy'
            });
            $('#tgl_selesai_peserta').datepicker({
                uiLibrary: 'bootstrap5',
                format: 'dd-mm-yyyy'
            });
            $('#input_transpor').click(function() {
                if ($(this).is(':checked')) {

                    $('#inputTranspor').removeAttr('disabled');

                } else {
                    $('#inputTranspor').attr('disabled', true);
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