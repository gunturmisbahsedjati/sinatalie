<?php
define('_MPDF_URI', '../../../../assets/vendor/libs/MPDF57/');
require_once '../../../../inc/inc.koneksi.php';
require_once '../../../../inc/inc.library.php';
require_once('../../../../assets/vendor/libs/MPDF57/mpdf.php');
require_once '../../../../assets/vendor/libs/phpqrcode/qrlib.php';

$date = date('d-m-Y H:i:s');
date_default_timezone_set('Asia/Jakarta');
$currentdate = Indonesia2Tgl(date("Y-m-d"));
$today = date("H:i");
@session_start();
$id = $_SESSION['id'];
$id_keg = decrypt($_GET['_token']);
// $no_urut = decrypt($_GET['_key']);
$no_urut = 1;
$no_urut_honor = 1;

$sqlKegiatan = mysqli_query($myConnection, "select tb_kegiatan.*, tb_kabkota.name as nama_kab, tb_profil_sptjb.nama_satker, tb_profil_sptjb.kode_satker, tb_profil_sptjb.no_dipa, tb_profil_sptjb.tgl_dipa, tb_profil_sptjb.klasifikasi, tb_profil_sptjb.no_dipa
                                              from tb_kegiatan
                                              left join tb_kabkota on tb_kabkota.id = tb_kegiatan.kabkota
											  left join tb_profil_sptjb on tb_profil_sptjb.id_profil_sptjb = tb_kegiatan.profil_dipa
                                              where tb_kegiatan.id_keg = '$id_keg'");
if (mysqli_num_rows($sqlKegiatan) > 0) {
  $viewKeg = mysqli_fetch_array($sqlKegiatan);

  include 'generate_no_bukti.php';
  $sqlPengarah = mysqli_query($myConnection, "select tb_pengarah_keg_kantor.* , tb_kabkota.name as nama_kab
from tb_pengarah_keg_kantor
left join tb_kabkota on tb_kabkota.id = tb_pengarah_keg_kantor.id_kabkota_unit_kerja
where tb_pengarah_keg_kantor.id_keg = '$id_keg' ");

  $mpdf = new \Mpdf('', 'A4');
  $mpdf->SetTitle('Kuitansi_Perjadin_BBPMP_Jatim');
  $mpdf->SetAuthor('ANIMASIKU Studio');
  $mpdf->SetCreator('Adara Cassie Violeta Misbah');
  $mpdf->SetDefaultFont('times');
  $mpdf->SetDefaultFontSize('10');

  include 'css_generate_pdf.php';
  // $mpdf->StartProgressBarOutput(2);

  while ($viewPengarah = mysqli_fetch_array($sqlPengarah)) {
    // $golPajakPengarah = $viewPengarah['id_pangkat_gol'];
    // $jmlJamPengarah = $viewPengarah['jml_jam'];
    // $totalTransportPengarah = $viewPengarah['bbm'] + $viewPengarah['tiket_pesawat'] + $viewPengarah['tiket_kapal'] + $viewPengarah['tiket'] + $viewPengarah['lokal'] + $viewPengarah['taksi'] + $viewPengarah['toll'] + $viewPengarah['dpr1'] + $viewPengarah['dpr2'];
    // $jmlHariPengarah = (IntervalDays($viewPengarah['tgl_mulai'], $viewPengarah['tgl_selesai'])) + 1;
    // $idKabKota = $viewPengarah['id_kabkota_unit_kerja'];
    // $viewSBM = mysqli_fetch_array(mysqli_query($myConnection, "select id, besaran from tb_kabkota where id = '$idKabKota'"));
    // $sbmPengarah = $viewSBM['id'] == 3578 ? $viewSBM['besaran'] : $viewSBM['besaran'] * 2;
    // if ($totalTransportPengarah > $sbmPengarah) {
    //   $transportPengarah = $sbmPengarah;
    // } else {
    //   $transportPengarah = $totalTransportPengarah;
    // }

    // $jmlHari = (IntervalDays($viewPengarah['tgl_mulai'], $viewPengarah['tgl_selesai'])) + 1;
    // if ($viewPengarah['jenis_pengarah'] == 'internal') {
    //   $uangHonorPengarah = 0;
    // } elseif ($viewPengarah['jenis_pengarah'] == 'eksternal') {
    //   $uangHonorPengarah = $viewKeg['honor_pengarah_e'] == '' ? '0' : $viewKeg['honor_pengarah_e'] * $viewPengarah['jml_jam'];
    // } else {
    //   $uangHonorPengarah = 0;
    // }
    // $pajak = mysqli_fetch_array(mysqli_query($myConnection, "select pajak from tb_gol_pajak where id_pangkat = '$golPajakPengarah'"));
    // $potonganHonor = ($uangHonorPengarah) * ($pajak['pajak'] / 100);
    // $uangHonorPengarahPotongan = $uangHonorPengarah - $potonganHonor;
    $golPajak = $viewPengarah['id_pangkat_gol'];
    $totalTransport = $viewPengarah['bbm'] + $viewPengarah['tiket_pesawat'] + $viewPengarah['tiket_kapal'] + $viewPengarah['tiket'] + $viewPengarah['lokal'] + $viewPengarah['taksi'] + $viewPengarah['toll'] + $viewPengarah['dpr1'] + $viewPengarah['dpr2'];
    $jmlHari = (IntervalDays($viewPengarah['tgl_mulai'], $viewPengarah['tgl_selesai'])) + 1;
    $idKabKota = $viewPengarah['id_kabkota_unit_kerja'];
    $viewSBM = mysqli_fetch_array(mysqli_query($myConnection, "select id, besaran from tb_kabkota where id = '$idKabKota'"));
    $sbm =  $viewSBM['id'] == 3578 ? $viewSBM['besaran'] : $viewSBM['besaran'] * 2;
    // echo $sbm;
    if ($viewPengarah['jenis_pengarah'] == 'internal') {
      $uangHonorPengarah = 0;
      $totalTransport = 0;
    } elseif ($viewPengarah['jenis_pengarah'] == 'eksternal') {
      $uangHonorPengarah = $viewPerjadin['honor_pengarah_e'] == '' ? '0' : $viewPerjadin['honor_pengarah_e'] * $viewPengarah['jml_jam'];
      $totalTransport = $totalTransport;
    } else {
      $uangHonorPengarah = 0;
      $totalTransport = 0;
    }
    $pajak = mysqli_fetch_array(mysqli_query($myConnection, "select pajak from tb_gol_pajak where id_pangkat = '$golPajak'"));
    $potonganHonor = ($uangHonorPengarah) * ($pajak['pajak'] / 100);
    $uangHonorPengarahPotongan = $uangHonorPengarah - $potonganHonor;

    if ($totalTransport > $sbm) {
      $transportPengarah = $sbm;
      $class = 'fw-bold text-danger';
      $titleTransport = 'Total Transport Riil : ' . format_angka($totalTransport);
    } else {
      $transportPengarah = $totalTransport;
      $class = '';
      $titleTransport = '';
    }


    //identitas pejabat
    $id_ppk = $viewKeg['id_ppk'];
    $viewPPK = mysqli_fetch_array(mysqli_query($myConnection, "select * from tb_pegawai where id_peg = '$id_ppk'"));
    $id_bendahara = $viewKeg['id_bendahara'];
    $viewBendahara = mysqli_fetch_array(mysqli_query($myConnection, "select * from tb_pegawai where id_peg = '$id_bendahara'"));
    $no_bukti_pengarah = digitNoBukti(($noBuktiTranportPengarah - 1) + $no_urut);
    $no_bukti_pengarah_honor = digitNoBukti(($noBuktiHonorPengarah - 1) + $no_urut);

    if ($viewPengarah['status_kabkota_unit_kerja'] == 'Daratan') {
      $rincianPernyataan = 'Kwitansi transport darat (tiket bus, tiket kereta, transport online, tol, BBM dan lain-lain)';
    } else {
      $rincianPernyataan = 'Kwitansi transport (tiket kapal, tiket travel, tiket bus, tiket kereta, transport online, tol, BBM dan lain-lain)';
    }
    //modul 
    if ($viewPengarah['jenis_pengarah'] == 'eksternal') {
      include 'kuintansi-pengarah/kuitansi-honor.php';
    }
    include 'kuintansi-pengarah/kuitansi.php';
    include 'kuintansi-pengarah/rincian.php';
    include 'kuintansi-pengarah/surat_pernyataan.php';

    //modul

    $no_urut++;
  }
  $mpdf->Output("Kuitansi_Pengarah_BBPMP_Jatim_" . $viewKeg['nama_keg_kuitansi'] . ".pdf", "I");
  exit;
} else {
  echo "Forbidden Access<br><br><br><br>";
}
