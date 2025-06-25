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
    $sqlKeg = mysqli_query($myConnection, "select tb_kegiatan.*, tb_kabkota.name as nama_kab
    from tb_kegiatan
    left join tb_kabkota on tb_kabkota.id = tb_kegiatan.kabkota
    where tb_kegiatan.id_keg = '$id_keg' ");
    if (mysqli_num_rows($sqlKeg) > 0) {
        $viewKeg = mysqli_fetch_array($sqlKeg);
?>
        <!-- <form action="setDocumentHotel" method="post" role="form" enctype="multipart/form-data" autocomplete="off"> -->
        <div class="modal-header">
            <h4 class="modal-title" id="modalFullTitle">Input Data Semua Transport Peserta Kantor</h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <!-- style="max-height: calc(114vh - 50px);overflow:scroll" -->
        <div class="modal-body">
            <?= $viewKeg['nama_keg']; ?><br>
            <?= $viewKeg['tempat_keg'] . ' - ' . ucwords($viewKeg['nama_kab']); ?><br>
            <?= Indonesia2Tgl($viewKeg['tgl_mulai']) . ' s.d ' . Indonesia2Tgl($viewKeg['tgl_selesai']) ?>
            <div class="table-responsive">
                <table id="tabel_transport_semua_peserta" class="table table table-bordered table-hover" width=100% cellspacing="0">
                    <thead style="width:100%">
                        <tr>
                            <th class="text-center text-nowrap align-middle">No</th>
                            <th class="text-center text-nowrap align-middle">Nama Peserta</th>
                            <th class="text-center text-nowrap align-middle">Unit Kerja</th>
                            <th class="text-center text-nowrap align-middle">Uang<br>Transport</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        $sqlPeserta =  mysqli_query($myConnection, "select tb_peserta_keg_kantor.* , tb_kabkota.name as nama_kab
                    from tb_peserta_keg_kantor
                    left join tb_kabkota on tb_kabkota.id = tb_peserta_keg_kantor.id_kabkota_unit_kerja
                    where tb_peserta_keg_kantor.id_keg = '$id_keg' limit 10");
                        while ($viewPeserta = mysqli_fetch_array($sqlPeserta)) {
                            $total = $viewPeserta['bbm'] + $viewPeserta['tiket'] + $viewPeserta['lokal'] + $viewPeserta['taksi'] + $viewPeserta['toll'];
                        ?>
                            <tr>
                                <td class="text-center"><?= $no++ ?></td>
                                <td><?= $viewPeserta['nama'] ?></td>
                                <td><?= ucwords(strtolower($viewPeserta['unit_kerja'])) . '<br>' . str_replace(["Kabupaten ", "Kota "], ["Kab. ", "Kota "], ucwords($viewPeserta['nama_kab'])) ?></td>
                                <td class="text-center"><?= $total == '' ? '0' : format_angka($total) ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="modal-footer">
            <input type="hidden" value="<?= encrypt($id_keg) ?>" name="_token">
            <input type="hidden" value="<?= encrypt($id_peserta_keg_kantor) ?>" name="_id">
            <button type="submit" name="inputTransportParticipantOffice" class="btn btn-info" id="inputTranspor" disabled>Upload</button>
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal" aria-label="Close">Batal</button>
        </div>
        <!-- </form> -->
        <script type="text/javascript">
            $("#total").click(function() {
                var bbm = isNaN(parseInt($("#bbm").val())) ? 0 : parseInt($("#bbm").val());
                var tiket = isNaN(parseInt($("#tiket").val())) ? 0 : parseInt($("#tiket").val());
                var lokal = isNaN(parseInt($("#lokal").val())) ? 0 : parseInt($("#lokal").val());
                var taksi = isNaN(parseInt($("#taksi").val())) ? 0 : parseInt($("#taksi").val());
                var toll = isNaN(parseInt($("#toll").val())) ? 0 : parseInt($("#toll").val());
                var total = bbm + tiket + lokal + taksi + toll;
                if (isNaN(total)) {
                    $("#total").val('0');
                } else {
                    $("#total").val(total);
                }

            });
            $('#input_transpor').click(function() {
                if ($(this).is(':checked')) {

                    $('#inputTranspor').removeAttr('disabled');

                } else {
                    $('#inputTranspor').attr('disabled', true);
                }
            });
            $(document).ready(function() {
                $('#tabel_transport_semua_peserta').DataTable({
                    // fixedHeader: true,
                    scrollCollapse: true,
                    scrollY: 475,
                    scroller: true,
                    'paging': false,
                    'lengthChange': false,
                    'searching': false,
                    'ordering': true,
                    'info': false,
                    'autoWidth': true,
                    "pageLength": 5
                });
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