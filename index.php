<?php
session_start();
require_once 'inc/inc.koneksi.php';
if (!isset($_SESSION['username'])) {
  header('location:/');
} else {
  $username = $_SESSION['username'];
  $nama_akun = $_SESSION['nama_akun'];
  $id = $_SESSION['id'];
  $level = $_SESSION['level'];
  $arrayAkses = explode(",", $_SESSION['level']);
  if (time() - $_SESSION["login_time_stamp"] > 57600) {
    session_unset();
    session_destroy();
    header("location:login");
  }
}

if (!isset($_SESSION['status_login'])) {
  header('location:login');
  exit;
}

$cek_status_akun = mysqli_num_rows(mysqli_query($myConnection, "SELECT * FROM akun_manajemen WHERE user_manajemen='$username' and id_manajemen = '$id' and level_manajemen = '$level' and status_manajemen = 'aktif' and soft_delete = 0 "));
if ($cek_status_akun == 0) {
  session_destroy();
  header("location:./");
}

?>
<!DOCTYPE html>

<html lang="en" class="light-style layout-menu-fixed layout-compact" dir="ltr" data-theme="theme-default" data-assets-path="assets/" data-template="vertical-menu-template">

<head>
  <meta charset="UTF-8">
  <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
  <meta name="description" content="SINATALIE BBPMP Provinsi Jawa Timur">
  <meta name="robots" content="index" />
  <meta name="name" content="SINATALIE">
  <meta name="shot-name" content="SINATALIE">
  <meta name="keywords" content="SINATALIE jatim, sistem informasi manajemen surat pertanggungjawaban online, bbpmp provinsi jawa timur, SINATALIE balai besar penjaminan mutu pendidikan" />
  <meta name="author" content="Arghavan Barra Al Misbah" />
  <meta name="language" content="Indonesia" />
  <meta name="theme-color" content="#0d0072" />
  <meta http-equiv="expires" content="0">
  <meta http-equiv="pragma" content="no-cache">
  <meta http-equiv="cache-control" content="no-cache, must-revalidate">

  <title>Si-NaTALie | BBPMP Provinsi Jawa Timur</title>

  <!-- Favicon -->
  <link rel="icon" type="image/x-icon" href="assets/image/logo.png" />

  <!-- Fonts -->
  <!-- <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&ampdisplay=swap" rel="stylesheet" /> -->

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="assets/vendor/fonts/materialdesignicons.css" />

  <!-- Menu waves for no-customizer fix -->
  <link rel="stylesheet" href="assets/vendor/libs/node-waves/node-waves.css" />

  <!-- Core CSS -->
  <link rel="stylesheet" href="assets/vendor/css/core.css" class="template-customizer-core-css" />
  <link rel="stylesheet" href="assets/vendor/css/theme-default.css?ver=<?php echo md5(time()); ?>" class="template-customizer-theme-css" />
  <link rel="stylesheet" href="assets/css/demo.css" />

  <!-- Vendors CSS -->
  <link rel="stylesheet" href="assets/vendor/libs/datatables/dataTables.bootstrap5.min.css" />
  <link rel="stylesheet" href="assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />
  <link rel="stylesheet" href="assets/vendor/libs/apex-charts/apex-charts.css" />
  <link rel="stylesheet" type="text/css" href="assets/vendor/libs/sweetalert/sweetalert2.css">
  <script src="assets/vendor/libs/sweetalert/sweetalert2.js"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/css/bootstrap-select.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.4/css/buttons.bootstrap5.min.css">
  <link href="https://unpkg.com/gijgo@1.9.14/css/gijgo.min.css" rel="stylesheet" type="text/css" />

  <!-- Page CSS -->

  <!-- Helpers -->
  <script src="assets/vendor/js/helpers.js"></script>
  <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
  <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
  <script src="assets/js/config.js"></script>
</head>

<body>

  <!-- <body style="margin:0;" onload="loadingPage()"> -->
  <!-- Layout wrapper -->
  <div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">
      <!-- Menu -->

      <?php include_once 'dashboard/sidebar.php'; ?>
      <!-- / Menu -->

      <!-- Layout container -->
      <div class="layout-page">
        <!-- Navbar -->

        <?php include_once 'dashboard/header.php'; ?>

        <!-- / Navbar -->

        <!-- Content wrapper -->
        <div class="content-wrapper">
          <!-- <div class="loader" id="loader"></div> -->
          <!-- Content -->
          <!-- <div style="display:none;" id="content"> -->
          <div>
            <?php include_once 'dashboard/routes.php'; ?>
          </div>
          <!-- / Content -->

          <!-- Footer -->
          <!-- <footer class="content-footer footer bg-footer-theme">
            <div class="container-xxl d-flex flex-wrap justify-content-between  flex-md-row flex-column">
              <div class="mb-2 mb-md-0">
                &copy; BAN S/M Provinsi Jawa Timur <?php echo date('Y') ?>
              </div>
              <div>
                Developed by Team IT BAN S/M Provinsi Jawa Timur
              </div>
            </div>
          </footer> -->
          <!-- / Footer -->

          <div class="content-backdrop fade"></div>
        </div>
        <!-- Content wrapper -->
      </div>
      <!-- / Layout page -->
    </div>

    <!-- Overlay -->
    <div class="layout-overlay layout-menu-toggle"></div>
  </div>
  <!-- / Layout wrapper -->

  <!-- Core JS -->
  <!-- build:js assets/vendor/js/core.js -->
  <script src="assets/vendor/libs/jquery/jquery-3.5.1.js"></script>
  <!-- <script src="assets/vendor/libs/popper/popper.js"></script>
  <script src="assets/vendor/js/bootstrap.js"></script> -->
  <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script> -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/libs/node-waves/node-waves.js"></script>
  <script src="assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
  <script src="assets/vendor/js/menu.js"></script>

  <!-- endbuild -->

  <!-- Vendors JS -->
  <script src="assets/vendor/libs/apex-charts/apexcharts.js"></script>
  <script src="assets/vendor/libs/datatables/jquery.dataTables.min.js"></script>
  <script src="assets/vendor/libs/datatables/dataTables.fixedColumns.min.js"></script>
  <!-- <script src="https://cdn.datatables.net/fixedheader/4.0.1/js/dataTables.fixedHeader.js"></script>
  <script src="https://cdn.datatables.net/fixedheader/4.0.1/js/fixedHeader.dataTables.js"></script>
  <script src="https://cdn.datatables.net/scroller/2.4.3/js/dataTables.scroller.js"></script>
  <script src="https://cdn.datatables.net/scroller/2.4.3/js/scroller.dataTables.js"></script> -->
  <script src="assets/vendor/libs/datatables/dataTables.bootstrap5.js"></script>
  <script src="https://unpkg.com/gijgo@1.9.14/js/gijgo.min.js" type="text/javascript"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/js/bootstrap-select.min.js"></script>
  <!-- Main JS -->
  <script src="assets/js/main.js"></script>
  <script src="assets/js/wizard.js?ver=<?php echo md5(time()); ?>"></script>

  <!-- Page JS -->
  <!-- <script src=" assets/js/dashboards-analytics.js"></script> -->
  <!-- <script src="assets/js/ui-popover.js"></script> -->

  <script type="text/javascript">
    function popupCenter(url, title, w, h) {
      var dualScreenLeft = window.screenLeft != undefined ? window.screenLeft : screen.left;
      var dualScreenTop = window.screenTop != undefined ? window.screenTop : screen.top;
      width = window.innerWidth ? window.innerWidth : document.documentElement.clientWidth ? document.documentElement.clientWidth : screen.width;
      height = window.innerHeight ? window.innerHeight : document.documentElement.clientHeight ? document.documentElement.clientHeight : screen.height;

      var left = ((width / 2) - (w / 2)) + dualScreenLeft;
      var top = ((height / 2) - (h / 2)) + dualScreenTop;
      var newWindow = window.open(url, title, 'scrollbars=yes, width=' + w + ', height=' + h + ', top=' + top + ', left=' + left);

      if (window.focus) {
        newWindow.focus();
      }
    }

    function pdfViewer(url) {
      popupWindow = window.open(url, 'popUpWindow', 'height=500,width=500,left=100,top=100,resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no, status=yes');
    }
  </script>

  <!-- Place this tag in your head or just before your close body tag. -->
  <!-- <script async defer src="https://buttons.github.io/buttons.js"></script> -->
</body>

</html>