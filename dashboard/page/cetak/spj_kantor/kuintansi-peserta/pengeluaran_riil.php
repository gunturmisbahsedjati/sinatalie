<?php
//peserta lokal
// if ($viewSBMPeserta['id'] == 3578) {
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
        <td colspan="14" style="padding-left:0.2em;border-style:solid;">' . $viewPeserta['nama'] . '</td>
    </tr>');
$mpdf->WriteHTML('<tr>
        <td style="" width="13%" height="25px">NIP</td>
        <td style="text-align: center;" width="2%">:</td>
        <td colspan="14" style="padding-left:0.2em;border-style:solid;">' . $viewPeserta['nip'] . '</td>
    </tr>');
$mpdf->WriteHTML('<tr>
        <td style="" width="13%" height="25px">Jabatan</td>
        <td style="text-align: center;" width="2%">:</td>
        <td colspan="14" style="padding-left:0.2em;border-style:solid;">' . $viewPeserta['jabatan'] . '</td>
    </tr>');
$mpdf->WriteHTML('<tr>
        <td style="" width="13%" height="25px">Instansi</td>
        <td style="text-align: center;" width="2%">:</td>
        <td colspan="14" style="padding-left:0.2em;border-style:solid;">' . $viewPeserta['unit_kerja'] . ', ' . $viewPeserta['kabkota_unit_kerja'] . '</td>
    </tr>');
$mpdf->WriteHTML('</table>');
$mpdf->WriteHTML('<p style="text-align:justify;text-justify: inter-word;">Berdasarkan Surat Perjalanan Dinas (SPD) tanggal ' . Indonesia2Tgl($viewKeg['tgl_sptjb_perjadin']) . ' Nomor : ' . $viewKeg['no_sptjb_perjadin'] . '' . $viewKeg['sptjb_perjadin'] . ' dengan ini kami menyatakan dengan sesungguhnya bahwa :</p>');
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
if ($viewPeserta['dpr1'] == NULL || $viewPeserta['dpr1'] == '') {
    $mpdf->WriteHTML('<tr>
        <td style="text-align: center;" width="5%" height="100px">1.</td>
        <td style="padding-left:0.8em;">Transport ' . str_replace('Kabupaten', 'Kab.', ucwords($viewKeg['nama_kab'])) . ' - ' . $viewPeserta['kabkota_unit_kerja'] . ' PP</td>
        <td style="text-align: right;padding-right:0.8em;">Rp. ' . format_angka($transportPeserta) . ',-</td>
    </tr>');
    $mpdf->WriteHTML('<tr>
        <td style="text-align: center;" width="5%" height="25px"></td>
        <td style="text-align: center;font-weight:bold">Jumlah</td>
        <td style="text-align: right;padding-right:0.8em;font-weight:bold">Rp. ' . format_angka($transportPeserta) . ',-</td>
    </tr>');
} else {
    $mpdf->WriteHTML('<tr>
        <td style="text-align: center;" width="5%" height="100px">1.</td>
        <td style="padding-left:0.8em;">Transport ' . str_replace('Kabupaten', 'Kab.', ucwords($viewKeg['nama_kab'])) . ' - ' . $viewPeserta['kabkota_unit_kerja'] . ' PP</td>
        <td style="text-align: right;padding-right:0.8em;">Rp. ' . format_angka($viewPeserta['dpr1']) . ',-</td>
    </tr>');
    $mpdf->WriteHTML('<tr>
        <td style="text-align: center;" width="5%" height="25px"></td>
        <td style="text-align: center;font-weight:bold">Jumlah</td>
        <td style="text-align: right;padding-right:0.8em;font-weight:bold">Rp. ' . format_angka($viewPeserta['dpr1']) . ',-</td>
    </tr>');
}

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
        <td>' . ucwords(str_replace(["kabupaten ", "kota "], ["kab. ", "kota "], $viewKeg['nama_kab'])) . ', ' . Indonesia2Tgl($viewKeg['tgl_selesai']) . '</td>
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
        <td>' . $viewPPK['nama_peg'] . '</td>
        <td>' . $viewPeserta['nama'] . '</td>
    </tr>');
$mpdf->WriteHTML('<tr>
        <td width="5%"></td>
        <td>NIP. ' . $viewPPK['nip'] . '</td>
        <td>NIP. ' . $viewPeserta['nip'] . '</td>
    </tr>');
$mpdf->WriteHTML('</table>');
// }
