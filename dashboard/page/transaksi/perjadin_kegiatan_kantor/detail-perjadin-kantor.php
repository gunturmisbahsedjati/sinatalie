<?php
$time_start = microtime(true);
require_once './inc/inc.koneksi.php';
require_once './inc/inc.library.php';
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
if (isset($_SESSION['alert'])) : ?>
  <script>
    let Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 3000,
      timerProgressBar: true
    })
    <?php
    echo $_SESSION['alert'];
    unset($_SESSION['alert']);
    ?>
  </script>
<?php endif ?>
<?php $arrayAkses = explode(",", $_SESSION['level']);
if (in_array(1, $arrayAkses) && isset($_GET['_token'])) {
  $id_keg = decrypt($_GET['_token']);
  $jenis_data = $_GET['_type'];
  $sqlKegiatan = mysqli_query($myConnection, "select tb_kegiatan.*, tb_kabkota.name as nama_kab
                                              from tb_kegiatan
                                              left join tb_kabkota on tb_kabkota.id = tb_kegiatan.kabkota
                                              where tb_kegiatan.id_keg = '$id_keg' and tb_kegiatan.jenis_perjadin='kantor'");
  if (mysqli_num_rows($sqlKegiatan) > 0) {
    $viewPerjadin = mysqli_fetch_array($sqlKegiatan);
?>
    <div class="container-xxl flex-grow-1 container-p-y">
      <div class="card">
        <div class="card-body">
          <div class="row mb-4">
            <div class="col-md-8">
              <h4 class=""><span class="text-muted fw-bold">SPJ Kegiatan Kantor</h4>
              <h5 class="card-title mt-1">
                <?= $viewPerjadin['nama_keg']; ?><br>
                <?= $viewPerjadin['tempat_keg'] . ' - ' . ucwords($viewPerjadin['nama_kab']); ?><br>
                <?= Indonesia2Tgl($viewPerjadin['tgl_mulai']) . ' s.d ' . Indonesia2Tgl($viewPerjadin['tgl_selesai']) ?>
              </h5>
              <!-- <div class="demo-inline-spacing"> -->
              <div class="btn-group" id="dropdown-icon-demo">
                <button type="button" class="btn btn-danger dropdown-toggle waves-effect waves-light" data-bs-toggle="dropdown" aria-expanded="false" title="Klik untuk menu Pengaturan SPJ">
                  <i class="mdi mdi-menu me-1"></i> Pengaturan SPJ
                </button>
                <ul class="dropdown-menu">
                  <li>
                    <?php if (in_array(1, $arrayAkses)) { ?>
                      <button type="button" class="dropdown-item d-flex align-items-center waves-effect" title="Pilih Panitia Keuangan" data-bs-toggle="modal" data-bs-target="#addFinancialOfficeClerk" data-id="<?= encrypt($id_keg) ?>" data-type="<?= encrypt($jenis_data) ?>"><span class="tf-icons mdi mdi-account mb-1"></span> Panitia Keuangan</button>
                    <?php } ?>
                  </li>
                  <li>
                    <button type="button" class="dropdown-item d-flex align-items-center waves-effect" title="Pengaturan Dokumen SPJ" data-bs-toggle="modal" data-bs-target="#setReceiptOffice" data-id="<?= encrypt($id_keg) ?>" data-type="<?= encrypt($jenis_data) ?>"><i class='tf-icons mdi mdi-cog mb-1'></i> Setting Dokumen</button>
                  </li>
                  <li>
                    <button type="button" class="dropdown-item d-flex align-items-center waves-effect" title="Pengaturan Keuangan" data-bs-toggle="modal" data-bs-target="#setFinancialReceiptOffice" data-id="<?= encrypt($id_keg) ?>" data-type="<?= encrypt($jenis_data) ?>"><i class='tf-icons mdi mdi-cog mb-1'></i> Setting Keuangan</button>
                  </li>
                  <li>
                    <button type="button" class="dropdown-item d-flex align-items-center waves-effect" title="Pengaturan Kuitansi" data-bs-toggle="offcanvas" data-bs-target="#printSPJ"><i class='tf-icons mdi mdi-printer-outline mb-1'></i> Cetak SPJ</button>
                  </li>
                </ul>
              </div>
              <!-- </div> -->
            </div>
            <div class="col text-end">
              <a href="documentOffice?_token=<?= encrypt($viewPerjadin['thn_st']) ?>" title="Mapping Data Asesor" class="btn btn-warning mt-1"><i class="bx bx-arrow-to-left"></i> Kembali</a>
            </div>
          </div>
          <div class="divider divider-primary">
            <div class="divider-text text-primary fw-bold">DETAIL DATA SPJ</div>
          </div>
          <?php
          if ($jenis_data == 'peserta') {
            include_once 'page_detail_perjadin_kantor/peserta.php';
          } elseif ($jenis_data == 'pengarah') {
            include_once 'page_detail_perjadin_kantor/pengarah.php';
          } elseif ($jenis_data == 'narsum') {
            include_once 'page_detail_perjadin_kantor/narsum.php';
          } elseif ($jenis_data == 'panitia') {
            include_once 'page_detail_perjadin_kantor/panitia.php';
          }
          ?>
        </div>
      </div>
    </div>
    <?php include_once 'modal_perjadin_kantor.php'; ?>
  <?php } else {
    echo '<div class="container-xxl flex-grow-1 container-p-y">
      <div class="card border border-primary col-6">
        <div class="card-body">
          <h2>Data tidak ditemukan</h2>
          <p>Error 404<br>Object not found!<br>The requested URL was not found on this server.</p>
        </div>
      </div>
    </div>';
  }
} else { ?>
  <!-- halaman petugas -->
  <div class="container-xxl flex-grow-1 container-p-y">
    <div class="card border border-primary col-6">
      <div class="card-body">
        <h2>Nyari apa.... 🤣</h2>
        <p>Error 404<br>Object not found!<br>The requested URL was not found on this server.</p>
      </div>
    </div>
  </div>
<?php } ?>