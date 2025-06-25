<?php
$excel->createSheet();

$allHonorPengarah = 0;
$allPajakPengarah = 0;
$allBiayaPengarah = 0;
$noUrutTugasPengarah = 1;
$numrowHonorPengarah = 9;

$excel->setActiveSheetIndex(4)->setCellValue('A1', "DAFTAR NOMINATIF PENERIMAAN HONORARIUM PENGARAH");
$excel->getActiveSheet()->mergeCells('A1:I1');
$excel->getActiveSheet()->getStyle('A1:I1')->applyFromArray($style_title);
$excel->setActiveSheetIndex(4)->setCellValue('A2', $viewPerjadin['nama_keg_kuitansi']);
$excel->getActiveSheet()->mergeCells('A2:I2');
$excel->getActiveSheet()->getStyle('A2:I2')->applyFromArray($style_title);
$excel->setActiveSheetIndex(4)->setCellValue('A3', 'di ' . $viewPerjadin['tempat_keg']);
$excel->getActiveSheet()->mergeCells('A3:I3');
$excel->getActiveSheet()->getStyle('A3:I3')->applyFromArray($style_title);
$excel->setActiveSheetIndex(4)->setCellValue('A4', "Tanggal : " . Indonesia2Tgl($viewPerjadin['tgl_mulai']) . " s.d " . Indonesia2Tgl($viewPerjadin['tgl_selesai']));
$excel->getActiveSheet()->mergeCells('A4:I4');
$excel->getActiveSheet()->getStyle('A4:I4')->applyFromArray($style_title);
$excel->setActiveSheetIndex(4)->setCellValue('A5', 'Nomor : ' . $viewPerjadin['no_sptjb_perjadin'] . '' . $viewPerjadin['sptjb_perjadin']);
$excel->getActiveSheet()->mergeCells('A5:I5');
$excel->getActiveSheet()->getStyle('A5:I5')->applyFromArray($style_title);

$excel->setActiveSheetIndex(4)->setCellValue('A7', "No");
$excel->getActiveSheet()->mergeCells('A7:A8');
$excel->getActiveSheet()->getStyle('A7:A8')->applyFromArray($style_col);
$excel->setActiveSheetIndex(4)->setCellValue('B7', "Nama");
$excel->getActiveSheet()->mergeCells('B7:B8');
$excel->getActiveSheet()->getStyle('B7:B8')->applyFromArray($style_col);
$excel->setActiveSheetIndex(4)->setCellValue('C7', "NIP");
$excel->getActiveSheet()->mergeCells('C7:C8');
$excel->getActiveSheet()->getStyle('C7:C8')->applyFromArray($style_col);
$excel->setActiveSheetIndex(4)->setCellValue('D7', "Gol");
$excel->getActiveSheet()->mergeCells('D7:D8');
$excel->getActiveSheet()->getStyle('D7:D8')->applyFromArray($style_col);
$excel->setActiveSheetIndex(4)->setCellValue('E7', "Unit Kerja");
$excel->getActiveSheet()->mergeCells('E7:E8');
$excel->getActiveSheet()->getStyle('E7:E8')->applyFromArray($style_col);
$excel->setActiveSheetIndex(4)->setCellValue('F7', "Honorarium");
$excel->setActiveSheetIndex(4)->setCellValue('F8', "Rp");
$excel->getActiveSheet()->getStyle('F7:F8')->applyFromArray($style_col);
$excel->setActiveSheetIndex(4)->setCellValue('G7', "PPH 21");
$excel->getActiveSheet()->mergeCells('G7:G8');
$excel->getActiveSheet()->getStyle('G7:G8')->applyFromArray($style_col);
$excel->setActiveSheetIndex(4)->setCellValue('H7', "Biaya");
$excel->setActiveSheetIndex(4)->setCellValue('H8', "Rp");
$excel->getActiveSheet()->getStyle('H7:H8')->applyFromArray($style_col);
$excel->setActiveSheetIndex(4)->setCellValue('I7', "No");
$excel->setActiveSheetIndex(4)->setCellValue('I8', "Rekening");
$excel->getActiveSheet()->getStyle('I7:I8')->applyFromArray($style_col);

$excel->getActiveSheet()->getStyle('A7:I8')->applyFromArray($styleWarp);

$excel->getActiveSheet()->getColumnDimension('A')->setWidth(5);
$excel->getActiveSheet()->getColumnDimension('B')->setWidth(35);
$excel->getActiveSheet()->getColumnDimension('C')->setWidth(25);
$excel->getActiveSheet()->getColumnDimension('D')->setWidth(4);
$excel->getActiveSheet()->getColumnDimension('E')->setWidth(25);
$excel->getActiveSheet()->getColumnDimension('F')->setWidth(15);
$excel->getActiveSheet()->getColumnDimension('G')->setWidth(12);
$excel->getActiveSheet()->getColumnDimension('H')->setWidth(12);
$excel->getActiveSheet()->getColumnDimension('I')->setWidth(15);



//pengarah
$sqlPengarah =  mysqli_query($myConnection, "select tb_pengarah_keg_hotel.* , tb_kabkota.name as nama_kab
                    from tb_pengarah_keg_hotel
                    left join tb_kabkota on tb_kabkota.id = tb_pengarah_keg_hotel.id_kabkota_unit_kerja
                    where tb_pengarah_keg_hotel.id_keg = '$id_keg'");
while ($viewPengarah = mysqli_fetch_array($sqlPengarah)) {
    $golPajak = $viewPengarah['id_pangkat_gol'];
    $jmlHari = (IntervalDays($viewPengarah['tgl_mulai'], $viewPengarah['tgl_selesai'])) + 1;
    if ($viewPengarah['jenis_pengarah'] == 'internal') {
        $uangHonorPengarah = 0;
    } elseif ($viewPengarah['jenis_pengarah'] == 'eksternal') {
        $uangHonorPengarah = $viewPerjadin['honor_pengarah_e'] == '' ? '0' : $viewPerjadin['honor_pengarah_e'] * $viewPengarah['jml_jam'];
    } else {
        $uangHonorPengarah = 0;
    }
    $pajak = mysqli_fetch_array(mysqli_query($myConnection, "select pajak from tb_gol_pajak where id_pangkat = '$golPajak'"));
    $potonganHonor = ($uangHonorPengarah) * ($pajak['pajak'] / 100);
    $uangHonorPengarahPotongan = $uangHonorPengarah - $potonganHonor;

    $excel->setActiveSheetIndex(4)->setCellValue('A' . $numrowHonorPengarah, $noUrutTugasPengarah);
    $excel->setActiveSheetIndex(4)->setCellValue('B' . $numrowHonorPengarah, $viewPengarah['nama']);
    $excel->setActiveSheetIndex(4)->setCellValueExplicit('C' . $numrowHonorPengarah, $viewPengarah['nip'], PHPExcel_Cell_DataType::TYPE_STRING);
    $excel->setActiveSheetIndex(4)->setCellValue('D' . $numrowHonorPengarah, $viewPengarah['gol']);
    $excel->setActiveSheetIndex(4)->setCellValue('E' . $numrowHonorPengarah, $viewPengarah['jabatan']);
    $excel->setActiveSheetIndex(4)->setCellValue('F' . $numrowHonorPengarah, $uangHonorPengarah);
    $excel->setActiveSheetIndex(4)->setCellValue('G' . $numrowHonorPengarah, $potonganHonor);
    $excel->setActiveSheetIndex(4)->setCellValue('H' . $numrowHonorPengarah, $uangHonorPengarahPotongan);
    $excel->setActiveSheetIndex(4)->setCellValue('I' . $numrowHonorPengarah, '');

    $excel->getActiveSheet()->getStyle('F' . $numrowHonorPengarah)->getNumberFormat()->setFormatCode("#,##0");
    $excel->getActiveSheet()->getStyle('G' . $numrowHonorPengarah)->getNumberFormat()->setFormatCode("#,##0");
    $excel->getActiveSheet()->getStyle('H' . $numrowHonorPengarah)->getNumberFormat()->setFormatCode("#,##0");
    // $excel->getActiveSheet()->getStyle('I' . $numrowHonorPengarah)->getNumberFormat()->setFormatCode("#,##0");

    $excel->getActiveSheet()->getStyle('A' . $numrowHonorPengarah)->applyFromArray($style_row);
    $excel->getActiveSheet()->getStyle('B' . $numrowHonorPengarah)->applyFromArray($style_row);
    $excel->getActiveSheet()->getStyle('C' . $numrowHonorPengarah)->applyFromArray($style_row);
    $excel->getActiveSheet()->getStyle('D' . $numrowHonorPengarah)->applyFromArray($style_row);
    $excel->getActiveSheet()->getStyle('E' . $numrowHonorPengarah)->applyFromArray($style_row);
    $excel->getActiveSheet()->getStyle('F' . $numrowHonorPengarah)->applyFromArray($style_row);
    $excel->getActiveSheet()->getStyle('G' . $numrowHonorPengarah)->applyFromArray($style_row);
    $excel->getActiveSheet()->getStyle('H' . $numrowHonorPengarah)->applyFromArray($style_row);
    $excel->getActiveSheet()->getStyle('I' . $numrowHonorPengarah)->applyFromArray($style_row);

    $excel->getActiveSheet()->getStyle('A' . $numrowHonorPengarah . ':I' . $numrowHonorPengarah)->getFont()->setSize(10);

    $excel->getActiveSheet()->getRowDimension($numrowHonorPengarah)->setRowHeight(15);
    $noUrutTugasPengarah++;
    $numrowHonorPengarah++;

    $namaHonorPengarah = $viewPengarah['nama'];
    $allHonorPengarah = $allHonorPengarah + $uangHonorPengarah;
    $allPajakPengarah = $allPajakPengarah + $potonganHonor;
    $allBiayaPengarah = $allBiayaPengarah + $uangHonorPengarahPotongan;
}


$excel->setActiveSheetIndex(4)->setCellValue('A' . $numrowHonorPengarah, '');
$excel->setActiveSheetIndex(4)->setCellValue('B' . $numrowHonorPengarah, 'Jumlah');
$excel->getActiveSheet()->getStyle('B' . $numrowHonorPengarah)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$excel->setActiveSheetIndex(4)->setCellValue('C' . $numrowHonorPengarah, '');
$excel->setActiveSheetIndex(4)->setCellValue('D' . $numrowHonorPengarah, '');
$excel->setActiveSheetIndex(4)->setCellValue('E' . $numrowHonorPengarah, '');
$excel->setActiveSheetIndex(4)->setCellValue('F' . $numrowHonorPengarah, $allHonorPengarah);
$excel->setActiveSheetIndex(4)->setCellValue('G' . $numrowHonorPengarah, $allPajakPengarah);
$excel->setActiveSheetIndex(4)->setCellValue('H' . $numrowHonorPengarah, $allBiayaPengarah);
$excel->setActiveSheetIndex(4)->setCellValue('I' . $numrowHonorPengarah, '');

$excel->getActiveSheet()->getStyle('F' . $numrowHonorPengarah)->getNumberFormat()->setFormatCode("#,##0");
$excel->getActiveSheet()->getStyle('G' . $numrowHonorPengarah)->getNumberFormat()->setFormatCode("#,##0");
$excel->getActiveSheet()->getStyle('H' . $numrowHonorPengarah)->getNumberFormat()->setFormatCode("#,##0");

$excel->getActiveSheet()->getStyle('A' . $numrowHonorPengarah)->applyFromArray($style_col_foot);
$excel->getActiveSheet()->getStyle('B' . $numrowHonorPengarah)->applyFromArray($style_col_foot);
$excel->getActiveSheet()->getStyle('C' . $numrowHonorPengarah)->applyFromArray($style_col_foot);
$excel->getActiveSheet()->getStyle('D' . $numrowHonorPengarah)->applyFromArray($style_col_foot);
$excel->getActiveSheet()->getStyle('E' . $numrowHonorPengarah)->applyFromArray($style_col_foot);
$excel->getActiveSheet()->getStyle('F' . $numrowHonorPengarah)->applyFromArray($style_col_foot);
$excel->getActiveSheet()->getStyle('G' . $numrowHonorPengarah)->applyFromArray($style_col_foot);
$excel->getActiveSheet()->getStyle('H' . $numrowHonorPengarah)->applyFromArray($style_col_foot);
$excel->getActiveSheet()->getStyle('I' . $numrowHonorPengarah)->applyFromArray($style_col_foot);

$excel->getActiveSheet()->getStyle('A' . $numrowHonorPengarah . ':I' . $numrowHonorPengarah)->getFont()->setSize(10);

// echo $numrowHonorPengarah;
$excel->setActiveSheetIndex(4)->setCellValue('B' . ($numrowHonorPengarah + 3), 'Mengetahui,');
$excel->setActiveSheetIndex(4)->setCellValue('B' . ($numrowHonorPengarah + 4), 'Kuasa Pengguna Anggaran/');
$excel->setActiveSheetIndex(4)->setCellValue('B' . ($numrowHonorPengarah + 5), 'Pejabat Pembuat Komitmen');
$excel->setActiveSheetIndex(4)->setCellValue('B' . ($numrowHonorPengarah + 9), $viewPPK['nama_peg']);
$excel->setActiveSheetIndex(4)->setCellValue('B' . ($numrowHonorPengarah + 10), 'NIP. ' . $viewPPK['nip']);

$excel->setActiveSheetIndex(4)->setCellValue('F' . ($numrowHonorPengarah + 3), 'Surabaya, ' . Indonesia2Tgl($viewPerjadin['tgl_sptjb_perjadin']));
$excel->setActiveSheetIndex(4)->setCellValue('F' . ($numrowHonorPengarah + 4), 'Bendahara Pengeluaran');
$excel->setActiveSheetIndex(4)->setCellValue('F' . ($numrowHonorPengarah + 5), '');
$excel->setActiveSheetIndex(4)->setCellValue('F' . ($numrowHonorPengarah + 9), $viewBendahara['nama_peg']);
$excel->setActiveSheetIndex(4)->setCellValue('F' . ($numrowHonorPengarah + 10), 'NIP. ' . $viewBendahara['nip']);


$excel->getActiveSheet()->getStyle('A' . ($numrowHonorPengarah + 2) . ':F' . ($numrowHonorPengarah + 10))->applyFromArray($style_ttd);
$excel->getActiveSheet()->getStyle('A' . ($numrowHonorPengarah + 2) . ':F' . ($numrowHonorPengarah + 10))->getFont()->setSize(10);


$numrowAkhirHonorPengarah = $numrowHonorPengarah + 12;
$excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
$excel->getActiveSheet(4)->setTitle('NOM Honor');
