<?php
$excel->createSheet();

$allTotalPengarah = 0;
$allTransportPengarah = 0;
$noUrutTugasPengarah = 1;
$numrowPengarah = 9;

$excel->setActiveSheetIndex(2)->setCellValue('A1', "Daftar Nominatif Penerimaan Biaya Perjalanan Dinas Pengarah");
$excel->getActiveSheet()->mergeCells('A1:M1');
$excel->getActiveSheet()->getStyle('A1:M1')->applyFromArray($style_title);
$excel->setActiveSheetIndex(2)->setCellValue('A2', $viewPerjadin['nama_keg_kuitansi']);
$excel->getActiveSheet()->mergeCells('A2:M2');
$excel->getActiveSheet()->getStyle('A2:M2')->applyFromArray($style_title);
$excel->setActiveSheetIndex(2)->setCellValue('A3', 'di ' . $viewPerjadin['tempat_keg']);
$excel->getActiveSheet()->mergeCells('A3:M3');
$excel->getActiveSheet()->getStyle('A3:M3')->applyFromArray($style_title);
$excel->setActiveSheetIndex(2)->setCellValue('A4', "Tanggal : " . Indonesia2Tgl($viewPerjadin['tgl_mulai']) . " s.d " . Indonesia2Tgl($viewPerjadin['tgl_selesai']));
$excel->getActiveSheet()->mergeCells('A4:M4');
$excel->getActiveSheet()->getStyle('A4:M4')->applyFromArray($style_title);
$excel->setActiveSheetIndex(2)->setCellValue('A5', 'Nomor : ' . $viewPerjadin['no_sptjb_perjadin'] . '' . $viewPerjadin['sptjb_perjadin']);
$excel->getActiveSheet()->mergeCells('A5:M5');
$excel->getActiveSheet()->getStyle('A5:M5')->applyFromArray($style_title);

$excel->setActiveSheetIndex(2)->setCellValue('A7', "No");
$excel->getActiveSheet()->mergeCells('A7:A8');
$excel->getActiveSheet()->getStyle('A7:A8')->applyFromArray($style_col);
$excel->setActiveSheetIndex(2)->setCellValue('B7', "Nama");
$excel->getActiveSheet()->mergeCells('B7:B8');
$excel->getActiveSheet()->getStyle('B7:B8')->applyFromArray($style_col);
$excel->setActiveSheetIndex(2)->setCellValue('C7', "Gol");
$excel->getActiveSheet()->mergeCells('C7:C8');
$excel->getActiveSheet()->getStyle('C7:C8')->applyFromArray($style_col);
$excel->setActiveSheetIndex(2)->setCellValue('D7', "Asal\nDaerah/Kota");
$excel->getActiveSheet()->mergeCells('D7:D8');
$excel->getActiveSheet()->getStyle('D7:D8')->applyFromArray($style_col);
$excel->setActiveSheetIndex(2)->setCellValue('E7', "Tujuan");
$excel->getActiveSheet()->mergeCells('E7:E8');
$excel->getActiveSheet()->getStyle('E7:E8')->applyFromArray($style_col);
$excel->setActiveSheetIndex(2)->setCellValue('F7', "Tanggal");
$excel->getActiveSheet()->mergeCells('F7:G7');
$excel->getActiveSheet()->getStyle('F7:G7')->applyFromArray($style_col);
$excel->setActiveSheetIndex(2)->setCellValue('F8', "Berangkat");
$excel->getActiveSheet()->getStyle('F8')->applyFromArray($style_col);
$excel->setActiveSheetIndex(2)->setCellValue('G8', "Pulang");
$excel->getActiveSheet()->getStyle('G8')->applyFromArray($style_col);
$excel->setActiveSheetIndex(2)->setCellValue('H7', "Lama\nPerjalanan");
$excel->getActiveSheet()->mergeCells('H7:H8');
$excel->getActiveSheet()->getStyle('H7:H8')->applyFromArray($style_col);
$excel->setActiveSheetIndex(2)->setCellValue('I7', "Transport");
$excel->getActiveSheet()->mergeCells('I7:I8');
$excel->getActiveSheet()->getStyle('I7:I8')->applyFromArray($style_col);
$excel->setActiveSheetIndex(2)->setCellValue('J7', "Uang\nHarian");
$excel->getActiveSheet()->mergeCells('J7:J8');
$excel->getActiveSheet()->getStyle('J7:J8')->applyFromArray($style_col);
$excel->setActiveSheetIndex(2)->setCellValue('K7', "Penginapan");
$excel->getActiveSheet()->mergeCells('K7:K8');
$excel->getActiveSheet()->getStyle('K7:K8')->applyFromArray($style_col);
$excel->setActiveSheetIndex(2)->setCellValue('L7', "Biaya\nRp.");
$excel->getActiveSheet()->mergeCells('L7:L8');
$excel->getActiveSheet()->getStyle('L7:L8')->applyFromArray($style_col);
$excel->setActiveSheetIndex(2)->setCellValue('M7', "No.\nRekening");
$excel->getActiveSheet()->mergeCells('M7:M8');
$excel->getActiveSheet()->getStyle('M7:M8')->applyFromArray($style_col);

$excel->getActiveSheet()->getStyle('A7:M8')->applyFromArray($styleWarp);

$excel->getActiveSheet()->getColumnDimension('A')->setWidth(5);
$excel->getActiveSheet()->getColumnDimension('B')->setWidth(35);
$excel->getActiveSheet()->getColumnDimension('C')->setWidth(4);
$excel->getActiveSheet()->getColumnDimension('D')->setWidth(15);
$excel->getActiveSheet()->getColumnDimension('E')->setWidth(12);
$excel->getActiveSheet()->getColumnDimension('F')->setWidth(12);
$excel->getActiveSheet()->getColumnDimension('G')->setWidth(12);
$excel->getActiveSheet()->getColumnDimension('H')->setWidth(12);
$excel->getActiveSheet()->getColumnDimension('I')->setWidth(15);
$excel->getActiveSheet()->getColumnDimension('J')->setWidth(15);
$excel->getActiveSheet()->getColumnDimension('K')->setWidth(15);
$excel->getActiveSheet()->getColumnDimension('L')->setWidth(15);
$excel->getActiveSheet()->getColumnDimension('M')->setWidth(12);

$excel->getActiveSheet()->getRowDimension('7')->setRowHeight(20);
$excel->getActiveSheet()->getRowDimension('8')->setRowHeight(20);


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
    if ($totalTransportPengarah > $sbmPengarah) {
        $transportPengarah = $sbmPengarah;
    } else {
        $transportPengarah = $totalTransportPengarah;
    }
    $TotalPengarah = $transportPengarah;
    $excel->setActiveSheetIndex(2)->setCellValue('A' . $numrowPengarah, $noUrutTugasPengarah);
    $excel->setActiveSheetIndex(2)->setCellValue('B' . $numrowPengarah, $viewPengarah['nama']);
    $excel->setActiveSheetIndex(2)->setCellValue('C' . $numrowPengarah, $viewPengarah['gol']);
    $excel->setActiveSheetIndex(2)->setCellValue('D' . $numrowPengarah, $viewPengarah['kabkota_unit_kerja']);
    $excel->setActiveSheetIndex(2)->setCellValue('E' . $numrowPengarah, str_replace('Kabupaten', 'Kab.', ucwords($viewPerjadin['nama_kab'])));
    $excel->setActiveSheetIndex(2)->setCellValue('F' . $numrowPengarah, Indonesia2Tgl($viewPerjadin['tgl_mulai']));
    $excel->getActiveSheet()->getStyle('F' . $numrowPengarah)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $excel->setActiveSheetIndex(2)->setCellValue('G' . $numrowPengarah, Indonesia2Tgl($viewPerjadin['tgl_selesai']));
    $excel->getActiveSheet()->getStyle('G' . $numrowPengarah)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $excel->setActiveSheetIndex(2)->setCellValue('H' . $numrowPengarah, $jmlHariPengarah . ' Hari');
    $excel->getActiveSheet()->getStyle('H' . $numrowPengarah)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $excel->setActiveSheetIndex(2)->setCellValue('I' . $numrowPengarah, $transportPengarah);
    $excel->setActiveSheetIndex(2)->setCellValue('J' . $numrowPengarah, '');
    $excel->setActiveSheetIndex(2)->setCellValue('K' . $numrowPengarah, '');
    $excel->setActiveSheetIndex(2)->setCellValue('L' . $numrowPengarah, $TotalPengarah);
    $excel->setActiveSheetIndex(2)->setCellValue('M' . $numrowPengarah, '');

    $excel->getActiveSheet()->getStyle('I' . $numrowPengarah)->getNumberFormat()->setFormatCode("#,##0");
    $excel->getActiveSheet()->getStyle('J' . $numrowPengarah)->getNumberFormat()->setFormatCode("#,##0");
    $excel->getActiveSheet()->getStyle('K' . $numrowPengarah)->getNumberFormat()->setFormatCode("#,##0");
    $excel->getActiveSheet()->getStyle('L' . $numrowPengarah)->getNumberFormat()->setFormatCode("#,##0");

    $excel->getActiveSheet()->getStyle('A' . $numrowPengarah)->applyFromArray($style_row);
    $excel->getActiveSheet()->getStyle('B' . $numrowPengarah)->applyFromArray($style_row);
    $excel->getActiveSheet()->getStyle('C' . $numrowPengarah)->applyFromArray($style_row);
    $excel->getActiveSheet()->getStyle('D' . $numrowPengarah)->applyFromArray($style_row);
    $excel->getActiveSheet()->getStyle('E' . $numrowPengarah)->applyFromArray($style_row);
    $excel->getActiveSheet()->getStyle('F' . $numrowPengarah)->applyFromArray($style_row);
    $excel->getActiveSheet()->getStyle('G' . $numrowPengarah)->applyFromArray($style_row);
    $excel->getActiveSheet()->getStyle('H' . $numrowPengarah)->applyFromArray($style_row);
    $excel->getActiveSheet()->getStyle('I' . $numrowPengarah)->applyFromArray($style_row);
    $excel->getActiveSheet()->getStyle('J' . $numrowPengarah)->applyFromArray($style_row);
    $excel->getActiveSheet()->getStyle('K' . $numrowPengarah)->applyFromArray($style_row);
    $excel->getActiveSheet()->getStyle('L' . $numrowPengarah)->applyFromArray($style_row);
    $excel->getActiveSheet()->getStyle('M' . $numrowPengarah)->applyFromArray($style_row);

    $excel->getActiveSheet()->getStyle('A' . $numrowPengarah . ':M' . $numrowPengarah)->getFont()->setSize(10);

    $excel->getActiveSheet()->getRowDimension($numrowPengarah)->setRowHeight(15);
    $noUrutTugasPengarah++;
    $numrowPengarah++;

    $allTransportPengarah = $allTransportPengarah + $transportPengarah;
    $allTotalPengarah = $allTotalPengarah + $TotalPengarah;
}


$excel->setActiveSheetIndex(2)->setCellValue('A' . $numrowPengarah, '');
$excel->setActiveSheetIndex(2)->setCellValue('B' . $numrowPengarah, 'Jumlah');
$excel->getActiveSheet()->getStyle('B' . $numrowPengarah)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$excel->setActiveSheetIndex(2)->setCellValue('C' . $numrowPengarah, '');
$excel->setActiveSheetIndex(2)->setCellValue('D' . $numrowPengarah, '');
$excel->setActiveSheetIndex(2)->setCellValue('E' . $numrowPengarah, '');
$excel->setActiveSheetIndex(2)->setCellValue('F' . $numrowPengarah, '');
$excel->setActiveSheetIndex(2)->setCellValue('G' . $numrowPengarah, '');
$excel->setActiveSheetIndex(2)->setCellValue('H' . $numrowPengarah, '');
$excel->setActiveSheetIndex(2)->setCellValue('I' . $numrowPengarah, $allTransportPengarah);
$excel->setActiveSheetIndex(2)->setCellValue('J' . $numrowPengarah, '');
$excel->setActiveSheetIndex(2)->setCellValue('K' . $numrowPengarah, '');
$excel->setActiveSheetIndex(2)->setCellValue('L' . $numrowPengarah, $allTotalPengarah);
$excel->setActiveSheetIndex(2)->setCellValue('M' . $numrowPengarah, '');

$excel->getActiveSheet()->getStyle('I' . $numrowPengarah)->getNumberFormat()->setFormatCode("#,##0");
$excel->getActiveSheet()->getStyle('J' . $numrowPengarah)->getNumberFormat()->setFormatCode("#,##0");
$excel->getActiveSheet()->getStyle('K' . $numrowPengarah)->getNumberFormat()->setFormatCode("#,##0");
$excel->getActiveSheet()->getStyle('L' . $numrowPengarah)->getNumberFormat()->setFormatCode("#,##0");

$excel->getActiveSheet()->getStyle('A' . $numrowPengarah)->applyFromArray($style_col_foot);
$excel->getActiveSheet()->getStyle('B' . $numrowPengarah)->applyFromArray($style_col_foot);
$excel->getActiveSheet()->getStyle('C' . $numrowPengarah)->applyFromArray($style_col_foot);
$excel->getActiveSheet()->getStyle('D' . $numrowPengarah)->applyFromArray($style_col_foot);
$excel->getActiveSheet()->getStyle('E' . $numrowPengarah)->applyFromArray($style_col_foot);
$excel->getActiveSheet()->getStyle('F' . $numrowPengarah)->applyFromArray($style_col_foot);
$excel->getActiveSheet()->getStyle('G' . $numrowPengarah)->applyFromArray($style_col_foot);
$excel->getActiveSheet()->getStyle('H' . $numrowPengarah)->applyFromArray($style_col_foot);
$excel->getActiveSheet()->getStyle('I' . $numrowPengarah)->applyFromArray($style_col_foot);
$excel->getActiveSheet()->getStyle('J' . $numrowPengarah)->applyFromArray($style_col_foot);
$excel->getActiveSheet()->getStyle('K' . $numrowPengarah)->applyFromArray($style_col_foot);
$excel->getActiveSheet()->getStyle('L' . $numrowPengarah)->applyFromArray($style_col_foot);
$excel->getActiveSheet()->getStyle('M' . $numrowPengarah)->applyFromArray($style_col_foot);

$excel->getActiveSheet()->getStyle('A' . $numrowPengarah . ':M' . $numrowPengarah)->getFont()->setSize(10);

// echo $numrowPengarah;
$excel->setActiveSheetIndex(2)->setCellValue('J' . ($numrowPengarah + 2), 'Surabaya, ' . Indonesia2Tgl($viewPerjadin['tgl_sptjb_perjadin']));
$excel->setActiveSheetIndex(2)->setCellValue('J' . ($numrowPengarah + 3), 'Kuasa Pengguna Anggaran/');
$excel->setActiveSheetIndex(2)->setCellValue('J' . ($numrowPengarah + 4), 'Pejabat Pembuat Komitmen');
$excel->setActiveSheetIndex(2)->setCellValue('J' . ($numrowPengarah + 8), $viewPPK['nama_peg']);
$excel->setActiveSheetIndex(2)->setCellValue('J' . ($numrowPengarah + 9), 'NIP. ' . $viewPPK['nip']);


$excel->getActiveSheet()->getStyle('A' . ($numrowPengarah + 2) . ':J' . ($numrowPengarah + 9))->applyFromArray($style_ttd);
$excel->getActiveSheet()->getStyle('A' . ($numrowPengarah + 2) . ':J' . ($numrowPengarah + 9))->getFont()->setSize(10);


$numrowAkhirPengarah = $numrowPengarah + 10;
// $excel->setActiveSheetIndex(2)->setCellValue('A' . $numrowAkhirPengarah, 'ini akhir pengarah');
$excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
$excel->getActiveSheet(2)->setTitle('NOM Transport');
