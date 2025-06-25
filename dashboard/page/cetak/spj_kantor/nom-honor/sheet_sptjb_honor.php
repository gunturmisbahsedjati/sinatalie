<?php
require_once 'query_sptjb_honor.php';
$excel->createSheet();

$excel->setActiveSheetIndex(5)->setCellValue('H1', 'Lampiran 1 Perdirjen Perbendaharaan');
$excel->setActiveSheetIndex(5)->setCellValue('H2', 'Nomor Per. 11/PB/2011');
$excel->setActiveSheetIndex(5)->setCellValue('H3', 'Tanggal  : 18 Februari 2011');

$excel->setActiveSheetIndex(5)->setCellValue('A5', 'SURAT PERNYATAAN TANGGUNG JAWAB  BELANJA');
$excel->getActiveSheet()->getStyle('A5')->getFont()->setUnderline(true);
$excel->getActiveSheet()->mergeCells('A5:J5');
$excel->setActiveSheetIndex(5)->setCellValue('A6', 'Nomor : ' . $viewPerjadin['no_sptjb_perjadin'] . '' . $viewPerjadin['sptjb_perjadin']);
$excel->getActiveSheet()->mergeCells('A6:J6');


$excel->getActiveSheet()->getStyle('H1:H3')->applyFromArray($style_ttd);
$excel->getActiveSheet()->getStyle('H1:H3')->getFont()->setSize(10);
$excel->getActiveSheet()->getStyle('A5:J6')->applyFromArray($style_title);


$excel->setActiveSheetIndex(5)->setCellValue('A8', '1');
$excel->getActiveSheet()->getStyle('A8')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$excel->setActiveSheetIndex(5)->setCellValue('B8', 'Nama Satuan Kerja');
$excel->setActiveSheetIndex(5)->setCellValue('F8', ':');
$excel->setActiveSheetIndex(5)->setCellValue('G8', $viewPerjadin['nama_satker']);
$excel->setActiveSheetIndex(5)->setCellValue('A9', '2');
$excel->getActiveSheet()->getStyle('A9')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$excel->setActiveSheetIndex(5)->setCellValue('B9', 'Kode Satuan Kerja');
$excel->setActiveSheetIndex(5)->setCellValue('F9', ':');
$excel->setActiveSheetIndex(5)->setCellValueExplicit('G9', $viewPerjadin['kode_satker'], PHPExcel_Cell_DataType::TYPE_STRING);
$excel->setActiveSheetIndex(5)->setCellValue('A10', '3');
$excel->getActiveSheet()->getStyle('A10')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$excel->setActiveSheetIndex(5)->setCellValue('B10', 'Tanggal/No. DIPA');
$excel->setActiveSheetIndex(5)->setCellValue('F10', ':');
$excel->setActiveSheetIndex(5)->setCellValue('G10', Indonesia2Tgl($viewPerjadin['tgl_dipa']) . ', DIPA - ' . $viewPerjadin['no_dipa']);
$excel->setActiveSheetIndex(5)->setCellValue('A11', '4');
$excel->getActiveSheet()->getStyle('A11')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$excel->setActiveSheetIndex(5)->setCellValue('B11', 'Klasifikasi Anggaran');
$excel->setActiveSheetIndex(5)->setCellValue('F11', ':');
$excel->setActiveSheetIndex(5)->setCellValue('G11', $viewPerjadin['klasifikasi']);

$excel->setActiveSheetIndex(5)->setCellValue('A13', 'Yang bertanda tangan di bawah ini atas nama Kuasa Pengguna Anggaran Satuan Kerja Lembaga Penjaminan Mutu Pendidikan ');
$excel->setActiveSheetIndex(5)->setCellValue('A14', '(LPMP) Jatim menyatakan bahwa saya bertanggung jawab secara formal dan material dan kebenaran perhitungan pajak ');
$excel->setActiveSheetIndex(5)->setCellValue('A15', 'atas segala pembayaran tagihan yang telah kami perintahkan dalam SPM ini dengan perincian sebagai berikut :');

$excel->getActiveSheet()->getStyle('A8:G10')->applyFromArray($style_ttd);
$excel->getActiveSheet()->getStyle('A11:J11')->applyFromArray($style_ttd2);
$excel->getActiveSheet()->getStyle('A13:J15')->applyFromArray($style_ttd);
$excel->getActiveSheet()->getColumnDimension('A')->setWidth(6);
$excel->getActiveSheet()->getColumnDimension('B')->setWidth(11);
$excel->getActiveSheet()->getColumnDimension('C')->setWidth(5);
$excel->getActiveSheet()->getColumnDimension('D')->setWidth(26);
$excel->getActiveSheet()->getColumnDimension('E')->setWidth(2);
$excel->getActiveSheet()->getColumnDimension('F')->setWidth(2);
$excel->getActiveSheet()->getColumnDimension('G')->setWidth(47);
$excel->getActiveSheet()->getColumnDimension('H')->setWidth(19);
$excel->getActiveSheet()->getColumnDimension('I')->setWidth(23);
$excel->getActiveSheet()->getColumnDimension('J')->setWidth(15);

$excel->setActiveSheetIndex(5)->setCellValue('A17', "NO");
$excel->getActiveSheet()->mergeCells('A17:A19');
$excel->getActiveSheet()->getStyle('A17:A19')->applyFromArray($style_col);
$excel->setActiveSheetIndex(5)->setCellValue('B17', "AKUN");
$excel->getActiveSheet()->mergeCells('B17:B19');
$excel->getActiveSheet()->getStyle('B17:B19')->applyFromArray($style_col);
$excel->setActiveSheetIndex(5)->setCellValue('C17', "PENERIMA");
$excel->getActiveSheet()->mergeCells('C17:D19');
$excel->getActiveSheet()->getStyle('C17:D19')->applyFromArray($style_col);
$excel->setActiveSheetIndex(5)->setCellValue('E17', "URAIAN");
$excel->getActiveSheet()->mergeCells('E17:G19');
$excel->getActiveSheet()->getStyle('E17:G19')->applyFromArray($style_col);
$excel->setActiveSheetIndex(5)->setCellValue('H17', "JUMLAH");
$excel->getActiveSheet()->mergeCells('H17:H19');
$excel->getActiveSheet()->getStyle('H17:H19')->applyFromArray($style_col);
$excel->setActiveSheetIndex(5)->setCellValue('I17', "PAJAK YANG DIPUNGUT");
$excel->getActiveSheet()->mergeCells('I17:J18');
$excel->getActiveSheet()->getStyle('I17:J18')->applyFromArray($style_col);
$excel->setActiveSheetIndex(5)->setCellValue('I19', 'PPN');
$excel->setActiveSheetIndex(5)->setCellValue('J19', 'PPh');
$excel->getActiveSheet()->getStyle('I19')->applyFromArray($style_col);
$excel->getActiveSheet()->getStyle('J19')->applyFromArray($style_col);

$excel->setActiveSheetIndex(5)->setCellValue('A20', "1");
$excel->getActiveSheet()->getStyle('A20')->applyFromArray($style_col);
$excel->setActiveSheetIndex(5)->setCellValue('B20', "2");
$excel->getActiveSheet()->getStyle('B20')->applyFromArray($style_col);
$excel->setActiveSheetIndex(5)->setCellValue('C20', "3");
$excel->getActiveSheet()->mergeCells('C20:D20');
$excel->getActiveSheet()->getStyle('C20:D20')->applyFromArray($style_col);
$excel->setActiveSheetIndex(5)->setCellValue('E20', "4");
$excel->getActiveSheet()->mergeCells('E20:G20');
$excel->getActiveSheet()->getStyle('E20:G20')->applyFromArray($style_col);
$excel->setActiveSheetIndex(5)->setCellValue('H20', "5");
$excel->getActiveSheet()->getStyle('H20')->applyFromArray($style_col);
$excel->setActiveSheetIndex(5)->setCellValue('I20', '6');
$excel->setActiveSheetIndex(5)->setCellValue('J20', '7');
$excel->getActiveSheet()->getStyle('I20')->applyFromArray($style_col);
$excel->getActiveSheet()->getStyle('J20')->applyFromArray($style_col);

$excel->getActiveSheet()->getStyle('A21')->applyFromArray($style_row_tengah);
$excel->getActiveSheet()->getStyle('B21')->applyFromArray($style_row_tengah);
$excel->getActiveSheet()->getStyle('C21:D21')->applyFromArray($style_row_tengah);
$excel->getActiveSheet()->getStyle('E21:G21')->applyFromArray($style_row_tengah);
$excel->getActiveSheet()->getStyle('H21')->applyFromArray($style_row_tengah);
$excel->getActiveSheet()->getStyle('I21')->applyFromArray($style_row_tengah);
$excel->getActiveSheet()->getStyle('J21')->applyFromArray($style_row_tengah);

$rowAwal = 21;
$noAwal = 1;

$cekPengarahEks = mysqli_query($myConnection, "select * from tb_pengarah_keg_hotel where jenis_pengarah = 'eksternal'");

if (mysqli_num_rows($cekPengarahEks) > 0) {
    //pengarah 22
    $excel->setActiveSheetIndex(5)->setCellValue('A' . ($rowAwal + 1), $noAwal);
    $excel->getActiveSheet()->getStyle('A' . ($rowAwal + 1))->applyFromArray($style_row_tengah);
    $excel->getActiveSheet()->getStyle('A' . ($rowAwal + 1))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $excel->setActiveSheetIndex(5)->setCellValue('B' . ($rowAwal + 1), $viewPerjadin['mak_hr_pengarah']);
    $excel->getActiveSheet()->getStyle('B' . ($rowAwal + 1))->applyFromArray($style_row_tengah);
    $excel->getActiveSheet()->getStyle('B' . ($rowAwal + 1))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $excel->setActiveSheetIndex(5)->setCellValue('C' . ($rowAwal + 1), $namaHonorPengarah);
    $excel->getActiveSheet()->mergeCells('C' . ($rowAwal + 1) . ':D' . ($rowAwal + 1));
    $excel->getActiveSheet()->getStyle('C' . ($rowAwal + 1))->applyFromArray($style_row_tengah);
    $excel->setActiveSheetIndex(5)->setCellValue('E' . ($rowAwal + 1), 'Honor Pengarah');
    $excel->getActiveSheet()->mergeCells('E' . ($rowAwal + 1) . ':G' . ($rowAwal + 1));
    $excel->getActiveSheet()->getStyle('E' . ($rowAwal + 1) . ':G' . ($rowAwal + 1))->applyFromArray($style_row_tengah);
    $excel->setActiveSheetIndex(5)->setCellValue('H' . ($rowAwal + 1), $allHonorPengarah);
    $excel->getActiveSheet()->getStyle('H' . ($rowAwal + 1))->applyFromArray($style_row_tengah);
    $excel->getActiveSheet()->getStyle('H' . ($rowAwal + 1))->getNumberFormat()->setFormatCode("#,##0");
    $excel->setActiveSheetIndex(5)->setCellValue('I' . ($rowAwal + 1), $allPajakPengarah);
    $excel->getActiveSheet()->getStyle('I' . ($rowAwal + 1))->applyFromArray($style_row_tengah);
    $excel->getActiveSheet()->getStyle('I' . ($rowAwal + 1))->getNumberFormat()->setFormatCode("#,##0");
    $excel->setActiveSheetIndex(5)->setCellValue('J' . ($rowAwal + 1), $allBiayaPengarah);
    $excel->getActiveSheet()->getStyle('J' . ($rowAwal + 1))->applyFromArray($style_row_tengah);
    $excel->getActiveSheet()->getStyle('J' . ($rowAwal + 1))->getNumberFormat()->setFormatCode("#,##0");
    $excel->getActiveSheet()->getStyle('A' . ($rowAwal + 2) . ':A' . ($rowAwal + 4))->applyFromArray($style_row_tengah);
    $excel->getActiveSheet()->getStyle('B' . ($rowAwal + 2) . ':B' . ($rowAwal + 4))->applyFromArray($style_row_tengah);
    $excel->getActiveSheet()->getStyle('C' . ($rowAwal + 2) . ':D' . ($rowAwal + 4))->applyFromArray($style_row_tengah);
    $excel->setActiveSheetIndex(5)->setCellValue('E' . ($rowAwal + 2), $viewPerjadin['nama_keg_kuitansi']);
    $excel->getActiveSheet()->mergeCells('E' . ($rowAwal + 2) . ':G' . ($rowAwal + 4));
    $excel->getActiveSheet()->getStyle('E' . ($rowAwal + 2) . ':G' . ($rowAwal + 4))->applyFromArray($style_row_tengah);
    $excel->getActiveSheet()->getStyle('H' . ($rowAwal + 2) . ':H' . ($rowAwal + 4))->applyFromArray($style_row_tengah);
    $excel->getActiveSheet()->getStyle('I' . ($rowAwal + 2) . ':I' . ($rowAwal + 4))->applyFromArray($style_row_tengah);
    $excel->getActiveSheet()->getStyle('J' . ($rowAwal + 2) . ':J' . ($rowAwal + 4))->applyFromArray($style_row_tengah);

    $excel->getActiveSheet()->getStyle('A' . ($rowAwal + 5))->applyFromArray($style_row_tengah);
    $excel->getActiveSheet()->getStyle('B' . ($rowAwal + 5))->applyFromArray($style_row_tengah);
    $excel->getActiveSheet()->getStyle('C' . ($rowAwal + 5) . ':D' . ($rowAwal + 5))->applyFromArray($style_row_tengah);
    $excel->getActiveSheet()->getStyle('E' . ($rowAwal + 5) . ':G' . ($rowAwal + 5))->applyFromArray($style_row_tengah);
    $excel->getActiveSheet()->getStyle('H' . ($rowAwal + 5))->applyFromArray($style_row_tengah);
    $excel->getActiveSheet()->getStyle('I' . ($rowAwal + 5))->applyFromArray($style_row_tengah);
    $excel->getActiveSheet()->getStyle('J' . ($rowAwal + 5))->applyFromArray($style_row_tengah);

    $rowAwal = $rowAwal + 5;
    $noAwal = $noAwal + 1;
}

$excel->setActiveSheetIndex(5)->setCellValue('A' . ($rowAwal + 1), $noAwal);
$excel->getActiveSheet()->getStyle('A' . ($rowAwal + 1))->applyFromArray($style_row_tengah);
$excel->getActiveSheet()->getStyle('A' . ($rowAwal + 1))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$excel->setActiveSheetIndex(5)->setCellValue('B' . ($rowAwal + 1), $viewPerjadin['mak_hr_narsum_e']);
$excel->getActiveSheet()->getStyle('B' . ($rowAwal + 1))->applyFromArray($style_row_tengah);
$excel->getActiveSheet()->getStyle('B' . ($rowAwal + 1))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$excel->setActiveSheetIndex(5)->setCellValue('C' . ($rowAwal + 1), $namaHonorNarsum);
$excel->getActiveSheet()->mergeCells('C' . ($rowAwal + 1) . ':D' . ($rowAwal + 1));
$excel->getActiveSheet()->getStyle('C' . ($rowAwal + 1))->applyFromArray($style_row_tengah);
$excel->setActiveSheetIndex(5)->setCellValue('E' . ($rowAwal + 1), 'Honor Narasumber');
$excel->getActiveSheet()->mergeCells('E' . ($rowAwal + 1) . ':G' . ($rowAwal + 1));
$excel->getActiveSheet()->getStyle('E' . ($rowAwal + 1) . ':G' . ($rowAwal + 1))->applyFromArray($style_row_tengah);
$excel->setActiveSheetIndex(5)->setCellValue('H' . ($rowAwal + 1), $allHonorNarsum);
$excel->getActiveSheet()->getStyle('H' . ($rowAwal + 1))->applyFromArray($style_row_tengah);
$excel->getActiveSheet()->getStyle('H' . ($rowAwal + 1))->getNumberFormat()->setFormatCode("#,##0");
$excel->setActiveSheetIndex(5)->setCellValue('I' . ($rowAwal + 1), $allPajakNarsum);
$excel->getActiveSheet()->getStyle('I' . ($rowAwal + 1))->applyFromArray($style_row_tengah);
$excel->getActiveSheet()->getStyle('I' . ($rowAwal + 1))->getNumberFormat()->setFormatCode("#,##0");
$excel->setActiveSheetIndex(5)->setCellValue('J' . ($rowAwal + 1), $allBiayaNarsum);
$excel->getActiveSheet()->getStyle('J' . ($rowAwal + 1))->applyFromArray($style_row_tengah);
$excel->getActiveSheet()->getStyle('J' . ($rowAwal + 1))->getNumberFormat()->setFormatCode("#,##0");
$excel->getActiveSheet()->getStyle('A' . ($rowAwal + 2) . ':A' . ($rowAwal + 4))->applyFromArray($style_row_tengah);
$excel->getActiveSheet()->getStyle('B' . ($rowAwal + 2) . ':B' . ($rowAwal + 4))->applyFromArray($style_row_tengah);
$excel->setActiveSheetIndex(5)->setCellValue('C' . ($rowAwal + 2), 'Cs');
$excel->setActiveSheetIndex(5)->setCellValue('D' . ($rowAwal + 2), $jmlNarsumOrang . ' Orang');
$excel->getActiveSheet()->getStyle('C' . ($rowAwal + 2) . ':D' . ($rowAwal + 4))->applyFromArray($style_row_tengah);
$excel->setActiveSheetIndex(5)->setCellValue('E' . ($rowAwal + 2), $viewPerjadin['nama_keg_kuitansi']);
$excel->getActiveSheet()->mergeCells('E' . ($rowAwal + 2) . ':G' . ($rowAwal + 4));
$excel->getActiveSheet()->getStyle('E' . ($rowAwal + 2) . ':G' . ($rowAwal + 4))->applyFromArray($style_row_tengah);
$excel->getActiveSheet()->getStyle('H' . ($rowAwal + 2) . ':H' . ($rowAwal + 4))->applyFromArray($style_row_tengah);
$excel->getActiveSheet()->getStyle('I' . ($rowAwal + 2) . ':I' . ($rowAwal + 4))->applyFromArray($style_row_tengah);
$excel->getActiveSheet()->getStyle('J' . ($rowAwal + 2) . ':J' . ($rowAwal + 4))->applyFromArray($style_row_tengah);

$excel->getActiveSheet()->getStyle('A' . ($rowAwal + 5))->applyFromArray($style_row_tengah);
$excel->getActiveSheet()->getStyle('B' . ($rowAwal + 5))->applyFromArray($style_row_tengah);
$excel->getActiveSheet()->getStyle('C' . ($rowAwal + 5) . ':D' . ($rowAwal + 5))->applyFromArray($style_row_tengah);
$excel->getActiveSheet()->getStyle('E' . ($rowAwal + 5) . ':G' . ($rowAwal + 5))->applyFromArray($style_row_tengah);
$excel->getActiveSheet()->getStyle('H' . ($rowAwal + 5))->applyFromArray($style_row_tengah);
$excel->getActiveSheet()->getStyle('I' . ($rowAwal + 5))->applyFromArray($style_row_tengah);
$excel->getActiveSheet()->getStyle('J' . ($rowAwal + 5))->applyFromArray($style_row_tengah);


$excel->setActiveSheetIndex(5)->setCellValue('A' . ($rowAwal + 6), $noAwal + 1);
$excel->getActiveSheet()->getStyle('A' . ($rowAwal + 6))->applyFromArray($style_row_tengah);
$excel->getActiveSheet()->getStyle('A' . ($rowAwal + 6))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$excel->setActiveSheetIndex(5)->setCellValue('B' . ($rowAwal + 6), $viewPerjadin['mak_hr_panitia']);
$excel->getActiveSheet()->getStyle('B' . ($rowAwal + 6))->applyFromArray($style_row_tengah);
$excel->getActiveSheet()->getStyle('B' . ($rowAwal + 6))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$excel->setActiveSheetIndex(5)->setCellValue('C' . ($rowAwal + 6), $namaHonorPanitia);
$excel->getActiveSheet()->mergeCells('C' . ($rowAwal + 6) . ':D' . ($rowAwal + 6));
$excel->getActiveSheet()->getStyle('C' . ($rowAwal + 6))->applyFromArray($style_row_tengah);
$excel->setActiveSheetIndex(5)->setCellValue('E' . ($rowAwal + 6), 'Honor Penanggungjawab dan Panitia');
$excel->getActiveSheet()->mergeCells('E' . ($rowAwal + 6) . ':G' . ($rowAwal + 6));
$excel->getActiveSheet()->getStyle('E' . ($rowAwal + 6) . ':G' . ($rowAwal + 6))->applyFromArray($style_row_tengah);
$excel->setActiveSheetIndex(5)->setCellValue('H' . ($rowAwal + 6), $allHonorPanitia);
$excel->getActiveSheet()->getStyle('H' . ($rowAwal + 6))->applyFromArray($style_row_tengah);
$excel->getActiveSheet()->getStyle('H' . ($rowAwal + 6))->getNumberFormat()->setFormatCode("#,##0");
$excel->setActiveSheetIndex(5)->setCellValue('I' . ($rowAwal + 6), $allPajakPanitia);
$excel->getActiveSheet()->getStyle('I' . ($rowAwal + 6))->applyFromArray($style_row_tengah);
$excel->getActiveSheet()->getStyle('I' . ($rowAwal + 6))->getNumberFormat()->setFormatCode("#,##0");
$excel->setActiveSheetIndex(5)->setCellValue('J' . ($rowAwal + 6), $allBiayaPanitia);
$excel->getActiveSheet()->getStyle('J' . ($rowAwal + 6))->applyFromArray($style_row_tengah);
$excel->getActiveSheet()->getStyle('J' . ($rowAwal + 6))->getNumberFormat()->setFormatCode("#,##0");
$excel->getActiveSheet()->getStyle('A' . ($rowAwal + 7) . ':A' . ($rowAwal + 9))->applyFromArray($style_row_tengah);
$excel->getActiveSheet()->getStyle('B' . ($rowAwal + 7) . ':B' . ($rowAwal + 9))->applyFromArray($style_row_tengah);
$excel->setActiveSheetIndex(5)->setCellValue('C' . ($rowAwal + 7), 'Cs');
$excel->setActiveSheetIndex(5)->setCellValue('D' . ($rowAwal + 7), $jmlPanitiaOrang . ' Orang');
$excel->getActiveSheet()->getStyle('C' . ($rowAwal + 7) . ':D' . ($rowAwal + 9))->applyFromArray($style_row_tengah);
$excel->setActiveSheetIndex(5)->setCellValue('E' . ($rowAwal + 7), $viewPerjadin['nama_keg_kuitansi']);
$excel->getActiveSheet()->mergeCells('E' . ($rowAwal + 7) . ':G' . ($rowAwal + 9));
$excel->getActiveSheet()->getStyle('E' . ($rowAwal + 7) . ':G' . ($rowAwal + 9))->applyFromArray($style_row_tengah);
$excel->getActiveSheet()->getStyle('H' . ($rowAwal + 7) . ':H' . ($rowAwal + 9))->applyFromArray($style_row_tengah);
$excel->getActiveSheet()->getStyle('I' . ($rowAwal + 7) . ':I' . ($rowAwal + 9))->applyFromArray($style_row_tengah);
$excel->getActiveSheet()->getStyle('J' . ($rowAwal + 7) . ':J' . ($rowAwal + 9))->applyFromArray($style_row_tengah);

$excel->getActiveSheet()->getStyle('A' . ($rowAwal + 10))->applyFromArray($style_row_tengah);
$excel->getActiveSheet()->getStyle('B' . ($rowAwal + 10))->applyFromArray($style_row_tengah);
$excel->getActiveSheet()->getStyle('C' . ($rowAwal + 10) . ':D' . ($rowAwal + 10))->applyFromArray($style_row_tengah);
$excel->getActiveSheet()->getStyle('E' . ($rowAwal + 10) . ':G' . ($rowAwal + 10))->applyFromArray($style_row_tengah);
$excel->getActiveSheet()->getStyle('H' . ($rowAwal + 10))->applyFromArray($style_row_tengah);
$excel->getActiveSheet()->getStyle('I' . ($rowAwal + 10))->applyFromArray($style_row_tengah);
$excel->getActiveSheet()->getStyle('J' . ($rowAwal + 10))->applyFromArray($style_row_tengah);

$excel->getActiveSheet()->getStyle('A' . ($rowAwal + 11) . ':A' . ($rowAwal + 12))->applyFromArray($style_row_tengah);
$excel->getActiveSheet()->getStyle('B' . ($rowAwal + 11) . ':B' . ($rowAwal + 12))->applyFromArray($style_row_tengah);
$excel->getActiveSheet()->getStyle('C' . ($rowAwal + 11) . ':D' . ($rowAwal + 12))->applyFromArray($style_row_tengah);
$excel->getActiveSheet()->getStyle('E' . ($rowAwal + 11) . ':G' . ($rowAwal + 12))->applyFromArray($style_row_tengah);
$excel->getActiveSheet()->getStyle('H' . ($rowAwal + 11) . ':H' . ($rowAwal + 12))->applyFromArray($style_row_tengah);
$excel->getActiveSheet()->getStyle('I' . ($rowAwal + 11) . ':I' . ($rowAwal + 12))->applyFromArray($style_row_tengah);
$excel->getActiveSheet()->getStyle('J' . ($rowAwal + 11) . ':J' . ($rowAwal + 12))->applyFromArray($style_row_tengah);

$excel->getActiveSheet()->getStyle('A' . ($rowAwal + 13) . ':B' . ($rowAwal + 13))->applyFromArray($style_col_foot);
$excel->setActiveSheetIndex(5)->setCellValue('C' . ($rowAwal + 13), 'Jumlah');
$excel->getActiveSheet()->getStyle('C' . ($rowAwal + 13) . ':G' . ($rowAwal + 13))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$excel->getActiveSheet()->mergeCells('C' . ($rowAwal + 13) . ':G' . ($rowAwal + 13));
$excel->getActiveSheet()->getStyle('C' . ($rowAwal + 13) . ':G' . ($rowAwal + 13))->applyFromArray($style_col_foot);
$excel->setActiveSheetIndex(5)->setCellValue('H' . ($rowAwal + 13), $allHonorPengarah + $allHonorNarsum + $allHonorPanitia);
$excel->getActiveSheet()->getStyle('H' . ($rowAwal + 13))->getNumberFormat()->setFormatCode("#,##0");
$excel->setActiveSheetIndex(5)->setCellValue('I' . ($rowAwal + 13), $allPajakPengarah + $allPajakNarsum + $allPajakPanitia);
$excel->getActiveSheet()->getStyle('H' . ($rowAwal + 13))->getNumberFormat()->setFormatCode("#,##0");
$excel->setActiveSheetIndex(5)->setCellValue('J' . ($rowAwal + 13), $allBiayaPengarah + $allBiayaNarsum + $allBiayaPanitia);
$excel->getActiveSheet()->getStyle('H' . ($rowAwal + 13))->getNumberFormat()->setFormatCode("#,##0");
$excel->getActiveSheet()->getStyle('H' . ($rowAwal + 13))->applyFromArray($style_col_foot);
$excel->getActiveSheet()->getStyle('I' . ($rowAwal + 13))->applyFromArray($style_col_foot);
$excel->getActiveSheet()->getStyle('J' . ($rowAwal + 13))->applyFromArray($style_col_foot);


$excel->setActiveSheetIndex(5)->setCellValue('A' . ($rowAwal + 15), 'Bukti-bukti pengeluaran anggaran dan asli setoran pajak (SSP/BPN) tersebut di atas disimpan oleh Pengguna Anggaran/ Kuasa');
$excel->setActiveSheetIndex(5)->setCellValue('A' . ($rowAwal + 16), 'Pengguna Anggaran untuk kelengkapan administrasi dan keperluan pemeriksaan aparat pengawasan fungsional.');
$excel->setActiveSheetIndex(5)->setCellValue('A' . ($rowAwal + 18), 'Demikian Surat Pernyataan ini dibuat dengan sebenarnya.');

$excel->setActiveSheetIndex(5)->setCellValue('H' . ($rowAwal + 20), 'Surabaya, ' . Indonesia2Tgl($viewPerjadin['tgl_sptjb_perjadin']));
$excel->setActiveSheetIndex(5)->setCellValue('H' . ($rowAwal + 21), 'Setuju dibayar :');
$excel->setActiveSheetIndex(5)->setCellValue('H' . ($rowAwal + 22), 'Kuasa Pengguna Anggaran/');
$excel->setActiveSheetIndex(5)->setCellValue('H' . ($rowAwal + 23), 'Pejabat Pembuat Komitmen');
$excel->setActiveSheetIndex(5)->setCellValue('H' . ($rowAwal + 27), $viewPPK['nama_peg']);
$excel->setActiveSheetIndex(5)->setCellValue('H' . ($rowAwal + 28), 'NIP. ' . $viewPPK['nip']);

$excel->getActiveSheet()->getStyle('A' . ($rowAwal + 15) . ':H' . ($rowAwal + 28))->applyFromArray($style_ttd);


$excel->getActiveSheet()->getStyle('A4:H' . ($rowAwal + 28))->getFont()->setSize(11);

$excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
$excel->getActiveSheet(5)->setTitle('SPTJB Honor');
