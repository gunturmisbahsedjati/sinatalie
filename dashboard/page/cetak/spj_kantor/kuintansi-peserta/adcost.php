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
                    <td>' . $no_bukti . '</td>
                </tr>');
$mpdf->WriteHTML('<tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>MAK</td>
                    <td width="1%">:</td>
                    <td>' . $viewKeg['mak_tp_peserta'] . '</td>
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
                    <td width="25%" style="text-align:center;vertical-align:middle;font-weight:bold;border-style:solid;border-width: 1px 0px 1px 0px;background-color:#cfcfcf">' . format_angka($jmlPerjadinPeserta) . ',-</td>
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
                    <td colspan="3" style="vertical-align:top;text-align: justify;text-justify: inter-word;">( ' . ucwords(terbilang($jmlPerjadinPeserta)) . ' )</td>
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
                        <span style="font-weight:bold;">Biaya Perjalanan Dinas Petugas</span><br>
                        <span style="font-weight:bold;">' . $viewKeg['nama_keg'] . ',</span><br>
                        <span>di ' . $viewKeg['tempat_keg'] . '</span><br>
                        <span>Tgl. ' . Indonesia2Tgl($viewPeserta['tgl_mulai']) . ' s.d ' . Indonesia2Tgl($viewPeserta['tgl_selesai']) . '</span><br>
                        <span style="font-weight:bold;">' . str_replace('Kabupaten', 'Kab.', ucwords($viewKeg['nama_kab'])) . ' - ' . $viewPeserta['kabkota_unit_kerja'] . ' PP</span>
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
                <td width="30%">Transport darat</td>
                <td width="3%"></td>
                <td width="2%">:</td>
                <td width="2%">Rp.</td>
                <td style="text-align:right" width="20%">' . format_angka($transportPeserta) . ',-</td>
                <td></td>
                </tr>
                <tr>
                <td width="23%"></td>
                <td width="7%"></td>
                <td width="30%">Uang Harian (' . $jmlHariPeserta . ' Hari)</td>
                <td width="3%"></td>
                <td width="2%">:</td>
                <td width="2%">Rp.</td>
                <td style="text-align:right" width="20%">' . format_angka($uangHarianPeserta) . ',-</td>
                <td></td>
                </tr>
                <tr>
                <td width="23%"></td>
                <td width="7%"></td>
                <td width="30%" style="text-align:center;font-weight:bold;">Jumlah</td>
                <td width="3%"></td>
                <td width="2%" style="font-weight:bold;border-style:solid;border-width:1px 0 0 0;">:</td>
                <td width="2%" style="font-weight:bold;border-style:solid;border-width:1px 0 0 0;">Rp.</td>
                <td style="text-align:right;font-weight:bold;border-style:solid;border-width:1px 0 0 0;" width="20%">' . format_angka($TotalPeserta) . ',-</td>
                <td></td>
                </tr>');
$mpdf->WriteHTML('</table>');

$mpdf->WriteHTML('<div style="padding-top:20px;padding-bottom:20px;">
                <table border="0" style="margin: 0 auto;border-collapse: collapse;" width="800px">
                    <tr>
                        <td></td>
                        <td width="45%" style="padding-left:2em">
                            <div>
                                <p>' . ucwords(str_replace(["kabupaten ", "kota "], ["kab. ", "kota "], $viewKeg['nama_kab'])) . ', ' . Indonesia2Tgl($viewKeg['tgl_selesai']) . '</p>
                                <p>Yang Menyatakan</p>
                                <br>
                                <br>
                                <br>
                                <br>
                                <br>
                                <br>
                                <p style="">' . $viewPeserta['nama'] . '</p>
                                <p style="">NIP. ' . $viewPeserta['nip'] . '</p>
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

//peserta lokal
if ($viewSBMPeserta['id'] == 3578) {
    //surat pengeluaran riil
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
        <td style="padding-right:1.8em;text-align:right;"></td>
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
    $mpdf->WriteHTML("<table border='0' style='border-collapse: collapse;' width='800px'>");
    $mpdf->WriteHTML('<tr style="border-style:solid;border-width: 0px 0px 3px 0px;">
        <td style="text-align: center;padding-left:1em;padding-bottom:10px;" width="5%"><img src="logo_st.png" alt="" width="15%"></td>
        <td style="text-align: center;padding-right:1em;padding-bottom:10px;">
            <span style="font-weight: bold;">KEMENTERIAN PENDIDIKAN, KEBUDAYAAN, RISET, DAN TEKNOLOGI</span><br>
            <span style="font-weight: bold;font-size: large;">BALAI BESAR PENJAMINAN MUTU PENDIDIKAN</span><br>
            <span style="font-weight: bold;font-size: large;">PROVINSI JAWA TIMUR</span><br>
            <span>Jl. Ketintang Wiyata No. 15 Surabaya, 60231</span><br>
            <span>Telepon (031) 8290243, 8273734Faksimile (031) 8273732</span><br>
            <span>Surel: bbpmpjatim@kemdikbud.go.id</span><br>
            <span>Laman: bbpmpjatim.kemdikbud.go.id</span>
        </td>
    </tr>');
    $mpdf->WriteHTML("</table>");
    $mpdf->WriteHTML('<div style="margin-right:10px;margin-bottom:2em;">
    <h3 style="padding-bottom:-1em;text-align: center;">DAFTAR PENGELUARAN RIIL</h3>
</div>');

    $mpdf->WriteHTML('<p>Yang bertanda tangan di bawah ini :</p>');
    $mpdf->WriteHTML('<table border="0" style="border-collapse: collapse;margin-bottom:0.2em;" width="800px">');
    $mpdf->WriteHTML('<tr>
        <td style="" width="13%" height="25px">Nama</td>
        <td style="text-align: center;" width="2%">:</td>
        <td colspan="14" style="padding-left:0.2em;border-style:solid;">' . $viewKeg['nama_peg'] . '</td>
    </tr>');
    $mpdf->WriteHTML('<tr>
        <td style="" width="13%" height="25px">NIP</td>
        <td style="text-align: center;" width="2%">:</td>
        <td colspan="14" style="padding-left:0.2em;border-style:solid;">' . $viewKeg['nip'] . '</td>
    </tr>');
    $mpdf->WriteHTML('<tr>
        <td style="" width="13%" height="25px">Jabatan</td>
        <td style="text-align: center;" width="2%">:</td>
        <td colspan="14" style="padding-left:0.2em;border-style:solid;">' . $viewKeg['jabatan_peg'] . '</td>
    </tr>');
    $mpdf->WriteHTML('<tr>
        <td style="" width="13%" height="25px">Instansi</td>
        <td style="text-align: center;" width="2%">:</td>
        <td colspan="14" style="padding-left:0.2em;border-style:solid;">BBPMP Provinsi Jawa Timur, Kota Surabaya</td>
    </tr>');
    $mpdf->WriteHTML('</table>');
    $mpdf->WriteHTML('<p style="text-align:justify;text-justify: inter-word;">Berdasarkan Surat Perjalanan Dinas (SPD) tanggal ' . Indonesia2Tgl($viewKeg['tgl_spd']) . ' Nomor : ' . $viewKeg['no_spd'] . ' dengan ini kami menyatakan dengan sesungguhnya bahwa :</p>');
    $mpdf->WriteHTML('<table border="0" style="border-collapse: collapse;" width="800px">');
    $mpdf->WriteHTML('<tr>
        <td style="vertical-align:top" width="5%">1.</td>
        <td style="vertical-align:top">Biaya transport pegawai dan/atau biaya penginapan dibawah ini yang tidak diperoleh bukti-bukti pengeluaran, meliputi :</td>
    </tr>');
    $mpdf->WriteHTML('</table>');

    $mpdf->WriteHTML('<table border="1" style="border-collapse: collapse;margin-bottom:1em;margin-top:1em;" width="800px">');
    $mpdf->WriteHTML('<tr>
        <th style="text-align: center;" width="5%" height="25px">NO.</th>
        <th style="text-align: center;">URAIAN</th>
        <th style="text-align: center;">JUMLAH</th>
    </tr>');
    $mpdf->WriteHTML('<tr>
        <td style="text-align: center;" width="5%" height="100px">1.</td>
        <td style="padding-left:0.8em;">Transport Kota Surabaya - ' . ucwords(str_replace(["kabupaten ", "kota "], ["kab. ", "kota "], $viewKeg['nama_kab'])) . ' PP</td>
        <td style="text-align: right;padding-right:0.8em;">Rp. ' . format_angka($totalTransportTerdekat) . ',-</td>
    </tr>');
    $mpdf->WriteHTML('<tr>
        <td style="text-align: center;" width="5%" height="25px"></td>
        <td style="text-align: center;font-weight:bold">Jumlah</td>
        <td style="text-align: right;padding-right:0.8em;font-weight:bold">Rp. ' . format_angka($totalTransportTerdekat) . ',-</td>
    </tr>');
    $mpdf->WriteHTML('</table>');

    $mpdf->WriteHTML('<table border="0" style="border-collapse: collapse;margin-bottom:2.5em;" width="800px">');
    $mpdf->WriteHTML('<tr>
        <td style="vertical-align:top" width="5%">2.</td>
        <td style="vertical-align:top">Jumlah uang tersebut pada angka 1 di atas benar-benar dikeluarkan untuk pelaksanaan perjalanan dinas di maksud dan apabila di kemudian hari terdapat kelebihan atas pembayaran, kami bersedia menyetorkan kelebihan tersebut ke Kas Negara.</td>
    </tr>');
    $mpdf->WriteHTML('<tr>
        <td style="vertical-align:middle" width="5%" height="50px"></td>
        <td style="vertical-align:middle;text-align:justify;text-justify: inter-word;">Demikian pernyataan ini kami buat dengan sebenarnya, untuk dipergunakan sebagaimana mestinya.</td>
    </tr>');
    $mpdf->WriteHTML('</table>');

    $mpdf->WriteHTML('<table border="0" style="border-collapse: collapse;margin-top:0.2em;" width="800px">');
    $mpdf->WriteHTML('<tr>
        <td width="5%"></td>
        <td>Mengetahui/Menyetujui</td>
        <td>Kota Surabaya, ' . Indonesia2Tgl($viewKeg['tgl_selesai2']) . '</td>
    </tr>');
    $mpdf->WriteHTML('<tr>
        <td width="5%"></td>
        <td>A.n. Kuasa Pengguna Anggaran/</td>
        <td>Yang Menyatakan,</td>
    </tr>');
    $mpdf->WriteHTML('<tr>
        <td width="5%"></td>
        <td>Pejabat Pembuat Komitmen</td>
        <td></td>
    </tr>');
    $mpdf->WriteHTML('<tr>
        <td width="5%" height="75px"></td>
        <td></td>
        <td></td>
    </tr>');
    $mpdf->WriteHTML('<tr>
        <td width="5%"></td>
        <td>' . $viewKeg['ppk'] . '</td>
        <td>' . $viewKeg['nama_peg'] . '</td>
    </tr>');
    $mpdf->WriteHTML('<tr>
        <td width="5%"></td>
        <td>NIP. ' . $viewKeg['nip_ppk'] . '</td>
        <td>' . $nipPetugas . '</td>
    </tr>');
    $mpdf->WriteHTML('</table>');
}



// //rincian
// $mpdf->AddPage('P', '', '', '', '', 15, 15, 10, 10);
// $mpdf->WriteHTML('<table border="0" style="border-collapse: collapse;margin-bottom:0.5em" width="800px">');
// $mpdf->WriteHTML('<tr>
//         <td></td>
//         <td style="text-align:right;font-weight:bold;font-size:11px" width="10%">' . $no_urut . '</td>
//     </tr>');
// $mpdf->WriteHTML('</table>');
// $mpdf->WriteHTML('<table border="0" style="border-collapse: collapse;margin-bottom:0.2em;" width="800px">');
// $mpdf->WriteHTML('<tr>
//         <td width="37%"></td>
//         <td style="padding-right:1.8em;text-align:right;"><img src="garuda.png" alt="" width="15%"></td>
//         <td style="font-size:10px;vertical-align:top;text-align: justify;text-justify: inter-word;" width="40%">
//             LAMPIRAN II<br>
//             PERATURAN MENTERI KEUANGAN REPUBLIK
//             INDONESIA NOMOR 113/PMK.05/2012 TENTANG
//             PERJALANAN DINAS JABATAN DALAM NEGERI BAGI
//             PEJABAT NEGARA, PEGAWAI NEGERI, DAN
//             PEGAWAI TIDAK TETAP
//         </td>
//     </tr>');
// $mpdf->WriteHTML("</table>");
// $mpdf->WriteHTML('<div style="text-align:center">
//     <p>MENTERI KEUANGAN<br>REPUBLIK INDONESIA</p>
//     <p style="font-weight:bold;">RINCIAN BIAYA PERJALANAN DINAS</p>
// </div>');
// $mpdf->WriteHTML('<table border="0" style="border-collapse: collapse;margin-bottom:0.2em;" width="800px">');
// $mpdf->WriteHTML('<tr>
//         <td width="20%"></td>
//         <td style="">Lampiran SPD Nomor</td>
//         <td width="2%" style="text-align:center">:</td>
//         <td>' . $viewKeg['no_spd'] . '</td>
//         <td></td>
//     </tr>');
// $mpdf->WriteHTML('<tr>
//         <td></td>
//         <td style="">Tanggal</td>
//         <td style="text-align:center">:</td>
//         <td>' . Indonesia2Tgl($viewKeg['tgl_spd']) . '</td>
//         <td></td>
//     </tr>');
// $mpdf->WriteHTML("</table><br>");

// $mpdf->WriteHTML('<table border="1" style="border-collapse: collapse;margin-bottom:0.2em;" width="800px">');
// $mpdf->WriteHTML('<tr>
//         <th height="40px">NO.</th>
//         <th>PERINCIAN BIAYA</th>
//         <th colspan="2">JUMLAH</th>
//         <th>KETERANGAN</th>
//     </tr>');
// $mpdf->WriteHTML($detail_rincian_terdekat);
// $mpdf->WriteHTML("</table><br>");

// $mpdf->WriteHTML('<table border="0" style="border-collapse: collapse;margin-bottom:0.2em;" width="800px">');
// $mpdf->WriteHTML('<tr>
//         <td width="50%"></td>
//         <td>' . ucwords(str_replace(["kabupaten ", "kota "], ["kab. ", "kota "], $viewKeg['nama_kab'])) . ', ' . Indonesia2Tgl($viewKeg['tgl_selesai']) . '</td>
//     </tr>');
// $mpdf->WriteHTML('<tr>
//         <td>Telah dibayar sejumlah</td>
//         <td>Telah menerima jumlah uang sebesar</td>
//     </tr>');
// $mpdf->WriteHTML('<tr>
//         <td>Rp. ' . format_angka($totalTerdekat) . '.-</td>
//         <td>Rp. ' . format_angka($totalTerdekat) . '.-</td>
//     </tr>');
// $mpdf->WriteHTML('<tr>
//         <td>Bendahara Pengeluaran</td>
//         <td>Yang menerima</td>
//     </tr>');
// $mpdf->WriteHTML('<tr>
//         <td height="60px"></td>
//         <td></td>
//     </tr>');
// $mpdf->WriteHTML('<tr>
//         <td>' . $viewKeg['bendahara'] . '</td>
//         <td>' . $viewKeg['nama_peg'] . '</td>
//     </tr>');
// $mpdf->WriteHTML('<tr>
//         <td style="border-style:solid;border-bottom:1px;">NIP. ' . $viewKeg['nip_bendahara'] . '</td>
//         <td style="border-style:solid;border-bottom:1px;">' . $nipPetugas . '</td>
//     </tr>');
// $mpdf->WriteHTML("</table>");

// $mpdf->WriteHTML('<div style="text-align:center">
//     <p style="font-weight:bold;">PERHITUNGAN SPD RAMPUNG</p>
// </div>');

// $mpdf->WriteHTML('<table border="0" style="border-collapse: collapse;margin-bottom:0.2em;" width="800px">');
// $mpdf->WriteHTML('<tr>
//         <td width="27%">Ditetapkan sejumlah</td>
//         <td width="2%">:</td>
//         <td width="2%">Rp. </td>
//         <td width="15%" style="text-align:right;">' . format_angka($totalTerdekat) . ',-</td>
//         <td></td>
//         <td></td>
//     </tr>');
// $mpdf->WriteHTML('<tr>
//         <td width="27%">Yang telah dibayar semula</td>
//         <td width="2%">:</td>
//         <td width="2%" style="border-style:solid;border-bottom:1px">Rp. </td>
//         <td width="15%" style="text-align:right;border-style:solid;border-bottom:1px">' . format_angka($totalTerdekat) . ',-</td>
//         <td></td>
//         <td></td>
//     </tr>');
// $mpdf->WriteHTML('<tr>
//         <td width="27%">Sisa kurang/lebih</td>
//         <td width="2%">:</td>
//         <td width="2%">Rp. </td>
//         <td width="15%" style="text-align:right;">0,-</td>
//         <td></td>
//         <td></td>
//     </tr>');
// $mpdf->WriteHTML("</table><br>");

// $mpdf->WriteHTML('<table border="0" style="border-collapse: collapse;margin-bottom:0.2em;" width="800px">');
// $mpdf->WriteHTML('<tr>
//         <td width="50%"></td>
//         <td colspan="2">Setuju Dibayar :</td>
//     </tr>');
// $mpdf->WriteHTML('<tr>
//         <td></td>
//         <td width="5%">A.n</td>
//         <td>Kuasa Pengguna Anggaran/</td>
//     </tr>');
// $mpdf->WriteHTML('<tr>
//         <td></td>
//         <td></td>
//         <td>Pejabat Pembuat Komitmen</td>
//     </tr>');
// $mpdf->WriteHTML('<tr>
//         <td height="60px"></td>
//         <td></td>
//         <td></td>
//     </tr>');
// $mpdf->WriteHTML('<tr>
//         <td></td>
//         <td></td>
//         <td>' . $viewKeg['ppk'] . '</td>
//     </tr>');
// $mpdf->WriteHTML('<tr>
//         <td></td>
//         <td></td>
//         <td>NIP. ' . $viewKeg['nip_ppk'] . '</td>
//     </tr>');
// $mpdf->WriteHTML("</table>");
