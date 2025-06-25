<ul class="nav nav-pills mb-3 nav-fill" role="tablist">
    <li class="nav-item ms-2 me-2 mb-2">
        <a href="checkDocumentHotel?_token=<?= encrypt($id_keg) ?>&_type=peserta" class="nav-link border border-primary">
            <i class="tf-icons bx bx-home"></i> Data Peserta
        </a>
    </li>
    <li class="nav-item ms-2 me-2 mb-2">
        <a href="checkDocumentHotel?_token=<?= encrypt($id_keg) ?>&_type=pengarah" class="nav-link active border border-primary">
            <i class="tf-icons bx bx-home"></i> Data Pengarah
        </a>
    </li>
    <li class="nav-item ms-2 me-2 mb-2">
        <a href="checkDocumentHotel?_token=<?= encrypt($id_keg) ?>&_type=narsum" class="nav-link border border-primary">
            <i class="tf-icons bx bx-home"></i> Data Narsum
        </a>
    </li>
    <li class="nav-item ms-2 me-2 mb-2">
        <a href="checkDocumentHotel?_token=<?= encrypt($id_keg) ?>&_type=panitia" class="nav-link border border-primary">
            <i class="tf-icons bx bx-home"></i> Data Panitia
        </a>
    </li>
</ul>
<div class="card border border-primary">
    <div class="card-body">
        <div class="float-end">
            <div class="btn-group">
                <button type="button" class="btn btn-success dropdown-toggle overflow-hidden d-sm-inline-flex d-block text-truncate waves-effect waves-light" data-bs-toggle="dropdown" title="Klik untuk menu Manajemen Peserta" data-bs-display="static" aria-haspopup="true" aria-expanded="false">
                    Manajemen Pengarah
                </button>
                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-lg-end">
                    <li>
                        <button type="button" class="dropdown-item d-flex align-items-center waves-effect" title="Tambah Pengarah dari unsur Internal" data-bs-toggle="modal" data-bs-target="#addDirectorInternal" data-id="<?= encrypt($id_keg) ?>"><i class="mdi mdi-account-multiple-plus text-success"></i>&nbsp;Pengarah Internal</button>
                    </li>
                    <li>
                        <button type="button" class="dropdown-item d-flex align-items-center waves-effect" title="Tambah Pengarah dari unsur Eksternal" data-bs-toggle="modal" data-bs-target="#addDirectorExternal" data-id="<?= encrypt($id_keg) ?>"><i class="mdi mdi-account-multiple-plus text-success"></i>&nbsp;Pengarah Eksternal</button>
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
                        <th class="text-center text-nowrap align-middle">Nama Pengarah</th>
                        <th class="text-center text-nowrap align-middle">Unit Kerja</th>
                        <th class="text-center text-nowrap align-middle">Uang<br>Transport</th>
                        <th class="text-center text-nowrap align-middle">Uang<br>Honor</th>
                        <th class="text-center text-nowrap align-middle">Total</th>
                        <th class="text-center text-nowrap align-middle">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    $sqlPengarah =  mysqli_query($myConnection, "select tb_pengarah_keg_hotel.* , tb_kabkota.name as nama_kab
                    from tb_pengarah_keg_hotel
                    left join tb_kabkota on tb_kabkota.id = tb_pengarah_keg_hotel.id_kabkota_unit_kerja
                    where tb_pengarah_keg_hotel.id_keg = '$id_keg' ");
                    while ($viewPengarah = mysqli_fetch_array($sqlPengarah)) {
                        $golPajak = $viewPengarah['id_pangkat_gol'];
                        $totalTransport = $viewPengarah['bbm'] + $viewPengarah['tiket_pesawat'] + $viewPengarah['tiket_kapal'] + $viewPengarah['tiket'] + $viewPengarah['lokal'] + $viewPengarah['taksi'] + $viewPengarah['toll'] + $viewPengarah['dpr1'] + $viewPengarah['dpr2'];
                        $jmlHari = (IntervalDays($viewPengarah['tgl_mulai'], $viewPengarah['tgl_selesai'])) + 1;
                        $idKabKota = $viewPengarah['id_kabkota_unit_kerja'];
                        $viewSBM = mysqli_fetch_array(mysqli_query($myConnection, "select id, besaran from tb_kabkota where id = '$idKabKota'"));
                        $sbm =  $viewSBM['id'] == 3578 ? $viewSBM['besaran'] : $viewSBM['besaran'] * 2;
                        // echo $sbm;
                        if ($viewPengarah['jenis_pengarah'] == 'internal') {
                            $uangHonorPengarah = 0;
                        } elseif ($viewPengarah['jenis_pengarah'] == 'eksternal') {
                            $uangHonorPengarah = $viewPerjadin['honor_pengarah_e'] == '' ? '0' : $viewPerjadin['honor_pengarah_e'] * $viewPengarah['jml_jam'];
                        } else {
                            $uangHonorPengarah = 0;
                        }
                        $pajak = mysqli_fetch_array(mysqli_query($myConnection, "select pajak from tb_gol_pajak where id_pangkat = '$golPajak'"));
                        $potonganHonor = ($uangHonorPengarah) * ($pajak['pajak'] / 100);
                        $uangHonorPengarahPotongan = $uangHonorPengarah - $potonganHonor;

                        if ($totalTransport > $sbm) {
                            $transportPengarah = $sbm;
                            $class = 'fw-bold text-danger';
                            $titleTransport = 'Total Transport Riil : ' . format_angka($totalTransport);
                        } else {
                            $transportPengarah = $totalTransport;
                            $class = '';
                            $titleTransport = '';
                        }
                    ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $jmlHari ?> Hari<br>JJM : <?= $viewPengarah['jml_jam'] ?> Jam</td>
                            <td><?= $viewPengarah['nama'] ?></td>
                            <td><?= $viewPengarah['unit_kerja'] . '<br>' . str_replace(["Kabupaten ", "Kota "], ["Kab. ", "Kota "], ucwords($viewPengarah['nama_kab'])) . '<br> SBM: <strong>' .  format_angka($sbm) . '</strong>' ?></td>
                            <td class="text-center <?= $class ?>" title="<?= $titleTransport ?>"><?= $transportPengarah == '' ? '0' : format_angka($transportPengarah) ?></td>
                            <td class="text-center"><?= $uangHonorPengarahPotongan == '' ? '0' : format_angka($uangHonorPengarahPotongan) ?></td>
                            <td class="text-center"><?= format_angka($transportPengarah + $uangHonorPengarahPotongan) ?></td>
                            <td class="text-center text-nowrap">
                                <?php if ($viewPengarah['jenis_pengarah'] == 'eksternal') { ?>
                                    <button class="btn btn-icon btn-sm btn-info waves-effect me-1 mb-1" title="Edit Data Narasumber Eksternal" type="button" data-bs-toggle="modal" data-bs-target="#editDirectorExternal" data-id="<?= encrypt($viewPengarah['id_pengarah_keg_hotel']) ?>" data-token="<?= encrypt($id_keg) ?>"><span class="tf-icons mdi mdi-file-edit-outline"></span></button>
                                    <button class="btn btn-icon btn-sm btn-primary waves-effect me-1 mb-1" title="Edit SPJ Narasumber" type="button" data-bs-toggle="modal" data-bs-target="#inputTransportDirector" data-id="<?= encrypt($viewPengarah['id_pengarah_keg_hotel']) ?>" data-token="<?= encrypt($id_keg) ?>"><span class="tf-icons mdi mdi-cash"></span></button>
                                <?php } ?>
                                <button class="btn btn-icon btn-sm btn-danger waves-effect me-1 mb-1" title="Hapus Pengarah" type="button" data-bs-toggle="modal" data-bs-target="#delDirector" data-id="<?= encrypt($viewPengarah['id_pengarah_keg_hotel']) ?>" data-token="<?= encrypt($id_keg) ?>"><span class="tf-icons mdi mdi-delete"></span></button>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
            <?= "Process took " . number_format(microtime(true) - $time_start, 2) . " seconds."; ?>
        </div>
    </div>
</div>