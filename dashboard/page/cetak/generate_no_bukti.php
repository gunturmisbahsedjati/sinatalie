<?php
// require_once '../../../inc/inc.koneksi.php';

// $id_keg = '1719230631-667960A7A926F';

$noBuktiTransport = $viewKeg['no_bukti_transport'];
$noBuktiHonor = $viewKeg['no_bukti_honor'];
$jmlPengarah = mysqli_num_rows(mysqli_query($myConnection, "select * from tb_pengarah_keg_hotel where id_keg = '$id_keg' and soft_delete =0"));
$jmlNarsum = mysqli_num_rows(mysqli_query($myConnection, "select * from tb_narsum_keg_hotel where id_keg = '$id_keg' and soft_delete =0"));
$jmlPanitia = mysqli_num_rows(mysqli_query($myConnection, "select * from tb_panitia_keg_hotel where id_keg = '$id_keg' and soft_delete =0"));
$jmlPeserta = mysqli_num_rows(mysqli_query($myConnection, "select * from tb_peserta_keg_hotel where id_keg = '$id_keg' and soft_delete =0"));

$noBuktiTranportPengarah = $noBuktiTransport;
$noBuktiTranportNarsum = $noBuktiTransport + $jmlPengarah;
$noBuktiTranportPanitia = $noBuktiTransport + $jmlPengarah + $jmlNarsum;
$noBuktiTranportPeserta = $noBuktiTransport + $jmlPengarah + $jmlNarsum + $jmlPanitia;

$noBuktiHonorPengarah = $noBuktiHonor;
$noBuktiHonorNarsum = $noBuktiHonor + $jmlPengarah;
$noBuktiHonorPanitia = $noBuktiHonor + $jmlPengarah + $jmlNarsum;

// echo $noBuktiTranportPengarah . '<br>';
// echo $noBuktiTranportNarsum . '<br>';
// echo $noBuktiTranportPanitia . '<br>';
// echo $noBuktiTranportPeserta . '<br>';
