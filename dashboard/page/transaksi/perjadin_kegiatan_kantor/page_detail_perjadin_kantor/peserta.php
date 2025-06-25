<ul class="nav nav-pills mb-3 nav-fill" role="tablist">
    <li class="nav-item ms-2 me-2 mb-2">
        <a href="checkDocumentOffice?_token=<?= encrypt($id_keg) ?>&_type=peserta" class="nav-link active border border-primary">
            <i class="tf-icons bx bx-home"></i> Data Peserta
        </a>
    </li>
    <li class="nav-item ms-2 me-2 mb-2">
        <a href="checkDocumentOffice?_token=<?= encrypt($id_keg) ?>&_type=pengarah" class="nav-link border border-primary">
            <i class="tf-icons bx bx-home"></i> Data Pengarah
        </a>
    </li>
    <li class="nav-item ms-2 me-2 mb-2">
        <a href="checkDocumentOffice?_token=<?= encrypt($id_keg) ?>&_type=narsum" class="nav-link border border-primary">
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
                    Manajemen Peserta
                </button>
                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-lg-end">
                    <li>
                        <button type="button" class="dropdown-item d-flex align-items-center waves-effect" title="Import Excel Data Peserta" data-bs-toggle="modal" data-bs-target="#importParticipantOffice" data-id="<?= encrypt($id_keg) ?>"><i class="mdi mdi-file-excel-outline text-success"></i>&nbsp;Import Excel Peserta</button>
                    </li>
                    <li>
                        <a href="formInputParticipantDocumentOffice?_token=<?= encrypt($id_keg) ?>" class="dropdown-item d-flex align-items-center waves-effect" title="Input Transport Peserta Kantor By Table"><i class="mdi mdi-table-account text-success"></i>&nbsp;Input Transport</a>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li>
                        <button type="button" class="dropdown-item d-flex align-items-center waves-effect" title="Hapus Semua Data Peserta" data-bs-toggle="modal" data-bs-target="#delAllParticipantOffice" data-id="<?= encrypt($id_keg) ?>"><i class="mdi mdi-delete text-danger"></i>&nbsp;Hapus Semua Peserta</button>
                    </li>
                </ul>
            </div>
        </div>
        <br>
        <div class="table-responsive mt-4">
            <table id="global_table" class="table table table-bordered table-hover">
                <thead>
                    <tr>
                        <th class="text-center text-nowrap align-middle">No</th>
                        <th class="text-center text-nowrap align-middle">Kehadiran</th>
                        <th class="text-center text-nowrap align-middle">Nama Peserta</th>
                        <th class="text-center text-nowrap align-middle">Unit Kerja</th>
                        <th class="text-center text-nowrap align-middle">Uang<br>Transport</th>
                        <th class="text-center text-nowrap align-middle">Uang<br>Harian</th>
                        <th class="text-center text-nowrap align-middle">Uang<br>Penginapan</th>
                        <th class="text-center text-nowrap align-middle">Total</th>
                        <th class="text-center text-nowrap align-middle">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    $sqlPeserta =  mysqli_query($myConnection, "select tb_peserta_keg_kantor.* , tb_kabkota.name as nama_kab
                    from tb_peserta_keg_kantor
                    left join tb_kabkota on tb_kabkota.id = tb_peserta_keg_kantor.id_kabkota_unit_kerja
                    where tb_peserta_keg_kantor.id_keg = '$id_keg' ");
                    while ($viewPeserta = mysqli_fetch_array($sqlPeserta)) {

                        $golPajakPeserta = $viewPeserta['id_pangkat_gol'];
                        $pajakPeserta = mysqli_fetch_array(mysqli_query($myConnection, "select gol, pajak from tb_gol_pajak where id_pangkat = '$golPajakPeserta'"));

                        $jmlHariPeserta = (IntervalDays($viewPeserta['tgl_mulai'], $viewPeserta['tgl_selesai'])) + 1;
                        $idKabKotaPeserta = $viewPeserta['id_kabkota_unit_kerja'];
                        $viewSBMPeserta = mysqli_fetch_array(mysqli_query($myConnection, "select id, besaran from tb_kabkota where id = '$idKabKotaPeserta'"));
                        $sbmPeserta = $viewSBMPeserta['id'] == 3578 ? $viewSBMPeserta['besaran'] : $viewSBMPeserta['besaran'] * 2;

                        //perhitungan sbm itu dari penambah dpr atau tidak ditambahi sbm ?
                        if ($viewPeserta['status_kabkota_unit_kerja'] == 'Daratan') {
                            $totalTransportPeserta = $viewPeserta['bbm'] + $viewPeserta['tiket_pesawat'] + $viewPeserta['tiket'] + $viewPeserta['tiket_kapal'] + $viewPeserta['lokal'] + $viewPeserta['taksi'] + $viewPeserta['toll'] + $viewPeserta['dpr1'] + $viewPeserta['dpr2'];
                            $uangHarianPeserta = $viewPerjadin['uh_peserta'] * $jmlHariPeserta;
                            $tiketKapal = 0;
                            $uangHarianPesertaHmin1 = 0;
                            $uangHarianPesertaHplus1 = 0;
                            $hotel = 0;
                        } else {
                            $totalTransportPeserta = $viewPeserta['bbm'] + $viewPeserta['tiket'] + $viewPeserta['lokal'] + $viewPeserta['taksi'] + $viewPeserta['toll'] + $viewPeserta['dpr1'] + $viewPeserta['dpr2'];
                            $tiketKapal = $viewPeserta['tiket_kapal'];
                            $uangHarianPeserta = $viewPerjadin['uh_peserta'] * $jmlHariPeserta;
                            $uangHarianPesertaHmin1 = $viewPerjadin['uh_peserta'];
                            $uangHarianPesertaHplus1 = $viewPerjadin['uh_peserta'];
                            $hotel = $viewPeserta['penginapan'];
                        }

                        if ($totalTransportPeserta > $sbmPeserta) {
                            $transportPeserta = $sbmPeserta;
                            $class = 'fw-bold text-danger';
                            $titleTransport = 'Total Transport Riil : ' . format_angka($totalTransportPeserta);
                        } else {
                            $transportPeserta = $totalTransportPeserta;
                            $class = '';
                            $titleTransport = '';
                        }
                        $jmlPerjadinPeserta = $transportPeserta + $tiketKapal + $uangHarianPeserta + $uangHarianPesertaHmin1 + $uangHarianPesertaHplus1 + $hotel;
                        $TotalPeserta = $transportPeserta + $tiketKapal + $uangHarianPeserta + $uangHarianPesertaHmin1 + $uangHarianPesertaHplus1 + $hotel;

                        if ($viewPeserta['status_kabkota_unit_kerja'] == 'Daratan') {
                            $rincianPernyataan = 'Kwitansi transport darat (tiket bus, tiket kereta, transport online, tol, BBM dan lain-lain)';
                        } else {
                            $rincianPernyataan = 'Kwitansi transport (tiket kapal, tiket travel, tiket bus, tiket kereta, transport online, tol, BBM dan lain-lain)';
                        }

                        $totalUangHarian = $uangHarianPeserta + $uangHarianPesertaHmin1 + $uangHarianPesertaHplus1;

                        if ($viewPeserta['jenis_peserta'] == 'internal') {
                            $transportPeserta = 0;
                            $totalUangHarian = 0;
                            $jmlPerjadinPeserta = 0;
                        } else {
                            $transportPeserta = $transportPeserta;
                            $totalUangHarian = $totalUangHarian;
                            $jmlPerjadinPeserta = $jmlPerjadinPeserta;
                        }

                    ?>
                        <tr>
                            <td class="text-center"><?= $no++ ?></td>
                            <td><?= $jmlHariPeserta ?> Hari</td>
                            <td><?= $viewPeserta['nama'] ?></td>
                            <td><?= $viewPeserta['unit_kerja'] . '<br>' . str_replace(["Kabupaten ", "Kota "], ["Kab. ", "Kota "], ucwords($viewPeserta['nama_kab'])) . '<br> SBM: <strong>' . format_angka($sbmPeserta) . '</strong>' ?></td>
                            <td class="text-center <?= $class ?>" title="<?= $titleTransport ?>"><?= $transportPeserta == '' ? '0' : format_angka($transportPeserta) ?></td>
                            <td class="text-center"><?= $totalUangHarian == '' ? '0' : format_angka($totalUangHarian) ?></td>
                            <td class="text-center"><?= $hotel == '' ? '0' : format_angka($hotel) ?></td>
                            <td class="text-center"><?= format_angka($jmlPerjadinPeserta) ?></td>
                            <td class="text-center text-nowrap">
                                <?php
                                if ($viewPeserta['jenis_peserta'] == 'eksternal') {
                                    echo '<button class="btn btn-icon btn-sm btn-primary waves-effect me-1 mb-1" title="Edit SPJ Peserta" type="button" data-bs-toggle="modal" data-bs-target="#inputTransportParticipantOffice" data-id="' . encrypt($viewPeserta['id_peserta_keg_kantor']) . '" data-token="' . encrypt($id_keg) . '"><span class="tf-icons mdi mdi-cash"></span></button>';
                                }
                                ?>
                                <button class="btn btn-icon btn-sm btn-danger waves-effect me-1 mb-1" title="Hapus Peserta" type="button" data-bs-toggle="modal" data-bs-target="#delParticipantOffice" data-id="<?= encrypt($viewPeserta['id_peserta_keg_kantor']) ?>" data-token="<?= encrypt($id_keg) ?>"><span class="tf-icons mdi mdi-delete"></span></button>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
            <?= "Process took " . number_format(microtime(true) - $time_start, 2) . " seconds."; ?>
        </div>
    </div>
</div>