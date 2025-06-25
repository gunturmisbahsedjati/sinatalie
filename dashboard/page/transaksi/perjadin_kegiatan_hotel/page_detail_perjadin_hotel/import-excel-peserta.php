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
if (isset($_POST['id'])) {
    $id_keg = decrypt($_POST['id']);
    $sqlKegiatan = mysqli_query($myConnection, "select * from tb_kegiatan where id_keg = '$id_keg'");
    if (mysqli_num_rows($sqlKegiatan) > 0) {
        $viewKeg = mysqli_fetch_array($sqlKegiatan);
        $token = $viewKeg['id_st_siratu']
?>
        <form action="setDocumentHotel" method="post" role="form" enctype="multipart/form-data" autocomplete="off">
            <div class="modal-header">
                <h5><i class="bx bx-data"></i> Import Data Peserta</h5>
            </div>
            <div class="modal-body">
                <div class="mb-2 fw-bold">
                    <p><?= $viewKeg['nama_keg'] . '<br>' . Indonesia2Tgl($viewKeg['tgl_mulai']) . ' s.d ' . Indonesia2Tgl($viewKeg['tgl_selesai']) ?></p>
                </div>
                <div class="mb-3">
                    <p class="fw-bold text-info" style="margin-bottom: -0.1em;">Panduan Import :</p>
                    <ul>
                        <li>Unduh format berikut : <a class="fw-bold" href="/format/template_import_peserta_perjadin_hotel.xlsx">Download Format</a></li>
                        <li>Sheet <strong>import_sinatalie</strong> di isi sesuai dengan ekspor excel dari <strong>Aplikasi Registrasi</strong></li>
                        <li>Kolom yang diperlukan dari Aplikasi Registrasi yaitu<strong> nama, nip, gol, pangkat, jabatan, unit_kerja, alamat_unit_kerja, no_hp</strong></li>
                        <li>Format penulisan pada kolom NIP tidak diperkenanankan ada spasi, titik atau petik</li>
                        <li>Format penulisan pada kolom gol, karakter setelah tanda / menggunakan huruf kecil => contoh untuk <strong>III/D ditulis III/d</strong> atau <strong>IV/A ditulis IV/a</strong></li>
                        <li>Format penulisan pada kolom kabkota => contoh untuk <strong>kabupaten jember ditulis Kab. Jember</strong> atau <strong>kota surabaya ditulis Kota Surabaya</strong></li>
                        <li>Jika ada data yang kosong pada kolom <strong> nama, nip, gol, pangkat, jabatan, unit_kerja, alamat_unit_kerja, no_hp</strong>, silahkan diberi tanda hubung ( - )</li>
                        <li>Semua kolom wajib menggunakan format <strong>TEXT</strong></li>
                        <li><span class="text-danger fw-bold">Pastikan tidak ada nama yang duplikat !</span></li>
                    </ul>
                </div>
                <div class="mb-3">
                    <label for="formFile" class="form-label">Upload File Excel</label>
                    <input class="form-control" type="file" id="formFile" accept=".xls,.xlsx" onchange="ValidateSingleInputExcel(this);" name="file_excel" required>
                </div>

                <div class="pt-2">
                    <div class="form-check">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="form-check-input" id="import_peserta" name="cek">
                            <label class="form-check-label" for="import_peserta">Saya yakin akan melakukan Import Data Peserta.</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <input type="hidden" value="<?= encrypt($id_keg) ?>" name="_token">
                <button type="submit" name="uploadParticipant" class="btn btn-info" id="importPeserta" disabled>Upload</button>
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal" aria-label="Close">Batal</button>
            </div>
        </form>
        <script type="text/javascript">
            $('#import_peserta').click(function() {
                if ($(this).is(':checked')) {

                    $('#importPeserta').removeAttr('disabled');

                } else {
                    $('#importPeserta').attr('disabled', true);
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