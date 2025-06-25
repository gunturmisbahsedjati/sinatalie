<?php

$excel->setActiveSheetIndex(0)->setCellValue('A1', "No");
$excel->setActiveSheetIndex(0)->setCellValue('B1', "MAK Transport");
$excel->setActiveSheetIndex(0)->setCellValue('C1', "MAK Honor");
$excel->setActiveSheetIndex(0)->setCellValue('D1', "No. Bukti Transport");
$excel->setActiveSheetIndex(0)->setCellValue('E1', "No. Bukti Honor");
$excel->setActiveSheetIndex(0)->setCellValue('F1', "NO. SPPD");
$excel->setActiveSheetIndex(0)->setCellValue('G1', "Tgl. SPPD");
$excel->setActiveSheetIndex(0)->setCellValue('H1', "Kegiatan");
$excel->setActiveSheetIndex(0)->setCellValue('I1', "Tgl. Awal");
$excel->setActiveSheetIndex(0)->setCellValue('J1', "Tgl. Akhir");
$excel->setActiveSheetIndex(0)->setCellValue('K1', "Lama");
$excel->setActiveSheetIndex(0)->setCellValue('L1', "No. Urut Tugas");
$excel->setActiveSheetIndex(0)->setCellValue('M1', "Sebagai");
$excel->setActiveSheetIndex(0)->setCellValue('N1', "Nama");
$excel->setActiveSheetIndex(0)->setCellValue('O1', "NIP");
$excel->setActiveSheetIndex(0)->setCellValue('P1', "Gol");
$excel->setActiveSheetIndex(0)->setCellValue('Q1', "Jabatan");
$excel->setActiveSheetIndex(0)->setCellValue('R1', "Unit Kerja");
$excel->setActiveSheetIndex(0)->setCellValue('S1', "Kab/Kota");
$excel->setActiveSheetIndex(0)->setCellValue('T1', "Tujuan");
$excel->setActiveSheetIndex(0)->setCellValue('U1', "Tempat Kegiatan");
$excel->setActiveSheetIndex(0)->setCellValue('V1', "SBM");
$excel->setActiveSheetIndex(0)->setCellValue('W1', "Tiket Pesawat");
$excel->setActiveSheetIndex(0)->setCellValue('X1', "Tiket Kapal");
$excel->setActiveSheetIndex(0)->setCellValue('Y1', "Tiket");
$excel->setActiveSheetIndex(0)->setCellValue('Z1', "Transport Lokal");
$excel->setActiveSheetIndex(0)->setCellValue('AA1', "Transport Lokal");
$excel->setActiveSheetIndex(0)->setCellValue('AB1', "Taksi/Grab/Gojek");
$excel->setActiveSheetIndex(0)->setCellValue('AC1', "Toll");
$excel->setActiveSheetIndex(0)->setCellValue('AD1', "BBM");
$excel->setActiveSheetIndex(0)->setCellValue('AE1', "Daftar Pengeluaran Riil");
$excel->setActiveSheetIndex(0)->setCellValue('AF1', "Uang Penginapan");
$excel->setActiveSheetIndex(0)->setCellValue('AG1', "Jml Transport");
$excel->setActiveSheetIndex(0)->setCellValue('AH1', "Uang Harian");
$excel->setActiveSheetIndex(0)->setCellValue('AI1', "Jml Perjadin");
$excel->setActiveSheetIndex(0)->setCellValue('AJ1', "Jam");
$excel->setActiveSheetIndex(0)->setCellValue('AK1', "Per Jam");
$excel->setActiveSheetIndex(0)->setCellValue('AL1', "Honor");
$excel->setActiveSheetIndex(0)->setCellValue('AM1', "PPH15");
$excel->setActiveSheetIndex(0)->setCellValue('AN1', "Jml Honor");
$excel->setActiveSheetIndex(0)->setCellValue('AO1', "Diterimakan");


$excel->getActiveSheet()->getStyle('A1')->applyFromArray($style_col);
$excel->getActiveSheet()->getStyle('B1')->applyFromArray($style_col);
$excel->getActiveSheet()->getStyle('C1')->applyFromArray($style_col);
$excel->getActiveSheet()->getStyle('D1')->applyFromArray($style_col);
$excel->getActiveSheet()->getStyle('D1')->applyFromArray($style_col);
$excel->getActiveSheet()->getStyle('F1')->applyFromArray($style_col);
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
$excel->getActiveSheet()->getStyle('O1')->applyFromArray($style_col);
$excel->getActiveSheet()->getStyle('P1')->applyFromArray($style_col);
$excel->getActiveSheet()->getStyle('Q1')->applyFromArray($style_col);
$excel->getActiveSheet()->getStyle('R1')->applyFromArray($style_col);
$excel->getActiveSheet()->getStyle('S1')->applyFromArray($style_col);
$excel->getActiveSheet()->getStyle('T1')->applyFromArray($style_col);
$excel->getActiveSheet()->getStyle('U1')->applyFromArray($style_col);
$excel->getActiveSheet()->getStyle('V1')->applyFromArray($style_col);
$excel->getActiveSheet()->getStyle('W1')->applyFromArray($style_col);
$excel->getActiveSheet()->getStyle('X1')->applyFromArray($style_col);
$excel->getActiveSheet()->getStyle('Y1')->applyFromArray($style_col);
$excel->getActiveSheet()->getStyle('Z1')->applyFromArray($style_col);
$excel->getActiveSheet()->getStyle('AA1')->applyFromArray($style_col);
$excel->getActiveSheet()->getStyle('AB1')->applyFromArray($style_col);
$excel->getActiveSheet()->getStyle('AC1')->applyFromArray($style_col);
$excel->getActiveSheet()->getStyle('AD1')->applyFromArray($style_col);
$excel->getActiveSheet()->getStyle('AE1')->applyFromArray($style_col);
$excel->getActiveSheet()->getStyle('AF1')->applyFromArray($style_col);
$excel->getActiveSheet()->getStyle('AG1')->applyFromArray($style_col);
$excel->getActiveSheet()->getStyle('AH1')->applyFromArray($style_col);
$excel->getActiveSheet()->getStyle('AI1')->applyFromArray($style_col);
$excel->getActiveSheet()->getStyle('AJ1')->applyFromArray($style_col);
$excel->getActiveSheet()->getStyle('AK1')->applyFromArray($style_col);
$excel->getActiveSheet()->getStyle('AL1')->applyFromArray($style_col);
$excel->getActiveSheet()->getStyle('AM1')->applyFromArray($style_col);
$excel->getActiveSheet()->getStyle('AN1')->applyFromArray($style_col);
$excel->getActiveSheet()->getStyle('AO1')->applyFromArray($style_col);

$excel->getActiveSheet()->getStyle('A1:AO1')->applyFromArray($styleWarp);

$excel->getActiveSheet()->getRowDimension('1')->setRowHeight(50);

$excel->getActiveSheet()->getColumnDimension('A')->setWidth(5);
$excel->getActiveSheet()->getColumnDimension('B')->setWidth(10);
$excel->getActiveSheet()->getColumnDimension('C')->setWidth(10);
$excel->getActiveSheet()->getColumnDimension('D')->setWidth(10);
$excel->getActiveSheet()->getColumnDimension('E')->setWidth(10);
$excel->getActiveSheet()->getColumnDimension('F')->setWidth(25);
$excel->getActiveSheet()->getColumnDimension('G')->setWidth(12);
$excel->getActiveSheet()->getColumnDimension('H')->setWidth(60);
$excel->getActiveSheet()->getColumnDimension('I')->setWidth(12);
$excel->getActiveSheet()->getColumnDimension('J')->setWidth(12);
$excel->getActiveSheet()->getColumnDimension('K')->setWidth(6);
$excel->getActiveSheet()->getColumnDimension('L')->setWidth(10);
$excel->getActiveSheet()->getColumnDimension('M')->setWidth(17);
$excel->getActiveSheet()->getColumnDimension('N')->setWidth(50);
$excel->getActiveSheet()->getColumnDimension('O')->setWidth(20);
$excel->getActiveSheet()->getColumnDimension('P')->setWidth(5);
$excel->getActiveSheet()->getColumnDimension('Q')->setWidth(35);
$excel->getActiveSheet()->getColumnDimension('R')->setWidth(35);
$excel->getActiveSheet()->getColumnDimension('S')->setWidth(16);
$excel->getActiveSheet()->getColumnDimension('T')->setWidth(16);
$excel->getActiveSheet()->getColumnDimension('U')->setWidth(35);
$excel->getActiveSheet()->getColumnDimension('V')->setWidth(11);
$excel->getActiveSheet()->getColumnDimension('W')->setWidth(11);
$excel->getActiveSheet()->getColumnDimension('X')->setWidth(11);
$excel->getActiveSheet()->getColumnDimension('Y')->setWidth(11);
$excel->getActiveSheet()->getColumnDimension('Z')->setWidth(11);
$excel->getActiveSheet()->getColumnDimension('AA')->setWidth(11);
$excel->getActiveSheet()->getColumnDimension('AB')->setWidth(11);
$excel->getActiveSheet()->getColumnDimension('AC')->setWidth(11);
$excel->getActiveSheet()->getColumnDimension('AD')->setWidth(11);
$excel->getActiveSheet()->getColumnDimension('AE')->setWidth(11);
$excel->getActiveSheet()->getColumnDimension('AF')->setWidth(11);
$excel->getActiveSheet()->getColumnDimension('AG')->setWidth(11);
$excel->getActiveSheet()->getColumnDimension('AH')->setWidth(11);
$excel->getActiveSheet()->getColumnDimension('AI')->setWidth(11);
$excel->getActiveSheet()->getColumnDimension('AJ')->setWidth(11);
$excel->getActiveSheet()->getColumnDimension('AK')->setWidth(11);
$excel->getActiveSheet()->getColumnDimension('AL')->setWidth(11);
$excel->getActiveSheet()->getColumnDimension('AM')->setWidth(11);
$excel->getActiveSheet()->getColumnDimension('AN')->setWidth(11);
$excel->getActiveSheet()->getColumnDimension('AO')->setWidth(11);


$allTotalPengarah = 0;
$allTotalNarsum = 0;
$allTotalPanitia = 0;
$allTotalPeserta = 0;

$noUrutTugasPengarah = 1;
$noUrutTransport = $viewPerjadin['no_bukti_transport'];
$noUrutHonor = $viewPerjadin['no_bukti_honor'];
$numrow = 2;
//pengarah
$sqlPengarah = mysqli_query($myConnection, "select tb_pengarah_keg_hotel.* , tb_kabkota.name as nama_kab
from tb_pengarah_keg_hotel
left join tb_kabkota on tb_kabkota.id = tb_pengarah_keg_hotel.id_kabkota_unit_kerja
where tb_pengarah_keg_hotel.id_keg = '$id_keg' ");
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
    if ($totalTransportPengarah > $sbmPengarah) {
        $transportPengarah = $sbmPengarah;
        $class = 'fw-bold text-danger';
        $titleTransport = 'Total Transport Riil : ' . format_angka($totalTransportPengarah);
    } else {
        $transportPengarah = $totalTransportPengarah;
        $class = '';
        $titleTransport = '';
    }
    $TotalPengarah = $transportPengarah + $uangHonorPengarahPotongan;
    $excel->setActiveSheetIndex(0)->setCellValue('A' . $numrow, $noUrutTugasPengarah);
    $excel->setActiveSheetIndex(0)->setCellValue('B' . $numrow, $viewPerjadin['mak_tp_pengarah']);
    $excel->setActiveSheetIndex(0)->setCellValue('C' . $numrow, $viewPerjadin['mak_hr_pengarah']);
    $excel->setActiveSheetIndex(0)->setCellValue('D' . $numrow, $noUrutTransport);
    $excel->setActiveSheetIndex(0)->setCellValue('E' . $numrow, $noUrutHonor);
    $excel->setActiveSheetIndex(0)->setCellValue('F' . $numrow, $viewPerjadin['no_sptjb_perjadin'] . '' . $viewPerjadin['sptjb_perjadin']);
    $excel->setActiveSheetIndex(0)->setCellValue('G' . $numrow, Indonesia2Tgl($viewPerjadin['tgl_sptjb_perjadin']));
    $excel->setActiveSheetIndex(0)->setCellValue('H' . $numrow, $viewPerjadin['nama_keg_kuitansi']);
    $excel->setActiveSheetIndex(0)->setCellValue('I' . $numrow, Indonesia2Tgl($viewPerjadin['tgl_mulai']));
    $excel->setActiveSheetIndex(0)->setCellValue('J' . $numrow, Indonesia2Tgl($viewPerjadin['tgl_selesai']));
    $excel->setActiveSheetIndex(0)->setCellValue('K' . $numrow, $jmlHariPengarah . ' Hari');
    $excel->setActiveSheetIndex(0)->setCellValue('L' . $numrow, $noUrutTugasPengarah);
    $excel->setActiveSheetIndex(0)->setCellValue('M' . $numrow, 'Pengarah');
    $excel->setActiveSheetIndex(0)->setCellValue('N' . $numrow, $viewPengarah['nama']);
    $excel->setActiveSheetIndex(0)->setCellValueExplicit('O' . $numrow, $viewPengarah['nip'], PHPExcel_Cell_DataType::TYPE_STRING);
    $excel->setActiveSheetIndex(0)->setCellValue('P' . $numrow, $pajakPengarah['gol']);
    $excel->setActiveSheetIndex(0)->setCellValue('Q' . $numrow, $viewPengarah['jabatan']);
    $excel->setActiveSheetIndex(0)->setCellValue('R' . $numrow, $viewPengarah['unit_kerja']);
    $excel->setActiveSheetIndex(0)->setCellValue('S' . $numrow, $viewPengarah['kabkota_unit_kerja']);
    $excel->setActiveSheetIndex(0)->setCellValue('T' . $numrow, str_replace('Kabupaten', 'Kab.', ucwords($viewPerjadin['nama_kab'])));
    $excel->setActiveSheetIndex(0)->setCellValue('U' . $numrow, $viewPerjadin['tempat_keg']);
    $excel->setActiveSheetIndex(0)->setCellValue('V' . $numrow, $sbmPengarah);
    $excel->setActiveSheetIndex(0)->setCellValue('W' . $numrow, $viewPengarah['tiket_pesawat']);
    $excel->setActiveSheetIndex(0)->setCellValue('X' . $numrow, $viewPengarah['tiket_kapal']);
    $excel->setActiveSheetIndex(0)->setCellValue('Y' . $numrow, $viewPengarah['tiket']);
    $excel->setActiveSheetIndex(0)->setCellValue('Z' . $numrow, $viewPengarah['lokal']);
    $excel->setActiveSheetIndex(0)->setCellValue('AA' . $numrow, $viewPengarah['lokal_jakarta']);
    $excel->setActiveSheetIndex(0)->setCellValue('AB' . $numrow, $viewPengarah['taksi']);
    $excel->setActiveSheetIndex(0)->setCellValue('AC' . $numrow, $viewPengarah['toll']);
    $excel->setActiveSheetIndex(0)->setCellValue('AD' . $numrow, $viewPengarah['bbm']);
    $excel->setActiveSheetIndex(0)->setCellValue('AE' . $numrow, $viewPengarah['dpr1']);
    $excel->setActiveSheetIndex(0)->setCellValue('AF' . $numrow, $viewPengarah['penginapan']);
    $excel->setActiveSheetIndex(0)->setCellValue('AG' . $numrow, $transportPengarah);
    $excel->setActiveSheetIndex(0)->setCellValue('AH' . $numrow, '');
    $excel->setActiveSheetIndex(0)->setCellValue('AI' . $numrow, $transportPengarah);
    $excel->setActiveSheetIndex(0)->setCellValue('AJ' . $numrow, $jamPengarah);
    $excel->setActiveSheetIndex(0)->setCellValue('AK' . $numrow, $honorPerJamPengarah);
    $excel->setActiveSheetIndex(0)->setCellValue('AL' . $numrow, $uangHonorPengarah);
    $excel->setActiveSheetIndex(0)->setCellValue('AM' . $numrow, $potonganHonorPengarah);
    $excel->setActiveSheetIndex(0)->setCellValue('AN' . $numrow, $uangHonorPengarahPotongan);
    $excel->setActiveSheetIndex(0)->setCellValue('AO' . $numrow, $TotalPengarah);



    $excel->getActiveSheet()->getStyle('A' . $numrow)->applyFromArray($style_row_pengarah);
    $excel->getActiveSheet()->getStyle('B' . $numrow)->applyFromArray($style_row_pengarah);
    $excel->getActiveSheet()->getStyle('C' . $numrow)->applyFromArray($style_row_pengarah);
    $excel->getActiveSheet()->getStyle('D' . $numrow)->applyFromArray($style_row_pengarah);
    $excel->getActiveSheet()->getStyle('E' . $numrow)->applyFromArray($style_row_pengarah);
    $excel->getActiveSheet()->getStyle('F' . $numrow)->applyFromArray($style_row_pengarah);
    $excel->getActiveSheet()->getStyle('G' . $numrow)->applyFromArray($style_row_pengarah);
    $excel->getActiveSheet()->getStyle('H' . $numrow)->applyFromArray($style_row_pengarah);
    $excel->getActiveSheet()->getStyle('I' . $numrow)->applyFromArray($style_row_pengarah);
    $excel->getActiveSheet()->getStyle('J' . $numrow)->applyFromArray($style_row_pengarah);
    $excel->getActiveSheet()->getStyle('K' . $numrow)->applyFromArray($style_row_pengarah);
    $excel->getActiveSheet()->getStyle('L' . $numrow)->applyFromArray($style_row_pengarah);
    $excel->getActiveSheet()->getStyle('M' . $numrow)->applyFromArray($style_row_pengarah);
    $excel->getActiveSheet()->getStyle('N' . $numrow)->applyFromArray($style_row_pengarah);
    $excel->getActiveSheet()->getStyle('O' . $numrow)->applyFromArray($style_row_pengarah);
    $excel->getActiveSheet()->getStyle('P' . $numrow)->applyFromArray($style_row_pengarah);
    $excel->getActiveSheet()->getStyle('Q' . $numrow)->applyFromArray($style_row_pengarah);
    $excel->getActiveSheet()->getStyle('R' . $numrow)->applyFromArray($style_row_pengarah);
    $excel->getActiveSheet()->getStyle('S' . $numrow)->applyFromArray($style_row_pengarah);
    $excel->getActiveSheet()->getStyle('T' . $numrow)->applyFromArray($style_row_pengarah);
    $excel->getActiveSheet()->getStyle('U' . $numrow)->applyFromArray($style_row_pengarah);
    $excel->getActiveSheet()->getStyle('V' . $numrow)->applyFromArray($style_row_pengarah);
    $excel->getActiveSheet()->getStyle('W' . $numrow)->applyFromArray($style_row_pengarah);
    $excel->getActiveSheet()->getStyle('X' . $numrow)->applyFromArray($style_row_pengarah);
    $excel->getActiveSheet()->getStyle('Y' . $numrow)->applyFromArray($style_row_pengarah);
    $excel->getActiveSheet()->getStyle('Z' . $numrow)->applyFromArray($style_row_pengarah);
    $excel->getActiveSheet()->getStyle('AA' . $numrow)->applyFromArray($style_row_pengarah);
    $excel->getActiveSheet()->getStyle('AB' . $numrow)->applyFromArray($style_row_pengarah);
    $excel->getActiveSheet()->getStyle('AC' . $numrow)->applyFromArray($style_row_pengarah);
    $excel->getActiveSheet()->getStyle('AD' . $numrow)->applyFromArray($style_row_pengarah);
    $excel->getActiveSheet()->getStyle('AE' . $numrow)->applyFromArray($style_row_pengarah);
    $excel->getActiveSheet()->getStyle('AF' . $numrow)->applyFromArray($style_row_pengarah);
    $excel->getActiveSheet()->getStyle('AG' . $numrow)->applyFromArray($style_row_pengarah);
    $excel->getActiveSheet()->getStyle('AH' . $numrow)->applyFromArray($style_row_pengarah);
    $excel->getActiveSheet()->getStyle('AI' . $numrow)->applyFromArray($style_row_pengarah);
    $excel->getActiveSheet()->getStyle('AJ' . $numrow)->applyFromArray($style_row_pengarah);
    $excel->getActiveSheet()->getStyle('AK' . $numrow)->applyFromArray($style_row_pengarah);
    $excel->getActiveSheet()->getStyle('AL' . $numrow)->applyFromArray($style_row_pengarah);
    $excel->getActiveSheet()->getStyle('AM' . $numrow)->applyFromArray($style_row_pengarah);
    $excel->getActiveSheet()->getStyle('AN' . $numrow)->applyFromArray($style_row_pengarah);
    $excel->getActiveSheet()->getStyle('AO' . $numrow)->applyFromArray($style_row_pengarah);

    $excel->getActiveSheet()->getStyle('V' . $numrow)->getNumberFormat()->setFormatCode("#,##0");
    $excel->getActiveSheet()->getStyle('W' . $numrow)->getNumberFormat()->setFormatCode("#,##0");
    $excel->getActiveSheet()->getStyle('X' . $numrow)->getNumberFormat()->setFormatCode("#,##0");
    $excel->getActiveSheet()->getStyle('Y' . $numrow)->getNumberFormat()->setFormatCode("#,##0");
    $excel->getActiveSheet()->getStyle('Z' . $numrow)->getNumberFormat()->setFormatCode("#,##0");
    $excel->getActiveSheet()->getStyle('AA' . $numrow)->getNumberFormat()->setFormatCode("#,##0");
    $excel->getActiveSheet()->getStyle('AB' . $numrow)->getNumberFormat()->setFormatCode("#,##0");
    $excel->getActiveSheet()->getStyle('AC' . $numrow)->getNumberFormat()->setFormatCode("#,##0");
    $excel->getActiveSheet()->getStyle('AD' . $numrow)->getNumberFormat()->setFormatCode("#,##0");
    $excel->getActiveSheet()->getStyle('AE' . $numrow)->getNumberFormat()->setFormatCode("#,##0");
    $excel->getActiveSheet()->getStyle('AF' . $numrow)->getNumberFormat()->setFormatCode("#,##0");
    $excel->getActiveSheet()->getStyle('AG' . $numrow)->getNumberFormat()->setFormatCode("#,##0");
    $excel->getActiveSheet()->getStyle('AH' . $numrow)->getNumberFormat()->setFormatCode("#,##0");
    $excel->getActiveSheet()->getStyle('AI' . $numrow)->getNumberFormat()->setFormatCode("#,##0");
    $excel->getActiveSheet()->getStyle('AJ' . $numrow)->getNumberFormat()->setFormatCode("#,##0");
    $excel->getActiveSheet()->getStyle('AK' . $numrow)->getNumberFormat()->setFormatCode("#,##0");
    $excel->getActiveSheet()->getStyle('AL' . $numrow)->getNumberFormat()->setFormatCode("#,##0");
    $excel->getActiveSheet()->getStyle('AM' . $numrow)->getNumberFormat()->setFormatCode("#,##0");
    $excel->getActiveSheet()->getStyle('AN' . $numrow)->getNumberFormat()->setFormatCode("#,##0");
    $excel->getActiveSheet()->getStyle('AO' . $numrow)->getNumberFormat()->setFormatCode("#,##0");

    $excel->getActiveSheet()->getStyle('A' . $numrow . ':AO' . $numrow)->getFont()->setSize(10);

    $excel->getActiveSheet()->getRowDimension($numrow)->setRowHeight(15);
    $noUrutTugasPengarah++;
    $noUrutHonor++;
    $noUrutTransport++;
    $numrow++;

    $allTotalPengarah = $allTotalPengarah + $TotalPengarah;
}
//pengarah

//narsum
$noUrutTugasNarsum = 1;
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

    $excel->setActiveSheetIndex(0)->setCellValue('A' . $numrow, $noUrutTugasNarsum);
    $excel->setActiveSheetIndex(0)->setCellValue('B' . $numrow, $makTranportNarsum);
    $excel->setActiveSheetIndex(0)->setCellValue('C' . $numrow, $makHonorNarsum);
    $excel->setActiveSheetIndex(0)->setCellValue('D' . $numrow, $noUrutTransport);
    $excel->setActiveSheetIndex(0)->setCellValue('E' . $numrow, $noUrutHonor);
    $excel->setActiveSheetIndex(0)->setCellValue('F' . $numrow, $viewPerjadin['no_sptjb_perjadin'] . '' . $viewPerjadin['sptjb_perjadin']);
    $excel->setActiveSheetIndex(0)->setCellValue('G' . $numrow, Indonesia2Tgl($viewPerjadin['tgl_sptjb_perjadin']));
    $excel->setActiveSheetIndex(0)->setCellValue('H' . $numrow, $viewPerjadin['nama_keg_kuitansi']);
    $excel->setActiveSheetIndex(0)->setCellValue('I' . $numrow, Indonesia2Tgl($viewPerjadin['tgl_mulai']));
    $excel->setActiveSheetIndex(0)->setCellValue('J' . $numrow, Indonesia2Tgl($viewPerjadin['tgl_selesai']));
    $excel->setActiveSheetIndex(0)->setCellValue('K' . $numrow, $jmlHariNarsum . ' Hari');
    $excel->setActiveSheetIndex(0)->setCellValue('L' . $numrow, $noUrutTugasNarsum);
    $excel->setActiveSheetIndex(0)->setCellValue('M' . $numrow, 'Narasumber');
    $excel->setActiveSheetIndex(0)->setCellValue('N' . $numrow, $viewNarsum['nama']);
    $excel->setActiveSheetIndex(0)->setCellValueExplicit('O' . $numrow, $viewNarsum['nip'], PHPExcel_Cell_DataType::TYPE_STRING);
    $excel->setActiveSheetIndex(0)->setCellValue('P' . $numrow, $pajakNarsum['gol']);
    $excel->setActiveSheetIndex(0)->setCellValue('Q' . $numrow, $viewNarsum['jabatan']);
    $excel->setActiveSheetIndex(0)->setCellValue('R' . $numrow, $viewNarsum['unit_kerja']);
    $excel->setActiveSheetIndex(0)->setCellValue('S' . $numrow, $viewNarsum['kabkota_unit_kerja']);
    $excel->setActiveSheetIndex(0)->setCellValue('T' . $numrow, str_replace('Kabupaten', 'Kab.', ucwords($viewPerjadin['nama_kab'])));
    $excel->setActiveSheetIndex(0)->setCellValue('U' . $numrow, $viewPerjadin['tempat_keg']);
    $excel->setActiveSheetIndex(0)->setCellValue('V' . $numrow, $sbmNarsum);
    $excel->setActiveSheetIndex(0)->setCellValue('W' . $numrow, $viewNarsum['tiket_pesawat']);
    $excel->setActiveSheetIndex(0)->setCellValue('X' . $numrow, $viewNarsum['tiket_kapal']);
    $excel->setActiveSheetIndex(0)->setCellValue('Y' . $numrow, $viewNarsum['tiket']);
    $excel->setActiveSheetIndex(0)->setCellValue('Z' . $numrow, $viewNarsum['lokal']);
    $excel->setActiveSheetIndex(0)->setCellValue('AA' . $numrow, $viewNarsum['lokal_jakarta']);
    $excel->setActiveSheetIndex(0)->setCellValue('AB' . $numrow, $viewNarsum['taksi']);
    $excel->setActiveSheetIndex(0)->setCellValue('AC' . $numrow, $viewNarsum['toll']);
    $excel->setActiveSheetIndex(0)->setCellValue('AD' . $numrow, $viewNarsum['bbm']);
    $excel->setActiveSheetIndex(0)->setCellValue('AE' . $numrow, $viewNarsum['dpr1']);
    $excel->setActiveSheetIndex(0)->setCellValue('AF' . $numrow, $viewNarsum['penginapan']);
    $excel->setActiveSheetIndex(0)->setCellValue('AG' . $numrow, $transportNarsum);
    $excel->setActiveSheetIndex(0)->setCellValue('AH' . $numrow, $uangHarianNarsum);
    $excel->setActiveSheetIndex(0)->setCellValue('AI' . $numrow, $jmlPerjadinNarsum);
    $excel->setActiveSheetIndex(0)->setCellValue('AJ' . $numrow, $jamNarsum);
    $excel->setActiveSheetIndex(0)->setCellValue('AK' . $numrow, $honorPerJamNarsum);
    $excel->setActiveSheetIndex(0)->setCellValue('AL' . $numrow, $uangHonorNarsum);
    $excel->setActiveSheetIndex(0)->setCellValue('AM' . $numrow, $potonganHonorNarsum);
    $excel->setActiveSheetIndex(0)->setCellValue('AN' . $numrow, $uangHonorNarsumPotongan);
    $excel->setActiveSheetIndex(0)->setCellValue('AO' . $numrow, $TotalNarsum);


    $excel->getActiveSheet()->getStyle('A' . $numrow)->applyFromArray($style_row_narsum);
    $excel->getActiveSheet()->getStyle('B' . $numrow)->applyFromArray($style_row_narsum);
    $excel->getActiveSheet()->getStyle('C' . $numrow)->applyFromArray($style_row_narsum);
    $excel->getActiveSheet()->getStyle('D' . $numrow)->applyFromArray($style_row_narsum);
    $excel->getActiveSheet()->getStyle('E' . $numrow)->applyFromArray($style_row_narsum);
    $excel->getActiveSheet()->getStyle('F' . $numrow)->applyFromArray($style_row_narsum);
    $excel->getActiveSheet()->getStyle('G' . $numrow)->applyFromArray($style_row_narsum);
    $excel->getActiveSheet()->getStyle('H' . $numrow)->applyFromArray($style_row_narsum);
    $excel->getActiveSheet()->getStyle('I' . $numrow)->applyFromArray($style_row_narsum);
    $excel->getActiveSheet()->getStyle('J' . $numrow)->applyFromArray($style_row_narsum);
    $excel->getActiveSheet()->getStyle('K' . $numrow)->applyFromArray($style_row_narsum);
    $excel->getActiveSheet()->getStyle('L' . $numrow)->applyFromArray($style_row_narsum);
    $excel->getActiveSheet()->getStyle('M' . $numrow)->applyFromArray($style_row_narsum);
    $excel->getActiveSheet()->getStyle('N' . $numrow)->applyFromArray($style_row_narsum);
    $excel->getActiveSheet()->getStyle('O' . $numrow)->applyFromArray($style_row_narsum);
    $excel->getActiveSheet()->getStyle('P' . $numrow)->applyFromArray($style_row_narsum);
    $excel->getActiveSheet()->getStyle('Q' . $numrow)->applyFromArray($style_row_narsum);
    $excel->getActiveSheet()->getStyle('R' . $numrow)->applyFromArray($style_row_narsum);
    $excel->getActiveSheet()->getStyle('S' . $numrow)->applyFromArray($style_row_narsum);
    $excel->getActiveSheet()->getStyle('T' . $numrow)->applyFromArray($style_row_narsum);
    $excel->getActiveSheet()->getStyle('U' . $numrow)->applyFromArray($style_row_narsum);
    $excel->getActiveSheet()->getStyle('V' . $numrow)->applyFromArray($style_row_narsum);
    $excel->getActiveSheet()->getStyle('W' . $numrow)->applyFromArray($style_row_narsum);
    $excel->getActiveSheet()->getStyle('X' . $numrow)->applyFromArray($style_row_narsum);
    $excel->getActiveSheet()->getStyle('Y' . $numrow)->applyFromArray($style_row_narsum);
    $excel->getActiveSheet()->getStyle('Z' . $numrow)->applyFromArray($style_row_narsum);
    $excel->getActiveSheet()->getStyle('AA' . $numrow)->applyFromArray($style_row_narsum);
    $excel->getActiveSheet()->getStyle('AB' . $numrow)->applyFromArray($style_row_narsum);
    $excel->getActiveSheet()->getStyle('AC' . $numrow)->applyFromArray($style_row_narsum);
    $excel->getActiveSheet()->getStyle('AD' . $numrow)->applyFromArray($style_row_narsum);
    $excel->getActiveSheet()->getStyle('AE' . $numrow)->applyFromArray($style_row_narsum);
    $excel->getActiveSheet()->getStyle('AF' . $numrow)->applyFromArray($style_row_narsum);
    $excel->getActiveSheet()->getStyle('AG' . $numrow)->applyFromArray($style_row_narsum);
    $excel->getActiveSheet()->getStyle('AH' . $numrow)->applyFromArray($style_row_narsum);
    $excel->getActiveSheet()->getStyle('AI' . $numrow)->applyFromArray($style_row_narsum);
    $excel->getActiveSheet()->getStyle('AJ' . $numrow)->applyFromArray($style_row_narsum);
    $excel->getActiveSheet()->getStyle('AK' . $numrow)->applyFromArray($style_row_narsum);
    $excel->getActiveSheet()->getStyle('AL' . $numrow)->applyFromArray($style_row_narsum);
    $excel->getActiveSheet()->getStyle('AM' . $numrow)->applyFromArray($style_row_narsum);
    $excel->getActiveSheet()->getStyle('AN' . $numrow)->applyFromArray($style_row_narsum);
    $excel->getActiveSheet()->getStyle('AO' . $numrow)->applyFromArray($style_row_narsum);

    $excel->getActiveSheet()->getStyle('V' . $numrow)->getNumberFormat()->setFormatCode("#,##0");
    $excel->getActiveSheet()->getStyle('W' . $numrow)->getNumberFormat()->setFormatCode("#,##0");
    $excel->getActiveSheet()->getStyle('X' . $numrow)->getNumberFormat()->setFormatCode("#,##0");
    $excel->getActiveSheet()->getStyle('Y' . $numrow)->getNumberFormat()->setFormatCode("#,##0");
    $excel->getActiveSheet()->getStyle('Z' . $numrow)->getNumberFormat()->setFormatCode("#,##0");
    $excel->getActiveSheet()->getStyle('AA' . $numrow)->getNumberFormat()->setFormatCode("#,##0");
    $excel->getActiveSheet()->getStyle('AB' . $numrow)->getNumberFormat()->setFormatCode("#,##0");
    $excel->getActiveSheet()->getStyle('AC' . $numrow)->getNumberFormat()->setFormatCode("#,##0");
    $excel->getActiveSheet()->getStyle('AD' . $numrow)->getNumberFormat()->setFormatCode("#,##0");
    $excel->getActiveSheet()->getStyle('AE' . $numrow)->getNumberFormat()->setFormatCode("#,##0");
    $excel->getActiveSheet()->getStyle('AF' . $numrow)->getNumberFormat()->setFormatCode("#,##0");
    $excel->getActiveSheet()->getStyle('AG' . $numrow)->getNumberFormat()->setFormatCode("#,##0");
    $excel->getActiveSheet()->getStyle('AH' . $numrow)->getNumberFormat()->setFormatCode("#,##0");
    $excel->getActiveSheet()->getStyle('AI' . $numrow)->getNumberFormat()->setFormatCode("#,##0");
    $excel->getActiveSheet()->getStyle('AJ' . $numrow)->getNumberFormat()->setFormatCode("#,##0");
    $excel->getActiveSheet()->getStyle('AK' . $numrow)->getNumberFormat()->setFormatCode("#,##0");
    $excel->getActiveSheet()->getStyle('AL' . $numrow)->getNumberFormat()->setFormatCode("#,##0");
    $excel->getActiveSheet()->getStyle('AM' . $numrow)->getNumberFormat()->setFormatCode("#,##0");
    $excel->getActiveSheet()->getStyle('AN' . $numrow)->getNumberFormat()->setFormatCode("#,##0");
    $excel->getActiveSheet()->getStyle('AO' . $numrow)->getNumberFormat()->setFormatCode("#,##0");

    $excel->getActiveSheet()->getStyle('A' . $numrow . ':AO' . $numrow)->getFont()->setSize(10);

    $excel->getActiveSheet()->getRowDimension($numrow)->setRowHeight(15);
    $noUrutTugasNarsum++;
    $noUrutHonor++;
    $noUrutTransport++;
    $numrow++;

    $allTotalNarsum = $allTotalNarsum + $TotalNarsum;
}
//narsum

//panitia
$noUrutTugasPanitia = 1;
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
    $excel->setActiveSheetIndex(0)->setCellValue('A' . $numrow, $noUrutTugasPanitia);
    $excel->setActiveSheetIndex(0)->setCellValue('B' . $numrow, $viewPerjadin['mak_tp_panitia']);
    $excel->setActiveSheetIndex(0)->setCellValue('C' . $numrow, $viewPerjadin['mak_hr_panitia']);
    $excel->setActiveSheetIndex(0)->setCellValue('D' . $numrow, $noUrutTransport);
    $excel->setActiveSheetIndex(0)->setCellValue('E' . $numrow, $noUrutHonor);
    $excel->setActiveSheetIndex(0)->setCellValue('F' . $numrow, $viewPerjadin['no_sptjb_perjadin'] . '' . $viewPerjadin['sptjb_perjadin']);
    $excel->setActiveSheetIndex(0)->setCellValue('G' . $numrow, Indonesia2Tgl($viewPerjadin['tgl_sptjb_perjadin']));
    $excel->setActiveSheetIndex(0)->setCellValue('H' . $numrow, $viewPerjadin['nama_keg_kuitansi']);
    $excel->setActiveSheetIndex(0)->setCellValue('I' . $numrow, Indonesia2Tgl($viewPerjadin['tgl_mulai']));
    $excel->setActiveSheetIndex(0)->setCellValue('J' . $numrow, Indonesia2Tgl($viewPerjadin['tgl_selesai']));
    $excel->setActiveSheetIndex(0)->setCellValue('K' . $numrow, $jmlHariPanitia . ' Hari');
    $excel->setActiveSheetIndex(0)->setCellValue('L' . $numrow, $noUrutTugasPanitia);
    $excel->setActiveSheetIndex(0)->setCellValue('M' . $numrow, 'Panitia');
    $excel->setActiveSheetIndex(0)->setCellValue('N' . $numrow, $viewPanitia['nama']);
    $excel->setActiveSheetIndex(0)->setCellValueExplicit('O' . $numrow, $viewPanitia['nip'], PHPExcel_Cell_DataType::TYPE_STRING);
    $excel->setActiveSheetIndex(0)->setCellValue('P' . $numrow, $pajakPanitia['gol']);
    $excel->setActiveSheetIndex(0)->setCellValue('Q' . $numrow, $viewPanitia['jabatan']);
    $excel->setActiveSheetIndex(0)->setCellValue('R' . $numrow, $viewPanitia['unit_kerja']);
    $excel->setActiveSheetIndex(0)->setCellValue('S' . $numrow, $viewPanitia['kabkota_unit_kerja']);
    $excel->setActiveSheetIndex(0)->setCellValue('T' . $numrow, str_replace('Kabupaten', 'Kab.', ucwords($viewPerjadin['nama_kab'])));
    $excel->setActiveSheetIndex(0)->setCellValue('U' . $numrow, $viewPerjadin['tempat_keg']);
    $excel->setActiveSheetIndex(0)->setCellValue('V' . $numrow, $sbmPanitia);
    $excel->setActiveSheetIndex(0)->setCellValue('W' . $numrow, $viewPanitia['tiket_pesawat']);
    $excel->setActiveSheetIndex(0)->setCellValue('X' . $numrow, $viewPanitia['tiket_kapal']);
    $excel->setActiveSheetIndex(0)->setCellValue('Y' . $numrow, $viewPanitia['tiket']);
    $excel->setActiveSheetIndex(0)->setCellValue('Z' . $numrow, $viewPanitia['lokal']);
    $excel->setActiveSheetIndex(0)->setCellValue('AA' . $numrow, $viewPanitia['lokal_jakarta']);
    $excel->setActiveSheetIndex(0)->setCellValue('AB' . $numrow, $viewPanitia['taksi']);
    $excel->setActiveSheetIndex(0)->setCellValue('AC' . $numrow, $viewPanitia['toll']);
    $excel->setActiveSheetIndex(0)->setCellValue('AD' . $numrow, $viewPanitia['bbm']);
    $excel->setActiveSheetIndex(0)->setCellValue('AE' . $numrow, $viewPanitia['dpr1']);
    $excel->setActiveSheetIndex(0)->setCellValue('AF' . $numrow, $viewPanitia['penginapan']);
    $excel->setActiveSheetIndex(0)->setCellValue('AG' . $numrow, $transportPanitia);
    $excel->setActiveSheetIndex(0)->setCellValue('AH' . $numrow, $uangHarianPanitia);
    $excel->setActiveSheetIndex(0)->setCellValue('AI' . $numrow, $jmlPerjadinPanitia);
    $excel->setActiveSheetIndex(0)->setCellValue('AJ' . $numrow, $jamPanitia);
    $excel->setActiveSheetIndex(0)->setCellValue('AK' . $numrow, $honorPerJamPanitia);
    $excel->setActiveSheetIndex(0)->setCellValue('AL' . $numrow, $uangHonorPanitia);
    $excel->setActiveSheetIndex(0)->setCellValue('AM' . $numrow, $potonganHonorPanitia);
    $excel->setActiveSheetIndex(0)->setCellValue('AN' . $numrow, $uangHonorPanitiaPotongan);
    $excel->setActiveSheetIndex(0)->setCellValue('AO' . $numrow, $TotalPanitia);


    $excel->getActiveSheet()->getStyle('A' . $numrow)->applyFromArray($style_row_panitia);
    $excel->getActiveSheet()->getStyle('B' . $numrow)->applyFromArray($style_row_panitia);
    $excel->getActiveSheet()->getStyle('C' . $numrow)->applyFromArray($style_row_panitia);
    $excel->getActiveSheet()->getStyle('D' . $numrow)->applyFromArray($style_row_panitia);
    $excel->getActiveSheet()->getStyle('E' . $numrow)->applyFromArray($style_row_panitia);
    $excel->getActiveSheet()->getStyle('F' . $numrow)->applyFromArray($style_row_panitia);
    $excel->getActiveSheet()->getStyle('G' . $numrow)->applyFromArray($style_row_panitia);
    $excel->getActiveSheet()->getStyle('H' . $numrow)->applyFromArray($style_row_panitia);
    $excel->getActiveSheet()->getStyle('I' . $numrow)->applyFromArray($style_row_panitia);
    $excel->getActiveSheet()->getStyle('J' . $numrow)->applyFromArray($style_row_panitia);
    $excel->getActiveSheet()->getStyle('K' . $numrow)->applyFromArray($style_row_panitia);
    $excel->getActiveSheet()->getStyle('L' . $numrow)->applyFromArray($style_row_panitia);
    $excel->getActiveSheet()->getStyle('M' . $numrow)->applyFromArray($style_row_panitia);
    $excel->getActiveSheet()->getStyle('N' . $numrow)->applyFromArray($style_row_panitia);
    $excel->getActiveSheet()->getStyle('O' . $numrow)->applyFromArray($style_row_panitia);
    $excel->getActiveSheet()->getStyle('P' . $numrow)->applyFromArray($style_row_panitia);
    $excel->getActiveSheet()->getStyle('Q' . $numrow)->applyFromArray($style_row_panitia);
    $excel->getActiveSheet()->getStyle('R' . $numrow)->applyFromArray($style_row_panitia);
    $excel->getActiveSheet()->getStyle('S' . $numrow)->applyFromArray($style_row_panitia);
    $excel->getActiveSheet()->getStyle('T' . $numrow)->applyFromArray($style_row_panitia);
    $excel->getActiveSheet()->getStyle('U' . $numrow)->applyFromArray($style_row_panitia);
    $excel->getActiveSheet()->getStyle('V' . $numrow)->applyFromArray($style_row_panitia);
    $excel->getActiveSheet()->getStyle('W' . $numrow)->applyFromArray($style_row_panitia);
    $excel->getActiveSheet()->getStyle('X' . $numrow)->applyFromArray($style_row_panitia);
    $excel->getActiveSheet()->getStyle('Y' . $numrow)->applyFromArray($style_row_panitia);
    $excel->getActiveSheet()->getStyle('Z' . $numrow)->applyFromArray($style_row_panitia);
    $excel->getActiveSheet()->getStyle('AA' . $numrow)->applyFromArray($style_row_panitia);
    $excel->getActiveSheet()->getStyle('AB' . $numrow)->applyFromArray($style_row_panitia);
    $excel->getActiveSheet()->getStyle('AC' . $numrow)->applyFromArray($style_row_panitia);
    $excel->getActiveSheet()->getStyle('AD' . $numrow)->applyFromArray($style_row_panitia);
    $excel->getActiveSheet()->getStyle('AE' . $numrow)->applyFromArray($style_row_panitia);
    $excel->getActiveSheet()->getStyle('AF' . $numrow)->applyFromArray($style_row_panitia);
    $excel->getActiveSheet()->getStyle('AG' . $numrow)->applyFromArray($style_row_panitia);
    $excel->getActiveSheet()->getStyle('AH' . $numrow)->applyFromArray($style_row_panitia);
    $excel->getActiveSheet()->getStyle('AI' . $numrow)->applyFromArray($style_row_panitia);
    $excel->getActiveSheet()->getStyle('AJ' . $numrow)->applyFromArray($style_row_panitia);
    $excel->getActiveSheet()->getStyle('AK' . $numrow)->applyFromArray($style_row_panitia);
    $excel->getActiveSheet()->getStyle('AL' . $numrow)->applyFromArray($style_row_panitia);
    $excel->getActiveSheet()->getStyle('AM' . $numrow)->applyFromArray($style_row_panitia);
    $excel->getActiveSheet()->getStyle('AN' . $numrow)->applyFromArray($style_row_panitia);
    $excel->getActiveSheet()->getStyle('AO' . $numrow)->applyFromArray($style_row_panitia);

    $excel->getActiveSheet()->getStyle('V' . $numrow)->getNumberFormat()->setFormatCode("#,##0");
    $excel->getActiveSheet()->getStyle('W' . $numrow)->getNumberFormat()->setFormatCode("#,##0");
    $excel->getActiveSheet()->getStyle('X' . $numrow)->getNumberFormat()->setFormatCode("#,##0");
    $excel->getActiveSheet()->getStyle('Y' . $numrow)->getNumberFormat()->setFormatCode("#,##0");
    $excel->getActiveSheet()->getStyle('Z' . $numrow)->getNumberFormat()->setFormatCode("#,##0");
    $excel->getActiveSheet()->getStyle('AA' . $numrow)->getNumberFormat()->setFormatCode("#,##0");
    $excel->getActiveSheet()->getStyle('AB' . $numrow)->getNumberFormat()->setFormatCode("#,##0");
    $excel->getActiveSheet()->getStyle('AC' . $numrow)->getNumberFormat()->setFormatCode("#,##0");
    $excel->getActiveSheet()->getStyle('AD' . $numrow)->getNumberFormat()->setFormatCode("#,##0");
    $excel->getActiveSheet()->getStyle('AE' . $numrow)->getNumberFormat()->setFormatCode("#,##0");
    $excel->getActiveSheet()->getStyle('AF' . $numrow)->getNumberFormat()->setFormatCode("#,##0");
    $excel->getActiveSheet()->getStyle('AG' . $numrow)->getNumberFormat()->setFormatCode("#,##0");
    $excel->getActiveSheet()->getStyle('AH' . $numrow)->getNumberFormat()->setFormatCode("#,##0");
    $excel->getActiveSheet()->getStyle('AI' . $numrow)->getNumberFormat()->setFormatCode("#,##0");
    $excel->getActiveSheet()->getStyle('AJ' . $numrow)->getNumberFormat()->setFormatCode("#,##0");
    $excel->getActiveSheet()->getStyle('AK' . $numrow)->getNumberFormat()->setFormatCode("#,##0");
    $excel->getActiveSheet()->getStyle('AL' . $numrow)->getNumberFormat()->setFormatCode("#,##0");
    $excel->getActiveSheet()->getStyle('AM' . $numrow)->getNumberFormat()->setFormatCode("#,##0");
    $excel->getActiveSheet()->getStyle('AN' . $numrow)->getNumberFormat()->setFormatCode("#,##0");
    $excel->getActiveSheet()->getStyle('AO' . $numrow)->getNumberFormat()->setFormatCode("#,##0");

    $excel->getActiveSheet()->getStyle('A' . $numrow . ':AO' . $numrow)->getFont()->setSize(10);

    $excel->getActiveSheet()->getRowDimension($numrow)->setRowHeight(15);
    $noUrutTugasPanitia++;
    $noUrutHonor++;
    $noUrutTransport++;
    $numrow++;
    $allTotalPanitia = $allTotalPanitia + $TotalPanitia;
}
//panitia

//peserta
$noUrutTugasPeserta = 1;
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

    $excel->setActiveSheetIndex(0)->setCellValue('A' . $numrow, $noUrutTugasPeserta);
    $excel->setActiveSheetIndex(0)->setCellValue('B' . $numrow, $viewPerjadin['mak_tp_peserta']);
    $excel->setActiveSheetIndex(0)->setCellValue('C' . $numrow, '');
    $excel->setActiveSheetIndex(0)->setCellValue('D' . $numrow, $noUrutTransport);
    $excel->setActiveSheetIndex(0)->setCellValue('E' . $numrow, '');
    $excel->setActiveSheetIndex(0)->setCellValue('F' . $numrow, $viewPerjadin['no_sptjb_perjadin'] . '' . $viewPerjadin['sptjb_perjadin']);
    $excel->setActiveSheetIndex(0)->setCellValue('G' . $numrow, Indonesia2Tgl($viewPerjadin['tgl_sptjb_perjadin']));
    $excel->setActiveSheetIndex(0)->setCellValue('H' . $numrow, $viewPerjadin['nama_keg_kuitansi']);
    $excel->setActiveSheetIndex(0)->setCellValue('I' . $numrow, Indonesia2Tgl($viewPerjadin['tgl_mulai']));
    $excel->setActiveSheetIndex(0)->setCellValue('J' . $numrow, Indonesia2Tgl($viewPerjadin['tgl_selesai']));
    $excel->setActiveSheetIndex(0)->setCellValue('K' . $numrow, $jmlHariPanitia . ' Hari');
    $excel->setActiveSheetIndex(0)->setCellValue('L' . $numrow, $noUrutTugasPeserta);
    $excel->setActiveSheetIndex(0)->setCellValue('M' . $numrow, 'Peserta');
    $excel->setActiveSheetIndex(0)->setCellValue('N' . $numrow, $viewPeserta['nama']);
    $excel->setActiveSheetIndex(0)->setCellValueExplicit('O' . $numrow, $viewPeserta['nip'], PHPExcel_Cell_DataType::TYPE_STRING);
    $excel->setActiveSheetIndex(0)->setCellValue('P' . $numrow, $viewPeserta['gol']);
    $excel->setActiveSheetIndex(0)->setCellValue('Q' . $numrow, $viewPeserta['jabatan']);
    $excel->setActiveSheetIndex(0)->setCellValue('R' . $numrow, $viewPeserta['unit_kerja']);
    $excel->setActiveSheetIndex(0)->setCellValue('S' . $numrow, $viewPeserta['kabkota_unit_kerja']);
    $excel->setActiveSheetIndex(0)->setCellValue('T' . $numrow, str_replace('Kabupaten', 'Kab.', ucwords($viewPerjadin['nama_kab'])));
    $excel->setActiveSheetIndex(0)->setCellValue('U' . $numrow, $viewPerjadin['tempat_keg']);
    $excel->setActiveSheetIndex(0)->setCellValue('V' . $numrow, $sbmPeserta);
    $excel->setActiveSheetIndex(0)->setCellValue('W' . $numrow, $viewPeserta['tiket_pesawat']);
    $excel->setActiveSheetIndex(0)->setCellValue('X' . $numrow, $viewPeserta['tiket_kapal']);
    $excel->setActiveSheetIndex(0)->setCellValue('Y' . $numrow, $viewPeserta['tiket']);
    $excel->setActiveSheetIndex(0)->setCellValue('Z' . $numrow, $viewPeserta['lokal']);
    $excel->setActiveSheetIndex(0)->setCellValue('AA' . $numrow, $viewPeserta['lokal_jakarta']);
    $excel->setActiveSheetIndex(0)->setCellValue('AB' . $numrow, $viewPeserta['taksi']);
    $excel->setActiveSheetIndex(0)->setCellValue('AC' . $numrow, $viewPeserta['toll']);
    $excel->setActiveSheetIndex(0)->setCellValue('AD' . $numrow, $viewPeserta['bbm']);
    $excel->setActiveSheetIndex(0)->setCellValue('AE' . $numrow, $viewPeserta['dpr1']);
    $excel->setActiveSheetIndex(0)->setCellValue('AF' . $numrow, $viewPeserta['penginapan']);
    $excel->setActiveSheetIndex(0)->setCellValue('AG' . $numrow, $transportPeserta);
    $excel->setActiveSheetIndex(0)->setCellValue('AH' . $numrow, $uangHarianPeserta + $uangHarianPesertaHmin1 + $uangHarianPesertaHplus1);
    $excel->setActiveSheetIndex(0)->setCellValue('AI' . $numrow, $jmlPerjadinPeserta);
    $excel->setActiveSheetIndex(0)->setCellValue('AJ' . $numrow, '');
    $excel->setActiveSheetIndex(0)->setCellValue('AK' . $numrow, '');
    $excel->setActiveSheetIndex(0)->setCellValue('AL' . $numrow, '');
    $excel->setActiveSheetIndex(0)->setCellValue('AM' . $numrow, '');
    $excel->setActiveSheetIndex(0)->setCellValue('AN' . $numrow, '');
    $excel->setActiveSheetIndex(0)->setCellValue('AO' . $numrow, $TotalPeserta);


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
    $excel->getActiveSheet()->getStyle('O' . $numrow)->applyFromArray($style_row);
    $excel->getActiveSheet()->getStyle('P' . $numrow)->applyFromArray($style_row);
    $excel->getActiveSheet()->getStyle('Q' . $numrow)->applyFromArray($style_row);
    $excel->getActiveSheet()->getStyle('R' . $numrow)->applyFromArray($style_row);
    $excel->getActiveSheet()->getStyle('S' . $numrow)->applyFromArray($style_row);
    $excel->getActiveSheet()->getStyle('T' . $numrow)->applyFromArray($style_row);
    $excel->getActiveSheet()->getStyle('U' . $numrow)->applyFromArray($style_row);
    $excel->getActiveSheet()->getStyle('V' . $numrow)->applyFromArray($style_row);
    $excel->getActiveSheet()->getStyle('W' . $numrow)->applyFromArray($style_row);
    $excel->getActiveSheet()->getStyle('X' . $numrow)->applyFromArray($style_row);
    $excel->getActiveSheet()->getStyle('Y' . $numrow)->applyFromArray($style_row);
    $excel->getActiveSheet()->getStyle('Z' . $numrow)->applyFromArray($style_row);
    $excel->getActiveSheet()->getStyle('AA' . $numrow)->applyFromArray($style_row);
    $excel->getActiveSheet()->getStyle('AB' . $numrow)->applyFromArray($style_row);
    $excel->getActiveSheet()->getStyle('AC' . $numrow)->applyFromArray($style_row);
    $excel->getActiveSheet()->getStyle('AD' . $numrow)->applyFromArray($style_row);
    $excel->getActiveSheet()->getStyle('AE' . $numrow)->applyFromArray($style_row);
    $excel->getActiveSheet()->getStyle('AF' . $numrow)->applyFromArray($style_row);
    $excel->getActiveSheet()->getStyle('AG' . $numrow)->applyFromArray($style_row);
    $excel->getActiveSheet()->getStyle('AH' . $numrow)->applyFromArray($style_row);
    $excel->getActiveSheet()->getStyle('AI' . $numrow)->applyFromArray($style_row);
    $excel->getActiveSheet()->getStyle('AJ' . $numrow)->applyFromArray($style_row);
    $excel->getActiveSheet()->getStyle('AK' . $numrow)->applyFromArray($style_row);
    $excel->getActiveSheet()->getStyle('AL' . $numrow)->applyFromArray($style_row);
    $excel->getActiveSheet()->getStyle('AM' . $numrow)->applyFromArray($style_row);
    $excel->getActiveSheet()->getStyle('AN' . $numrow)->applyFromArray($style_row);
    $excel->getActiveSheet()->getStyle('AO' . $numrow)->applyFromArray($style_row);

    $excel->getActiveSheet()->getStyle('V' . $numrow)->getNumberFormat()->setFormatCode("#,##0");
    $excel->getActiveSheet()->getStyle('W' . $numrow)->getNumberFormat()->setFormatCode("#,##0");
    $excel->getActiveSheet()->getStyle('X' . $numrow)->getNumberFormat()->setFormatCode("#,##0");
    $excel->getActiveSheet()->getStyle('Y' . $numrow)->getNumberFormat()->setFormatCode("#,##0");
    $excel->getActiveSheet()->getStyle('Z' . $numrow)->getNumberFormat()->setFormatCode("#,##0");
    $excel->getActiveSheet()->getStyle('AA' . $numrow)->getNumberFormat()->setFormatCode("#,##0");
    $excel->getActiveSheet()->getStyle('AB' . $numrow)->getNumberFormat()->setFormatCode("#,##0");
    $excel->getActiveSheet()->getStyle('AC' . $numrow)->getNumberFormat()->setFormatCode("#,##0");
    $excel->getActiveSheet()->getStyle('AD' . $numrow)->getNumberFormat()->setFormatCode("#,##0");
    $excel->getActiveSheet()->getStyle('AE' . $numrow)->getNumberFormat()->setFormatCode("#,##0");
    $excel->getActiveSheet()->getStyle('AF' . $numrow)->getNumberFormat()->setFormatCode("#,##0");
    $excel->getActiveSheet()->getStyle('AG' . $numrow)->getNumberFormat()->setFormatCode("#,##0");
    $excel->getActiveSheet()->getStyle('AH' . $numrow)->getNumberFormat()->setFormatCode("#,##0");
    $excel->getActiveSheet()->getStyle('AI' . $numrow)->getNumberFormat()->setFormatCode("#,##0");
    $excel->getActiveSheet()->getStyle('AJ' . $numrow)->getNumberFormat()->setFormatCode("#,##0");
    $excel->getActiveSheet()->getStyle('AK' . $numrow)->getNumberFormat()->setFormatCode("#,##0");
    $excel->getActiveSheet()->getStyle('AL' . $numrow)->getNumberFormat()->setFormatCode("#,##0");
    $excel->getActiveSheet()->getStyle('AM' . $numrow)->getNumberFormat()->setFormatCode("#,##0");
    $excel->getActiveSheet()->getStyle('AN' . $numrow)->getNumberFormat()->setFormatCode("#,##0");
    $excel->getActiveSheet()->getStyle('AO' . $numrow)->getNumberFormat()->setFormatCode("#,##0");

    $excel->getActiveSheet()->getStyle('A' . $numrow . ':AO' . $numrow)->getFont()->setSize(10);

    $excel->getActiveSheet()->getRowDimension($numrow)->setRowHeight(15);
    $noUrutTugasPeserta++;
    $noUrutHonor++;
    $noUrutTransport++;
    $numrow++;

    $allTotalPeserta = $allTotalPeserta + $TotalPeserta;
}
//peserta
// echo $allTotalPeserta;

//total
$excel->setActiveSheetIndex(0)->setCellValue('AO' . $numrow, $allTotalPengarah + $allTotalNarsum + $allTotalPanitia + $allTotalPeserta);

$excel->getActiveSheet()->getStyle('AO' . $numrow)->getFont()->setSize(12);
$excel->getActiveSheet()->getStyle('AO' . $numrow)->getNumberFormat()->setFormatCode("#,##0");
$excel->getActiveSheet()->getStyle('AO' . $numrow)->applyFromArray($style_row);
//total

$excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
$excel->getActiveSheet(0)->setTitle('Master SPJ');
