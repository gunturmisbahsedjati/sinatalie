<?php
include_once 'inc/inc.koneksi.php';
include_once 'inc/inc.library.php';
include_once 'inc/config.php';
if (!isset($_SESSION['status_login'])) {
    echo '<script type="text/javascript">
    window.location = "period"
    </script>';
    exit;
}
$arrayAkses = explode(",", $_SESSION['level']);

if (in_array(1, $arrayAkses)) {
    if (isset($_POST['syncEmployee'])) {
        $getAllEmployee1 = getAllEmployee($keySiratu);
        $cek = http_request($getAllEmployee1);
        $getAllEmployeeView = json_decode($cek, true);
        $getAllPosition1 = getAllPosition($keySiratu);
        $cekJabatan = http_request($getAllPosition1);
        $getAllPositionView = json_decode($cekJabatan, true);
        if ($getAllEmployeeView['status']['code'] == '200' && $getAllPositionView['status']['code'] == '200') {
            $result = isset($getAllEmployeeView['results']) ? $getAllEmployeeView['results'] : array();
            $resultPosition = isset($getAllPositionView['results']) ? $getAllPositionView['results'] : array();

            foreach ($result as $arrName) {
                $id_peg = $arrName['id_peg'];
                $nama_peg = mysqli_escape_string($myConnection, $arrName['nama_peg']);
                $nip = $arrName['nip'];
                $id_pangkat = $arrName['id_pangkat'];
                $jabatan = $arrName['jabatan'];
                $kelompok_peg = $arrName['kelompok_peg'];
                $jk = $arrName['jk'];
                $status_peg = $arrName['status_peg'];
                $pin_absen = $arrName['pin_absen'];
                $soft_delete = $arrName['soft_delete'];
                $alasan = $arrName['alasan'];
                $created_date = $arrName['created_date'];

                $sqlSync = mysqli_query($myConnection, "select * from tb_pegawai where id_peg = '$id_peg'");
                if (mysqli_num_rows($sqlSync) > 0) {
                    $sync = mysqli_query($myConnection, "update tb_pegawai set
                    nama_peg = '$nama_peg',
                    nip = '$nip',
                    id_pangkat = '$id_pangkat',
                    jabatan = '$jabatan',
                    kelompok_peg = '$kelompok_peg',
                    jk = '$jk',
                    status_peg = '$status_peg',
                    pin_absen = '$pin_absen',
                    soft_delete = '$soft_delete',
                    alasan = '$alasan',
                    created_date = '$created_date'
                    where id_peg = '$id_peg' ");
                } else {
                    $sync = mysqli_query($myConnection, "insert into tb_pegawai (id_peg, nama_peg, nip, id_pangkat, jabatan, kelompok_peg, jk, status_peg, pin_absen, soft_delete, alasan, created_date) values ('$id_peg','$nama_peg','$nip','$id_pangkat','$jabatan','$kelompok_peg','$jk','$status_peg','$pin_absen','$soft_delete','$alasan','$created_date')");
                }
            }

            foreach ($resultPosition as $arrNamePosition) {
                $kd_jabatan = $arrNamePosition['kd_jabatan'];
                $nama_jabatan = mysqli_escape_string($myConnection, $arrNamePosition['nama_jabatan']);

                $sqlSync = mysqli_query($myConnection, "select * from tb_jabatan where kd_jabatan = '$kd_jabatan'");
                if (mysqli_num_rows($sqlSync) > 0) {
                    $sync = mysqli_query($myConnection, "update tb_jabatan set
                    nama_jabatan = '$nama_jabatan'
                    where kd_jabatan = '$kd_jabatan' ");
                } else {
                    $sync = mysqli_query($myConnection, "insert into tb_jabatan (nama_jabatan) values ('$nama_jabatan')");
                }
            }

            $_SESSION['alert'] = "Toast.fire({icon: 'success',title: 'Data Pegawai Diperbaharui'})";
            echo "<script> window.location='employee'; </script>";
        } else {
            $_SESSION['alert'] = "Toast.fire({icon: 'error',title: 'Koneksi Terputus !'})";
            echo "<script> window.location='employee'; </script>";
        }
    } else {
        echo '<script type="text/javascript">
	window.location = "period"
	</script>';
    }
} else {
    echo '<script type="text/javascript">
    window.location = "./"
    </script>';
}
