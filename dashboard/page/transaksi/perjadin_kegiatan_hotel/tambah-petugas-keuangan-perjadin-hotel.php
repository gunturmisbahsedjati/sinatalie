<?php
session_start();
include_once '../../../../inc/inc.koneksi.php';
include_once '../../../../inc/config.php';
include_once '../../../../inc/inc.library.php';
if (empty($_SESSION['username'])) {
    header('location:../../../');
} else {
    $username = $_SESSION['username'];
    $id = $_SESSION['id'];
    $level = $_SESSION['level'];
    $arrayAkses = explode(",", $_SESSION['level']);
}
if (!isset($_SESSION['status_login'])) {
    echo '<script type="text/javascript">
    window.location = "./"
    </script>';
    exit;
}

if (isset($_POST['id']) && isset($_POST['type']) && $_SESSION['level'] == 1) {
    $id_keg = decrypt($_POST['id']);
    $page = $_POST['type'];
?>
    <div class="modal-header">
        <h4><i class="bx bx-folder"></i> Daftar Petugas Keuangan</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">
        <form action="setDocumentHotel" method="post" role="form" enctype="multipart/form-data" autocomplete="off">
            <div class="mb-5">
                <div class="input-group">
                    <select class="form-control border border-select-picker1" title="Pilih Petugas Keuangan...." data-live-search="true" data-size="5" id="petugas_keu" name="petugas_keu">
                        <!-- <option value="" selected>Pilih Petugas Keuangan</option> -->
                        <?php
                        $sqlKeu = mysqli_query($myConnection, "select tb_panitia_keg_hotel.*, tb_pegawai.nama_peg as nama_peg, tb_jabatan_kegiatan.nama_jabatan
                  from tb_panitia_keg_hotel
                  left join tb_kegiatan on tb_kegiatan.id_keg = tb_panitia_keg_hotel.id_keg
                  left join tb_pegawai on tb_pegawai.id_peg = tb_panitia_keg_hotel.id_peg
                  left join tb_gol_pajak on tb_gol_pajak.id_pangkat = tb_pegawai.id_pangkat
                  left join tb_jabatan_kegiatan on tb_jabatan_kegiatan.kd_jabatan = tb_panitia_keg_hotel.id_jab_st
                  where tb_panitia_keg_hotel.id_keg = '$id_keg' 
                  order by tb_jabatan_kegiatan.kd_jabatan asc");
                        while ($viewKeu = mysqli_fetch_array($sqlKeu)) {
                            echo '<option value="' . $viewKeu['id_panitia_keg_hotel'] . '">' . $viewKeu['nama'] . '</option>';
                        }
                        ?>
                    </select>
                    <button class="btn btn-outline-primary waves-effect" type="submit" name="addFinancialOfficer">Tambah</button>
                </div>
                <input type="hidden" name="_token" value="<?= encrypt($id_keg) ?>">
                <input type="hidden" name="_type" value="<?= $page ?>">
                <small class="text-danger">Data diambil dari <strong>Data Panitia</strong>.<br>Jika tidak ada nama yang akan dipilih, Silahkan masukkan terlebih dahulu pada <strong>Data Panitia</strong></small>
            </div>
        </form>
        <div class="table-responsive text-nowrap">
            <table id="tabel_keu" class="table table table-bordered table-hover" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th class="text-center text-nowrap align-middle">No</th>
                        <th class="text-center text-nowrap align-middle">Nama Pegawai</th>
                        <th class="text-center text-nowrap align-middle">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    $sqlPetugasKeu = mysqli_query($myConnection, "select tb_petugas_keuangan_keg_hotel.*, tb_panitia_keg_hotel.nama
                    from tb_petugas_keuangan_keg_hotel
                    left join tb_panitia_keg_hotel on tb_panitia_keg_hotel.id_panitia_keg_hotel = tb_petugas_keuangan_keg_hotel.id_panitia_keg_hotel
                    where tb_petugas_keuangan_keg_hotel.id_keg = '$id_keg'");
                    while ($viewPetugasKeu = mysqli_fetch_array($sqlPetugasKeu)) { ?>
                        <tr>
                            <td class="text-center"><?= $no++ ?></td>
                            <td><?= $viewPetugasKeu['nama'] ?></td>
                            <td class="text-center">
                                <form action="setDocumentHotel" method="post" role="form" enctype="multipart/form-data" autocomplete="off">
                                    <input type="hidden" name="_token" value="<?= encrypt($viewPetugasKeu['id_petugas_keu_keg']) ?>">
                                    <input type="hidden" name="_key" value="<?= encrypt($viewPetugasKeu['id_keg']) ?>">
                                    <input type="hidden" name="_type" value="<?= $page ?>">
                                    <button class="btn btn-icon btn-outline-danger waves-effect" title="Hapus Petugas Keuangan" type="submit" name="delFinancialOfficer"><span class="tf-icons mdi mdi-delete"></span></button>
                                </form>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#petugas_keu').selectpicker();
            $('#tabel_keu').DataTable({
                'paging': false,
                'lengthChange': false,
                'searching': false,
                'ordering': false,
                'info': false,
                'autoWidth': true,
                "pageLength": 5
            });
        });
    </script>
<?php } else {
    # code...
}
