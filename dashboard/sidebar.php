<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="index.html" class="app-brand-link mt-2">
            <img src="assets/image/logo.png" alt="" width="23%">
            <span class="app-brand-text  menu-text fw-bold ms-1" style="font-size: 2.0em;">SI-NaTALie</span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
            <i class="mdi menu-toggle-icon d-xl-block align-middle mdi-20px"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        <li class="menu-header fw-medium mt-4"><span class="menu-header-text fw-bold">Navigation</span></li>
        <li class="menu-item">
            <a href="./" class="menu-link">
                <i class="menu-icon tf-icons mdi mdi-home-outline"></i>
                <div data-i18n="Dashboard">Dashboard</div>
            </a>
        </li>

        <?php
        //level admin 
        if ($_SESSION['level'] == 1) { ?>
            <li class="menu-header fw-medium mt-4"><span class="menu-header-text fw-bold">Data Master</span></li>
            <li class="menu-item">
                <a href="account" class="menu-link">
                    <i class="menu-icon tf-icons mdi mdi-account-key"></i>
                    <div data-i18n="Data Akun">Data Akun</div>
                </a>
            </li>
            <li class="menu-item">
                <a href="employee" class="menu-link">
                    <i class="menu-icon tf-icons mdi mdi-clipboard-account"></i>
                    <div data-i18n="Data Pegawai">Data Pegawai</div>
                </a>
            </li>
            <li class="menu-item">
                <a href="dipaList" class="menu-link">
                    <i class="menu-icon tf-icons mdi mdi-briefcase-check"></i>
                    <div data-i18n="Data DIPA">Data DIPA</div>
                </a>
            </li>
            <li class="menu-item">
                <a href="shoppingList" class="menu-link">
                    <i class="menu-icon tf-icons mdi mdi-cart"></i>
                    <div data-i18n="Data Belanja">Data Belanja</div>
                </a>
            </li>
            <li class="menu-item">
                <a href="mapping" class="menu-link">
                    <i class="menu-icon tf-icons mdi mdi-map-marker-radius"></i>
                    <div>Mapping Wilayah</div>
                </a>
            </li>
        <?php } ?>

        <li class="menu-header fw-medium mt-4"><span class="menu-header-text fw-bold">Data Transaksi SPJ</span></li>
        <li class="menu-item">
            <a href="#" data-bs-toggle="modal" data-bs-target="#choosePeriodHotel" class="menu-link">
                <i class="menu-icon tf-icons mdi mdi-file-sign"></i>
                <div data-i18n="SPJ Hotel">SPJ Hotel</div>
            </a>
        </li>
        <li class="menu-item">
            <a href="#" data-bs-toggle="modal" data-bs-target="#choosePeriodOffice" class="menu-link">
                <i class="menu-icon tf-icons mdi mdi-file-sign"></i>
                <div data-i18n="SPJ Hotel">SPJ Luring/Kantor</div>
            </a>
        </li>
    </ul>
</aside>
<div class="modal fade" id="choosePeriodHotel" tabindex="-1" data-bs-backdrop="static" role="dialog" aria-labelledby="exampleEditModal" aria-hidden="true" aria-modal="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div id="load-choose-period-hotel" style="display: none;">
                <div class="modal-body">
                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                    loading......
                </div>
            </div>
            <div class="choose-period-hotel" id="choose-period-hotel"></div>
        </div>
    </div>
</div>
<div class="modal fade" id="choosePeriodOffice" tabindex="-1" data-bs-backdrop="static" role="dialog" aria-labelledby="exampleEditModal" aria-hidden="true" aria-modal="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div id="load-choose-period-office" style="display: none;">
                <div class="modal-body">
                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                    loading......
                </div>
            </div>
            <div class="choose-period-office" id="choose-period-office"></div>
        </div>
    </div>
</div>

<div class="modal fade" id="commingSoon" tabindex="-1" data-bs-backdrop="static" role="dialog" aria-labelledby="exampleEditModal" aria-hidden="true" aria-modal="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div id="load-comingsoon" style="display: none;">
                <div class="modal-body">
                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                    loading......
                </div>
            </div>
            <div class="comingsoon" id="comingsoon"></div>
        </div>
    </div>
</div>