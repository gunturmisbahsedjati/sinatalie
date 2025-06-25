<div class="offcanvas offcanvas-end" data-bs-backdrop="static" tabindex="-1" id="printSPJ" aria-labelledby="staticBackdropLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="staticBackdropLabel"><i class='tf-icons mdi mdi-printer-outline mb-1'></i> Cetak SPJ Hotel</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <div>
            <div class="divider divider-success">
                <div class="divider-text text-success fw-bold">Ekspor Excel</div>
            </div>
            <a href="dashboard/page/cetak/cetak-excel-master-spj?_token=<?= encrypt($id_keg) ?>" class="mt-2 me-2 btn btn-success2 d-grid w-100 waves-effect waves-light" title="Ekspor Excel Master SPJ dan Master Pecahan Uang">Master SPJ</a>
            <!-- <a href="dashboard/page/cetak/cetak-excel-nom-transport?_token=<?= encrypt($id_keg) ?>" class="mt-2 me-2 btn btn-success2 d-grid w-100 waves-effect waves-light" title="Ekspor Excel NOM Transport dan SPTJB Transport">NOM Transport</a>
            <a href="dashboard/page/cetak/cetak-excel-nom-honor?_token=<?= encrypt($id_keg) ?>" class="mt-2 me-2 btn btn-success2 d-grid w-100 waves-effect waves-light" title="Ekspor Excel NOM Honor dan SPTJB Honor">NOM Honor</a> -->

            <div class="divider divider-danger">
                <div class="divider-text text-danger fw-bold">Ekspor PDF</div>
            </div>
            <div class="divider text-start">
                <div class="divider-text">Pengarah</div>
            </div>
            <div class="row">
                <div class="col-md-6 col-12">
                    <a href="javascript:void(0)" onclick="popupCenter('dashboard/page/cetak/cetak-kuitansi-pengarah?_token=<?= encrypt($id_keg) ?>','pop',900,600) ;" class="mt-2 me-2 btn btn-danger d-grid w-100 waves-effect waves-light" title="Ekspor PDF Kuitansi Perjadin">Kuitansi</a>
                </div>
                <div class="col-md-6 col-12">
                    <a href="javascript:void(0)" onclick="popupCenter('dashboard/page/cetak/cetak-amplop-pengarah?_token=<?= encrypt($id_keg) ?>','pop',900,600) ;" class="mt-2 me-2 btn btn-danger d-grid w-100 waves-effect waves-light" title="Ekspor PDF Amplop Perjadin">Amplop</a>
                </div>
            </div>
            <div class="divider text-start">
                <div class="divider-text">Narasumber</div>
            </div>
            <div class="row">
                <div class="col-md-6 col-12">
                    <a href="javascript:void(0)" onclick="popupCenter('dashboard/page/cetak/cetak-kuitansi-narsum?_token=<?= encrypt($id_keg) ?>','pop',900,600) ;" class="mt-2 me-2 btn btn-danger d-grid w-100 waves-effect waves-light" title="Ekspor PDF Kuitansi Perjadin">Kuitansi</a>
                </div>
                <div class="col-md-6 col-12">
                    <a href="javascript:void(0)" onclick="popupCenter('dashboard/page/cetak/cetak-amplop-narsum?_token=<?= encrypt($id_keg) ?>','pop',900,600) ;" class="mt-2 me-2 btn btn-danger d-grid w-100 waves-effect waves-light" title="Ekspor PDF Amplop Perjadin">Amplop</a>
                </div>
            </div>
            <div class="divider text-start">
                <div class="divider-text">Panitia</div>
            </div>
            <div class="row">
                <div class="col-md-6 col-12">
                    <a href="javascript:void(0)" onclick="popupCenter('dashboard/page/cetak/cetak-kuitansi-panitia?_token=<?= encrypt($id_keg) ?>','pop',900,600) ;" class="mt-2 me-2 btn btn-danger d-grid w-100 waves-effect waves-light" title="Ekspor PDF Kuitansi Perjadin">Kuitansi</a>
                </div>
                <div class="col-md-6 col-12">
                    <a href="javascript:void(0)" onclick="popupCenter('dashboard/page/cetak/cetak-amplop-panitia?_token=<?= encrypt($id_keg) ?>','pop',900,600) ;" class="mt-2 me-2 btn btn-danger d-grid w-100 waves-effect waves-light" title="Ekspor PDF Amplop Perjadin">Amplop</a>
                </div>
            </div>
            <div class="divider text-start">
                <div class="divider-text">Peserta</div>
            </div>
            <div class="row">
                <div class="col-md-6 col-12">
                    <a href="javascript:void(0)" onclick="popupCenter('dashboard/page/cetak/cetak-kuitansi-peserta?_token=<?= encrypt($id_keg) ?>','pop',900,600) ;" class="mt-2 me-2 btn btn-danger d-grid w-100 waves-effect waves-light" title="Ekspor PDF Kuitansi Perjadin">Kuitansi</a>
                </div>
                <div class="col-md-6 col-12">
                    <a href="javascript:void(0)" onclick="popupCenter('dashboard/page/cetak/cetak-amplop-peserta?_token=<?= encrypt($id_keg) ?>','pop',900,600) ;" class="mt-2 me-2 btn btn-danger d-grid w-100 waves-effect waves-light" title="Ekspor PDF Amplop Perjadin">Amplop</a>
                </div>
            </div>

        </div>
    </div>
</div>
<div class="modal fade" id="setReceiptHotel" tabindex="-1" data-bs-backdrop="static" role="dialog" aria-labelledby="exampleEditModal" aria-hidden="true" aria-modal="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div id="load-set-receipt-hotel" style="display: none;">
                <div class="modal-body">
                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                    loading......
                </div>
            </div>
            <div class="set-receipt-hotel" id="set-receipt-hotel"></div>
        </div>
    </div>
</div>
<div class="modal fade" id="setFinancialReceiptHotel" tabindex="-1" data-bs-backdrop="static" role="dialog" aria-labelledby="exampleEditModal" aria-hidden="true" aria-modal="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div id="load-set-financial-receipt-hotel" style="display: none;">
                <div class="modal-body">
                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                    loading......
                </div>
            </div>
            <div class="set-financial-receipt-hotel" id="set-financial-receipt-hotel"></div>
        </div>
    </div>
</div>
<div class="modal fade" id="delOfficer" tabindex="-1" data-bs-backdrop="static" role="dialog" aria-labelledby="exampleEditModal" aria-hidden="true" aria-modal="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div id="load-del-officer" style="display: none;">
                <div class="modal-body">
                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                    loading......
                </div>
            </div>
            <div class="del-officer" id="del-officer"></div>
        </div>
    </div>
</div>
<div class="modal fade" id="addOfficer" tabindex="-1" data-bs-backdrop="static" role="dialog" aria-labelledby="exampleEditModal" aria-hidden="true" aria-modal="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div id="load-add-officer" style="display: none;">
                <div class="modal-body">
                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                    loading......
                </div>
            </div>
            <div class="add-officer" id="add-officer"></div>
        </div>
    </div>
</div>
<div class="modal fade" id="addFinancialOfficer" tabindex="-1" data-bs-backdrop="static" role="dialog" aria-labelledby="exampleEditModal" aria-hidden="true" aria-modal="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div id="load-add-financial-officer" style="display: none;">
                <div class="modal-body">
                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                    loading......
                </div>
            </div>
            <div class="add-financial-officer" id="add-financial-officer"></div>
        </div>
    </div>
</div>
<div class="modal fade" id="syncData" tabindex="-1" data-bs-backdrop="static" role="dialog" aria-labelledby="exampleEditModal" aria-hidden="true" aria-modal="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div id="load-sync-data" style="display: none;">
                <div class="modal-body">
                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                    loading......
                </div>
            </div>
            <div class="sync-data" id="sync-data"></div>
        </div>
    </div>
</div>
<div class="modal fade" id="importParticipant" tabindex="-1" data-bs-backdrop="static" role="dialog" aria-labelledby="exampleEditModal" aria-hidden="true" aria-modal="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div id="load-import-participant" style="display: none;">
                <div class="modal-body">
                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                    loading......
                </div>
            </div>
            <div class="import-participant" id="import-participant"></div>
        </div>
    </div>
</div>
<div class="modal fade" id="delAllParticipant" tabindex="-1" data-bs-backdrop="static" role="dialog" aria-labelledby="exampleEditModal" aria-hidden="true" aria-modal="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div id="load-del-all-participant" style="display: none;">
                <div class="modal-body">
                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                    loading......
                </div>
            </div>
            <div class="del-all-participant" id="del-all-participant"></div>
        </div>
    </div>
</div>
<div class="modal fade" id="delParticipant" tabindex="-1" data-bs-backdrop="static" role="dialog" aria-labelledby="exampleEditModal" aria-hidden="true" aria-modal="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div id="load-del-participant" style="display: none;">
                <div class="modal-body">
                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                    loading......
                </div>
            </div>
            <div class="del-participant" id="del-participant"></div>
        </div>
    </div>
</div>
<div class="modal fade" id="inputTransportParticipant" tabindex="-1" data-bs-backdrop="static" role="dialog" aria-labelledby="exampleEditModal" aria-hidden="true" aria-modal="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div id="load-input-transport-participant" style="display: none;">
                <div class="modal-body">
                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                    loading......
                </div>
            </div>
            <div class="input-transport-participant" id="input-transport-participant"></div>
        </div>
    </div>
</div>
<div class="modal fade" id="takeDailyCosts" tabindex="-1" data-bs-backdrop="static" role="dialog" aria-labelledby="exampleEditModal" aria-hidden="true" aria-modal="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div id="load-take-daily-costs" style="display: none;">
                <div class="modal-body">
                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                    loading......
                </div>
            </div>
            <div class="take-daily-costs" id="take-daily-costs"></div>
        </div>
    </div>
</div>
<div class="modal fade" id="inputTransportAllParticipant" tabindex="-1" data-bs-backdrop="static" role="dialog" aria-labelledby="exampleEditModal" aria-hidden="true" aria-modal="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div id="load-input-transport-all-participant" style="display: none;">
                <div class="modal-body">
                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                    loading......
                </div>
            </div>
            <div class="input-transport-all-participant" id="input-transport-all-participant"></div>
        </div>
    </div>
</div>
<div class="modal fade" id="addFinanceUsers" tabindex="-1" data-bs-backdrop="static" role="dialog" aria-labelledby="exampleEditModal" aria-hidden="true" aria-modal="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div id="load-add-finance-users" style="display: none;">
                <div class="modal-body">
                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                    loading......
                </div>
            </div>
            <div class="add-finance-users" id="add-finance-users"></div>
        </div>
    </div>
</div>
<div class="modal fade" id="addDirectorExternal" tabindex="-1" data-bs-backdrop="static" role="dialog" aria-labelledby="exampleEditModal" aria-hidden="true" aria-modal="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div id="load-add-director-external" style="display: none;">
                <div class="modal-body">
                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                    loading......
                </div>
            </div>
            <div class="add-director-external" id="add-director-external"></div>
        </div>
    </div>
</div>
<div class="modal fade" id="addDirectorInternal" tabindex="-1" data-bs-backdrop="static" role="dialog" aria-labelledby="exampleEditModal" aria-hidden="true" aria-modal="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div id="load-add-director-internal" style="display: none;">
                <div class="modal-body">
                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                    loading......
                </div>
            </div>
            <div class="add-director-internal" id="add-director-internal"></div>
        </div>
    </div>
</div>
<div class="modal fade" id="editDirectorExternal" tabindex="-1" data-bs-backdrop="static" role="dialog" aria-labelledby="exampleEditModal" aria-hidden="true" aria-modal="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div id="load-edit-director-external" style="display: none;">
                <div class="modal-body">
                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                    loading......
                </div>
            </div>
            <div class="edit-director-external" id="edit-director-external"></div>
        </div>
    </div>
</div>
<div class="modal fade" id="delDirector" tabindex="-1" data-bs-backdrop="static" role="dialog" aria-labelledby="exampleEditModal" aria-hidden="true" aria-modal="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div id="load-del-director" style="display: none;">
                <div class="modal-body">
                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                    loading......
                </div>
            </div>
            <div class="del-director" id="del-director"></div>
        </div>
    </div>
</div>
<div class="modal fade" id="inputTransportDirector" tabindex="-1" data-bs-backdrop="static" role="dialog" aria-labelledby="exampleEditModal" aria-hidden="true" aria-modal="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div id="load-input-transport-director" style="display: none;">
                <div class="modal-body">
                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                    loading......
                </div>
            </div>
            <div class="input-transport-director" id="input-transport-director"></div>
        </div>
    </div>
</div>
<div class="modal fade" id="addInformantExternal" tabindex="-1" data-bs-backdrop="static" role="dialog" aria-labelledby="exampleEditModal" aria-hidden="true" aria-modal="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div id="load-add-informant-external" style="display: none;">
                <div class="modal-body">
                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                    loading......
                </div>
            </div>
            <div class="add-informant-external" id="add-informant-external"></div>
        </div>
    </div>
</div>
<div class="modal fade" id="addInformantInternal" tabindex="-1" data-bs-backdrop="static" role="dialog" aria-labelledby="exampleEditModal" aria-hidden="true" aria-modal="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div id="load-add-informant-internal" style="display: none;">
                <div class="modal-body">
                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                    loading......
                </div>
            </div>
            <div class="add-informant-internal" id="add-informant-internal"></div>
        </div>
    </div>
</div>
<div class="modal fade" id="editInformantExternal" tabindex="-1" data-bs-backdrop="static" role="dialog" aria-labelledby="exampleEditModal" aria-hidden="true" aria-modal="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div id="load-edit-informant-external" style="display: none;">
                <div class="modal-body">
                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                    loading......
                </div>
            </div>
            <div class="edit-informant-external" id="edit-informant-external"></div>
        </div>
    </div>
</div>
<div class="modal fade" id="delInformant" tabindex="-1" data-bs-backdrop="static" role="dialog" aria-labelledby="exampleEditModal" aria-hidden="true" aria-modal="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div id="load-del-informant" style="display: none;">
                <div class="modal-body">
                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                    loading......
                </div>
            </div>
            <div class="del-informant" id="del-informant"></div>
        </div>
    </div>
</div>
<div class="modal fade" id="inputTransportInformant" tabindex="-1" data-bs-backdrop="static" role="dialog" aria-labelledby="exampleEditModal" aria-hidden="true" aria-modal="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div id="load-input-transport-informant" style="display: none;">
                <div class="modal-body">
                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                    loading......
                </div>
            </div>
            <div class="input-transport-informant" id="input-transport-informant"></div>
        </div>
    </div>
</div>
<div class="modal fade" id="addCommitteeExternal" tabindex="-1" data-bs-backdrop="static" role="dialog" aria-labelledby="exampleEditModal" aria-hidden="true" aria-modal="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div id="load-add-committee-external" style="display: none;">
                <div class="modal-body">
                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                    loading......
                </div>
            </div>
            <div class="add-committee-external" id="add-committee-external"></div>
        </div>
    </div>
</div>
<div class="modal fade" id="addCommitteeInternal" tabindex="-1" data-bs-backdrop="static" role="dialog" aria-labelledby="exampleEditModal" aria-hidden="true" aria-modal="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div id="load-add-committee-internal" style="display: none;">
                <div class="modal-body">
                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                    loading......
                </div>
            </div>
            <div class="add-committee-internal" id="add-committee-internal"></div>
        </div>
    </div>
</div>
<div class="modal fade" id="editCommitteeExternal" tabindex="-1" data-bs-backdrop="static" role="dialog" aria-labelledby="exampleEditModal" aria-hidden="true" aria-modal="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div id="load-edit-committee-external" style="display: none;">
                <div class="modal-body">
                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                    loading......
                </div>
            </div>
            <div class="edit-committee-external" id="edit-committee-external"></div>
        </div>
    </div>
</div>
<div class="modal fade" id="delCommittee" tabindex="-1" data-bs-backdrop="static" role="dialog" aria-labelledby="exampleEditModal" aria-hidden="true" aria-modal="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div id="load-del-committee" style="display: none;">
                <div class="modal-body">
                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                    loading......
                </div>
            </div>
            <div class="del-committee" id="del-committee"></div>
        </div>
    </div>
</div>
<div class="modal fade" id="attendanceCommittee" tabindex="-1" data-bs-backdrop="static" role="dialog" aria-labelledby="exampleEditModal" aria-hidden="true" aria-modal="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div id="load-attendance-committee" style="display: none;">
                <div class="modal-body">
                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                    loading......
                </div>
            </div>
            <div class="attendance-committee" id="attendance-committee"></div>
        </div>
    </div>
</div>