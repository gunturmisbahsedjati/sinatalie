<div class="offcanvas offcanvas-end" data-bs-backdrop="static" tabindex="-1" id="printSPJ" aria-labelledby="staticBackdropLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="staticBackdropLabel"><i class='tf-icons mdi mdi-printer-outline mb-1'></i> Cetak SPJ Kantor</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <div>
            <div class="divider divider-success">
                <div class="divider-text text-success fw-bold">Ekspor Excel</div>
            </div>
            <a href="dashboard/page/cetak/spj_kantor/cetak-excel-master-spj?_token=<?= encrypt($id_keg) ?>" class="mt-2 me-2 btn btn-success2 d-grid w-100 waves-effect waves-light" title="Ekspor Excel Master SPJ dan Master Pecahan Uang">Master SPJ</a>
            <!-- <a href="dashboard/page/cetak/spj_kantor/cetak-excel-nom-transport?_token=<?= encrypt($id_keg) ?>" class="mt-2 me-2 btn btn-success2 d-grid w-100 waves-effect waves-light" title="Ekspor Excel NOM Transport dan SPTJB Transport">NOM Transport</a>
            <a href="dashboard/page/cetak/spj_kantor/cetak-excel-nom-honor?_token=<?= encrypt($id_keg) ?>" class="mt-2 me-2 btn btn-success2 d-grid w-100 waves-effect waves-light" title="Ekspor Excel NOM Honor dan SPTJB Honor">NOM Honor</a> -->

            <div class="divider divider-danger">
                <div class="divider-text text-danger fw-bold">Ekspor PDF</div>
            </div>
            <div class="divider text-start">
                <div class="divider-text">Pengarah</div>
            </div>
            <div class="row">
                <div class="col-md-6 col-12">
                    <a href="javascript:void(0)" onclick="popupCenter('dashboard/page/cetak/spj_kantor/cetak-kuitansi-pengarah?_token=<?= encrypt($id_keg) ?>','pop',900,600) ;" class="mt-2 me-2 btn btn-danger d-grid w-100 waves-effect waves-light" title="Ekspor PDF Kuitansi Perjadin">Kuitansi</a>
                </div>
                <div class="col-md-6 col-12">
                    <a href="javascript:void(0)" onclick="popupCenter('dashboard/page/cetak/spj_kantor/cetak-amplop-pengarah?_token=<?= encrypt($id_keg) ?>','pop',900,600) ;" class="mt-2 me-2 btn btn-danger d-grid w-100 waves-effect waves-light" title="Ekspor PDF Amplop Perjadin">Amplop</a>
                </div>
            </div>
            <div class="divider text-start">
                <div class="divider-text">Narasumber</div>
            </div>
            <div class="row">
                <div class="col-md-6 col-12">
                    <a href="javascript:void(0)" onclick="popupCenter('dashboard/page/cetak/spj_kantor/cetak-kuitansi-narsum?_token=<?= encrypt($id_keg) ?>','pop',900,600) ;" class="mt-2 me-2 btn btn-danger d-grid w-100 waves-effect waves-light" title="Ekspor PDF Kuitansi Perjadin">Kuitansi</a>
                </div>
                <div class="col-md-6 col-12">
                    <a href="javascript:void(0)" onclick="popupCenter('dashboard/page/cetak/spj_kantor/cetak-amplop-narsum?_token=<?= encrypt($id_keg) ?>','pop',900,600) ;" class="mt-2 me-2 btn btn-danger d-grid w-100 waves-effect waves-light" title="Ekspor PDF Amplop Perjadin">Amplop</a>
                </div>
            </div>
            <div class="divider text-start">
                <div class="divider-text">Panitia</div>
            </div>
            <div class="row">
                <div class="col-md-6 col-12">
                    <a href="javascript:void(0)" onclick="popupCenter('dashboard/page/cetak/spj_kantor/cetak-kuitansi-panitia?_token=<?= encrypt($id_keg) ?>','pop',900,600) ;" class="mt-2 me-2 btn btn-danger d-grid w-100 waves-effect waves-light" title="Ekspor PDF Kuitansi Perjadin">Kuitansi</a>
                </div>
                <div class="col-md-6 col-12">
                    <a href="javascript:void(0)" onclick="popupCenter('dashboard/page/cetak/spj_kantor/cetak-amplop-panitia?_token=<?= encrypt($id_keg) ?>','pop',900,600) ;" class="mt-2 me-2 btn btn-danger d-grid w-100 waves-effect waves-light" title="Ekspor PDF Amplop Perjadin">Amplop</a>
                </div>
            </div>
            <div class="divider text-start">
                <div class="divider-text">Peserta</div>
            </div>
            <div class="row">
                <div class="col-md-6 col-12">
                    <a href="javascript:void(0)" onclick="popupCenter('dashboard/page/cetak/spj_kantor/cetak-kuitansi-peserta?_token=<?= encrypt($id_keg) ?>','pop',900,600) ;" class="mt-2 me-2 btn btn-danger d-grid w-100 waves-effect waves-light" title="Ekspor PDF Kuitansi Perjadin">Kuitansi</a>
                </div>
                <div class="col-md-6 col-12">
                    <a href="javascript:void(0)" onclick="popupCenter('dashboard/page/cetak/spj_kantor/cetak-amplop-peserta?_token=<?= encrypt($id_keg) ?>','pop',900,600) ;" class="mt-2 me-2 btn btn-danger d-grid w-100 waves-effect waves-light" title="Ekspor PDF Amplop Perjadin">Amplop</a>
                </div>
            </div>

        </div>
    </div>
</div>
<div class="modal fade" id="setReceiptOffice" tabindex="-1" data-bs-backdrop="static" role="dialog" aria-labelledby="exampleEditModal" aria-hidden="true" aria-modal="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div id="load-set-receipt-office" style="display: none;">
                <div class="modal-body">
                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                    loading......
                </div>
            </div>
            <div class="set-receipt-office" id="set-receipt-office"></div>
        </div>
    </div>
</div>
<div class="modal fade" id="setFinancialReceiptOffice" tabindex="-1" data-bs-backdrop="static" role="dialog" aria-labelledby="exampleEditModal" aria-hidden="true" aria-modal="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div id="load-set-financial-receipt-office" style="display: none;">
                <div class="modal-body">
                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                    loading......
                </div>
            </div>
            <div class="set-financial-receipt-office" id="set-financial-receipt-office"></div>
        </div>
    </div>
</div>
<div class="modal fade" id="delOfficeClerk" tabindex="-1" data-bs-backdrop="static" role="dialog" aria-labelledby="exampleEditModal" aria-hidden="true" aria-modal="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div id="load-del-office-clerk" style="display: none;">
                <div class="modal-body">
                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                    loading......
                </div>
            </div>
            <div class="del-office-clerk" id="del-office-clerk"></div>
        </div>
    </div>
</div>
<div class="modal fade" id="addOfficeClerk" tabindex="-1" data-bs-backdrop="static" role="dialog" aria-labelledby="exampleEditModal" aria-hidden="true" aria-modal="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div id="load-add-office-clerk" style="display: none;">
                <div class="modal-body">
                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                    loading......
                </div>
            </div>
            <div class="add-office-clerk" id="add-office-clerk"></div>
        </div>
    </div>
</div>
<div class="modal fade" id="addFinancialOfficeClerk" tabindex="-1" data-bs-backdrop="static" role="dialog" aria-labelledby="exampleEditModal" aria-hidden="true" aria-modal="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div id="load-add-financial-office-clerk" style="display: none;">
                <div class="modal-body">
                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                    loading......
                </div>
            </div>
            <div class="add-financial-office-clerk" id="add-financial-office-clerk"></div>
        </div>
    </div>
</div>
<div class="modal fade" id="syncDataOffice" tabindex="-1" data-bs-backdrop="static" role="dialog" aria-labelledby="exampleEditModal" aria-hidden="true" aria-modal="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div id="load-sync-data-office" style="display: none;">
                <div class="modal-body">
                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                    loading......
                </div>
            </div>
            <div class="sync-data-office" id="sync-data-office"></div>
        </div>
    </div>
</div>
<div class="modal fade" id="importParticipantOffice" tabindex="-1" data-bs-backdrop="static" role="dialog" aria-labelledby="exampleEditModal" aria-hidden="true" aria-modal="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div id="load-import-participant-office" style="display: none;">
                <div class="modal-body">
                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                    loading......
                </div>
            </div>
            <div class="import-participant-office" id="import-participant-office"></div>
        </div>
    </div>
</div>
<div class="modal fade" id="delAllParticipantOffice" tabindex="-1" data-bs-backdrop="static" role="dialog" aria-labelledby="exampleEditModal" aria-hidden="true" aria-modal="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div id="load-del-all-participant-office" style="display: none;">
                <div class="modal-body">
                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                    loading......
                </div>
            </div>
            <div class="del-all-participant-office" id="del-all-participant-office"></div>
        </div>
    </div>
</div>
<div class="modal fade" id="delParticipantOffice" tabindex="-1" data-bs-backdrop="static" role="dialog" aria-labelledby="exampleEditModal" aria-hidden="true" aria-modal="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div id="load-del-participant-office" style="display: none;">
                <div class="modal-body">
                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                    loading......
                </div>
            </div>
            <div class="del-participant-office" id="del-participant-office"></div>
        </div>
    </div>
</div>
<div class="modal fade" id="inputTransportParticipantOffice" tabindex="-1" data-bs-backdrop="static" role="dialog" aria-labelledby="exampleEditModal" aria-hidden="true" aria-modal="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div id="load-input-transport-participant-office" style="display: none;">
                <div class="modal-body">
                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                    loading......
                </div>
            </div>
            <div class="input-transport-participant-office" id="input-transport-participant-office"></div>
        </div>
    </div>
</div>
<div class="modal fade" id="inputTransportAllParticipantOffice" tabindex="-1" data-bs-backdrop="static" role="dialog" aria-labelledby="exampleEditModal" aria-hidden="true" aria-modal="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div id="load-input-transport-all-participant-office" style="display: none;">
                <div class="modal-body">
                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                    loading......
                </div>
            </div>
            <div class="input-transport-all-participant-office" id="input-transport-all-participant-office"></div>
        </div>
    </div>
</div>
<div class="modal fade" id="addFinanceUsersOffice" tabindex="-1" data-bs-backdrop="static" role="dialog" aria-labelledby="exampleEditModal" aria-hidden="true" aria-modal="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div id="load-add-finance-users-office" style="display: none;">
                <div class="modal-body">
                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                    loading......
                </div>
            </div>
            <div class="add-finance-users-office" id="add-finance-users-office"></div>
        </div>
    </div>
</div>
<div class="modal fade" id="addDirectorExternalOffice" tabindex="-1" data-bs-backdrop="static" role="dialog" aria-labelledby="exampleEditModal" aria-hidden="true" aria-modal="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div id="load-add-director-external-office" style="display: none;">
                <div class="modal-body">
                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                    loading......
                </div>
            </div>
            <div class="add-director-external-office" id="add-director-external-office"></div>
        </div>
    </div>
</div>
<div class="modal fade" id="addDirectorInternalOffice" tabindex="-1" data-bs-backdrop="static" role="dialog" aria-labelledby="exampleEditModal" aria-hidden="true" aria-modal="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div id="load-add-director-internal-office" style="display: none;">
                <div class="modal-body">
                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                    loading......
                </div>
            </div>
            <div class="add-director-internal-office" id="add-director-internal-office"></div>
        </div>
    </div>
</div>
<div class="modal fade" id="editDirectorExternalOffice" tabindex="-1" data-bs-backdrop="static" role="dialog" aria-labelledby="exampleEditModal" aria-hidden="true" aria-modal="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div id="load-edit-director-external-office" style="display: none;">
                <div class="modal-body">
                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                    loading......
                </div>
            </div>
            <div class="edit-director-external-office" id="edit-director-external-office"></div>
        </div>
    </div>
</div>
<div class="modal fade" id="delDirectorOffice" tabindex="-1" data-bs-backdrop="static" role="dialog" aria-labelledby="exampleEditModal" aria-hidden="true" aria-modal="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div id="load-del-director-office" style="display: none;">
                <div class="modal-body">
                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                    loading......
                </div>
            </div>
            <div class="del-director-office" id="del-director-office"></div>
        </div>
    </div>
</div>
<div class="modal fade" id="inputTransportDirectorOffice" tabindex="-1" data-bs-backdrop="static" role="dialog" aria-labelledby="exampleEditModal" aria-hidden="true" aria-modal="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div id="load-input-transport-director-office" style="display: none;">
                <div class="modal-body">
                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                    loading......
                </div>
            </div>
            <div class="input-transport-director-office" id="input-transport-director-office"></div>
        </div>
    </div>
</div>
<div class="modal fade" id="addInformantExternalOffice" tabindex="-1" data-bs-backdrop="static" role="dialog" aria-labelledby="exampleEditModal" aria-hidden="true" aria-modal="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div id="load-add-informant-external-office" style="display: none;">
                <div class="modal-body">
                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                    loading......
                </div>
            </div>
            <div class="add-informant-external-office" id="add-informant-external-office"></div>
        </div>
    </div>
</div>
<div class="modal fade" id="addInformantInternalOffice" tabindex="-1" data-bs-backdrop="static" role="dialog" aria-labelledby="exampleEditModal" aria-hidden="true" aria-modal="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div id="load-add-informant-internal-office" style="display: none;">
                <div class="modal-body">
                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                    loading......
                </div>
            </div>
            <div class="add-informant-internal-office" id="add-informant-internal-office"></div>
        </div>
    </div>
</div>
<div class="modal fade" id="editInformantExternalOffice" tabindex="-1" data-bs-backdrop="static" role="dialog" aria-labelledby="exampleEditModal" aria-hidden="true" aria-modal="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div id="load-edit-informant-external-office" style="display: none;">
                <div class="modal-body">
                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                    loading......
                </div>
            </div>
            <div class="edit-informant-external-office" id="edit-informant-external-office"></div>
        </div>
    </div>
</div>
<div class="modal fade" id="delInformantOffice" tabindex="-1" data-bs-backdrop="static" role="dialog" aria-labelledby="exampleEditModal" aria-hidden="true" aria-modal="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div id="load-del-informant-office" style="display: none;">
                <div class="modal-body">
                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                    loading......
                </div>
            </div>
            <div class="del-informant-office" id="del-informant-office"></div>
        </div>
    </div>
</div>
<div class="modal fade" id="inputTransportInformantOffice" tabindex="-1" data-bs-backdrop="static" role="dialog" aria-labelledby="exampleEditModal" aria-hidden="true" aria-modal="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div id="load-input-transport-informant-office" style="display: none;">
                <div class="modal-body">
                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                    loading......
                </div>
            </div>
            <div class="input-transport-informant-office" id="input-transport-informant-office"></div>
        </div>
    </div>
</div>
<div class="modal fade" id="addCommitteeExternalOffice" tabindex="-1" data-bs-backdrop="static" role="dialog" aria-labelledby="exampleEditModal" aria-hidden="true" aria-modal="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div id="load-add-committee-external-office" style="display: none;">
                <div class="modal-body">
                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                    loading......
                </div>
            </div>
            <div class="add-committee-external-office" id="add-committee-external-office"></div>
        </div>
    </div>
</div>
<div class="modal fade" id="addCommitteeInternalOffice" tabindex="-1" data-bs-backdrop="static" role="dialog" aria-labelledby="exampleEditModal" aria-hidden="true" aria-modal="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div id="load-add-committee-internal-office" style="display: none;">
                <div class="modal-body">
                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                    loading......
                </div>
            </div>
            <div class="add-committee-internal-office" id="add-committee-internal-office"></div>
        </div>
    </div>
</div>
<div class="modal fade" id="editCommitteeExternalOffice" tabindex="-1" data-bs-backdrop="static" role="dialog" aria-labelledby="exampleEditModal" aria-hidden="true" aria-modal="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div id="load-edit-committee-external-office" style="display: none;">
                <div class="modal-body">
                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                    loading......
                </div>
            </div>
            <div class="edit-committee-external-office" id="edit-committee-external-office"></div>
        </div>
    </div>
</div>
<div class="modal fade" id="delCommitteeOffice" tabindex="-1" data-bs-backdrop="static" role="dialog" aria-labelledby="exampleEditModal" aria-hidden="true" aria-modal="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div id="load-del-committee-office" style="display: none;">
                <div class="modal-body">
                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                    loading......
                </div>
            </div>
            <div class="del-committee-office" id="del-committee-office"></div>
        </div>
    </div>
</div>
<div class="modal fade" id="attendanceCommitteeOffice" tabindex="-1" data-bs-backdrop="static" role="dialog" aria-labelledby="exampleEditModal" aria-hidden="true" aria-modal="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div id="load-attendance-committee-office" style="display: none;">
                <div class="modal-body">
                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                    loading......
                </div>
            </div>
            <div class="attendance-committee-office" id="attendance-committee-office"></div>
        </div>
    </div>
</div>