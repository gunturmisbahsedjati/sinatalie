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
        $viewKeg['uh_peserta'] = $viewKeg['uh_peserta'] == '' ? '' : number_format($viewKeg['uh_peserta'], 0);
        $viewKeg['uh_panitia'] = $viewKeg['uh_panitia'] == '' ? '' : number_format($viewKeg['uh_panitia'], 0);
        $viewKeg['uh_narsum_i'] = $viewKeg['uh_narsum_i'] == '' ? '' : number_format($viewKeg['uh_narsum_i'], 0);
        $viewKeg['uh_narsum_i_kemdikbud'] = $viewKeg['uh_narsum_i_kemdikbud'] == '' ? '' : number_format($viewKeg['uh_narsum_i_kemdikbud'], 0);
        $viewKeg['honor_narsum_e'] = $viewKeg['honor_narsum_e'] == '' ? '' : number_format($viewKeg['honor_narsum_e'], 0);
        $viewKeg['honor_pengarah_e'] = $viewKeg['honor_pengarah_e'] == '' ? '' : number_format($viewKeg['honor_pengarah_e'], 0);
        $viewKeg['honor_penanggungjawab'] = $viewKeg['honor_penanggungjawab'] == '' ? '' : number_format($viewKeg['honor_penanggungjawab'], 0);
        $viewKeg['honor_ketua'] = $viewKeg['honor_ketua'] == '' ? '' : number_format($viewKeg['honor_ketua'], 0);
        $viewKeg['honor_anggota'] = $viewKeg['honor_anggota'] == '' ? '' : number_format($viewKeg['honor_anggota'], 0);
?>
        <form action="setDocumentOffice" method="post" role="form" enctype="multipart/form-data" autocomplete="off">
            <div class="modal-body">
                <h4 class="card-title mb-3"><i class="bx bx-file"></i> Pengaturan Keuangan</h4>
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Uang Harian Peserta Per Hari</label>
                            <input type="text" oninput="seprator(this)" step="any" class="form-control border border-secondary" placeholder="410000" name="uh_peserta" value="<?= $viewKeg['uh_peserta'] ?>">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Uang Harian Panitia Per Hari</label>
                            <input type="text" oninput="seprator(this)" step="any" class="form-control border border-secondary" placeholder="410000" name="uh_panitia" value="<?= $viewKeg['uh_panitia'] ?>">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Uang Harian Narasumber Internal Per Hari</label>
                            <input type="text" oninput="seprator(this)" step="any" class="form-control border border-secondary" placeholder="410000" name="uh_narsum_i" value="<?= $viewKeg['uh_narsum_i'] ?>">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Uang Harian Narasumber Internal Kemdikbud Per Hari</label>
                            <input type="text" oninput="seprator(this)" step="any" class="form-control border border-secondary" placeholder="410000" name="uh_narsum_i_kemdikbud" value="<?= $viewKeg['uh_narsum_i_kemdikbud'] ?>">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Honor Narasumber Eksternal Per Jam</label>
                            <input type="text" oninput="seprator(this)" step="any" class="form-control border border-secondary" placeholder="410000" name="honor_narsum_e" value="<?= $viewKeg['honor_narsum_e'] ?>">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Honor Pengarah Eksternal Per Jam</label>
                            <input type="text" oninput="seprator(this)" step="any" class="form-control border border-secondary" placeholder="410000" name="honor_pengarah_e" value="<?= $viewKeg['honor_pengarah_e'] ?>">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Honor PenanggungJawab Per Jam</label>
                            <input type="text" oninput="seprator(this)" step="any" class="form-control border border-secondary" placeholder="410000" name="honor_penanggungjawab" value="<?= $viewKeg['honor_penanggungjawab'] ?>">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Honor Ketua Panitia Per Jam</label>
                            <input type="text" oninput="seprator(this)" step="any" class="form-control border border-secondary" placeholder="410000" name="honor_ketua" value="<?= $viewKeg['honor_ketua'] ?>">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Honor Anggota Panitia Per Jam</label>
                            <input type="text" oninput="seprator(this)" step="any" class="form-control border border-secondary" placeholder="410000" name="honor_anggota" value="<?= $viewKeg['honor_anggota'] ?>">
                        </div>
                    </div>
                </div>



                <div class="">
                    <div class="form-check">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="form-check-input" id="edit_keuangan_kuitansi" name="cek">
                            <label class="form-check-label" for="edit_keuangan_kuitansi">Saya yakin data telah benar.</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <input type="hidden" value="<?= encrypt($viewKeg['id_keg']) ?>" name="_token">
                <input type="hidden" name="_type" value="<?= $page ?>">
                <button type="submit" name="settingFinancialReceiptOffice" class="btn btn-info" id="updateUangKuitansi" disabled>Simpan</button>
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal" aria-label="Close">Batal</button>
            </div>
        </form>
        <script type="text/javascript">
            $('#edit_keuangan_kuitansi').click(function() {
                if ($(this).is(':checked')) {

                    $('#updateUangKuitansi').removeAttr('disabled');

                } else {
                    $('#updateUangKuitansi').attr('disabled', true);
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
    window.location = "../../../../"
    </script>';
}
?>