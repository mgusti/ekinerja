<div class="container-fluid">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href=""><?= $title; ?></a></li>


        </ol>
    </nav>
    <div class="card mb-3">
        <div class="card-body text-danger">
            <form action="" method="get">
                <div class="row">
                    <div class="col-lg-4">
                        <label for="">Bulan</label>
                        <select name="bulan" id="bulan" class="form-control">
                            <option value="">-pilih-</option>
                            <?php
                            foreach ($bln as $b) :

                            ?>
                                <option value="<?= $b['kode_bulan'] ?>"><?= $b['nama_bulan'] ?></option>
                            <?php
                            endforeach;
                            ?>
                        </select>
                    </div>
                    <div class="col-lg-4">
                        <label for="">Tahun</label>
                        <input type="number" name="tahun" id="tahun" class="form-control" value="<?= date('Y') ?>">
                    </div>

                </div>
                <div class="row">
                    <div class="col-lg-4">
                        <label for="">NIK</label>
                        <input type="text" name="search" id="search" class="form-control" value="">
                    </div>

                </div>
                <button class="btn btn-danger mt-3"><i class="fa fa-search"></i></button>
            </form>
        </div>
    </div>
    <div class="card mb-3">
        <div class="card-header">
            <h3 class="card-title">Data Absen </h3>
        </div>
        <div class="card-body">
            <div class="flash-data" data-flashdata="<?= $this->session->flashdata('messege'); ?>"></div>
            <div class="eror" data-flashdata="<?= $this->session->flashdata('eror'); ?>"></div>
            <p>Jumlah Pegawai : <?= $peg ?></p>
            <p>Jumlah input : <?= $jabsen ?></p>


            <table class="table table-striped table-bordered table-responsive-md " id="e">
                <thead class="text-center">
                    <tr>
                        <th>No.</th>
                        <th>NIK</th>
                        <th>NIP</th>
                        <th>Status</th>
                        <th>Nama</th>
                        <th>Tgl Absen <span><small>(format tgl-bulan-tahun)</small></span></th>

                        <th>Shift Kerja</th>
                        <th>Keterangan</th>

                        <th>Verifikasi</th>
                        <th>hasil verifikasi</th>
                        <th>Update</th>

                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    foreach ($absen as $a) :
                        if ($a['peripikasi'] == 0) {
                            $pe = "Waiting Verified";
                            $warna = "warning";
                        } else if ($a['peripikasi'] == 1) {
                            $pe = "Verified";
                            $warna = "success";
                        } else {
                            $pe = "not Verified";
                            $warna = "danger";
                        }

                        if ($a['beda_pns'] == 1) {
                            $st = 'PNS';
                        } else if ($a['beda_pns'] == 2) {
                            $st = "TKK";
                        } else {
                            $st = "uknown";
                        }
                    ?>
                        <tr class="text-center">
                            <th><?= $i++ ?></th>
                            <th><?= $a['nik'] ?></th>
                            <th><?= $a['nip'] ?></th>
                            <th><?= $st ?></th>
                            <td><?= $a['nama'] ?></td>
                            <td><?= date('D, d-m-Y', strtotime($a['tgl_absen'])) ?></td>
                            <td><?= $a['nama_shift'] ?></td>
                            <td><?= $a['keterangan'] ?></td>
                            <td class="bg-<?= $warna ?> "><a href="<?= base_url('absensi/verifikasi/') . $itg . '/' . $a['kd_absen'] ?>" class="btn btn-sm text-white perip"><?= $pe ?></a></td>
                            <td><?= $a['hasil_perip'] ?></td>
                            <td><a href="#" class="btn btn-warning " data-toggle="modal" data-target="#eabsen<?= $a['kd_absen'] ?>" type="button"><i class="fa fa-edit"></i></a></td>
                        </tr>

                        <div class="modal fade" id="eabsen<?= $a['kd_absen'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Edit Absen</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <?php
                                        $this->db->select('*, ket_absen.keterangan as kt, absen.keterangan as kk');
                                        $this->db->from('absen');
                                        $this->db->join('shift', 'shift.kd_shift = absen.shift');
                                        $this->db->join('ket_absen', 'ket_absen.kd_ket_absen = absen.keterangan');

                                        $this->db->where('kd_absen', $a['kd_absen']);
                                        $abs = $this->db->get()->row_array();
                                        ?>
                                        <form action="<?= base_url('absensi/elaporanabsen/') . $a['kd_absen'] ?>" method="post">
                                            <div class="row " hidden>
                                                <div class="col-lg-6">
                                                    <label for="bulan">bulan</label>
                                                    <input type="text" name="bulan2" class="form-control" value="<?= $_GET['bulan'] ?>" readonly>
                                                </div>
                                                <div class="col-lg-6">
                                                    <label for="tahun">tahun</label>
                                                    <input type="text" name="tahun2" class="form-control" value="<?= $_GET['tahun'] ?>" readonly>
                                                </div>
                                                <div class="col-lg-6">
                                                    <label for="search">search</label>
                                                    <input type="text" name="search2" class="form-control" value="<?= $_GET['search'] ?>" readonly>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <label for="tgl">Tanggal Absen</label>
                                                    <input type="text" name="etgl" class="form-control" required value="<?= $abs['tgl_absen'] ?>" readonly>
                                                </div>
                                                <div class="col-lg-6">
                                                    <label for="shift">Shift</label>
                                                    <select name="eshift" class="form-control" required>
                                                        <option value="<?= $abs['kd_shift'] ?>"><?= $abs['nama_shift'] ?></option>
                                                        <?php
                                                        $this->db->select('*');
                                                        $this->db->from('shift');
                                                        $this->db->where_not_in('kd_shift', $a['kd_shift']);
                                                        $shift = $this->db->get()->result_array();
                                                        foreach ($shift as $s) :
                                                        ?>
                                                            <option value="<?= $s['kd_shift'] ?>"><?= $s['nama_shift'] ?></option>
                                                        <?php
                                                        endforeach;
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <label for="ket">Keterangan</label>
                                                    <select name="eket" class="form-control" required>
                                                        <option value="<?= $abs['kk'] ?>"><?= $abs['kt'] ?></option>
                                                        <?php
                                                        $this->db->select('*');
                                                        $this->db->from('ket_absen');
                                                        $this->db->where_not_in('kd_ket_absen', $abs['kk']);
                                                        $ket_absen = $this->db->get()->result_array();
                                                        foreach ($ket_absen as $ket) :
                                                        ?>
                                                            <option value="<?= $ket["kd_ket_absen"] ?>"><?= $ket['keterangan'] ?></option>
                                                        <?php
                                                        endforeach;
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <label for="hasil">Hasil Ferivikasi</label>
                                                    <textarea name="hasil" id="hasil" class="form-control" value=""><?= $abs['hasil_perip'] ?></textarea>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-4">
                                                    <label for="">Confrim Ferivikasi</label>
                                                    <select name="conf" id="conf" class="form-control">
                                                        <option value="">-pilih-</option>
                                                        <option value="0">waiting</option>
                                                        <option value="1">Verified</option>
                                                    </select>
                                                </div>
                                            </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-warning"> Edit</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php
                    endforeach;
                    ?>

                </tbody>
            </table>
        </div>
    </div>
</div>