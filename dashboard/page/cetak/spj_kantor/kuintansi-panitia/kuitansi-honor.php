<?php
//kuitansi
$mpdf->AddPage('P', '', '', '', '', 15, 15, 10, 10);
$mpdf->WriteHTML('<table border="0">
    <tr>
        <td style="border-style:solid;border-width:1px 1px 1px 1px;padding:0.5em">');
$mpdf->WriteHTML('<table border="0" style="border-collapse: collapse;margin-bottom:0.5em" width="800px">');
$mpdf->WriteHTML('<tr>
                    <td></td>
                    <td style="text-align:right;font-weight:bold;font-size:11px" width="10%">' . $no_urut . '</td>
                </tr>');
$mpdf->WriteHTML('</table>');
$mpdf->WriteHTML('<table border="0" style="border-collapse: collapse;margin-bottom:0.2em;" width="800px">');
$mpdf->WriteHTML('<tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>Tahun Anggaran</td>
                    <td width="1%">:</td>
                    <td>' . $viewKeg['thn_st'] . '</td>
                </tr>');
$mpdf->WriteHTML('<tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>No. Bukti</td>
                    <td width="1%">:</td>
                    <td>' . $no_bukti_panitia_honor . '</td>
                </tr>');
$mpdf->WriteHTML('<tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>MAK</td>
                    <td width="1%">:</td>
                    <td>' . $viewKeg['mak_hr_panitia'] . '</td>
                </tr>');
$mpdf->WriteHTML('<tr>
                    <td width="27%"></td>
                    <td style="text-align:center;vertical-align:middle;font-weight:bold;font-size:30px;border-style:double;border-width: 5px 5px 5px 5px;letter-spacing:7px;padding-left:2em;padding-right:1.4em" height="50px">KWITANSI</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>');
$mpdf->WriteHTML('</table><br>');

$mpdf->WriteHTML('<table border="0" style="border-collapse: collapse;margin-bottom:0.2em;" width="800px">');
$mpdf->WriteHTML('<tr>
                    <td width="20%" style="vertical-align:top;">Sudah terima dari</td>
                    <td width="3%" style="vertical-align:top;text-align:center;">:</td>
                    <td colspan="3" style="vertical-align:top;text-align: justify;text-justify: inter-word;font-weight:bold;">Atas Nama Kuasa Pengguna Anggaran/Pejabat Pembuat Komitmen Balai Besar Penjaminan Mutu Pendidikan Provinsi Jawa Timur</td>
                </tr>');
$mpdf->WriteHTML('<tr>
                    <td height="20px"></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>');
$mpdf->WriteHTML('<tr>
                    <td width="20%" style="vertical-align:middle;">Jumlah Uang</td>
                    <td width="3%" style="vertical-align:middle;text-align:center;">:</td>
                    <td width="3%" style="font-weight:bold;border-style:solid;border-width: 1px 0px 1px 0px;background-color:#cfcfcf" height="30px">Rp</td>
                    <td width="25%" style="text-align:center;vertical-align:middle;font-weight:bold;border-style:solid;border-width: 1px 0px 1px 0px;background-color:#cfcfcf">' . format_angka($uangHonorPanitia) . ',-</td>
                    <td></td>
                </tr>');
$mpdf->WriteHTML('<tr>
                    <td height="20px"></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>');
$mpdf->WriteHTML('<tr>
                    <td width="20%" style="vertical-align:top;">Terbilang</td>
                    <td width="3%" style="vertical-align:top;text-align:center;">:</td>
                    <td colspan="3" style="vertical-align:top;text-align: justify;text-justify: inter-word;">( ' . ucwords(terbilang($uangHonorPanitia)) . ' )</td>
                </tr>');
$mpdf->WriteHTML('<tr>
                    <td height="20px"></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>');
$mpdf->WriteHTML('<tr>
                    <td width="20%" style="vertical-align:top;">Untuk Pembayaran</td>
                    <td width="3%" style="vertical-align:top;text-align:center;">:</td>
                    <td colspan="3" style="vertical-align:top;text-align: justify;text-justify: inter-word;">
                        <span style="font-weight:bold;">Honorarium ' . $namaJabatan . '</span><br>
                        <span style="font-weight:bold;">' . $viewKeg['nama_keg_kuitansi'] . ',</span><br>
                        <span>di ' . $viewKeg['tempat_keg'] . '</span><br>
                        <span>Tgl. ' . Indonesia2Tgl($viewPanitia['tgl_mulai']) . ' s.d ' . Indonesia2Tgl($viewPanitia['tgl_selesai']) . '</span>
                    </td>
                </tr>');
$mpdf->WriteHTML('</table><br>');

$mpdf->WriteHTML('<table border="0" style="border-collapse: collapse;margin-bottom:0.2em;" width="800px">');
$mpdf->WriteHTML('<tr>
                    <td width="23%"></td>
                    <td colspan="7"><i>Dengan Rincian :</i></td>
                </tr>');
$mpdf->WriteHTML('<tr>
                <td width="23%"></td>
                <td width="7%"></td>
                <td width="30%">Honorarium</td>
                <td width="3%"></td>
                <td width="2%">:</td>
                <td width="2%">Rp.</td>
                <td style="text-align:right" width="20%">' . format_angka($uangHonorPanitia) . ',-</td>
                <td></td>
                </tr>
               <tr>
                <td width="23%"></td>
                <td width="7%"></td>
                <td width="30%">PPh 21</td>
                <td width="3%"></td>
                <td width="2%">:</td>
                <td width="2%">Rp.</td>
                <td style="text-align:right" width="20%">' . format_angka($potonganHonorPanitia) . ',-</td>
                <td style="padding-top:10px"> <strong>&mdash;</strong></td>
                </tr>
                </tr>
                <tr>
                <td width="23%"></td>
                <td width="7%"></td>
                <td width="30%" style="text-align:center;font-weight:bold;">Jumlah</td>
                <td width="3%"></td>
                <td width="2%" style="font-weight:bold;border-style:solid;border-width:1px 0 0 0;">:</td>
                <td width="2%" style="font-weight:bold;border-style:solid;border-width:1px 0 0 0;">Rp.</td>
                <td style="text-align:right;font-weight:bold;border-style:solid;border-width:1px 0 0 0;" width="20%">' . format_angka($uangHonorPanitiaPotongan) . ',-</td>
                <td></td>
                </tr>');
$mpdf->WriteHTML('</table>');

$mpdf->WriteHTML('<div style="padding-top:20px;padding-bottom:20px;">
                <table border="0" style="margin: 0 auto;border-collapse: collapse;" width="800px">
                    <tr>
                        <td></td>
                        <td width="45%" style="padding-left:2em">
                            <div>
                                <p>' . ucwords(str_replace(["kabupaten ", "kota "], ["kab. ", "kota "], $viewKeg['nama_kab'])) . ', ' . Indonesia2Tgl($viewPanitia['tgl_selesai']) . '</p>
                                <p>Yang Menyatakan</p>
                                <br>
                                <br>
                                <br>
                                <br>
                                <br>
                                <br>
                                <p style="">' . $viewPanitia['nama'] . '</p>
                                <p style="">NIP. ' . $viewPanitia['nip'] . '</p>
                        </td>
                    </tr>
                </table>
            </div>');

$mpdf->WriteHTML("<table border='0' style='border-collapse: collapse;margin-bottom:2em' width='800px'>");
$mpdf->WriteHTML('
                <tr>
                    <td colspan="4" style="border-style:solid;border-width:1px 0 0 0;">Setuju Dibayar :</td>
                </tr>
                <tr>
                    <td></td>
                    <td>A.n. Kuasa Pengguna Anggaran/</td>
                    <td></td>
                    <td>Lunas Dibayar Tgl,</td>
                </tr>
                <tr>
                    <td></td>
                    <td>Pejabat Pembuat Komitmen</td>
                    <td></td>
                    <td>Bendahara</td>
                </tr>
                <tr>
                    <td height="100px"></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td>' . $viewPPK['nama_peg'] . '</td>
                    <td></td>
                    <td>' . $viewBendahara['nama_peg'] . '</td>
                </tr>
                <tr>
                    <td></td>
                    <td>NIP. ' . $viewPPK['nip'] . '</td>
                    <td></td>
                    <td>NIP. ' . $viewBendahara['nip'] . '</td>
                </tr>
                ');
$mpdf->WriteHTML("
            </table>");
$mpdf->WriteHTML("</td>
    </tr>
</table>");
