<?php
// $excel->createSheet();

$allHonorNarsum = 0;
$allPajakNarsum = 0;
$allBiayaNarsum = 0;
$noUrutTugasNarsum = 1;
$numrowHonorNarsum = $numrowAkhirHonorPengarah;
$jmlNarsumOrang = 0;

$excel->setActiveSheetIndex(4)->setCellValue('A' . $numrowHonorNarsum, "DAFTAR NOMINATIF PENERIMAAN HONORARIUM NARA SUMBER");
$excel->getActiveSheet()->mergeCells('A' . $numrowHonorNarsum . ':I' . $numrowHonorNarsum);
$excel->getActiveSheet()->getStyle('A' . $numrowHonorNarsum . ':I' . $numrowHonorNarsum)->applyFromArray($style_title);
$excel->setActiveSheetIndex(4)->setCellValue('A' . ($numrowHonorNarsum + 1), $viewPerjadin['nama_keg_kuitansi']);
$excel->getActiveSheet()->mergeCells('A' . ($numrowHonorNarsum + 1) . ':I' . ($numrowHonorNarsum + 1));
$excel->getActiveSheet()->getStyle('A' . ($numrowHonorNarsum + 1) . ':I' . ($numrowHonorNarsum + 1))->applyFromArray($style_title);
$excel->setActiveSheetIndex(4)->setCellValue('A' . ($numrowHonorNarsum + 2), 'di ' . $viewPerjadin['tempat_keg']);
$excel->getActiveSheet()->mergeCells('A' . ($numrowHonorNarsum + 2) . ':I' . ($numrowHonorNarsum + 2));
$excel->getActiveSheet()->getStyle('A' . ($numrowHonorNarsum + 2) . ':I' . ($numrowHonorNarsum + 2))->applyFromArray($style_title);
$excel->setActiveSheetIndex(4)->setCellValue('A' . ($numrowHonorNarsum + 3), "Tanggal : " . Indonesia2Tgl($viewPerjadin['tgl_mulai']) . " s.d " . Indonesia2Tgl($viewPerjadin['tgl_selesai']));
$excel->getActiveSheet()->mergeCells('A' . ($numrowHonorNarsum + 3) . ':I' . ($numrowHonorNarsum + 3));
$excel->getActiveSheet()->getStyle('A' . ($numrowHonorNarsum + 3) . ':I' . ($numrowHonorNarsum + 3))->applyFromArray($style_title);
$excel->setActiveSheetIndex(4)->setCellValue('A' . ($numrowHonorNarsum + 4), 'Nomor : ' . $viewPerjadin['no_sptjb_perjadin'] . '' . $viewPerjadin['sptjb_perjadin']);
$excel->getActiveSheet()->mergeCells('A' . ($numrowHonorNarsum + 4) . ':I' . ($numrowHonorNarsum + 4));
$excel->getActiveSheet()->getStyle('A' . ($numrowHonorNarsum + 4) . ':I' . ($numrowHonorNarsum + 4))->applyFromArray($style_title);

$excel->setActiveSheetIndex(4)->setCellValue('A' . ($numrowHonorNarsum + 6), "No");
$excel->getActiveSheet()->mergeCells('A' . ($numrowHonorNarsum + 6) . ':A' . ($numrowHonorNarsum + 7));
$excel->getActiveSheet()->getStyle('A' . ($numrowHonorNarsum + 6) . ':A' . ($numrowHonorNarsum + 7))->applyFromArray($style_col);
$excel->setActiveSheetIndex(4)->setCellValue('B' . ($numrowHonorNarsum + 6), "Nama");
$excel->getActiveSheet()->mergeCells('B' . ($numrowHonorNarsum + 6) . ':B' . ($numrowHonorNarsum + 7));
$excel->getActiveSheet()->getStyle('B' . ($numrowHonorNarsum + 6) . ':B' . ($numrowHonorNarsum + 7))->applyFromArray($style_col);
$excel->setActiveSheetIndex(4)->setCellValue('C' . ($numrowHonorNarsum + 6), "NIP");
$excel->getActiveSheet()->mergeCells('C' . ($numrowHonorNarsum + 6) . ':C' . ($numrowHonorNarsum + 7));
$excel->getActiveSheet()->getStyle('C' . ($numrowHonorNarsum + 6) . ':C' . ($numrowHonorNarsum + 7))->applyFromArray($style_col);
$excel->setActiveSheetIndex(4)->setCellValue('D' . ($numrowHonorNarsum + 6), "Gol");
$excel->getActiveSheet()->mergeCells('D' . ($numrowHonorNarsum + 6) . ':D' . ($numrowHonorNarsum + 7));
$excel->getActiveSheet()->getStyle('D' . ($numrowHonorNarsum + 6) . ':D' . ($numrowHonorNarsum + 7))->applyFromArray($style_col);
$excel->setActiveSheetIndex(4)->setCellValue('E' . ($numrowHonorNarsum + 6), "Unit Kerja");
$excel->getActiveSheet()->mergeCells('E' . ($numrowHonorNarsum + 6) . ':E' . ($numrowHonorNarsum + 7));
$excel->getActiveSheet()->getStyle('E' . ($numrowHonorNarsum + 6) . ':E' . ($numrowHonorNarsum + 7))->applyFromArray($style_col);
$excel->setActiveSheetIndex(4)->setCellValue('F' . ($numrowHonorNarsum + 6), "Honorarium");
$excel->setActiveSheetIndex(4)->setCellValue('F' . ($numrowHonorNarsum + 7), "Rp");
$excel->getActiveSheet()->getStyle('F' . ($numrowHonorNarsum + 6) . ':F' . ($numrowHonorNarsum + 7))->applyFromArray($style_col);
$excel->setActiveSheetIndex(4)->setCellValue('G' . ($numrowHonorNarsum + 6), "PPH 21");
$excel->getActiveSheet()->mergeCells('G' . ($numrowHonorNarsum + 6) . ':G' . ($numrowHonorNarsum + 7));
$excel->getActiveSheet()->getStyle('G' . ($numrowHonorNarsum + 6) . ':G' . ($numrowHonorNarsum + 7))->applyFromArray($style_col);
$excel->setActiveSheetIndex(4)->setCellValue('H' . ($numrowHonorNarsum + 6), "Biaya");
$excel->setActiveSheetIndex(4)->setCellValue('H' . ($numrowHonorNarsum + 7), "Rp");
$excel->getActiveSheet()->getStyle('H' . ($numrowHonorNarsum + 6) . ':H' . ($numrowHonorNarsum + 7))->applyFromArray($style_col);
$excel->setActiveSheetIndex(4)->setCellValue('I' . ($numrowHonorNarsum + 6), "No");
$excel->setActiveSheetIndex(4)->setCellValue('I' . ($numrowHonorNarsum + 7), "Rekening");
$excel->getActiveSheet()->getStyle('I' . ($numrowHonorNarsum + 6) . ':I' . ($numrowHonorNarsum + 7))->applyFromArray($style_col);

$excel->getActiveSheet()->getStyle('A' . ($numrowHonorNarsum + 6) . ':I' . ($numrowHonorNarsum + 7))->applyFromArray($styleWarp);
// $excel->getActiveSheet()->getColumnDimension('A')->setWidth(5);
// $excel->getActiveSheet()->getColumnDimension('B')->setWidth(35);
// $excel->getActiveSheet()->getColumnDimension('C')->setWidth(25);
// $excel->getActiveSheet()->getColumnDimension('D')->setWidth(4);
// $excel->getActiveSheet()->getColumnDimension('E')->setWidth(25);
// $excel->getActiveSheet()->getColumnDimension('F')->setWidth(15);
// $excel->getActiveSheet()->getColumnDimension('G')->setWidth(12);
// $excel->getActiveSheet()->getColumnDimension('H')->setWidth(12);
// $excel->getActiveSheet()->getColumnDimension('I')->setWidth(15);


$numrowHonorNarsum = $numrowAkhirHonorPengarah + 8;

//pengarah
$sqlNarsum = mysqli_query($myConnection, "select tb_narsum_keg_kantor.* , tb_kabkota.name as nama_kab
from tb_narsum_keg_kantor
left join tb_kabkota on tb_kabkota.id = tb_narsum_keg_kantor.id_kabkota_unit_kerja
where tb_narsum_keg_kantor.id_keg = '$id_keg' and tb_narsum_keg_kantor.jenis_narsum = 'eksternal' order by tb_narsum_keg_kantor.created_date desc");
while ($viewNarsum = mysqli_fetch_array($sqlNarsum)) {
    $golPajakNarsum = $viewNarsum['id_pangkat_gol'];
    if ($viewNarsum['jenis_narsum'] == 'internal') {
        $uangHonorNarsum = 0;
        $makHonorNarsum = $viewPerjadin['mak_hr_narsum_i'];
        $honorPerJamNarsum = 0;
        $jamNarsum = 0;
    } elseif ($viewNarsum['jenis_narsum'] == 'eksternal') {
        if ($viewNarsum['status_internal_kemdikbud'] == 1) {
            $uangHonorNarsum = 0;
            $makHonorNarsum = $viewPerjadin['mak_hr_narsum_i'];
            $makTranportNarsum = $viewPerjadin['mak_tp_narsum_i'];
            $honorPerJamNarsum = 0;
            $jamNarsum = 0;
        } else {
            $uangHonorNarsum = $viewPerjadin['honor_narsum_e'] == '' ? '0' : $viewPerjadin['honor_narsum_e'] * $viewNarsum['jml_jam'];
            $makHonorNarsum = $viewPerjadin['mak_hr_narsum_e'];
            $makTranportNarsum = $viewPerjadin['mak_tp_narsum_e'];
            $honorPerJamNarsum = $viewPerjadin['honor_narsum_e'];
            $jamNarsum = $viewNarsum['jml_jam'];
        }
    } else {
        $uangHonorNarsum = 0;
        $makHonorNarsum = 0;
        $makTranportNarsum = 0;
        $honorPerJamNarsum = 0;
        $jamNarsum = 0;
    }

    $pajakNarsum = mysqli_fetch_array(mysqli_query($myConnection, "select gol,pajak from tb_gol_pajak where id_pangkat = '$golPajakNarsum'"));
    $potonganHonorNarsum = ($uangHonorNarsum) * ($pajakNarsum['pajak'] / 100);
    $uangHonorNarsumPotongan = $uangHonorNarsum - $potonganHonorNarsum;

    $excel->setActiveSheetIndex(4)->setCellValue('A' . $numrowHonorNarsum, $noUrutTugasNarsum);
    $excel->setActiveSheetIndex(4)->setCellValue('B' . $numrowHonorNarsum, $viewNarsum['nama']);
    $excel->setActiveSheetIndex(4)->setCellValueExplicit('C' . $numrowHonorNarsum, $viewNarsum['nip'], PHPExcel_Cell_DataType::TYPE_STRING);
    $excel->setActiveSheetIndex(4)->setCellValue('D' . $numrowHonorNarsum, $viewNarsum['gol']);
    $excel->setActiveSheetIndex(4)->setCellValue('E' . $numrowHonorNarsum, $viewNarsum['jabatan']);
    $excel->setActiveSheetIndex(4)->setCellValue('F' . $numrowHonorNarsum, $uangHonorNarsum);
    $excel->setActiveSheetIndex(4)->setCellValue('G' . $numrowHonorNarsum, $potonganHonorNarsum);
    $excel->setActiveSheetIndex(4)->setCellValue('H' . $numrowHonorNarsum, $uangHonorNarsumPotongan);
    $excel->setActiveSheetIndex(4)->setCellValue('I' . $numrowHonorNarsum, '');

    $excel->getActiveSheet()->getStyle('F' . $numrowHonorNarsum)->getNumberFormat()->setFormatCode("#,##0");
    $excel->getActiveSheet()->getStyle('G' . $numrowHonorNarsum)->getNumberFormat()->setFormatCode("#,##0");
    $excel->getActiveSheet()->getStyle('H' . $numrowHonorNarsum)->getNumberFormat()->setFormatCode("#,##0");
    // $excel->getActiveSheet()->getStyle('I' . $numrowHonorNarsum)->getNumberFormat()->setFormatCode("#,##0");

    $excel->getActiveSheet()->getStyle('A' . $numrowHonorNarsum)->applyFromArray($style_row);
    $excel->getActiveSheet()->getStyle('B' . $numrowHonorNarsum)->applyFromArray($style_row);
    $excel->getActiveSheet()->getStyle('C' . $numrowHonorNarsum)->applyFromArray($style_row);
    $excel->getActiveSheet()->getStyle('D' . $numrowHonorNarsum)->applyFromArray($style_row);
    $excel->getActiveSheet()->getStyle('E' . $numrowHonorNarsum)->applyFromArray($style_row);
    $excel->getActiveSheet()->getStyle('F' . $numrowHonorNarsum)->applyFromArray($style_row);
    $excel->getActiveSheet()->getStyle('G' . $numrowHonorNarsum)->applyFromArray($style_row);
    $excel->getActiveSheet()->getStyle('H' . $numrowHonorNarsum)->applyFromArray($style_row);
    $excel->getActiveSheet()->getStyle('I' . $numrowHonorNarsum)->applyFromArray($style_row);

    $excel->getActiveSheet()->getStyle('A' . $numrowHonorNarsum . ':I' . $numrowHonorNarsum)->getFont()->setSize(10);

    $excel->getActiveSheet()->getRowDimension($numrowHonorNarsum)->setRowHeight(15);
    $noUrutTugasNarsum++;
    $numrowHonorNarsum++;
    $jmlNarsumOrang++;
    $namaHonorNarsum = $viewNarsum['nama'];
    $allHonorNarsum = $allHonorNarsum + $uangHonorNarsum;
    $allPajakNarsum = $allPajakNarsum + $potonganHonorNarsum;
    $allBiayaNarsum = $allBiayaNarsum + $uangHonorNarsumPotongan;
}


$excel->setActiveSheetIndex(4)->setCellValue('A' . $numrowHonorNarsum, '');
$excel->setActiveSheetIndex(4)->setCellValue('B' . $numrowHonorNarsum, 'Jumlah');
$excel->getActiveSheet()->getStyle('B' . $numrowHonorNarsum)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$excel->setActiveSheetIndex(4)->setCellValue('C' . $numrowHonorNarsum, '');
$excel->setActiveSheetIndex(4)->setCellValue('D' . $numrowHonorNarsum, '');
$excel->setActiveSheetIndex(4)->setCellValue('E' . $numrowHonorNarsum, '');
$excel->setActiveSheetIndex(4)->setCellValue('F' . $numrowHonorNarsum, $allHonorNarsum);
$excel->setActiveSheetIndex(4)->setCellValue('G' . $numrowHonorNarsum, $allPajakNarsum);
$excel->setActiveSheetIndex(4)->setCellValue('H' . $numrowHonorNarsum, $allBiayaNarsum);
$excel->setActiveSheetIndex(4)->setCellValue('I' . $numrowHonorNarsum, '');

$excel->getActiveSheet()->getStyle('F' . $numrowHonorNarsum)->getNumberFormat()->setFormatCode("#,##0");
$excel->getActiveSheet()->getStyle('G' . $numrowHonorNarsum)->getNumberFormat()->setFormatCode("#,##0");
$excel->getActiveSheet()->getStyle('H' . $numrowHonorNarsum)->getNumberFormat()->setFormatCode("#,##0");

$excel->getActiveSheet()->getStyle('A' . $numrowHonorNarsum)->applyFromArray($style_col_foot);
$excel->getActiveSheet()->getStyle('B' . $numrowHonorNarsum)->applyFromArray($style_col_foot);
$excel->getActiveSheet()->getStyle('C' . $numrowHonorNarsum)->applyFromArray($style_col_foot);
$excel->getActiveSheet()->getStyle('D' . $numrowHonorNarsum)->applyFromArray($style_col_foot);
$excel->getActiveSheet()->getStyle('E' . $numrowHonorNarsum)->applyFromArray($style_col_foot);
$excel->getActiveSheet()->getStyle('F' . $numrowHonorNarsum)->applyFromArray($style_col_foot);
$excel->getActiveSheet()->getStyle('G' . $numrowHonorNarsum)->applyFromArray($style_col_foot);
$excel->getActiveSheet()->getStyle('H' . $numrowHonorNarsum)->applyFromArray($style_col_foot);
$excel->getActiveSheet()->getStyle('I' . $numrowHonorNarsum)->applyFromArray($style_col_foot);

$excel->getActiveSheet()->getStyle('A' . $numrowHonorNarsum . ':I' . $numrowHonorNarsum)->getFont()->setSize(10);

// echo $numrowHonorNarsum;
$excel->setActiveSheetIndex(4)->setCellValue('B' . ($numrowHonorNarsum + 3), 'Mengetahui,');
$excel->setActiveSheetIndex(4)->setCellValue('B' . ($numrowHonorNarsum + 4), 'Kuasa Pengguna Anggaran/');
$excel->setActiveSheetIndex(4)->setCellValue('B' . ($numrowHonorNarsum + 5), 'Pejabat Pembuat Komitmen');
$excel->setActiveSheetIndex(4)->setCellValue('B' . ($numrowHonorNarsum + 9), $viewPPK['nama_peg']);
$excel->setActiveSheetIndex(4)->setCellValue('B' . ($numrowHonorNarsum + 10), 'NIP. ' . $viewPPK['nip']);

$excel->setActiveSheetIndex(4)->setCellValue('F' . ($numrowHonorNarsum + 3), 'Surabaya, ' . Indonesia2Tgl($viewPerjadin['tgl_sptjb_perjadin']));
$excel->setActiveSheetIndex(4)->setCellValue('F' . ($numrowHonorNarsum + 4), 'Bendahara Pengeluaran');
$excel->setActiveSheetIndex(4)->setCellValue('F' . ($numrowHonorNarsum + 5), '');
$excel->setActiveSheetIndex(4)->setCellValue('F' . ($numrowHonorNarsum + 9), $viewBendahara['nama_peg']);
$excel->setActiveSheetIndex(4)->setCellValue('F' . ($numrowHonorNarsum + 10), 'NIP. ' . $viewBendahara['nip']);


$excel->getActiveSheet()->getStyle('A' . ($numrowHonorNarsum + 2) . ':F' . ($numrowHonorNarsum + 10))->applyFromArray($style_ttd);
$excel->getActiveSheet()->getStyle('A' . ($numrowHonorNarsum + 2) . ':F' . ($numrowHonorNarsum + 10))->getFont()->setSize(10);



$numrowAkhirHonorNarsum = $numrowHonorNarsum + 12;

$excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
// $excel->getActiveSheet(4)->setTitle('Narasumber');
