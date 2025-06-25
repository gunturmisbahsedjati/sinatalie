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
<?php
$arrayAkses = explode(",", $_SESSION['level']);
if (in_array(1, $arrayAkses) && isset($_GET['_token'])) {
  $thnPerjadin = decrypt($_GET['_token']);
?>
  <div class="container-xxl flex-grow-1 container-p-y" id="dokumen_perjadin_hotel">
    <div class="card">
      <div class="card-header ">
        <div class="row">
          <div class="col">
            <h5 class="card-title">Manajemen Dokumen SPJ Hotel<br>Tahun <?= $thnPerjadin ?></h5>
          </div>
          <div class="col text-end">
            <button type="button" class="btn btn-sm btn-primary" title="Tambah Kegiatan dari Data SIRATU" data-bs-toggle="modal" data-bs-target="#addDocumentHotel" data-id="<?= encrypt($thnPerjadin) ?>">
              <span class="tf-icons mdi mdi-edit"></span> Ambil Data Siratu
            </button>
          </div>
        </div>
      </div>
      <div class="card-body">
        <div class="table-responsive mt-4 ">
          <table id="perjadin_hotel_table" class="table table table-bordered table-hover" width="100%">
            <thead>
              <tr>
                <th class="text-center text-nowrap align-middle">No.</th>
                <th class="text-center text-nowrap align-middle">Detail Kegiatan</th>
                <th class="text-center text-nowrap align-middle">Tempat Kegiatan</th>
                <th class="text-center text-nowrap align-middle">Status</th>
                <th class="text-center text-nowrap align-middle">Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $no = 1;
              $sqlKeg = mysqli_query($myConnection, "select tb_kegiatan.* , tb_kabkota.name as nama_kab
              from tb_kegiatan
              left join tb_kabkota on tb_kabkota.id = tb_kegiatan.kabkota
              where tb_kegiatan.thn_st = '$thnPerjadin' and tb_kegiatan.jenis_perjadin = 'hotel'
              order by tb_kegiatan.status desc, tb_kegiatan.tgl_mulai desc");
              while ($viewKeg = mysqli_fetch_array($sqlKeg)) {
                $id_keg = $viewKeg['id_keg'];
              ?>
                <tr>
                  <td width="7%" class="text-center"><?= $no++ ?></td>
                  <td width="50%"><?= $viewKeg['nama_keg'] ?><br><?= Indonesia2Tgl($viewKeg['tgl_mulai']) . ' s.d ' . Indonesia2Tgl($viewKeg['tgl_selesai']) ?></td>
                  <td width="25%"><?= $viewKeg['tempat_keg'] . '<br>' . ucwords($viewKeg['nama_kab']); ?></td>
                  <td width="15%" class="text-center ">
                    <?php
                    if ($viewKeg['status'] == 1) { ?>
                      <button type="button" class="btn btn-sm btn-warning text-white fw-bold " data-bs-toggle="modal" data-bs-target="#changeStatus" data-id="<?= encrypt($viewKeg['id_keg']) ?>" data-status="<?= encrypt(0) ?>">
                        <span class="spinner-border spinner-border-md text-white" role="status" aria-hidden="true"></span>&nbsp; on progress</button>
                    <?php } elseif ($viewKeg['status'] == 0) { ?>
                      <button class="btn btn-sm btn-success fw-bold" data-bs-toggle="modal" data-bs-target="#changeStatus" data-id="<?= encrypt($viewKeg['id_keg']) ?>" data-status="<?= encrypt(1) ?>">selesai</button>
                    <?php } ?>
                  </td>
                  <td class="text-center text-nowrap">
                    <a href="checkDocumentHotel?_token=<?= encrypt($viewKeg['id_keg']) ?>&_type=peserta" class="btn btn-sm btn-icon btn-primary me-2" title="Detail Progress Kegiatan">
                      <span class="tf-icons mdi mdi-cog-outline"></span>
                    </a>
                    <button type="button" class="btn btn-sm btn-icon btn-danger" data-bs-toggle="modal" data-bs-target="#delDocumentHotel" data-id="<?= encrypt($viewKeg['id_keg']) ?>" title="Hapus Kegiatan">
                      <span class="tf-icons mdi mdi-delete"></span>
                    </button>
                  </td>
                </tr>
              <?php } ?>
            </tbody>
          </table>
          <?= "Process took " . number_format(microtime(true) - $time_start, 2) . " seconds."; ?>
        </div>
      </div>
    </div>
  </div>
  <div class="modal secondModal bg-dark bg-opacity-50 fade" id="viewPanitia" tabindex="-1" data-bs-backdrop="static" role="dialog" aria-labelledby="exampleEditModal" aria-hidden="true" aria-modal="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div id="load-view-panitia" style="display: none;">
          <div class="modal-body">
            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
            loading......
          </div>
        </div>
        <div class="view-panitia" id="view-panitia"></div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="commingSoon" tabindex="-1" data-bs-backdrop="static" role="dialog" aria-labelledby="exampleEditModal" aria-hidden="true" aria-modal="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div id="load-comingsoon" style="display: none;">
          <div class="modal-body">
            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
            loading......
          </div>
        </div>
        <div class="comingsoon" id="comingsoon"></div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="addDocumentHotel" tabindex="-1" data-bs-backdrop="static" role="dialog" aria-labelledby="exampleEditModal" aria-hidden="true" aria-modal="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div id="load-add-document-hotel" style="display: none;">
          <div class="modal-body">
            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
            loading......
          </div>
        </div>
        <div class="add-document-hotel" id="add-document-hotel"></div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="viewDocumentHotel" tabindex="-1" data-bs-backdrop="static" role="dialog" aria-labelledby="exampleEditModal" aria-hidden="true" aria-modal="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div id="load-view-document-hotel" style="display: none;">
          <div class="modal-body">
            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
            loading......
          </div>
        </div>
        <div class="view-document-hotel" id="view-document-hotel"></div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="detailOfficer" tabindex="-1" data-bs-backdrop="static" role="dialog" aria-labelledby="exampleEditModal" aria-hidden="true" aria-modal="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div id="load-detail-officer" style="display: none;">
          <div class="modal-body">
            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
            loading......
          </div>
        </div>
        <div class="detail-officer" id="detail-officer"></div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="changeStatus" tabindex="-1" data-bs-backdrop="static" role="dialog" aria-labelledby="exampleEditModal" aria-hidden="true" aria-modal="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div id="load-change-status" style="display: none;">
          <div class="modal-body">
            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
            loading......
          </div>
        </div>
        <div class="change-status" id="change-status"></div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="delDocumentHotel" tabindex="-1" data-bs-backdrop="static" role="dialog" aria-labelledby="exampleEditModal" aria-hidden="true" aria-modal="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div id="load-del-document-hotel" style="display: none;">
          <div class="modal-body">
            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
            loading......
          </div>
        </div>
        <div class="del-document-hotel" id="del-document-hotel"></div>
      </div>
    </div>
  </div>
<?php } else { ?>
  <div class="container-xxl flex-grow-1 container-p-y">
    <div class="card border border-primary col-6">
      <div class="card-body">
        <h2>Nyari apa.... 🤣</h2>
        <p>Error 404<br>Object not found!<br>The requested URL was not found on this server.</p>
      </div>
    </div>
  </div>
<?php } ?>