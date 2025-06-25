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
    include 'css_generate_pdf.php';
    include 'generate_no_bukti.php';
    $sqlCekPeserta = mysqli_query($myConnection, "select tb_peserta_keg_hotel.* , tb_kabkota.name as nama_kab
    from tb_peserta_keg_hotel
    left join tb_kabkota on tb_kabkota.id = tb_peserta_keg_hotel.id_kabkota_unit_kerja
    where tb_peserta_keg_hotel.id_keg = '$id_keg'");

    $mpdf = new \Mpdf('', array(230, 110));
    $mpdf->SetTitle('Amplop_Perjadin_Peserta_BBPMP_Jatim');
    $mpdf->SetAuthor('ANIMASIKU Studio');
    $mpdf->SetCreator('Adara Cassie Violeta Misbah');
    $mpdf->defaultheaderline = 0;
    $mpdf->defaultfooterline = 0;
    $mpdf->SetHeader($no_urut);
    $mpdf->SetDefaultFont('times');
    $mpdf->SetDefaultFontSize('10');

    // $mpdf->StartProgressBarOutput(2);

    while ($viewPeserta = mysqli_fetch_array($sqlCekPeserta)) {
        $golPajakPeserta = $viewPeserta['id_pangkat_gol'];
        $pajakPeserta = mysqli_fetch_array(mysqli_query($myConnection, "select gol, pajak from tb_gol_pajak where id_pangkat = '$golPajakPeserta'"));

        $jmlHariPeserta = (IntervalDays($viewPeserta['tgl_mulai'], $viewPeserta['tgl_selesai'])) + 1;
        $idKabKotaPeserta = $viewPeserta['id_kabkota_unit_kerja'];
        $viewSBMPeserta = mysqli_fetch_array(mysqli_query($myConnection, "select id, besaran from tb_kabkota where id = '$idKabKotaPeserta'"));
        $sbmPeserta = $viewSBMPeserta['id'] == 3578 ? $viewSBMPeserta['besaran'] : $viewSBMPeserta['besaran'] * 2;


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

        if ($totalTransportPeserta > $sbmPeserta) {
            $transportPeserta = $sbmPeserta;
        } else {
            $transportPeserta = $totalTransportPeserta;
        }
        $jmlPerjadinPeserta = $transportPeserta + $tiketKapal + $uangHarianPeserta + $uangHarianPesertaHmin1 + $uangHarianPesertaHplus1 + $hotel;
        $TotalPeserta = $transportPeserta + $tiketKapal + $uangHarianPeserta + $uangHarianPesertaHmin1 + $uangHarianPesertaHplus1 + $hotel;

        $totalUangHarian = $uangHarianPeserta + $uangHarianPesertaHmin1 + $uangHarianPesertaHplus1;

        $no_bukti = digitNoBukti(($noBuktiTranportPeserta - 1) + $no_urut);

        if ($hotel != 0 || $hotel != "" || $hotel != NULL) {
            $kui_hotel = '<tr>
                            <td width="27%">Penginapan</td>
                            <td width="2%">:</td>
                            <td width="2%" style="">Rp. </td>
                            <td width="15%" style="text-align:right;">' . format_angka($hotel) . ',-</td>
                            <td></td>
                            <td></td>
                        </tr>';
        } else {
            $kui_hotel = '';
        }

        $mpdf->AddPage('P', '', '', '', '', 20, 20, 10, 10);

        //peserta daratan
        if ($viewPeserta['status_kabkota_unit_kerja'] == 'Daratan') {
            $mpdf->WriteHTML('<table border="0" style="border-collapse: collapse;margin-bottom:0.5em" width="800px">');
            $mpdf->WriteHTML('<tr>
            <td></td>
            <td rowspan="2" style="text-align:center;font-size:15px;font-weight:bold;border-style:solid;border-width:1px 1px 1px 1px" width="10%">' . $no_urut . '</td>
           </tr>');
            $mpdf->WriteHTML('</table>');
            $mpdf->WriteHTML('<table border="1" style="border-collapse: collapse;" width="800px">');
            $mpdf->WriteHTML('<tr>
           <td style="padding-left:2em;font-weight:bold" height="50px">' . $viewPeserta['nama'] . '</td>
           </tr>');
            $mpdf->WriteHTML('</table>');
            $mpdf->WriteHTML('<div>
            <p>Perjalanan Dinas Peserta dari ' . $viewPeserta['kabkota_unit_kerja'] . ' - ' . str_replace('Kabupaten', 'Kab.', ucwords($viewKeg['nama_kab'])) . ' PP<br>' . $viewKeg['nama_keg_kuitansi'] . '<br>Tanggal ' . Indonesia2Tgl($viewPeserta['tgl_mulai']) . ' s.d ' . Indonesia2Tgl($viewPeserta['tgl_selesai']) . '</p>
            </div>');
            $mpdf->WriteHTML('<p style="text-decoration: underline;padding-top:-1em">Dengan Rincian :</p>');
            $mpdf->WriteHTML('<table border="0" style="border-collapse: collapse;margin-bottom:0.2em;" width="800px">');
            $mpdf->WriteHTML('<tr>
            <td width="27%">Transport</td>
            <td width="2%">:</td>
            <td width="2%" style="">Rp. </td>
            <td width="15%" style="text-align:right;">' . format_angka($transportPeserta) . ',-</td>
            <td></td>
            <td></td>
            </tr>');
            $mpdf->WriteHTML('<tr>
            <td width="27%">Uang Harian (' . $jmlHariPeserta . ' Hari)</td>
            <td width="2%">:</td>
            <td width="2%" style="">Rp. </td>
            <td width="15%" style="text-align:right;">' . format_angka($totalUangHarian) . ',-</td>
            <td></td>
            <td></td>
            </tr>');
            $mpdf->WriteHTML('<tr>
            <td width="27%" height="35px" style="font-weight:bold">DITERIMAKAN</td>
            <td width="2%" style="font-weight:bold">:</td>
            <td width="2%" style="font-weight:bold;border-style:solid;border-top:1px">Rp. </td>
            <td width="15%" style="text-align:right;font-weight:bold;border-style:solid;border-top:1px">' . format_angka($TotalPeserta) . ',-</td>
            <td></td>
            <td></td>
            <td></td>
            </tr>');
            $mpdf->WriteHTML("</table>");
        } elseif ($viewPeserta['status_kabkota_unit_kerja'] == 'Kepulauan') {
            $mpdf->WriteHTML('<table border="0" style="border-collapse: collapse;margin-bottom:0.5em" width="800px">');
            $mpdf->WriteHTML('<tr>
            <td></td>
            <td rowspan="2" style="text-align:center;font-size:15px;font-weight:bold;border-style:solid;border-width:1px 1px 1px 1px" width="10%">' . $no_urut . '</td>
           </tr>');
            $mpdf->WriteHTML('</table>');
            $mpdf->WriteHTML('<table border="1" style="border-collapse: collapse;" width="800px">');
            $mpdf->WriteHTML('<tr>
           <td style="padding-left:2em;font-weight:bold" height="50px">' . $viewPeserta['nama'] . '</td>
           </tr>');
            $mpdf->WriteHTML('</table>');
            $mpdf->WriteHTML('<div>
            <p>Perjalanan Dinas Peserta dari ' . $viewPeserta['kabkota_unit_kerja'] . ' - ' . str_replace('Kabupaten', 'Kab.', ucwords($viewKeg['nama_kab'])) . ' PP<br>' . $viewKeg['nama_keg_kuitansi'] . '<br>Tanggal ' . Indonesia2Tgl($viewPeserta['tgl_mulai']) . ' s.d ' . Indonesia2Tgl($viewPeserta['tgl_selesai']) . '</p>
            </div>');
            $mpdf->WriteHTML('<p style="text-decoration: underline;padding-top:-2em;padding-bottom:-1em">Dengan Rincian :</p>');
            $mpdf->WriteHTML('<table border="0" style="border-collapse: collapse;" width="800px">');
            $mpdf->WriteHTML('<tr>
            <td width="27%">Transport Darat</td>
            <td width="2%">:</td>
            <td width="2%" style="">Rp. </td>
            <td width="15%" style="text-align:right;">' . format_angka($transportPeserta) . ',-</td>
            <td></td>
            <td></td>
            </tr>');
            $mpdf->WriteHTML('<tr>
            <td width="27%">Tiket Kapal</td>
            <td width="2%">:</td>
            <td width="2%" style="">Rp. </td>
            <td width="15%" style="text-align:right;">' . format_angka($tiketKapal) . ',-</td>
            <td></td>
            <td></td>
            </tr>');
            $mpdf->WriteHTML('<tr>
            <td width="27%">Uang Harian (' . $jmlHariPeserta . ' Hari)</td>
            <td width="2%">:</td>
            <td width="2%" style="">Rp. </td>
            <td width="15%" style="text-align:right;">' . format_angka($totalUangHarian) . ',-</td>
            <td></td>
            <td></td>
            </tr>');
            $mpdf->WriteHTML('<tr>
            <td width="27%">Uang Harian H - 1</td>
            <td width="2%">:</td>
            <td width="2%" style="">Rp. </td>
            <td width="15%" style="text-align:right;">' . format_angka($uangHarianPesertaHmin1) . ',-</td>
            <td></td>
            <td></td>
            </tr>');
            $mpdf->WriteHTML('<tr>
            <td width="27%">Uang Harian H + 1</td>
            <td width="2%">:</td>
            <td width="2%" style="">Rp. </td>
            <td width="15%" style="text-align:right;">' . format_angka($uangHarianPesertaHplus1) . ',-</td>
            <td></td>
            <td></td>
            </tr>');
            $mpdf->WriteHTML($kui_hotel);
            $mpdf->WriteHTML('<tr>
            <td width="27%" height="35px" style="font-weight:bold">DITERIMAKAN</td>
            <td width="2%" style="font-weight:bold">:</td>
            <td width="2%" style="font-weight:bold;border-style:solid;border-top:1px">Rp. </td>
            <td width="15%" style="text-align:right;font-weight:bold;border-style:solid;border-top:1px">' . format_angka($TotalPeserta) . ',-</td>
            <td></td>
            <td></td>
            <td></td>
            </tr>');
            $mpdf->WriteHTML("</table>");
        }

        $no_urut++;
    }
    $mpdf->Output("Amplop_Peserta_BBPMP_Jatim_" . $pengaturan['nama_keg'] . ".pdf", "I");
    exit;
} else {
    echo "Forbidden Access<br><br><br><br>";
}
