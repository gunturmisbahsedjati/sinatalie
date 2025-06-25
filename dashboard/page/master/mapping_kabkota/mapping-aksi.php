<?php
include_once 'inc/inc.koneksi.php';
include_once 'inc/inc.library.php';
include_once 'inc/config.php';
if (!isset($_SESSION['status_login'])) {
    echo '<script type="text/javascript">
    window.location = "mapping"
    </script>';
    exit;
}
$arrayAkses = explode(",", $_SESSION['level']);

if (in_array(1, $arrayAkses)) {
    if (isset($_POST['updateMapping'])) {
        $created_by = $_SESSION['id'];
        $wilayah = htmlspecialchars(mysqli_escape_string($myConnection, decrypt($_POST['wilayah'])));
        $id = htmlspecialchars(mysqli_escape_string($myConnection, decrypt($_POST['_token'])));
        $besaran = htmlspecialchars(mysqli_escape_string($myConnection, bersihkan($_POST['besaran'])));
        $updateMapping = mysqli_query($myConnection, "update tb_kabkota set mapping = '$wilayah', besaran = '$besaran' where id = '$id'");
        if ($updateMapping) {
            $_SESSION['alert'] = "Toast.fire({icon: 'success',title: 'Data Mapping berhasil disimpan'})";
            echo "<script> window.location='mapping'; </script>";
        } else {
            $_SESSION['alert'] = "Toast.fire({icon: 'error',title: 'Data Mapping gagal disimpan'})";
            echo "<script> window.location='mapping'; </script>";
        }
    } elseif (isset($_POST['syncMapping'])) {
        $created_by = $_SESSION['id'];

        $map = getMapping($keySinadin);
        $reqMap = http_request($map);
        $cekMap = json_decode($reqMap, true);
        if ($cekMap['status']['code'] == '200') {
            $map = 1;
            $viewMap = isset($cekMap['results']) ? $cekMap['results'] : array();
        } else {
            $map = 0;
        }

        if ($map) {
            foreach ($viewMap as $viewMapArray) {
                $id = $viewMapArray['id'];
                $wilayah = $viewMapArray['mapping'];
                $besaran = $viewMapArray['besaran'];
                $updateMapping = mysqli_query($myConnection, "update tb_kabkota set mapping = '$wilayah', besaran = '$besaran' where id = '$id'");
            }
            $_SESSION['alert'] = "Toast.fire({icon: 'success',title: 'Data Mapping berhasil disinkron'})";
            echo "<script> window.location='mapping'; </script>";
        } else {
            $_SESSION['alert'] = "Toast.fire({icon: 'error',title: 'Koneksi Terputus !'})";
            echo "<script> window.location='mapping'; </script>";
        }
    } else {
        echo '<script type="text/javascript">
	window.location = "mapping"
	</script>';
    }
} else {
    echo '<script type="text/javascript">
    window.location = "./"
    </script>';
}
