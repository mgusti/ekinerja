<div class="container-fluid">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href=""><?= $title; ?></a></li>


        </ol>
    </nav>
    <div class="card mb-3">
        <div class="card-body text-danger">
            <ol>
                <p>Note update 1.6</p>
                <li>Penambahan Pencarian Data Berdasarkan bulan</li>
                <li>untuk menampilkan data silahkan tekan tombol <button class="btn btn-danger btn-sm disabled"><i class="fa fa-search"></i></button> setelah pilih bulan dan tahun</li>
                <li>bagi yang input absen bulan juni yang salah input silahkan edit menggunakan tombol <button class="btn btn-warning disabled btn-sm"><i class="fa fa-edit "></i></button> yang terletak di sebelah kanan data di table </li>
                <li>Jika status verifikasi berwana hijau, tetapi data yang diinputkan masih salah, silahkan hubungi rangga SIMRS untuk perubahan data</li>
            </ol>
            <hr>
            <ol>
                <p>Aturan :</p>
                <li>silahkan input data absen setelah absen pulang di mesin absen wajah</li>
                <li>maximal keterlambatan input 2 hari setelah absen wajah di mesin absen</li>
                <li>inputlah absen berdasarkan absen wajah di mesin, tidak berdasarkan jadwal bulanan</li>
                <li>dikarenakan aplikasi masih baru, inputlah absen dari tanggal 1 juni 2021, untuk seterusnya gunakan point no 1</li>
            </ol>

        </div>
    </div>
    <div class="card mb-3">
        <div class="card-body text-danger">
            <form action="" method="get">
                <div class="row">
                    <div class="col-lg-6">
                        <label for="">Bulan</label>
                        <select name="bulan" id="bulan" class="form-control">
                            <option value="">-Pilih-</option>
                            <?php
                            foreach ($bln as $b) :
                            ?>

                                <option value="<?= $b['kode_bulan'] ?>"><?= $b['nama_bulan'] ?></option>
                            <?php
                            endforeach;
                            ?>
                        </select>
                    </div>

                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <label for="">Tahun</label>
                        <input type="number" name="tahun" id="tahun" class="form-control" value="<?= date('Y') ?>">
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-lg-12">
                        <button class="btn btn-danger"><i class="fa fa-search"></i></button>
                    </div>
                </div>
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
            <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#exampleModal">
                <i class="fa fa-plus"> Tambah Data</i>
            </button>



            <p>Bulan : <?= $_GET['bulan'] ?> - <?= $_GET['tahun'] ?></p>
            <table class="table table-striped table-bordered table-responsive-md">
                <thead>
                    <tr>
                        <th>Keterangan</th>
                        <th>Jumlah</th>

                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($count_absen as $c) :
                    ?>
                        <tr>
                            <td><?= $c['kt'] ?></td>
                            <td><?= $c['jumlah'] ?></td>
                        </tr>
                    <?php
                    endforeach;
                    ?>
                </tbody>
            </table>
            <table class="table table-striped table-bordered table-responsive-md ex">
                <thead class="text-center">
                    <tr>
                        <th>No.</th>
                        <th>Tgl Absen <span><small>(format tgl-bulan-tahun)</small></span></th>

                        <th>Shift Kerja</th>
                        <th>Keterangan</th>

                        <th>Verifikasi</th>
                        <th>Hasil Verifikasi</th>
                        <th>Edit</th>

                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    foreach ($absen as $a) :
                        if ($a['peripikasi'] == 0) {
                            $pe = "Waiting Verified";
                            $warna = "warning";
                            $but = "enabeled";
                        } else if ($a['peripikasi'] == 1) {
                            $pe = "Verified";
                            $warna = "success";
                            $but = "disabled";
                        } else {
                            $pe = "not Verified";
                            $warna = "danger";
                            $but = "disabled";
                        }
                    ?>
                        <tr class="text-center">
                            <th><?= $i++ ?></th>
                            <td><?= date('D, d-m-Y', strtotime($a['tgl_absen'])) ?></td>
                            <td><?= $a['nama_shift'] ?></td>
                            <td><?= $a['kt'] ?></td>
                            <td class="bg-<?= $warna ?> text-white"><?= $pe ?></td>
                            <td><?= $a['hasil_perip'] ?></td>
                            <td><a href="#" class="btn btn-warning <?= $but  ?>" data-toggle="modal" data-target="#eabsen<?= $a['kd_absen'] ?>" type="button"><i class="fa fa-edit"></i></a></td>
                        </tr>

                        <!-- Modal -->
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
                                        <form action="<?= base_url('absensi/eabsen/') . $a['kd_absen'] ?>" method="post">
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



<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Input Absen</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('absensi/iabsen') ?>" method="post">
                    <div class="row">
                        <div class="col-lg-6">
                            <label for="tgl">Tanggal Absen</label>
                            <input type="date" name="tgl" id="tgl" class="form-control"  required>
                        </div>
                        <div class="col-lg-6">
                            <label for="shift">Shift</label>
                            <select name="shift" id="shift" class="form-control" required>
                                <option value="">-Pilih-</option>
                                <?php
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
                            <select name="ket" id="ket" class="form-control" required>
                                <option value="">-Pliih-</option>
                                <?php
                                foreach ($ket_absen as $ket) :
                                ?>
                                    <option value="<?= $ket["kd_ket_absen"] ?>"><?= $ket['keterangan'] ?></option>
                                <?php
                                endforeach;
                                ?>
                            </select>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary"> Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>