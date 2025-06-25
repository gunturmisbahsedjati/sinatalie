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
$thnPerjadin = decrypt($_POST['id']);
$getDataSTPerjadin = getDataSTPerjadin($keySiratu, $thnPerjadin);
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
                        echo '<td class="text-center"><button type="button" data-id="' . $arrName['id_st'] . '" class="btn btn-sm btn-primary" id="cekPanitia" name="cekPanitia[]" title="Lihat Data Pegawai" >' . $arrName['jml_petugas'] . '</button></td>';
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
    });
    if (document.getElementById("cekPanitia")) {
        var buttonCekPanitia = document.getElementsByName('cekPanitia[]');
        for (var i = 0; i < buttonCekPanitia.length; i++) {
            var a = buttonCekPanitia[i];
            const id = $(a).data('id');
            $(a).on('click', function(event) {
                $('#viewPanitia').modal('show');
                $('.modal .modal-dialog').attr('class', 'modal-dialog modal-lg');
                document.getElementById("load-view-panitia").style.display = "block";
                document.getElementById("view-panitia").style.display = "none";
                $.ajax({
                    type: 'post',
                    url: 'dashboard/page/transaksi/perjadin_kegiatan_hotel/lihat-petugas-kegiatan',
                    data: {
                        'id': id
                    },
                    success: function(data) {
                        document.getElementById("load-view-panitia").style.display = "none";
                        document.getElementById("view-panitia").style.display = "block";
                        $('.view-panitia').html(data);

                    }
                });
                $('.modal').on('hide.bs.modal', function(e) {
                    $('.modal .modal-dialog').attr('class', 'modal-dialog modal-lg');
                });
            });
        }
    }
</script>