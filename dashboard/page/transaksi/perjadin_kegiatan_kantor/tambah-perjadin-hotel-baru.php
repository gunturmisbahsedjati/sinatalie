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
$getDataSTPerjadin = getDataSTPerjadin($keySiratu, $thnIni);
$absenPPNPN = http_request($getDataSTPerjadin);
$getDataSTPerjadinView = json_decode($absenPPNPN, true);
?>
<div class="modal-header">
    <h4><i class="bx bx-folder"></i> Data Dokumen SIRATU <?= $thnIni ?></h4>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
    <div class="table-responsive text-nowrap">
        <table id="tabel_cabut" class="table table table-bordered table-hover" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th class="text-center text-nowrap align-middle">Kegiatan</th>
                    <th class="text-center text-nowrap align-middle">Tanggal</th>
                    <th class="text-center align-middle">Jml Pegawai</th>
                    <th class="text-center text-nowrap align-middle">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($getDataSTPerjadinView['status']['code'] == '200') {
                    $resultView = isset($getDataSTPerjadinView['results']) ? $getDataSTPerjadinView['results'] : array();
                    foreach ($resultView as $arrName) {
                        echo "<tr>";
                        echo '<td style="white-space: pre-wrap;">' . $arrName['nama_keg'] . '<br><strong>Kategori : ' . $arrName['nama_kat'] . '<strong></td>';
                        echo '<td>' . tanggal($arrName['tgl_mulai']) . '<br>' . tanggal($arrName['tgl_selesai']) . '</td>';
                        echo '<td class="text-center"><button type="button" id="tooltip" name="tooltip[]" class="btn btn-primary waves-effect waves-light" data-bs-original-title="Tooltip on bottom">
                        Bottom
                      </button></td>';
                        echo '<td>
                                <a class="btn btn-sm btn-icon btn-primary me-2" title="Tambah Dokumen Perjadin" href="setDocumentHotel?insertDocumentHotel=1&_token=' . encrypt($arrName['id_st']) . '">
                                    <span class="mdi mdi-plus-network"></span>
                                </a>
                            </td>';
                        echo "</tr>";
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $('#tabel_cabut').DataTable({
            'paging': true,
            'lengthChange': false,
            'searching': true,
            'ordering': true,
            'info': true,
            'autoWidth': true,
            "pageLength": 5
        });
        // $('#pop').popover();
        if (document.getElementById("tooltip")) {
            var tool_tip = document.getElementsByName('tooltip[]');
            for (var i = 0; i < tool_tip.length; i++) {
                var a = tool_tip[i];
                $(a).tooltip({
                    placement: 'left',
                    html: true,
                    sanitize: false,
                });
            }
        }
    });
</script>