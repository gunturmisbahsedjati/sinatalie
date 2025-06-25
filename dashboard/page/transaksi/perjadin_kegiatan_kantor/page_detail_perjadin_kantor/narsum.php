<ul class="nav nav-pills mb-3 nav-fill" role="tablist">
    <li class="nav-item ms-2 me-2 mb-2">
        <a href="checkDocumentOffice?_token=<?= encrypt($id_keg) ?>&_type=peserta" class="nav-link border border-primary">
            <i class="tf-icons bx bx-home"></i> Data Peserta
        </a>
    </li>
    <li class="nav-item ms-2 me-2 mb-2">
        <a href="checkDocumentOffice?_token=<?= encrypt($id_keg) ?>&_type=pengarah" class="nav-link border border-primary">
            <i class="tf-icons bx bx-home"></i> Data Pengarah
        </a>
    </li>
    <li class="nav-item ms-2 me-2 mb-2">
        <a href="checkDocumentOffice?_token=<?= encrypt($id_keg) ?>&_type=narsum" class="nav-link active border border-primary">
            <i class="tf-icons bx bx-home"></i> Data Narsum
        </a>
    </li>
    <li class="nav-item ms-2 me-2 mb-2">
        <a href="checkDocumentOffice?_token=<?= encrypt($id_keg) ?>&_type=panitia" class="nav-link border border-primary">
            <i class="tf-icons bx bx-home"></i> Data Panitia
        </a>
    </li>
</ul>
<div class="card border border-primary">
    <div class="card-body">
        <div class="float-end">
            <div class="btn-group">
                <button type="button" class="btn btn-success dropdown-toggle overflow-hidden d-sm-inline-flex d-block text-truncate waves-effect waves-light" data-bs-toggle="dropdown" title="Klik untuk menu Manajemen Peserta" data-bs-display="static" aria-haspopup="true" aria-expanded="false">
                    Manajemen Narasumber
                </button>
                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-lg-end">
                    <li>
                        <button type="button" class="dropdown-item d-flex align-items-center waves-effect" title="Tambah Narasumber dari unsur Internal" data-bs-toggle="modal" data-bs-target="#addInformantInternalOffice" data-id="<?= encrypt($id_keg) ?>"><i class="mdi mdi-account-multiple-plus text-success"></i>&nbsp;Narasumber Internal</button>
                    </li>
                    <li>
                        <button type="button" class="dropdown-item d-flex align-items-center waves-effect" title="Tambah Narasumber dari unsur Eksternal" data-bs-toggle="modal" data-bs-target="#addInformantExternalOffice" data-id="<?= encrypt($id_keg) ?>"><i class="mdi mdi-account-multiple-plus text-success"></i>&nbsp;Narasumber Eksternal</button>
                    </li>
                </ul>
            </div>
        </div>
        <br>
        <div class="table-responsive  mt-4">
            <table id="global_table" class="table table table-bordered table-hover">
                <thead>
                    <tr>
                        <th class="text-center text-nowrap align-middle">No</th>
                        <th class="text-center text-nowrap align-middle">Kehadiran</th>
                        <th class="text-center text-nowrap align-middle">Nama Narsum</th>
                        <th class="text-center text-nowrap align-middle">Unit Kerja</th>
                        <th class="text-center text-nowrap align-middle">Uang<br>Transport</th>
                        <th class="text-center text-nowrap align-middle">Uang<br>Harian</th>
                        <th class="text-center text-nowrap align-middle">Honor</th>
                        <th class="text-center text-nowrap align-middle">Uang<br>Penginapan</th>
                        <th class="text-center text-nowrap align-middle">Total</th>
                        <th class="text-center text-nowrap align-middle">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    $sqlNarsum =  mysqli_query($myConnection, "select tb_narsum_keg_kantor.* , tb_kabkota.name as nama_kab
                    from tb_narsum_keg_kantor
                    left join tb_kabkota on tb_kabkota.id = tb_narsum_keg_kantor.id_kabkota_unit_kerja
                    where tb_narsum_keg_kantor.id_keg = '$id_keg' ");
                    while ($viewNarsum = mysqli_fetch_array($sqlNarsum)) {
                        $golPajak = $viewNarsum['id_pangkat_gol'];
                        $totalTransport = $viewNarsum['bbm'] + $viewNarsum['tiket_pesawat'] + $viewNarsum['tiket_kapal'] + $viewNarsum['tiket'] + $viewNarsum['lokal'] + $viewNarsum['lokal_jakarta'] + $viewNarsum['taksi'] + $viewNarsum['toll'] + $viewNarsum['dpr1'] + $viewNarsum['dpr2'];
                        $jmlHari = (IntervalDays($viewNarsum['tgl_mulai'], $viewNarsum['tgl_selesai'])) + 1;
                        $idKabKota = $viewNarsum['id_kabkota_unit_kerja'];
                        $viewSBM = mysqli_fetch_array(mysqli_query($myConnection, "select id, besaran from tb_kabkota where id = '$idKabKota'"));
                        $sbm =  $viewSBM['id'] == 3578 ? $viewSBM['besaran'] : $viewSBM['besaran'] * 2;
                        if ($viewNarsum['jenis_narsum'] == 'internal') {
                            $uangHarianNarsum = 0;
                            $uangHonorNarsum = 0;
                            $hotel = 0;
                            $statusKemdikbud = '';
                            $totalTransport = 0;
                        } elseif ($viewNarsum['jenis_narsum'] == 'eksternal') {
                            if ($viewNarsum['status_internal_kemdikbud'] == 1) {
                                $uangHarianNarsum = $viewPerjadin['uh_narsum_i_kemdikbud'] == '' ? '0' : $viewPerjadin['uh_narsum_i_kemdikbud'] * $jmlHari;
                                $uangHonorNarsum = 0;
                                $hotel = $viewNarsum['penginapan'] == '' ? 0 : $viewNarsum['penginapan'];
                                $statusKemdikbud = '<br><span class="text-danger fw-bold">Internal Kemdikbud</span>';
                                $totalTransport = $totalTransport;
                            } else {
                                $uangHarianNarsum = 0;
                                $uangHonorNarsum = $viewPerjadin['honor_narsum_e'] == '' ? '0' : $viewPerjadin['honor_narsum_e'] * $viewNarsum['jml_jam'];
                                $hotel = 0;
                                $statusKemdikbud = '';
                                $totalTransport = $totalTransport;
                            }
                        } else {
                            $totalTransport = 0;
                            $uangHarianNarsum = 0;
                            $uangHonorNarsum = 0;
                            $hotel = 0;
                            $statusKemdikbud = '';
                        }
                        $pajak = mysqli_fetch_array(mysqli_query($myConnection, "select pajak from tb_gol_pajak where id_pangkat = '$golPajak'"));
                        $potonganHonor = ($uangHonorNarsum) * ($pajak['pajak'] / 100);
                        $uangHonorNarsumPotongan = $uangHonorNarsum - $potonganHonor;

                        if ($totalTransport > $sbm) {
                            $transportNarsum = $sbm;
                            $class = 'fw-bold text-danger';
                            $titleTransport = 'Total Transport Riil : ' . format_angka($totalTransport);
                        } else {
                            $transportNarsum = $totalTransport;
                            $class = '';
                            $titleTransport = '';
                        }

                    ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td class="text-nowrap"><?= $jmlHari ?> Hari<br>JJM : <?= $viewNarsum['jml_jam'] ?> Jam</td>
                            <td><?= $viewNarsum['nama'] . '<br>NIP. ' . $viewNarsum['nip'] . '<br>' . $viewNarsum['pangkat'] . ' - ' . $viewNarsum['gol'] . ' ' . $statusKemdikbud ?></td>
                            <td><?= $viewNarsum['unit_kerja'] . '<br>' . str_replace(["Kabupaten ", "Kota "], ["Kab. ", "Kota "], ucwords($viewNarsum['nama_kab'])) . '<br> SBM: <strong>' .  format_angka($sbm) . '</strong>' ?></td>
                            <td class="text-center <?= $class ?>" title="<?= $titleTransport ?>"><?= $transportNarsum == '' ? '0' : format_angka($transportNarsum) ?></td>
                            <td class="text-center"><?= $uangHarianNarsum == '' ? '0' : format_angka($uangHarianNarsum) ?></td>
                            <td class="text-center"><?= $uangHonorNarsumPotongan == '' ? '0' : format_angka($uangHonorNarsumPotongan) ?></td>
                            <td class="text-center"><?= format_angka($hotel) ?></td>
                            <td class="text-center"><?= format_angka($totalTransport + $uangHarianNarsum + $uangHonorNarsumPotongan + $hotel) ?></td>
                            <td class="text-center text-nowrap">
                                <?php if ($viewNarsum['jenis_narsum'] == 'eksternal') { ?>
                                    <button class="btn btn-icon btn-sm btn-info waves-effect me-1 mb-1" title="Edit Data Narasumber Eksternal" type="button" data-bs-toggle="modal" data-bs-target="#editInformantExternalOffice" data-id="<?= encrypt($viewNarsum['id_narsum_keg_kantor']) ?>" data-token="<?= encrypt($id_keg) ?>"><span class="tf-icons mdi mdi-file-edit-outline"></span></button>
                                    <button class="btn btn-icon btn-sm btn-primary waves-effect me-1 mb-1" title="Edit SPJ Narasumber" type="button" data-bs-toggle="modal" data-bs-target="#inputTransportInformantOffice" data-id="<?= encrypt($viewNarsum['id_narsum_keg_kantor']) ?>" data-token="<?= encrypt($id_keg) ?>"><span class="tf-icons mdi mdi-cash"></span></button>
                                <?php } ?>
                                <button class="btn btn-icon btn-sm btn-danger waves-effect me-1 mb-1" title="Hapus Narasumber" type="button" data-bs-toggle="modal" data-bs-target="#delInformantOffice" data-id="<?= encrypt($viewNarsum['id_narsum_keg_kantor']) ?>" data-token="<?= encrypt($id_keg) ?>"><span class="tf-icons mdi mdi-delete"></span></button>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
            <?= "Process took " . number_format(microtime(true) - $time_start, 2) . " seconds."; ?>
        </div>
    </div>
</div>