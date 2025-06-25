<?php
include_once 'inc/inc.koneksi.php';
include_once 'inc/inc.library.php';
if (!isset($_SESSION['status_login'])) {
    echo '<script type="text/javascript">
    window.location = "category"
    </script>';
    exit;
}
$arrayAkses = explode(",", $_SESSION['level']);

if (in_array(1, $arrayAkses) || in_array(12, $arrayAkses)) {
    if (isset($_POST['addShopping'])) {
        $created_by = $_SESSION['id'];
        $id_akun_belanja = htmlspecialchars(mysqli_escape_string($myConnection, $_POST['id_akun_belanja']));
        $nama_akun_belanja = htmlspecialchars(mysqli_escape_string($myConnection, $_POST['nama_akun_belanja']));
        $jenis = htmlspecialchars(mysqli_escape_string($myConnection, $_POST['jenis']));

        $cekAkunBelanja = mysqli_query($myConnection, "select * from tb_akun_belanja where id_akun_belanja = '$id_akun_belanja' ");
        if (mysqli_num_rows($cekAkunBelanja) > 0) {
            $_SESSION['alert'] = "Toast.fire({icon: 'error',title: 'Kode Akun Belanja sudah terpakai'})";
            echo "<script> window.location='shoppingList'; </script>";
        } else {
            $insertShopping = mysqli_query($myConnection, "insert into tb_akun_belanja (id_akun_belanja, nama_akun_belanja, jenis) values ('$id_akun_belanja', '$nama_akun_belanja', '$jenis')");
            if ($insertShopping) {
                $_SESSION['alert'] = "Toast.fire({icon: 'success',title: 'Data Kategori berhasil ditambahkan'})";
                echo "<script> window.location='shoppingList'; </script>";
            } else {
                $_SESSION['alert'] = "Toast.fire({icon: 'error',title: 'Data Kategori gagal ditambahkan'})";
                echo "<script> window.location='shoppingList'; </script>";
            }
        }
    } elseif (isset($_POST['editShopping'])) {
        $created_by = $_SESSION['id'];
        $id = mysqli_escape_string($myConnection, decrypt($_POST['_token']));
        $id_akun_belanja = htmlspecialchars(mysqli_escape_string($myConnection, $_POST['id_akun_belanja']));
        $nama_akun_belanja = htmlspecialchars(mysqli_escape_string($myConnection, $_POST['nama_akun_belanja']));
        $jenis = htmlspecialchars(mysqli_escape_string($myConnection, $_POST['jenis']));
        $sqlCekID = mysqli_query($myConnection, "select * from tb_akun_belanja where id = '$id'");
        if (mysqli_num_rows($sqlCekID) > 0) {
            $update = mysqli_query($myConnection, "update tb_akun_belanja set id_akun_belanja = '$id_akun_belanja', nama_akun_belanja = '$nama_akun_belanja', jenis = '$jenis' where id = '$id'");
            if ($update) {
                $_SESSION['alert'] = "Toast.fire({icon: 'success',title: 'Data Kategori berhasil diubah'})";
                echo "<script> window.location='shoppingList'; </script>";
            } else {
                $_SESSION['alert'] = "Toast.fire({icon: 'error',title: 'Data Kategori gagal diubah'})";
                echo "<script> window.location='shoppingList'; </script>";
            }
        } else {
            $_SESSION['alert'] = "Toast.fire({icon: 'error',title: 'SQL Injection terdeteksi'})";
            echo "<script> window.location='shoppingList'; </script>";
        }
    } elseif (isset($_POST['delShopping'])) {
        $created_by = $_SESSION['id'];
        $id = mysqli_escape_string($myConnection, decrypt($_POST['_token']));
        $id_akun_belanja = mysqli_escape_string($myConnection, decrypt($_POST['_key']));
        $sqlCekID = mysqli_query($myConnection, "select * from tb_akun_belanja where id = '$id' and id_akun_belanja = '$id_akun_belanja'");
        if (mysqli_num_rows($sqlCekID) > 0) {
            $del = mysqli_query($myConnection, "delete from tb_akun_belanja where id = '$id' and id_akun_belanja = '$id_akun_belanja'");
            if ($del) {
                $_SESSION['alert'] = "Toast.fire({icon: 'success',title: 'Data Kategori berhasil dihapus'})";
                echo "<script> window.location='shoppingList'; </script>";
            } else {
                $_SESSION['alert'] = "Toast.fire({icon: 'error',title: 'Data Kategori gagal dihapus'})";
                echo "<script> window.location='shoppingList'; </script>";
            }
        } else {
            $_SESSION['alert'] = "Toast.fire({icon: 'error',title: 'SQL Injection terdeteksi'})";
            echo "<script> window.location='shoppingList'; </script>";
        }
    } else {
        echo '<script type="text/javascript">
	window.location = "shoppingList"
	</script>';
    }
} else {
    echo '<script type="text/javascript">
    window.location = "./"
    </script>';
}
