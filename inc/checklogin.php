<?php
require_once 'inc.koneksi.php';
require_once 'inc.library.php';

if (isset($_POST['username']) && isset($_POST['password'])) {
	$username = htmlspecialchars($_POST['username']);
	$password = htmlspecialchars($_POST['password']);
	$enc = encrypt($password);
	$num = mysqli_num_rows(mysqli_query($myConnection, "SELECT * FROM akun_manajemen WHERE user_manajemen='$username' and pass_manajemen='$enc' and status_manajemen = 'aktif' and soft_delete = 0 "));
	if ($num > 0) {
		echo 1;
	} else {
		echo 0;
	}
} else {
	echo "What are you doing?";
}
