<?php
require_once '../../../inc/inc.koneksi.php';
require_once '../../../inc/inc.library.php';
$date = date('d-m-Y H:i:s');
// $tokenCetak = strtotime($date);
date_default_timezone_set('Asia/Jakarta');
$currentdate = Indonesia2Tgl(date("Y-m-d"));
$today = date("H:i");


session_start();
if (empty($_SESSION['username']) && !isset($_SESSION['status_login'])) {
	echo "<h2>File Not Found</h2>";
} else {
	if (isset($_GET['_token'])) {
		$id_keg = decrypt($_GET['_token']);
		$sqlKegiatan = mysqli_query($myConnection, "select tb_kegiatan.*, tb_kabkota.name as nama_kab, tb_profil_sptjb.nama_satker, tb_profil_sptjb.kode_satker, tb_profil_sptjb.no_dipa, tb_profil_sptjb.tgl_dipa, tb_profil_sptjb.klasifikasi, tb_profil_sptjb.no_dipa
                                              from tb_kegiatan
                                              left join tb_kabkota on tb_kabkota.id = tb_kegiatan.kabkota
											  left join tb_profil_sptjb on tb_profil_sptjb.id_profil_sptjb = tb_kegiatan.profil_dipa
                                              where tb_kegiatan.id_keg = '$id_keg'");
		if (mysqli_num_rows($sqlKegiatan) > 0) {
			$viewPerjadin = mysqli_fetch_array($sqlKegiatan);
			$id_ppk = $viewPerjadin['id_ppk'];
			$id_bendahara = $viewPerjadin['id_bendahara'];
			$viewPPK = mysqli_fetch_array(mysqli_query($myConnection, "select * from tb_pegawai where id_peg = '$id_ppk'"));
			$viewBendahara = mysqli_fetch_array(mysqli_query($myConnection, "select * from tb_pegawai where id_peg = '$id_bendahara'"));
			require_once '../../../assets/vendor/libs/excel/PHPExcel.php';
			$excel = new PHPExcel();

			$excel->getProperties()->setCreator('ANIMASIKU Studio')
				->setLastModifiedBy('ANIMASIKU Studio')
				->setTitle("SINADIN - Rekapitulasi Perjadin " . strtoupper(uniqid()))
				->setSubject("Export Data Perjadin")
				->setDescription("SINADIN-ExportExcel")
				->setKeywords("SINADIN-ExportExcel");
			$style_title = array(
				'font' => array(
					'bold' => true,
					'name'  => 'Arial',
					'size' => 10
				),
				'alignment' => array(
					'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
					'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER
				),
			);
			$style_ttd = array(
				'font' => array(
					// 'bold' => true,
					'name'  => 'Arial',
					'size' => 10
				),
				// 'alignment' => array(
				// 	'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
				// 	'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER
				// ),
			);
			$style_ttd2 = array(
				'font' => array(
					// 'bold' => true,
					'name'  => 'Arial',
					'size' => 10
				),
				'borders' => array(
					'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN)
				)
				// 'alignment' => array(
				// 	'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
				// 	'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER
				// ),
			);
			$style_col = array(
				'font' => array('name'  => 'Arial', 'size' => 10),
				'alignment' => array(
					'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
					'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER
				),
				'borders' => array(
					'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),
					'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),
					'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),
					'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN)
				)
			);
			$style_col_foot = array(
				'font' => array('bold' => true, 'name'  => 'Arial', 'size' => 10),
				'alignment' => array(
					// 'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
					'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER
				),
				'borders' => array(
					'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),
					'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),
					'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_DOUBLE),
					'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN)
				)
			);
			$style_row = array(
				'alignment' => array(
					'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER
				),
				'font' => array('name'  => 'Arial', 'size' => 10),
				'borders' => array(
					'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),
					'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),
					'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),
					'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN)
				)
			);
			$style_row_tengah = array(
				'alignment' => array(
					'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
					'wrap' => true
				),
				'font' => array('name'  => 'Arial', 'size' => 10),
				'borders' => array(
					'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),
					'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN)
				),
			);
			$style_row_empty = array(
				'fill' => array(
					'type' => PHPExcel_Style_Fill::FILL_SOLID,
					'color' => array('rgb' => 'D3D3D3')
				),
				'borders' => array(
					'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),
					'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),
					'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),
					'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN)
				),
			);
			$styleWarp = array(
				'alignment' => array(
					// 'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
					'wrap' => true
				)
			);

			//include file-file sheet
			include_once 'nom-honor/sheet_nom_honor_pengarah.php';
			include_once 'nom-honor/sheet_nom_honor_narsum.php';
			include_once 'nom-honor/sheet_nom_honor_panitia.php';
			include_once 'nom-honor/sheet_sptjb_honor.php';

			$excel->setActiveSheetIndex(0);
			header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
			header('Content-Disposition: attachment; filename="NOM Honor ' . $viewPerjadin['nama_keg_kuitansi'] . '.xlsx"');
			header('Cache-Control: max-age=0');
			$write = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
			$write->save('php://output');
			exit;
		} else {
			echo '<div class="container-xxl flex-grow-1 container-p-y">
					<div class="card border border-primary col-6">
						<div class="card-body">
							<p>Error 404<br>Object not found!<br>The requested URL was not found on this server.</p>
						</div>
					</div>
				</div>';
		}
	} else {
		echo '<div class="container-xxl flex-grow-1 container-p-y">
				<div class="card border border-primary col-6">
					<div class="card-body">
						<p>Error 404<br>Object not found!<br>The requested URL was not found on this server.</p>
					</div>
				</div>
			</div>';
	}
}
