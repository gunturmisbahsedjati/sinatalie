<?php
// $excel->createSheet();

$allTransportPanitia = 0;
$allHarianPanitia = 0;
$allPerjadinPanitia = 0;
$noUrutTugasPanitia = 1;
$numrowPanitia = $numrowAkhirNarsum;

$excel->setActiveSheetIndex(2)->setCellValue('A' . $numrowPanitia, "Daftar Nominatif Penerimaan Biaya Perjalanan Dinas Panitia");
$excel->getActiveSheet()->mergeCells('A' . $numrowPanitia . ':M' . $numrowPanitia);
$excel->getActiveSheet()->getStyle('A' . $numrowPanitia . ':M' . $numrowPanitia)->applyFromArray($style_title);
$excel->setActiveSheetIndex(2)->setCellValue('A' . ($numrowPanitia + 1), $viewPerjadin['nama_keg_kuitansi']);
$excel->getActiveSheet()->mergeCells('A' . ($numrowPanitia + 1) . ':M' . ($numrowPanitia + 1));
$excel->getActiveSheet()->getStyle('A' . ($numrowPanitia + 1) . ':M' . ($numrowPanitia + 1))->applyFromArray($style_title);
$excel->setActiveSheetIndex(2)->setCellValue('A' . ($numrowPanitia + 2), 'di ' . $viewPerjadin['tempat_keg']);
$excel->getActiveSheet()->mergeCells('A' . ($numrowPanitia + 2) . ':M' . ($numrowPanitia + 2));
$excel->getActiveSheet()->getStyle('A' . ($numrowPanitia + 2) . ':M' . ($numrowPanitia + 2))->applyFromArray($style_title);
$excel->setActiveSheetIndex(2)->setCellValue('A' . ($numrowPanitia + 3), "Tanggal : " . Indonesia2Tgl($viewPerjadin['tgl_mulai']) . " s.d " . Indonesia2Tgl($viewPerjadin['tgl_selesai']));
$excel->getActiveSheet()->mergeCells('A' . ($numrowPanitia + 3) . ':M' . ($numrowPanitia + 3));
$excel->getActiveSheet()->getStyle('A' . ($numrowPanitia + 3) . ':M' . ($numrowPanitia + 3))->applyFromArray($style_title);
$excel->setActiveSheetIndex(2)->setCellValue('A' . ($numrowPanitia + 4), 'Nomor : ' . $viewPerjadin['no_sptjb_perjadin'] . '' . $viewPerjadin['sptjb_perjadin']);
$excel->getActiveSheet()->mergeCells('A' . ($numrowPanitia + 4) . ':M' . ($numrowPanitia + 4));
$excel->getActiveSheet()->getStyle('A' . ($numrowPanitia + 4) . ':M' . ($numrowPanitia + 4))->applyFromArray($style_title);

$excel->setActiveSheetIndex(2)->setCellValue('A' . ($numrowPanitia + 6), "No");
$excel->getActiveSheet()->mergeCells('A' . ($numrowPanitia + 6) . ':A' . ($numrowPanitia + 7));
$excel->getActiveSheet()->getStyle('A' . ($numrowPanitia + 6) . ':A' . ($numrowPanitia + 7))->applyFromArray($style_col);
$excel->setActiveSheetIndex(2)->setCellValue('B' . ($numrowPanitia + 6), "Nama");
$excel->getActiveSheet()->mergeCells('B' . ($numrowPanitia + 6) . ':B' . ($numrowPanitia + 7));
$excel->getActiveSheet()->getStyle('B' . ($numrowPanitia + 6) . ':B' . ($numrowPanitia + 7))->applyFromArray($style_col);
$excel->setActiveSheetIndex(2)->setCellValue('C' . ($numrowPanitia + 6), "Gol");
$excel->getActiveSheet()->mergeCells('C' . ($numrowPanitia + 6) . ':C' . ($numrowPanitia + 7));
$excel->getActiveSheet()->getStyle('C' . ($numrowPanitia + 6) . ':C' . ($numrowPanitia + 7))->applyFromArray($style_col);
$excel->setActiveSheetIndex(2)->setCellValue('D' . ($numrowPanitia + 6), "Asal\nDaerah/Kota");
$excel->getActiveSheet()->mergeCells('D' . ($numrowPanitia + 6) . ':D' . ($numrowPanitia + 7));
$excel->getActiveSheet()->getStyle('D' . ($numrowPanitia + 6) . ':D' . ($numrowPanitia + 7))->applyFromArray($style_col);
$excel->setActiveSheetIndex(2)->setCellValue('E' . ($numrowPanitia + 6), "Tujuan");
$excel->getActiveSheet()->mergeCells('E' . ($numrowPanitia + 6) . ':E' . ($numrowPanitia + 7));
$excel->getActiveSheet()->getStyle('E' . ($numrowPanitia + 6) . ':E' . ($numrowPanitia + 7))->applyFromArray($style_col);
$excel->setActiveSheetIndex(2)->setCellValue('F' . ($numrowPanitia + 6), "Tanggal");
$excel->getActiveSheet()->mergeCells('F' . ($numrowPanitia + 6) . ':G' . ($numrowPanitia + 6));
$excel->getActiveSheet()->getStyle('F' . ($numrowPanitia + 6) . ':G' . ($numrowPanitia + 6))->applyFromArray($style_col);
$excel->setActiveSheetIndex(2)->setCellValue('F' . ($numrowPanitia + 7), "Berangkat");
$excel->getActiveSheet()->getStyle('F' . ($numrowPanitia + 7))->applyFromArray($style_col);
$excel->setActiveSheetIndex(2)->setCellValue('G' . ($numrowPanitia + 7), "Pulang");
$excel->getActiveSheet()->getStyle('G' . ($numrowPanitia + 7))->applyFromArray($style_col);
$excel->setActiveSheetIndex(2)->setCellValue('H' . ($numrowPanitia + 6), "Lama\nPerjalanan");
$excel->getActiveSheet()->mergeCells('H' . ($numrowPanitia + 6) . ':H' . ($numrowPanitia + 7));
$excel->getActiveSheet()->getStyle('H' . ($numrowPanitia + 6) . ':H' . ($numrowPanitia + 7))->applyFromArray($style_col);
$excel->setActiveSheetIndex(2)->setCellValue('I' . ($numrowPanitia + 6), "Transport");
$excel->getActiveSheet()->mergeCells('I' . ($numrowPanitia + 6) . ':I' . ($numrowPanitia + 7));
$excel->getActiveSheet()->getStyle('I' . ($numrowPanitia + 6) . ':I' . ($numrowPanitia + 7))->applyFromArray($style_col);
$excel->setActiveSheetIndex(2)->setCellValue('J' . ($numrowPanitia + 6), "Uang\nHarian");
$excel->getActiveSheet()->mergeCells('J' . ($numrowPanitia + 6) . ':J' . ($numrowPanitia + 7));
$excel->getActiveSheet()->getStyle('J' . ($numrowPanitia + 6) . ':J' . ($numrowPanitia + 7))->applyFromArray($style_col);
$excel->setActiveSheetIndex(2)->setCellValue('K' . ($numrowPanitia + 6), "Penginapan");
$excel->getActiveSheet()->mergeCells('K' . ($numrowPanitia + 6) . ':K' . ($numrowPanitia + 7));
$excel->getActiveSheet()->getStyle('K' . ($numrowPanitia + 6) . ':K' . ($numrowPanitia + 7))->applyFromArray($style_col);
$excel->setActiveSheetIndex(2)->setCellValue('L' . ($numrowPanitia + 6), "Biaya\nRp.");
$excel->getActiveSheet()->mergeCells('L' . ($numrowPanitia + 6) . ':L' . ($numrowPanitia + 7));
$excel->getActiveSheet()->getStyle('L' . ($numrowPanitia + 6) . ':L' . ($numrowPanitia + 7))->applyFromArray($style_col);
$excel->setActiveSheetIndex(2)->setCellValue('M' . ($numrowPanitia + 6), "No.\nRekening");
$excel->getActiveSheet()->mergeCells('M' . ($numrowPanitia + 6) . ':M' . ($numrowPanitia + 7));
$excel->getActiveSheet()->getStyle('M' . ($numrowPanitia + 6) . ':M' . ($numrowPanitia + 7))->applyFromArray($style_col);

$excel->getActiveSheet()->getStyle('A' . ($numrowPanitia + 6) . ':M' . ($numrowPanitia + 7))->applyFromArray($styleWarp);

// $excel->getActiveSheet()->getColumnDimension('A')->setWidth(5);
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

$excel->getActiveSheet()->getRowDimension($numrowNarsum + 6)->setRowHeight(20);
$excel->getActiveSheet()->getRowDimension($numrowNarsum + 7)->setRowHeight(20);

$numrowPanitia = $numrowPanitia + 8;
$sqlPanitia = mysqli_query($myConnection, "select tb_panitia_keg_kantor.*, tb_pegawai.nama_peg as nama_peg, tb_jabatan_kegiatan.nama_jabatan
from tb_panitia_keg_kantor
left join tb_kegiatan on tb_kegiatan.id_keg = tb_panitia_keg_kantor.id_keg
left join tb_pegawai on tb_pegawai.id_peg = tb_panitia_keg_kantor.id_peg
left join tb_gol_pajak on tb_gol_pajak.id_pangkat = tb_pegawai.id_pangkat
left join tb_jabatan_kegiatan on tb_jabatan_kegiatan.kd_jabatan = tb_panitia_keg_kantor.id_jab_st
where tb_panitia_keg_kantor.id_keg = '$id_keg'
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

    $excel->setActiveSheetIndex(2)->setCellValue('A' . $numrowPanitia, $noUrutTugasPanitia);
    $excel->setActiveSheetIndex(2)->setCellValue('B' . $numrowPanitia, $viewPanitia['nama']);
    $excel->setActiveSheetIndex(2)->setCellValue('C' . $numrowPanitia, $viewPanitia['gol']);
    $excel->setActiveSheetIndex(2)->setCellValue('D' . $numrowPanitia, $viewPanitia['kabkota_unit_kerja']);
    $excel->setActiveSheetIndex(2)->setCellValue('E' . $numrowPanitia, str_replace('Kabupaten', 'Kab.', ucwords($viewPerjadin['nama_kab'])));
    $excel->setActiveSheetIndex(2)->setCellValue('F' . $numrowPanitia, Indonesia2Tgl($viewPanitia['tgl_mulai']));
    $excel->getActiveSheet()->getStyle('F' . $numrowPanitia)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $excel->setActiveSheetIndex(2)->setCellValue('G' . $numrowPanitia, Indonesia2Tgl($viewPanitia['tgl_selesai']));
    $excel->getActiveSheet()->getStyle('G' . $numrowPanitia)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $excel->setActiveSheetIndex(2)->setCellValue('H' . $numrowPanitia, $jmlHariPanitia . ' Hari');
    $excel->getActiveSheet()->getStyle('H' . $numrowPanitia)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $excel->setActiveSheetIndex(2)->setCellValue('I' . $numrowPanitia, $transportPanitia);
    $excel->setActiveSheetIndex(2)->setCellValue('J' . $numrowPanitia, $uangHarianPanitia);
    $excel->setActiveSheetIndex(2)->setCellValue('K' . $numrowPanitia, '');
    $excel->setActiveSheetIndex(2)->setCellValue('L' . $numrowPanitia, $jmlPerjadinPanitia);
    $excel->setActiveSheetIndex(2)->setCellValue('M' . $numrowPanitia, '');

    $excel->getActiveSheet()->getStyle('I' . $numrowPanitia)->getNumberFormat()->setFormatCode("#,##0");
    $excel->getActiveSheet()->getStyle('J' . $numrowPanitia)->getNumberFormat()->setFormatCode("#,##0");
    $excel->getActiveSheet()->getStyle('K' . $numrowPanitia)->getNumberFormat()->setFormatCode("#,##0");
    $excel->getActiveSheet()->getStyle('L' . $numrowPanitia)->getNumberFormat()->setFormatCode("#,##0");

    $excel->getActiveSheet()->getStyle('A' . $numrowPanitia)->applyFromArray($style_row);
    $excel->getActiveSheet()->getStyle('B' . $numrowPanitia)->applyFromArray($style_row);
    $excel->getActiveSheet()->getStyle('C' . $numrowPanitia)->applyFromArray($style_row);
    $excel->getActiveSheet()->getStyle('D' . $numrowPanitia)->applyFromArray($style_row);
    $excel->getActiveSheet()->getStyle('E' . $numrowPanitia)->applyFromArray($style_row);
    $excel->getActiveSheet()->getStyle('F' . $numrowPanitia)->applyFromArray($style_row);
    $excel->getActiveSheet()->getStyle('G' . $numrowPanitia)->applyFromArray($style_row);
    $excel->getActiveSheet()->getStyle('H' . $numrowPanitia)->applyFromArray($style_row);
    $excel->getActiveSheet()->getStyle('I' . $numrowPanitia)->applyFromArray($style_row);
    $excel->getActiveSheet()->getStyle('J' . $numrowPanitia)->applyFromArray($style_row);
    $excel->getActiveSheet()->getStyle('K' . $numrowPanitia)->applyFromArray($style_row);
    $excel->getActiveSheet()->getStyle('L' . $numrowPanitia)->applyFromArray($style_row);
    $excel->getActiveSheet()->getStyle('M' . $numrowPanitia)->applyFromArray($style_row);

    $excel->getActiveSheet()->getStyle('A' . $numrowPanitia . ':M' . $numrowPanitia)->getFont()->setSize(10);

    $excel->getActiveSheet()->getRowDimension($numrowPanitia)->setRowHeight(15);
    $noUrutTugasPanitia++;
    $numrowPanitia++;

    $allTransportPanitia = $allTransportPanitia + $transportPanitia;
    $allHarianPanitia = $allHarianPanitia + $uangHarianPanitia;
    $allPerjadinPanitia = $allPerjadinPanitia + $jmlPerjadinPanitia;
}


$excel->setActiveSheetIndex(2)->setCellValue('A' . $numrowPanitia, '');
$excel->setActiveSheetIndex(2)->setCellValue('B' . $numrowPanitia, 'Jumlah');
$excel->getActiveSheet()->getStyle('B' . $numrowPanitia)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$excel->setActiveSheetIndex(2)->setCellValue('C' . $numrowPanitia, '');
$excel->setActiveSheetIndex(2)->setCellValue('D' . $numrowPanitia, '');
$excel->setActiveSheetIndex(2)->setCellValue('E' . $numrowPanitia, '');
$excel->setActiveSheetIndex(2)->setCellValue('F' . $numrowPanitia, '');
$excel->setActiveSheetIndex(2)->setCellValue('G' . $numrowPanitia, '');
$excel->setActiveSheetIndex(2)->setCellValue('H' . $numrowPanitia, '');
$excel->setActiveSheetIndex(2)->setCellValue('I' . $numrowPanitia, $allTransportPanitia);
$excel->setActiveSheetIndex(2)->setCellValue('J' . $numrowPanitia, $allHarianPanitia);
$excel->setActiveSheetIndex(2)->setCellValue('K' . $numrowPanitia, '');
$excel->setActiveSheetIndex(2)->setCellValue('L' . $numrowPanitia, $allPerjadinPanitia);
$excel->setActiveSheetIndex(2)->setCellValue('M' . $numrowPanitia, '');

$excel->getActiveSheet()->getStyle('I' . $numrowPanitia)->getNumberFormat()->setFormatCode("#,##0");
$excel->getActiveSheet()->getStyle('J' . $numrowPanitia)->getNumberFormat()->setFormatCode("#,##0");
$excel->getActiveSheet()->getStyle('K' . $numrowPanitia)->getNumberFormat()->setFormatCode("#,##0");
$excel->getActiveSheet()->getStyle('L' . $numrowPanitia)->getNumberFormat()->setFormatCode("#,##0");

$excel->getActiveSheet()->getStyle('A' . $numrowPanitia)->applyFromArray($style_col_foot);
$excel->getActiveSheet()->getStyle('B' . $numrowPanitia)->applyFromArray($style_col_foot);
$excel->getActiveSheet()->getStyle('C' . $numrowPanitia)->applyFromArray($style_col_foot);
$excel->getActiveSheet()->getStyle('D' . $numrowPanitia)->applyFromArray($style_col_foot);
$excel->getActiveSheet()->getStyle('E' . $numrowPanitia)->applyFromArray($style_col_foot);
$excel->getActiveSheet()->getStyle('F' . $numrowPanitia)->applyFromArray($style_col_foot);
$excel->getActiveSheet()->getStyle('G' . $numrowPanitia)->applyFromArray($style_col_foot);
$excel->getActiveSheet()->getStyle('H' . $numrowPanitia)->applyFromArray($style_col_foot);
$excel->getActiveSheet()->getStyle('I' . $numrowPanitia)->applyFromArray($style_col_foot);
$excel->getActiveSheet()->getStyle('J' . $numrowPanitia)->applyFromArray($style_col_foot);
$excel->getActiveSheet()->getStyle('K' . $numrowPanitia)->applyFromArray($style_col_foot);
$excel->getActiveSheet()->getStyle('L' . $numrowPanitia)->applyFromArray($style_col_foot);
$excel->getActiveSheet()->getStyle('M' . $numrowPanitia)->applyFromArray($style_col_foot);

$excel->getActiveSheet()->getStyle('A' . $numrowPanitia . ':M' . $numrowPanitia)->getFont()->setSize(10);

// echo $numrowPanitia;
$excel->setActiveSheetIndex(2)->setCellValue('J' . ($numrowPanitia + 2), 'Surabaya, ' . Indonesia2Tgl($viewPerjadin['tgl_sptjb_perjadin']));
$excel->setActiveSheetIndex(2)->setCellValue('J' . ($numrowPanitia + 3), 'Kuasa Pengguna Anggaran/');
$excel->setActiveSheetIndex(2)->setCellValue('J' . ($numrowPanitia + 4), 'Pejabat Pembuat Komitmen');
$excel->setActiveSheetIndex(2)->setCellValue('J' . ($numrowPanitia + 8), $viewPPK['nama_peg']);
$excel->setActiveSheetIndex(2)->setCellValue('J' . ($numrowPanitia + 9), 'NIP. ' . $viewPPK['nip']);


$excel->getActiveSheet()->getStyle('A' . ($numrowPanitia + 2) . ':J' . ($numrowPanitia + 9))->applyFromArray($style_ttd);
$excel->getActiveSheet()->getStyle('A' . ($numrowPanitia + 2) . ':J' . ($numrowPanitia + 9))->getFont()->setSize(10);

$numrowAkhirPanitia = $numrowPanitia + 10;

$excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
// $excel->getActiveSheet(2)->setTitle('Panitia');
