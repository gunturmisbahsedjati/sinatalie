<?php
$time_start = microtime(true);
require_once './inc/inc.koneksi.php';
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
if (in_array(1, $arrayAkses)) { ?>
  <div class="container-xxl flex-grow-1 container-p-y">
    <div class="card border border-primary">
      <div class="card-header ">
        <div class="row">
          <div class="col">
            <h5 class="card-title">Data Pegawai</h5>
            <small class="text-danger">Jika ada ketidaksamaan data, silahkan sinkronisasi untuk mengambil data dari Data SIRATU</small>
          </div>
          <div class="col text-end">
            <form action="setEmployee" method="post" role="form" enctype="multipart/form-data" autocomplete="off">
              <button type="submit" name="syncEmployee" class="btn btn-sm btn-primary" title="Sinkronisasi Data Pegawai SIRATU"><i class="mdi mdi-cog-refresh-outline"></i>&nbsp;Sinkron Data SIRATU</button>
            </form>
          </div>
        </div>
      </div>
      <div class="card-body">
        <div class="table-responsive mt-4">
          <table id="global_table" class="table table table-bordered table-hover">
            <thead>
              <tr>
                <th class="text-center text-nowrap align-middle">No.</th>
                <th class="text-center text-nowrap align-middle">Nama</th>
                <th class="text-center text-nowrap align-middle">NIP</th>
                <th class="text-center text-nowrap align-middle">Pangkat/Gol</th>
                <th class="text-center text-nowrap align-middle">Jabatan</th>
                <th class="text-center text-nowrap align-middle">Status</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $no = 1;
              $sqlPegawai = mysqli_query($myConnection, "select tb_pegawai.*, tb_gol_pajak.gol as gol, tb_gol_pajak.jabatan_struktural as pangkat, tb_jabatan.nama_jabatan as nama_jabatan from tb_pegawai
              left join tb_gol_pajak on tb_gol_pajak.id_pangkat = tb_pegawai.id_pangkat
              left join tb_jabatan on tb_jabatan.kd_jabatan = tb_pegawai.jabatan
              where tb_pegawai.soft_delete = 0
              order by tb_jabatan.kd_jabatan asc");
              while ($viewPeg = mysqli_fetch_array($sqlPegawai)) { ?>
                <tr>
                  <td class="text-center"><?= $no++ ?></td>
                  <td><?= $viewPeg['nama_peg'] ?></td>
                  <td><?= $viewPeg['nip'] ?></td>
                  <td><?= $viewPeg['pangkat'] . ' / ' . $viewPeg['gol'] ?></td>
                  <td><?= $viewPeg['nama_jabatan'] ?></td>
                  <td><?= $viewPeg['status_peg'] ?></td>
                </tr>
              <?php } ?>
            </tbody>
          </table>
          <?= "Process took " . number_format(microtime(true) - $time_start, 2) . " seconds."; ?>
        </div>
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