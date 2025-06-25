<?php
// $excel->createSheet();

$allHonorPanitia = 0;
$allPajakPanitia = 0;
$allBiayaPanitia = 0;
$noUrutTugasPanitia = 1;
$numrowHonorPanitia = $numrowAkhirHonorNarsum;
$jmlPanitiaOrang = 0;

$excel->setActiveSheetIndex(4)->setCellValue('A' . $numrowHonorPanitia, "DAFTAR NOMINATIF PENERIMAAN HONORARIUM PANITIA");
$excel->getActiveSheet()->mergeCells('A' . $numrowHonorPanitia . ':I' . $numrowHonorPanitia);
$excel->getActiveSheet()->getStyle('A' . $numrowHonorPanitia . ':I' . $numrowHonorPanitia)->applyFromArray($style_title);
$excel->setActiveSheetIndex(4)->setCellValue('A' . ($numrowHonorPanitia + 1), $viewPerjadin['nama_keg_kuitansi']);
$excel->getActiveSheet()->mergeCells('A' . ($numrowHonorPanitia + 1) . ':I' . ($numrowHonorPanitia + 1));
$excel->getActiveSheet()->getStyle('A' . ($numrowHonorPanitia + 1) . ':I' . ($numrowHonorPanitia + 1))->applyFromArray($style_title);
$excel->setActiveSheetIndex(4)->setCellValue('A' . ($numrowHonorPanitia + 2), 'di ' . $viewPerjadin['tempat_keg']);
$excel->getActiveSheet()->mergeCells('A' . ($numrowHonorPanitia + 2) . ':I' . ($numrowHonorPanitia + 2));
$excel->getActiveSheet()->getStyle('A' . ($numrowHonorPanitia + 2) . ':I' . ($numrowHonorPanitia + 2))->applyFromArray($style_title);
$excel->setActiveSheetIndex(4)->setCellValue('A' . ($numrowHonorPanitia + 3), "Tanggal : " . Indonesia2Tgl($viewPerjadin['tgl_mulai']) . " s.d " . Indonesia2Tgl($viewPerjadin['tgl_selesai']));
$excel->getActiveSheet()->mergeCells('A' . ($numrowHonorPanitia + 3) . ':I' . ($numrowHonorPanitia + 3));
$excel->getActiveSheet()->getStyle('A' . ($numrowHonorPanitia + 3) . ':I' . ($numrowHonorPanitia + 3))->applyFromArray($style_title);
$excel->setActiveSheetIndex(4)->setCellValue('A' . ($numrowHonorPanitia + 4), 'Nomor : ' . $viewPerjadin['no_sptjb_perjadin'] . '' . $viewPerjadin['sptjb_perjadin']);
$excel->getActiveSheet()->mergeCells('A' . ($numrowHonorPanitia + 4) . ':I' . ($numrowHonorPanitia + 4));
$excel->getActiveSheet()->getStyle('A' . ($numrowHonorPanitia + 4) . ':I' . ($numrowHonorPanitia + 4))->applyFromArray($style_title);

$excel->setActiveSheetIndex(4)->setCellValue('A' . ($numrowHonorPanitia + 6), "No");
$excel->getActiveSheet()->mergeCells('A' . ($numrowHonorPanitia + 6) . ':A' . ($numrowHonorPanitia + 7));
$excel->getActiveSheet()->getStyle('A' . ($numrowHonorPanitia + 6) . ':A' . ($numrowHonorPanitia + 7))->applyFromArray($style_col);
$excel->setActiveSheetIndex(4)->setCellValue('B' . ($numrowHonorPanitia + 6), "Nama");
$excel->getActiveSheet()->mergeCells('B' . ($numrowHonorPanitia + 6) . ':B' . ($numrowHonorPanitia + 7));
$excel->getActiveSheet()->getStyle('B' . ($numrowHonorPanitia + 6) . ':B' . ($numrowHonorPanitia + 7))->applyFromArray($style_col);
$excel->setActiveSheetIndex(4)->setCellValue('C' . ($numrowHonorPanitia + 6), "NIP");
$excel->getActiveSheet()->mergeCells('C' . ($numrowHonorPanitia + 6) . ':C' . ($numrowHonorPanitia + 7));
$excel->getActiveSheet()->getStyle('C' . ($numrowHonorPanitia + 6) . ':C' . ($numrowHonorPanitia + 7))->applyFromArray($style_col);
$excel->setActiveSheetIndex(4)->setCellValue('D' . ($numrowHonorPanitia + 6), "Gol");
$excel->getActiveSheet()->mergeCells('D' . ($numrowHonorPanitia + 6) . ':D' . ($numrowHonorPanitia + 7));
$excel->getActiveSheet()->getStyle('D' . ($numrowHonorPanitia + 6) . ':D' . ($numrowHonorPanitia + 7))->applyFromArray($style_col);
$excel->setActiveSheetIndex(4)->setCellValue('E' . ($numrowHonorPanitia + 6), "Unit Kerja");
$excel->getActiveSheet()->mergeCells('E' . ($numrowHonorPanitia + 6) . ':E' . ($numrowHonorPanitia + 7));
$excel->getActiveSheet()->getStyle('E' . ($numrowHonorPanitia + 6) . ':E' . ($numrowHonorPanitia + 7))->applyFromArray($style_col);
$excel->setActiveSheetIndex(4)->setCellValue('F' . ($numrowHonorPanitia + 6), "Honorarium");
$excel->setActiveSheetIndex(4)->setCellValue('F' . ($numrowHonorPanitia + 7), "Rp");
$excel->getActiveSheet()->getStyle('F' . ($numrowHonorPanitia + 6) . ':F' . ($numrowHonorPanitia + 7))->applyFromArray($style_col);
$excel->setActiveSheetIndex(4)->setCellValue('G' . ($numrowHonorPanitia + 6), "PPH 21");
$excel->getActiveSheet()->mergeCells('G' . ($numrowHonorPanitia + 6) . ':G' . ($numrowHonorPanitia + 7));
$excel->getActiveSheet()->getStyle('G' . ($numrowHonorPanitia + 6) . ':G' . ($numrowHonorPanitia + 7))->applyFromArray($style_col);
$excel->setActiveSheetIndex(4)->setCellValue('H' . ($numrowHonorPanitia + 6), "Biaya");
$excel->setActiveSheetIndex(4)->setCellValue('H' . ($numrowHonorPanitia + 7), "Rp");
$excel->getActiveSheet()->getStyle('H' . ($numrowHonorPanitia + 6) . ':H' . ($numrowHonorPanitia + 7))->applyFromArray($style_col);
$excel->setActiveSheetIndex(4)->setCellValue('I' . ($numrowHonorPanitia + 6), "No");
$excel->setActiveSheetIndex(4)->setCellValue('I' . ($numrowHonorPanitia + 7), "Rekening");
$excel->getActiveSheet()->getStyle('I' . ($numrowHonorPanitia + 6) . ':I' . ($numrowHonorPanitia + 7))->applyFromArray($style_col);

$excel->getActiveSheet()->getStyle('A' . ($numrowHonorPanitia + 6) . ':I' . ($numrowHonorPanitia + 7))->applyFromArray($styleWarp);
// $excel->getActiveSheet()->getColumnDimension('A')->setWidth(5);
// $excel->getActiveSheet()->getColumnDimension('B')->setWidth(35);
// $excel->getActiveSheet()->getColumnDimension('C')->setWidth(25);
// $excel->getActiveSheet()->getColumnDimension('D')->setWidth(4);
// $excel->getActiveSheet()->getColumnDimension('E')->setWidth(25);
// $excel->getActiveSheet()->getColumnDimension('F')->setWidth(15);
// $excel->getActiveSheet()->getColumnDimension('G')->setWidth(12);
// $excel->getActiveSheet()->getColumnDimension('H')->setWidth(12);
// $excel->getActiveSheet()->getColumnDimension('I')->setWidth(15);


$numrowHonorPanitia = $numrowAkhirHonorNarsum + 8;
//pengarah
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
    $idKabKotaPanitia = $viewPanitia['id_kabkota_unit_kerja'];
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

    $excel->setActiveSheetIndex(4)->setCellValue('A' . $numrowHonorPanitia, $noUrutTugasPanitia);
    $excel->setActiveSheetIndex(4)->setCellValue('B' . $numrowHonorPanitia, $viewPanitia['nama']);
    $excel->setActiveSheetIndex(4)->setCellValueExplicit('C' . $numrowHonorPanitia, $viewPanitia['nip'], PHPExcel_Cell_DataType::TYPE_STRING);
    $excel->setActiveSheetIndex(4)->setCellValue('D' . $numrowHonorPanitia, $viewPanitia['gol']);
    $excel->setActiveSheetIndex(4)->setCellValue('E' . $numrowHonorPanitia, $viewPanitia['unit_kerja']);
    $excel->setActiveSheetIndex(4)->setCellValue('F' . $numrowHonorPanitia, $uangHonorPanitia);
    $excel->setActiveSheetIndex(4)->setCellValue('G' . $numrowHonorPanitia, $potonganHonorPanitia);
    $excel->setActiveSheetIndex(4)->setCellValue('H' . $numrowHonorPanitia, $uangHonorPanitiaPotongan);
    $excel->setActiveSheetIndex(4)->setCellValue('I' . $numrowHonorPanitia, '');

    $excel->getActiveSheet()->getStyle('F' . $numrowHonorPanitia)->getNumberFormat()->setFormatCode("#,##0");
    $excel->getActiveSheet()->getStyle('G' . $numrowHonorPanitia)->getNumberFormat()->setFormatCode("#,##0");
    $excel->getActiveSheet()->getStyle('H' . $numrowHonorPanitia)->getNumberFormat()->setFormatCode("#,##0");
    // $excel->getActiveSheet()->getStyle('I' . $numrowHonorPanitia)->getNumberFormat()->setFormatCode("#,##0");

    $excel->getActiveSheet()->getStyle('A' . $numrowHonorPanitia)->applyFromArray($style_row);
    $excel->getActiveSheet()->getStyle('B' . $numrowHonorPanitia)->applyFromArray($style_row);
    $excel->getActiveSheet()->getStyle('C' . $numrowHonorPanitia)->applyFromArray($style_row);
    $excel->getActiveSheet()->getStyle('D' . $numrowHonorPanitia)->applyFromArray($style_row);
    $excel->getActiveSheet()->getStyle('E' . $numrowHonorPanitia)->applyFromArray($style_row);
    $excel->getActiveSheet()->getStyle('F' . $numrowHonorPanitia)->applyFromArray($style_row);
    $excel->getActiveSheet()->getStyle('G' . $numrowHonorPanitia)->applyFromArray($style_row);
    $excel->getActiveSheet()->getStyle('H' . $numrowHonorPanitia)->applyFromArray($style_row);
    $excel->getActiveSheet()->getStyle('I' . $numrowHonorPanitia)->applyFromArray($style_row);

    $excel->getActiveSheet()->getStyle('A' . $numrowHonorPanitia . ':I' . $numrowHonorPanitia)->getFont()->setSize(10);

    $excel->getActiveSheet()->getRowDimension($numrowHonorPanitia)->setRowHeight(15);
    $noUrutTugasPanitia++;
    $numrowHonorPanitia++;
    $jmlPanitiaOrang++;

    $allHonorPanitia = $allHonorPanitia + $uangHonorPanitia;
    $allPajakPanitia = $allPajakPanitia + $potonganHonorPanitia;
    $allBiayaPanitia = $allBiayaPanitia + $uangHonorPanitiaPotongan;
}
$namaPanitia = mysqli_fetch_array(mysqli_query($myConnection, "select tb_panitia_keg_hotel.*, tb_pegawai.nama_peg as nama_peg, tb_jabatan_kegiatan.nama_jabatan
from tb_panitia_keg_hotel
left join tb_kegiatan on tb_kegiatan.id_keg = tb_panitia_keg_hotel.id_keg
left join tb_pegawai on tb_pegawai.id_peg = tb_panitia_keg_hotel.id_peg
left join tb_gol_pajak on tb_gol_pajak.id_pangkat = tb_pegawai.id_pangkat
left join tb_jabatan_kegiatan on tb_jabatan_kegiatan.kd_jabatan = tb_panitia_keg_hotel.id_jab_st
where tb_panitia_keg_hotel.id_keg = '$id_keg'
order by tb_jabatan_kegiatan.kd_jabatan asc"));
$namaHonorPanitia = $namaPanitia['nama'];

$excel->setActiveSheetIndex(4)->setCellValue('A' . $numrowHonorPanitia, '');
$excel->setActiveSheetIndex(4)->setCellValue('B' . $numrowHonorPanitia, 'Jumlah');
$excel->getActiveSheet()->getStyle('B' . $numrowHonorPanitia)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$excel->setActiveSheetIndex(4)->setCellValue('C' . $numrowHonorPanitia, '');
$excel->setActiveSheetIndex(4)->setCellValue('D' . $numrowHonorPanitia, '');
$excel->setActiveSheetIndex(4)->setCellValue('E' . $numrowHonorPanitia, '');
$excel->setActiveSheetIndex(4)->setCellValue('F' . $numrowHonorPanitia, $allHonorPanitia);
$excel->setActiveSheetIndex(4)->setCellValue('G' . $numrowHonorPanitia, $allPajakPanitia);
$excel->setActiveSheetIndex(4)->setCellValue('H' . $numrowHonorPanitia, $allBiayaPanitia);
$excel->setActiveSheetIndex(4)->setCellValue('I' . $numrowHonorPanitia, '');

$excel->getActiveSheet()->getStyle('F' . $numrowHonorPanitia)->getNumberFormat()->setFormatCode("#,##0");
$excel->getActiveSheet()->getStyle('G' . $numrowHonorPanitia)->getNumberFormat()->setFormatCode("#,##0");
$excel->getActiveSheet()->getStyle('H' . $numrowHonorPanitia)->getNumberFormat()->setFormatCode("#,##0");

$excel->getActiveSheet()->getStyle('A' . $numrowHonorPanitia)->applyFromArray($style_col_foot);
$excel->getActiveSheet()->getStyle('B' . $numrowHonorPanitia)->applyFromArray($style_col_foot);
$excel->getActiveSheet()->getStyle('C' . $numrowHonorPanitia)->applyFromArray($style_col_foot);
$excel->getActiveSheet()->getStyle('D' . $numrowHonorPanitia)->applyFromArray($style_col_foot);
$excel->getActiveSheet()->getStyle('E' . $numrowHonorPanitia)->applyFromArray($style_col_foot);
$excel->getActiveSheet()->getStyle('F' . $numrowHonorPanitia)->applyFromArray($style_col_foot);
$excel->getActiveSheet()->getStyle('G' . $numrowHonorPanitia)->applyFromArray($style_col_foot);
$excel->getActiveSheet()->getStyle('H' . $numrowHonorPanitia)->applyFromArray($style_col_foot);
$excel->getActiveSheet()->getStyle('I' . $numrowHonorPanitia)->applyFromArray($style_col_foot);

$excel->getActiveSheet()->getStyle('A' . $numrowHonorPanitia . ':I' . $numrowHonorPanitia)->getFont()->setSize(10);

// echo $numrowHonorPanitia;
$excel->setActiveSheetIndex(4)->setCellValue('B' . ($numrowHonorPanitia + 3), 'Mengetahui,');
$excel->setActiveSheetIndex(4)->setCellValue('B' . ($numrowHonorPanitia + 4), 'Kuasa Pengguna Anggaran/');
$excel->setActiveSheetIndex(4)->setCellValue('B' . ($numrowHonorPanitia + 5), 'Pejabat Pembuat Komitmen');
$excel->setActiveSheetIndex(4)->setCellValue('B' . ($numrowHonorPanitia + 9), $viewPPK['nama_peg']);
$excel->setActiveSheetIndex(4)->setCellValue('B' . ($numrowHonorPanitia + 10), 'NIP. ' . $viewPPK['nip']);

$excel->setActiveSheetIndex(4)->setCellValue('F' . ($numrowHonorPanitia + 3), 'Surabaya, ' . Indonesia2Tgl($viewPerjadin['tgl_sptjb_perjadin']));
$excel->setActiveSheetIndex(4)->setCellValue('F' . ($numrowHonorPanitia + 4), 'Bendahara Pengeluaran');
$excel->setActiveSheetIndex(4)->setCellValue('F' . ($numrowHonorPanitia + 5), '');
$excel->setActiveSheetIndex(4)->setCellValue('F' . ($numrowHonorPanitia + 9), $viewBendahara['nama_peg']);
$excel->setActiveSheetIndex(4)->setCellValue('F' . ($numrowHonorPanitia + 10), 'NIP. ' . $viewBendahara['nip']);


$excel->getActiveSheet()->getStyle('A' . ($numrowHonorPanitia + 2) . ':F' . ($numrowHonorPanitia + 10))->applyFromArray($style_ttd);
$excel->getActiveSheet()->getStyle('A' . ($numrowHonorPanitia + 2) . ':F' . ($numrowHonorPanitia + 10))->getFont()->setSize(10);



$excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
// $excel->getActiveSheet(4)->setTitle('Panitia');
