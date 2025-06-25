<?php
// $excel->createSheet();

$allTransportPeserta = 0;
$allHarianPeserta = 0;
$allPerjadinPeserta = 0;
$noUrutTugasPeserta = 1;
$numrowPeserta = $numrowAkhirPanitia;

$excel->setActiveSheetIndex(2)->setCellValue('A' . $numrowPeserta, "Daftar Nominatif Penerimaan Biaya Perjalanan Dinas Peserta");
$excel->getActiveSheet()->mergeCells('A' . $numrowPeserta . ':M' . $numrowPeserta);
$excel->getActiveSheet()->getStyle('A' . $numrowPeserta . ':M' . $numrowPeserta)->applyFromArray($style_title);
$excel->setActiveSheetIndex(2)->setCellValue('A' . ($numrowPeserta + 1), $viewPerjadin['nama_keg_kuitansi']);
$excel->getActiveSheet()->mergeCells('A' . ($numrowPeserta + 1) . ':M' . ($numrowPeserta + 1));
$excel->getActiveSheet()->getStyle('A' . ($numrowPeserta + 1) . ':M' . ($numrowPeserta + 1))->applyFromArray($style_title);
$excel->setActiveSheetIndex(2)->setCellValue('A' . ($numrowPeserta + 2), 'di ' . $viewPerjadin['tempat_keg']);
$excel->getActiveSheet()->mergeCells('A' . ($numrowPeserta + 2) . ':M' . ($numrowPeserta + 2));
$excel->getActiveSheet()->getStyle('A' . ($numrowPeserta + 2) . ':M' . ($numrowPeserta + 2))->applyFromArray($style_title);
$excel->setActiveSheetIndex(2)->setCellValue('A' . ($numrowPeserta + 3), "Tanggal : " . Indonesia2Tgl($viewPerjadin['tgl_mulai']) . " s.d " . Indonesia2Tgl($viewPerjadin['tgl_selesai']));
$excel->getActiveSheet()->mergeCells('A' . ($numrowPeserta + 3) . ':M' . ($numrowPeserta + 3));
$excel->getActiveSheet()->getStyle('A' . ($numrowPeserta + 3) . ':M' . ($numrowPeserta + 3))->applyFromArray($style_title);
$excel->setActiveSheetIndex(2)->setCellValue('A' . ($numrowPeserta + 4), 'Nomor : ' . $viewPerjadin['no_sptjb_perjadin'] . '' . $viewPerjadin['sptjb_perjadin']);
$excel->getActiveSheet()->mergeCells('A' . ($numrowPeserta + 4) . ':M' . ($numrowPeserta + 4));
$excel->getActiveSheet()->getStyle('A' . ($numrowPeserta + 4) . ':M' . ($numrowPeserta + 4))->applyFromArray($style_title);

$excel->setActiveSheetIndex(2)->setCellValue('A' . ($numrowPeserta + 6), "No");
$excel->getActiveSheet()->mergeCells('A' . ($numrowPeserta + 6) . ':A' . ($numrowPeserta + 7));
$excel->getActiveSheet()->getStyle('A' . ($numrowPeserta + 6) . ':A' . ($numrowPeserta + 7))->applyFromArray($style_col);
$excel->setActiveSheetIndex(2)->setCellValue('B' . ($numrowPeserta + 6), "Nama");
$excel->getActiveSheet()->mergeCells('B' . ($numrowPeserta + 6) . ':B' . ($numrowPeserta + 7));
$excel->getActiveSheet()->getStyle('B' . ($numrowPeserta + 6) . ':B' . ($numrowPeserta + 7))->applyFromArray($style_col);
$excel->setActiveSheetIndex(2)->setCellValue('C' . ($numrowPeserta + 6), "Gol");
$excel->getActiveSheet()->mergeCells('C' . ($numrowPeserta + 6) . ':C' . ($numrowPeserta + 7));
$excel->getActiveSheet()->getStyle('C' . ($numrowPeserta + 6) . ':C' . ($numrowPeserta + 7))->applyFromArray($style_col);
$excel->setActiveSheetIndex(2)->setCellValue('D' . ($numrowPeserta + 6), "Asal\nDaerah/Kota");
$excel->getActiveSheet()->mergeCells('D' . ($numrowPeserta + 6) . ':D' . ($numrowPeserta + 7));
$excel->getActiveSheet()->getStyle('D' . ($numrowPeserta + 6) . ':D' . ($numrowPeserta + 7))->applyFromArray($style_col);
$excel->setActiveSheetIndex(2)->setCellValue('E' . ($numrowPeserta + 6), "Tujuan");
$excel->getActiveSheet()->mergeCells('E' . ($numrowPeserta + 6) . ':E' . ($numrowPeserta + 7));
$excel->getActiveSheet()->getStyle('E' . ($numrowPeserta + 6) . ':E' . ($numrowPeserta + 7))->applyFromArray($style_col);
$excel->setActiveSheetIndex(2)->setCellValue('F' . ($numrowPeserta + 6), "Tanggal");
$excel->getActiveSheet()->mergeCells('F' . ($numrowPeserta + 6) . ':G' . ($numrowPeserta + 6));
$excel->getActiveSheet()->getStyle('F' . ($numrowPeserta + 6) . ':G' . ($numrowPeserta + 6))->applyFromArray($style_col);
$excel->setActiveSheetIndex(2)->setCellValue('F' . ($numrowPeserta + 7), "Berangkat");
$excel->getActiveSheet()->getStyle('F' . ($numrowPeserta + 7))->applyFromArray($style_col);
$excel->setActiveSheetIndex(2)->setCellValue('G' . ($numrowPeserta + 7), "Pulang");
$excel->getActiveSheet()->getStyle('G' . ($numrowPeserta + 7))->applyFromArray($style_col);
$excel->setActiveSheetIndex(2)->setCellValue('H' . ($numrowPeserta + 6), "Lama\nPerjalanan");
$excel->getActiveSheet()->mergeCells('H' . ($numrowPeserta + 6) . ':H' . ($numrowPeserta + 7));
$excel->getActiveSheet()->getStyle('H' . ($numrowPeserta + 6) . ':H' . ($numrowPeserta + 7))->applyFromArray($style_col);
$excel->setActiveSheetIndex(2)->setCellValue('I' . ($numrowPeserta + 6), "Transport");
$excel->getActiveSheet()->mergeCells('I' . ($numrowPeserta + 6) . ':I' . ($numrowPeserta + 7));
$excel->getActiveSheet()->getStyle('I' . ($numrowPeserta + 6) . ':I' . ($numrowPeserta + 7))->applyFromArray($style_col);
$excel->setActiveSheetIndex(2)->setCellValue('J' . ($numrowPeserta + 6), "Uang\nHarian");
$excel->getActiveSheet()->mergeCells('J' . ($numrowPeserta + 6) . ':J' . ($numrowPeserta + 7));
$excel->getActiveSheet()->getStyle('J' . ($numrowPeserta + 6) . ':J' . ($numrowPeserta + 7))->applyFromArray($style_col);
$excel->setActiveSheetIndex(2)->setCellValue('K' . ($numrowPeserta + 6), "Penginapan");
$excel->getActiveSheet()->mergeCells('K' . ($numrowPeserta + 6) . ':K' . ($numrowPeserta + 7));
$excel->getActiveSheet()->getStyle('K' . ($numrowPeserta + 6) . ':K' . ($numrowPeserta + 7))->applyFromArray($style_col);
$excel->setActiveSheetIndex(2)->setCellValue('L' . ($numrowPeserta + 6), "Biaya\nRp.");
$excel->getActiveSheet()->mergeCells('L' . ($numrowPeserta + 6) . ':L' . ($numrowPeserta + 7));
$excel->getActiveSheet()->getStyle('L' . ($numrowPeserta + 6) . ':L' . ($numrowPeserta + 7))->applyFromArray($style_col);
$excel->setActiveSheetIndex(2)->setCellValue('M' . ($numrowPeserta + 6), "No.\nRekening");
$excel->getActiveSheet()->mergeCells('M' . ($numrowPeserta + 6) . ':M' . ($numrowPeserta + 7));
$excel->getActiveSheet()->getStyle('M' . ($numrowPeserta + 6) . ':M' . ($numrowPeserta + 7))->applyFromArray($style_col);

$excel->getActiveSheet()->getStyle('A' . ($numrowPeserta + 6) . ':M' . ($numrowPeserta + 7))->applyFromArray($styleWarp);

// $excel->getActiveSheet()->getColumnDimension('A')->setWidth(2);
// $excel->getActiveSheet()->getColumnDimension('B')->setWidth(35);
// $excel->getActiveSheet()->getColumnDimension('C')->setWidth(2);
// $excel->getActiveSheet()->getColumnDimension('D')->setWidth(15);
// $excel->getActiveSheet()->getColumnDimension('E')->setWidth(12);
// $excel->getActiveSheet()->getColumnDimension('F')->setWidth(12);
// $excel->getActiveSheet()->getColumnDimension('G')->setWidth(12);
// $excel->getActiveSheet()->getColumnDimension('H')->setWidth(12);
// $excel->getActiveSheet()->getColumnDimension('I')->setWidth(15);
// $excel->getActiveSheet()->getColumnDimension('J')->setWidth(15);
// $excel->getActiveSheet()->getColumnDimension('K')->setWidth(15);
// $excel->getActiveSheet()->getColumnDimension('L')->setWidth(15);
// $excel->getActiveSheet()->getColumnDimension('M')->setWidth(12);

$excel->getActiveSheet()->getRowDimension($numrowPeserta + 6)->setRowHeight(20);
$excel->getActiveSheet()->getRowDimension($numrowPeserta + 7)->setRowHeight(20);

$numrowPeserta = $numrowPeserta + 8;
$sqlPeserta = mysqli_query($myConnection, "select tb_peserta_keg_hotel.* , tb_kabkota.name as nama_kab
from tb_peserta_keg_hotel
left join tb_kabkota on tb_kabkota.id = tb_peserta_keg_hotel.id_kabkota_unit_kerja
where tb_peserta_keg_hotel.id_keg = '$id_keg' ");
while ($viewPeserta = mysqli_fetch_array($sqlPeserta)) {
    $golPajakPeserta = $viewPeserta['id_pangkat_gol'];
    $pajakPeserta = mysqli_fetch_array(mysqli_query($myConnection, "select gol, pajak from tb_gol_pajak where id_pangkat = '$golPajakPeserta'"));
    // $totalTransportPeserta = $viewPeserta['bbm'] + $viewPeserta['tiket_pesawat'] + $viewPeserta['tiket_kapal'] + $viewPeserta['tiket'] + 

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

    $excel->setActiveSheetIndex(2)->setCellValue('A' . $numrowPeserta, $noUrutTugasPeserta);
    $excel->setActiveSheetIndex(2)->setCellValue('B' . $numrowPeserta, $viewPeserta['nama']);
    $excel->setActiveSheetIndex(2)->setCellValue('C' . $numrowPeserta, $viewPeserta['gol']);
    $excel->setActiveSheetIndex(2)->setCellValue('D' . $numrowPeserta, $viewPeserta['kabkota_unit_kerja']);
    $excel->setActiveSheetIndex(2)->setCellValue('E' . $numrowPeserta, str_replace('Kabupaten', 'Kab.', ucwords($viewPerjadin['nama_kab'])));
    $excel->setActiveSheetIndex(2)->setCellValue('F' . $numrowPeserta, Indonesia2Tgl($viewPeserta['tgl_mulai']));
    $excel->getActiveSheet()->getStyle('F' . $numrowPeserta)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $excel->setActiveSheetIndex(2)->setCellValue('G' . $numrowPeserta, Indonesia2Tgl($viewPeserta['tgl_selesai']));
    $excel->getActiveSheet()->getStyle('G' . $numrowPeserta)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $excel->setActiveSheetIndex(2)->setCellValue('H' . $numrowPeserta, $jmlHariPeserta . ' Hari');
    $excel->getActiveSheet()->getStyle('H' . $numrowPeserta)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $excel->setActiveSheetIndex(2)->setCellValue('I' . $numrowPeserta, $transportPeserta);
    $excel->setActiveSheetIndex(2)->setCellValue('J' . $numrowPeserta, $uangHarianPeserta + $uangHarianPesertaHmin1 + $uangHarianPesertaHplus1);
    $excel->setActiveSheetIndex(2)->setCellValue('K' . $numrowPeserta, $hotel == 0 ? '' : $hotel);
    $excel->setActiveSheetIndex(2)->setCellValue('L' . $numrowPeserta, $jmlPerjadinPeserta);
    $excel->setActiveSheetIndex(2)->setCellValue('M' . $numrowPeserta, '');

    $excel->getActiveSheet()->getStyle('I' . $numrowPeserta)->getNumberFormat()->setFormatCode("#,##0");
    $excel->getActiveSheet()->getStyle('J' . $numrowPeserta)->getNumberFormat()->setFormatCode("#,##0");
    $excel->getActiveSheet()->getStyle('K' . $numrowPeserta)->getNumberFormat()->setFormatCode("#,##0");
    $excel->getActiveSheet()->getStyle('L' . $numrowPeserta)->getNumberFormat()->setFormatCode("#,##0");

    $excel->getActiveSheet()->getStyle('A' . $numrowPeserta)->applyFromArray($style_row);
    $excel->getActiveSheet()->getStyle('B' . $numrowPeserta)->applyFromArray($style_row);
    $excel->getActiveSheet()->getStyle('C' . $numrowPeserta)->applyFromArray($style_row);
    $excel->getActiveSheet()->getStyle('D' . $numrowPeserta)->applyFromArray($style_row);
    $excel->getActiveSheet()->getStyle('E' . $numrowPeserta)->applyFromArray($style_row);
    $excel->getActiveSheet()->getStyle('F' . $numrowPeserta)->applyFromArray($style_row);
    $excel->getActiveSheet()->getStyle('G' . $numrowPeserta)->applyFromArray($style_row);
    $excel->getActiveSheet()->getStyle('H' . $numrowPeserta)->applyFromArray($style_row);
    $excel->getActiveSheet()->getStyle('I' . $numrowPeserta)->applyFromArray($style_row);
    $excel->getActiveSheet()->getStyle('J' . $numrowPeserta)->applyFromArray($style_row);
    $excel->getActiveSheet()->getStyle('K' . $numrowPeserta)->applyFromArray($style_row);
    $excel->getActiveSheet()->getStyle('L' . $numrowPeserta)->applyFromArray($style_row);
    $excel->getActiveSheet()->getStyle('M' . $numrowPeserta)->applyFromArray($style_row);

    $excel->getActiveSheet()->getStyle('A' . $numrowPeserta . ':M' . $numrowPeserta)->getFont()->setSize(10);

    $excel->getActiveSheet()->getRowDimension($numrowPeserta)->setRowHeight(15);
    $noUrutTugasPeserta++;
    $numrowPeserta++;

    $allTransportPeserta = $allTransportPeserta + $transportPeserta;
    $allHarianPeserta = $allHarianPeserta + $uangHarianPeserta;
    $allPerjadinPeserta = $allPerjadinPeserta + $jmlPerjadinPeserta;
}


$excel->setActiveSheetIndex(2)->setCellValue('A' . $numrowPeserta, '');
$excel->setActiveSheetIndex(2)->setCellValue('B' . $numrowPeserta, 'Jumlah');
$excel->getActiveSheet()->getStyle('B' . $numrowPeserta)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$excel->setActiveSheetIndex(2)->setCellValue('C' . $numrowPeserta, '');
$excel->setActiveSheetIndex(2)->setCellValue('D' . $numrowPeserta, '');
$excel->setActiveSheetIndex(2)->setCellValue('E' . $numrowPeserta, '');
$excel->setActiveSheetIndex(2)->setCellValue('F' . $numrowPeserta, '');
$excel->setActiveSheetIndex(2)->setCellValue('G' . $numrowPeserta, '');
$excel->setActiveSheetIndex(2)->setCellValue('H' . $numrowPeserta, '');
$excel->setActiveSheetIndex(2)->setCellValue('I' . $numrowPeserta, $allTransportPeserta);
$excel->setActiveSheetIndex(2)->setCellValue('J' . $numrowPeserta, $allHarianPeserta);
$excel->setActiveSheetIndex(2)->setCellValue('K' . $numrowPeserta, '');
$excel->setActiveSheetIndex(2)->setCellValue('L' . $numrowPeserta, $allPerjadinPeserta);
$excel->setActiveSheetIndex(2)->setCellValue('M' . $numrowPeserta, '');

$excel->getActiveSheet()->getStyle('I' . $numrowPeserta)->getNumberFormat()->setFormatCode("#,##0");
$excel->getActiveSheet()->getStyle('J' . $numrowPeserta)->getNumberFormat()->setFormatCode("#,##0");
$excel->getActiveSheet()->getStyle('K' . $numrowPeserta)->getNumberFormat()->setFormatCode("#,##0");
$excel->getActiveSheet()->getStyle('L' . $numrowPeserta)->getNumberFormat()->setFormatCode("#,##0");

$excel->getActiveSheet()->getStyle('A' . $numrowPeserta)->applyFromArray($style_col_foot);
$excel->getActiveSheet()->getStyle('B' . $numrowPeserta)->applyFromArray($style_col_foot);
$excel->getActiveSheet()->getStyle('C' . $numrowPeserta)->applyFromArray($style_col_foot);
$excel->getActiveSheet()->getStyle('D' . $numrowPeserta)->applyFromArray($style_col_foot);
$excel->getActiveSheet()->getStyle('E' . $numrowPeserta)->applyFromArray($style_col_foot);
$excel->getActiveSheet()->getStyle('F' . $numrowPeserta)->applyFromArray($style_col_foot);
$excel->getActiveSheet()->getStyle('G' . $numrowPeserta)->applyFromArray($style_col_foot);
$excel->getActiveSheet()->getStyle('H' . $numrowPeserta)->applyFromArray($style_col_foot);
$excel->getActiveSheet()->getStyle('I' . $numrowPeserta)->applyFromArray($style_col_foot);
$excel->getActiveSheet()->getStyle('J' . $numrowPeserta)->applyFromArray($style_col_foot);
$excel->getActiveSheet()->getStyle('K' . $numrowPeserta)->applyFromArray($style_col_foot);
$excel->getActiveSheet()->getStyle('L' . $numrowPeserta)->applyFromArray($style_col_foot);
$excel->getActiveSheet()->getStyle('M' . $numrowPeserta)->applyFromArray($style_col_foot);

$excel->getActiveSheet()->getStyle('A' . $numrowPeserta . ':M' . $numrowPeserta)->getFont()->setSize(10);

// echo $numrowPeserta;
$excel->setActiveSheetIndex(2)->setCellValue('J' . ($numrowPeserta + 2), 'Surabaya, ' . Indonesia2Tgl($viewPerjadin['tgl_sptjb_perjadin']));
$excel->setActiveSheetIndex(2)->setCellValue('J' . ($numrowPeserta + 3), 'Kuasa Pengguna Anggaran/');
$excel->setActiveSheetIndex(2)->setCellValue('J' . ($numrowPeserta + 4), 'Pejabat Pembuat Komitmen');
$excel->setActiveSheetIndex(2)->setCellValue('J' . ($numrowPeserta + 8), $viewPPK['nama_peg']);
$excel->setActiveSheetIndex(2)->setCellValue('J' . ($numrowPeserta + 9), 'NIP. ' . $viewPPK['nip']);


$excel->getActiveSheet()->getStyle('A' . ($numrowPeserta + 2) . ':J' . ($numrowPeserta + 9))->applyFromArray($style_ttd);
$excel->getActiveSheet()->getStyle('A' . ($numrowPeserta + 2) . ':J' . ($numrowPeserta + 9))->getFont()->setSize(10);



$excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
// $excel->getActiveSheet(2)->setTitle('Peserta');
