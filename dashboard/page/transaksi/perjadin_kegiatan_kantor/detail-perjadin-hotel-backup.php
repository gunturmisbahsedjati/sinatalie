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
  $sqlKegiatan = mysqli_query($myConnection, "select * from tb_kegiatan where id_keg = '$id_keg'");
  if (mysqli_num_rows($sqlKegiatan) > 0) {
    $viewPerjadin = mysqli_fetch_array($sqlKegiatan);
    $sqlTotalTransport = mysqli_fetch_array(mysqli_query($myConnection, "select sum(tb_petugas_transport.nominal) as total
      from tb_petugas_transport
      left join tb_petugas_kegiatan on tb_petugas_kegiatan.id_petugas_keg = tb_petugas_transport.id_petugas_keg
      left join tb_kegiatan on tb_kegiatan.id_keg = tb_petugas_kegiatan.id_keg
      where tb_kegiatan.id_keg = '$id_keg' "));
    $sqlTotalHotel = mysqli_query($myConnection, "select tb_petugas_hotel.harga_per_malam as malam, DATEDIFF(tb_petugas_hotel.check_out, tb_petugas_hotel.check_in) as lama, (tb_petugas_hotel.harga_per_malam * (DATEDIFF(tb_petugas_hotel.check_out, tb_petugas_hotel.check_in))) as total
      from tb_petugas_hotel
      left join tb_petugas_kegiatan on tb_petugas_kegiatan.id_petugas_keg = tb_petugas_hotel.id_petugas_keg
      left join tb_kegiatan on tb_kegiatan.id_keg = tb_petugas_kegiatan.id_keg
      where tb_kegiatan.id_keg = '$id_keg'");
    $arrHotel = [];
    while ($arrayHotelPetugas = mysqli_fetch_array($sqlTotalHotel)) {
      $arrHotel[] = $arrayHotelPetugas['total'];
    }
    $totalHotel = array_sum($arrHotel);
?>
    <div class="container-xxl flex-grow-1 container-p-y">
      <div class="card">
        <div class="card-body">
          <div class="row mb-4">
            <div class="col-md-8">
              <h5 class="card-title mt-1"><?= $viewPerjadin['nama_keg']; ?><br>
                <?= Indonesia2Tgl($viewPerjadin['tgl_mulai']) . ' s.d ' . Indonesia2Tgl($viewPerjadin['tgl_selesai']) ?></h5>
            </div>
            <div class="col text-end">
              <a href="documentHotel?_token=<?= encrypt($viewPerjadin['thn_st']) ?>" title="Mapping Data Asesor" class="btn btn-sm btn-warning mt-1"><i class="bx bx-arrow-to-left"></i> Kembali</a>
            </div>
          </div>
          <div class="row mb-4">
            <!-- Pengaturan -->
            <div class="col-md-6 mb-2">
              <div class="card border border-primary h-100">
                <div class="card-body">
                  <div class="card-title fw-bold">
                    Pengaturan SPJ
                  </div>
                  <div>
                    <button type="button" class="btn btn-sm btn-primary mt-2 me-2" title="Pilih Panitia Keuangan" data-bs-toggle="modal" data-bs-target="#addFinancialOfficer" data-id="<?= encrypt($id_keg) ?>" data-type="<?= encrypt($jenis_data) ?>"><span class="tf-icons mdi mdi-delete mb-1"></span> Panitia Keuangan</button>
                    <button type="button" class="btn btn-sm btn-success mt-2 me-2" title="Pengaturan Kuitansi" data-bs-toggle="modal" data-bs-target="#syncData" data-id="<?= encrypt($id_keg) ?>"><i class='tf-icons mdi mdi-cog mb-1'></i> Sync</button>
                    <button type="button" class="btn btn-sm btn-secondary mt-2 me-2" title="Pengaturan Kuitansi" data-bs-toggle="modal" data-bs-target="#setReceipt" data-id="<?= encrypt($id_keg) ?>"><i class='tf-icons mdi mdi-cog mb-1'></i> Setting Kuitansi</button>

                  </div>
                </div>
              </div>
            </div>
            <!-- cetak -->
            <div class="col-md-6 mb-2">
              <div class="card border border-primary h-100">
                <div class="card-body">
                  <div class="card-title fw-bold">
                    Cetak SPJ
                  </div>
                  <div>
                    <a href="javascript:void(0)" onclick="popupCenter('dashboard/modul/cetak/cetak-all-kuitansi-perjadin?_token=<?= encrypt($id_keg) ?>','pop',900,600) ;" class="mt-2 me-2 btn btn-sm btn-danger" title="Ekspor PDF Kuitansi Perjadin"><i class="tf-icons mdi mdi-file-document-outline mb-1"></i> Kuitansi Perjadin</a>
                    <a href="javascript:void(0)" onclick="popupCenter('dashboard/modul/cetak/cetak-amplop-perjadin?_token=<?= encrypt($id_keg) ?>','pop',900,600) ;" class="mt-2 me-2 btn btn-sm btn-danger" title="Ekspor PDF Amplop Perjadin"><i class="tf-icons mdi mdi-file-document-outline mb-1"></i> Amplop Perjadin</a>
                    <a href="javascript:void(0)" onclick="popupCenter('dashboard/modul/cetak/cetak-sptjb-perjadin?_token=<?= encrypt($id_keg) ?>','pop',900,600) ;" class="mt-2 me-2 btn btn-sm btn-danger" title="Cetak SPTJB Perjadin"><i class="tf-icons mdi mdi-file-document-outline mb-1"></i> SPTJB Perjadin</a>
                    <a href="dashboard/modul/cetak/cetak-excel-detail-petugas-perjadin?_token=<?= encrypt($id_keg) ?>" class="mt-2 me-2 btn btn-sm btn-success2" title="Ekspor Excel Data Detail Perjadin"><i class="mdi mdi-file-excel-outline mb-1"></i> Excel Perjadin</a>
                    <a href="dashboard/modul/cetak/cetak-excel-sppd-perjadin?_token=<?= encrypt($id_keg) ?>" class="mt-2 me-2 btn btn-sm btn-success2" title="Ekspor Excel Data Detail Perjadin"><i class="mdi mdi-file-excel-outline mb-1"></i> Excel SPPD</a>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <?php if ($jenis_data == 'peserta') { ?>
            <!-- //data_peserta -->
            <ul class="nav nav-pills mb-3 nav-fill" role="tablist">
              <li class="nav-item ms-2 me-2 mb-2">
                <a href="checkDocumentHotel?_token=<?= encrypt($id_keg) ?>&_type=peserta" class="nav-link active border border-primary">
                  <i class="tf-icons bx bx-home"></i> Data Peserta
                </a>
              </li>
              <li class="nav-item ms-2 me-2 mb-2">
                <a href="checkDocumentHotel?_token=<?= encrypt($id_keg) ?>&_type=narsum" class="nav-link border border-primary">
                  <i class="tf-icons bx bx-home"></i> Data Narsum
                </a>
              </li>
              <li class="nav-item ms-2 me-2 mb-2">
                <a href="checkDocumentHotel?_token=<?= encrypt($id_keg) ?>&_type=panitia" class="nav-link border border-primary">
                  <i class="tf-icons bx bx-home"></i> Data Panitia
                </a>
              </li>
            </ul>

            <div class="card border border-success">
              <div class="card-body">
                <div>
                  <button type="button" class="btn btn-sm btn-outline-success" title="Import Excel Data Peserta" data-bs-toggle="modal" data-bs-target="#importParticipant" data-id="<?= encrypt($id_keg) ?>"><i class="mdi mdi-file-excel-outline mb-1"></i> Import Excel Peserta</button>
                </div>
                <div class="table-responsive  mt-4">
                  <table id="global_table" class="table table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th class="text-center text-nowrap align-middle">No</th>
                        <th class="text-center text-nowrap align-middle">Akun Reg</th>
                        <th class="text-center text-nowrap align-middle">Nama Peserta</th>
                        <th class="text-center text-nowrap align-middle">Unit Kerja</th>
                        <th class="text-center text-nowrap align-middle">Uang<br>Harian</th>
                        <th class="text-center text-nowrap align-middle">Uang<br>Transport</th>
                        <th class="text-center text-nowrap align-middle">Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $no = 1;
                      $sqlPeserta =  mysqli_query($myConnection, "select * from tb_peserta_keg_hotel where id_keg = '$id_keg' ");
                      while ($viewPeserta = mysqli_fetch_array($sqlPeserta)) { ?>
                        <tr>
                          <td class="text-center"><?= $no++ ?></td>
                          <td class="text-center"><?= $viewPeserta['no_reg_peserta'] ?></td>
                          <td><?= $viewPeserta['nama'] ?></td>
                          <td><?= ucwords(strtolower($viewPeserta['unit_kerja'])) . '<br>' . $viewPeserta['kabkota_unit_kerja'] ?></td>
                          <td></td>
                          <td></td>
                          <td></td>
                        </tr>
                      <?php } ?>
                    </tbody>
                  </table>
                  <?= "Process took " . number_format(microtime(true) - $time_start, 2) . " seconds."; ?>
                </div>
              </div>
            </div>
            <!-- //data_peserta -->
          <?php } elseif ($jenis_data == 'narsum') { ?>
            <!-- //data_narsum -->
            <ul class="nav nav-pills mb-3 nav-fill" role="tablist">
              <li class="nav-item ms-2 me-2 mb-2">
                <a href="checkDocumentHotel?_token=<?= encrypt($id_keg) ?>&_type=peserta" class="nav-link border border-primary">
                  <i class="tf-icons bx bx-home"></i> Data Peserta
                </a>
              </li>
              <li class="nav-item ms-2 me-2 mb-2">
                <a href="checkDocumentHotel?_token=<?= encrypt($id_keg) ?>&_type=narsum" class="nav-link active border border-primary">
                  <i class="tf-icons bx bx-home"></i> Data Narsum
                </a>
              </li>
              <li class="nav-item ms-2 me-2 mb-2">
                <a href="checkDocumentHotel?_token=<?= encrypt($id_keg) ?>&_type=panitia" class="nav-link border border-primary">
                  <i class="tf-icons bx bx-home"></i> Data Panitia
                </a>
              </li>
            </ul>
            <div class="table-responsive  mt-4">
              <table id="global_table" class="table table table-bordered table-hover">
                <thead>
                  <tr>
                    <th class="text-center text-nowrap align-middle">No</th>
                    <th class="text-center text-nowrap align-middle">Nama Petugas</th>
                    <th class="text-center text-nowrap align-middle">Kab/Kota Tujuan</th>
                    <th class="text-center align-middle">Transport</th>
                    <th class="text-center text-nowrap align-middle">Penginapan</th>
                    <th class="text-center text-nowrap align-middle">File</th>
                    <th class="text-center text-nowrap align-middle">Aksi</th>
                  </tr>
                </thead>
              </table>
              <?= "Process took " . number_format(microtime(true) - $time_start, 2) . " seconds."; ?>
            </div>
            <!-- //data_narsum -->

          <?php } elseif ($jenis_data == 'panitia') { ?>
            <!-- //data_panitia -->
            <ul class="nav nav-pills mb-3 nav-fill" role="tablist">
              <li class="nav-item ms-2 me-2 mb-2">
                <a href="checkDocumentHotel?_token=<?= encrypt($id_keg) ?>&_type=peserta" class="nav-link border border-primary">
                  <i class="tf-icons bx bx-home"></i> Data Peserta
                </a>
              </li>
              <li class="nav-item ms-2 me-2 mb-2">
                <a href="checkDocumentHotel?_token=<?= encrypt($id_keg) ?>&_type=narsum" class="nav-link border border-primary">
                  <i class="tf-icons bx bx-home"></i> Data Narsum
                </a>
              </li>
              <li class="nav-item ms-2 me-2 mb-2">
                <a href="checkDocumentHotel?_token=<?= encrypt($id_keg) ?>&_type=panitia" class="nav-link active border border-primary">
                  <i class="tf-icons bx bx-home"></i> Data Panitia
                </a>
              </li>
            </ul>
            <div class="table-responsive  mt-4">
              <table id="global_table" class="table table table-bordered table-hover">
                <thead>
                  <tr>
                    <th class="text-center text-nowrap align-middle">No</th>
                    <th class="text-center text-nowrap align-middle">Nama Panitia</th>
                    <th class="text-center text-nowrap align-middle">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $no = 1;
                  $sqlPanitia =  mysqli_query($myConnection, "select tb_panitia_keg_hotel.*, tb_pegawai.nama_peg as nama_peg
                  from tb_panitia_keg_hotel
                  left join tb_kegiatan on tb_kegiatan.id_keg = tb_panitia_keg_hotel.id_keg
                  left join tb_pegawai on tb_pegawai.id_peg = tb_panitia_keg_hotel.id_peg
                  left join tb_gol_pajak on tb_gol_pajak.id_pangkat = tb_pegawai.id_pangkat
                  where tb_panitia_keg_hotel.id_keg = '$id_keg' 
                  order by tb_gol_pajak.id_pangkat, tb_panitia_keg_hotel.id_peg_st_siratu asc");
                  while ($viewPanitia = mysqli_fetch_array($sqlPanitia)) {
                    $id_peg = $viewPanitia['id_peg']; ?>
                    <tr>
                      <td class="text-center"><?= $no++ ?></td>
                      <td><?= $viewPanitia['nama_peg'] ?></td>
                      <td class="text-center"></td>
                    </tr>
                  <?php } ?>
                </tbody>
              </table>
              <?= "Process took " . number_format(microtime(true) - $time_start, 2) . " seconds."; ?>
            </div>
            <!-- //data_panitia -->
          <?php } ?>
        </div>
      </div>
    </div>
    </div>
    <div class="modal fade" id="setReceiptHotel" tabindex="-1" data-bs-backdrop="static" role="dialog" aria-labelledby="exampleEditModal" aria-hidden="true" aria-modal="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div id="load-set-receipt-hotel" style="display: none;">
            <div class="modal-body">
              <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
              loading......
            </div>
          </div>
          <div class="set-receipt-hotel" id="set-receipt-hotel"></div>
        </div>
      </div>
    </div>
    <div class="modal fade" id="delOfficer" tabindex="-1" data-bs-backdrop="static" role="dialog" aria-labelledby="exampleEditModal" aria-hidden="true" aria-modal="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div id="load-del-officer" style="display: none;">
            <div class="modal-body">
              <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
              loading......
            </div>
          </div>
          <div class="del-officer" id="del-officer"></div>
        </div>
      </div>
    </div>
    <div class="modal fade" id="addOfficer" tabindex="-1" data-bs-backdrop="static" role="dialog" aria-labelledby="exampleEditModal" aria-hidden="true" aria-modal="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div id="load-add-officer" style="display: none;">
            <div class="modal-body">
              <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
              loading......
            </div>
          </div>
          <div class="add-officer" id="add-officer"></div>
        </div>
      </div>
    </div>
    <div class="modal fade" id="addFinancialOfficer" tabindex="-1" data-bs-backdrop="static" role="dialog" aria-labelledby="exampleEditModal" aria-hidden="true" aria-modal="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div id="load-add-financial-officer" style="display: none;">
            <div class="modal-body">
              <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
              loading......
            </div>
          </div>
          <div class="add-financial-officer" id="add-financial-officer"></div>
        </div>
      </div>
    </div>
    <div class="modal fade" id="syncData" tabindex="-1" data-bs-backdrop="static" role="dialog" aria-labelledby="exampleEditModal" aria-hidden="true" aria-modal="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div id="load-sync-data" style="display: none;">
            <div class="modal-body">
              <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
              loading......
            </div>
          </div>
          <div class="sync-data" id="sync-data"></div>
        </div>
      </div>
    </div>
    <div class="modal fade" id="importParticipant" tabindex="-1" data-bs-backdrop="static" role="dialog" aria-labelledby="exampleEditModal" aria-hidden="true" aria-modal="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div id="load-import-participant" style="display: none;">
            <div class="modal-body">
              <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
              loading......
            </div>
          </div>
          <div class="import-participant" id="import-participant"></div>
        </div>
      </div>
    </div>
    <div class="modal fade" id="addFinanceUsers" tabindex="-1" data-bs-backdrop="static" role="dialog" aria-labelledby="exampleEditModal" aria-hidden="true" aria-modal="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div id="load-add-finance-users" style="display: none;">
            <div class="modal-body">
              <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
              loading......
            </div>
          </div>
          <div class="add-finance-users" id="add-finance-users"></div>
        </div>
      </div>
    </div>
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