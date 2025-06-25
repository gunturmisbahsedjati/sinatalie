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

    $mpdf = new \Mpdf('', array(230, 110));
    $mpdf->SetTitle('Amplop_Perjadin_Panitia_BBPMP_Jatim');
    $mpdf->SetAuthor('ANIMASIKU Studio');
    $mpdf->SetCreator('Adara Cassie Violeta Misbah');
    $mpdf->defaultheaderline = 0;
    $mpdf->defaultfooterline = 0;
    $mpdf->SetHeader($no_urut);
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

        if ($totalTransportPanitia > $sbmPanitia) {
            $transportPanitia = $sbmPanitia;
        } else {
            $transportPanitia = $totalTransportPanitia;
        }

        if ($viewPanitia['jenis_panitia'] == 'internal') {
            $transportPanitia = 0;
            $uangHarianPanitia = 0;
        } else {
            $transportPanitia = $transportPanitia;
            $uangHarianPanitia = 0;
        }
        $jmlPerjadinPanitia = $transportPanitia + $uangHarianPanitia;
        $TotalPanitia = $transportPanitia + $uangHarianPanitia + $uangHonorPanitiaPotongan;


        $mpdf->AddPage('P', '', '', '', '', 20, 20, 10, 10);

        $mpdf->WriteHTML('<table border="0" style="border-collapse: collapse;margin-bottom:0.5em" width="800px">');
        $mpdf->WriteHTML('<tr>
            <td></td>
            <td rowspan="2" style="text-align:center;font-size:15px;font-weight:bold;border-style:solid;border-width:1px 1px 1px 1px" width="10%">' . $no_urut . '</td>
           </tr>');
        $mpdf->WriteHTML('</table>');
        $mpdf->WriteHTML('<table border="1" style="border-collapse: collapse;" width="800px">');
        $mpdf->WriteHTML('<tr>
           <td style="padding-left:2em;font-weight:bold" height="50px">' . $viewPanitia['nama'] . '</td>
           </tr>');
        $mpdf->WriteHTML('</table>');
        $mpdf->WriteHTML('<div>
            <p>Honorarium ' . $namaJabatan . '<br>' . $viewKeg['nama_keg_kuitansi'] . '<br>Tanggal ' . Indonesia2Tgl($viewPanitia['tgl_mulai']) . ' s.d ' . Indonesia2Tgl($viewPanitia['tgl_selesai']) . '</p>
            </div>');
        $mpdf->WriteHTML('<p style="text-decoration: underline;padding-top:-1em">Dengan Rincian :</p>');
        $mpdf->WriteHTML('<table border="0" style="border-collapse: collapse;margin-bottom:0.2em;" width="800px">');
        $mpdf->WriteHTML('<tr>
            <td width="27%">Honorarium</td>
            <td width="2%">:</td>
            <td width="2%" style="">Rp. </td>
            <td width="15%" style="text-align:right;">' . format_angka($uangHonorPanitia) . ',-</td>
            <td></td>
            <td></td>
            </tr>');
        $mpdf->WriteHTML('<tr>
            <td width="27%">PPh 21</td>
            <td width="2%">:</td>
            <td width="2%" style="">Rp. </td>
            <td width="15%" style="text-align:right;">' . format_angka($potonganHonorPanitia) . ',-</td>
            <td></td>
            <td></td>
            </tr>');
        $mpdf->WriteHTML('<tr>
            <td width="27%" height="35px" style="font-weight:bold">DITERIMAKAN</td>
            <td width="2%" style="font-weight:bold">:</td>
            <td width="2%" style="font-weight:bold;border-style:solid;border-top:1px">Rp. </td>
            <td width="15%" style="text-align:right;font-weight:bold;border-style:solid;border-top:1px">' . format_angka($TotalPanitia) . ',-</td>
            <td></td>
            <td></td>
            <td></td>
            </tr>');
        $mpdf->WriteHTML("</table>");

        $no_urut++;
    }
    $mpdf->Output("Amplop_Panitia_BBPMP_Jatim_" . $pengaturan['nama_keg'] . ".pdf", "I");
    exit;
} else {
    echo "Forbidden Access<br><br><br><br>";
}
