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
if (in_array(1, $arrayAkses)) { ?>
  <div class="container-xxl flex-grow-1 container-p-y" id="data_mapping_wilayah">
    <div class="card border border-primary">
      <div class="card-header ">
        <div class="row">
          <div class="col">
            <h5 class="card-title">Data Mapping Kab/Kota Jawa Timur</h5>
          </div>
          <div class="col text-end">
            <button type="button" data-bs-toggle="modal" data-bs-target="#sinkronMapping" class="btn btn-sm btn-primary" title="Sinkronisasi Data Mapping Wilayah"><i class="mdi mdi-cog-refresh-outline"></i>&nbsp;Sinkron Data SINADIN</button>
          </div>
        </div>
      </div>
      <div class="card-body">
        <div class="table-responsive text-nowrap ">
          <table id="mapping_region_table" class="table display table-bordered table-hover">
            <thead>
              <tr>
                <th class="text-center text-nowrap align-middle">No.</th>
                <th class="text-center text-nowrap align-middle">Provinsi</th>
                <th class="text-center text-nowrap align-middle">Asal</th>
                <th class="text-center text-nowrap align-middle">Tujuan</th>
                <th class="text-center text-nowrap align-middle">Besaran</th>
                <th class="text-center text-nowrap align-middle">Wilayah</th>
                <th class="text-center text-nowrap align-middle">Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $no = 1;
              $sqlWil = mysqli_query($myConnection, "select tb_kabkota.*, tb_mapping_wilayah.wilayah from tb_kabkota left join tb_mapping_wilayah on tb_mapping_wilayah.id = tb_kabkota.mapping where tb_kabkota.province_id = 35 order by tb_mapping_wilayah.id, tb_kabkota.id asc");
              while ($viewWil = mysqli_fetch_array($sqlWil)) { ?>
                <tr>
                  <td class="text-center"><?= $no++ ?></td>
                  <td>Jawa Timur</td>
                  <td>Kota Surabaya</td>
                  <td><?= ucwords(str_replace(["kabupaten ", "kota "], ["kab. ", "kota "], $viewWil['name'])) ?></td>
                  <td class="text-end"><?= format_angka($viewWil['besaran']) ?></td>
                  <td class="text-center"><?= $viewWil['wilayah'] ?></td>
                  <td class="text-center">
                    <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#updateMapping" data-id="<?= encrypt($viewWil['id']) ?>">
                      <i class=" bx bx-edit "></i> update
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
  <div class="modal fade" id="updateMapping" tabindex="-1" data-bs-backdrop="static" role="dialog" aria-labelledby="exampleEditModal" aria-hidden="true" aria-modal="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div id="load-update-mapping" style="display: none;">
          <div class="modal-body">
            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
            loading......
          </div>
        </div>
        <div class="update-mapping" id="update-mapping"></div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="sinkronMapping" tabindex="-1" data-bs-backdrop="static" role="dialog" aria-labelledby="exampleEditModal" aria-hidden="true" aria-modal="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div id="load-sinkron-mapping" style="display: none;">
          <div class="modal-body">
            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
            loading......
          </div>
        </div>
        <div class="sinkron-mapping" id="sinkron-mapping"></div>
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