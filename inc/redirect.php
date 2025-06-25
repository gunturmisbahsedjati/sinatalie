<?php
require_once 'inc.koneksi.php';
require_once 'inc.library.php';
$username = htmlspecialchars($_POST['username']);
$password = htmlspecialchars($_POST['password']);
$enc = encrypt($password);
$num = mysqli_query($myConnection, "SELECT * FROM akun_manajemen WHERE user_manajemen='$username' and pass_manajemen='$enc' and status_manajemen = 'aktif' and soft_delete = 0 ");
$akun = mysqli_fetch_array($num);

session_start();
$_SESSION['username'] = $akun['user_manajemen'];
$_SESSION['id'] = $akun['id_manajemen'];
$_SESSION['id_peg'] = $akun['id_peg'];
$_SESSION['level'] = $akun['level_manajemen'];
$_SESSION['nama_akun'] = $akun['nama_manajemen'];
$_SESSION['soft_delete'] = $akun['soft_delete'];
$_SESSION['status_login'] = true;
$_SESSION["login_time_stamp"] = time();
$arrayAkses = explode(",", $_SESSION['level']);
