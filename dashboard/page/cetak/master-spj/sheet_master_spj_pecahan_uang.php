<?php
$excel->createSheet();

$excel->setActiveSheetIndex(1)->setCellValue('A1', "No");
$excel->setActiveSheetIndex(1)->setCellValue('B1', "Nama");
$excel->setActiveSheetIndex(1)->setCellValue('C1', "Diterimakan");
$excel->setActiveSheetIndex(1)->setCellValue('D1', "100000");
$excel->setActiveSheetIndex(1)->setCellValue('E1', "50000");
$excel->setActiveSheetIndex(1)->setCellValue('F1', "20000");
$excel->setActiveSheetIndex(1)->setCellValue('G1', "10000");
$excel->setActiveSheetIndex(1)->setCellValue('H1', "5000");
$excel->setActiveSheetIndex(1)->setCellValue('I1', "2000");
$excel->setActiveSheetIndex(1)->setCellValue('J1', "1000");
$excel->setActiveSheetIndex(1)->setCellValue('K1', "500");
$excel->setActiveSheetIndex(1)->setCellValue('L1', "100");
$excel->setActiveSheetIndex(1)->setCellValue('M1', "Jml. Rincian");
$excel->setActiveSheetIndex(1)->setCellValue('N1', "Kekurangan");

$excel->getActiveSheet()->getStyle('D1:L1')->getNumberFormat()->setFormatCode("#,##0");

$excel->getActiveSheet()->getStyle('A1')->applyFromArray($style_col);
$excel->getActiveSheet()->getStyle('B1')->applyFromArray($style_col);
$excel->getActiveSheet()->getStyle('C1')->applyFromArray($style_col);
$excel->getActiveSheet()->getStyle('D1')->applyFromArray($style_col);
$excel->getActiveSheet()->getStyle('E1')->applyFromArray($style_col);
$excel->getActiveSheet()->getStyle('F1')->applyFromArray($style_col);
$excel->getActiveSheet()->getStyle('G1')->applyFromArray($style_col);
$excel->getActiveSheet()->getStyle('H1')->applyFromArray($style_col);
$excel->getActiveSheet()->getStyle('I1')->applyFromArray($style_col);
$excel->getActiveSheet()->getStyle('J1')->applyFromArray($style_col);
$excel->getActiveSheet()->getStyle('K1')->applyFromArray($style_col);
$excel->getActiveSheet()->getStyle('L1')->applyFromArray($style_col);
$excel->getActiveSheet()->getStyle('M1')->applyFromArray($style_col);
$excel->getActiveSheet()->getStyle('N1')->applyFromArray($style_col);

$excel->getActiveSheet()->getRowDimension('1')->setRowHeight(20);

$excel->getActiveSheet()->getColumnDimension('A')->setWidth(5);
$excel->getActiveSheet()->getColumnDimension('B')->setWidth(30);
$excel->getActiveSheet()->getColumnDimension('C')->setWidth(15);
$excel->getActiveSheet()->getColumnDimension('D')->setWidth(8);
$excel->getActiveSheet()->getColumnDimension('E')->setWidth(8);
$excel->getActiveSheet()->getColumnDimension('F')->setWidth(8);
$excel->getActiveSheet()->getColumnDimension('G')->setWidth(8);
$excel->getActiveSheet()->getColumnDimension('H')->setWidth(8);
$excel->getActiveSheet()->getColumnDimension('I')->setWidth(8);
$excel->getActiveSheet()->getColumnDimension('J')->setWidth(8);
$excel->getActiveSheet()->getColumnDimension('K')->setWidth(8);
$excel->getActiveSheet()->getColumnDimension('L')->setWidth(8);
$excel->getActiveSheet()->getColumnDimension('M')->setWidth(15);
$excel->getActiveSheet()->getColumnDimension('N')->setWidth(15);


$no = 1;
$numrow = 2;

$noRecehUrutTugasPengarah = 1;
$noRecehUrutTugasNarsum = 1;
$noRecehUrutTugasPanitia = 1;
$noRecehUrutTugasPeserta = 1;

$hitungTotal = [];
$total100k = [];
$total50k = [];
$total20k = [];
$total10k = [];
$total5k = [];
$total2k = [];
$total1k = [];
$total500 = [];
$total100 = [];
$totalRincian = [];
$totalKurang = [];

//pengarah
$sqlPengarah = mysqli_query($myConnection, "select tb_pengarah_keg_hotel.* , tb_kabkota.name as nama_kab
from tb_pengarah_keg_hotel
left join tb_kabkota on tb_kabkota.id = tb_pengarah_keg_hotel.id_kabkota_unit_kerja
where tb_pengarah_keg_hotel.id_keg = '$id_keg' ");
while ($viewPengarah = mysqli_fetch_array($sqlPengarah)) {
    $golPajakPengarah = $viewPengarah['id_pangkat_gol'];
    $totalTransportPengarah = $viewPengarah['bbm'] + $viewPengarah['tiket_pesawat'] + $viewPengarah['tiket_kapal'] + $viewPengarah['tiket'] + $viewPengarah['lokal'] + $viewPengarah['taksi'] + $viewPengarah['toll'] + $viewPengarah['dpr1'] + $viewPengarah['dpr2'];

    if ($totalTransportPengarah > $sbmPengarah) {
        $transportPengarah = $sbmPengarah;
    } else {
        $transportPengarah = $totalTransportPengarah;
    }

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

    $TotalPengarah = $transportPengarah + $uangHonorPengarahPotongan;


    $arrayRecehanPengarah = recehan($TotalPengarah);
    $jml100kPengarah = $arrayRecehanPengarah[0] * 100000;
    $jml50kPengarah = $arrayRecehanPengarah[1] * 50000;
    $jml20kPengarah = $arrayRecehanPengarah[2] * 20000;
    $jml10kPengarah = $arrayRecehanPengarah[3] * 10000;
    $jml5kPengarah = $arrayRecehanPengarah[4] * 5000;
    $jml2kPengarah = $arrayRecehanPengarah[5] * 2000;
    $jml1kPengarah = $arrayRecehanPengarah[6] * 1000;
    $jml500Pengarah = $arrayRecehanPengarah[7] * 500;
    $jml100Pengarah = $arrayRecehanPengarah[8] * 100;

    $jmlRincianPengarah = $jml100kPengarah + $jml50kPengarah + $jml20kPengarah + $jml10kPengarah + $jml5kPengarah + $jml2kPengarah + $jml1kPengarah + $jml500Pengarah + $jml100Pengarah;
    $kurangPengarah = $TotalPengarah - $jmlRincianPengarah;


    $excel->setActiveSheetIndex(1)->setCellValue('A' . $numrow, $noRecehUrutTugasPengarah);
    $excel->setActiveSheetIndex(1)->setCellValue('B' . $numrow, $viewPengarah['nama']);
    $excel->setActiveSheetIndex(1)->setCellValue('C' . $numrow, $TotalPengarah);

    $excel->setActiveSheetIndex(1)->setCellValue('D' . $numrow, $arrayRecehanPengarah[0]);
    $excel->setActiveSheetIndex(1)->setCellValue('E' . $numrow, $arrayRecehanPengarah[1]);
    $excel->setActiveSheetIndex(1)->setCellValue('F' . $numrow, $arrayRecehanPengarah[2]);
    $excel->setActiveSheetIndex(1)->setCellValue('G' . $numrow, $arrayRecehanPengarah[3]);
    $excel->setActiveSheetIndex(1)->setCellValue('H' . $numrow, $arrayRecehanPengarah[4]);
    $excel->setActiveSheetIndex(1)->setCellValue('I' . $numrow, $arrayRecehanPengarah[5]);
    $excel->setActiveSheetIndex(1)->setCellValue('J' . $numrow, $arrayRecehanPengarah[6]);
    $excel->setActiveSheetIndex(1)->setCellValue('K' . $numrow, $arrayRecehanPengarah[7]);
    $excel->setActiveSheetIndex(1)->setCellValue('L' . $numrow, $arrayRecehanPengarah[8]);

    $excel->setActiveSheetIndex(1)->setCellValue('M' . $numrow, $jmlRincianPengarah);
    $excel->getActiveSheet()->getStyle('M' . $numrow)->getNumberFormat()->setFormatCode("#,##0");
    $excel->setActiveSheetIndex(1)->setCellValue('N' . $numrow, $kurangPengarah);

    $excel->getActiveSheet()->getStyle('A' . $numrow)->applyFromArray($style_row);
    $excel->getActiveSheet()->getStyle('B' . $numrow)->applyFromArray($style_row);
    $excel->getActiveSheet()->getStyle('C' . $numrow)->applyFromArray($style_row);
    $excel->getActiveSheet()->getStyle('D' . $numrow)->applyFromArray($style_row);
    $excel->getActiveSheet()->getStyle('E' . $numrow)->applyFromArray($style_row);
    $excel->getActiveSheet()->getStyle('F' . $numrow)->applyFromArray($style_row);
    $excel->getActiveSheet()->getStyle('G' . $numrow)->applyFromArray($style_row);
    $excel->getActiveSheet()->getStyle('H' . $numrow)->applyFromArray($style_row);
    $excel->getActiveSheet()->getStyle('I' . $numrow)->applyFromArray($style_row);
    $excel->getActiveSheet()->getStyle('J' . $numrow)->applyFromArray($style_row);
    $excel->getActiveSheet()->getStyle('K' . $numrow)->applyFromArray($style_row);
    $excel->getActiveSheet()->getStyle('L' . $numrow)->applyFromArray($style_row);
    $excel->getActiveSheet()->getStyle('M' . $numrow)->applyFromArray($style_row);
    $excel->getActiveSheet()->getStyle('N' . $numrow)->applyFromArray($style_row);

    $excel->getActiveSheet()->getStyle('C' . $numrow)->getNumberFormat()->setFormatCode("#,##0");
    $excel->getActiveSheet()->getStyle('M' . $numrow)->getNumberFormat()->setFormatCode("#,##0");

    $excel->getActiveSheet()->getStyle('A' . $numrow . ':N' . $numrow)->getFont()->setSize(10);

    $numrow++;
    $noRecehUrutTugasPengarah++;

    $hitungTotal[] = $TotalPengarah;
    $total100k[] = $arrayRecehanPengarah[0];
    $total50k[] = $arrayRecehanPengarah[1];
    $total20k[] = $arrayRecehanPengarah[2];
    $total10k[] = $arrayRecehanPengarah[3];
    $total5k[] = $arrayRecehanPengarah[4];
    $total2k[] = $arrayRecehanPengarah[5];
    $total1k[] = $arrayRecehanPengarah[6];
    $total500[] = $arrayRecehanPengarah[7];
    $total100[] = $arrayRecehanPengarah[8];
    $totalRincian[] = $jmlRincianPengarah;
    $totalKurang[] = $kurangPengarah;
}

//narsum
$sqlNarsum = mysqli_query($myConnection, "select tb_narsum_keg_hotel.* , tb_kabkota.name as nama_kab
from tb_narsum_keg_hotel
left join tb_kabkota on tb_kabkota.id = tb_narsum_keg_hotel.id_kabkota_unit_kerja
where tb_narsum_keg_hotel.id_keg = '$id_keg' ");
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
            $uangHarianNarsum = $viewPerjadin['uh_narsum_i_kemdikbud'] == '' ? '0' : $viewPerjadin['uh_narsum_i_kemdikbud'] * $jmlHariNarsum;
            $uangHonorNarsum = '';
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

    $jmlPerjadinNarsum = $transportNarsum + $uangHarianNarsum + $hotel;
    $TotalNarsum = $transportNarsum + $uangHarianNarsum + $hotel + $uangHonorNarsumPotongan;

    $arrayRecehanNarsum = recehan($TotalNarsum);
    $jml100kNarsum = $arrayRecehanNarsum[0] * 100000;
    $jml50kNarsum = $arrayRecehanNarsum[1] * 50000;
    $jml20kNarsum = $arrayRecehanNarsum[2] * 20000;
    $jml10kNarsum = $arrayRecehanNarsum[3] * 10000;
    $jml5kNarsum = $arrayRecehanNarsum[4] * 5000;
    $jml2kNarsum = $arrayRecehanNarsum[5] * 2000;
    $jml1kNarsum = $arrayRecehanNarsum[6] * 1000;
    $jml500Narsum = $arrayRecehanNarsum[7] * 500;
    $jml100Narsum = $arrayRecehanNarsum[8] * 100;

    $jmlRincianNarsum = $jml100kNarsum + $jml50kNarsum + $jml20kNarsum + $jml10kNarsum + $jml5kNarsum + $jml2kNarsum + $jml1kNarsum + $jml500Narsum + $jml100Narsum;
    $kurangNarsum = $TotalNarsum - $jmlRincianNarsum;


    $excel->setActiveSheetIndex(1)->setCellValue('A' . $numrow, $noRecehUrutTugasNarsum);
    $excel->setActiveSheetIndex(1)->setCellValue('B' . $numrow, $viewNarsum['nama']);
    $excel->setActiveSheetIndex(1)->setCellValue('C' . $numrow, $TotalNarsum);

    $excel->setActiveSheetIndex(1)->setCellValue('D' . $numrow, $arrayRecehanNarsum[0]);
    $excel->setActiveSheetIndex(1)->setCellValue('E' . $numrow, $arrayRecehanNarsum[1]);
    $excel->setActiveSheetIndex(1)->setCellValue('F' . $numrow, $arrayRecehanNarsum[2]);
    $excel->setActiveSheetIndex(1)->setCellValue('G' . $numrow, $arrayRecehanNarsum[3]);
    $excel->setActiveSheetIndex(1)->setCellValue('H' . $numrow, $arrayRecehanNarsum[4]);
    $excel->setActiveSheetIndex(1)->setCellValue('I' . $numrow, $arrayRecehanNarsum[5]);
    $excel->setActiveSheetIndex(1)->setCellValue('J' . $numrow, $arrayRecehanNarsum[6]);
    $excel->setActiveSheetIndex(1)->setCellValue('K' . $numrow, $arrayRecehanNarsum[7]);
    $excel->setActiveSheetIndex(1)->setCellValue('L' . $numrow, $arrayRecehanNarsum[8]);

    $excel->setActiveSheetIndex(1)->setCellValue('M' . $numrow, $jmlRincianNarsum);
    $excel->getActiveSheet()->getStyle('M' . $numrow)->getNumberFormat()->setFormatCode("#,##0");
    $excel->setActiveSheetIndex(1)->setCellValue('N' . $numrow, $kurangNarsum);

    $excel->getActiveSheet()->getStyle('A' . $numrow)->applyFromArray($style_row);
    $excel->getActiveSheet()->getStyle('B' . $numrow)->applyFromArray($style_row);
    $excel->getActiveSheet()->getStyle('C' . $numrow)->applyFromArray($style_row);
    $excel->getActiveSheet()->getStyle('D' . $numrow)->applyFromArray($style_row);
    $excel->getActiveSheet()->getStyle('E' . $numrow)->applyFromArray($style_row);
    $excel->getActiveSheet()->getStyle('F' . $numrow)->applyFromArray($style_row);
    $excel->getActiveSheet()->getStyle('G' . $numrow)->applyFromArray($style_row);
    $excel->getActiveSheet()->getStyle('H' . $numrow)->applyFromArray($style_row);
    $excel->getActiveSheet()->getStyle('I' . $numrow)->applyFromArray($style_row);
    $excel->getActiveSheet()->getStyle('J' . $numrow)->applyFromArray($style_row);
    $excel->getActiveSheet()->getStyle('K' . $numrow)->applyFromArray($style_row);
    $excel->getActiveSheet()->getStyle('L' . $numrow)->applyFromArray($style_row);
    $excel->getActiveSheet()->getStyle('M' . $numrow)->applyFromArray($style_row);
    $excel->getActiveSheet()->getStyle('N' . $numrow)->applyFromArray($style_row);

    $excel->getActiveSheet()->getStyle('C' . $numrow)->getNumberFormat()->setFormatCode("#,##0");
    $excel->getActiveSheet()->getStyle('M' . $numrow)->getNumberFormat()->setFormatCode("#,##0");

    $excel->getActiveSheet()->getStyle('A' . $numrow . ':N' . $numrow)->getFont()->setSize(10);

    $numrow++;
    $noRecehUrutTugasNarsum++;

    $hitungTotal[] = $TotalNarsum;
    $total100k[] = $arrayRecehanNarsum[0];
    $total50k[] = $arrayRecehanNarsum[1];
    $total20k[] = $arrayRecehanNarsum[2];
    $total10k[] = $arrayRecehanNarsum[3];
    $total5k[] = $arrayRecehanNarsum[4];
    $total2k[] = $arrayRecehanNarsum[5];
    $total1k[] = $arrayRecehanNarsum[6];
    $total500[] = $arrayRecehanNarsum[7];
    $total100[] = $arrayRecehanNarsum[8];
    $totalRincian[] = $jmlRincianNarsum;
    $totalKurang[] = $kurangNarsum;
}


//panitia
$sqlPanitia = mysqli_query($myConnection, "select tb_panitia_keg_hotel.*, tb_pegawai.nama_peg as nama_peg, tb_jabatan_kegiatan.nama_jabatan
from tb_panitia_keg_hotel
left join tb_kegiatan on tb_kegiatan.id_keg = tb_panitia_keg_hotel.id_keg
left join tb_pegawai on tb_pegawai.id_peg = tb_panitia_keg_hotel.id_peg
left join tb_gol_pajak on tb_gol_pajak.id_pangkat = tb_pegawai.id_pangkat
left join tb_jabatan_kegiatan on tb_jabatan_kegiatan.kd_jabatan = tb_panitia_keg_hotel.id_jab_st
where tb_panitia_keg_hotel.id_keg = '$id_keg'
order by tb_jabatan_kegiatan.kd_jabatan asc");
while ($viewPanitia = mysqli_fetch_array($sqlPanitia)) {
    $id_peg = $viewPanitia['id_peg'];

    $golPajakPanitia = $viewPanitia['id_pangkat_gol'];
    $totalTransportPanitia = $viewPanitia['bbm'] + $viewPanitia['tiket_pesawat'] + $viewPanitia['tiket_kapal'] + $viewPanitia['tiket'] + $viewPanitia['lokal'] + $viewPanitia['taksi'] + $viewPanitia['toll'] + $viewPanitia['dpr1'] + $viewPanitia['dpr2'];
    $jmlHariPanitia = (IntervalDays($viewPanitia['tgl_mulai'], $viewPanitia['tgl_selesai'])) + 1;
    $idKabKotaPanitia = $viewPanitia['id_kabkota_unit_kerja'];
    $viewSBMPanitia = mysqli_fetch_array(mysqli_query($myConnection, "select id, besaran from tb_kabkota where id = '$idKabKotaPanitia'"));
    $sbmPanitia = $viewSBMPanitia['id'] == 3578 ? $viewSBMPanitia['besaran'] : $viewSBMPanitia['besaran'] * 2;
    $uangHarianPanitia = $viewPerjadin['uh_panitia'] == '' ? '0' : $viewPerjadin['uh_panitia'] * $jmlHariPanitia;
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

    $uangHarianPanitia = $viewPerjadin['uh_panitia'] == '' ? '0' : $viewPerjadin['uh_panitia'] * $jmlHariPanitia;

    if ($totalTransportPanitia > $sbmPanitia) {
        $transportPanitia = $sbmPanitia;
        $class = 'fw-bold text-danger';
        $titleTransport = 'Total Transport Riil : ' . format_angka($totalTransportPanitia);
    } else {
        $transportPanitia = $totalTransportPanitia;
        $class = '';
        $titleTransport = '';
    }
    $jmlPerjadinPanitia = $transportPanitia + $uangHarianPanitia;
    $TotalPanitia = $transportPanitia + $uangHarianPanitia + $uangHonorPanitiaPotongan;

    $arrayRecehanPanitia = recehan($TotalPanitia);
    $jml100kPanitia = $arrayRecehanPanitia[0] * 100000;
    $jml50kPanitia = $arrayRecehanPanitia[1] * 50000;
    $jml20kPanitia = $arrayRecehanPanitia[2] * 20000;
    $jml10kPanitia = $arrayRecehanPanitia[3] * 10000;
    $jml5kPanitia = $arrayRecehanPanitia[4] * 5000;
    $jml2kPanitia = $arrayRecehanPanitia[5] * 2000;
    $jml1kPanitia = $arrayRecehanPanitia[6] * 1000;
    $jml500Panitia = $arrayRecehanPanitia[7] * 500;
    $jml100Panitia = $arrayRecehanPanitia[8] * 100;

    $jmlRincianPanitia = $jml100kPanitia + $jml50kPanitia + $jml20kPanitia + $jml10kPanitia + $jml5kPanitia + $jml2kPanitia + $jml1kPanitia + $jml500Panitia + $jml100Panitia;
    $kurangPanitia = $TotalPanitia - $jmlRincianPanitia;

    $excel->setActiveSheetIndex(1)->setCellValue('A' . $numrow, $noRecehUrutTugasPanitia);
    $excel->setActiveSheetIndex(1)->setCellValue('B' . $numrow, $viewPanitia['nama']);
    $excel->setActiveSheetIndex(1)->setCellValue('C' . $numrow, $TotalPanitia);

    $excel->setActiveSheetIndex(1)->setCellValue('D' . $numrow, $arrayRecehanPanitia[0]);
    $excel->setActiveSheetIndex(1)->setCellValue('E' . $numrow, $arrayRecehanPanitia[1]);
    $excel->setActiveSheetIndex(1)->setCellValue('F' . $numrow, $arrayRecehanPanitia[2]);
    $excel->setActiveSheetIndex(1)->setCellValue('G' . $numrow, $arrayRecehanPanitia[3]);
    $excel->setActiveSheetIndex(1)->setCellValue('H' . $numrow, $arrayRecehanPanitia[4]);
    $excel->setActiveSheetIndex(1)->setCellValue('I' . $numrow, $arrayRecehanPanitia[5]);
    $excel->setActiveSheetIndex(1)->setCellValue('J' . $numrow, $arrayRecehanPanitia[6]);
    $excel->setActiveSheetIndex(1)->setCellValue('K' . $numrow, $arrayRecehanPanitia[7]);
    $excel->setActiveSheetIndex(1)->setCellValue('L' . $numrow, $arrayRecehanPanitia[8]);

    $excel->setActiveSheetIndex(1)->setCellValue('M' . $numrow, $jmlRincianPanitia);
    $excel->getActiveSheet()->getStyle('M' . $numrow)->getNumberFormat()->setFormatCode("#,##0");
    $excel->setActiveSheetIndex(1)->setCellValue('N' . $numrow, $kurangPanitia);

    $excel->getActiveSheet()->getStyle('A' . $numrow)->applyFromArray($style_row);
    $excel->getActiveSheet()->getStyle('B' . $numrow)->applyFromArray($style_row);
    $excel->getActiveSheet()->getStyle('C' . $numrow)->applyFromArray($style_row);
    $excel->getActiveSheet()->getStyle('D' . $numrow)->applyFromArray($style_row);
    $excel->getActiveSheet()->getStyle('E' . $numrow)->applyFromArray($style_row);
    $excel->getActiveSheet()->getStyle('F' . $numrow)->applyFromArray($style_row);
    $excel->getActiveSheet()->getStyle('G' . $numrow)->applyFromArray($style_row);
    $excel->getActiveSheet()->getStyle('H' . $numrow)->applyFromArray($style_row);
    $excel->getActiveSheet()->getStyle('I' . $numrow)->applyFromArray($style_row);
    $excel->getActiveSheet()->getStyle('J' . $numrow)->applyFromArray($style_row);
    $excel->getActiveSheet()->getStyle('K' . $numrow)->applyFromArray($style_row);
    $excel->getActiveSheet()->getStyle('L' . $numrow)->applyFromArray($style_row);
    $excel->getActiveSheet()->getStyle('M' . $numrow)->applyFromArray($style_row);
    $excel->getActiveSheet()->getStyle('N' . $numrow)->applyFromArray($style_row);

    $excel->getActiveSheet()->getStyle('C' . $numrow)->getNumberFormat()->setFormatCode("#,##0");
    $excel->getActiveSheet()->getStyle('M' . $numrow)->getNumberFormat()->setFormatCode("#,##0");

    $excel->getActiveSheet()->getStyle('A' . $numrow . ':N' . $numrow)->getFont()->setSize(10);

    $numrow++;
    $noRecehUrutTugasPanitia++;

    $hitungTotal[] = $TotalPanitia;
    $total100k[] = $arrayRecehanPanitia[0];
    $total50k[] = $arrayRecehanPanitia[1];
    $total20k[] = $arrayRecehanPanitia[2];
    $total10k[] = $arrayRecehanPanitia[3];
    $total5k[] = $arrayRecehanPanitia[4];
    $total2k[] = $arrayRecehanPanitia[5];
    $total1k[] = $arrayRecehanPanitia[6];
    $total500[] = $arrayRecehanPanitia[7];
    $total100[] = $arrayRecehanPanitia[8];
    $totalRincian[] = $jmlRincianPanitia;
    $totalKurang[] = $kurangPanitia;
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
    // if ($viewPeserta['dpr1'] == NULL || $viewPeserta['dpr1'] == '') {
    //     $totalTransportPeserta = $viewPeserta['bbm'] + $viewPeserta['tiket_pesawat'] + $viewPeserta['tiket_kapal'] + $viewPeserta['tiket'] + $viewPeserta['lokal'] + $viewPeserta['taksi'] + $viewPeserta['toll'] + $viewPeserta['dpr1'] + $viewPeserta['dpr2'];
    // } else {
    //     $TransportPesertaPP = $viewPeserta['dpr1'] + $viewPeserta['dpr2'];
    //     $totalTransportPeserta = ($viewPeserta['dpr1'] + $viewPeserta['dpr2']) * 2;
    // }
    // $jmlHariPeserta = (IntervalDays($viewPeserta['tgl_mulai'], $viewPeserta['tgl_selesai'])) + 1;
    // $idKabKotaPeserta = $viewPeserta['id_kabkota_unit_kerja'];
    // $viewSBMPeserta = mysqli_fetch_array(mysqli_query($myConnection, "select id, besaran from tb_kabkota where id = '$idKabKotaPeserta'"));
    // $sbmPeserta = $viewSBMPeserta['id'] == 3578 ? $viewSBMPeserta['besaran'] : $viewSBMPeserta['besaran'] * 2;
    // $uangHarianPeserta = $viewPerjadin['uh_peserta'] * $jmlHariPeserta;

    // if ($totalTransportPeserta > $sbmPeserta) {
    //     $transportPeserta = $sbmPeserta;
    //     $class = 'fw-bold text-danger';
    //     $titleTransport = 'Total Transport Riil : ' . format_angka($totalTransportPeserta);
    // } else {
    //     $transportPeserta = $totalTransportPeserta;
    //     $class = '';
    //     $titleTransport = '';
    // }
    // $jmlPerjadinPeserta = $transportPeserta + $uangHarianPeserta;
    // $TotalPeserta = $transportPeserta + $uangHarianPeserta;
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
    $jmlPerjadinPeserta = $transportPeserta + $uangHarianPeserta + $uangHarianPesertaHmin1 + $uangHarianPesertaHplus1 + $hotel;
    $TotalPeserta = $transportPeserta + $uangHarianPeserta + $uangHarianPesertaHmin1 + $uangHarianPesertaHplus1 + $hotel;

    $arrayRecehanPeserta = recehan($TotalPeserta);
    $jml100kPeserta = $arrayRecehanPeserta[0] * 100000;
    $jml50kPeserta = $arrayRecehanPeserta[1] * 50000;
    $jml20kPeserta = $arrayRecehanPeserta[2] * 20000;
    $jml10kPeserta = $arrayRecehanPeserta[3] * 10000;
    $jml5kPeserta = $arrayRecehanPeserta[4] * 5000;
    $jml2kPeserta = $arrayRecehanPeserta[5] * 2000;
    $jml1kPeserta = $arrayRecehanPeserta[6] * 1000;
    $jml500Peserta = $arrayRecehanPeserta[7] * 500;
    $jml100Peserta = $arrayRecehanPeserta[8] * 100;

    $jmlRincianPeserta = $jml100kPeserta + $jml50kPeserta + $jml20kPeserta + $jml10kPeserta + $jml5kPeserta + $jml2kPeserta + $jml1kPeserta + $jml500Peserta + $jml100Peserta;
    $kurangPeserta = $TotalPeserta - $jmlRincianPeserta;

    $excel->setActiveSheetIndex(1)->setCellValue('A' . $numrow, $noRecehUrutTugasPeserta);
    $excel->setActiveSheetIndex(1)->setCellValue('B' . $numrow, $viewPeserta['nama']);
    $excel->setActiveSheetIndex(1)->setCellValue('C' . $numrow, $TotalPeserta);

    $excel->setActiveSheetIndex(1)->setCellValue('D' . $numrow, $arrayRecehanPeserta[0]);
    $excel->setActiveSheetIndex(1)->setCellValue('E' . $numrow, $arrayRecehanPeserta[1]);
    $excel->setActiveSheetIndex(1)->setCellValue('F' . $numrow, $arrayRecehanPeserta[2]);
    $excel->setActiveSheetIndex(1)->setCellValue('G' . $numrow, $arrayRecehanPeserta[3]);
    $excel->setActiveSheetIndex(1)->setCellValue('H' . $numrow, $arrayRecehanPeserta[4]);
    $excel->setActiveSheetIndex(1)->setCellValue('I' . $numrow, $arrayRecehanPeserta[5]);
    $excel->setActiveSheetIndex(1)->setCellValue('J' . $numrow, $arrayRecehanPeserta[6]);
    $excel->setActiveSheetIndex(1)->setCellValue('K' . $numrow, $arrayRecehanPeserta[7]);
    $excel->setActiveSheetIndex(1)->setCellValue('L' . $numrow, $arrayRecehanPeserta[8]);

    $excel->setActiveSheetIndex(1)->setCellValue('M' . $numrow, $jmlRincianPeserta);
    $excel->getActiveSheet()->getStyle('M' . $numrow)->getNumberFormat()->setFormatCode("#,##0");
    $excel->setActiveSheetIndex(1)->setCellValue('N' . $numrow, $kurangPeserta);

    $excel->getActiveSheet()->getStyle('A' . $numrow)->applyFromArray($style_row);
    $excel->getActiveSheet()->getStyle('B' . $numrow)->applyFromArray($style_row);
    $excel->getActiveSheet()->getStyle('C' . $numrow)->applyFromArray($style_row);
    $excel->getActiveSheet()->getStyle('D' . $numrow)->applyFromArray($style_row);
    $excel->getActiveSheet()->getStyle('E' . $numrow)->applyFromArray($style_row);
    $excel->getActiveSheet()->getStyle('F' . $numrow)->applyFromArray($style_row);
    $excel->getActiveSheet()->getStyle('G' . $numrow)->applyFromArray($style_row);
    $excel->getActiveSheet()->getStyle('H' . $numrow)->applyFromArray($style_row);
    $excel->getActiveSheet()->getStyle('I' . $numrow)->applyFromArray($style_row);
    $excel->getActiveSheet()->getStyle('J' . $numrow)->applyFromArray($style_row);
    $excel->getActiveSheet()->getStyle('K' . $numrow)->applyFromArray($style_row);
    $excel->getActiveSheet()->getStyle('L' . $numrow)->applyFromArray($style_row);
    $excel->getActiveSheet()->getStyle('M' . $numrow)->applyFromArray($style_row);
    $excel->getActiveSheet()->getStyle('N' . $numrow)->applyFromArray($style_row);

    $excel->getActiveSheet()->getStyle('C' . $numrow)->getNumberFormat()->setFormatCode("#,##0");
    $excel->getActiveSheet()->getStyle('M' . $numrow)->getNumberFormat()->setFormatCode("#,##0");

    $excel->getActiveSheet()->getStyle('A' . $numrow . ':N' . $numrow)->getFont()->setSize(10);

    $numrow++;
    $noRecehUrutTugasPeserta++;

    $hitungTotal[] = $TotalPeserta;
    $total100k[] = $arrayRecehanPeserta[0];
    $total50k[] = $arrayRecehanPeserta[1];
    $total20k[] = $arrayRecehanPeserta[2];
    $total10k[] = $arrayRecehanPeserta[3];
    $total5k[] = $arrayRecehanPeserta[4];
    $total2k[] = $arrayRecehanPeserta[5];
    $total1k[] = $arrayRecehanPeserta[6];
    $total500[] = $arrayRecehanPeserta[7];
    $total100[] = $arrayRecehanPeserta[8];
    $totalRincian[] = $jmlRincianPeserta;
    $totalKurang[] = $kurangPeserta;
}


$excel->setActiveSheetIndex(1)->setCellValue('A' . $numrow, '');
$excel->setActiveSheetIndex(1)->setCellValue('B' . $numrow, 'Total');
$excel->getActiveSheet()->getStyle('B' . $numrow)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$excel->setActiveSheetIndex(1)->setCellValue('C' . $numrow, array_sum($hitungTotal));
$excel->getActiveSheet()->getStyle('C' . $numrow)->getNumberFormat()->setFormatCode("#,##0");

$excel->setActiveSheetIndex(1)->setCellValue('D' . $numrow, array_sum($total100k));
$excel->setActiveSheetIndex(1)->setCellValue('E' . $numrow, array_sum($total50k));
$excel->setActiveSheetIndex(1)->setCellValue('F' . $numrow, array_sum($total20k));
$excel->setActiveSheetIndex(1)->setCellValue('G' . $numrow, array_sum($total10k));
$excel->setActiveSheetIndex(1)->setCellValue('H' . $numrow, array_sum($total5k));
$excel->setActiveSheetIndex(1)->setCellValue('I' . $numrow, array_sum($total2k));
$excel->setActiveSheetIndex(1)->setCellValue('J' . $numrow, array_sum($total1k));
$excel->setActiveSheetIndex(1)->setCellValue('K' . $numrow, array_sum($total500));
$excel->setActiveSheetIndex(1)->setCellValue('L' . $numrow, array_sum($total100));
$excel->setActiveSheetIndex(1)->setCellValue('M' . $numrow, array_sum($totalRincian));
$excel->getActiveSheet()->getStyle('M' . $numrow)->getNumberFormat()->setFormatCode("#,##0");
$excel->setActiveSheetIndex(1)->setCellValue('N' . $numrow, array_sum($totalKurang));


$excel->getActiveSheet()->getStyle('A' . $numrow)->applyFromArray($style_row);
$excel->getActiveSheet()->getStyle('B' . $numrow)->applyFromArray($style_row);
$excel->getActiveSheet()->getStyle('C' . $numrow)->applyFromArray($style_row);
$excel->getActiveSheet()->getStyle('D' . $numrow)->applyFromArray($style_row);
$excel->getActiveSheet()->getStyle('E' . $numrow)->applyFromArray($style_row);
$excel->getActiveSheet()->getStyle('F' . $numrow)->applyFromArray($style_row);
$excel->getActiveSheet()->getStyle('G' . $numrow)->applyFromArray($style_row);
$excel->getActiveSheet()->getStyle('H' . $numrow)->applyFromArray($style_row);
$excel->getActiveSheet()->getStyle('I' . $numrow)->applyFromArray($style_row);
$excel->getActiveSheet()->getStyle('J' . $numrow)->applyFromArray($style_row);
$excel->getActiveSheet()->getStyle('K' . $numrow)->applyFromArray($style_row);
$excel->getActiveSheet()->getStyle('L' . $numrow)->applyFromArray($style_row);
$excel->getActiveSheet()->getStyle('M' . $numrow)->applyFromArray($style_row);
$excel->getActiveSheet()->getStyle('N' . $numrow)->applyFromArray($style_row);

$excel->getActiveSheet()->getStyle('D' . $numrow)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$excel->getActiveSheet()->getStyle('E' . $numrow)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$excel->getActiveSheet()->getStyle('F' . $numrow)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$excel->getActiveSheet()->getStyle('G' . $numrow)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$excel->getActiveSheet()->getStyle('H' . $numrow)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$excel->getActiveSheet()->getStyle('I' . $numrow)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$excel->getActiveSheet()->getStyle('J' . $numrow)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$excel->getActiveSheet()->getStyle('K' . $numrow)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$excel->getActiveSheet()->getStyle('L' . $numrow)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$excel->getActiveSheet()->getStyle('N' . $numrow)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);


$excel->setActiveSheetIndex(1)->setCellValue('Q1', "No");
$excel->setActiveSheetIndex(1)->setCellValue('R1', "Uang");
$excel->setActiveSheetIndex(1)->setCellValue('S1', "Jumlah");
$excel->setActiveSheetIndex(1)->setCellValue('T1', "Jumlah/Lembar");

$excel->getActiveSheet()->getStyle('Q1')->applyFromArray($style_col);
$excel->getActiveSheet()->getStyle('R1')->applyFromArray($style_col);
$excel->getActiveSheet()->getStyle('S1')->applyFromArray($style_col);
$excel->getActiveSheet()->getStyle('T1')->applyFromArray($style_col);

$excel->getActiveSheet()->getRowDimension('1')->setRowHeight(20);

$excel->getActiveSheet()->getColumnDimension('Q')->setWidth(5);
$excel->getActiveSheet()->getColumnDimension('R')->setWidth(20);
$excel->getActiveSheet()->getColumnDimension('S')->setWidth(20);
$excel->getActiveSheet()->getColumnDimension('T')->setWidth(20);

$jmlPecahan = 9;
$row = 2;
$arrayPecah = [array_sum($total100k), array_sum($total50k), array_sum($total20k), array_sum($total10k), array_sum($total5k), array_sum($total2k), array_sum($total1k), array_sum($total500), array_sum($total100)];
$arrayPecahan = [100000, 50000, 20000, 10000, 5000, 2000, 1000, 500, 100];
for ($i = 0; $i < $jmlPecahan; $i++) {
    $angka = $i + 1;
    $excel->setActiveSheetIndex(1)->setCellValue('Q' . $row, $angka);
    $excel->setActiveSheetIndex(1)->setCellValue('R' . $row, $arrayPecahan[$i]);
    $excel->setActiveSheetIndex(1)->setCellValue('S' . $row, $arrayPecah[$i] * $arrayPecahan[$i]);
    $excel->setActiveSheetIndex(1)->setCellValue('T' . $row, ($arrayPecah[$i] * $arrayPecahan[$i]) / $arrayPecahan[$i]);

    $excel->getActiveSheet()->getStyle('R' . $row)->getNumberFormat()->setFormatCode("#,##0");
    $excel->getActiveSheet()->getStyle('Q' . $row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $excel->getActiveSheet()->getStyle('S' . $row)->getNumberFormat()->setFormatCode("#,##0");

    $excel->getActiveSheet()->getStyle('Q' . $row)->applyFromArray($style_row);
    $excel->getActiveSheet()->getStyle('R' . $row)->applyFromArray($style_row);
    $excel->getActiveSheet()->getStyle('S' . $row)->applyFromArray($style_row);
    $excel->getActiveSheet()->getStyle('T' . $row)->applyFromArray($style_row);

    $row++;
}


$excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);

// Rename 2nd sheet
$excel->getActiveSheet(1)->setTitle('Master Uang Pecahan');
