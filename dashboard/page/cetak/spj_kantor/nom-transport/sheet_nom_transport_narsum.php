<?php
// $excel->createSheet();

$allTransportNarsum = 0;
$allHarianNarsum = 0;
$allPerjadinNarsum = 0;
$allHotelNarsum = 0;
$noUrutTugasNarsum = 1;
$numrowNarsum = $numrowAkhirPengarah;

$excel->setActiveSheetIndex(2)->setCellValue('A' . $numrowNarsum, "Daftar Nominatif Penerimaan Biaya Perjalanan Dinas Nara Sumber");
$excel->getActiveSheet()->mergeCells('A' . $numrowNarsum . ':M' . $numrowNarsum);
$excel->getActiveSheet()->getStyle('A' . $numrowNarsum . ':M' . $numrowNarsum)->applyFromArray($style_title);
$excel->setActiveSheetIndex(2)->setCellValue('A' . ($numrowNarsum + 1), $viewPerjadin['nama_keg_kuitansi']);
$excel->getActiveSheet()->mergeCells('A' . ($numrowNarsum + 1) . ':M' . ($numrowNarsum + 1));
$excel->getActiveSheet()->getStyle('A' . ($numrowNarsum + 1) . ':M' . ($numrowNarsum + 1))->applyFromArray($style_title);
$excel->setActiveSheetIndex(2)->setCellValue('A' . ($numrowNarsum + 2), 'di ' . $viewPerjadin['tempat_keg']);
$excel->getActiveSheet()->mergeCells('A' . ($numrowNarsum + 2) . ':M' . ($numrowNarsum + 2));
$excel->getActiveSheet()->getStyle('A' . ($numrowNarsum + 2) . ':M' . ($numrowNarsum + 2))->applyFromArray($style_title);
$excel->setActiveSheetIndex(2)->setCellValue('A' . ($numrowNarsum + 3), "Tanggal : " . Indonesia2Tgl($viewPerjadin['tgl_mulai']) . " s.d " . Indonesia2Tgl($viewPerjadin['tgl_selesai']));
$excel->getActiveSheet()->mergeCells('A' . ($numrowNarsum + 3) . ':M' . ($numrowNarsum + 3));
$excel->getActiveSheet()->getStyle('A' . ($numrowNarsum + 3) . ':M' . ($numrowNarsum + 3))->applyFromArray($style_title);
$excel->setActiveSheetIndex(2)->setCellValue('A' . ($numrowNarsum + 4), 'Nomor : ' . $viewPerjadin['no_sptjb_perjadin'] . '' . $viewPerjadin['sptjb_perjadin']);
$excel->getActiveSheet()->mergeCells('A' . ($numrowNarsum + 4) . ':M' . ($numrowNarsum + 4));
$excel->getActiveSheet()->getStyle('A' . ($numrowNarsum + 4) . ':M' . ($numrowNarsum + 4))->applyFromArray($style_title);

$excel->setActiveSheetIndex(2)->setCellValue('A' . ($numrowNarsum + 6), "No");
$excel->getActiveSheet()->mergeCells('A' . ($numrowNarsum + 6) . ':A' . ($numrowNarsum + 7));
$excel->getActiveSheet()->getStyle('A' . ($numrowNarsum + 6) . ':A' . ($numrowNarsum + 7))->applyFromArray($style_col);
$excel->setActiveSheetIndex(2)->setCellValue('B' . ($numrowNarsum + 6), "Nama");
$excel->getActiveSheet()->mergeCells('B' . ($numrowNarsum + 6) . ':B' . ($numrowNarsum + 7));
$excel->getActiveSheet()->getStyle('B' . ($numrowNarsum + 6) . ':B' . ($numrowNarsum + 7))->applyFromArray($style_col);
$excel->setActiveSheetIndex(2)->setCellValue('C' . ($numrowNarsum + 6), "Gol");
$excel->getActiveSheet()->mergeCells('C' . ($numrowNarsum + 6) . ':C' . ($numrowNarsum + 7));
$excel->getActiveSheet()->getStyle('C' . ($numrowNarsum + 6) . ':C' . ($numrowNarsum + 7))->applyFromArray($style_col);
$excel->setActiveSheetIndex(2)->setCellValue('D' . ($numrowNarsum + 6), "Asal\nDaerah/Kota");
$excel->getActiveSheet()->mergeCells('D' . ($numrowNarsum + 6) . ':D' . ($numrowNarsum + 7));
$excel->getActiveSheet()->getStyle('D' . ($numrowNarsum + 6) . ':D' . ($numrowNarsum + 7))->applyFromArray($style_col);
$excel->setActiveSheetIndex(2)->setCellValue('E' . ($numrowNarsum + 6), "Tujuan");
$excel->getActiveSheet()->mergeCells('E' . ($numrowNarsum + 6) . ':E' . ($numrowNarsum + 7));
$excel->getActiveSheet()->getStyle('E' . ($numrowNarsum + 6) . ':E' . ($numrowNarsum + 7))->applyFromArray($style_col);
$excel->setActiveSheetIndex(2)->setCellValue('F' . ($numrowNarsum + 6), "Tanggal");
$excel->getActiveSheet()->mergeCells('F' . ($numrowNarsum + 6) . ':G' . ($numrowNarsum + 6));
$excel->getActiveSheet()->getStyle('F' . ($numrowNarsum + 6) . ':G' . ($numrowNarsum + 6))->applyFromArray($style_col);
$excel->setActiveSheetIndex(2)->setCellValue('F' . ($numrowNarsum + 7), "Berangkat");
$excel->getActiveSheet()->getStyle('F' . ($numrowNarsum + 7))->applyFromArray($style_col);
$excel->setActiveSheetIndex(2)->setCellValue('G' . ($numrowNarsum + 7), "Pulang");
$excel->getActiveSheet()->getStyle('G' . ($numrowNarsum + 7))->applyFromArray($style_col);
$excel->setActiveSheetIndex(2)->setCellValue('H' . ($numrowNarsum + 6), "Lama\nPerjalanan");
$excel->getActiveSheet()->mergeCells('H' . ($numrowNarsum + 6) . ':H' . ($numrowNarsum + 7));
$excel->getActiveSheet()->getStyle('H' . ($numrowNarsum + 6) . ':H' . ($numrowNarsum + 7))->applyFromArray($style_col);
$excel->setActiveSheetIndex(2)->setCellValue('I' . ($numrowNarsum + 6), "Transport");
$excel->getActiveSheet()->mergeCells('I' . ($numrowNarsum + 6) . ':I' . ($numrowNarsum + 7));
$excel->getActiveSheet()->getStyle('I' . ($numrowNarsum + 6) . ':I' . ($numrowNarsum + 7))->applyFromArray($style_col);
$excel->setActiveSheetIndex(2)->setCellValue('J' . ($numrowNarsum + 6), "Uang\nHarian");
$excel->getActiveSheet()->mergeCells('J' . ($numrowNarsum + 6) . ':J' . ($numrowNarsum + 7));
$excel->getActiveSheet()->getStyle('J' . ($numrowNarsum + 6) . ':J' . ($numrowNarsum + 7))->applyFromArray($style_col);
$excel->setActiveSheetIndex(2)->setCellValue('K' . ($numrowNarsum + 6), "Penginapan");
$excel->getActiveSheet()->mergeCells('K' . ($numrowNarsum + 6) . ':K' . ($numrowNarsum + 7));
$excel->getActiveSheet()->getStyle('K' . ($numrowNarsum + 6) . ':K' . ($numrowNarsum + 7))->applyFromArray($style_col);
$excel->setActiveSheetIndex(2)->setCellValue('L' . ($numrowNarsum + 6), "Biaya\nRp.");
$excel->getActiveSheet()->mergeCells('L' . ($numrowNarsum + 6) . ':L' . ($numrowNarsum + 7));
$excel->getActiveSheet()->getStyle('L' . ($numrowNarsum + 6) . ':L' . ($numrowNarsum + 7))->applyFromArray($style_col);
$excel->setActiveSheetIndex(2)->setCellValue('M' . ($numrowNarsum + 6), "No.\nRekening");
$excel->getActiveSheet()->mergeCells('M' . ($numrowNarsum + 6) . ':M' . ($numrowNarsum + 7));
$excel->getActiveSheet()->getStyle('M' . ($numrowNarsum + 6) . ':M' . ($numrowNarsum + 7))->applyFromArray($style_col);

$excel->getActiveSheet()->getStyle('A' . ($numrowNarsum + 6) . ':M' . ($numrowNarsum + 7))->applyFromArray($styleWarp);

// $excel->getActiveSheet()->getColumnDimension('A')->setWidth(5);
// $excel->getActiveSheet()->getColumnDimension('B')->setWidth(35);
// $excel->getActiveSheet()->getColumnDimension('C')->setWidth(4);
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

$excel->getActiveSheet()->getRowDimension($numrowNarsum + 6)->setRowHeight(20);
$excel->getActiveSheet()->getRowDimension($numrowNarsum + 7)->setRowHeight(20);

$numrowNarsum = $numrowAkhirPengarah + 8;
$sqlNarsum = mysqli_query($myConnection, "select tb_narsum_keg_kantor.* , tb_kabkota.name as nama_kab
from tb_narsum_keg_kantor
left join tb_kabkota on tb_kabkota.id = tb_narsum_keg_kantor.id_kabkota_unit_kerja
where tb_narsum_keg_kantor.id_keg = '$id_keg' ");
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
        $class = 'fw-bold text-danger';
        $titleTransport = 'Total Transport Riil : ' . format_angka($totalTransport);
    } else {
        $transportNarsum = $totalTransportNarsum;
        $class = '';
        $titleTransport = '';
    }

    $jmlPerjadinNarsum = $transportNarsum + $uangHarianNarsum + $hotel;
    $TotalNarsum = $transportNarsum + $uangHarianNarsum + $uangHonorNarsumPotongan + $hotel;

    $excel->setActiveSheetIndex(2)->setCellValue('A' . $numrowNarsum, $noUrutTugasNarsum);
    $excel->setActiveSheetIndex(2)->setCellValue('B' . $numrowNarsum, $viewNarsum['nama']);
    $excel->setActiveSheetIndex(2)->setCellValue('C' . $numrowNarsum, $viewNarsum['gol']);
    $excel->setActiveSheetIndex(2)->setCellValue('D' . $numrowNarsum, $viewNarsum['kabkota_unit_kerja']);
    $excel->setActiveSheetIndex(2)->setCellValue('E' . $numrowNarsum, str_replace('Kabupaten', 'Kab.', ucwords($viewPerjadin['nama_kab'])));
    $excel->setActiveSheetIndex(2)->setCellValue('F' . $numrowNarsum, Indonesia2Tgl($viewNarsum['tgl_mulai']));
    $excel->getActiveSheet()->getStyle('F' . $numrowNarsum)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $excel->setActiveSheetIndex(2)->setCellValue('G' . $numrowNarsum, Indonesia2Tgl($viewNarsum['tgl_selesai']));
    $excel->getActiveSheet()->getStyle('G' . $numrowNarsum)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $excel->setActiveSheetIndex(2)->setCellValue('H' . $numrowNarsum, $jmlHariNarsum . ' Hari');
    $excel->getActiveSheet()->getStyle('H' . $numrowNarsum)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $excel->setActiveSheetIndex(2)->setCellValue('I' . $numrowNarsum, $transportNarsum);
    $excel->setActiveSheetIndex(2)->setCellValue('J' . $numrowNarsum, $uangHarianNarsum);
    $excel->setActiveSheetIndex(2)->setCellValue('K' . $numrowNarsum, $hotel);
    $excel->setActiveSheetIndex(2)->setCellValue('L' . $numrowNarsum, $jmlPerjadinNarsum);
    $excel->setActiveSheetIndex(2)->setCellValue('M' . $numrowNarsum, '');

    $excel->getActiveSheet()->getStyle('I' . $numrowNarsum)->getNumberFormat()->setFormatCode("#,##0");
    $excel->getActiveSheet()->getStyle('J' . $numrowNarsum)->getNumberFormat()->setFormatCode("#,##0");
    $excel->getActiveSheet()->getStyle('K' . $numrowNarsum)->getNumberFormat()->setFormatCode("#,##0");
    $excel->getActiveSheet()->getStyle('L' . $numrowNarsum)->getNumberFormat()->setFormatCode("#,##0");

    $excel->getActiveSheet()->getStyle('A' . $numrowNarsum)->applyFromArray($style_row);
    $excel->getActiveSheet()->getStyle('B' . $numrowNarsum)->applyFromArray($style_row);
    $excel->getActiveSheet()->getStyle('C' . $numrowNarsum)->applyFromArray($style_row);
    $excel->getActiveSheet()->getStyle('D' . $numrowNarsum)->applyFromArray($style_row);
    $excel->getActiveSheet()->getStyle('E' . $numrowNarsum)->applyFromArray($style_row);
    $excel->getActiveSheet()->getStyle('F' . $numrowNarsum)->applyFromArray($style_row);
    $excel->getActiveSheet()->getStyle('G' . $numrowNarsum)->applyFromArray($style_row);
    $excel->getActiveSheet()->getStyle('H' . $numrowNarsum)->applyFromArray($style_row);
    $excel->getActiveSheet()->getStyle('I' . $numrowNarsum)->applyFromArray($style_row);
    $excel->getActiveSheet()->getStyle('J' . $numrowNarsum)->applyFromArray($style_row);
    $excel->getActiveSheet()->getStyle('K' . $numrowNarsum)->applyFromArray($style_row);
    $excel->getActiveSheet()->getStyle('L' . $numrowNarsum)->applyFromArray($style_row);
    $excel->getActiveSheet()->getStyle('M' . $numrowNarsum)->applyFromArray($style_row);

    $excel->getActiveSheet()->getStyle('A' . $numrowNarsum . ':M' . $numrowNarsum)->getFont()->setSize(10);

    $excel->getActiveSheet()->getRowDimension($numrowNarsum)->setRowHeight(15);
    $noUrutTugasNarsum++;
    $numrowNarsum++;

    $allTransportNarsum = $allTransportNarsum + $transportNarsum;
    $allHarianNarsum = $allHarianNarsum + $uangHarianNarsum;
    $allHotelNarsum = $allHotelNarsum + $hotel;
    $allPerjadinNarsum = $allPerjadinNarsum + $jmlPerjadinNarsum;
}


$excel->setActiveSheetIndex(2)->setCellValue('A' . $numrowNarsum, '');
$excel->setActiveSheetIndex(2)->setCellValue('B' . $numrowNarsum, 'Jumlah');
$excel->getActiveSheet()->getStyle('B' . $numrowNarsum)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$excel->setActiveSheetIndex(2)->setCellValue('C' . $numrowNarsum, '');
$excel->setActiveSheetIndex(2)->setCellValue('D' . $numrowNarsum, '');
$excel->setActiveSheetIndex(2)->setCellValue('E' . $numrowNarsum, '');
$excel->setActiveSheetIndex(2)->setCellValue('F' . $numrowNarsum, '');
$excel->setActiveSheetIndex(2)->setCellValue('G' . $numrowNarsum, '');
$excel->setActiveSheetIndex(2)->setCellValue('H' . $numrowNarsum, '');
$excel->setActiveSheetIndex(2)->setCellValue('I' . $numrowNarsum, $allTransportNarsum);
$excel->setActiveSheetIndex(2)->setCellValue('J' . $numrowNarsum, $allHarianNarsum);
$excel->setActiveSheetIndex(2)->setCellValue('K' . $numrowNarsum, $allHotelNarsum);
$excel->setActiveSheetIndex(2)->setCellValue('L' . $numrowNarsum, $allPerjadinNarsum);
$excel->setActiveSheetIndex(2)->setCellValue('M' . $numrowNarsum, '');

$excel->getActiveSheet()->getStyle('I' . $numrowNarsum)->getNumberFormat()->setFormatCode("#,##0");
$excel->getActiveSheet()->getStyle('J' . $numrowNarsum)->getNumberFormat()->setFormatCode("#,##0");
$excel->getActiveSheet()->getStyle('K' . $numrowNarsum)->getNumberFormat()->setFormatCode("#,##0");
$excel->getActiveSheet()->getStyle('L' . $numrowNarsum)->getNumberFormat()->setFormatCode("#,##0");

$excel->getActiveSheet()->getStyle('A' . $numrowNarsum)->applyFromArray($style_col_foot);
$excel->getActiveSheet()->getStyle('B' . $numrowNarsum)->applyFromArray($style_col_foot);
$excel->getActiveSheet()->getStyle('C' . $numrowNarsum)->applyFromArray($style_col_foot);
$excel->getActiveSheet()->getStyle('D' . $numrowNarsum)->applyFromArray($style_col_foot);
$excel->getActiveSheet()->getStyle('E' . $numrowNarsum)->applyFromArray($style_col_foot);
$excel->getActiveSheet()->getStyle('F' . $numrowNarsum)->applyFromArray($style_col_foot);
$excel->getActiveSheet()->getStyle('G' . $numrowNarsum)->applyFromArray($style_col_foot);
$excel->getActiveSheet()->getStyle('H' . $numrowNarsum)->applyFromArray($style_col_foot);
$excel->getActiveSheet()->getStyle('I' . $numrowNarsum)->applyFromArray($style_col_foot);
$excel->getActiveSheet()->getStyle('J' . $numrowNarsum)->applyFromArray($style_col_foot);
$excel->getActiveSheet()->getStyle('K' . $numrowNarsum)->applyFromArray($style_col_foot);
$excel->getActiveSheet()->getStyle('L' . $numrowNarsum)->applyFromArray($style_col_foot);
$excel->getActiveSheet()->getStyle('M' . $numrowNarsum)->applyFromArray($style_col_foot);

$excel->getActiveSheet()->getStyle('A' . $numrowNarsum . ':M' . $numrowNarsum)->getFont()->setSize(10);

// echo $numrowNarsum;
$excel->setActiveSheetIndex(2)->setCellValue('J' . ($numrowNarsum + 2), 'Surabaya, ' . Indonesia2Tgl($viewPerjadin['tgl_sptjb_perjadin']));
$excel->setActiveSheetIndex(2)->setCellValue('J' . ($numrowNarsum + 3), 'Kuasa Pengguna Anggaran/');
$excel->setActiveSheetIndex(2)->setCellValue('J' . ($numrowNarsum + 4), 'Pejabat Pembuat Komitmen');
$excel->setActiveSheetIndex(2)->setCellValue('J' . ($numrowNarsum + 8), $viewPPK['nama_peg']);
$excel->setActiveSheetIndex(2)->setCellValue('J' . ($numrowNarsum + 9), 'NIP. ' . $viewPPK['nip']);


$excel->getActiveSheet()->getStyle('A' . ($numrowNarsum + 2) . ':J' . ($numrowNarsum + 9))->applyFromArray($style_ttd);
$excel->getActiveSheet()->getStyle('A' . ($numrowNarsum + 2) . ':J' . ($numrowNarsum + 9))->getFont()->setSize(10);

$numrowAkhirNarsum = $numrowNarsum + 10;

$excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
// $excel->getActiveSheet(2)->setTitle('Narasumber');
