<?php
define('_MPDF_URI', '../../../assets/vendor/libs/MPDF57/');
require_once '../../../inc/inc.koneksi.php';
require_once '../../../inc/inc.library.php';
require_once('../../../assets/vendor/libs/MPDF57/mpdf.php');
require_once '../../../assets/vendor/libs/phpqrcode/qrlib.php';

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
  $sqlNarsum = mysqli_query($myConnection, "select tb_narsum_keg_hotel.* , tb_kabkota.name as nama_kab
from tb_narsum_keg_hotel
left join tb_kabkota on tb_kabkota.id = tb_narsum_keg_hotel.id_kabkota_unit_kerja
where tb_narsum_keg_hotel.id_keg = '$id_keg'");

  $mpdf = new \Mpdf('', 'A4');
  $mpdf->SetTitle('Kuitansi_Perjadin_BBPMP_Jatim');
  $mpdf->SetAuthor('ANIMASIKU Studio');
  $mpdf->SetCreator('Adara Cassie Violeta Misbah');
  $mpdf->SetDefaultFont('times');
  $mpdf->SetDefaultFontSize('10');

  include 'css_generate_pdf.php';
  // $mpdf->StartProgressBarOutput(2);

  while ($viewNarsum = mysqli_fetch_array($sqlNarsum)) {
    $golPajakNarsum = $viewNarsum['id_pangkat_gol'];
    $jmlHariNarsum = (IntervalDays($viewNarsum['tgl_mulai'], $viewNarsum['tgl_selesai'])) + 1;
    $idKabKota = $viewNarsum['id_kabkota_unit_kerja'];



    $viewSBMNarsum = mysqli_fetch_array(mysqli_query($myConnection, "select id, besaran from tb_kabkota where id = '$idKabKota'"));
    $cekJatim = mysqli_fetch_array(mysqli_query($myConnection, "select * from tb_kabkota where id = '$idKabKota'"));


    $sbmNarsum = $viewSBMNarsum['id'] == 3578 ? $viewSBMNarsum['besaran'] : $viewSBMNarsum['besaran'] * 2;
    if ($viewNarsum['jenis_narsum'] == 'internal') {
      $uangHarianNarsum = $viewKeg['uh_narsum_i'] == '' ? '0' : $viewKeg['uh_narsum_i'] * $jmlHariNarsum;
      $uangHonorNarsum = '';
      $makHonorNarsum = $viewKeg['mak_hr_narsum_i'];
      $makTranportNarsum = $viewKeg['mak_tp_narsum_i'];
      $honorPerJamNarsum = '';
      $jamNarsum = '';
      $hotel = 0;
    } elseif ($viewNarsum['jenis_narsum'] == 'eksternal') {
      if ($viewNarsum['status_internal_kemdikbud'] == 1) {
        $uangHarianNarsum = $viewKeg['uh_narsum_i_kemdikbud'] == '' ? '0' : $viewKeg['uh_narsum_i_kemdikbud'] * $jmlHariNarsum;
        $uangHonorNarsum = 0;
        $hotel = $viewNarsum['penginapan'];
        $makHonorNarsum = $viewKeg['mak_hr_narsum_e'];
        $makTranportNarsum = $viewKeg['mak_tp_narsum_e'];
        $honorPerJamNarsum = $viewKeg['honor_narsum_e'];
        $jamNarsum = '';
      } else {
        $uangHarianNarsum = '';
        $uangHonorNarsum = $viewKeg['honor_narsum_e'] == '' ? '0' : $viewKeg['honor_narsum_e'] * $viewNarsum['jml_jam'];
        $makHonorNarsum = $viewKeg['mak_hr_narsum_e'];
        $makTranportNarsum = $viewKeg['mak_tp_narsum_e'];
        $honorPerJamNarsum = $viewKeg['honor_narsum_e'];
        $jamNarsum = $viewNarsum['jml_jam'];
        $hotel = 0;
      }
    } else {
      $uangHarianNarsum = '';
      $uangHonorNarsum = '';
      $makHonorNarsum = '';
      $makTranportNarsum = '';
      $honorPerJamNarsum = '';
      $jamNarsum = '';
      $hotel = 0;
    }
    $pajakNarsum = mysqli_fetch_array(mysqli_query($myConnection, "select gol,pajak from tb_gol_pajak where id_pangkat = '$golPajakNarsum'"));
    $potonganHonorNarsum = ($uangHonorNarsum) * ($pajakNarsum['pajak'] / 100);
    $uangHonorNarsumPotongan = $uangHonorNarsum - $potonganHonorNarsum;

    if ($cekJatim['province_id'] == '35') {
      $totalTransportNarsum = $viewNarsum['bbm'] + $viewNarsum['tiket_pesawat'] + $viewNarsum['tiket_kapal'] + $viewNarsum['tiket'] + $viewNarsum['lokal'] + $viewNarsum['lokal_jakarta'] + $viewNarsum['taksi'] + $viewNarsum['toll'] + $viewNarsum['dpr1'] + $viewNarsum['dpr2'];
      $tiketPesawat = '';
    } else {
      $totalTransportNarsum = $viewNarsum['bbm'] + $viewNarsum['tiket'] + $viewNarsum['lokal'] + $viewNarsum['lokal_jakarta'] + $viewNarsum['taksi'] + $viewNarsum['toll'] + $viewNarsum['dpr1'] + $viewNarsum['dpr2'];
      $tiketPesawat = $viewNarsum['tiket_pesawat'];
    }

    if ($totalTransportNarsum > $sbmNarsum) {
      $transportNarsum = $sbmNarsum;
    } else {
      $transportNarsum = $totalTransportNarsum;
    }

    // if (($viewNarsum['lokal'] != NULL || $viewNarsum['lokal'] != '') || ($viewNarsum['dpr1'] != NULL || $viewNarsum['dpr1'] != '')) {
    $totalDPR = $viewNarsum['lokal'] + $viewNarsum['lokal_jakarta'] + $viewNarsum['dpr1'];
    // } else {
    //   # code...
    // }

    $jmlPerjadinNarsum = $transportNarsum + $uangHarianNarsum + $tiketPesawat + $hotel;

    //identitas pejabat
    $id_ppk = $viewKeg['id_ppk'];
    $viewPPK = mysqli_fetch_array(mysqli_query($myConnection, "select * from tb_pegawai where id_peg = '$id_ppk'"));
    $id_bendahara = $viewKeg['id_bendahara'];
    $viewBendahara = mysqli_fetch_array(mysqli_query($myConnection, "select * from tb_pegawai where id_peg = '$id_bendahara'"));
    $no_bukti_narsum = digitNoBukti(($noBuktiTranportNarsum - 1) + $no_urut);
    $no_bukti_narsum_honor = digitNoBukti(($noBuktiHonorNarsum - 1) + $no_urut);

    if ($viewNarsum['status_kabkota_unit_kerja'] == 'Daratan' && $cekJatim['province_id'] == '35') {
      $rincianPernyataan = 'Kwitansi transport darat (tiket bus, tiket kereta, transport online, tol, BBM dan lain-lain)';
    } else {
      $rincianPernyataan = 'Kwitansi transport (tiket kapal, tiket travel, tiket bus, tiket kereta, transport online, tol, BBM dan lain-lain)';
    }


    //modul 
    if ($viewNarsum['jenis_narsum'] == 'eksternal') {
      if ($cekJatim['province_id'] == '35') {
        if ($viewNarsum['status_internal_kemdikbud'] == 1) {
          // include 'kuintansi-narsum/kuitansi-honor.php';
          include 'kuintansi-narsum/kuitansi-dalam-jatim-internal.php';
          include 'kuintansi-narsum/pengeluaran_riil_internal.php';
          include 'kuintansi-narsum/rincian-dalam-jatim-internal.php';
        } else {
          include 'kuintansi-narsum/kuitansi-honor.php';
          include 'kuintansi-narsum/kuitansi.php';
          include 'kuintansi-narsum/pengeluaran_riil_eksternal_lokal.php';
          include 'kuintansi-narsum/rincian.php';
        }
        // include 'kuintansi-narsum/kuitansi-honor.php';
        // include 'kuintansi-narsum/kuitansi.php';
        // include 'kuintansi-narsum/rincian.php';
        include 'kuintansi-narsum/surat_pernyataan.php';
      } else {
        if ($viewNarsum['status_internal_kemdikbud'] == 1) {
          include 'kuintansi-narsum/kuitansi-luar-jatim-internal.php';
          include 'kuintansi-narsum/pengeluaran_riil.php';
          include 'kuintansi-narsum/rincian-luar-jatim-internal.php';
        } else {
          include 'kuintansi-narsum/kuitansi-honor.php';
          include 'kuintansi-narsum/kuitansi-luar-jatim.php';
          include 'kuintansi-narsum/pengeluaran_riil.php';
          include 'kuintansi-narsum/rincian-luar-jatim.php';
        }
        include 'kuintansi-narsum/surat_pernyataan_luar_jatim.php';
      }
    } elseif ($viewNarsum['jenis_narsum'] == 'internal') {
      include 'kuintansi-narsum/kuitansi-internal.php';
      include 'kuintansi-narsum/pengeluaran_riil_internal.php';
      include 'kuintansi-narsum/rincian_internal.php';
    } else {
    }
    //modul

    $no_urut++;
  }
  $mpdf->Output("Kuitansi_Narsum_BBPMP_Jatim_" . $viewKeg['nama_keg_kuitansi'] . ".pdf", "I");
  exit;
} else {
  echo "Forbidden Access<br><br><br><br>";
}
