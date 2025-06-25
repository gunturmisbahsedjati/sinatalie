<?php
//rincian
if ($hotel != 0 || $hotel != "" || $hotel != NULL) {
    $rincian_hotel = '<tr>
                <td style="text-align:center;border-style:solid;border-width: 0px 1px 0px 1px" height="10px">6.</td>
                <td style="padding-left:0.8em;border-style:solid;border-width: 0px 1px 0px 0px">Penginapan</td>
                <td style="border-style:solid;border-width: 0px 0px 0px 0px;padding-left:0.8em;">Rp</td>
                <td style="border-left:0px;text-align:right;padding-right:0.8em;border-style:solid;border-width: 0px 0px 0px 0px">' . format_angka($hotel) . ',-</td>
                <td style="border-style:solid;border-width: 0px 1px 0px 1px"></td>
                </tr>';
} else {
    $rincian_hotel = '';
}
$mpdf->AddPage('P', '', '', '', '', 15, 15, 10, 10);
$mpdf->WriteHTML('<table border="0" style="border-collapse: collapse;margin-bottom:0.5em" width="800px">');
$mpdf->WriteHTML('<tr>
        <td></td>
        <td style="text-align:right;font-weight:bold;font-size:11px" width="10%">' . $no_urut . '</td>
    </tr>');
$mpdf->WriteHTML('</table>');
$mpdf->WriteHTML('<table border="0" style="border-collapse: collapse;margin-bottom:0.2em;" width="800px">');
$mpdf->WriteHTML('<tr>
        <td width="37%"></td>
        <td style="padding-right:1.8em;text-align:right;"><img src="garuda.png" alt="" width="15%"></td>
        <td style="font-size:10px;vertical-align:top;text-align: justify;text-justify: inter-word;" width="40%">
            LAMPIRAN II<br>
            PERATURAN MENTERI KEUANGAN REPUBLIK
            INDONESIA NOMOR 113/PMK.05/2012 TENTANG
            PERJALANAN DINAS JABATAN DALAM NEGERI BAGI
            PEJABAT NEGARA, PEGAWAI NEGERI, DAN
            PEGAWAI TIDAK TETAP
        </td>
    </tr>');
$mpdf->WriteHTML("</table>");
$mpdf->WriteHTML('<div style="text-align:center">
    <p>MENTERI KEUANGAN<br>REPUBLIK INDONESIA</p>
    <p style="font-weight:bold;">RINCIAN BIAYA PERJALANAN DINAS</p>
</div>');
$mpdf->WriteHTML('<table border="0" style="border-collapse: collapse;margin-bottom:0.2em;" width="800px">');
$mpdf->WriteHTML('<tr>
        <td width="20%"></td>
        <td style="">Lampiran SPD Nomor</td>
        <td width="2%" style="text-align:center">:</td>
        <td>' .  $viewKeg['no_sptjb_perjadin'] . '' . $viewKeg['sptjb_perjadin'] . '</td>
        <td></td>
    </tr>');
$mpdf->WriteHTML('<tr>
        <td></td>
        <td style="">Tanggal</td>
        <td style="text-align:center">:</td>
        <td>' . Indonesia2Tgl($viewKeg['tgl_sptjb_perjadin']) . '</td>
        <td></td>
    </tr>');
$mpdf->WriteHTML("</table><br>");

$mpdf->WriteHTML('<table border="1" style="border-collapse: collapse;margin-bottom:0.2em;" width="800px">');
$mpdf->WriteHTML('<tr>
        <th height="40px">NO.</th>
        <th>PERINCIAN BIAYA</th>
        <th colspan="2">JUMLAH</th>
        <th>KETERANGAN</th>
    </tr>');
$mpdf->WriteHTML('<tr>
                <td style="text-align:center;border-style:solid;border-width: 0px 1px 0px 1px" height="10px">1.</td>
                <td style="padding-left:0.8em;border-style:solid;border-width: 0px 1px 0px 0px">Transport</td>
                <td style="border-style:solid;border-width: 0px 0px 0px 0px;padding-left:0.8em;">Rp</td>
                <td style="border-left:0px;text-align:right;padding-right:0.8em;border-style:solid;border-width: 0px 0px 0px 0px">' . format_angka($transportPeserta) . ',-</td>
                <td style="border-style:solid;border-width: 0px 1px 0px 1px"></td>
                </tr>
                <tr>
                <td style="text-align:center;border-style:solid;border-width: 0px 1px 0px 1px" height="10px">2.</td>
                <td style="padding-left:0.8em;border-style:solid;border-width: 0px 1px 0px 0px">Tiket Kapal</td>
                <td style="border-style:solid;border-width: 0px 0px 0px 0px;padding-left:0.8em;">Rp</td>
                <td style="border-left:0px;text-align:right;padding-right:0.8em;border-style:solid;border-width: 0px 0px 0px 0px">' . format_angka($tiketKapal) . ',-</td>
                <td style="border-style:solid;border-width: 0px 1px 0px 1px"></td>
                </tr>
                <tr>
                <td style="text-align:center;border-style:solid;border-width: 0px 1px 0px 1px" height="10px">3.</td>
                <td style="padding-left:0.8em;border-style:solid;border-width: 0px 1px 0px 0px">Uang Harian (' . $jmlHariPeserta . ' Hari)</td>
                <td style="border-style:solid;border-width: 0px 0px 0px 0px;padding-left:0.8em;">Rp</td>
                <td style="border-left:0px;text-align:right;padding-right:0.8em;border-style:solid;border-width: 0px 0px 0px 0px">' . format_angka($uangHarianPeserta) . ',-</td>
                <td style="border-style:solid;border-width: 0px 1px 0px 1px"></td>
                </tr>
                <tr>
                <td style="text-align:center;border-style:solid;border-width: 0px 1px 0px 1px" height="10px">4.</td>
                <td style="padding-left:0.8em;border-style:solid;border-width: 0px 1px 0px 0px">Uang Harian H - 1</td>
                <td style="border-style:solid;border-width: 0px 0px 0px 0px;padding-left:0.8em;">Rp</td>
                <td style="border-left:0px;text-align:right;padding-right:0.8em;border-style:solid;border-width: 0px 0px 0px 0px">' . format_angka($uangHarianPesertaHmin1) . ',-</td>
                <td style="border-style:solid;border-width: 0px 1px 0px 1px"></td>
                </tr>
                <tr>
                <td style="text-align:center;border-style:solid;border-width: 0px 1px 0px 1px" height="10px">5.</td>
                <td style="padding-left:0.8em;border-style:solid;border-width: 0px 1px 0px 0px">Uang Harian H + 1</td>
                <td style="border-style:solid;border-width: 0px 0px 0px 0px;padding-left:0.8em;">Rp</td>
                <td style="border-left:0px;text-align:right;padding-right:0.8em;border-style:solid;border-width: 0px 0px 0px 0px">' . format_angka($uangHarianPesertaHplus1) . ',-</td>
                <td style="border-style:solid;border-width: 0px 1px 0px 1px"></td>
                </tr>
                ' . $rincian_hotel . '
                <tr>
                <td  height="40px"></td>
                <td style="text-align:center;font-weight:bold;">Jumlah</td>
                <td style="border-right:0px;font-weight:bold;padding-left:0.8em;">Rp</td>
                <td style="border-left:0px;text-align:right;padding-right:0.8em;font-weight:bold">' . format_angka($TotalPeserta) . ',-</td>
                <td></td>
                </tr>');
$mpdf->WriteHTML("</table><br>");

$mpdf->WriteHTML('<table border="0" style="border-collapse: collapse;margin-bottom:0.2em;" width="800px">');
$mpdf->WriteHTML('<tr>
        <td width="50%"></td>
        <td>' . ucwords(str_replace(["kabupaten ", "kota "], ["kab. ", "kota "], $viewKeg['nama_kab'])) . ', ' . Indonesia2Tgl($viewKeg['tgl_selesai']) . '</td>
    </tr>');
$mpdf->WriteHTML('<tr>
        <td>Telah dibayar sejumlah</td>
        <td>Telah menerima jumlah uang sebesar</td>
    </tr>');
$mpdf->WriteHTML('<tr>
        <td>Rp. ' . format_angka($TotalPeserta) . '.-</td>
        <td>Rp. ' . format_angka($TotalPeserta) . '.-</td>
    </tr>');
$mpdf->WriteHTML('<tr>
        <td>Bendahara Pengeluaran</td>
        <td>Yang menerima</td>
    </tr>');
$mpdf->WriteHTML('<tr>
        <td height="60px"></td>
        <td></td>
    </tr>');
$mpdf->WriteHTML('<tr>
        <td>' . $viewBendahara['nama_peg'] . '</td>
        <td>' . $viewPeserta['nama'] . '</td>
    </tr>');
$mpdf->WriteHTML('<tr>
        <td style="border-style:solid;border-bottom:1px;">NIP. ' . $viewBendahara['nip'] . '</td>
        <td style="border-style:solid;border-bottom:1px;">NIP. ' . $viewPeserta['nip'] . '</td>
    </tr>');
$mpdf->WriteHTML("</table>");

$mpdf->WriteHTML('<div style="text-align:center">
    <p style="font-weight:bold;">PERHITUNGAN SPD RAMPUNG</p>
</div>');

$mpdf->WriteHTML('<table border="0" style="border-collapse: collapse;margin-bottom:0.2em;" width="800px">');
$mpdf->WriteHTML('<tr>
        <td width="27%">Ditetapkan sejumlah</td>
        <td width="2%">:</td>
        <td width="2%">Rp. </td>
        <td width="15%" style="text-align:right;">' . format_angka($TotalPeserta) . ',-</td>
        <td></td>
        <td></td>
    </tr>');
$mpdf->WriteHTML('<tr>
        <td width="27%">Yang telah dibayar semula</td>
        <td width="2%">:</td>
        <td width="2%" style="border-style:solid;border-bottom:1px">Rp. </td>
        <td width="15%" style="text-align:right;border-style:solid;border-bottom:1px">' . format_angka($TotalPeserta) . ',-</td>
        <td></td>
        <td></td>
    </tr>');
$mpdf->WriteHTML('<tr>
        <td width="27%">Sisa kurang/lebih</td>
        <td width="2%">:</td>
        <td width="2%">Rp. </td>
        <td width="15%" style="text-align:right;">0,-</td>
        <td></td>
        <td></td>
    </tr>');
$mpdf->WriteHTML("</table><br>");

$mpdf->WriteHTML('<table border="0" style="border-collapse: collapse;margin-bottom:0.2em;" width="800px">');
$mpdf->WriteHTML('<tr>
        <td width="50%"></td>
        <td colspan="2">Setuju Dibayar :</td>
    </tr>');
$mpdf->WriteHTML('<tr>
        <td></td>
        <td width="5%">A.n</td>
        <td>Kuasa Pengguna Anggaran/</td>
    </tr>');
$mpdf->WriteHTML('<tr>
        <td></td>
        <td></td>
        <td>Pejabat Pembuat Komitmen</td>
    </tr>');
$mpdf->WriteHTML('<tr>
        <td height="60px"></td>
        <td></td>
        <td></td>
    </tr>');
$mpdf->WriteHTML('<tr>
        <td></td>
        <td></td>
        <td>' . $viewPPK['nama_peg'] . '</td>
    </tr>');
$mpdf->WriteHTML('<tr>
        <td></td>
        <td></td>
        <td>NIP. ' . $viewPPK['nip'] . '</td>
    </tr>');
$mpdf->WriteHTML("</table>");
