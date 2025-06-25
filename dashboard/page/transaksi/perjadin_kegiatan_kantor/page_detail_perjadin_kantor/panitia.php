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
        <a href="checkDocumentOffice?_token=<?= encrypt($id_keg) ?>&_type=narsum" class="nav-link border border-primary">
            <i class="tf-icons bx bx-home"></i> Data Narsum
        </a>
    </li>
    <li class="nav-item ms-2 me-2 mb-2">
        <a href="checkDocumentOffice?_token=<?= encrypt($id_keg) ?>&_type=panitia" class="nav-link active border border-primary">
            <i class="tf-icons bx bx-home"></i> Data Panitia
        </a>
    </li>
</ul>
<div class="card border border-primary">
    <div class="card-body">
        <div class="float-end">
            <div class="btn-group">
                <button type="button" class="btn btn-success dropdown-toggle overflow-hidden d-sm-inline-flex d-block text-truncate waves-effect waves-light" data-bs-toggle="dropdown" title="Klik untuk menu Manajemen Peserta" data-bs-display="static" aria-haspopup="true" aria-expanded="false">
                    Manajemen Panitia
                </button>
                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-lg-end">
                    <li>
                        <button type="button" class="dropdown-item d-flex align-items-center waves-effect" title="Tambah Panitia dari unsur Internal" data-bs-toggle="modal" data-bs-target="#addCommitteeInternalOffice" data-id="<?= encrypt($id_keg) ?>"><i class="mdi mdi-account-multiple-plus text-success"></i>&nbsp;Panitia Internal</button>
                    </li>
                    <li>
                        <button type="button" class="dropdown-item d-flex align-items-center waves-effect" title="Tambah Panitia dari unsur Eksternal" data-bs-toggle="modal" data-bs-target="#addCommitteeExternalOffice" data-id="<?= encrypt($id_keg) ?>"><i class="mdi mdi-account-multiple-plus text-success"></i>&nbsp;Panitia Eksternal</button>
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
                        <th class="text-center text-nowrap align-middle">Nama Panitia</th>
                        <th class="text-center text-nowrap align-middle">Uang<br>Transport</th>
                        <th class="text-center text-nowrap align-middle">Uang<br>Harian</th>
                        <th class="text-center text-nowrap align-middle">Honor</th>
                        <th class="text-center text-nowrap align-middle">Total</th>
                        <th class="text-center text-nowrap align-middle">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    $sqlPanitia =  mysqli_query($myConnection, "select tb_panitia_keg_kantor.*, tb_pegawai.nama_peg as nama_peg, tb_jabatan_kegiatan.nama_jabatan
                  from tb_panitia_keg_kantor
                  left join tb_kegiatan on tb_kegiatan.id_keg = tb_panitia_keg_kantor.id_keg
                  left join tb_pegawai on tb_pegawai.id_peg = tb_panitia_keg_kantor.id_peg
                  left join tb_gol_pajak on tb_gol_pajak.id_pangkat = tb_pegawai.id_pangkat
                  left join tb_jabatan_kegiatan on tb_jabatan_kegiatan.kd_jabatan = tb_panitia_keg_kantor.id_jab_st
                  where tb_panitia_keg_kantor.id_keg = '$id_keg' 
                  order by tb_jabatan_kegiatan.kd_jabatan asc");
                    while ($viewPanitia = mysqli_fetch_array($sqlPanitia)) {
                        $id_peg = $viewPanitia['id_peg'];

                        $golPajak = $viewPanitia['id_pangkat_gol'];
                        $totalTransport = $viewPanitia['bbm'] + $viewPanitia['tiket_pesawat'] + $viewPanitia['tiket_kapal'] + $viewPanitia['tiket'] + $viewPanitia['lokal'] + $viewPanitia['taksi'] + $viewPanitia['toll'] + $viewPanitia['dpr1'] + $viewPanitia['dpr2'];
                        $jmlHari = (IntervalDays($viewPanitia['tgl_mulai'], $viewPanitia['tgl_selesai'])) + 1;
                        $idKabKota = $viewPanitia['id_kabkota_unit_kerja'];
                        $viewSBM = mysqli_fetch_array(mysqli_query($myConnection, "select id, besaran from tb_kabkota where id = '$idKabKota'"));
                        $sbm =  $viewSBM['id'] == 3578 ? $viewSBM['besaran'] : $viewSBM['besaran'] * 2;
                        $uangHarianPanitia = $viewPerjadin['uh_panitia'] == '' ? '0' : $viewPerjadin['uh_panitia'] * $jmlHari;

                        if ($viewPanitia['id_jab_st'] == '1') {
                            $uangHonorPanitia = $viewPerjadin['honor_penanggungjawab'] == '' ? '0' : $viewPerjadin['honor_penanggungjawab'] * $viewPanitia['jml_jam'];
                        } elseif ($viewPanitia['id_jab_st'] == '3') {
                            $uangHonorPanitia = $viewPerjadin['honor_ketua'] == '' ? '0' : $viewPerjadin['honor_ketua'] * $viewPanitia['jml_jam'];
                        } elseif ($viewPanitia['id_jab_st'] == '12') {
                            $uangHonorPanitia = $viewPerjadin['honor_anggota'] == '' ? '0' : $viewPerjadin['honor_anggota'] * $viewPanitia['jml_jam'];
                        } else {
                            $uangHonorPanitia = 0;
                        }
                        $pajak = mysqli_fetch_array(mysqli_query($myConnection, "select pajak from tb_gol_pajak where id_pangkat = '$golPajak'"));
                        $potonganHonor = ($uangHonorPanitia) * ($pajak['pajak'] / 100);
                        $uangHonorPanitiaPotongan = $uangHonorPanitia - $potonganHonor;

                        $uangHarianPanitia = $viewPerjadin['uh_panitia'] == '' ? '0' : $viewPerjadin['uh_panitia'] * $jmlHari;

                        if ($totalTransport > $sbm) {
                            $transportPanitia = $sbm;
                            $class = 'fw-bold text-danger';
                            $titleTransport = 'Total Transport Riil : ' . format_angka($totalTransport);
                        } else {
                            $transportPanitia = $totalTransport;
                            $class = '';
                            $titleTransport = '';
                        }

                        if ($viewPanitia['jenis_panitia'] == 'internal') {
                            $transportPanitia = 0;
                            $uangHarianPanitia = 0;
                        } else {
                            $transportPanitia = $transportPanitia;
                            $uangHarianPanitia = 0;
                        }



                    ?>
                        <tr>
                            <td class="text-center"><?= $no++ ?></td>
                            <td class="text-nowrap"><?= $jmlHari ?> Hari</td>
                            <td><?= $viewPanitia['nama'] . '<br>NIP. ' . $viewPanitia['nip'] . '<br>' . $viewPanitia['pangkat'] . ' - ' . $viewPanitia['gol']  . '<br><strong>' . $viewPanitia['nama_jabatan'] . '</strong>' ?></td>
                            <td class="text-center"><?= $transportPanitia == '' ? '0' : format_angka($transportPanitia) ?></td>
                            <td class="text-center"><?= $uangHarianPanitia == '' ? '0' : format_angka($uangHarianPanitia) ?></td>
                            <td class="text-center"><?= $uangHonorPanitiaPotongan == '' ? '0' : format_angka($uangHonorPanitiaPotongan) ?></td>
                            <td class="text-center"><?= format_angka($transportPanitia + $uangHarianPanitia + $uangHonorPanitiaPotongan) ?></td>
                            <td class="text-center text-nowrap">
                                <?php if ($viewPanitia['jenis_panitia'] == 'eksternal') { ?>
                                    <button class="btn btn-icon btn-sm btn-info waves-effect me-1 mb-1" title="Edit Data Panitia Eksternal" type="button" data-bs-toggle="modal" data-bs-target="#editCommitteeExternalOffice" data-id="<?= encrypt($viewPanitia['id_panitia_keg_kantor']) ?>" data-token="<?= encrypt($id_keg) ?>"><span class="tf-icons mdi mdi-file-edit-outline"></span></button>
                                <?php } ?>
                                <button class="btn btn-icon btn-sm btn-primary waves-effect me-1 mb-1" title="Edit Kehadiran Panitia" type="button" data-bs-toggle="modal" data-bs-target="#attendanceCommitteeOffice" data-id="<?= encrypt($viewPanitia['id_panitia_keg_kantor']) ?>" data-token="<?= encrypt($id_keg) ?>"><span class="tf-icons mdi mdi-forum-outline"></span></button>
                                <button class="btn btn-icon btn-sm btn-danger waves-effect me-1 mb-1" title="Hapus Panitia" type="button" data-bs-toggle="modal" data-bs-target="#delCommitteeOffice" data-id="<?= encrypt($viewPanitia['id_panitia_keg_kantor']) ?>" data-token="<?= encrypt($id_keg) ?>"><span class="tf-icons mdi mdi-delete"></span></button>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
            <?= "Process took " . number_format(microtime(true) - $time_start, 2) . " seconds."; ?>
        </div>
    </div>
</div>