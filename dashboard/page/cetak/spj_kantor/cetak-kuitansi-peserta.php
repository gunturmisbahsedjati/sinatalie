<?php
// uncomment jika terjadi error pada mpdf
// ini_set('display_errors','off');
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

$sqlKegiatan = mysqli_query($myConnection, "select tb_kegiatan.*, tb_kabkota.name as nama_kab, tb_profil_sptjb.nama_satker, tb_profil_sptjb.kode_satker, tb_profil_sptjb.no_dipa, tb_profil_sptjb.tgl_dipa, tb_profil_sptjb.klasifikasi, tb_profil_sptjb.no_dipa
from tb_kegiatan
left join tb_kabkota on tb_kabkota.id = tb_kegiatan.kabkota
left join tb_profil_sptjb on tb_profil_sptjb.id_profil_sptjb = tb_kegiatan.profil_dipa
where tb_kegiatan.id_keg = '$id_keg'");
if (mysqli_num_rows($sqlKegiatan) > 0) {
  $viewKeg = mysqli_fetch_array($sqlKegiatan);
  include 'generate_no_bukti.php';
  $sqlCekPeserta = mysqli_query($myConnection, "select tb_peserta_keg_kantor.* , tb_kabkota.name as nama_kab
    from tb_peserta_keg_kantor
    left join tb_kabkota on tb_kabkota.id = tb_peserta_keg_kantor.id_kabkota_unit_kerja
    where tb_peserta_keg_kantor.id_keg = '$id_keg' ");
  //and tb_peserta_keg_kantor.jenis_peserta = 'eksternal' limit 3
  $mpdf = new \Mpdf('', 'A4');
  $mpdf->SetTitle('Kuitansi_Perjadin_BBPMP_Jatim');
  $mpdf->SetAuthor('ANIMASIKU Studio');
  $mpdf->SetCreator('Adara Cassie Violeta Misbah');
  $mpdf->SetDefaultFont('times');
  $mpdf->SetDefaultFontSize('10');
  // include 'css_generate_pdf.php';
  // $mpdf->StartProgressBarOutput(2);



  while ($viewPeserta = mysqli_fetch_array($sqlCekPeserta)) {
    $golPajakPeserta = $viewPeserta['id_pangkat_gol'];
    $pajakPeserta = mysqli_fetch_array(mysqli_query($myConnection, "select gol, pajak from tb_gol_pajak where id_pangkat = '$golPajakPeserta'"));

    $jmlHariPeserta = (IntervalDays($viewPeserta['tgl_mulai'], $viewPeserta['tgl_selesai'])) + 1;
    $idKabKotaPeserta = $viewPeserta['id_kabkota_unit_kerja'];
    $viewSBMPeserta = mysqli_fetch_array(mysqli_query($myConnection, "select id, besaran from tb_kabkota where id = '$idKabKotaPeserta'"));
    $sbmPeserta = $viewSBMPeserta['id'] == 3578 ? $viewSBMPeserta['besaran'] : $viewSBMPeserta['besaran'] * 2;


    // if ($viewPeserta['dpr1'] == NULL || $viewPeserta['dpr1'] == '') {
    if ($viewPeserta['status_kabkota_unit_kerja'] == 'Daratan') {
      $totalTransportPeserta = $viewPeserta['bbm'] + $viewPeserta['tiket_pesawat'] + $viewPeserta['tiket'] + $viewPeserta['tiket_kapal'] + $viewPeserta['lokal'] + $viewPeserta['taksi'] + $viewPeserta['toll'] + $viewPeserta['dpr1'] + $viewPeserta['dpr2'];
      $uangHarianPeserta = $viewKeg['uh_peserta'] * $jmlHariPeserta;
      $tiketKapal = 0;
      $uangHarianPesertaHmin1 = 0;
      $uangHarianPesertaHplus1 = 0;
      $hotel = 0;
    } else {
      $totalTransportPeserta = $viewPeserta['bbm'] + $viewPeserta['tiket'] + $viewPeserta['lokal'] + $viewPeserta['taksi'] + $viewPeserta['toll'] + $viewPeserta['dpr1'] + $viewPeserta['dpr2'];
      $tiketKapal = $viewPeserta['tiket_kapal'];
      $uangHarianPeserta = $viewKeg['uh_peserta'] * $jmlHariPeserta;
      $uangHarianPesertaHmin1 = $viewKeg['uh_peserta'];
      $uangHarianPesertaHplus1 = $viewKeg['uh_peserta'];
      $hotel = $viewPeserta['penginapan'];
    }
    // } else {
    //   $TransportPesertaPP = $totalTransportPeserta + $viewPeserta['dpr1'];
    //   $totalTransportPeserta = ($viewPeserta['dpr1'] + $viewPeserta['dpr2']) * 2;
    // }

    if ($totalTransportPeserta > $sbmPeserta) {
      $transportPeserta = $sbmPeserta;
    } else {
      $transportPeserta = $totalTransportPeserta;
    }
    $jmlPerjadinPeserta = $transportPeserta + $tiketKapal + $uangHarianPeserta + $uangHarianPesertaHmin1 + $uangHarianPesertaHplus1 + $hotel;
    $TotalPeserta = $transportPeserta + $tiketKapal + $uangHarianPeserta + $uangHarianPesertaHmin1 + $uangHarianPesertaHplus1 + $hotel;

    if ($viewPeserta['status_kabkota_unit_kerja'] == 'Daratan') {
      $rincianPernyataan = 'Kwitansi transport darat (tiket bus, tiket kereta, transport online, tol, BBM dan lain-lain)';
    } else {
      $rincianPernyataan = 'Kwitansi transport (tiket kapal, tiket travel, tiket bus, tiket kereta, transport online, tol, BBM dan lain-lain)';
    }

    if ($viewPeserta['jenis_peserta'] == 'internal') {
      $transportPeserta = 0;
      $tiketKapal = 0;
      $uangHarianPeserta = 0;
      $uangHarianPesertaHmin1 = 0;
      $uangHarianPesertaHplus1 = 0;
      $hotel = 0;
      $jmlPerjadinPeserta = 0;
      $TotalPeserta = 0;
    } elseif ($viewPeserta['jenis_peserta'] == 'eksternal') {
      $transportPeserta = $transportPeserta;
      $tiketKapal = $tiketKapal;
      $uangHarianPeserta = $uangHarianPeserta;
      $uangHarianPesertaHmin1 = $uangHarianPesertaHmin1;
      $uangHarianPesertaHplus1 = $uangHarianPesertaHplus1;
      $hotel = $hotel;
      $jmlPerjadinPeserta = $transportPeserta + $tiketKapal + $uangHarianPeserta + $uangHarianPesertaHmin1 + $uangHarianPesertaHplus1 + $hotel;
      $TotalPeserta = $transportPeserta + $tiketKapal + $uangHarianPeserta + $uangHarianPesertaHmin1 + $uangHarianPesertaHplus1 + $hotel;
    } else {
      $transportPeserta = 0;
      $tiketKapal = 0;
      $uangHarianPeserta = 0;
      $uangHarianPesertaHmin1 = 0;
      $uangHarianPesertaHplus1 = 0;
      $hotel = 0;
      $jmlPerjadinPeserta = 0;
      $TotalPeserta = 0;
    }

    //identitas pejabat
    $id_ppk = $viewKeg['id_ppk'];
    $viewPPK = mysqli_fetch_array(mysqli_query($myConnection, "select * from tb_pegawai where id_peg = '$id_ppk'"));
    $id_bendahara = $viewKeg['id_bendahara'];
    $viewBendahara = mysqli_fetch_array(mysqli_query($myConnection, "select * from tb_pegawai where id_peg = '$id_bendahara'"));
    $no_bukti = digitNoBukti(($noBuktiTranportPeserta - 1) + $no_urut);


    //modul 
    if ($viewPeserta['status_kabkota_unit_kerja'] == 'Daratan') {
      include 'kuintansi-peserta/kuitansi.php';
      if ($viewSBMPeserta['id'] == 3578 || ($viewPeserta['dpr1'] != NULL || $viewPeserta['dpr1'] != '')) {
        include 'kuintansi-peserta/pengeluaran_riil.php';
      }
      include 'kuintansi-peserta/rincian.php';
      if ($viewSBMPeserta['id'] != 3578) {
        include 'kuintansi-peserta/surat_pernyataan.php';
      }
    } elseif ($viewPeserta['status_kabkota_unit_kerja'] == 'Kepulauan') {
      include 'kuintansi-peserta/kuitansi-pulau.php';
      if ($viewSBMPeserta['id'] == 3578 || ($viewPeserta['dpr1'] != NULL || $viewPeserta['dpr1'] != '')) {
        include 'kuintansi-peserta/pengeluaran_riil.php';
      }
      include 'kuintansi-peserta/rincian-pulau.php';
      if ($viewSBMPeserta['id'] != 3578) {
        include 'kuintansi-peserta/surat_pernyataan-pulau.php';
      }
    }
    //modul

    $no_urut++;
  }
  $mpdf->Output("Kuitansi_Peserta_BBPMP_Jatim_" . $viewKeg['nama_keg_kuitansi'] . ".pdf", "I");
  exit;
} else {
  echo "Forbidden Access<br><br><br><br>";
}
