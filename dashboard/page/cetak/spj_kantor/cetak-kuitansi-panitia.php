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
  $sqlPanitia = mysqli_query($myConnection, "select tb_panitia_keg_kantor.*, tb_pegawai.nama_peg as nama_peg, tb_jabatan_kegiatan.nama_jabatan
  from tb_panitia_keg_kantor
  left join tb_kegiatan on tb_kegiatan.id_keg = tb_panitia_keg_kantor.id_keg
  left join tb_pegawai on tb_pegawai.id_peg = tb_panitia_keg_kantor.id_peg
  left join tb_gol_pajak on tb_gol_pajak.id_pangkat = tb_pegawai.id_pangkat
  left join tb_jabatan_kegiatan on tb_jabatan_kegiatan.kd_jabatan = tb_panitia_keg_kantor.id_jab_st
  where tb_panitia_keg_kantor.id_keg = '$id_keg'
  order by tb_jabatan_kegiatan.kd_jabatan asc");
  $mpdf = new \Mpdf('', 'A4');
  $mpdf->SetTitle('Kuitansi_Perjadin_BBPMP_Jatim');
  $mpdf->SetAuthor('ANIMASIKU Studio');
  $mpdf->SetCreator('Adara Cassie Violeta Misbah');
  $mpdf->SetDefaultFont('times');
  $mpdf->SetDefaultFontSize('10');
  include 'css_generate_pdf.php';
  // $mpdf->StartProgressBarOutput(2);

  while ($viewPanitia = mysqli_fetch_array($sqlPanitia)) {
    $golPajakPanitia = $viewPanitia['id_pangkat_gol'];
    $totalTransportPanitia = $viewPanitia['bbm'] + $viewPanitia['tiket_pesawat'] + $viewPanitia['tiket_kapal'] + $viewPanitia['tiket'] + $viewPanitia['lokal'] + $viewPanitia['taksi'] + $viewPanitia['toll'] + $viewPanitia['dpr1'] + $viewPanitia['dpr2'];
    $jmlHariPanitia = (IntervalDays($viewPanitia['tgl_mulai'], $viewPanitia['tgl_selesai'])) + 1;
    $idKabKotaPanitia = $viewPanitia['id_kabkota_unit_kerja'];
    $viewSBMPanitia = mysqli_fetch_array(mysqli_query($myConnection, "select id, besaran from tb_kabkota where id = '$idKabKotaPanitia'"));
    $sbmPanitia = $viewSBMPanitia['id'] == 3578 ? $viewSBMPanitia['besaran'] : $viewSBMPanitia['besaran'] * 2;
    $uangHarianPanitia = $viewKeg['uh_panitia'] == '' ? '0' : $viewKeg['uh_panitia'] * $jmlHariPanitia;
    $jamPanitia = $viewPanitia['jml_jam'];
    if ($viewPanitia['id_jab_st'] == '1') {
      $uangHonorPanitia = $viewKeg['honor_penanggungjawab'] == '' ? '0' : $viewKeg['honor_penanggungjawab'] * $viewPanitia['jml_jam'];
      $honorPerJamPanitia = $viewKeg['honor_penanggungjawab'];
      $namaJabatan = 'Penanggungjawab';
    } elseif ($viewPanitia['id_jab_st'] == '3') {
      $uangHonorPanitia = $viewKeg['honor_ketua'] == '' ? '0' : $viewKeg['honor_ketua'] * $viewPanitia['jml_jam'];
      $honorPerJamPanitia = $viewKeg['honor_ketua'];
      $namaJabatan = 'Ketua Panitia';
    } elseif ($viewPanitia['id_jab_st'] == '12') {
      $uangHonorPanitia = $viewKeg['honor_anggota'] == '' ? '0' : $viewKeg['honor_anggota'] * $viewPanitia['jml_jam'];
      $honorPerJamPanitia = $viewKeg['honor_anggota'];
      $namaJabatan = 'Panitia';
    } else {
      $uangHonorPanitia = '';
      $honorPerJamPanitia = '';
      $namaJabatan = '';
    }
    $pajakPanitia = mysqli_fetch_array(mysqli_query($myConnection, "select gol, pajak from tb_gol_pajak where id_pangkat = '$golPajakPanitia'"));
    $potonganHonorPanitia = ($uangHonorPanitia) * ($pajakPanitia['pajak'] / 100);
    $uangHonorPanitiaPotongan = $uangHonorPanitia - $potonganHonorPanitia;

    $uangHarianPanitia = $viewKeg['uh_panitia'] == '' ? '0' : $viewKeg['uh_panitia'] * $jmlHariPanitia;

    if ($viewPanitia['jenis_panitia'] == 'internal') {
      $transportPanitia = 0;
      $uangHarianPanitia = 0;
    } else {
      $transportPanitia = $transportPanitia;
      $uangHarianPanitia = 0;
    }
    $jmlPerjadinPanitia = $transportPanitia + $uangHarianPanitia;
    $TotalPanitia = $transportPanitia + $uangHarianPanitia + $uangHonorPanitiaPotongan;


    //identitas pejabat
    $id_ppk = $viewKeg['id_ppk'];
    $viewPPK = mysqli_fetch_array(mysqli_query($myConnection, "select * from tb_pegawai where id_peg = '$id_ppk'"));
    $id_bendahara = $viewKeg['id_bendahara'];
    $viewBendahara = mysqli_fetch_array(mysqli_query($myConnection, "select * from tb_pegawai where id_peg = '$id_bendahara'"));
    $no_bukti_panitia = digitNoBukti(($noBuktiTranportPanitia - 1) + $no_urut);
    $no_bukti_panitia_honor = digitNoBukti(($noBuktiHonorPanitia - 1) + $no_urut);


    //modul 
    include 'kuintansi-panitia/kuitansi-honor.php';
    // include 'kuintansi-panitia/kuitansi.php';
    // include 'kuintansi-panitia/pengeluaran_riil.php';
    // include 'kuintansi-panitia/rincian.php';
    //modul

    $no_urut++;
  }
  $mpdf->Output("Kuitansi_Panitia_BBPMP_Jatim_" . $viewKeg['nama_keg_kuitansi'] . ".pdf", "I");
  exit;
} else {
  echo "Forbidden Access<br><br><br><br>";
}
