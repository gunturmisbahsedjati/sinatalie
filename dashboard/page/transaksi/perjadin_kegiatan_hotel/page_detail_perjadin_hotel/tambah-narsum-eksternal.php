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
                <h4><i class="bx bx-data"></i> Tambah Narasumber Eksternal</h4>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label">Nama</label>
                    <input type="text" class="form-control border border-secondary" placeholder="Nama Lengkap Narasumber" name="nama" id="nama">
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">NIP</label>
                            <input type="text" class="form-control border border-secondary" placeholder="NIP Narasumber" name="nip" id="nip">
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
                                    echo '<option value="' . encrypt($viewPangkat['id_pangkat']) . '">' . $viewPangkat['jabatan_struktural'] . ' - ' . $viewPangkat['gol'] . '</option>';
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
                            <input type="text" class="form-control border border-secondary" placeholder="No. HP" name="no_hp" id="no_hp">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Jabatan</label>
                            <input type="text" class="form-control border border-secondary" placeholder="Jabatan di Unit Kerja" name="jabatan" id="jabatan">
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Unit Kerja</label>
                    <input type="text" class="form-control border border-secondary" placeholder="Unit Kerja Narasumber" name="unit_kerja" id="unit_kerja">
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Alamat Unit Kerja</label>
                            <textarea rows="3" class="form-control border border-secondary" placeholder="Alamat Lengkap Unit Kerja" name="alamat_unit_kerja"></textarea>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Kab/Kota Unit Kerja</label>
                            <select class="form-control border border-secondary" title="Pilih Salah Satu...." data-live-search="true" data-size="5" id="kabkota_unitkerja" name="kabkota_unitkerja">
                                <?php
                                $sqlKabkota = mysqli_query($myConnection, "select tb_kabkota.*, tb_provinsi.name as provinsi from tb_kabkota left join tb_provinsi on tb_provinsi.id = tb_kabkota.province_id");
                                while ($viewKabkota = mysqli_fetch_array($sqlKabkota)) {
                                    echo '<option data-subtext="' . $viewKabkota['provinsi'] . '" value="' . $viewKabkota['id'] . '">' . str_replace('Kabupaten', 'Kab.', ucwords($viewKabkota['name'])) . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <span class="fw-bold">Kehadiran</span>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Tanggal Awal</label>
                            <input class="form-control border border-secondary" id="tgl_mulai_narsum_eks" placeholder="dd-mm-yyyy" name="tgl_mulai" value="<?= $viewKeg['tgl_mulai'] == '' || $viewKeg['tgl_mulai'] == '0000-00-00' ? '' : tanggal($viewKeg['tgl_mulai']); ?>">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Tanggal Akhir</label>
                            <input class="form-control border border-secondary" id="tgl_selesai_narsum_eks" placeholder="dd-mm-yyyy" name="tgl_selesai" value="<?= $viewKeg['tgl_selesai'] == '' || $viewKeg['tgl_selesai'] == '0000-00-00' ? '' : tanggal($viewKeg['tgl_selesai']); ?>">
                        </div>
                    </div>
                </div>
                <div class="pt-2">
                    <div class="form-check">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="form-check-input" id="cek_internal" name="cek_internal">
                            <label class="form-check-label" for="cek_internal">Apakah narasumber dari Internal Kemdikbud ?</label>
                        </div>
                        <small class="text-danger">*Centang jika iya</small>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <input type="hidden" value="<?= encrypt($id_keg) ?>" name="_token">
                <button type="submit" name="addExternalInformant" class="btn btn-info">Simpan</button>
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal" aria-label="Close">Batal</button>
            </div>
        </form>
        <script type="text/javascript">
            $('#kabkota_unitkerja').selectpicker();
            $('#tgl_mulai_narsum_eks').datepicker({
                uiLibrary: 'bootstrap5',
                format: 'dd-mm-yyyy'
            });
            $('#tgl_selesai_narsum_eks').datepicker({
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