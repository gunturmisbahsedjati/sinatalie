<?php
include_once 'inc/inc.koneksi.php';
include_once 'inc/inc.library.php';
include_once 'inc/config.php';
if (!isset($_SESSION['status_login'])) {
    echo '<script type="text/javascript">
    window.location = "account"
    </script>';
    exit;
}
$arrayAkses = explode(",", $_SESSION['level']);

if (in_array(1, $arrayAkses)) {
    if (isset($_GET['insertDocumentOffice'])) {
        $code2 = time() . '-' . uniqid();
        $code = strtoupper($code2);
        $created_by = $_SESSION['id'];
        $token = mysqli_escape_string($myConnection, decrypt($_GET['_token']));

        $sbm = mysqli_fetch_array(mysqli_query($myConnection, "select besaran from tb_kabkota where id = 3578"));
        $sbmSurabaya = $sbm['besaran'];

        // insert kegiatan
        $getDataSTPerjadinByID = getDataSTPerjadinByID($keySiratu, $token);
        $insertKeg = http_request($getDataSTPerjadinByID);
        $getDataSTPerjadinByIDView = json_decode($insertKeg, true);
        if ($getDataSTPerjadinByIDView['status']['code'] == '200') {
            $resultView = isset($getDataSTPerjadinByIDView['results']) ? $getDataSTPerjadinByIDView['results'] : array();
            foreach ($resultView as $arrName) {
                $id_st = $arrName['id_st'];
                $nama_keg = $arrName['nama_keg'];
                $tgl_mulai = $arrName['tgl_mulai'];
                $tgl_selesai = $arrName['tgl_selesai'];
                $tgl_mulai2 = $arrName['tgl_mulai2'] == '' || $arrName['tgl_mulai2'] == '0000-00-00' ? $tgl_mulai : $arrName['tgl_mulai2'];
                $tgl_selesai2 = $arrName['tgl_selesai2'] == '' || $arrName['tgl_selesai2'] == '0000-00-00' ? $tgl_selesai : $arrName['tgl_selesai2'];
                $tmpt_keg = $arrName['tmpt_keg'];
                $alamat_keg = $arrName['alamat_keg'];
                $kabkota = $arrName['kabkota'];
                $bln_st = $arrName['bln_st'];
                $thn_st = $arrName['thn_st'];
                $insertKeg = mysqli_query($myConnection, "insert into tb_kegiatan (id_keg, id_st_siratu, nama_keg, nama_keg_kuitansi, tgl_mulai, tgl_selesai, tgl_mulai2, tgl_selesai2, tempat_keg, alamat_keg, kabkota, bln_st, thn_st, jenis_perjadin) values ('$code', '$token', '$nama_keg', '$nama_keg', '$tgl_mulai', '$tgl_selesai', '$tgl_mulai2', '$tgl_selesai2', '$tmpt_keg', '$alamat_keg', '$kabkota', '$bln_st', '$thn_st', 'kantor')");
            }
            $getDataPegSTPerjadin = getDataPegSTPerjadin($keySiratu, $token);
            $peg = http_request($getDataPegSTPerjadin);
            $getDataPegSTPerjadinView = json_decode($peg, true);
            if ($getDataPegSTPerjadinView['status']['code'] == '200') {
                $resultPeg = isset($getDataPegSTPerjadinView['results']) ? $getDataPegSTPerjadinView['results'] : array();
                $sqlInsertPeg = "insert into tb_panitia_keg_kantor (id_panitia_keg_kantor, id_keg, id_peg_st_siratu, id_st_siratu, id_peg, id_jab_st, nama, nip, gol, pangkat, id_pangkat_gol, jabatan, unit_kerja, alamat_unit_kerja, kabkota_unit_kerja, id_kabkota_unit_kerja, no_hp, tgl_mulai, tgl_selesai, lokal, jenis_panitia, created_by) values";
                foreach ($resultPeg as $arrPeg) {
                    $codePeg2 = time() . '-' . uniqid();
                    $codePeg = strtoupper($codePeg2);
                    $id_peg_st = $arrPeg['id_peg_st'];
                    $id_peg = $arrPeg['id_peg'];
                    $id_jab_st = $arrPeg['id_jab_st'];
                    $nama_peg = $arrPeg['nama_peg'];
                    $nip = $arrPeg['nip'];
                    $id_pangkat = $arrPeg['id_pangkat'];
                    $gol = $arrPeg['gol'];
                    $pangkat = $arrPeg['pangkat'];
                    $jabatan = $arrPeg['jabatan'];
                    $unit_kerja = 'BBPMP Provinsi Jawa Timur';
                    $alamat_unit_kerja = 'Kota Surabaya';
                    $id_kabkota = 3578;
                    $no_hp = "-";

                    $id_kabkota_unit_kerja = $arrPeg['id_jab_st'];

                    $sqlInsertPeg .= "('" . $codePeg . "','" . $code . "','" . $id_peg_st . "','" . $token . "','" . $id_peg . "', '" . $id_jab_st . "', '" . $nama_peg . "', '" . $nip . "', '" . $gol . "', '" . $pangkat . "', '" . $id_pangkat . "', '" . $jabatan . "', '" . $unit_kerja . "', '" . $alamat_unit_kerja . "', '" . $alamat_unit_kerja . "', '" . $id_kabkota . "', '" . $no_hp . "', '" . $tgl_mulai . "', '" . $tgl_selesai . "', '" . $sbmSurabaya . "', 'internal', '" . $created_by . "'), ";
                }
                $insertPeg = rtrim($sqlInsertPeg, ', ');
                // echo $insertPeg;
                $insertPetugas = mysqli_query($myConnection, $insertPeg);
            }
            $_SESSION['alert'] = "Toast.fire({icon: 'success',title: 'Data berhasil disimpan'})";
            echo '<script> window.location="documentOffice?_token=' . encrypt($thn_st) . '"; </script>';
        } else {
            $_SESSION['alert'] = "Toast.fire({icon: 'error',title: 'SQL Injection terdeteksi'})";
            echo '<script> window.location="documentOffice?_token=' . encrypt($thn_st) . '"; </script>';
        }
    } elseif (isset($_POST['delDocumentOffice'])) {
        $created_by = $_SESSION['id'];
        $id_keg = mysqli_escape_string($myConnection, decrypt($_POST['_token']));
        $thnST = mysqli_fetch_array(mysqli_query($myConnection, "select * from tb_kegiatan where id_keg = '$id_keg' "));
        $thn_st = $thnST['thn_st'];
        $delKeg = mysqli_query($myConnection, "delete from tb_kegiatan where id_keg = '$id_keg'");
        $delPanitia = mysqli_query($myConnection, "delete from tb_panitia_keg_kantor where id_keg = '$id_keg'");
        $delPeserta = mysqli_query($myConnection, "delete from tb_peserta_keg_kantor where id_keg = '$id_keg'");
        $delPengarah = mysqli_query($myConnection, "delete from tb_pengarah_keg_kantor where id_keg = '$id_keg'");
        $delPetugas = mysqli_query($myConnection, "delete from tb_petugas_keuangan_keg_hotel where id_keg = '$id_keg'");
        if ($delKeg && $delPanitia && $delPeserta && $delPengarah && $delPetugas) {
            $_SESSION['alert'] = "Toast.fire({icon: 'success',title: 'Data berhasil dihapus'})";
            echo '<script> window.location="documentOffice?_token=' . encrypt($thn_st) . '"; </script>';
        } else {
            $_SESSION['alert'] = "Toast.fire({icon: 'error',title: 'Data berhasil dihapus'})";
            echo '<script> window.location="documentOffice?_token=' . encrypt($thn_st) . '"; </script>';
        }
    } elseif (isset($_POST['documentOfficeStatus'])) {
        $created_by = $_SESSION['id'];
        $id_keg = mysqli_escape_string($myConnection, decrypt($_POST['_token']));
        $status = mysqli_escape_string($myConnection, decrypt($_POST['_key']));
        $thnST = mysqli_fetch_array(mysqli_query($myConnection, "select * from tb_kegiatan where id_keg = '$id_keg' "));
        $thn_st = $thnST['thn_st'];
        $updateStatus = mysqli_query($myConnection, "update tb_kegiatan set status = '$status' where id_keg = '$id_keg'");
        if ($updateStatus) {
            $_SESSION['alert'] = "Toast.fire({icon: 'success',title: 'Status Kegiatan berhasil diubah'})";
            echo '<script> window.location="documentOffice?_token=' . encrypt($thn_st) . '"; </script>';
        } else {
            $_SESSION['alert'] = "Toast.fire({icon: 'error',title: 'Status Kegiatan berhasil diubah'})";
            echo '<script> window.location="documentOffice?_token=' . encrypt($thn_st) . '"; </script>';
        }
    } elseif (isset($_POST['uploadParticipantOffice'])) {
        $created_by = $_SESSION['id'];
        $now = date("dmYHis");
        $id_keg = decrypt($_POST['_token']);
        $sql_tgl_keg = mysqli_fetch_array(mysqli_query($myConnection, "select * from tb_kegiatan where id_keg = '$id_keg'"));
        $tgl_mulai = $sql_tgl_keg['tgl_mulai'];
        $tgl_selesai = $sql_tgl_keg['tgl_selesai'];
        $type = explode(".", $_FILES['file_excel']['name']);
        $target_dir = "temp_folder_uploads/" . $now . "." . strtolower(end($type));
        move_uploaded_file($_FILES['file_excel']['tmp_name'], $target_dir);
        require('assets/vendor/libs/upload_excel/excel_reader2.php');
        require('assets/vendor/libs/upload_excel/SpreadsheetReader.php');
        $Reader = new SpreadsheetReader($target_dir);
        foreach ($Reader->Sheets() as $sheet) {
            $arraySheet[] = $sheet;
        }
        $sqlPeserta = "insert into tb_peserta_keg_kantor (id_peserta_keg_kantor, id_keg, nama, nip, gol, jabatan, unit_kerja, alamat_unit_kerja, kabkota_unit_kerja, id_kabkota_unit_kerja, status_kabkota_unit_kerja, no_hp, tgl_mulai, tgl_selesai, tiket_pesawat, tiket_kapal, tiket,lokal, taksi, toll, bbm, dpr1, jenis_peserta, created_by) values ";
        if (in_array('import_sinatalie', $arraySheet)) {
            foreach ($Reader as $Key => $Row) {
                $code2 = time() . '-' . uniqid();
                $code = strtoupper($code2);
                if ($Key < 1) continue;
                // $no_reg = htmlspecialchars(addslashes($Row[1]));
                if (isset($Row[0])) {
                    $nama = mysqli_escape_string($myConnection, $Row[1]);
                    $nip = mysqli_escape_string($myConnection, bersihkan($Row[2]));
                    $gol = mysqli_escape_string($myConnection, $Row[3]);
                    $jabatan = mysqli_escape_string($myConnection, $Row[4]);
                    $unit_kerja = mysqli_escape_string($myConnection, $Row[5]);
                    $alamat_unit_kerja = mysqli_escape_string($myConnection, $Row[7]);
                    $kabkota_unit_kerja = mysqli_escape_string($myConnection, $Row[6]);
                    $no_hp = mysqli_escape_string($myConnection, $Row[8]);
                    $tiket_pesawat = !isset($Row[8]) ? '' : mysqli_escape_string($myConnection, bersihkan($Row[9]));
                    $tiket_kapal = !isset($Row[9]) ? '' : mysqli_escape_string($myConnection, bersihkan($Row[10]));
                    $tiket = !isset($Row[10]) ? '' : mysqli_escape_string($myConnection, bersihkan($Row[11]));
                    $lokal = !isset($Row[11]) ? '' : mysqli_escape_string($myConnection, bersihkan($Row[12]));
                    $taksi = !isset($Row[12]) ? '' : mysqli_escape_string($myConnection, bersihkan($Row[13]));
                    $toll = !isset($Row[13]) ? '' : mysqli_escape_string($myConnection, bersihkan($Row[14]));
                    $bbm = !isset($Row[14]) ? '' : mysqli_escape_string($myConnection, bersihkan($Row[15]));
                    $dpr1 = !isset($Row[15]) ? '' : mysqli_escape_string($myConnection, bersihkan($Row[16]));
                    $jenis_peserta = !isset($Row[17]) ? 'eksternal' : mysqli_escape_string($myConnection, $Row[17]);
                    // $penginapan = !isset($Row[16]) ? '' : mysqli_escape_string($myConnection, bersihkan($Row[16]));


                    $kabkota_unit_kerja_lengkap = str_replace(["Kab. ", "Kota "], ["Kabupaten ", "Kota "], $kabkota_unit_kerja);
                    $sql_kabkota_unit_kerja = mysqli_query($myConnection, "select id from tb_kabkota where name = '$kabkota_unit_kerja_lengkap'");
                    if (mysqli_num_rows($sql_kabkota_unit_kerja) > 0) {
                        $viewKode = mysqli_fetch_array($sql_kabkota_unit_kerja);
                        $id_kabkota_unit_kerja = $viewKode['id'];
                    } else {
                        $id_kabkota_unit_kerja = '0';
                    }

                    // echo $kabkota_unit_kerja . '-' . $kabkota_unit_kerja_lengkap . '-' . $id_kabkota_unit_kerja . '<br>';
                }
                // if ($no_reg != '') {

                // $sqlCekNoReg = mysqli_query($myConnection, "select no_reg_peserta from tb_peserta_keg_hotel where no_reg_peserta = '$no_reg'");
                // if (mysqli_num_rows($sqlCekNoReg) == 0) {
                $sqlPeserta .= "('$code', '$id_keg', '$nama', '$nip', '$gol', '$jabatan', '$unit_kerja', '$alamat_unit_kerja', '$kabkota_unit_kerja', '$id_kabkota_unit_kerja', 'Daratan', '$no_hp', '$tgl_mulai', '$tgl_selesai', '$tiket_pesawat','$tiket_kapal','$tiket','$lokal','$taksi','$toll','$bbm','$dpr1', '$jenis_peserta','$created_by'), ";
                // }

                // buat logika sudah ada no reg d database
                // }
            }
            $insertPeserta = rtrim($sqlPeserta, ', ');

            // echo $insertPeserta;
            $insertPesertaHotel = mysqli_query($myConnection, $insertPeserta);
            if ($insertPesertaHotel) {
                $_SESSION['alert'] = "Toast.fire({icon: 'success',title: 'Data Peserta berhasil disimpan'})";
                echo '<script> window.location="checkDocumentOffice?_token=' . encrypt($id_keg) . '&_type=peserta"; </script>';
            } else {
                $_SESSION['alert'] = "Toast.fire({icon: 'error',title: 'Data Peserta gagal disimpan'})";
                echo '<script> window.location="checkDocumentOffice?_token=' . encrypt($id_keg) . '&_type=peserta"; </script>';
            }
        } else {
            $_SESSION['alert'] = "Toast.fire({icon: 'error',title: 'Sheet import_sinatalie tidak ditemukan'})";
            echo '<script> window.location="checkDocumentOffice?_token=' . encrypt($id_keg) . '&_type=peserta"; </script>';
        }
    } elseif (isset($_POST['delAllParticipantOffice'])) {
        $created_by = $_SESSION['id'];
        $id_keg = mysqli_escape_string($myConnection, decrypt($_POST['_token']));
        $cekKeg = mysqli_query($myConnection, "select * from tb_kegiatan where id_keg = '$id_keg' ");
        if (mysqli_num_rows($cekKeg) > 0) {
            $delPeserta = mysqli_query($myConnection, "delete from tb_peserta_keg_kantor where id_keg = '$id_keg'");
            if ($delPeserta) {
                $_SESSION['alert'] = "Toast.fire({icon: 'success',title: 'Data berhasil dihapus'})";
                echo '<script> window.location="checkDocumentOffice?_token=' . encrypt($id_keg) . '&_type=peserta"; </script>';
            } else {
                $_SESSION['alert'] = "Toast.fire({icon: 'error',title: 'Data gagal dihapus'})";
                echo '<script> window.location="checkDocumentOffice?_token=' . encrypt($id_keg) . '&_type=peserta"; </script>';
            }
        } else {
            $_SESSION['alert'] = "Toast.fire({icon: 'error',title: 'SQL Injection Detected !'})";
            echo '<script> window.location="checkDocumentOffice?_token=' . encrypt($id_keg) . '&_type=peserta"; </script>';
        }
    } elseif (isset($_POST['saveTakeDailyCosts'])) {
        $created_by = $_SESSION['id'];
        $id_keg = mysqli_escape_string($myConnection, decrypt($_POST['_token']));

        $sqlKeg = mysqli_query($myConnection, "select * from tb_kegiatan where id_keg = '$id_keg'");
        if (mysqli_num_rows($sqlKeg) > 0) {
            $viewKeg = mysqli_fetch_array($sqlKeg);
            $nomUH = $viewKeg['uh_peserta'];
            echo $nomUH;
            $cekPeserta = mysqli_query($myConnection, "select * from tb_peserta_keg_hotel where id_keg = '$id_keg'");
            if (mysqli_num_rows($cekPeserta) > 0) {
                // $save = mysqli_query($myConnection, "update tb_peserta_keg_hotel set uang_harian = '$nomUH' where id_keg = '$id_keg' ");
                // if ($save) {
                //     $_SESSION['alert'] = "Toast.fire({icon: 'success',title: 'Uang Harian Peserta berhasil disimpan'})";
                //     echo '<script> window.location="checkDocumentOffice?_token=' . encrypt($id_keg) . '&_type=peserta"; </script>';
                // } else {
                //     $_SESSION['alert'] = "Toast.fire({icon: 'error',title: 'Uang Harian Peserta gagal disimpan'})";
                //     echo '<script> window.location="checkDocumentOffice?_token=' . encrypt($id_keg) . '&_type=peserta"; </script>';
                // }
            } else {
                $_SESSION['alert'] = "Toast.fire({icon: 'error',title: 'Data Peserta Tidak Ditemukan'})";
                echo '<script> window.location="checkDocumentOffice?_token=' . encrypt($id_keg) . '&_type=peserta"; </script>';
            }
        } else {
            $_SESSION['alert'] = "Toast.fire({icon: 'error',title: 'SQL Injection Detected !'})";
            echo '<script> window.location="checkDocumentOffice?_token=' . encrypt($id_keg) . '&_type=peserta"; </script>';
        }
    } elseif (isset($_POST['inputTransportParticipantOffice'])) {
        $created_by = $_SESSION['id'];
        $id_keg = mysqli_escape_string($myConnection, decrypt($_POST['_token']));
        $id_peserta_keg_kantor = mysqli_escape_string($myConnection, decrypt($_POST['_id']));

        $cekPeserta = mysqli_query($myConnection, "select * from tb_peserta_keg_kantor where id_keg = '$id_keg' and id_peserta_keg_kantor = '$id_peserta_keg_kantor'");
        if (mysqli_num_rows($cekPeserta) > 0) {
            $bbm = mysqli_escape_string($myConnection, bersihkan($_POST['bbm']));
            $tiket_pesawat = mysqli_escape_string($myConnection, bersihkan($_POST['tiket_pesawat']));
            $tiket_kapal = mysqli_escape_string($myConnection, bersihkan($_POST['tiket_kapal']));
            $tiket = mysqli_escape_string($myConnection, bersihkan($_POST['tiket']));
            $lokal = mysqli_escape_string($myConnection, bersihkan($_POST['lokal']));
            $taksi = mysqli_escape_string($myConnection, bersihkan($_POST['taksi']));
            $toll = mysqli_escape_string($myConnection, bersihkan($_POST['toll']));
            $dpr1 = mysqli_escape_string($myConnection, bersihkan($_POST['dpr1']));
            $penginapan = mysqli_escape_string($myConnection, bersihkan($_POST['penginapan']));
            // $dpr2 = mysqli_escape_string($myConnection, bersihkan($_POST['dpr2']));
            $tgl_mulai = substr($_POST['tgl_mulai'], 6, 4) . '-' . substr($_POST['tgl_mulai'], 3, 2) . '-' . substr($_POST['tgl_mulai'], 0, 2);
            $tgl_selesai = substr($_POST['tgl_selesai'], 6, 4) . '-' . substr($_POST['tgl_selesai'], 3, 2) . '-' . substr($_POST['tgl_selesai'], 0, 2);
            $status_kabkota_unit_kerja = isset($_POST['status_kabkota_unit_kerja']) ? 'Daratan' : mysqli_escape_string($myConnection, $_POST['status_kabkota_unit_kerja']);

            $input = mysqli_query($myConnection, "update tb_peserta_keg_kantor set
            tgl_mulai = '$tgl_mulai',
            tgl_selesai = '$tgl_selesai',
            bbm = '$bbm',
            tiket = '$tiket',
            tiket_pesawat = '$tiket_pesawat',
            tiket_kapal = '$tiket_kapal',
            lokal = '$lokal',
            taksi = '$taksi',
            toll = '$toll',
            dpr1 = '$dpr1',
            penginapan = '$penginapan',
            status_kabkota_unit_kerja = '$status_kabkota_unit_kerja'
            where id_peserta_keg_kantor = '$id_peserta_keg_kantor' and id_keg = '$id_keg' ");
            if ($input) {
                $_SESSION['alert'] = "Toast.fire({icon: 'success',title: 'Transport berhasil disimpan'})";
                echo '<script> window.location="checkDocumentOffice?_token=' . encrypt($id_keg) . '&_type=peserta"; </script>';
            } else {
                $_SESSION['alert'] = "Toast.fire({icon: 'error',title: 'Transport gagal disimpan'})";
                echo '<script> window.location="checkDocumentOffice?_token=' . encrypt($id_keg) . '&_type=peserta"; </script>';
            }
        } else {
            $_SESSION['alert'] = "Toast.fire({icon: 'error',title: 'SQL Injection Detected !'})";
            echo '<script> window.location="checkDocumentOffice?_token=' . encrypt($id_keg) . '&_type=peserta"; </script>';
        }
    } elseif (isset($_POST['delParticipantOffice'])) {
        $created_by = $_SESSION['id'];
        $id_keg = mysqli_escape_string($myConnection, decrypt($_POST['_token']));
        $id_peserta_keg_kantor = mysqli_escape_string($myConnection, decrypt($_POST['_id']));

        $cekPeserta = mysqli_query($myConnection, "select * from tb_peserta_keg_kantor where id_keg = '$id_keg' and id_peserta_keg_kantor = '$id_peserta_keg_kantor'");
        if (mysqli_num_rows($cekPeserta) > 0) {

            $input = mysqli_query($myConnection, "delete from tb_peserta_keg_kantor where id_peserta_keg_kantor = '$id_peserta_keg_kantor' and id_keg = '$id_keg' ");
            if ($input) {
                $_SESSION['alert'] = "Toast.fire({icon: 'success',title: 'Peserta berhasil dihapus'})";
                echo '<script> window.location="checkDocumentOffice?_token=' . encrypt($id_keg) . '&_type=peserta"; </script>';
            } else {
                $_SESSION['alert'] = "Toast.fire({icon: 'error',title: 'Peserta gagal dihapus'})";
                echo '<script> window.location="checkDocumentOffice?_token=' . encrypt($id_keg) . '&_type=peserta"; </script>';
            }
        } else {
            $_SESSION['alert'] = "Toast.fire({icon: 'error',title: 'SQL Injection Detected !'})";
            echo '<script> window.location="checkDocumentOffice?_token=' . encrypt($id_keg) . '&_type=peserta"; </script>';
        }
    } elseif (isset($_POST['saveTransportParticipantOffice'])) {
        $id_keg = mysqli_escape_string($myConnection, decrypt($_POST['saveTransportParticipantOffice']));
        // echo $id_keg;
        if (isset($_POST['_id'])) {
            $bbm1 = $_POST['bbm'];
            $tiket1 = $_POST['tiket'];
            $tiket_pesawat1 = $_POST['tiket_pesawat'];
            $tiket_kapal1 = $_POST['tiket_kapal'];
            $lokal1 = $_POST['lokal'];
            $taksi1 = $_POST['taksi'];
            $toll1 = $_POST['toll'];
            $dpr11 = $_POST['dpr1'];
            // $dpr21 = $_POST['dpr2'];
            $id_peserta_keg_kantor1 = $_POST['_id'];
            $tgl_mulai1 = $_POST['tgl_mulai'];
            $tgl_selesai1 = $_POST['tgl_selesai'];
            $totalPeserta = count($id_peserta_keg_kantor1);
            for ($i = 0; $i < $totalPeserta; $i++) {
                $id_peserta_keg_kantor = mysqli_escape_string($myConnection, decrypt($id_peserta_keg_kantor1[$i]));
                $bbm = isset($bbm1[$i]) ? mysqli_escape_string($myConnection, bersihkan($bbm1[$i])) : '';
                $tiket =  isset($tiket1[$i]) ? mysqli_escape_string($myConnection, bersihkan($tiket1[$i])) : '';
                $tiket_pesawat =  isset($tiket_pesawat1[$i]) ? mysqli_escape_string($myConnection, bersihkan($tiket_pesawat1[$i])) : '';
                $tiket_kapal =  isset($tiket_kapal1[$i]) ? mysqli_escape_string($myConnection, bersihkan($tiket_kapal1[$i])) : '';
                $lokal =  isset($lokal1[$i]) ? mysqli_escape_string($myConnection, bersihkan($lokal1[$i])) : '';
                $taksi =  isset($taksi1[$i]) ? mysqli_escape_string($myConnection, bersihkan($taksi1[$i])) : '';
                $toll =  isset($toll1[$i]) ? mysqli_escape_string($myConnection, bersihkan($toll1[$i])) : '';
                $dpr1 =  isset($dpr11[$i]) ? mysqli_escape_string($myConnection, bersihkan($dpr11[$i])) : '';
                // $dpr2 = mysqli_escape_string($myConnection, bersihkan($dpr21[$i]));
                $tgl_mulai = substr($tgl_mulai1[$i], 6, 4) . '-' . substr($tgl_mulai1[$i], 3, 2) . '-' . substr($tgl_mulai1[$i], 0, 2);
                $tgl_selesai = substr($tgl_selesai1[$i], 6, 4) . '-' . substr($tgl_selesai1[$i], 3, 2) . '-' . substr($tgl_selesai1[$i], 0, 2);
                $input = mysqli_query($myConnection, "update tb_peserta_keg_kantor set
            tgl_mulai = '$tgl_mulai',
            tgl_selesai = '$tgl_selesai',
            bbm = '$bbm',
            tiket = '$tiket',
            tiket_pesawat = '$tiket_pesawat',
            tiket_kapal = '$tiket_kapal',
            lokal = '$lokal',
            taksi = '$taksi',
            toll = '$toll',
            dpr1 = '$dpr1'
            where id_peserta_keg_kantor = '$id_peserta_keg_kantor' and id_keg = '$id_keg' ");
            }
            if ($input) {
                $_SESSION['alert'] = "Toast.fire({icon: 'success',title: 'Transport berhasil disimpan'})";
                echo '<script> window.location="checkDocumentOffice?_token=' . encrypt($id_keg) . '&_type=peserta"; </script>';
            } else {
                $_SESSION['alert'] = "Toast.fire({icon: 'error',title: 'Transport gagal disimpan'})";
                echo '<script> window.location="checkDocumentOffice?_token=' . encrypt($id_keg) . '&_type=peserta"; </script>';
            }
        } else {
            $_SESSION['alert'] = "Toast.fire({icon: 'error',title: 'SQL Injection Detected !'})";
            echo '<script> window.location="checkDocumentOffice?_token=' . encrypt($id_keg) . '&_type=peserta"; </script>';
        }
    } elseif (isset($_POST['settingReceiptOffice'])) {
        $created_by = $_SESSION['id'];
        $id_keg = mysqli_escape_string($myConnection, decrypt($_POST['_token']));
        $id_pejabat = mysqli_escape_string($myConnection, $_POST['pejabat']);
        $id_ppk = mysqli_escape_string($myConnection, $_POST['ppk']);
        $id_bendahara = mysqli_escape_string($myConnection, $_POST['bendahara']);
        $no_sptjb_perjadin = mysqli_escape_string($myConnection, $_POST['no_sptjb_perjadin']);
        $sptjb_perjadin = mysqli_escape_string($myConnection, $_POST['sptjb_perjadin']);
        $no_sptjb_perjadin = mysqli_escape_string($myConnection, $_POST['no_sptjb_perjadin']);
        $tgl_sptjb_perjadin = substr($_POST['tgl_sptjb_perjadin'], 6, 4) . '-' . substr($_POST['tgl_sptjb_perjadin'], 3, 2) . '-' . substr($_POST['tgl_sptjb_perjadin'], 0, 2);
        $tgl_perjadin = $tgl_sptjb_perjadin == '--' ? '0000-00-00' : $tgl_sptjb_perjadin;
        $no_sptjb_honor = mysqli_escape_string($myConnection, $_POST['no_sptjb_honor']);
        $sptjb_honor = mysqli_escape_string($myConnection, $_POST['sptjb_honor']);
        $tgl_sptjb_honor = substr($_POST['tgl_sptjb_honor'], 6, 4) . '-' . substr($_POST['tgl_sptjb_honor'], 3, 2) . '-' . substr($_POST['tgl_sptjb_honor'], 0, 2);
        $tgl_honor = $tgl_sptjb_honor == '--' ? '0000-00-00' : $tgl_sptjb_honor;
        $nama_keg_kuitansi = mysqli_escape_string($myConnection, $_POST['nama_keg_kuitansi']);
        $mak_tp_pengarah = mysqli_escape_string($myConnection, $_POST['mak_tp_pengarah']);
        $mak_tp_narsum_e = mysqli_escape_string($myConnection, $_POST['mak_tp_narsum_e']);
        $mak_tp_narsum_i = mysqli_escape_string($myConnection, $_POST['mak_tp_narsum_i']);
        $mak_tp_panitia = mysqli_escape_string($myConnection, $_POST['mak_tp_panitia']);
        $mak_tp_peserta = mysqli_escape_string($myConnection, $_POST['mak_tp_peserta']);
        $mak_hr_pengarah = mysqli_escape_string($myConnection, $_POST['mak_hr_pengarah']);
        $mak_hr_narsum_e = mysqli_escape_string($myConnection, $_POST['mak_hr_narsum_e']);
        $mak_hr_narsum_i = mysqli_escape_string($myConnection, $_POST['mak_hr_narsum_i']);
        $mak_hr_panitia = mysqli_escape_string($myConnection, $_POST['mak_hr_panitia']);
        $mak_hr_peserta = mysqli_escape_string($myConnection, $_POST['mak_hr_peserta']);
        $no_bukti_transport = mysqli_escape_string($myConnection, $_POST['no_bukti_transport']);
        $no_bukti_honor = mysqli_escape_string($myConnection, $_POST['no_bukti_honor']);
        $profil_dipa = mysqli_escape_string($myConnection, decrypt($_POST['profil_dipa']));
        $page = mysqli_escape_string($myConnection, decrypt($_POST['_type']));

        $updateKuitansi = mysqli_query($myConnection, "update tb_kegiatan set 
        nama_keg_kuitansi = '$nama_keg_kuitansi',
        no_sptjb_perjadin = '$no_sptjb_perjadin',
        sptjb_perjadin = '$sptjb_perjadin',
        tgl_sptjb_perjadin = '$tgl_perjadin',
        no_sptjb_honor = '$no_sptjb_honor',
        sptjb_honor = '$sptjb_honor',
        tgl_sptjb_honor = '$tgl_honor',
        no_bukti_transport = '$no_bukti_transport',
        no_bukti_honor = '$no_bukti_honor',
        mak_tp_pengarah = '$mak_tp_pengarah',
        mak_tp_narsum_e = '$mak_tp_narsum_e',
        mak_tp_narsum_i = '$mak_tp_narsum_i',
        mak_tp_peserta = '$mak_tp_peserta',
        mak_tp_panitia = '$mak_tp_panitia',
        mak_hr_pengarah = '$mak_hr_pengarah',
        mak_hr_narsum_e = '$mak_hr_narsum_e',
        mak_hr_narsum_i = '$mak_hr_narsum_i',
        mak_hr_peserta = '$mak_hr_peserta',
        mak_hr_panitia = '$mak_hr_panitia',
        id_pejabat = '$id_pejabat',
        id_ppk = '$id_ppk',
        id_bendahara = '$id_bendahara',
        profil_dipa = '$profil_dipa' 
        where id_keg = '$id_keg'");
        if ($updateKuitansi) {
            $_SESSION['alert'] = "Toast.fire({icon: 'success',title: 'Pengaturan berhasil disimpan'})";
            echo '<script> window.location="checkDocumentOffice?_token=' . encrypt($id_keg) . '&_type=' . $page . '"; </script>';
        } else {
            $_SESSION['alert'] = "Toast.fire({icon: 'error',title: 'Pengaturan gagal disimpan'})";
            echo '<script> window.location="checkDocumentOffice?_token=' . encrypt($id_keg) . '&_type=' . $page . '"; </script>';
        }
    } elseif (isset($_POST['settingFinancialReceiptOffice'])) {
        $created_by = $_SESSION['id'];
        $id_keg = mysqli_escape_string($myConnection, decrypt($_POST['_token']));

        $uh_peserta = mysqli_escape_string($myConnection, bersihkan($_POST['uh_peserta']));
        $uh_narsum_i = mysqli_escape_string($myConnection, bersihkan($_POST['uh_narsum_i']));
        $uh_narsum_i_kemdikbud = mysqli_escape_string($myConnection, bersihkan($_POST['uh_narsum_i_kemdikbud']));
        $uh_panitia = mysqli_escape_string($myConnection, bersihkan($_POST['uh_panitia']));
        $honor_narsum_e = mysqli_escape_string($myConnection, bersihkan($_POST['honor_narsum_e']));
        $honor_pengarah_e = mysqli_escape_string($myConnection, bersihkan($_POST['honor_pengarah_e']));
        $honor_penanggungjawab = mysqli_escape_string($myConnection, bersihkan($_POST['honor_penanggungjawab']));
        $honor_ketua = mysqli_escape_string($myConnection, bersihkan($_POST['honor_ketua']));
        $honor_anggota = mysqli_escape_string($myConnection, bersihkan($_POST['honor_anggota']));

        $page = mysqli_escape_string($myConnection, decrypt($_POST['_type']));

        $updateKuitansi = mysqli_query($myConnection, "update tb_kegiatan set 
        uh_peserta = '$uh_peserta',
        uh_narsum_i = '$uh_narsum_i',
        uh_narsum_i_kemdikbud = '$uh_narsum_i_kemdikbud',
        uh_panitia = '$uh_panitia',
        honor_narsum_e = '$honor_narsum_e',
        honor_pengarah_e = '$honor_pengarah_e',
        honor_penanggungjawab = '$honor_penanggungjawab',
        honor_ketua = '$honor_ketua',
        honor_anggota = '$honor_anggota'
        where id_keg = '$id_keg'");
        if ($updateKuitansi) {
            $_SESSION['alert'] = "Toast.fire({icon: 'success',title: 'Pengaturan berhasil disimpan'})";
            echo '<script> window.location="checkDocumentOffice?_token=' . encrypt($id_keg) . '&_type=' . $page . '"; </script>';
        } else {
            $_SESSION['alert'] = "Toast.fire({icon: 'error',title: 'Pengaturan gagal disimpan'})";
            echo '<script> window.location="checkDocumentOffice?_token=' . encrypt($id_keg) . '&_type=' . $page . '"; </script>';
        }
    } elseif (isset($_POST['deleteOfficer'])) {
        $created_by = $_SESSION['id'];
        $id_keg =  mysqli_escape_string($myConnection, decrypt($_POST['_key']));
        $id_petugas_keg = mysqli_escape_string($myConnection, decrypt($_POST['_token']));
        $delPetugas = mysqli_query($myConnection, "delete from tb_petugas_kegiatan where id_petugas_keg = '$id_petugas_keg'");
        $delFile = mysqli_query($myConnection, "delete from tb_petugas_file where id_petugas_keg = '$id_petugas_keg'");
        $delHotel = mysqli_query($myConnection, "delete from tb_petugas_hotel where id_petugas_keg = '$id_petugas_keg'");
        $delTransport = mysqli_query($myConnection, "delete from tb_petugas_transport where id_petugas_keg = '$id_petugas_keg'");
        if ($delPetugas) {
            $_SESSION['alert'] = "Toast.fire({icon: 'success',title: 'Data Petugas berhasil dihapus'})";
            echo '<script> window.location="checkDocumentOfficer?_token=' . encrypt($id_keg) . '"; </script>';
        } else {
            $_SESSION['alert'] = "Toast.fire({icon: 'error',title: 'Data Petugas gagal dihapus'})";
            echo '<script> window.location="checkDocumentOfficer?_token=' . encrypt($id_keg) . '"; </script>';
        }
    } elseif (isset($_POST['addOfficer'])) {
        $created_by = $_SESSION['id'];
        $id_keg =  mysqli_escape_string($myConnection, decrypt($_POST['_token']));
        $cekKegiatan = mysqli_query($myConnection, "select * from tb_kegiatan where id_keg = '$id_keg'");

        if (mysqli_num_rows($cekKegiatan) > 0) {
            $viewKegiatan = mysqli_fetch_array($cekKegiatan);
            $id_st_siratu = $viewKegiatan['id_st_siratu'];
            $codePeg2 = time() . '-' . uniqid();
            $codePeg = strtoupper($codePeg2);

            $id_peg = mysqli_escape_string($myConnection, $_POST['petugas']);
            $kabkota = mysqli_escape_string($myConnection, $_POST['kabkota']);

            $insertOfficer = mysqli_query($myConnection, "insert into tb_petugas_kegiatan (id_petugas_keg, id_keg, id_peg_st_siratu, id_st_siratu, kabkota, id_peg) values ('$codePeg', '$id_keg', '0','$id_st_siratu', '$kabkota', '$id_peg')");

            if ($insertOfficer) {
                $_SESSION['alert'] = "Toast.fire({icon: 'success',title: 'Data Petugas berhasil dihapus'})";
                echo '<script> window.location="checkDocumentOfficer?_token=' . encrypt($id_keg) . '"; </script>';
            } else {
                $_SESSION['alert'] = "Toast.fire({icon: 'error',title: 'Data Petugas gagal dihapus'})";
                echo '<script> window.location="checkDocumentOfficer?_token=' . encrypt($id_keg) . '"; </script>';
            }
        } else {
            $_SESSION['alert'] = "Toast.fire({icon: 'error',title: 'SQL Injection terdeteksi'})";
            echo "<script> window.location='./'; </script>";
        }
    } elseif (isset($_POST['addFinancialOfficeClerk'])) {
        $created_by = $_SESSION['id'];
        $id_keg =  mysqli_escape_string($myConnection, decrypt($_POST['_token']));
        $cekKegiatan = mysqli_query($myConnection, "select * from tb_kegiatan where id_keg = '$id_keg' and soft_delete = 0");

        if (mysqli_num_rows($cekKegiatan) > 0) {
            $viewKegiatan = mysqli_fetch_array($cekKegiatan);
            $thn_st = $viewKegiatan['thn_st'];
            $id_panitia_keg_kantor = mysqli_escape_string($myConnection, $_POST['petugas_keu']);
            $page = mysqli_escape_string($myConnection, decrypt($_POST['_type']));
            // echo $id_panitia_keg_kantor;
            $sqlPeg = mysqli_query($myConnection, "select * from tb_panitia_keg_kantor where id_panitia_keg_kantor = '$id_panitia_keg_kantor'");
            if (mysqli_num_rows($sqlPeg) > 0) {
                $viewPetugas = mysqli_fetch_array($sqlPeg);
                $id_peg = $viewPetugas['id_peg'];
                $sqlInputPetugas = mysqli_query($myConnection, "insert into tb_petugas_keuangan_keg_hotel (id_petugas_keu_keg, id_keg, id_panitia_keg_hotel) values ('$id_panitia_keg_kantor', '$id_keg', '$id_panitia_keg_kantor')");
                if ($sqlInputPetugas) {
                    $_SESSION['alert'] = "Toast.fire({icon: 'success',title: 'Data Petugas Keuangan berhasil ditambahkan'})";
                    echo '<script>  window.location="checkDocumentOffice?_token=' . encrypt($id_keg) . '&_type=' . $page . '"; </script>';
                } else {
                    $_SESSION['alert'] = "Toast.fire({icon: 'error',title: 'Data Petugas Keuangan gagal ditambahkan'})";
                    echo '<script>  window.location="checkDocumentOffice?_token=' . encrypt($id_keg) . '&_type=' . $page . '"; </script>';
                }
            } else {
                $_SESSION['alert'] = "Toast.fire({icon: 'error',title: 'Panitia gagal ditemukan !'})";
                echo "<script> window.location='./'; </script>";
            }
        } else {
            $_SESSION['alert'] = "Toast.fire({icon: 'error',title: 'SQL Injection terdeteksi'})";
            echo "<script> window.location='./'; </script>";
        }
    } elseif (isset($_POST['delFinancialOfficeClerk'])) {
        $created_by = $_SESSION['id'];
        $id_keg =  mysqli_escape_string($myConnection, decrypt($_POST['_key']));
        $id_petugas_keu_keg = mysqli_escape_string($myConnection, decrypt($_POST['_token']));
        $page = mysqli_escape_string($myConnection, decrypt($_POST['_type']));

        $delPetugas = mysqli_query($myConnection, "delete from tb_petugas_keuangan_keg_hotel where id_petugas_keu_keg = '$id_petugas_keu_keg' and id_keg = '$id_keg'");
        if ($delPetugas) {
            $_SESSION['alert'] = "Toast.fire({icon: 'success',title: 'Data Petugas Keuangan berhasil dihapus'})";
            echo '<script>  window.location="checkDocumentOffice?_token=' . encrypt($id_keg) . '&_type=' . $page . '"; </script>';
        } else {
            $_SESSION['alert'] = "Toast.fire({icon: 'error',title: 'Data Petugas Keuangan gagal dihapus'})";
            echo '<script>  window.location="checkDocumentOffice?_token=' . encrypt($id_keg) . '&_type=' . $page . '"; </script>';
        }
    } elseif (isset($_POST['addExternalDirectorOffice'])) {
        $created_by = $_SESSION['id'];
        $code2 = time() . '-' . uniqid();
        $code = strtoupper($code2);
        $id_keg = mysqli_escape_string($myConnection, decrypt($_POST['_token']));

        $cekKegiatan = mysqli_query($myConnection, "select * from tb_kegiatan where id_keg = '$id_keg'");

        if (mysqli_num_rows($cekKegiatan) > 0) {
            $nama = mysqli_escape_string($myConnection, $_POST['nama']);
            $nip = mysqli_escape_string($myConnection, $_POST['nip']);
            $id_pangkat = mysqli_escape_string($myConnection, decrypt($_POST['pangkat']));
            $jabatan = mysqli_escape_string($myConnection, $_POST['jabatan']);
            $unit_kerja = mysqli_escape_string($myConnection, $_POST['unit_kerja']);
            $alamat_unit_kerja = mysqli_escape_string($myConnection, $_POST['alamat_unit_kerja']);
            $id_kabkota = mysqli_escape_string($myConnection, $_POST['kabkota_unitkerja']);
            $no_hp = mysqli_escape_string($myConnection, $_POST['no_hp']);
            $viewPangkat = mysqli_fetch_array(mysqli_query($myConnection, "select * from tb_gol_pajak where id_pangkat = '$id_pangkat'"));
            $viewKabkota = mysqli_fetch_array(mysqli_query($myConnection, "select * from tb_kabkota where id = '$id_kabkota'"));

            $gol = $viewPangkat['gol'];
            $pangkat = $viewPangkat['jabatan_struktural'];
            $kabkota_unit_kerja = str_replace('Kabupaten', 'Kab.', ucwords($viewKabkota['name']));
            $tgl_mulai = substr($_POST['tgl_mulai'], 6, 4) . '-' . substr($_POST['tgl_mulai'], 3, 2) . '-' . substr($_POST['tgl_mulai'], 0, 2);
            $tgl_selesai = substr($_POST['tgl_selesai'], 6, 4) . '-' . substr($_POST['tgl_selesai'], 3, 2) . '-' . substr($_POST['tgl_selesai'], 0, 2);

            $sql = "insert into tb_pengarah_keg_kantor (id_pengarah_keg_kantor, id_keg, nama, nip, gol, pangkat, id_pangkat_gol, jabatan, unit_kerja, alamat_unit_kerja, kabkota_unit_kerja, id_kabkota_unit_kerja, no_hp, tgl_mulai, tgl_selesai, jenis_pengarah, created_by,created_date) values ('$code', '$id_keg', '$nama', '$nip', '$gol', '$pangkat', '$id_pangkat', '$jabatan', '$unit_kerja', '$alamat_unit_kerja', '$kabkota_unit_kerja', '$id_kabkota', '$no_hp', '$tgl_mulai', '$tgl_selesai', 'eksternal', '$created_by', NOW())";
            // echo $sql;
            $input = mysqli_query($myConnection, $sql);
            if ($input) {
                $_SESSION['alert'] = "Toast.fire({icon: 'success',title: 'Pengarah berhasil ditambahkan'})";
                echo '<script> window.location="checkDocumentOffice?_token=' . encrypt($id_keg) . '&_type=pengarah"; </script>';
            } else {
                $_SESSION['alert'] = "Toast.fire({icon: 'error',title: 'Pengarah gagal ditambahkan'})";
                echo '<script> window.location="checkDocumentOffice?_token=' . encrypt($id_keg) . '&_type=pengarah"; </script>';
            }
        } else {
            $_SESSION['alert'] = "Toast.fire({icon: 'error',title: 'SQL Injection terdeteksi'})";
            echo "<script> window.location='./'; </script>";
        }
    } elseif (isset($_POST['addInternalDirectorOffice'])) {
        $created_by = $_SESSION['id'];
        $code2 = time() . '-' . uniqid();
        $code = strtoupper($code2);
        $id_keg = mysqli_escape_string($myConnection, decrypt($_POST['_token']));

        $cekKegiatan = mysqli_query($myConnection, "select * from tb_kegiatan where id_keg = '$id_keg'");
        $sbm = mysqli_fetch_array(mysqli_query($myConnection, "select besaran from tb_kabkota where id = 3578"));
        $sbmSurabaya = $sbm['besaran'];

        if (mysqli_num_rows($cekKegiatan) > 0) {
            $id_peg = mysqli_escape_string($myConnection, decrypt($_POST['pengarah_internal']));
            $tgl_mulai = substr($_POST['tgl_mulai'], 6, 4) . '-' . substr($_POST['tgl_mulai'], 3, 2) . '-' . substr($_POST['tgl_mulai'], 0, 2);
            $tgl_selesai = substr($_POST['tgl_selesai'], 6, 4) . '-' . substr($_POST['tgl_selesai'], 3, 2) . '-' . substr($_POST['tgl_selesai'], 0, 2);

            $sqlCekPeg = mysqli_query($myConnection, "select tb_pegawai.*, tb_gol_pajak.gol as gol, tb_gol_pajak.jabatan_struktural as pangkat, tb_jabatan.nama_jabatan as nama_jabatan from tb_pegawai
                         left join tb_gol_pajak on tb_gol_pajak.id_pangkat = tb_pegawai.id_pangkat
                         left join tb_jabatan on tb_jabatan.kd_jabatan = tb_pegawai.jabatan
                         where tb_pegawai.soft_delete = 0 and tb_pegawai.id_peg = '$id_peg'");
            if (mysqli_num_rows($sqlCekPeg) > 0) {
                $pegawai = mysqli_fetch_array($sqlCekPeg);
                $nama = $pegawai['nama_peg'];
                $nip = $pegawai['nip'];
                $id_pangkat = $pegawai['id_pangkat'];
                $jabatan = $pegawai['nama_jabatan'];
                $unit_kerja = 'BBPMP Provinsi Jawa timur';
                $alamat_unit_kerja = 'Kota Surabaya';
                $id_kabkota = 3578;
                $no_hp = "-";
                $viewPangkat = mysqli_fetch_array(mysqli_query($myConnection, "select * from tb_gol_pajak where id_pangkat = '$id_pangkat'"));
                $viewKabkota = mysqli_fetch_array(mysqli_query($myConnection, "select * from tb_kabkota where id = '$id_kabkota'"));

                $gol = $viewPangkat['gol'];
                $pangkat = $viewPangkat['jabatan_struktural'];
                $kabkota_unit_kerja = str_replace('Kabupaten', 'Kab.', ucwords($viewKabkota['name']));
                $tgl_mulai = substr($_POST['tgl_mulai'], 6, 4) . '-' . substr($_POST['tgl_mulai'], 3, 2) . '-' . substr($_POST['tgl_mulai'], 0, 2);
                $tgl_selesai = substr($_POST['tgl_selesai'], 6, 4) . '-' . substr($_POST['tgl_selesai'], 3, 2) . '-' . substr($_POST['tgl_selesai'], 0, 2);

                $sql = "insert into tb_pengarah_keg_kantor (id_pengarah_keg_kantor, id_keg, id_peg, nama, nip, gol, pangkat, id_pangkat_gol, jabatan, unit_kerja, alamat_unit_kerja, kabkota_unit_kerja, id_kabkota_unit_kerja, no_hp, tgl_mulai, tgl_selesai, jenis_pengarah, lokal, created_by,created_date) values ('$code', '$id_keg', '$id_peg', '$nama', '$nip', '$gol', '$pangkat', '$id_pangkat', '$jabatan', '$unit_kerja', '$alamat_unit_kerja', '$kabkota_unit_kerja', '$id_kabkota', '$no_hp', '$tgl_mulai', '$tgl_selesai', 'internal', '$sbmSurabaya', '$created_by', NOW())";
                // echo $sql;
                $input = mysqli_query($myConnection, $sql);
                if ($input) {
                    $_SESSION['alert'] = "Toast.fire({icon: 'success',title: 'Pengarah berhasil ditambahkan'})";
                    echo '<script> window.location="checkDocumentOffice?_token=' . encrypt($id_keg) . '&_type=pengarah"; </script>';
                } else {
                    $_SESSION['alert'] = "Toast.fire({icon: 'error',title: 'Pengarah gagal ditambahkan'})";
                    echo '<script> window.location="checkDocumentOffice?_token=' . encrypt($id_keg) . '&_type=pengarah"; </script>';
                }
            } else {
                $_SESSION['alert'] = "Toast.fire({icon: 'error',title: 'SQL Injection terdeteksi'})";
                echo "<script> window.location='./'; </script>";
            }
        } else {
            $_SESSION['alert'] = "Toast.fire({icon: 'error',title: 'SQL Injection terdeteksi'})";
            echo "<script> window.location='./'; </script>";
        }
    } elseif (isset($_POST['editDirectorExternalOffice'])) {
        $created_by = $_SESSION['id'];
        $id_keg = mysqli_escape_string($myConnection, decrypt($_POST['_token']));
        $id_pengarah_keg_kantor = mysqli_escape_string($myConnection, decrypt($_POST['_id']));

        $cekPengarah = mysqli_query($myConnection, "select * from tb_pengarah_keg_kantor where id_keg = '$id_keg' and id_pengarah_keg_kantor = '$id_pengarah_keg_kantor'");
        if (mysqli_num_rows($cekPengarah) > 0) {
            $nama = mysqli_escape_string($myConnection, $_POST['nama']);
            $nip = mysqli_escape_string($myConnection, $_POST['nip']);
            $id_pangkat = mysqli_escape_string($myConnection, decrypt($_POST['pangkat']));
            $jabatan = mysqli_escape_string($myConnection, $_POST['jabatan']);
            $unit_kerja = mysqli_escape_string($myConnection, $_POST['unit_kerja']);
            $alamat_unit_kerja = mysqli_escape_string($myConnection, $_POST['alamat_unit_kerja']);
            $id_kabkota = mysqli_escape_string($myConnection, $_POST['kabkota_unitkerja']);
            $no_hp = mysqli_escape_string($myConnection, $_POST['no_hp']);
            $viewPangkat = mysqli_fetch_array(mysqli_query($myConnection, "select * from tb_gol_pajak where id_pangkat = '$id_pangkat'"));
            $viewKabkota = mysqli_fetch_array(mysqli_query($myConnection, "select * from tb_kabkota where id = '$id_kabkota'"));

            $gol = $viewPangkat['gol'];
            $pangkat = $viewPangkat['jabatan_struktural'];
            $kabkota_unit_kerja = str_replace('Kabupaten', 'Kab.', ucwords($viewKabkota['name']));

            $update = mysqli_query($myConnection, "update tb_pengarah_keg_kantor set
            nama = '$nama',
            nip = '$nip',
            gol = '$gol',
            pangkat = '$pangkat',
            id_pangkat_gol = '$id_pangkat',
            jabatan = '$jabatan',
            unit_kerja = '$unit_kerja',
            alamat_unit_kerja = '$alamat_unit_kerja',
            kabkota_unit_kerja = '$kabkota_unit_kerja',
            id_kabkota_unit_kerja = '$id_kabkota',
            no_hp = '$no_hp'
            where id_keg = '$id_keg' and id_pengarah_keg_kantor = '$id_pengarah_keg_kantor' ");
            if ($update) {
                $_SESSION['alert'] = "Toast.fire({icon: 'success',title: 'Pengarah berhasil diubah'})";
                echo '<script> window.location="checkDocumentOffice?_token=' . encrypt($id_keg) . '&_type=pengarah"; </script>';
            } else {
                $_SESSION['alert'] = "Toast.fire({icon: 'error',title: 'Pengarah gagal diubah'})";
                echo '<script> window.location="checkDocumentOffice?_token=' . encrypt($id_keg) . '&_type=pengarah"; </script>';
            }
        } else {
            $_SESSION['alert'] = "Toast.fire({icon: 'error',title: 'SQL Injection Detected !'})";
            echo '<script> window.location="checkDocumentOffice?_token=' . encrypt($id_keg) . '&_type=pengarah"; </script>';
        }
    } elseif (isset($_POST['delDirectorOffice'])) {
        $created_by = $_SESSION['id'];
        $id_keg = mysqli_escape_string($myConnection, decrypt($_POST['_token']));
        $id_pengarah_keg_kantor = mysqli_escape_string($myConnection, decrypt($_POST['_id']));

        $cekPengarah = mysqli_query($myConnection, "select * from tb_pengarah_keg_kantor where id_keg = '$id_keg' and id_pengarah_keg_kantor = '$id_pengarah_keg_kantor'");
        if (mysqli_num_rows($cekPengarah) > 0) {

            $input = mysqli_query($myConnection, "delete from tb_pengarah_keg_kantor where id_pengarah_keg_kantor = '$id_pengarah_keg_kantor' and id_keg = '$id_keg' ");
            if ($input) {
                $_SESSION['alert'] = "Toast.fire({icon: 'success',title: 'Pengarah berhasil dihapus'})";
                echo '<script> window.location="checkDocumentOffice?_token=' . encrypt($id_keg) . '&_type=pengarah"; </script>';
            } else {
                $_SESSION['alert'] = "Toast.fire({icon: 'error',title: 'Pengarah gagal dihapus'})";
                echo '<script> window.location="checkDocumentOffice?_token=' . encrypt($id_keg) . '&_type=pengarah"; </script>';
            }
        } else {
            $_SESSION['alert'] = "Toast.fire({icon: 'error',title: 'SQL Injection Detected !'})";
            echo '<script> window.location="checkDocumentOffice?_token=' . encrypt($id_keg) . '&_type=pengarah"; </script>';
        }
    } elseif (isset($_POST['addInternalInformantOffice'])) {
        $created_by = $_SESSION['id'];
        $code2 = time() . '-' . uniqid();
        $code = strtoupper($code2);
        $id_keg = mysqli_escape_string($myConnection, decrypt($_POST['_token']));

        $cekKegiatan = mysqli_query($myConnection, "select * from tb_kegiatan where id_keg = '$id_keg'");
        $sbm = mysqli_fetch_array(mysqli_query($myConnection, "select besaran from tb_kabkota where id = 3578"));
        $sbmSurabaya = $sbm['besaran'];

        if (mysqli_num_rows($cekKegiatan) > 0) {
            $id_peg = mysqli_escape_string($myConnection, decrypt($_POST['narsum_internal']));
            $tgl_mulai = substr($_POST['tgl_mulai'], 6, 4) . '-' . substr($_POST['tgl_mulai'], 3, 2) . '-' . substr($_POST['tgl_mulai'], 0, 2);
            $tgl_selesai = substr($_POST['tgl_selesai'], 6, 4) . '-' . substr($_POST['tgl_selesai'], 3, 2) . '-' . substr($_POST['tgl_selesai'], 0, 2);

            $sqlCekPeg = mysqli_query($myConnection, "select tb_pegawai.*, tb_gol_pajak.gol as gol, tb_gol_pajak.jabatan_struktural as pangkat, tb_jabatan.nama_jabatan as nama_jabatan from tb_pegawai
                         left join tb_gol_pajak on tb_gol_pajak.id_pangkat = tb_pegawai.id_pangkat
                         left join tb_jabatan on tb_jabatan.kd_jabatan = tb_pegawai.jabatan
                         where tb_pegawai.soft_delete = 0 and tb_pegawai.id_peg = '$id_peg'");
            if (mysqli_num_rows($sqlCekPeg) > 0) {
                $pegawai = mysqli_fetch_array($sqlCekPeg);
                $nama = $pegawai['nama_peg'];
                $nip = $pegawai['nip'];
                $id_pangkat = $pegawai['id_pangkat'];
                $jabatan = $pegawai['nama_jabatan'];
                $unit_kerja = 'BBPMP Provinsi Jawa timur';
                $alamat_unit_kerja = 'Kota Surabaya';
                $id_kabkota = 3578;
                $no_hp = "-";
                $viewPangkat = mysqli_fetch_array(mysqli_query($myConnection, "select * from tb_gol_pajak where id_pangkat = '$id_pangkat'"));
                $viewKabkota = mysqli_fetch_array(mysqli_query($myConnection, "select * from tb_kabkota where id = '$id_kabkota'"));

                $gol = $viewPangkat['gol'];
                $pangkat = $viewPangkat['jabatan_struktural'];
                $kabkota_unit_kerja = str_replace('Kabupaten', 'Kab.', ucwords($viewKabkota['name']));
                $tgl_mulai = substr($_POST['tgl_mulai'], 6, 4) . '-' . substr($_POST['tgl_mulai'], 3, 2) . '-' . substr($_POST['tgl_mulai'], 0, 2);
                $tgl_selesai = substr($_POST['tgl_selesai'], 6, 4) . '-' . substr($_POST['tgl_selesai'], 3, 2) . '-' . substr($_POST['tgl_selesai'], 0, 2);

                $sql = "insert into tb_narsum_keg_kantor (id_narsum_keg_kantor, id_keg, id_peg, nama, nip, gol, pangkat, id_pangkat_gol, jabatan, unit_kerja, alamat_unit_kerja, kabkota_unit_kerja, id_kabkota_unit_kerja, no_hp, tgl_mulai, tgl_selesai, jenis_narsum, lokal, created_by,created_date) values ('$code', '$id_keg', '$id_peg', '$nama', '$nip', '$gol', '$pangkat', '$id_pangkat', '$jabatan', '$unit_kerja', '$alamat_unit_kerja', '$kabkota_unit_kerja', '$id_kabkota', '$no_hp', '$tgl_mulai', '$tgl_selesai', 'internal', '$sbmSurabaya', '$created_by', NOW())";
                // echo $sql;
                $input = mysqli_query($myConnection, $sql);
                if ($input) {
                    $_SESSION['alert'] = "Toast.fire({icon: 'success',title: 'Narasumber berhasil ditambahkan'})";
                    echo '<script> window.location="checkDocumentOffice?_token=' . encrypt($id_keg) . '&_type=narsum"; </script>';
                } else {
                    $_SESSION['alert'] = "Toast.fire({icon: 'error',title: 'Narasumber gagal ditambahkan'})";
                    echo '<script> window.location="checkDocumentOffice?_token=' . encrypt($id_keg) . '&_type=narsum"; </script>';
                }
            } else {
                $_SESSION['alert'] = "Toast.fire({icon: 'error',title: 'SQL Injection terdeteksi'})";
                echo "<script> window.location='./'; </script>";
            }
        } else {
            $_SESSION['alert'] = "Toast.fire({icon: 'error',title: 'SQL Injection terdeteksi'})";
            echo "<script> window.location='./'; </script>";
        }
    } elseif (isset($_POST['addExternalInformantOffice'])) {
        $created_by = $_SESSION['id'];
        $code2 = time() . '-' . uniqid();
        $code = strtoupper($code2);
        $id_keg = mysqli_escape_string($myConnection, decrypt($_POST['_token']));

        $cekKegiatan = mysqli_query($myConnection, "select * from tb_kegiatan where id_keg = '$id_keg'");

        if (mysqli_num_rows($cekKegiatan) > 0) {
            $nama = mysqli_escape_string($myConnection, $_POST['nama']);
            $nip = mysqli_escape_string($myConnection, $_POST['nip']);
            $id_pangkat = mysqli_escape_string($myConnection, decrypt($_POST['pangkat']));
            $jabatan = mysqli_escape_string($myConnection, $_POST['jabatan']);
            $unit_kerja = mysqli_escape_string($myConnection, $_POST['unit_kerja']);
            $alamat_unit_kerja = mysqli_escape_string($myConnection, $_POST['alamat_unit_kerja']);
            $id_kabkota = mysqli_escape_string($myConnection, $_POST['kabkota_unitkerja']);
            $no_hp = mysqli_escape_string($myConnection, $_POST['no_hp']);
            $cek_internal = isset($_POST['cek_internal']) ? 1 : 0;
            $viewPangkat = mysqli_fetch_array(mysqli_query($myConnection, "select * from tb_gol_pajak where id_pangkat = '$id_pangkat'"));
            $viewKabkota = mysqli_fetch_array(mysqli_query($myConnection, "select * from tb_kabkota where id = '$id_kabkota'"));

            $gol = $viewPangkat['gol'];
            $pangkat = $viewPangkat['jabatan_struktural'];
            $kabkota_unit_kerja = str_replace('Kabupaten', 'Kab.', ucwords($viewKabkota['name']));
            $tgl_mulai = substr($_POST['tgl_mulai'], 6, 4) . '-' . substr($_POST['tgl_mulai'], 3, 2) . '-' . substr($_POST['tgl_mulai'], 0, 2);
            $tgl_selesai = substr($_POST['tgl_selesai'], 6, 4) . '-' . substr($_POST['tgl_selesai'], 3, 2) . '-' . substr($_POST['tgl_selesai'], 0, 2);

            $sql = "insert into tb_narsum_keg_kantor (id_narsum_keg_kantor, id_keg, nama, nip, gol, pangkat, id_pangkat_gol, jabatan, unit_kerja, alamat_unit_kerja, kabkota_unit_kerja, id_kabkota_unit_kerja, no_hp, tgl_mulai, tgl_selesai, jml_jam, jenis_narsum, status_internal_kemdikbud, created_by,created_date) values ('$code', '$id_keg', '$nama', '$nip', '$gol', '$pangkat', '$id_pangkat', '$jabatan', '$unit_kerja', '$alamat_unit_kerja', '$kabkota_unit_kerja', '$id_kabkota', '$no_hp', '$tgl_mulai', '$tgl_selesai', '1', 'eksternal', '$cek_internal', '$created_by', NOW())";
            // echo $sql;
            $input = mysqli_query($myConnection, $sql);
            if ($input) {
                $_SESSION['alert'] = "Toast.fire({icon: 'success',title: 'Narasumber berhasil ditambahkan'})";
                echo '<script> window.location="checkDocumentOffice?_token=' . encrypt($id_keg) . '&_type=narsum"; </script>';
            } else {
                $_SESSION['alert'] = "Toast.fire({icon: 'error',title: 'Narasumber gagal ditambahkan'})";
                echo '<script> window.location="checkDocumentOffice?_token=' . encrypt($id_keg) . '&_type=narsum"; </script>';
            }
        } else {
            $_SESSION['alert'] = "Toast.fire({icon: 'error',title: 'SQL Injection terdeteksi'})";
            echo "<script> window.location='./'; </script>";
        }
    } elseif (isset($_POST['delInformantOffice'])) {
        $created_by = $_SESSION['id'];
        $id_keg = mysqli_escape_string($myConnection, decrypt($_POST['_token']));
        $id_narsum_keg_kantor = mysqli_escape_string($myConnection, decrypt($_POST['_id']));

        $cekPengarah = mysqli_query($myConnection, "select * from tb_narsum_keg_kantor where id_keg = '$id_keg' and id_narsum_keg_kantor = '$id_narsum_keg_kantor'");
        if (mysqli_num_rows($cekPengarah) > 0) {

            $input = mysqli_query($myConnection, "delete from tb_narsum_keg_kantor where id_narsum_keg_kantor = '$id_narsum_keg_kantor' and id_keg = '$id_keg' ");
            if ($input) {
                $_SESSION['alert'] = "Toast.fire({icon: 'success',title: 'Narasumber berhasil dihapus'})";
                echo '<script> window.location="checkDocumentOffice?_token=' . encrypt($id_keg) . '&_type=narsum"; </script>';
            } else {
                $_SESSION['alert'] = "Toast.fire({icon: 'error',title: 'Narasumber gagal dihapus'})";
                echo '<script> window.location="checkDocumentOffice?_token=' . encrypt($id_keg) . '&_type=narsum"; </script>';
            }
        } else {
            $_SESSION['alert'] = "Toast.fire({icon: 'error',title: 'SQL Injection Detected !'})";
            echo '<script> window.location="checkDocumentOffice?_token=' . encrypt($id_keg) . '&_type=narsum"; </script>';
        }
    } elseif (isset($_POST['editInformantExternalOffice'])) {
        $created_by = $_SESSION['id'];
        $id_keg = mysqli_escape_string($myConnection, decrypt($_POST['_token']));
        $id_narsum_keg_kantor = mysqli_escape_string($myConnection, decrypt($_POST['_id']));

        $cekPengarah = mysqli_query($myConnection, "select * from tb_narsum_keg_kantor where id_keg = '$id_keg' and id_narsum_keg_kantor = '$id_narsum_keg_kantor'");
        if (mysqli_num_rows($cekPengarah) > 0) {
            $nama = mysqli_escape_string($myConnection, $_POST['nama']);
            $nip = mysqli_escape_string($myConnection, $_POST['nip']);
            $id_pangkat = mysqli_escape_string($myConnection, decrypt($_POST['pangkat']));
            $jabatan = mysqli_escape_string($myConnection, $_POST['jabatan']);
            $unit_kerja = mysqli_escape_string($myConnection, $_POST['unit_kerja']);
            $alamat_unit_kerja = mysqli_escape_string($myConnection, $_POST['alamat_unit_kerja']);
            $id_kabkota = mysqli_escape_string($myConnection, $_POST['kabkota_unitkerja']);
            $no_hp = mysqli_escape_string($myConnection, $_POST['no_hp']);
            $cek_internal = isset($_POST['cek_internal']) ? 1 : 0;
            $viewPangkat = mysqli_fetch_array(mysqli_query($myConnection, "select * from tb_gol_pajak where id_pangkat = '$id_pangkat'"));
            $viewKabkota = mysqli_fetch_array(mysqli_query($myConnection, "select * from tb_kabkota where id = '$id_kabkota'"));

            $gol = $viewPangkat['gol'];
            $pangkat = $viewPangkat['jabatan_struktural'];
            $kabkota_unit_kerja = str_replace('Kabupaten', 'Kab.', ucwords($viewKabkota['name']));

            $update = mysqli_query($myConnection, "update tb_narsum_keg_kantor set
            nama = '$nama',
            nip = '$nip',
            gol = '$gol',
            pangkat = '$pangkat',
            id_pangkat_gol = '$id_pangkat',
            jabatan = '$jabatan',
            unit_kerja = '$unit_kerja',
            alamat_unit_kerja = '$alamat_unit_kerja',
            kabkota_unit_kerja = '$kabkota_unit_kerja',
            id_kabkota_unit_kerja = '$id_kabkota',
            no_hp = '$no_hp',
            status_internal_kemdikbud = '$cek_internal'
            where id_keg = '$id_keg' and id_narsum_keg_kantor = '$id_narsum_keg_kantor' ");
            if ($update) {
                $_SESSION['alert'] = "Toast.fire({icon: 'success',title: 'Narasumber berhasil diubah'})";
                echo '<script> window.location="checkDocumentOffice?_token=' . encrypt($id_keg) . '&_type=narsum"; </script>';
            } else {
                $_SESSION['alert'] = "Toast.fire({icon: 'error',title: 'Narasumber gagal diubah'})";
                echo '<script> window.location="checkDocumentOffice?_token=' . encrypt($id_keg) . '&_type=narsum"; </script>';
            }
        } else {
            $_SESSION['alert'] = "Toast.fire({icon: 'error',title: 'SQL Injection Detected !'})";
            echo '<script> window.location="checkDocumentOffice?_token=' . encrypt($id_keg) . '&_type=narsum"; </script>';
        }
    } elseif (isset($_POST['inputTransportInformantOffice'])) {
        $created_by = $_SESSION['id'];
        $id_keg = mysqli_escape_string($myConnection, decrypt($_POST['_token']));
        $id_narsum_keg_kantor = mysqli_escape_string($myConnection, decrypt($_POST['_id']));

        $cekNarsum = mysqli_query($myConnection, "select * from tb_narsum_keg_kantor where id_keg = '$id_keg' and id_narsum_keg_kantor = '$id_narsum_keg_kantor' and jenis_narsum = 'eksternal'");
        if (mysqli_num_rows($cekNarsum) > 0) {
            $jml_jam = mysqli_escape_string($myConnection, bersihkan($_POST['jml_jam']));
            $bbm = mysqli_escape_string($myConnection, bersihkan($_POST['bbm']));
            $tiket_pesawat = mysqli_escape_string($myConnection, bersihkan($_POST['tiket_pesawat']));
            $tiket_kapal = mysqli_escape_string($myConnection, bersihkan($_POST['tiket_kapal']));
            $tiket = mysqli_escape_string($myConnection, bersihkan($_POST['tiket']));
            $lokal = mysqli_escape_string($myConnection, bersihkan($_POST['lokal']));
            $taksi = mysqli_escape_string($myConnection, bersihkan($_POST['taksi']));
            $toll = mysqli_escape_string($myConnection, bersihkan($_POST['toll']));
            $dpr1 = mysqli_escape_string($myConnection, bersihkan($_POST['dpr1']));
            $penginapan = mysqli_escape_string($myConnection, bersihkan($_POST['penginapan']));
            $lokal_jakarta = mysqli_escape_string($myConnection, bersihkan($_POST['lokal_jakarta']));
            $tgl_mulai = substr($_POST['tgl_mulai'], 6, 4) . '-' . substr($_POST['tgl_mulai'], 3, 2) . '-' . substr($_POST['tgl_mulai'], 0, 2);
            $tgl_selesai = substr($_POST['tgl_selesai'], 6, 4) . '-' . substr($_POST['tgl_selesai'], 3, 2) . '-' . substr($_POST['tgl_selesai'], 0, 2);
            $status_kabkota_unit_kerja = mysqli_escape_string($myConnection, $_POST['status_kabkota_unit_kerja']);

            $input = mysqli_query($myConnection, "update tb_narsum_keg_kantor set
            tgl_mulai = '$tgl_mulai',
            tgl_selesai = '$tgl_selesai',
            jml_jam = '$jml_jam',
            bbm = '$bbm',
            tiket = '$tiket',
            tiket_pesawat = '$tiket_pesawat',
            tiket_kapal = '$tiket_kapal',
            lokal = '$lokal',
            taksi = '$taksi',
            toll = '$toll',
            dpr1 = '$dpr1',
            penginapan = '$penginapan',
            lokal_jakarta = '$lokal_jakarta',
            status_kabkota_unit_kerja = '$status_kabkota_unit_kerja'
            where id_narsum_keg_kantor = '$id_narsum_keg_kantor' and id_keg = '$id_keg' ");
            if ($input) {
                $_SESSION['alert'] = "Toast.fire({icon: 'success',title: 'Transport berhasil disimpan'})";
                echo '<script> window.location="checkDocumentOffice?_token=' . encrypt($id_keg) . '&_type=narsum"; </script>';
            } else {
                $_SESSION['alert'] = "Toast.fire({icon: 'error',title: 'Transport gagal disimpan'})";
                echo '<script> window.location="checkDocumentOffice?_token=' . encrypt($id_keg) . '&_type=narsum"; </script>';
            }
        } else {
            $_SESSION['alert'] = "Toast.fire({icon: 'error',title: 'SQL Injection Detected !'})";
            echo '<script> window.location="checkDocumentOffice?_token=' . encrypt($id_keg) . '&_type=narsum"; </script>';
        }
    } elseif (isset($_POST['inputDirectorTransportOffice'])) {
        $created_by = $_SESSION['id'];
        $id_keg = mysqli_escape_string($myConnection, decrypt($_POST['_token']));
        $id_pengarah_keg_kantor = mysqli_escape_string($myConnection, decrypt($_POST['_id']));

        $cekPengarah = mysqli_query($myConnection, "select * from tb_pengarah_keg_kantor where id_keg = '$id_keg' and id_pengarah_keg_kantor = '$id_pengarah_keg_kantor' and jenis_pengarah = 'eksternal'");
        if (mysqli_num_rows($cekPengarah) > 0) {
            $jml_jam = mysqli_escape_string($myConnection, bersihkan($_POST['jml_jam']));
            $bbm = mysqli_escape_string($myConnection, bersihkan($_POST['bbm']));
            $tiket_pesawat = mysqli_escape_string($myConnection, bersihkan($_POST['tiket_pesawat']));
            $tiket_kapal = mysqli_escape_string($myConnection, bersihkan($_POST['tiket_kapal']));
            $tiket = mysqli_escape_string($myConnection, bersihkan($_POST['tiket']));
            $lokal = mysqli_escape_string($myConnection, bersihkan($_POST['lokal']));
            $taksi = mysqli_escape_string($myConnection, bersihkan($_POST['taksi']));
            $toll = mysqli_escape_string($myConnection, bersihkan($_POST['toll']));
            $dpr1 = mysqli_escape_string($myConnection, bersihkan($_POST['dpr1']));
            $dpr2 = mysqli_escape_string($myConnection, bersihkan($_POST['dpr2']));
            $tgl_mulai = substr($_POST['tgl_mulai'], 6, 4) . '-' . substr($_POST['tgl_mulai'], 3, 2) . '-' . substr($_POST['tgl_mulai'], 0, 2);
            $tgl_selesai = substr($_POST['tgl_selesai'], 6, 4) . '-' . substr($_POST['tgl_selesai'], 3, 2) . '-' . substr($_POST['tgl_selesai'], 0, 2);
            $status_kabkota_unit_kerja = mysqli_escape_string($myConnection, $_POST['status_kabkota_unit_kerja']);

            $input = mysqli_query($myConnection, "update tb_pengarah_keg_kantor set
            tgl_mulai = '$tgl_mulai',
            tgl_selesai = '$tgl_selesai',
            jml_jam = '$jml_jam',
            bbm = '$bbm',
            tiket = '$tiket',
            tiket_pesawat = '$tiket_pesawat',
            tiket_kapal = '$tiket_kapal',
            lokal = '$lokal',
            taksi = '$taksi',
            toll = '$toll',
            dpr1 = '$dpr1',
            dpr2 = '$dpr2',
            status_kabkota_unit_kerja = '$status_kabkota_unit_kerja'
            where id_pengarah_keg_kantor = '$id_pengarah_keg_kantor' and id_keg = '$id_keg' ");
            if ($input) {
                $_SESSION['alert'] = "Toast.fire({icon: 'success',title: 'Transport berhasil disimpan'})";
                echo '<script> window.location="checkDocumentOffice?_token=' . encrypt($id_keg) . '&_type=pengarah"; </script>';
            } else {
                $_SESSION['alert'] = "Toast.fire({icon: 'error',title: 'Transport gagal disimpan'})";
                echo '<script> window.location="checkDocumentOffice?_token=' . encrypt($id_keg) . '&_type=pengarah"; </script>';
            }
        } else {
            $_SESSION['alert'] = "Toast.fire({icon: 'error',title: 'SQL Injection Detected !'})";
            echo '<script> window.location="checkDocumentOffice?_token=' . encrypt($id_keg) . '&_type=pengarah"; </script>';
        }
    } elseif (isset($_POST['addInternalCommitteeOffice'])) {
        $created_by = $_SESSION['id'];
        $code2 = time() . '-' . uniqid();
        $code = strtoupper($code2);
        $id_keg = mysqli_escape_string($myConnection, decrypt($_POST['_token']));

        $cekKegiatan = mysqli_query($myConnection, "select * from tb_kegiatan where id_keg = '$id_keg'");
        $sbm = mysqli_fetch_array(mysqli_query($myConnection, "select besaran from tb_kabkota where id = 3578"));
        $sbmSurabaya = $sbm['besaran'];

        if (mysqli_num_rows($cekKegiatan) > 0) {
            $id_peg = mysqli_escape_string($myConnection, decrypt($_POST['panitia_internal']));
            $id_jab_st = mysqli_escape_string($myConnection, decrypt($_POST['jabatan_kegiatan']));
            $tgl_mulai = substr($_POST['tgl_mulai'], 6, 4) . '-' . substr($_POST['tgl_mulai'], 3, 2) . '-' . substr($_POST['tgl_mulai'], 0, 2);
            $tgl_selesai = substr($_POST['tgl_selesai'], 6, 4) . '-' . substr($_POST['tgl_selesai'], 3, 2) . '-' . substr($_POST['tgl_selesai'], 0, 2);

            $sqlCekPeg = mysqli_query($myConnection, "select tb_pegawai.*, tb_gol_pajak.gol as gol, tb_gol_pajak.jabatan_struktural as pangkat, tb_jabatan.nama_jabatan as nama_jabatan from tb_pegawai
                         left join tb_gol_pajak on tb_gol_pajak.id_pangkat = tb_pegawai.id_pangkat
                         left join tb_jabatan on tb_jabatan.kd_jabatan = tb_pegawai.jabatan
                         where tb_pegawai.soft_delete = 0 and tb_pegawai.id_peg = '$id_peg'");
            if (mysqli_num_rows($sqlCekPeg) > 0) {
                $pegawai = mysqli_fetch_array($sqlCekPeg);
                $nama = $pegawai['nama_peg'];
                $nip = $pegawai['nip'];
                $id_pangkat = $pegawai['id_pangkat'];
                $jabatan = $pegawai['nama_jabatan'];
                $unit_kerja = 'BBPMP Provinsi Jawa timur';
                $alamat_unit_kerja = 'Kota Surabaya';
                $id_kabkota = 3578;
                $no_hp = "-";
                $viewPangkat = mysqli_fetch_array(mysqli_query($myConnection, "select * from tb_gol_pajak where id_pangkat = '$id_pangkat'"));
                $viewKabkota = mysqli_fetch_array(mysqli_query($myConnection, "select * from tb_kabkota where id = '$id_kabkota'"));

                $gol = $viewPangkat['gol'];
                $pangkat = $viewPangkat['jabatan_struktural'];
                $kabkota_unit_kerja = str_replace('Kabupaten', 'Kab.', ucwords($viewKabkota['name']));
                $tgl_mulai = substr($_POST['tgl_mulai'], 6, 4) . '-' . substr($_POST['tgl_mulai'], 3, 2) . '-' . substr($_POST['tgl_mulai'], 0, 2);
                $tgl_selesai = substr($_POST['tgl_selesai'], 6, 4) . '-' . substr($_POST['tgl_selesai'], 3, 2) . '-' . substr($_POST['tgl_selesai'], 0, 2);

                $sql = "insert into tb_panitia_keg_kantor (id_panitia_keg_kantor, id_keg, id_peg, id_jab_st, nama, nip, gol, pangkat, id_pangkat_gol, jabatan, unit_kerja, alamat_unit_kerja, kabkota_unit_kerja, id_kabkota_unit_kerja, no_hp, tgl_mulai, tgl_selesai, jenis_panitia, lokal, created_by,created_date) values ('$code', '$id_keg', '$id_peg', '$id_jab_st', '$nama', '$nip', '$gol', '$pangkat', '$id_pangkat', '$jabatan', '$unit_kerja', '$alamat_unit_kerja', '$kabkota_unit_kerja', '$id_kabkota', '$no_hp', '$tgl_mulai', '$tgl_selesai', 'internal', '$sbmSurabaya', '$created_by', NOW())";
                // echo $sql;
                $input = mysqli_query($myConnection, $sql);
                if ($input) {
                    $_SESSION['alert'] = "Toast.fire({icon: 'success',title: 'Panitia berhasil ditambahkan'})";
                    echo '<script> window.location="checkDocumentOffice?_token=' . encrypt($id_keg) . '&_type=panitia"; </script>';
                } else {
                    $_SESSION['alert'] = "Toast.fire({icon: 'error',title: 'Panitia gagal ditambahkan'})";
                    echo '<script> window.location="checkDocumentOffice?_token=' . encrypt($id_keg) . '&_type=panitia"; </script>';
                }
            } else {
                $_SESSION['alert'] = "Toast.fire({icon: 'error',title: 'SQL Injection terdeteksi'})";
                echo "<script> window.location='./'; </script>";
            }
        } else {
            $_SESSION['alert'] = "Toast.fire({icon: 'error',title: 'SQL Injection terdeteksi'})";
            echo "<script> window.location='./'; </script>";
        }
    } elseif (isset($_POST['delCommitteeOffice'])) {
        $created_by = $_SESSION['id'];
        $id_keg = mysqli_escape_string($myConnection, decrypt($_POST['_token']));
        $id_panitia_keg_kantor = mysqli_escape_string($myConnection, decrypt($_POST['_id']));

        $cekPanitia = mysqli_query($myConnection, "select * from tb_panitia_keg_kantor where id_keg = '$id_keg' and id_panitia_keg_kantor = '$id_panitia_keg_kantor'");
        if (mysqli_num_rows($cekPanitia) > 0) {

            $input = mysqli_query($myConnection, "delete from tb_panitia_keg_kantor where id_panitia_keg_kantor = '$id_panitia_keg_kantor' and id_keg = '$id_keg' ");
            if ($input) {
                $_SESSION['alert'] = "Toast.fire({icon: 'success',title: 'Panitia berhasil dihapus'})";
                echo '<script> window.location="checkDocumentOffice?_token=' . encrypt($id_keg) . '&_type=panitia"; </script>';
            } else {
                $_SESSION['alert'] = "Toast.fire({icon: 'error',title: 'Panitia gagal dihapus'})";
                echo '<script> window.location="checkDocumentOffice?_token=' . encrypt($id_keg) . '&_type=panitia"; </script>';
            }
        } else {
            $_SESSION['alert'] = "Toast.fire({icon: 'error',title: 'SQL Injection Detected !'})";
            echo '<script> window.location="checkDocumentOffice?_token=' . encrypt($id_keg) . '&_type=panitia"; </script>';
        }
    } elseif (isset($_POST['addExternalCommitteeOffice'])) {
        $created_by = $_SESSION['id'];
        $code2 = time() . '-' . uniqid();
        $code = strtoupper($code2);
        $id_keg = mysqli_escape_string($myConnection, decrypt($_POST['_token']));

        $cekKegiatan = mysqli_query($myConnection, "select * from tb_kegiatan where id_keg = '$id_keg'");
        $sbm = mysqli_fetch_array(mysqli_query($myConnection, "select besaran from tb_kabkota where id = 3578"));
        $sbmSurabaya = $sbm['besaran'];

        if (mysqli_num_rows($cekKegiatan) > 0) {
            $nama = mysqli_escape_string($myConnection, $_POST['nama']);
            $nip = mysqli_escape_string($myConnection, $_POST['nip']);
            $id_pangkat = mysqli_escape_string($myConnection, decrypt($_POST['pangkat']));
            $jabatan = mysqli_escape_string($myConnection, $_POST['jabatan']);
            $unit_kerja = mysqli_escape_string($myConnection, $_POST['unit_kerja']);
            $alamat_unit_kerja = mysqli_escape_string($myConnection, $_POST['alamat_unit_kerja']);
            $id_kabkota = mysqli_escape_string($myConnection, $_POST['kabkota_unitkerja']);
            $no_hp = mysqli_escape_string($myConnection, $_POST['no_hp']);
            $viewPangkat = mysqli_fetch_array(mysqli_query($myConnection, "select * from tb_gol_pajak where id_pangkat = '$id_pangkat'"));
            $viewKabkota = mysqli_fetch_array(mysqli_query($myConnection, "select * from tb_kabkota where id = '$id_kabkota'"));
            $id_jab_st = mysqli_escape_string($myConnection, decrypt($_POST['jabatan_kegiatan']));
            $gol = $viewPangkat['gol'];
            $pangkat = $viewPangkat['jabatan_struktural'];
            $kabkota_unit_kerja = str_replace('Kabupaten', 'Kab.', ucwords($viewKabkota['name']));
            $tgl_mulai = substr($_POST['tgl_mulai'], 6, 4) . '-' . substr($_POST['tgl_mulai'], 3, 2) . '-' . substr($_POST['tgl_mulai'], 0, 2);
            $tgl_selesai = substr($_POST['tgl_selesai'], 6, 4) . '-' . substr($_POST['tgl_selesai'], 3, 2) . '-' . substr($_POST['tgl_selesai'], 0, 2);

            $sql = "insert into tb_panitia_keg_kantor (id_panitia_keg_kantor, id_keg, id_jab_st, nama, nip, gol, pangkat, id_pangkat_gol, jabatan, unit_kerja, alamat_unit_kerja, kabkota_unit_kerja, id_kabkota_unit_kerja, no_hp, tgl_mulai, tgl_selesai, jml_jam, jenis_panitia, lokal, created_by,created_date) values ('$code', '$id_keg', '$id_jab_st', '$nama', '$nip', '$gol', '$pangkat', '$id_pangkat', '$jabatan', '$unit_kerja', '$alamat_unit_kerja', '$kabkota_unit_kerja', '$id_kabkota', '$no_hp', '$tgl_mulai', '$tgl_selesai', '1', 'eksternal', '$sbmSurabaya', '$created_by', NOW())";
            // echo $sql;
            $input = mysqli_query($myConnection, $sql);
            if ($input) {
                $_SESSION['alert'] = "Toast.fire({icon: 'success',title: 'Panitia berhasil ditambahkan'})";
                echo '<script> window.location="checkDocumentOffice?_token=' . encrypt($id_keg) . '&_type=panitia"; </script>';
            } else {
                $_SESSION['alert'] = "Toast.fire({icon: 'error',title: 'Panitia gagal ditambahkan'})";
                echo '<script> window.location="checkDocumentOffice?_token=' . encrypt($id_keg) . '&_type=panitia"; </script>';
            }
        } else {
            $_SESSION['alert'] = "Toast.fire({icon: 'error',title: 'SQL Injection terdeteksi'})";
            echo "<script> window.location='./'; </script>";
        }
    } elseif (isset($_POST['editCommitteeExternal'])) {
        $created_by = $_SESSION['id'];
        $id_keg = mysqli_escape_string($myConnection, decrypt($_POST['_token']));
        $id_panitia_keg_kantor = mysqli_escape_string($myConnection, decrypt($_POST['_id']));

        $cekPanitia = mysqli_query($myConnection, "select * from tb_panitia_keg_kantor where id_keg = '$id_keg' and id_panitia_keg_kantor = '$id_panitia_keg_kantor'");
        if (mysqli_num_rows($cekPanitia) > 0) {
            $nama = mysqli_escape_string($myConnection, $_POST['nama']);
            $nip = mysqli_escape_string($myConnection, $_POST['nip']);
            $id_pangkat = mysqli_escape_string($myConnection, decrypt($_POST['pangkat']));
            $jabatan = mysqli_escape_string($myConnection, $_POST['jabatan']);
            $unit_kerja = mysqli_escape_string($myConnection, $_POST['unit_kerja']);
            $alamat_unit_kerja = mysqli_escape_string($myConnection, $_POST['alamat_unit_kerja']);
            $id_kabkota = mysqli_escape_string($myConnection, $_POST['kabkota_unitkerja']);
            $no_hp = mysqli_escape_string($myConnection, $_POST['no_hp']);
            $viewPangkat = mysqli_fetch_array(mysqli_query($myConnection, "select * from tb_gol_pajak where id_pangkat = '$id_pangkat'"));
            $viewKabkota = mysqli_fetch_array(mysqli_query($myConnection, "select * from tb_kabkota where id = '$id_kabkota'"));
            $id_jab_st = mysqli_escape_string($myConnection, decrypt($_POST['jabatan_kegiatan']));
            $gol = $viewPangkat['gol'];
            $pangkat = $viewPangkat['jabatan_struktural'];
            $kabkota_unit_kerja = str_replace('Kabupaten', 'Kab.', ucwords($viewKabkota['name']));

            $update = mysqli_query($myConnection, "update tb_panitia_keg_kantor set
            id_jab_st = '$id_jab_st',
            nama = '$nama',
            nip = '$nip',
            gol = '$gol',
            pangkat = '$pangkat',
            id_pangkat_gol = '$id_pangkat',
            jabatan = '$jabatan',
            unit_kerja = '$unit_kerja',
            alamat_unit_kerja = '$alamat_unit_kerja',
            kabkota_unit_kerja = '$kabkota_unit_kerja',
            id_kabkota_unit_kerja = '$id_kabkota',
            no_hp = '$no_hp'
            where id_keg = '$id_keg' and id_panitia_keg_kantor = '$id_panitia_keg_kantor' ");
            if ($update) {
                $_SESSION['alert'] = "Toast.fire({icon: 'success',title: 'Panitia berhasil diubah'})";
                echo '<script> window.location="checkDocumentOffice?_token=' . encrypt($id_keg) . '&_type=panitia"; </script>';
            } else {
                $_SESSION['alert'] = "Toast.fire({icon: 'error',title: 'Panitia gagal diubah'})";
                echo '<script> window.location="checkDocumentOffice?_token=' . encrypt($id_keg) . '&_type=panitia"; </script>';
            }
        } else {
            $_SESSION['alert'] = "Toast.fire({icon: 'error',title: 'SQL Injection Detected !'})";
            echo '<script> window.location="checkDocumentOffice?_token=' . encrypt($id_keg) . '&_type=panitia"; </script>';
        }
    } elseif (isset($_POST['editAttendanceCommitteeOffice'])) {
        $created_by = $_SESSION['id'];
        $id_keg = mysqli_escape_string($myConnection, decrypt($_POST['_token']));
        $id_panitia_keg_kantor = mysqli_escape_string($myConnection, decrypt($_POST['_id']));

        $cekPanitia = mysqli_query($myConnection, "select * from tb_panitia_keg_kantor where id_keg = '$id_keg' and id_panitia_keg_kantor = '$id_panitia_keg_kantor'");
        if (mysqli_num_rows($cekPanitia) > 0) {
            $tgl_mulai = substr($_POST['tgl_mulai'], 6, 4) . '-' . substr($_POST['tgl_mulai'], 3, 2) . '-' . substr($_POST['tgl_mulai'], 0, 2);
            $tgl_selesai = substr($_POST['tgl_selesai'], 6, 4) . '-' . substr($_POST['tgl_selesai'], 3, 2) . '-' . substr($_POST['tgl_selesai'], 0, 2);
            $jml_jam = mysqli_escape_string($myConnection, bersihkan($_POST['jml_jam']));

            $update = mysqli_query($myConnection, "update tb_panitia_keg_kantor set
           tgl_mulai = '$tgl_mulai',
           tgl_selesai = '$tgl_selesai',
           jml_jam = '$jml_jam'
            where id_keg = '$id_keg' and id_panitia_keg_kantor = '$id_panitia_keg_kantor' ");
            if ($update) {
                $_SESSION['alert'] = "Toast.fire({icon: 'success',title: 'Panitia berhasil diubah'})";
                echo '<script> window.location="checkDocumentOffice?_token=' . encrypt($id_keg) . '&_type=panitia"; </script>';
            } else {
                $_SESSION['alert'] = "Toast.fire({icon: 'error',title: 'Panitia gagal diubah'})";
                echo '<script> window.location="checkDocumentOffice?_token=' . encrypt($id_keg) . '&_type=panitia"; </script>';
            }
        } else {
            $_SESSION['alert'] = "Toast.fire({icon: 'error',title: 'SQL Injection Detected !'})";
            echo '<script> window.location="checkDocumentOffice?_token=' . encrypt($id_keg) . '&_type=panitia"; </script>';
        }
    } else {
        echo '<script type="text/javascript">
	window.location = "./"
	</script>';
    }
} else {
    echo '<script type="text/javascript">
    window.location = "./"
    </script>';
}
