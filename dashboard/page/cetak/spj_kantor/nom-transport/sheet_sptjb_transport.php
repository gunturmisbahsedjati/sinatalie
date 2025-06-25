<?php
require_once 'query_sptjb_tranport.php';
$excel->createSheet();

$excel->setActiveSheetIndex(3)->setCellValue('H1', 'Lampiran 1 Perdirjen Perbendaharaan');
$excel->setActiveSheetIndex(3)->setCellValue('H2', 'Nomor Per. 11/PB/2011');
$excel->setActiveSheetIndex(3)->setCellValue('H3', 'Tanggal  : 18 Februari 2011');

$excel->setActiveSheetIndex(3)->setCellValue('A5', 'SURAT PERNYATAAN TANGGUNG JAWAB  BELANJA');
$excel->getActiveSheet()->getStyle('A5')->getFont()->setUnderline(true);
$excel->getActiveSheet()->mergeCells('A5:J5');
$excel->setActiveSheetIndex(3)->setCellValue('A6', 'Nomor : ' . $viewPerjadin['no_sptjb_perjadin'] . '' . $viewPerjadin['sptjb_perjadin']);
$excel->getActiveSheet()->mergeCells('A6:J6');


$excel->getActiveSheet()->getStyle('H1:H3')->applyFromArray($style_ttd);
$excel->getActiveSheet()->getStyle('H1:H3')->getFont()->setSize(10);
$excel->getActiveSheet()->getStyle('A5:J6')->applyFromArray($style_title);

$excel->setActiveSheetIndex(3)->setCellValue('A8', '1');
$excel->getActiveSheet()->getStyle('A8')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$excel->setActiveSheetIndex(3)->setCellValue('B8', 'Nama Satuan Kerja');
$excel->setActiveSheetIndex(3)->setCellValue('F8', ':');
$excel->setActiveSheetIndex(3)->setCellValue('G8', $viewPerjadin['nama_satker']);
$excel->setActiveSheetIndex(3)->setCellValue('A9', '2');
$excel->getActiveSheet()->getStyle('A9')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$excel->setActiveSheetIndex(3)->setCellValue('B9', 'Kode Satuan Kerja');
$excel->setActiveSheetIndex(3)->setCellValue('F9', ':');
$excel->setActiveSheetIndex(3)->setCellValueExplicit('G9', $viewPerjadin['kode_satker'], PHPExcel_Cell_DataType::TYPE_STRING);
$excel->setActiveSheetIndex(3)->setCellValue('A10', '3');
$excel->getActiveSheet()->getStyle('A10')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$excel->setActiveSheetIndex(3)->setCellValue('B10', 'Tanggal/No. DIPA');
$excel->setActiveSheetIndex(3)->setCellValue('F10', ':');
$excel->setActiveSheetIndex(3)->setCellValue('G10', Indonesia2Tgl($viewPerjadin['tgl_dipa']) . ', DIPA - ' . $viewPerjadin['no_dipa']);
$excel->setActiveSheetIndex(3)->setCellValue('A11', '4');
$excel->getActiveSheet()->getStyle('A11')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$excel->setActiveSheetIndex(3)->setCellValue('B11', 'Klasifikasi Anggaran');
$excel->setActiveSheetIndex(3)->setCellValue('F11', ':');
$excel->setActiveSheetIndex(3)->setCellValue('G11', $viewPerjadin['klasifikasi']);

$excel->setActiveSheetIndex(3)->setCellValue('A14', 'BBPMP Provinsi Jawa Timur menyatakan bahwa saya bertanggung jawab secara formal dan material dan kebenaran perhitungan pajak ');
$excel->setActiveSheetIndex(3)->setCellValue('A15', 'atas segala pembayaran tagihan yang telah kami perintahkan dalam SPM ini dengan perincian sebagai berikut :');

$excel->getActiveSheet()->getStyle('A8:G10')->applyFromArray($style_ttd);
$excel->getActiveSheet()->getStyle('A11:J11')->applyFromArray($style_ttd2);
$excel->getActiveSheet()->getStyle('A14:J15')->applyFromArray($style_ttd);
$excel->getActiveSheet()->getColumnDimension('A')->setWidth(6);
$excel->getActiveSheet()->getColumnDimension('B')->setWidth(11);
$excel->getActiveSheet()->getColumnDimension('C')->setWidth(3);
$excel->getActiveSheet()->getColumnDimension('D')->setWidth(26);
$excel->getActiveSheet()->getColumnDimension('E')->setWidth(2);
$excel->getActiveSheet()->getColumnDimension('F')->setWidth(2);
$excel->getActiveSheet()->getColumnDimension('G')->setWidth(47);
$excel->getActiveSheet()->getColumnDimension('H')->setWidth(19);
$excel->getActiveSheet()->getColumnDimension('I')->setWidth(23);
$excel->getActiveSheet()->getColumnDimension('J')->setWidth(15);

$excel->setActiveSheetIndex(3)->setCellValue('A17', "NO");
$excel->getActiveSheet()->mergeCells('A17:A19');
$excel->getActiveSheet()->getStyle('A17:A19')->applyFromArray($style_col);
$excel->setActiveSheetIndex(3)->setCellValue('B17', "AKUN");
$excel->getActiveSheet()->mergeCells('B17:B19');
$excel->getActiveSheet()->getStyle('B17:B19')->applyFromArray($style_col);
$excel->setActiveSheetIndex(3)->setCellValue('C17', "PENERIMA");
$excel->getActiveSheet()->mergeCells('C17:D19');
$excel->getActiveSheet()->getStyle('C17:D19')->applyFromArray($style_col);
$excel->setActiveSheetIndex(3)->setCellValue('E17', "URAIAN");
$excel->getActiveSheet()->mergeCells('E17:G19');
$excel->getActiveSheet()->getStyle('E17:G19')->applyFromArray($style_col);
$excel->setActiveSheetIndex(3)->setCellValue('H17', "JUMLAH");
$excel->getActiveSheet()->mergeCells('H17:H19');
$excel->getActiveSheet()->getStyle('H17:H19')->applyFromArray($style_col);
$excel->setActiveSheetIndex(3)->setCellValue('I17', "PAJAK YANG DIPUNGUT");
$excel->getActiveSheet()->mergeCells('I17:J18');
$excel->getActiveSheet()->getStyle('I17:J18')->applyFromArray($style_col);
$excel->setActiveSheetIndex(3)->setCellValue('I19', 'PPN');
$excel->setActiveSheetIndex(3)->setCellValue('J19', 'PPh');
$excel->getActiveSheet()->getStyle('I19')->applyFromArray($style_col);
$excel->getActiveSheet()->getStyle('J19')->applyFromArray($style_col);

$excel->setActiveSheetIndex(3)->setCellValue('A20', "1");
$excel->getActiveSheet()->getStyle('A20')->applyFromArray($style_col);
$excel->setActiveSheetIndex(3)->setCellValue('B20', "2");
$excel->getActiveSheet()->getStyle('B20')->applyFromArray($style_col);
$excel->setActiveSheetIndex(3)->setCellValue('C20', "3");
$excel->getActiveSheet()->mergeCells('C20:D20');
$excel->getActiveSheet()->getStyle('C20:D20')->applyFromArray($style_col);
$excel->setActiveSheetIndex(3)->setCellValue('E20', "4");
$excel->getActiveSheet()->mergeCells('E20:G20');
$excel->getActiveSheet()->getStyle('E20:G20')->applyFromArray($style_col);
$excel->setActiveSheetIndex(3)->setCellValue('H20', "5");
$excel->getActiveSheet()->getStyle('H20')->applyFromArray($style_col);
$excel->setActiveSheetIndex(3)->setCellValue('I20', '6');
$excel->setActiveSheetIndex(3)->setCellValue('J20', '7');
$excel->getActiveSheet()->getStyle('I20')->applyFromArray($style_col);
$excel->getActiveSheet()->getStyle('J20')->applyFromArray($style_col);

$excel->getActiveSheet()->getStyle('A21')->applyFromArray($style_row_tengah);
$excel->getActiveSheet()->getStyle('B21')->applyFromArray($style_row_tengah);
$excel->getActiveSheet()->getStyle('C21:D21')->applyFromArray($style_row_tengah);
$excel->getActiveSheet()->getStyle('E21:G21')->applyFromArray($style_row_tengah);
$excel->getActiveSheet()->getStyle('H21')->applyFromArray($style_row_tengah);
$excel->getActiveSheet()->getStyle('I21')->applyFromArray($style_row_tengah);
$excel->getActiveSheet()->getStyle('J21')->applyFromArray($style_row_tengah);

//pengarah
$excel->setActiveSheetIndex(3)->setCellValue('A22', "1");
$excel->getActiveSheet()->getStyle('A22')->applyFromArray($style_row_tengah);
$excel->getActiveSheet()->getStyle('A22')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$excel->setActiveSheetIndex(3)->setCellValue('B22', $viewPerjadin['mak_tp_pengarah']);
$excel->getActiveSheet()->getStyle('B22')->applyFromArray($style_row_tengah);
$excel->getActiveSheet()->getStyle('B22')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$excel->setActiveSheetIndex(3)->setCellValue('C22', $namaPengarah);
$excel->getActiveSheet()->mergeCells('C22:D22');
$excel->getActiveSheet()->getStyle('C22')->applyFromArray($style_row_tengah);
$excel->setActiveSheetIndex(3)->setCellValue('E22', 'Biaya Perjalanan Dinas Pengarah');
$excel->getActiveSheet()->mergeCells('E22:G22');
$excel->getActiveSheet()->getStyle('E22:G22')->applyFromArray($style_row_tengah);
$excel->setActiveSheetIndex(3)->setCellValue('H22', $sptjbPengarah);
$excel->getActiveSheet()->getStyle('H22')->applyFromArray($style_row_tengah);
$excel->getActiveSheet()->getStyle('H22')->getNumberFormat()->setFormatCode("#,##0");
$excel->getActiveSheet()->getStyle('I22')->applyFromArray($style_row_tengah);
$excel->getActiveSheet()->getStyle('J22')->applyFromArray($style_row_tengah);
$excel->getActiveSheet()->getStyle('A23:A25')->applyFromArray($style_row_tengah);
$excel->getActiveSheet()->getStyle('B23:B25')->applyFromArray($style_row_tengah);
$excel->getActiveSheet()->getStyle('C23:D25')->applyFromArray($style_row_tengah);
$excel->setActiveSheetIndex(3)->setCellValue('E23', $viewPerjadin['nama_keg_kuitansi']);
$excel->getActiveSheet()->mergeCells('E23:G25');
$excel->getActiveSheet()->getStyle('E23:G25')->applyFromArray($style_row_tengah);
$excel->getActiveSheet()->getStyle('H23:H25')->applyFromArray($style_row_tengah);
$excel->getActiveSheet()->getStyle('I23:I25')->applyFromArray($style_row_tengah);
$excel->getActiveSheet()->getStyle('J23:J25')->applyFromArray($style_row_tengah);

$excel->getActiveSheet()->getStyle('A26')->applyFromArray($style_row_tengah);
$excel->getActiveSheet()->getStyle('B26')->applyFromArray($style_row_tengah);
$excel->getActiveSheet()->getStyle('C26:D26')->applyFromArray($style_row_tengah);
$excel->getActiveSheet()->getStyle('E26:G26')->applyFromArray($style_row_tengah);
$excel->getActiveSheet()->getStyle('H26')->applyFromArray($style_row_tengah);
$excel->getActiveSheet()->getStyle('I26')->applyFromArray($style_row_tengah);
$excel->getActiveSheet()->getStyle('J26')->applyFromArray($style_row_tengah);

//narsum
$excel->setActiveSheetIndex(3)->setCellValue('A27', "2");
$excel->getActiveSheet()->getStyle('A27')->applyFromArray($style_row_tengah);
$excel->getActiveSheet()->getStyle('A27')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$excel->setActiveSheetIndex(3)->setCellValue('B27', $viewPerjadin['mak_tp_narsum_e']);
$excel->getActiveSheet()->getStyle('B27')->applyFromArray($style_row_tengah);
$excel->getActiveSheet()->getStyle('B27')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$excel->setActiveSheetIndex(3)->setCellValue('C27', $namaNarsum);
$excel->getActiveSheet()->mergeCells('C27:D27');
$excel->getActiveSheet()->getStyle('C27')->applyFromArray($style_row_tengah);
$excel->setActiveSheetIndex(3)->setCellValue('E27', 'Biaya Perjalanan Dinas Narasumber');
$excel->getActiveSheet()->mergeCells('E27:G27');
$excel->getActiveSheet()->getStyle('E27:G27')->applyFromArray($style_row_tengah);
$excel->setActiveSheetIndex(3)->setCellValue('H27', $sptjbNarsum);
$excel->getActiveSheet()->getStyle('H27')->applyFromArray($style_row_tengah);
$excel->getActiveSheet()->getStyle('H27')->getNumberFormat()->setFormatCode("#,##0");
$excel->getActiveSheet()->getStyle('I27')->applyFromArray($style_row_tengah);
$excel->getActiveSheet()->getStyle('J27')->applyFromArray($style_row_tengah);
$excel->getActiveSheet()->getStyle('A28:A30')->applyFromArray($style_row_tengah);
$excel->getActiveSheet()->getStyle('B28:B30')->applyFromArray($style_row_tengah);
$excel->setActiveSheetIndex(3)->setCellValue('C28', 'Cs');
$excel->setActiveSheetIndex(3)->setCellValue('D28', $jmlNarsumOrang . ' Orang');
$excel->getActiveSheet()->getStyle('C28:D30')->applyFromArray($style_row_tengah);
$excel->setActiveSheetIndex(3)->setCellValue('E28', $viewPerjadin['nama_keg_kuitansi']);
$excel->getActiveSheet()->mergeCells('E28:G30');
$excel->getActiveSheet()->getStyle('E28:G30')->applyFromArray($style_row_tengah);
$excel->getActiveSheet()->getStyle('H28:H30')->applyFromArray($style_row_tengah);
$excel->getActiveSheet()->getStyle('I28:I30')->applyFromArray($style_row_tengah);
$excel->getActiveSheet()->getStyle('J28:J30')->applyFromArray($style_row_tengah);

$excel->getActiveSheet()->getStyle('A31')->applyFromArray($style_row_tengah);
$excel->getActiveSheet()->getStyle('B31')->applyFromArray($style_row_tengah);
$excel->getActiveSheet()->getStyle('C31:D31')->applyFromArray($style_row_tengah);
$excel->getActiveSheet()->getStyle('E31:G31')->applyFromArray($style_row_tengah);
$excel->getActiveSheet()->getStyle('H31')->applyFromArray($style_row_tengah);
$excel->getActiveSheet()->getStyle('I31')->applyFromArray($style_row_tengah);
$excel->getActiveSheet()->getStyle('J31')->applyFromArray($style_row_tengah);

//panitia
$excel->setActiveSheetIndex(3)->setCellValue('A32', "3");
$excel->getActiveSheet()->getStyle('A32')->applyFromArray($style_row_tengah);
$excel->getActiveSheet()->getStyle('A32')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$excel->setActiveSheetIndex(3)->setCellValue('B32', $viewPerjadin['mak_tp_panitia']);
$excel->getActiveSheet()->getStyle('B32')->applyFromArray($style_row_tengah);
$excel->getActiveSheet()->getStyle('B32')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$excel->setActiveSheetIndex(3)->setCellValue('C32', $namaPanitia);
$excel->getActiveSheet()->mergeCells('C32:D32');
$excel->getActiveSheet()->getStyle('C32')->applyFromArray($style_row_tengah);
$excel->setActiveSheetIndex(3)->setCellValue('E32', 'Biaya Perjalanan Dinas Penanggung Jawab dan Panitia');
$excel->getActiveSheet()->mergeCells('E32:G32');
$excel->getActiveSheet()->getStyle('E32:G32')->applyFromArray($style_row_tengah);
$excel->setActiveSheetIndex(3)->setCellValue('H32', $sptjbPanitia);
$excel->getActiveSheet()->getStyle('H32')->applyFromArray($style_row_tengah);
$excel->getActiveSheet()->getStyle('H32')->getNumberFormat()->setFormatCode("#,##0");
$excel->getActiveSheet()->getStyle('I32')->applyFromArray($style_row_tengah);
$excel->getActiveSheet()->getStyle('J32')->applyFromArray($style_row_tengah);
$excel->getActiveSheet()->getStyle('A33:A35')->applyFromArray($style_row_tengah);
$excel->getActiveSheet()->getStyle('B33:B35')->applyFromArray($style_row_tengah);
$excel->setActiveSheetIndex(3)->setCellValue('C33', 'Cs');
$excel->setActiveSheetIndex(3)->setCellValue('D33', $jmlPanitiaOrang . ' Orang');
$excel->getActiveSheet()->getStyle('C33:D35')->applyFromArray($style_row_tengah);
$excel->setActiveSheetIndex(3)->setCellValue('E33', $viewPerjadin['nama_keg_kuitansi']);
$excel->getActiveSheet()->mergeCells('E33:G35');
$excel->getActiveSheet()->getStyle('E33:G35')->applyFromArray($style_row_tengah);
$excel->getActiveSheet()->getStyle('H33:H35')->applyFromArray($style_row_tengah);
$excel->getActiveSheet()->getStyle('I33:I35')->applyFromArray($style_row_tengah);
$excel->getActiveSheet()->getStyle('J33:J35')->applyFromArray($style_row_tengah);

$excel->getActiveSheet()->getStyle('A36')->applyFromArray($style_row_tengah);
$excel->getActiveSheet()->getStyle('B36')->applyFromArray($style_row_tengah);
$excel->getActiveSheet()->getStyle('C36:D36')->applyFromArray($style_row_tengah);
$excel->getActiveSheet()->getStyle('E36:G36')->applyFromArray($style_row_tengah);
$excel->getActiveSheet()->getStyle('H36')->applyFromArray($style_row_tengah);
$excel->getActiveSheet()->getStyle('I36')->applyFromArray($style_row_tengah);
$excel->getActiveSheet()->getStyle('J36')->applyFromArray($style_row_tengah);

//peserta
$excel->setActiveSheetIndex(3)->setCellValue('A37', "4");
$excel->getActiveSheet()->getStyle('A37')->applyFromArray($style_row_tengah);
$excel->getActiveSheet()->getStyle('A37')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$excel->setActiveSheetIndex(3)->setCellValue('B37', $viewPerjadin['mak_tp_peserta']);
$excel->getActiveSheet()->getStyle('B37')->applyFromArray($style_row_tengah);
$excel->getActiveSheet()->getStyle('B37')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$excel->setActiveSheetIndex(3)->setCellValue('C37', 'Peserta');
$excel->getActiveSheet()->mergeCells('C37:D37');
$excel->getActiveSheet()->getStyle('C37')->applyFromArray($style_row_tengah);
$excel->setActiveSheetIndex(3)->setCellValue('E37', 'Biaya Perjalanan Dinas  Peserta');
$excel->getActiveSheet()->mergeCells('E37:G37');
$excel->getActiveSheet()->getStyle('E37:G37')->applyFromArray($style_row_tengah);
$excel->setActiveSheetIndex(3)->setCellValue('H37', $sptjbPeserta);
$excel->getActiveSheet()->getStyle('H37')->applyFromArray($style_row_tengah);
$excel->getActiveSheet()->getStyle('H37')->getNumberFormat()->setFormatCode("#,##0");
$excel->getActiveSheet()->getStyle('I37')->applyFromArray($style_row_tengah);
$excel->getActiveSheet()->getStyle('J37')->applyFromArray($style_row_tengah);
$excel->getActiveSheet()->getStyle('A38:A40')->applyFromArray($style_row_tengah);
$excel->getActiveSheet()->getStyle('B38:B40')->applyFromArray($style_row_tengah);
$excel->setActiveSheetIndex(3)->setCellValue('C38', 'Cs');
$excel->setActiveSheetIndex(3)->setCellValue('D38', $jmlPesertaOrang . ' Orang');
$excel->getActiveSheet()->getStyle('C38:D40')->applyFromArray($style_row_tengah);
$excel->setActiveSheetIndex(3)->setCellValue('E38', $viewPerjadin['nama_keg_kuitansi']);
$excel->getActiveSheet()->mergeCells('E38:G40');
$excel->getActiveSheet()->getStyle('E38:G40')->applyFromArray($style_row_tengah);
$excel->getActiveSheet()->getStyle('H38:H40')->applyFromArray($style_row_tengah);
$excel->getActiveSheet()->getStyle('I38:I40')->applyFromArray($style_row_tengah);
$excel->getActiveSheet()->getStyle('J38:J40')->applyFromArray($style_row_tengah);

$excel->getActiveSheet()->getStyle('A41:A42')->applyFromArray($style_row_tengah);
$excel->getActiveSheet()->getStyle('B41:B42')->applyFromArray($style_row_tengah);
$excel->getActiveSheet()->getStyle('C41:D42')->applyFromArray($style_row_tengah);
$excel->getActiveSheet()->getStyle('E41:G42')->applyFromArray($style_row_tengah);
$excel->getActiveSheet()->getStyle('H41:H42')->applyFromArray($style_row_tengah);
$excel->getActiveSheet()->getStyle('I41:I42')->applyFromArray($style_row_tengah);
$excel->getActiveSheet()->getStyle('J41:J42')->applyFromArray($style_row_tengah);

$excel->getActiveSheet()->getStyle('A43:B43')->applyFromArray($style_col_foot);
$excel->setActiveSheetIndex(3)->setCellValue('C43', 'Jumlah');
$excel->getActiveSheet()->getStyle('C43:G43')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$excel->getActiveSheet()->mergeCells('C43:G43');
$excel->getActiveSheet()->getStyle('C43:G43')->applyFromArray($style_col_foot);
$excel->setActiveSheetIndex(3)->setCellValue('H43', $sptjbPengarah + $sptjbNarsum + $sptjbPanitia + $sptjbPeserta);
$excel->getActiveSheet()->getStyle('H43')->getNumberFormat()->setFormatCode("#,##0");
$excel->getActiveSheet()->getStyle('H43')->applyFromArray($style_col_foot);
$excel->getActiveSheet()->getStyle('I43')->applyFromArray($style_col_foot);
$excel->getActiveSheet()->getStyle('J43')->applyFromArray($style_col_foot);


$excel->setActiveSheetIndex(3)->setCellValue('A45', 'Bukti-bukti pengeluaran anggaran dan asli setoran pajak (SSP/BPN) tersebut di atas disimpan oleh Pengguna Anggaran/ Kuasa');
$excel->setActiveSheetIndex(3)->setCellValue('A46', 'Pengguna Anggaran untuk kelengkapan administrasi dan keperluan pemeriksaan aparat pengawasan fungsional.');
$excel->setActiveSheetIndex(3)->setCellValue('A48', 'Demikian Surat Pernyataan ini dibuat dengan sebenarnya.');

$excel->setActiveSheetIndex(3)->setCellValue('H51', 'Surabaya, ' . Indonesia2Tgl($viewPerjadin['tgl_sptjb_perjadin']));
$excel->setActiveSheetIndex(3)->setCellValue('H52', 'Setuju dibayar :');
$excel->setActiveSheetIndex(3)->setCellValue('H53', 'Kuasa Pengguna Anggaran/');
$excel->setActiveSheetIndex(3)->setCellValue('H54', 'Pejabat Pembuat Komitmen');
$excel->setActiveSheetIndex(3)->setCellValue('H58', $viewPPK['nama_peg']);
$excel->setActiveSheetIndex(3)->setCellValue('H59', 'NIP. ' . $viewPPK['nip']);

$excel->getActiveSheet()->getStyle('A45:H59')->applyFromArray($style_ttd);


$excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
$excel->getActiveSheet(3)->setTitle('SPTJB Transport');
