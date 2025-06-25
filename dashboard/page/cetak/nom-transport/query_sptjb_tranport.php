<?php
$sptjbPengarah = 0;
$sptjbNarsum = 0;
$jmlNarsumOrang = 0;
$sptjbPanitia = 0;
$jmlPanitiaOrang = 0;
$sptjbPeserta = 0;
$jmlPesertaOrang = 0;


//pengarah
$sqlPengarah = mysqli_query($myConnection, "select tb_pengarah_keg_hotel.* , tb_kabkota.name as nama_kab
from tb_pengarah_keg_hotel
left join tb_kabkota on tb_kabkota.id = tb_pengarah_keg_hotel.id_kabkota_unit_kerja
where tb_pengarah_keg_hotel.id_keg = '$id_keg' order by tb_pengarah_keg_hotel.created_date desc");
while ($viewPengarah = mysqli_fetch_array($sqlPengarah)) {
    $golPajakPengarah = $viewPengarah['id_pangkat_gol'];
    $totalTransportPengarah = $viewPengarah['bbm'] + $viewPengarah['tiket_pesawat'] + $viewPengarah['tiket_kapal'] + $viewPengarah['tiket'] + $viewPengarah['lokal'] + $viewPengarah['taksi'] + $viewPengarah['toll'] + $viewPengarah['dpr1'] + $viewPengarah['dpr2'];
    $jmlHariPengarah = (IntervalDays($viewPengarah['tgl_mulai'], $viewPengarah['tgl_selesai'])) + 1;
    $idKabKota = $viewPengarah['id_kabkota_unit_kerja'];
    $viewSBM = mysqli_fetch_array(mysqli_query($myConnection, "select id, besaran from tb_kabkota where id = '$idKabKota'"));
    $sbmPengarah = $viewSBM['id'] == 3578 ? $viewSBM['besaran'] : $viewSBM['besaran'] * 2;
    if ($totalTransportPengarah > $sbmPengarah) {
        $transportPengarah = $sbmPengarah;
    } else {
        $transportPengarah = $totalTransportPengarah;
    }
    $namaPengarah = $viewPengarah['nama'];
    $TotalPengarah = $transportPengarah;
    $sptjbPengarah = $sptjbPengarah + $TotalPengarah;
}

//narsum
$sqlNarsum = mysqli_query($myConnection, "select tb_narsum_keg_hotel.* , tb_kabkota.name as nama_kab
from tb_narsum_keg_hotel
left join tb_kabkota on tb_kabkota.id = tb_narsum_keg_hotel.id_kabkota_unit_kerja
where tb_narsum_keg_hotel.id_keg = '$id_keg' order by tb_narsum_keg_hotel.created_date desc");
while ($viewNarsum = mysqli_fetch_array($sqlNarsum)) {
    $golPajakNarsum = $viewNarsum['id_pangkat_gol'];
    $totalTransportNarsum = $viewNarsum['bbm'] + $viewNarsum['tiket_pesawat'] + $viewNarsum['tiket_kapal'] + $viewNarsum['tiket'] + $viewNarsum['lokal'] + $viewNarsum['lokal_jakarta'] + $viewNarsum['taksi'] + $viewNarsum['toll'] + $viewNarsum['dpr1'] + $viewNarsum['dpr2'];
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
        $hotel = 0;
    } elseif ($viewNarsum['jenis_narsum'] == 'eksternal') {
        if ($viewNarsum['status_internal_kemdikbud'] == 1) {
            $uangHarianNarsum = $viewPerjadin['uh_narsum_i_kemdikbud'] == '' ? '0' : $viewPerjadin['uh_narsum_i_kemdikbud'] * $jmlHariNarsum;;
            $uangHonorNarsum = 0;
            $makHonorNarsum = $viewPerjadin['mak_hr_narsum_i'];
            $makTranportNarsum = $viewPerjadin['mak_tp_narsum_i'];
            $honorPerJamNarsum = '';
            $jamNarsum = '';
            $hotel = $viewNarsum['penginapan'];
        } else {
            $uangHarianNarsum = '';
            $uangHonorNarsum = $viewPerjadin['honor_narsum_e'] == '' ? '0' : $viewPerjadin['honor_narsum_e'] * $viewNarsum['jml_jam'];
            $makHonorNarsum = $viewPerjadin['mak_hr_narsum_e'];
            $makTranportNarsum = $viewPerjadin['mak_tp_narsum_e'];
            $honorPerJamNarsum = $viewPerjadin['honor_narsum_e'];
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

    if ($totalTransportNarsum > $sbmNarsum) {
        $transportNarsum = $sbmNarsum;
    } else {
        $transportNarsum = $totalTransportNarsum;
    }

    $jmlNarsumOrang++;

    $namaNarsum = $viewNarsum['nama'];
    $jmlPerjadinNarsum = $transportNarsum + $uangHarianNarsum + $hotel;
    $sptjbNarsum = $sptjbNarsum + $jmlPerjadinNarsum;
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
    $totalTransportPanitia = $viewPanitia['bbm'] + $viewPanitia['tiket_pesawat'] + $viewPanitia['tiket_kapal'] + $viewPanitia['tiket'] + $viewPanitia['lokal'] + $viewPanitia['taksi'] + $viewPanitia['toll'] + $viewPanitia['dpr1'] + $viewPanitia['dpr2'];
    $jmlHariPanitia = (IntervalDays($viewPanitia['tgl_mulai'], $viewPanitia['tgl_selesai'])) + 1;
    $idKabKotaPanitia = $viewPanitia['id_kabkota_unit_kerja'];
    $viewSBMPanitia = mysqli_fetch_array(mysqli_query($myConnection, "select id, besaran from tb_kabkota where id = '$idKabKotaPanitia'"));
    $sbmPanitia = $viewSBMPanitia['id'] == 3578 ? $viewSBMPanitia['besaran'] : $viewSBMPanitia['besaran'] * 2;
    $uangHarianPanitia = $viewPerjadin['uh_panitia'] == '' ? '0' : $viewPerjadin['uh_panitia'] * $jmlHariPanitia;

    if ($totalTransportPanitia > $sbmPanitia) {
        $transportPanitia = $sbmPanitia;
    } else {
        $transportPanitia = $totalTransportPanitia;
    }
    $jmlPanitiaOrang++;
    $namaPanitia = $viewPanitia['nama'];
    $jmlPerjadinPanitia = $transportPanitia + $uangHarianPanitia;
    $sptjbPanitia = $sptjbPanitia + $jmlPerjadinPanitia;
}


//peserta
$sqlPeserta = mysqli_query($myConnection, "select tb_peserta_keg_hotel.* , tb_kabkota.name as nama_kab
from tb_peserta_keg_hotel
left join tb_kabkota on tb_kabkota.id = tb_peserta_keg_hotel.id_kabkota_unit_kerja
where tb_peserta_keg_hotel.id_keg = '$id_keg' ");
while ($viewPeserta = mysqli_fetch_array($sqlPeserta)) {
    $golPajakPeserta = $viewPeserta['id_pangkat_gol'];
    $pajakPeserta = mysqli_fetch_array(mysqli_query($myConnection, "select gol, pajak from tb_gol_pajak where id_pangkat = '$golPajakPeserta'"));
    // $totalTransportPeserta = $viewPeserta['bbm'] + $viewPeserta['tiket_pesawat'] + $viewPeserta['tiket_kapal'] + $viewPeserta['tiket'] + $viewPeserta['lokal'] + $viewPeserta['taksi'] + $viewPeserta['toll'] + $viewPeserta['dpr1'] + $viewPeserta['dpr2'];
    $jmlHariPeserta = (IntervalDays($viewPeserta['tgl_mulai'], $viewPeserta['tgl_selesai'])) + 1;
    $idKabKotaPeserta = $viewPeserta['id_kabkota_unit_kerja'];
    $viewSBMPeserta = mysqli_fetch_array(mysqli_query($myConnection, "select id, besaran from tb_kabkota where id = '$idKabKotaPeserta'"));
    $sbmPeserta = $viewSBMPeserta['id'] == 3578 ? $viewSBMPeserta['besaran'] : $viewSBMPeserta['besaran'] * 2;

    // if ($viewPeserta['dpr1'] == NULL || $viewPeserta['dpr1'] == '') {
    if ($viewPeserta['status_kabkota_unit_kerja'] == 'Daratan') {
        $totalTransportPeserta = $viewPeserta['bbm'] + $viewPeserta['tiket_pesawat'] + $viewPeserta['tiket'] + $viewPeserta['tiket_kapal'] + $viewPeserta['lokal'] + $viewPeserta['taksi'] + $viewPeserta['toll'] + $viewPeserta['dpr1'] + $viewPeserta['dpr2'];
        $uangHarianPeserta = $viewPerjadin['uh_peserta'] * $jmlHariPeserta;
        $tiketKapal = 0;
        $uangHarianPesertaHmin1 = 0;
        $uangHarianPesertaHplus1 = 0;
        $hotel = 0;
    } else {
        $totalTransportPeserta = $viewPeserta['bbm'] + $viewPeserta['tiket'] + $viewPeserta['lokal'] + $viewPeserta['taksi'] + $viewPeserta['toll'] + $viewPeserta['dpr1'] + $viewPeserta['dpr2'];
        $tiketKapal = $viewPeserta['tiket_kapal'];
        $uangHarianPeserta = $viewPerjadin['uh_peserta'] * $jmlHariPeserta;
        $uangHarianPesertaHmin1 = $viewPerjadin['uh_peserta'];
        $uangHarianPesertaHplus1 = $viewPerjadin['uh_peserta'];
        $hotel = $viewPeserta['penginapan'];
    }
    // } else {
    //     $TransportPesertaPP = $viewPeserta['dpr1'] + $viewPeserta['dpr2'];
    //     $totalTransportPeserta = ($viewPeserta['dpr1'] + $viewPeserta['dpr2']) * 2;
    // }

    if ($totalTransportPeserta > $sbmPeserta) {
        $transportPeserta = $sbmPeserta;
    } else {
        $transportPeserta = $totalTransportPeserta;
    }
    if ($viewPeserta['status_kabkota_unit_kerja'] == 'Kepulauan') {
        $transportPeserta = $transportPeserta + $tiketKapal;
    }

    $jmlPesertaOrang++;
    $jmlPerjadinPeserta = $transportPeserta + $uangHarianPeserta + $uangHarianPesertaHmin1 + $uangHarianPesertaHplus1 + $hotel;
    $TotalPeserta = $transportPeserta + $uangHarianPeserta + $uangHarianPesertaHmin1 + $uangHarianPesertaHplus1 + $hotel;
    $sptjbPeserta = $sptjbPeserta + $jmlPerjadinPeserta;
}
