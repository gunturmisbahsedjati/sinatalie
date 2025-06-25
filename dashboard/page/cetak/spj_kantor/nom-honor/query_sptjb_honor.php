<?php
$sptjbPengarah = 0;
$sptjbNarsum = 0;
$jmlNarsumOrang = 0;
$sptjbPanitia = 0;
$jmlPanitiaOrang = 0;
$sptjbPeserta = 0;
$jmlPesertaOrang = 0;
$allHonorPanitia = 0;
$allPajakPanitia = 0;
$allBiayaPanitia = 0;

require_once '../../../../inc/inc.koneksi.php';
require_once '../../../../inc/inc.library.php';
$id_keg = '1719230631-667960A7A926F';
$sqlKegiatan = mysqli_query($myConnection, "select tb_kegiatan.*, tb_kabkota.name as nama_kab, tb_profil_sptjb.nama_satker, tb_profil_sptjb.kode_satker, tb_profil_sptjb.no_dipa, tb_profil_sptjb.tgl_dipa, tb_profil_sptjb.klasifikasi, tb_profil_sptjb.no_dipa
from tb_kegiatan
left join tb_kabkota on tb_kabkota.id = tb_kegiatan.kabkota
left join tb_profil_sptjb on tb_profil_sptjb.id_profil_sptjb = tb_kegiatan.profil_dipa
where tb_kegiatan.id_keg = '$id_keg'");
$viewPerjadin = mysqli_fetch_array($sqlKegiatan);

//pengarah
$sqlPengarah = mysqli_query($myConnection, "select tb_pengarah_keg_hotel.* , tb_kabkota.name as nama_kab
from tb_pengarah_keg_hotel
left join tb_kabkota on tb_kabkota.id = tb_pengarah_keg_hotel.id_kabkota_unit_kerja
where tb_pengarah_keg_hotel.id_keg = '$id_keg' order by tb_pengarah_keg_hotel.created_date desc");
if (mysqli_num_rows($sqlPengarah) > 0) {
    while ($viewPengarah = mysqli_fetch_array($sqlPengarah)) {
        $golPajakPengarah = $viewPengarah['id_pangkat_gol'];
        $totalTransportPengarah = $viewPengarah['bbm'] + $viewPengarah['tiket_pesawat'] + $viewPengarah['tiket_kapal'] + $viewPengarah['tiket'] + $viewPengarah['lokal'] + $viewPengarah['taksi'] + $viewPengarah['toll'] + $viewPengarah['dpr1'] + $viewPengarah['dpr2'];
        $jmlHariPengarah = (IntervalDays($viewPengarah['tgl_mulai'], $viewPengarah['tgl_selesai'])) + 1;
        $idKabKota = $viewPengarah['id_kabkota_unit_kerja'];
        $viewSBM = mysqli_fetch_array(mysqli_query($myConnection, "select id, besaran from tb_kabkota where id = '$idKabKota'"));
        $sbmPengarah = $viewSBM['id'] == 3578 ? $viewSBM['besaran'] : $viewSBM['besaran'] * 2;
        if ($viewPengarah['jenis_pengarah'] == 'internal') {
            $uangHonorPengarah = '';
            $honorPerJamPengarah = '';
            $jamPengarah = '';
        } elseif ($viewPengarah['jenis_pengarah'] == 'eksternal') {
            $uangHonorPengarah = $viewPerjadin['honor_pengarah_e'] == '' ? '0' : $viewPerjadin['honor_pengarah_e'] * $viewPengarah['jml_jam'];
            $honorPerJamPengarah = $viewPerjadin['honor_pengarah_e'];
            $jamPengarah = $viewPengarah['jml_jam'];
        } else {
            $uangHonorPengarah = '';
            $honorPerJamPengarah = '';
            $jamPengarah = '';
        }
        $pajakPengarah = mysqli_fetch_array(mysqli_query($myConnection, "select gol,pajak from tb_gol_pajak where id_pangkat = '$golPajakPengarah'"));
        $potonganHonorPengarah = ($uangHonorPengarah) * ($pajakPengarah['pajak'] / 100);
        $uangHonorPengarahPotongan = $uangHonorPengarah - $potonganHonorPengarah;

        $namaHonorPengarah = $viewPengarah['nama'];
    }
} else {
    $namaHonorPengarah = '';
    $uangHonorPengarah = '';
    $honorPerJamPengarah = '';
    $jamPengarah = '';
}


//narsum
$sqlNarsum = mysqli_query($myConnection, "select tb_narsum_keg_hotel.* , tb_kabkota.name as nama_kab
from tb_narsum_keg_hotel
left join tb_kabkota on tb_kabkota.id = tb_narsum_keg_hotel.id_kabkota_unit_kerja
where tb_narsum_keg_hotel.id_keg = '$id_keg' order by tb_narsum_keg_hotel.created_date desc");
while ($viewNarsum = mysqli_fetch_array($sqlNarsum)) {
    $golPajakNarsum = $viewNarsum['id_pangkat_gol'];
    $totalTransportNarsum = $viewNarsum['bbm'] + $viewNarsum['tiket_pesawat'] + $viewNarsum['tiket_kapal'] + $viewNarsum['tiket'] + $viewNarsum['lokal'] + +$viewNarsum['lokal_jakarta'] + $viewNarsum['taksi'] + $viewNarsum['toll'] + $viewNarsum['dpr1'] + $viewNarsum['dpr2'];
    $jmlHariNarsum = (IntervalDays($viewNarsum['tgl_mulai'], $viewNarsum['tgl_selesai'])) + 1;
    $idKabKota = $viewNarsum['id_kabkota_unit_kerja'];
    $viewSBMNarsum = mysqli_fetch_array(mysqli_query($myConnection, "select id, besaran from tb_kabkota where id = '$idKabKota'"));
    $sbmNarsum = $viewSBMNarsum['id'] == 3578 ? $viewSBMNarsum['besaran'] : $viewSBMNarsum['besaran'] * 2;
    if ($viewNarsum['jenis_narsum'] == 'internal') {
        $uangHarianNarsum = $viewPerjadin['uh_narsum_i'] == '' ? '0' : $viewPerjadin['uh_narsum_i'] * $jmlHariNarsum;
        $uangHonorNarsum = '';
        $makHonorNarsum = $viewPerjadin['mak_hr_narsum_i'];
        $makTranportNarsum = $viewPerjadin['mak_tp_narsum_i'];
        $honorPerJamNarsum = '';
        $jamNarsum = '';
    } elseif ($viewNarsum['jenis_narsum'] == 'eksternal') {
        $uangHarianNarsum = '';
        $uangHonorNarsum = $viewPerjadin['honor_narsum_e'] == '' ? '0' : $viewPerjadin['honor_narsum_e'] * $viewNarsum['jml_jam'];
        $makHonorNarsum = $viewPerjadin['mak_hr_narsum_e'];
        $makTranportNarsum = $viewPerjadin['mak_tp_narsum_e'];
        $honorPerJamNarsum = $viewPerjadin['honor_narsum_e'];
        $jamNarsum = $viewNarsum['jml_jam'];
    } else {
        $uangHarianNarsum = '';
        $uangHonorNarsum = '';
        $makHonorNarsum = '';
        $makTranportNarsum = '';
        $honorPerJamNarsum = '';
        $jamNarsum = '';
    }
    $pajakNarsum = mysqli_fetch_array(mysqli_query($myConnection, "select gol,pajak from tb_gol_pajak where id_pangkat = '$golPajakNarsum'"));
    $potonganHonorNarsum = ($uangHonorNarsum) * ($pajakNarsum['pajak'] / 100);
    $uangHonorNarsumPotongan = $uangHonorNarsum - $potonganHonorNarsum;

    $jmlNarsumOrang++;

    $namaNarsum = $viewNarsum['nama'];
}

//panitia
$sqlPanitia = mysqli_query($myConnection, "select tb_panitia_keg_hotel.*, tb_pegawai.nama_peg as nama_peg, tb_jabatan_kegiatan.nama_jabatan
from tb_panitia_keg_hotel
left join tb_kegiatan on tb_kegiatan.id_keg = tb_panitia_keg_hotel.id_keg
left join tb_pegawai on tb_pegawai.id_peg = tb_panitia_keg_hotel.id_peg
left join tb_gol_pajak on tb_gol_pajak.id_pangkat = tb_pegawai.id_pangkat
left join tb_jabatan_kegiatan on tb_jabatan_kegiatan.kd_jabatan = tb_panitia_keg_hotel.id_jab_st
where tb_panitia_keg_hotel.id_keg = '$id_keg'
order by tb_panitia_keg_hotel.id_jab_st desc");
while ($viewPanitia = mysqli_fetch_array($sqlPanitia)) {
    $id_peg = $viewPanitia['id_peg'];
    $golPajakPanitia = $viewPanitia['id_pangkat_gol'];
    $idKabKotaPanitia = $viewPanitia['id_kabkota_unit_kerja'];
    $jamPanitia = $viewPanitia['jml_jam'];
    if ($viewPanitia['id_jab_st'] == '1') {
        $uangHonorPanitia = $viewPerjadin['honor_penanggungjawab'] == '' ? '0' : $viewPerjadin['honor_penanggungjawab'] * $viewPanitia['jml_jam'];
        $honorPerJamPanitia = $viewPerjadin['honor_penanggungjawab'];
    } elseif ($viewPanitia['id_jab_st'] == '3') {
        $uangHonorPanitia = $viewPerjadin['honor_ketua'] == '' ? '0' : $viewPerjadin['honor_ketua'] * $viewPanitia['jml_jam'];
        $honorPerJamPanitia = $viewPerjadin['honor_ketua'];
    } elseif ($viewPanitia['id_jab_st'] == '12') {
        $uangHonorPanitia = $viewPerjadin['honor_anggota'] == '' ? '0' : $viewPerjadin['honor_anggota'] * $viewPanitia['jml_jam'];
        $honorPerJamPanitia = $viewPerjadin['honor_anggota'];
    } else {
        $uangHonorPanitia = '';
        $honorPerJamPanitia = '';
    }
    $pajakPanitia = mysqli_fetch_array(mysqli_query($myConnection, "select gol, pajak from tb_gol_pajak where id_pangkat = '$golPajakPanitia'"));
    $potonganHonorPanitia = ($uangHonorPanitia) * ($pajakPanitia['pajak'] / 100);
    $uangHonorPanitiaPotongan = $uangHonorPanitia - $potonganHonorPanitia;
    $jmlPanitiaOrang++;
    $namaPanitia = $viewPanitia['nama'];
    $allHonorPanitia = $allHonorPanitia + $uangHonorPanitia;
    $allPajakPanitia = $allPajakPanitia + $potonganHonorPanitia;
    $allBiayaPanitia = $allBiayaPanitia + $uangHonorPanitiaPotongan;
}

echo $uangHonorPengarah . '<br>';
echo $potonganHonorPengarah . '<br>';
echo $uangHonorPengarahPotongan . '<br>';

echo $sptjbPanitia . '<br>';
echo $jmlPanitiaOrang . '<br>';
echo $sptjbPeserta . '<br>';
echo $jmlPesertaOrang . '<br>';
