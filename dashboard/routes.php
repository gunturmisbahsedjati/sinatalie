<?php
$do = explode("/", $_REQUEST['do']);
$opsi = $do[0];

define('PUB_DIR', dirname(__FILE__) . '/');

switch ($opsi) {
    case 'home':
        require_once(PUB_DIR . 'page/home.php');
        break;

        //page master
    case 'account':
        require_once(PUB_DIR . 'page/master/data_akun.php');
        break;
    case 'setAccount':
        require_once(PUB_DIR . 'page/master/akun_manajemen/akun-aksi.php');
        break;
    case 'shoppingList':
        require_once(PUB_DIR . 'page/master/data_akun_belanja.php');
        break;
    case 'setShopping':
        require_once(PUB_DIR . 'page/master/akun_belanja/akun-belanja-aksi.php');
        break;
    case 'dipaList':
        require_once(PUB_DIR . 'page/master/data_dipa.php');
        break;
    case 'setDipa':
        require_once(PUB_DIR . 'page/master/dipa/dipa-aksi.php');
        break;
    case 'mapping':
        require_once(PUB_DIR . 'page/master/data_mapping_wilayah.php');
        break;
    case 'setMapping':
        require_once(PUB_DIR . 'page/master/mapping_kabkota/mapping-aksi.php');
        break;
    case 'employee':
        require_once(PUB_DIR . 'page/master/data_pegawai.php');
        break;
    case 'setEmployee':
        require_once(PUB_DIR . 'page/master/pegawai/pegawai-aksi.php');
        break;

        //perjadin hotel
    case 'documentHotel':
        require_once(PUB_DIR . 'page/transaksi/data_perjadin_kegiatan_hotel.php');
        break;
    case 'setDocumentHotel':
        require_once(PUB_DIR . 'page/transaksi/perjadin_kegiatan_hotel/perjadin-hotel-aksi.php');
        break;

    case 'checkDocumentHotel':
        require_once(PUB_DIR . 'page/transaksi/perjadin_kegiatan_hotel/detail-perjadin-hotel.php');
        break;
    case 'formInputParticipantDocumentHotel':
        require_once(PUB_DIR . 'page/transaksi/perjadin_kegiatan_hotel/page_detail_perjadin_hotel/pengisian-semua-transport-peserta.php');
        break;


        //perjadin luring
    case 'documentOffice':
        require_once(PUB_DIR . 'page/transaksi/data_perjadin_kegiatan_kantor.php');
        break;
    case 'setDocumentOffice':
        require_once(PUB_DIR . 'page/transaksi/perjadin_kegiatan_kantor/perjadin-kantor-aksi.php');
        break;

    case 'checkDocumentOffice':
        require_once(PUB_DIR . 'page/transaksi/perjadin_kegiatan_kantor/detail-perjadin-kantor.php');
        break;
    case 'formInputParticipantDocumentOffice':
        require_once(PUB_DIR . 'page/transaksi/perjadin_kegiatan_kantor/page_detail_perjadin_kantor/pengisian-semua-transport-peserta.php');
        break;

        //signout
    case 'logout':
        require_once(PUB_DIR . '../signout.php');
        break;

    default:
        require_once(PUB_DIR . 'page/home.php');
}
