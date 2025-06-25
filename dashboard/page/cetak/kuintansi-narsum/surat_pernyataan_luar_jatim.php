<?php
//surat pernyataan
// if ($viewSBMPeserta['id'] != 3578) {

$mpdf->AddPage('P', '', '', '', '', 20, 20, 15, 15);
$mpdf->WriteHTML('<table border="0" style="border-collapse: collapse;margin-bottom:0.5em" width="800px">');
$mpdf->WriteHTML('<tr>
    <td></td>
    <td style="text-align:right;font-weight:bold;font-size:11px" width="10%">' . $no_urut . '</td>
   </tr>');
$mpdf->WriteHTML('</table>');
$mpdf->WriteHTML('<div style="margin-right:10px;margin-bottom:2em;">
    <h3 style="padding-bottom:-1em;text-align: center;">SURAT PERNYATAAN</h3></div>');

$mpdf->WriteHTML('<p>Saya yang bertanda tangan di bawah ini :</p>');
$mpdf->WriteHTML('<table border="0" style="border-collapse: collapse;margin-bottom:0.2em;" width="800px">');
$mpdf->WriteHTML('<tr>
    <td style="" width="13%" height="25px">Nama</td>
    <td style="text-align: center;" width="2%">:</td>
    <td colspan = "14" style="padding-left:0.2em;border-style:solid;">' . $viewNarsum['nama'] . '</td>
    </tr>');
$mpdf->WriteHTML('<tr>
    <td style="" width="13%" height="25px">NIP</td>
    <td style="text-align: center;" width="2%">:</td>
    <td colspan = "14" style="padding-left:0.2em;border-style:solid;">' . $viewNarsum['nip'] . '</td>
    </tr>');
$mpdf->WriteHTML('<tr>
    <td style="" width="13%" height="25px">Jabatan</td>
    <td style="text-align: center;" width="2%">:</td>
    <td colspan = "14" style="padding-left:0.2em;border-style:solid;">' . $viewNarsum['jabatan'] . '</td>
    </tr>');
$mpdf->WriteHTML('<tr>
    <td style="" width="13%" height="25px">Instansi</td>
    <td style="text-align: center;" width="2%">:</td>
    <td colspan = "14" style="padding-left:0.2em;border-style:solid;">' . $viewNarsum['unit_kerja'] . ', ' . $viewNarsum['kabkota_unit_kerja'] . '</td>
    </tr>');
$mpdf->WriteHTML('</table>');
$mpdf->WriteHTML('<p>Menyatakan telah melaksanakan kegiatan : <i>' . $viewKeg['nama_keg_kuitansi'] . '</i>.</p>');
$mpdf->WriteHTML('<p style="padding-bottom:0.8em;">Yang diselenggarakan oleh Balai Besar Penjaminan Mutu Pendidikan Provinsi  Jawa Timur dengan menggunakan DIPA APBN.</p>');
$mpdf->WriteHTML('<p>Saya bertanggung jawab atas bukti pengeluaran berupa :</p>');

$mpdf->WriteHTML('<table border="0" style="border-collapse: collapse;margin-top:-5em;" width="800px">');
$mpdf->WriteHTML('<tr><td>' . $rincianPernyataan . '</td></tr>');
$mpdf->WriteHTML('</table>');

$mpdf->WriteHTML('<br><p>Demikian Surat Pernyataan ini saya buat untuk dipergunakan sebagai laporan pertanggungjawaban kegiatan tersebut di atas.</p>');

$mpdf->WriteHTML('<div style="padding-top:50px;">
    <table border="0" style="margin: 0 auto;border-collapse: collapse;" width="800px">
    <tr>
    <td width="60%"></td>
    <td style="padding-left:2em">
    <div><p>' . ucwords(str_replace(["kabupaten ", "kota "], ["kab. ", "kota "], $viewKeg['nama_kab'])) . ', ' . Indonesia2Tgl($viewNarsum['tgl_selesai']) . '</p>
    <p>Yang Menyatakan</p>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <p>' . $viewNarsum['nama'] . '</p>
    <p>NIP. ' . $viewNarsum['nip'] . '</p>
    </td>
    </tr>
    </table>
    </div>');
// }
