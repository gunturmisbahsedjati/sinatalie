<?php
require_once '../../../inc/inc.koneksi.php';
require_once '../../../inc/inc.library.php';
require_once('../../../assets/vendor/libs/MPDF57/mpdf.php');
require_once '../../../assets/vendor/libs/phpqrcode/qrlib.php';
$date = date('d-m-Y H:i:s');
date_default_timezone_set('Asia/Jakarta');
$currentdate = Indonesia2Tgl(date("Y-m-d"));
$today = date("H:i");
session_start();
$id = $_SESSION['id'];
$id_keg = decrypt($_GET['_token']);

$sqlCekKeg = mysqli_query($myConnection, "select tb_petugas_kegiatan.*, tb_kegiatan.nama_keg as nama_keg, tb_kegiatan.tgl_mulai as tgl_mulai, tb_kegiatan.tgl_selesai as tgl_selesai,tb_kegiatan.tgl_mulai2 as tgl_mulai2, tb_kegiatan.tgl_selesai2 as tgl_selesai2, tb_kegiatan.thn_st as thn_st, tb_kegiatan.no_bukti, tb_kegiatan.no_mak, tb_kegiatan.no_spd, tb_kegiatan.tgl_spd, tb_kegiatan.nom_honor as honor, tb_kegiatan.nom_honor_terdekat as honor_terdekat, ppk.nama_peg as ppk, ppk.nip as nip_ppk, bendahara.nama_peg as bendahara, bendahara.nip as nip_bendahara, tb_kabkota.name as nama_kab, tb_kabkota.mapping as mapping, tb_kabkota.besaran as besaran, tb_pegawai.nama_peg as nama_peg, tb_pegawai.nip as nip, tb_jabatan.nama_jabatan as jabatan_peg, tb_jenis_transport.jenis_transport as nama_transport, tb_kegiatan.pagu_hotel
from tb_petugas_kegiatan
left join tb_kegiatan on tb_kegiatan.id_keg = tb_petugas_kegiatan.id_keg
left join tb_pegawai on tb_pegawai.id_peg = tb_petugas_kegiatan.id_peg
left join tb_kabkota on tb_kabkota.id = tb_petugas_kegiatan.kabkota
left join tb_jenis_transport on tb_jenis_transport.id_jenis_transport = tb_petugas_kegiatan.jenis_transport
left join tb_jabatan on tb_jabatan.kd_jabatan = tb_pegawai.jabatan
left join tb_pegawai as ppk on ppk.id_peg = tb_kegiatan.id_ppk
left join tb_pegawai as bendahara on bendahara.id_peg = tb_kegiatan.id_bendahara
left join tb_gol_pajak on tb_gol_pajak.id_pangkat = tb_pegawai.id_pangkat
where tb_petugas_kegiatan.id_keg = '$id_keg'
order by tb_petugas_kegiatan.kabkota, tb_gol_pajak.id_pangkat, tb_petugas_kegiatan.id_peg_st_siratu asc");
$pengaturan = mysqli_fetch_array(mysqli_query($myConnection, "select tb_kegiatan.*, tb_pegawai.nama_peg as ppk, tb_pegawai.nip as nip_ppk, tb_profil_sptjb.nama_satker, tb_profil_sptjb.kode_satker, tb_profil_sptjb.no_dipa, tb_profil_sptjb.tgl_dipa, tb_profil_sptjb.klasifikasi 
from tb_kegiatan 
left join tb_profil_sptjb on tb_profil_sptjb.id_profil_sptjb = tb_kegiatan.sptjb
left join tb_pegawai on tb_pegawai.id_peg = tb_kegiatan.id_ppk
where tb_kegiatan.id_keg = '$id_keg'"));
if (mysqli_num_rows($sqlCekKeg) > 0) {
    $mpdf = new \Mpdf('', 'A4');
    $mpdf->SetTitle('Kuitansi_Perjadin_BBPMP_Jatim');
    $mpdf->SetAuthor('ANIMASIKU Studio');
    $mpdf->SetCreator('Adara Cassie Violeta Misbah');
    $mpdf->SetDefaultFont('times');
    $mpdf->SetDefaultFontSize('10');
    $hitungTotal = [];
    $nama_peg_sptjb = [];
    $uangHarianJml = [];
    $countPeg = [];
    while ($viewKeg = mysqli_fetch_array($sqlCekKeg)) {
        $id_keg = $viewKeg['id_keg'];
        $id_peg = $viewKeg['id_peg'];
        $id_petugas_keg = $viewKeg['id_petugas_keg'];
        $tgl1 = selesihHari($viewKeg['tgl_mulai'], $viewKeg['tgl_selesai']) + 1; // terjauh
        $tgl2 = selesihHari($viewKeg['tgl_mulai2'], $viewKeg['tgl_selesai2']) + 1; // terdekat & sedang
        if ($viewKeg['mapping'] == 1) {
            // //kuitansi terdekat
            $jmlPeg = 1;
            $hitungTransport = $viewKeg['besaran'] * 2;
            $uangHarian = $viewKeg['honor_terdekat'] * $tgl2;
            $totalTerdekat = $totalTransportTerdekat + $uangHarian;
            $hitungHotel = 0;
        } else {
            // kuintansi sedang dan terjauh
            $sumSqlTransport = mysqli_fetch_array(mysqli_query($myConnection, "select sum(nominal) as total from tb_petugas_transport where soft_delete = 0 and id_petugas_keg = '$id_petugas_keg'"));
            $totalPerHotel = [];
            $totalMenginap = [];
            $sumSqlHotel = mysqli_query($myConnection, "select id_petugas_hotel, harga_per_malam, DATEDIFF(check_out, check_in) as lama from tb_petugas_hotel where soft_delete = 0 and id_petugas_keg = '$id_petugas_keg'");
            while ($viewSumHotel = mysqli_fetch_array($sumSqlHotel)) {
                $totalPerHotel[] = $viewSumHotel['lama'] * $viewSumHotel['harga_per_malam'];
                $totalMenginap[] = $viewSumHotel['lama'];
            }
            $totalHotel = array_sum($totalPerHotel);
            $totalMenginapHotel = array_sum($totalMenginap);

            $totalUangHarianTerjauh = $viewKeg['honor'] * $tgl1;
            $totalUangHarianSedang = $viewKeg['honor'] * $tgl2;
            $totalTransport = $sumSqlTransport['total'];

            if ($viewKeg['mapping'] == 2) {
                $uangHarian = $totalUangHarianSedang;
                $pelaksanaan = $tgl2;
                $tglPelaksanaan = Indonesia2Tgl($viewKeg['tgl_mulai2']) . ' s.d ' . Indonesia2Tgl($viewKeg['tgl_selesai2']);
                $tglTTD = Indonesia2Tgl($viewKeg['tgl_selesai2']);
            } elseif ($viewKeg['mapping'] == 3) {
                $uangHarian = $totalUangHarianTerjauh;
                $pelaksanaan = $tgl1;
                $tglPelaksanaan = Indonesia2Tgl($viewKeg['tgl_mulai']) . ' s.d ' . Indonesia2Tgl($viewKeg['tgl_selesai']);
                $tglTTD = Indonesia2Tgl($viewKeg['tgl_selesai']);
            }
            //logika file
            $sqlFileTransport = mysqli_query($myConnection, "select * from tb_petugas_file where id_petugas_keg = '$id_petugas_keg' and jenis_file = 'file_transport'");
            $sqlFileHotel = mysqli_query($myConnection, "select * from tb_petugas_file where id_petugas_keg = '$id_petugas_keg' and jenis_file = 'file_hotel'");

            if (mysqli_num_rows($sqlFileTransport) > 0) {
                $transportMapping = $viewKeg['besaran'] * 2;
                if ($totalTransport > $transportMapping) {
                    $hitungTransport = $transportMapping;
                } else {
                    $hitungTransport = $totalTransport;
                }
            } else {
                $hitungTransport = 0;
                // $uangHarian = 0;
            }

            if (mysqli_num_rows($sqlFileHotel) > 0) {
                $hotelMapping = $viewKeg['pagu_hotel'] * $totalMenginapHotel;
                if ($totalHotel > $hotelMapping) {
                    $hitungHotel = $hotelMapping;
                } else {
                    $hitungHotel = $totalHotel;
                }
            } else {
                $hitungHotel = 0;
            }

            if (mysqli_num_rows($sqlFileTransport) > 0 || mysqli_num_rows($sqlFileHotel) > 0) {
                $jmlPeg = 1;
                $uangHarian = $uangHarian;
                $nama = $viewKeg['nama_peg'];
            } else {
                $jmlPeg = 0;
                $uangHarian = 0;
                // $nama = '-';
            }
        }

        $totalPengeluaran = $uangHarian + $hitungTransport + $hitungHotel;
        $hitungTotal[] = $totalPengeluaran;
        $nama_peg_sptjb[] = $nama;
        $uangHarianJml[] = $uangHarian;
        $countPeg[] = $jmlPeg;
    }

    // $count = count($hitungTotal);

    // for ($i = 0; $i < $count; $i++) {
    //     echo $i . '. ' . ' ' . $nama_peg_sptjb[$i] . ' => ' . $hitungTotal[$i] . '<br>';
    // }

    // echo format_angka(array_sum($hitungTotal));
    // var_dump($nama_peg_sptjb);
    $var_dump_nama = array_values(array_filter($nama_peg_sptjb));
    $nama_yg_tampil = $var_dump_nama[0];
    // echo array_sum($countPeg);
    //rincian
    $mpdf->AddPage('P', '', '', '', '', 10, 10, 10, 10);
    $mpdf->WriteHTML('<table border="0" style="border-collapse: collapse;margin-bottom:-0.2em;" width="800px">');
    $mpdf->WriteHTML('<tr>
            <td width="70%"></td>
            <td style="font-size:10px">Lampiran 1 Perdirjen Perbendaharaan</td>
            </tr>');
    $mpdf->WriteHTML('<tr>
            <td></td>
            <td style="font-size:10px">Nomor Per. 11/PB/2011</td>
            </tr>');
    $mpdf->WriteHTML('<tr>
            <td></td>
            <td style="font-size:10px">Tanggal  : 18 Februari 2011</td>
            </tr>');
    $mpdf->WriteHTML('</table><br>');
    $mpdf->WriteHTML('<div style="margin-bottom:0.8em">
    <h3 style="padding-bottom:-1em;text-align: center;">SURAT PERNYATAAN TANGGUNG JAWAB  BELANJA</h3>
    <h4 style="padding-bottom:-1em;text-align: center;">Nomor : ' . $pengaturan['no_spd'] . '</h4>
    </div>');

    $mpdf->WriteHTML('<table border="0" style="border-collapse: collapse;margin-bottom:0.2em;" width="800px">');
    $mpdf->WriteHTML('<tr>
            <td width="5%">1.</td>
            <td width="20%">Nama Satuan Kerja</td>
            <td width="1%">:</td>
            <td>' . $pengaturan['nama_satker'] . '</td>
            </tr>');
    $mpdf->WriteHTML('<tr>
            <td width="5%">2.</td>
            <td width="20%">Kode Satuan Kerja</td>
            <td width="1%">:</td>
            <td>' . $pengaturan['kode_satker'] . '</td>
            </tr>');
    $mpdf->WriteHTML('<tr>
            <td width="5%">3.</td>
            <td width="20%">Tanggal/No. DIPA</td>
            <td width="1%">:</td>
            <td>' . Indonesia2Tgl($pengaturan['tgl_dipa']) . ', DIPA - ' . $pengaturan['no_dipa'] . '</td>
            </tr>');
    $mpdf->WriteHTML('<tr>
            <td style="border-style:solid;border-bottom:1px" width="5%">4.</td>
            <td style="border-style:solid;border-bottom:1px" width="20%">Nama Satuan Kerja</td>
            <td style="border-style:solid;border-bottom:1px" width="1%">:</td>
            <td style="border-style:solid;border-bottom:1px">' . $pengaturan['klasifikasi'] . '</td>
            </tr>');
    $mpdf->WriteHTML('</table>');
    $mpdf->WriteHTML('<p>Yang bertanda tangan di bawah ini atas nama Kuasa Pengguna Anggaran Satuan Kerja Lembaga Penjaminan Mutu Pendidikan (LPMP) Jatim menyatakan bahwa saya bertanggung jawab secara formal dan material dan kebenaran perhitungan pajak atas segala pembayaran tagihan yang telah kami perintahkan dalam SPM ini dengan perincian sebagai berikut :</p>');

    $mpdf->WriteHTML('<table border="1" style="border-collapse: collapse;margin-bottom:0.2em;" width="800px">');
    $mpdf->WriteHTML('<tr>
           <th rowspan="2" width="5%">NO</th>
           <th rowspan="2">AKUN</th>
           <th rowspan="2">PENERIMA</th>
           <th rowspan="2">URAIAN</th>
           <th rowspan="2">JUMLAH</th>
           <th colspan="2" >PAJAK YG DIPUNGUT</th>
            </tr>');
    $mpdf->WriteHTML('<tr>
            <th width="10%">PPN</th>
            <th width="10%">PPh</th>
            </tr>');
    $mpdf->WriteHTML('<tr>
            <td style="text-align:center;">1</td>
            <td style="text-align:center;">2</td>
            <td style="text-align:center;">3</td>
            <td style="text-align:center;">4</td>
            <td style="text-align:center;">5</td>
            <td style="text-align:center;">6</td>
            <td style="text-align:center;">7</td>
            </tr>');
    $mpdf->WriteHTML('<tr>
            <td style="text-align:center;padding-top:2em;vertical-align:top" height="240px">1</td>
            <td style="text-align:center;padding-top:2em;vertical-align:top">' . $pengaturan['no_mak'] . '</td>
            <td style="padding-left:0.8em;padding-top:2em;vertical-align:top">' . $nama_yg_tampil . '<br>Cs. ' . array_sum($countPeg) . ' orang</td>
            <td style="padding-left:0.8em;padding-top:2em;vertical-align:top">Biaya Perjalanan Dinas Petugas ' . $pengaturan['nama_keg'] . '</td>
            <td style="padding-left:0.8em;padding-right:0.8em;text-align:center;padding-top:2em;vertical-align:top">' . format_angka(array_sum($hitungTotal)) . '</td>
            <td style="text-align:center;padding-top:2em;vertical-align:top"></td>
            <td style="text-align:center;padding-top:2em;vertical-align:top"></td>
            </tr>');
    $mpdf->WriteHTML('<tr>
            <th style="text-align:center;" colspan="4">JUMLAH</th>
            <th style="text-align:center;">' . format_angka(array_sum($hitungTotal)) . '</th>
            <th style="text-align:center;"></th>
            <th style="text-align:center;"></th>
            </tr>');
    $mpdf->WriteHTML('</table>');

    $mpdf->WriteHTML('<p>Bukti-bukti pengeluaran anggaran dan asli setoran pajak (SSP/BPN) tersebut di atas disimpan oleh Pengguna Anggaran/ Kuasa Pengguna Anggaran untuk kelengkapan administrasi dan keperluan pemeriksaan aparat pengawasan fungsional.</p>');
    $mpdf->WriteHTML('<p>Demikian Surat Pernyataan ini dibuat dengan sebenarnya.');

    $mpdf->WriteHTML('<div style="padding-top:50px;">
            <table border="0" style="margin: 0 auto;border-collapse: collapse;" width="800px">
            <tr>
            <td width="60%"></td>
            <td style="padding-left:2em">
            <div><p>Surabaya, ' . Indonesia2Tgl($pengaturan['tgl_selesai']) . '</p>
            <p>Setuju dibayar :</p>
            <p>Kuasa Pengguna Anggaran/</p>
            <p>Pejabat Pembuat Komitmen</p>
            <br>
            <br>
            <br>
            <br>
            <p>' . $pengaturan['ppk'] . '</p>
            <p>NIP. ' . $pengaturan['nip_ppk'] . '</p>
            </td>
            </tr>
            </table>
            </div>');

    $mpdf->Output("SPTJB_Perjadin_BBPMP_Jatim_" . $pengaturan['nama_keg'] . ".pdf", "I");
    exit;
} else {
    echo "Forbidden Access<br><br><br><br>";
}
