<?php
include_once 'inc/inc.koneksi.php';
include_once 'inc/inc.library.php';
include_once 'inc/config.php';
if (!isset($_SESSION['status_login'])) {
    echo '<script type="text/javascript">
    window.location = "dipaList"
    </script>';
    exit;
}
$arrayAkses = explode(",", $_SESSION['level']);

if (in_array(1, $arrayAkses)) {
    if (isset($_POST['syncDipa'])) {
        $dipa = getDIPA($keySinadin);
        $reqDIPA = http_request($dipa);
        $cekDIPA = json_decode($reqDIPA, true);
        if ($cekDIPA['status']['code'] == '200') {
            $dipa = 1;
            $viewDIPA = isset($cekDIPA['results']) ? $cekDIPA['results'] : array();
        } else {
            $dipa = 0;
        }
        if ($dipa) {
            foreach ($viewDIPA as $viewDIPAArray) {
                $id_profil_sptjb = $viewDIPAArray['id_profil_sptjb'];
                $nama_satker = $viewDIPAArray['nama_satker'];
                $kode_satker = $viewDIPAArray['kode_satker'];
                $no_dipa = $viewDIPAArray['no_dipa'];
                $tgl_dipa = $viewDIPAArray['tgl_dipa'];
                $klasifikasi = $viewDIPAArray['klasifikasi'];
                $thn_anggaran = $viewDIPAArray['thn_anggaran'];
                $soft_delete = $viewDIPAArray['soft_delete'];
                $created_date = $viewDIPAArray['created_date'];

                $sqlSync = mysqli_query($myConnection, "select * from tb_profil_sptjb where id_profil_sptjb = '$id_profil_sptjb'");
                if (mysqli_num_rows($sqlSync) > 0) {
                    mysqli_query($myConnection, "update tb_profil_sptjb set 
                    nama_satker = '$nama_satker',
                    kode_satker = '$kode_satker',
                    no_dipa = '$no_dipa',
                    tgl_dipa = '$tgl_dipa',
                    klasifikasi = '$klasifikasi',
                    thn_anggaran = '$thn_anggaran',
                    soft_delete = '$soft_delete',
                    created_date = '$created_date'
                    where id_profil_sptjb = '$id_profil_sptjb'");
                } else {
                    mysqli_query($myConnection, "insert into tb_profil_sptjb (id_profil_sptjb, nama_satker, kode_satker, no_dipa, tgl_dipa, klasifikasi, thn_anggaran, soft_delete, created_date) values ('$id_profil_sptjb', '$nama_satker', '$kode_satker', '$no_dipa', '$tgl_dipa', '$klasifikasi', '$thn_anggaran', '$soft_delete', NOW())");
                }
            }
            $_SESSION['alert'] = "Toast.fire({icon: 'success',title: 'Data DIPA Diperbaharui'})";
            echo "<script> window.location='dipaList'; </script>";
        } else {
            $_SESSION['alert'] = "Toast.fire({icon: 'error',title: 'Koneksi Terputus !'})";
            echo "<script> window.location='dipaList'; </script>";
        }
    } else {
        echo '<script type="text/javascript">
	window.location = "dipaList"
	</script>';
    }
} else {
    echo '<script type="text/javascript">
    window.location = "./"
    </script>';
}
