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
    $sqlPengarah = mysqli_query($myConnection, "select tb_pengarah_keg_kantor.* , tb_kabkota.name as nama_kab
    from tb_pengarah_keg_kantor
    left join tb_kabkota on tb_kabkota.id = tb_pengarah_keg_kantor.id_kabkota_unit_kerja
    where tb_pengarah_keg_kantor.id_keg = '$id_keg' ");
    $mpdf = new \Mpdf('', array(230, 110));
    $mpdf->SetTitle('Amplop_Perjadin_Pengarah_BBPMP_Jatim');
    $mpdf->SetAuthor('ANIMASIKU Studio');
    $mpdf->SetCreator('Adara Cassie Violeta Misbah');
    $mpdf->defaultheaderline = 0;
    $mpdf->defaultfooterline = 0;
    $mpdf->SetHeader($no_urut);
    $mpdf->SetDefaultFont('times');
    $mpdf->SetDefaultFontSize('10');
    include 'css_generate_pdf.php';
    // $mpdf->StartProgressBarOutput(2);

    while ($viewPengarah = mysqli_fetch_array($sqlPengarah)) {
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

        if ($viewPengarah['jenis_pengarah'] == 'eksternal') {
            $honorAmplop = 'Honorarium Pengarah dan ';
            $rincianAmplop = '<tr>
            <td width="27%">Transport</td>
            <td width="2%">:</td>
            <td width="2%" style="">Rp. </td>
            <td width="15%" style="text-align:right;">' . format_angka($transportPengarah) . ',-</td>
            <td></td>
            <td></td>
            </tr>
            <tr>
            <td width="27%">Honorarium - PPh 21</td>
            <td width="2%">:</td>
            <td width="2%" style="">Rp. </td>
            <td width="15%" style="text-align:right;">' . format_angka($uangHonorPengarahPotongan) . ',-</td>
            <td></td>
            <td></td>
            </tr>';
        } elseif ($viewPengarah['jenis_pengarah'] == 'internal') {
            $honorAmplop = '';
            $rincianAmplop = '<tr>
            <td width="27%">Transport</td>
            <td width="2%">:</td>
            <td width="2%" style="">Rp. </td>
            <td width="15%" style="text-align:right;">' . format_angka($transportPengarah) . ',-</td>
            <td></td>
            <td></td>
            </tr>';
        } else {
        }

        $mpdf->AddPage('P', '', '', '', '', 20, 20, 10, 10);

        $mpdf->WriteHTML('<table border="0" style="border-collapse: collapse;margin-bottom:0.5em" width="800px">');
        $mpdf->WriteHTML('<tr>
            <td></td>
            <td rowspan="2" style="text-align:center;font-size:15px;font-weight:bold;border-style:solid;border-width:1px 1px 1px 1px" width="10%">' . $no_urut . '</td>
           </tr>');
        $mpdf->WriteHTML('</table>');
        $mpdf->WriteHTML('<table border="1" style="border-collapse: collapse;" width="800px">');
        $mpdf->WriteHTML('<tr>
           <td style="padding-left:2em;font-weight:bold" height="50px">' . $viewPengarah['nama'] . '</td>
           </tr>');
        $mpdf->WriteHTML('</table>');
        $mpdf->WriteHTML('<div>
            <p>' . $honorAmplop . 'Perjalanan Dinas dari ' . $viewPengarah['kabkota_unit_kerja'] . ' - ' . str_replace('Kabupaten', 'Kab.', ucwords($viewKeg['nama_kab'])) . ' PP<br>' . $viewKeg['nama_keg_kuitansi'] . '<br>Tanggal ' . Indonesia2Tgl($viewPengarah['tgl_mulai']) . ' s.d ' . Indonesia2Tgl($viewPengarah['tgl_selesai']) . '</p>
            </div>');
        $mpdf->WriteHTML('<p style="text-decoration: underline;padding-top:-1em">Dengan Rincian :</p>');
        $mpdf->WriteHTML('<table border="0" style="border-collapse: collapse;margin-bottom:0.2em;" width="800px">');
        $mpdf->WriteHTML($rincianAmplop);
        $mpdf->WriteHTML('<tr>
            <td width="27%" height="35px" style="font-weight:bold">DITERIMAKAN</td>
            <td width="2%" style="font-weight:bold">:</td>
            <td width="2%" style="font-weight:bold;border-style:solid;border-top:1px">Rp. </td>
            <td width="15%" style="text-align:right;font-weight:bold;border-style:solid;border-top:1px">' . format_angka($jmlAmplopPengarah) . ',-</td>
            <td></td>
            <td></td>
            <td></td>
            </tr>');
        $mpdf->WriteHTML("</table>");

        $no_urut++;
    }
    $mpdf->Output("Amplop_Pengarah_BBPMP_Jatim_" . $pengaturan['nama_keg'] . ".pdf", "I");
    exit;
} else {
    echo "Forbidden Access<br><br><br><br>";
}
