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
                <h4><i class="bx bx-data"></i> Tambah Pengarah Internal</h4>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label">Daftar Pegawai Internal</label>
                    <select class="form-control border border-select-picker1" title="Pilih Pegawai Internal...." data-live-search="true" data-size="10" id="pengarah_internal" name="pengarah_internal" required>
                        <?php
                        $sqlPegawai = mysqli_query($myConnection, "select tb_pegawai.*, tb_gol_pajak.gol as gol, tb_gol_pajak.jabatan_struktural as pangkat, tb_jabatan.nama_jabatan as nama_jabatan from tb_pegawai
                         left join tb_gol_pajak on tb_gol_pajak.id_pangkat = tb_pegawai.id_pangkat
                         left join tb_jabatan on tb_jabatan.kd_jabatan = tb_pegawai.jabatan
                         where tb_pegawai.soft_delete = 0
                         order by tb_jabatan.kd_jabatan asc");
                        while ($viewPegawai = mysqli_fetch_array($sqlPegawai)) {
                            echo '<option data-subtext="' . $viewPegawai['nip'] . '" value="' . encrypt($viewPegawai['id_peg']) . '">' . $viewPegawai['nama_peg'] . '</option>';
                        }
                        ?>
                    </select>
                </div>
                <div class="row">
                    <span class="fw-bold">Kehadiran</span>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Tanggal Awal</label>
                            <input class="form-control border border-secondary" id="tgl_mulai_pengarah" placeholder="dd-mm-yyyy" name="tgl_mulai" value="<?= $viewKeg['tgl_mulai'] == '' || $viewKeg['tgl_mulai'] == '0000-00-00' ? '' : tanggal($viewKeg['tgl_mulai']); ?>">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Tanggal Akhir</label>
                            <input class="form-control border border-secondary" id="tgl_selesai_pengarah" placeholder="dd-mm-yyyy" name="tgl_selesai" value="<?= $viewKeg['tgl_selesai'] == '' || $viewKeg['tgl_selesai'] == '0000-00-00' ? '' : tanggal($viewKeg['tgl_selesai']); ?>">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <input type="hidden" value="<?= encrypt($id_keg) ?>" name="_token">
                <button type="submit" name="addInternalDirector" class="btn btn-info">Simpan</button>
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal" aria-label="Close">Batal</button>
            </div>
        </form>
        <script type="text/javascript">
            $('#pengarah_internal').selectpicker();
            $('#tgl_mulai_pengarah').datepicker({
                uiLibrary: 'bootstrap5',
                format: 'dd-mm-yyyy'
            });
            $('#tgl_selesai_pengarah').datepicker({
                uiLibrary: 'bootstrap5',
                format: 'dd-mm-yyyy'
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