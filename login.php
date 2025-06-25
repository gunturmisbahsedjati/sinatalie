<?php
session_start();
if (isset($_SESSION['status_login'])) {
  header('location:./');
  exit;
}
?>
<!DOCTYPE html>

<html lang="en" class="light-style layout-wide customizer-hide" dir="ltr" data-theme="theme-default" data-assets-path="assets/" data-template="vertical-menu-template-free">

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
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="assets/vendor/fonts/materialdesignicons.css" />

  <!-- Menu waves for no-customizer fix -->
  <link rel="stylesheet" href="assets/vendor/libs/node-waves/node-waves.css" />

  <!-- Core CSS -->
  <link rel="stylesheet" href="assets/vendor/css/core.css" class="template-customizer-core-css" />
  <link rel="stylesheet" href="assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
  <link rel="stylesheet" href="assets/css/demo.css" />

  <!-- Vendors CSS -->
  <link rel="stylesheet" href="assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />
  <link rel="stylesheet" type="text/css" href="assets/vendor/libs/sweetalert/sweetalert2.css" />
  <script src="assets/vendor/libs/sweetalert/sweetalert2.js"></script>

  <!-- Page CSS -->
  <!-- Page -->
  <link rel="stylesheet" href="assets/vendor/css/pages/page-auth.css?ver=<?php echo time(); ?>" />

  <!-- Helpers -->
  <script src="assets/vendor/js/helpers.js"></script>
  <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
  <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
  <script src="assets/js/config.js"></script>
</head>

<body>
  <!-- Content -->
  <div id="preloader">
    <div class="jumper">
      <div></div>
      <div></div>
      <div></div>
    </div>
  </div>
  <div class="container-xxl mt-4">
    <div class="authentication-wrapper authentication-basic container-p-y">
      <div class="authentication-inner">
        <div class="card">
          <div class="card-body">
            <img src="assets/image/logo.png" class="mx-auto d-block" width="30%">
            <h4 style="font-size: 2em;" class="mb-1 text-center fw-bold">Si-NaTALie</h4>
            <p class="mb-4 text-center">Sistem Informasi Manajemen<br>Surat Pertanggungjawaban Online</p>
            <form id="formAuthentication" class="mb-3" action="" method="POST">
              <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" name="username" placeholder="Enter your username" autofocus />
              </div>
              <div class="mb-3 form-password-toggle">
                <div class="d-flex justify-content-between">
                  <label class="form-label" for="password">Password</label>
                </div>
                <div class="input-group input-group-merge">
                  <input type="password" id="password" class="form-control" name="password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="password" />
                </div>
              </div>
              <div class="mb-4 pt-3">
                <button class="btn d-grid w-100 btn-login" type="submit">Login</button>
                <button class="btn btn-loading d-none d-grid w-100" type="button">
                  <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                </button>
              </div>
            </form>
            <p class="text-center foot">
              <span class="copyright">&copy; BBPMP Provinsi Jawa Timur <?php echo date('Y') ?><br />Developed with ❤ by Team IT BBPMP Provinsi Jawa Timur</span>
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
  </div>
  </div>
  </div>

  <!-- / Content -->

  <!-- Core JS -->
  <!-- build:js assets/vendor/js/core.js -->
  <script src="assets/vendor/libs/jquery/jquery.js"></script>
  <script src="assets/vendor/libs/popper/popper.js"></script>
  <script src="assets/vendor/js/bootstrap.js"></script>
  <script src="assets/vendor/libs/node-waves/node-waves.js"></script>
  <script src="assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
  <script src="assets/vendor/js/menu.js"></script>

  <!-- endbuild -->

  <!-- Vendors JS -->

  <!-- Main JS -->
  <script src="assets/js/main.js"></script>
  <script src="assets/js/wizard.js?ver=<?php echo time(); ?>"></script>
</body>

</html>