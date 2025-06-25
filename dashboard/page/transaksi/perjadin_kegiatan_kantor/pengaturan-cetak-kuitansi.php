<?php
session_start();
include_once '../../../../inc/inc.koneksi.php';
include_once '../../../../inc/config.php';
include_once '../../../../inc/inc.library.php';
if (empty($_SESSION['username'])) {
    header('location:../../../../');
} else {
    $username = $_SESSION['username'];
    $id = $_SESSION['id'];
    $level = $_SESSION['level'];
    $arrayAkses = explode(",", $_SESSION['level']);
}
if (!isset($_SESSION['status_login'])) {
    echo '<script type="text/javascript">
    window.location = "../../../../"
    </script>';
    exit;
}
if (isset($_POST['id']) && isset($_POST['type'])) {
    $id_keg = decrypt($_POST['id']);
    $page = $_POST['type'];
    $sqlKegiatan = mysqli_query($myConnection, "select * from tb_kegiatan where id_keg = '$id_keg'");
    if (mysqli_num_rows($sqlKegiatan) > 0) {
        $viewKeg = mysqli_fetch_array($sqlKegiatan);
?>
        <form action="setDocumentOffice" method="post" role="form" enctype="multipart/form-data" autocomplete="off">
            <div class="modal-body">
                <h4 class="card-title mb-3"><i class="bx bx-file"></i> Pengaturan Dokumen</h4>
                <div class="mb-2">
                    <label class="form-label">Profil DIPA</label>
                    <input type="text" class="form-control border border-secondary" placeholder="Silahkan isi sesuai nama kegiatan...." name="nama_keg_kuitansi" value="<?= $viewKeg['nama_keg_kuitansi'] ?>">
                    <small class="text-danger">*Silahkan diubah/diedit jika nama kegiatan belum lengkap, nama kegiatan ini digunakan pada narasi kuitansi</small>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label class="form-label">Nama PPK</label>
                            <select class="form-control border border-secondary" title="Pilih Pegawai...." data-live-search="true" data-size="5" name="ppk" id="ppk">
                                <?php
                                $sqlPeg = mysqli_query($myConnection, "select id_peg, nama_peg, nip from tb_pegawai");
                                while ($viewPeg = mysqli_fetch_array($sqlPeg)) {
                                    $ppk_param = $viewKeg['id_ppk'];
                                    $select = $viewPeg['id_peg'] == $ppk_param ? 'selected' : '';
                                    echo '<option value="' . $viewPeg['id_peg'] . '" ' . $select . '>' . $viewPeg['nama_peg'] . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label class="form-label">Nama Bendahara</label>
                            <select class="form-control border border-secondary" title="Pilih Pegawai...." data-live-search="true" data-size="5" name="bendahara" id="bendahara">
                                <?php
                                $sqlPeg = mysqli_query($myConnection, "select id_peg, nama_peg, nip from tb_pegawai");
                                while ($viewPeg = mysqli_fetch_array($sqlPeg)) {
                                    $bendahara_param = $viewKeg['id_bendahara'];
                                    $select = $viewPeg['id_peg'] == $bendahara_param ? 'selected' : '';
                                    echo '<option value="' . $viewPeg['id_peg'] . '" ' . $select . '>' . $viewPeg['nama_peg'] . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label class="form-label">Nama KPA</label>
                            <select class="form-control border border-secondary" title="Pilih Pegawai...." data-live-search="true" data-size="5" name="pejabat" id="pejabat">
                                <?php
                                $sqlPeg = mysqli_query($myConnection, "select id_peg, nama_peg, nip from tb_pegawai");
                                while ($viewPeg = mysqli_fetch_array($sqlPeg)) {
                                    $ppk_param = $viewKeg['id_pejabat'];
                                    $select = $viewPeg['id_peg'] == $ppk_param ? 'selected' : '';
                                    echo '<option value="' . $viewPeg['id_peg'] . '" ' . $select . '>' . $viewPeg['nama_peg'] . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label class="form-label">No. SPTJB Perjadin</label>
                            <input type="text" class="form-control border border-secondary" onchange="getSPPD()" placeholder="0888" id="no1" name="no_sptjb_perjadin" value="<?= $viewKeg['no_sptjb_perjadin'] ?>">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label class="form-label">SPTJB Perjadin</label>
                            <input type="text" class="form-control border border-secondary" onchange="getSPPD()" placeholder="/C7.4/KU.02.01/2023" id="no2" name="sptjb_perjadin" value="<?= $viewKeg['sptjb_perjadin'] ?>">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label class="form-label">Tanggal Perjadin</label>
                            <input class="form-control border border-secondary" id="tgl_sptjb_perjadin" placeholder="dd-mm-yyyy" name="tgl_sptjb_perjadin" value="<?= $viewKeg['tgl_sptjb_perjadin'] == '' || $viewKeg['tgl_sptjb_perjadin'] == '0000-00-00' ? '' : tanggal($viewKeg['tgl_sptjb_perjadin']); ?>">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label class="form-label">No. SPTJB Honor</label>
                            <input type="text" class="form-control border border-secondary" onchange="getSPPD()" placeholder="0888" id="no1" name="no_sptjb_honor" value="<?= $viewKeg['no_sptjb_honor'] ?>">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label class="form-label">SPTJB Honor</label>
                            <input type="text" class="form-control border border-secondary" placeholder="/C7.45/KU.02.01/2023" id="no3" name="sptjb_honor" value="<?= $viewKeg['sptjb_honor'] ?>">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label class="form-label">Tanggal Honor</label>
                            <input class="form-control border border-secondary" id="tgl_sptjb_honor" placeholder="dd-mm-yyyy" name="tgl_sptjb_honor" value="<?= $viewKeg['tgl_sptjb_honor'] == '' || $viewKeg['tgl_sptjb_honor'] == '0000-00-00' ? '' : tanggal($viewKeg['tgl_sptjb_honor']); ?>">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">

                        <div class="card border border-primary">
                            <div class="card-body">
                                <div class="mb-3">
                                    <label class="form-label fw-bold">No. Bukti Transport</label>
                                    <input type="text" class="form-control border border-secondary" placeholder="7313" name="no_bukti_transport" value="<?= $viewKeg['no_bukti_transport'] ?>">
                                </div>
                                <hr class="border-primary">
                                <h6 class="card-title"><i class="bx bx-file"></i> MAK Transport</h6>
                                <div class="mb-3">
                                    <label class="form-label">Pengarah</label>
                                    <input type="text" class="form-control border border-secondary" placeholder="524114" name="mak_tp_pengarah" value="<?= $viewKeg['mak_tp_pengarah'] ?>">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Narasumber Eksternal</label>
                                    <input type="text" class="form-control border border-secondary" placeholder="524114" name="mak_tp_narsum_e" value="<?= $viewKeg['mak_tp_narsum_e'] ?>">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Narasumber Internal</label>
                                    <input type="text" class="form-control border border-secondary" placeholder="524114" name="mak_tp_narsum_i" value="<?= $viewKeg['mak_tp_narsum_i'] ?>">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Panitia</label>
                                    <input type="text" class="form-control border border-secondary" placeholder="524114" name="mak_tp_panitia" value="<?= $viewKeg['mak_tp_panitia'] ?>">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Peserta</label>
                                    <input type="text" class="form-control border border-secondary" placeholder="524114" name="mak_tp_peserta" value="<?= $viewKeg['mak_tp_peserta'] ?>">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="card border border-primary">
                            <div class="card-body">
                                <div class="mb-3">
                                    <label class="form-label fw-bold">No. Bukti Honor</label>
                                    <input type="text" class="form-control border border-secondary" placeholder="7313" name="no_bukti_honor" value="<?= $viewKeg['no_bukti_honor'] ?>">
                                </div>
                                <hr class="border-primary">
                                <h6 class="card-title"><i class="bx bx-file"></i> MAK Honor</h6>
                                <div class="mb-3">
                                    <label class="form-label">Pengarah</label>
                                    <input type="text" class="form-control border border-secondary" placeholder="524114" name="mak_hr_pengarah" value="<?= $viewKeg['mak_hr_pengarah'] ?>">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Narasumber Eksternal</label>
                                    <input type="text" class="form-control border border-secondary" placeholder="524114" name="mak_hr_narsum_e" value="<?= $viewKeg['mak_hr_narsum_e'] ?>">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Narasumber Internal</label>
                                    <input type="text" class="form-control border border-secondary" placeholder="524114" name="mak_hr_narsum_i" value="<?= $viewKeg['mak_hr_narsum_i'] ?>">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Panitia</label>
                                    <input type="text" class="form-control border border-secondary" placeholder="524114" name="mak_hr_panitia" value="<?= $viewKeg['mak_hr_panitia'] ?>">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Peserta</label>
                                    <input type="text" class="form-control border border-secondary" placeholder="524114" name="mak_hr_peserta" value="<?= $viewKeg['mak_hr_peserta'] ?>">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mb-5">
                    <label class="form-label">Profil DIPA</label>
                    <select class="form-select border border-secondary" name="profil_dipa">
                        <option value="">Pilih DIPA...</option>
                        <?php
                        $sqlSPTJB = mysqli_query($myConnection, "select id_profil_sptjb, no_dipa, tgl_dipa from tb_profil_sptjb where soft_delete = 0");
                        while ($viewSPTJB = mysqli_fetch_array($sqlSPTJB)) {
                            $id_param = $viewKeg['profil_dipa'];
                            $select = $viewSPTJB['id_profil_sptjb'] == $id_param ? 'selected' : '';
                            echo '<option value="' . encrypt($viewSPTJB['id_profil_sptjb']) . '" ' . $select . '>' . $viewSPTJB['no_dipa'] . ' Tgl. ' . Indonesia2Tgl($viewSPTJB['tgl_dipa']) . '</option>';
                        }
                        ?>
                    </select>
                </div>
                <div class="">
                    <div class="form-check">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="form-check-input" id="edit_kuitansi" name="cek">
                            <label class="form-check-label" for="edit_kuitansi">Saya yakin data telah benar.</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <input type="hidden" value="<?= encrypt($viewKeg['id_keg']) ?>" name="_token">
                <input type="hidden" name="_type" value="<?= $page ?>">
                <button type="submit" name="settingReceiptOffice" class="btn btn-info" id="updateKuitansi" disabled>Simpan</button>
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal" aria-label="Close">Batal</button>
            </div>
        </form>
        <script type="text/javascript">
            $(document).ready(function() {
                $('#ppk').selectpicker();
                $('#pejabat').selectpicker();
                $('#bendahara').selectpicker();
                $('#sptjb').selectpicker();
                $('#tgl_sptjb_honor').datepicker({
                    uiLibrary: 'bootstrap5',
                    format: 'dd-mm-yyyy'
                });
                $('#tgl_sptjb_perjadin').datepicker({
                    uiLibrary: 'bootstrap5',
                    format: 'dd-mm-yyyy'
                });
            });
            $('#edit_kuitansi').click(function() {
                if ($(this).is(':checked')) {

                    $('#updateKuitansi').removeAttr('disabled');

                } else {
                    $('#updateKuitansi').attr('disabled', true);
                }
            });

            function getSPPD() {
                let no1 = $('#no1').val();
                let no2 = $('#no2').val();
                let data = no1 + no2;
                $('#sppd').val(data);
            }
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
    window.location = "../../../../"
    </script>';
}
?>