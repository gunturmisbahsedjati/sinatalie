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
  $sqlKegiatan = mysqli_query($myConnection, "select tb_kegiatan.*, tb_kabkota.name as nama_kab
                                              from tb_kegiatan
                                              left join tb_kabkota on tb_kabkota.id = tb_kegiatan.kabkota
                                              where tb_kegiatan.id_keg = '$id_keg'");
  if (mysqli_num_rows($sqlKegiatan) > 0) {
    $viewPerjadin = mysqli_fetch_array($sqlKegiatan);
?>
    <form action="setDocumentHotel" method="post" id="formTransportParticipant" role="form" enctype="multipart/form-data" autocomplete="off">
      <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card">
          <div class="card-body">
            <div class="row">
              <div class="col-md-8">
                <p class="card-title mt-1">
                  Data Peserta<br>
                  <?= $viewPerjadin['nama_keg']; ?><br>
                  <?= $viewPerjadin['tempat_keg'] . ' - ' . ucwords($viewPerjadin['nama_kab']); ?><br>
                  <?= Indonesia2Tgl($viewPerjadin['tgl_mulai']) . ' s.d ' . Indonesia2Tgl($viewPerjadin['tgl_selesai']) ?>
                </p>
              </div>
              <div class="col text-end">
                <button type="button" name="" class="btn btn-primary mb-2 me-1" id="inputTransportPeserta">simpan</button>
                <input type="hidden" name="saveTransportParticipant" value="<?= encrypt($id_keg) ?>">
                <a href="checkDocumentHotel?_token=<?= encrypt($id_keg) ?>&_type=peserta" title="Mapping Data Asesor" class="btn btn-warning mb-2 me-1"><i class="bx bx-arrow-to-left"></i> Kembali</a>
              </div>
            </div>
            <div class="table-responsive ">
              <table id="tabel_transport_semua_peserta" class="table table-bordered table-hover" style="width:1000px">
                <thead>
                  <tr>
                    <th class="text-center text-nowrap align-middle bg-secondary text-white" rowspan="2">Nama Peserta</th>
                    <th class="text-center text-nowrap align-middle" colspan="2">Tanggal</th>
                    <th class="text-center text-nowrap align-middle" rowspan="2">Tiket<br>Pesawat</th>
                    <th class="text-center text-nowrap align-middle" rowspan="2">Tiket<br>Kapal</th>
                    <th class="text-center text-nowrap align-middle" rowspan="2">Tiket</th>
                    <th class="text-center text-nowrap align-middle" rowspan="2">Transport<br>Lokal</th>
                    <th class="text-center text-nowrap align-middle" rowspan="2">Taksi/<br>Grab/<br>Gojek</th>
                    <th class="text-center text-nowrap align-middle" rowspan="2">Toll</th>
                    <th class="text-center text-nowrap align-middle" rowspan="2">BBM</th>
                    <th class="text-center text-nowrap align-middle" rowspan="2">DPR</th>
                  </tr>
                  <tr>
                    <th class="text-center text-nowrap align-middle">Datang</th>
                    <th class="text-center text-nowrap align-middle">Pulang</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $no = 1;
                  $sqlPeserta =  mysqli_query($myConnection, "select tb_peserta_keg_hotel.* , tb_kabkota.name as nama_kab
                    from tb_peserta_keg_hotel
                    left join tb_kabkota on tb_kabkota.id = tb_peserta_keg_hotel.id_kabkota_unit_kerja
                    where tb_peserta_keg_hotel.id_keg = '$id_keg' ");
                  while ($viewPeserta = mysqli_fetch_array($sqlPeserta)) {
                    $idKabKota = $viewPeserta['id_kabkota_unit_kerja'];
                    $viewSBM = mysqli_fetch_array(mysqli_query($myConnection, "select besaran from tb_kabkota where id = '$idKabKota'"));
                    $viewPeserta['bbm'] = $viewPeserta['bbm'] == '' ? '' : number_format($viewPeserta['bbm'], 0);
                    $viewPeserta['tiket_pesawat'] = $viewPeserta['tiket_pesawat'] == '' ? '' :  number_format($viewPeserta['tiket_pesawat'], 0);
                    $viewPeserta['tiket'] = $viewPeserta['tiket'] == '' ? '' :  number_format($viewPeserta['tiket'], 0);
                    $viewPeserta['tiket_kapal'] = $viewPeserta['tiket_kapal'] == '' ? '' :  number_format($viewPeserta['tiket_kapal'], 0);
                    $viewPeserta['lokal'] = $viewPeserta['lokal'] == '' ? '' :   number_format($viewPeserta['lokal'], 0);
                    $viewPeserta['taksi'] = $viewPeserta['taksi'] == '' ? '' :  number_format($viewPeserta['taksi'], 0);
                    $viewPeserta['toll'] = $viewPeserta['toll'] == '' ? '' :  number_format($viewPeserta['toll'], 0);
                    $viewPeserta['dpr1'] = $viewPeserta['dpr1'] == '' ? '' :  number_format($viewPeserta['dpr1'], 0);
                  ?>
                    <tr>
                      <td class="bg-secondary text-white" style="position: sticky;z-index: 200;">
                        <input type="hidden" name="_id[]" value="<?= encrypt($viewPeserta['id_peserta_keg_hotel']) ?>">
                        <?= $viewPeserta['nama'] . '<br>' . $viewPeserta['unit_kerja'] . '<br>' . str_replace(["Kabupaten ", "Kota "], ["Kab. ", "Kota "], ucwords($viewPeserta['nama_kab'])) . '<br> SBM: <strong>' . format_angka($viewSBM['besaran'] * 2) . '</strong>' ?>
                      </td>
                      <td>
                        <div style="margin-bottom: -1rem;">
                          <input class="form-control" id="tgl_mulai_peserta" placeholder="Tanggal" required name="tgl_mulai[]" value="<?= substr($viewPeserta['tgl_mulai'], 8, 2) . '-' . substr($viewPeserta['tgl_mulai'], 5, 2) . '-' . substr($viewPeserta['tgl_mulai'], 0, 4) ?>" />
                        </div>
                      </td>
                      <td>
                        <div style="margin-bottom: -1rem;">
                          <input class="form-control" id="tgl_selesai_peserta" placeholder="Tanggal" required name="tgl_selesai[]" value="<?= substr($viewPeserta['tgl_selesai'], 8, 2) . '-' . substr($viewPeserta['tgl_selesai'], 5, 2) . '-' . substr($viewPeserta['tgl_selesai'], 0, 4) ?>" />
                        </div>
                      </td>
                      <td>
                        <input type="text" class="form-control " oninput="seprator(this)" step="any" name="tiket_pesawat[]" id="tiket_pesawat" value="<?= $viewPeserta['tiket_pesawat'] ?>">
                      </td>
                      <td>
                        <input type="text" class="form-control " oninput="seprator(this)" step="any" name="tiket_kapal[]" id="tiket_kapal" value="<?= $viewPeserta['tiket_kapal'] ?>">
                      </td>
                      <td>
                        <input type="text" class="form-control " oninput="seprator(this)" step="any" name="tiket[]" id="tiket" value="<?= $viewPeserta['tiket'] ?>">
                      </td>
                      <td>
                        <input type="text" class="form-control " oninput="seprator(this)" step="any" name="lokal[]" id="lokal" value="<?= $viewPeserta['lokal'] ?>">
                      </td>
                      <td>
                        <input type="text" class="form-control " oninput="seprator(this)" step="any" name="taksi[]" id="taksi" value="<?= $viewPeserta['taksi'] ?>">
                      </td>
                      <td>
                        <input type="text" class="form-control " oninput="seprator(this)" step="any" name="toll[]" id="toll" value="<?= $viewPeserta['toll'] ?>">
                      </td>
                      <td>
                        <input type="text" class="form-control " oninput="seprator(this)" step="any" name="bbm[]" id="bbm" value="<?= $viewPeserta['bbm'] ?>">
                      </td>
                      <td>
                        <input type="text" class="form-control " oninput="seprator(this)" step="any" name="dpr1[]" id="dpr1" value="<?= $viewPeserta['dpr1'] ?>">
                      </td>
                    </tr>
                  <?php } ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </form>
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