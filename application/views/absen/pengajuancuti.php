<div class="container-fluid">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href=""><?= $title; ?></a></li>


        </ol>
    </nav>
    <div class="card mb-3">
        <div class="card-body text-danger">
            <p>Note</p>
            <li>Pengajuan Cuti dilakukan 2 minggu sebelum tanggal cuti dimulai</li>
            <li>Diinput setelah persetujuan Atasan</li>


        </div>
    </div>
    <div class="card mb-3">
        <div class="card-header">
            <h3 class="card-title">Data Cuti </h3>
        </div>
        <div class="card-body">
            <div class="flash-data" data-flashdata="<?= $this->session->flashdata('messege'); ?>"></div>
            <div class="eror" data-flashdata="<?= $this->session->flashdata('eror'); ?>"></div>
            <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#exampleModal">
                <i class="fa fa-plus"> Tambah Pengajuan</i>
            </button>



            <table class="table table-striped table-bordered table-responsive-md ex">
                <thead class="text-center">
                    <tr>
                        <th>No.</th>
                        <th>No. Pengajuan</th>
                        <th>Jenis Cuti</th>

                        <th>Tgl Mulai Cuti</th>
                        <th>Tgl Selesai Cuti</th>
                        <th>Jumlah Hari</th>
                        <th>Keterangan Cuti</th>

                        <th>Persetujuan Kepegawaian</th>
                        <th>Edit</th>
                        <th>Hapus</th>

                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    foreach ($cuti as $c) :


                        if ($c['acc_kepegawaian'] == 0) {
                            $warna2 = "warning";
                            $pe2 = "tunggu";
                            $but = "enabeled";
                        } else  if ($c['acc_kepegawaian'] == 1) {
                            $warna2 = "success";
                            $pe2 = "OK";
                            $but = "disabled";
                        } else {
                            $warna2 = "danger";
                            $pe2 = "ditangguhkan";
                            $but = "enabeled";
                        }




                    ?>
                        <tr class="text-center">
                            <th><?= $i++ ?></th>
                            <th><?= $c['kode_cuti'] ?></th>
                            <th><?= $c['jt'] ?></th>
                            <th><?= $c['tgl_mulai_ajuan'] ?></th>
                            <th><?= $c['tgl_selesai_ajuan'] ?></th>
                            <th><?= $c['jumlah_hari'] . ' hari' ?></th>
                            <th><?= $c['keterangan_cuti'] ?></th>

                            <td class="bg-<?= $warna2 ?> text-white"><?= $pe2 ?></td>
                            <td><a href="<?= base_url('absensi/ecuti/') . $c['kode_cuti'] ?>" class="btn btn-warning <?= $but ?>" data-toggle="modal" data-target="#editcuti<?= $c['kode_cuti'] ?>"><i class="fa fa-edit"></i></a></td>
                            <td><a href="<?= base_url('absensi/dcuti/') . $c['kode_cuti'] ?>" class="btn btn-danger <?= $but ?> hapus"><i class="fa fa-trash"></i></a></td>

                        </tr>

                        <div class="modal fade" id="editcuti<?= $c['kode_cuti'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">Edit Pengajuan Cuti</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <?php
                                        $cut = $this->db->get_where('cuti', ['kode_cuti' => $c['kode_cuti']])->row_array();
                                        ?>
                                        <form action="<?= base_url('absensi/ecuti/') . $c['kode_cuti'] ?>" method="post">
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <label for="">Jenis Cuti</label>
                                                    <select name="jenis" id="jenis" class="form-control" required>
                                                        <option value="<?= $cut['jenis_cuti'] ?>"><?= $cut['jenis_cuti'] ?></option>
                                                        <?php
                                                        $jenis = $this->db->get('jenis_cuti')->result_array();
                                                        foreach ($jenis as $j) :
                                                        ?>
                                                            <option value="<?= $j['kode_jenis_cuti'] ?>"><?= $j['kode_jenis_cuti'] ?>. <?= $j['jenis_cuti'] ?></option>
                                                        <?php
                                                        endforeach;
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <label for="">Tgl Mulai Cuti</label>
                                                    <input type="date" name="tgl_mulai" id="tgl_mulai" class="form-control" value="<?= $cut['tgl_mulai_ajuan'] ?>" required>
                                                </div>
                                                <div class="col-lg-6">
                                                    <label for="">Tgl berakir cuti</label>
                                                    <input type="date" name="tgl_akhir" id="tgl_akhir" class="form-control" value="<?= $cut['tgl_selesai_ajuan'] ?>" required>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <label for="">Jumlah Hari</label>
                                                    <input type="number" name="jumlah" id="jumlah" class="form-control" value="<?= $cut['jumlah_hari'] ?>" readonly>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <label for="">Keterangan Cuti</label>
                                                    <textarea name="keterangan" id="keterangan" cols="12" rows="3" class="form-control" value="<?= $cut['keterangan_cuti'] ?>" required></textarea>
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
            <div class="modal-header">Pengajuan Cuti</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('absensi/icuti') ?>" method="post">
                    <div class="row">
                        <div class="col-lg-6">
                            <label for="">Jenis Cuti</label>
                            <select name="jenis" id="jenis" class="form-control" required>
                                <option value="">-pilih-</option>
                                <?php
                                $jenis = $this->db->get('jenis_cuti')->result_array();
                                foreach ($jenis as $j) :
                                ?>
                                    <option value="<?= $j['kode_jenis_cuti'] ?>"><?= $j['kode_jenis_cuti'] ?>. <?= $j['jenis_cuti'] ?></option>
                                <?php
                                endforeach;
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <label for="">Tgl Mulai Cuti</label>
                            <input type="date" name="tgl_mulai" id="tgl_mulai" class="form-control" required>
                        </div>
                        <div class="col-lg-6">
                            <label for="">Tgl berakir cuti</label>
                            <input type="date" name="tgl_akhir" id="tgl_akhir" class="form-control" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <label for="">Jumlah Hari</label>
                            <input type="number" name="jumlah" id="jumlah" class="form-control" readonly>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <label for="">Keterangan Cuti</label>
                            <textarea name="keterangan" id="keterangan" cols="12" rows="3" class="form-control" required></textarea>
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