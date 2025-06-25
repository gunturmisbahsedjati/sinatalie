<?php
// uncomment jika terjadi error pada mpdf
// ini_set('display_errors','off');
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

    $mpdf = new \Mpdf('', array(230, 110));
    $mpdf->SetTitle('Amplop_Perjadin_Narsum_BBPMP_Jatim');
    $mpdf->SetAuthor('ANIMASIKU Studio');
    $mpdf->SetCreator('Adara Cassie Violeta Misbah');
    $mpdf->defaultheaderline = 0;
    $mpdf->defaultfooterline = 0;
    $mpdf->SetHeader($no_urut);
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

        $jmlPerjadinNarsum = $transportNarsum + $uangHarianNarsum + $tiketPesawat + $hotel;


        if ($viewNarsum['jenis_narsum'] == 'eksternal') {
            if ($cekJatim['province_id'] == '35') {
                if ($viewNarsum['status_internal_kemdikbud'] == 1) {
                    $honorAmplop = '';
                    $rincianAmplop = '<tr>
                        <td width="27%">Transport Darat</td>
                        <td width="2%">:</td>
                        <td width="2%" style="">Rp. </td>
                        <td width="15%" style="text-align:right;">' . format_angka($transportNarsum) . ',-</td>
                        <td></td>
                        <td></td>
                        </tr>
                        <tr>
                        <td width="27%">Uang Harian</td>
                        <td width="2%">:</td>
                        <td width="2%" style="">Rp. </td>
                        <td width="15%" style="text-align:right;">' . format_angka($uangHarianNarsum) . ',-</td>
                        <td></td>
                        <td></td>
                        </tr>
                        <tr>
                        <td width="27%">Penginapan</td>
                        <td width="2%">:</td>
                        <td width="2%" style="">Rp. </td>
                        <td width="15%" style="text-align:right;">' . format_angka($hotel) . ',-</td>
                        <td></td>
                        <td></td>
                        </tr>
                        <tr>
                        <td width="27%" height="35px" style="font-weight:bold">DITERIMAKAN</td>
                        <td width="2%" style="font-weight:bold">:</td>
                        <td width="2%" style="font-weight:bold;border-style:solid;border-top:1px">Rp. </td>
                        <td width="15%" style="text-align:right;font-weight:bold;border-style:solid;border-top:1px">' . format_angka($jmlPerjadinNarsum) . ',-</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        </tr>';
                } else {
                    $honorAmplop = 'Honorarium Narasumber (PPh 21) dan ';
                    $rincianAmplop = '<tr>
                                    <td width="27%">Honorarium - PPh 21</td>
                                    <td width="2%">:</td>
                                    <td width="2%" style="">Rp. </td>
                                    <td width="15%" style="text-align:right;">' . format_angka($uangHonorNarsumPotongan) . ',-</td>
                                    <td></td>
                                    <td></td>
                                    </tr>
                                    <tr>
                                    <td width="27%">Transport</td>
                                    <td width="2%">:</td>
                                    <td width="2%" style="">Rp. </td>
                                    <td width="15%" style="text-align:right;">' . format_angka($transportNarsum) . ',-</td>
                                    <td></td>
                                    <td></td>
                                    </tr>
                                    <tr>
                                    <td width="27%" height="35px" style="font-weight:bold">DITERIMAKAN</td>
                                    <td width="2%" style="font-weight:bold">:</td>
                                    <td width="2%" style="font-weight:bold;border-style:solid;border-top:1px">Rp. </td>
                                    <td width="15%" style="text-align:right;font-weight:bold;border-style:solid;border-top:1px">' . format_angka($jmlPerjadinNarsum + $uangHonorNarsumPotongan) . ',-</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    </tr>';
                }
            } else {
                if ($viewNarsum['status_internal_kemdikbud'] == 1) {
                    $honorAmplop = '';
                    $rincianAmplop = '<tr>
                        <td width="27%">Transport Darat</td>
                        <td width="2%">:</td>
                        <td width="2%" style="">Rp. </td>
                        <td width="15%" style="text-align:right;">' . format_angka($transportNarsum) . ',-</td>
                        <td></td>
                        <td></td>
                        </tr>
                        <tr>
                        <td width="27%">Tiket Pesawat PP</td>
                        <td width="2%">:</td>
                        <td width="2%" style="">Rp. </td>
                        <td width="15%" style="text-align:right;">' . format_angka($tiketPesawat) . ',-</td>
                        <td></td>
                        <td></td>
                        </tr>
                        <tr>
                        <td width="27%">Uang Harian</td>
                        <td width="2%">:</td>
                        <td width="2%" style="">Rp. </td>
                        <td width="15%" style="text-align:right;">' . format_angka($uangHarianNarsum) . ',-</td>
                        <td></td>
                        <td></td>
                        </tr>
                        <tr>
                        <td width="27%">Penginapan</td>
                        <td width="2%">:</td>
                        <td width="2%" style="">Rp. </td>
                        <td width="15%" style="text-align:right;">' . format_angka($hotel) . ',-</td>
                        <td></td>
                        <td></td>
                        </tr>
                        <tr>
                        <td width="27%" height="35px" style="font-weight:bold">DITERIMAKAN</td>
                        <td width="2%" style="font-weight:bold">:</td>
                        <td width="2%" style="font-weight:bold;border-style:solid;border-top:1px">Rp. </td>
                        <td width="15%" style="text-align:right;font-weight:bold;border-style:solid;border-top:1px">' . format_angka($jmlPerjadinNarsum) . ',-</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        </tr>';
                } else {
                    $honorAmplop = 'Honorarium Narasumber (PPh 21) dan ';
                    $rincianAmplop = '<tr>
                        <td width="27%">Honorarium - PPh 21</td>
                        <td width="2%">:</td>
                        <td width="2%" style="">Rp. </td>
                        <td width="15%" style="text-align:right;">' . format_angka($uangHonorNarsumPotongan) . ',-</td>
                        <td></td>
                        <td></td>
                        </tr>
                        <tr>
                        <td width="27%">Transport Darat</td>
                        <td width="2%">:</td>
                        <td width="2%" style="">Rp. </td>
                        <td width="15%" style="text-align:right;">' . format_angka($transportNarsum) . ',-</td>
                        <td></td>
                        <td></td>
                        </tr>
                        <tr>
                        <td width="27%">Tiket Pesawat PP</td>
                        <td width="2%">:</td>
                        <td width="2%" style="">Rp. </td>
                        <td width="15%" style="text-align:right;">' . format_angka($tiketPesawat) . ',-</td>
                        <td></td>
                        <td></td>
                        </tr>
                        <tr>
                        <td width="27%" height="35px" style="font-weight:bold">DITERIMAKAN</td>
                        <td width="2%" style="font-weight:bold">:</td>
                        <td width="2%" style="font-weight:bold;border-style:solid;border-top:1px">Rp. </td>
                        <td width="15%" style="text-align:right;font-weight:bold;border-style:solid;border-top:1px">' . format_angka($jmlPerjadinNarsum + $uangHonorNarsumPotongan) . ',-</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        </tr>';
                }
            }
        } elseif ($viewNarsum['jenis_narsum'] == 'internal') {
            $honorAmplop = '';
            $rincianAmplop = '<tr>
            <td width="27%">Transport</td>
            <td width="2%">:</td>
            <td width="2%" style="">Rp. </td>
            <td width="15%" style="text-align:right;">' . format_angka($transportNarsum) . ',-</td>
            <td></td>
            <td></td>
            </tr>
            <tr>
            <td width="27%">Uang Harian (' . $jmlHariNarsum . ' Hari)</td>
            <td width="2%">:</td>
            <td width="2%" style="">Rp. </td>
            <td width="15%" style="text-align:right;">' . format_angka($uangHarianNarsum) . ',-</td>
            <td></td>
            <td></td>
            </tr>
            <tr>
            <td width="27%" height="35px" style="font-weight:bold">DITERIMAKAN</td>
            <td width="2%" style="font-weight:bold">:</td>
            <td width="2%" style="font-weight:bold;border-style:solid;border-top:1px">Rp. </td>
            <td width="15%" style="text-align:right;font-weight:bold;border-style:solid;border-top:1px">' . format_angka($jmlPerjadinNarsum) . ',-</td>
            <td></td>
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
           <td style="padding-left:2em;font-weight:bold" height="50px">' . $viewNarsum['nama'] . '</td>
           </tr>');
        $mpdf->WriteHTML('</table>');
        $mpdf->WriteHTML('<div>
            <p>' . $honorAmplop . 'Perjalanan Dinas dari ' . $viewNarsum['kabkota_unit_kerja'] . ' - ' . str_replace('Kabupaten', 'Kab.', ucwords($viewKeg['nama_kab'])) . ' PP<br>' . $viewKeg['nama_keg_kuitansi'] . '<br>Tanggal ' . Indonesia2Tgl($viewNarsum['tgl_mulai']) . ' s.d ' . Indonesia2Tgl($viewNarsum['tgl_selesai']) . '</p>
            </div>');
        $mpdf->WriteHTML('<p style="text-decoration: underline;padding-top:-1em">Dengan Rincian :</p>');
        $mpdf->WriteHTML('<table border="0" style="border-collapse: collapse;margin-bottom:0.2em;" width="800px">');
        $mpdf->WriteHTML($rincianAmplop);


        $mpdf->WriteHTML("</table>");

        $no_urut++;
    }
    $mpdf->Output("Amplop_Narsum_BBPMP_Jatim_" . $pengaturan['nama_keg'] . ".pdf", "I");
    exit;
} else {
    echo "Forbidden Access<br><br><br><br>";
}
