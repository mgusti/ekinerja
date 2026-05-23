<div class="container-fluid">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href=""><?= $title; ?></a></li>


        </ol>
    </nav>
    <div class="card mb-3">
        <div class="card-body ">


        </div>
    </div>
    <div class="card mb-3">

        <div class="card-body">
            <div class="flash-data" data-flashdata="<?= $this->session->flashdata('messege'); ?>"></div>
            <div class="eror" data-flashdata="<?= $this->session->flashdata('eror'); ?>"></div>

            <table class="table table-striped table-bordered table-responsive" id="example">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>NIK</th>
                        <th>NIP</th>
                        <th>Nama</th>
                        <th>Status</th>
                        <th>No. Pengajuan</th>
                        <th>Jenis Cuti</th>
                        <th>Tgl Mulai Cuti</th>
                        <th>Tgl Selesai Cuti</th>
                        <th>Jumlah Hari</th>
                        <th>Keterangan Cuti</th>
                        <th>Persetujuan Kepegawaian</th>
                        <th>Cetak</th>
                        <th>Keterangan Kepegawaian</th>




                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;

                    foreach ($cuti as $r) :

                        if ($r['beda_pns'] == 1) {
                            $st = 'PNS';
                        } else if ($r['beda_pns'] == 2) {
                            $st = 'TKK';
                        } else if ($r['beda_pns'] == 0) {
                            $st = 'Admin';
                        } else {
                            $st = 'uknown';
                        }

                        if ($r['acc_kepegawaian'] == 0) {
                            $h = "Tunggu";
                            $warna = "warning";
                            $cetak = "disabled";
                        } else {
                            $h = "OK";
                            $warna = "success";
                            $cetak = "enabled";
                        }


                    ?>
                        <tr>
                            <th><?= $i++ ?></th>
                            <th><?= $r['nik'] ?></th>
                            <th><?= $r['nip'] ?></th>
                            <th><?= $r['nama'] ?></th>
                            <th><?= $st ?></th>
                            <th><?= $r['kode_cuti'] ?></th>
                            <th><?= $r['jt'] ?></th>
                            <th><?= $r['tgl_mulai_ajuan'] ?></th>
                            <th><?= $r['tgl_selesai_ajuan'] ?></th>
                            <th><?= $r['jumlah_hari'] . ' Hari' ?></th>
                            <th><?= $r['keterangan_cuti'] ?></th>
                            <th class="bg-<?= $warna ?> text-white text-center"><button class="btn btn-<?= $warna ?>" data-toggle="modal" data-target="#acc_cuti<?= $r['kode_cuti'] ?>"><?= $h ?></button></th>
                            <th><a href="<?= base_url('absensi/cetak_cuti/') . $r['kode_cuti'] ?>" target="_blank" class="btn btn-danger <?= $cetak ?>"><i class="fa fa-print"></i></a></th>
                            <th><?= $r['keterangan_kepegawaian'] ?></th>
                        </tr>

                        <div class="modal fade" id="acc_cuti<?= $r['kode_cuti'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Persetujuan Cuti</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">

                                        <form action="<?= base_url('absensi/acc_cuti/') . $r['kode_cuti'] ?>" method="post">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <label for="">Persetujuan</label>
                                                    <select name="persetujuan" id="persetujuan" class="form-control" required>
                                                        <option value="">-Pilih-</option>
                                                        <option value="1">OK</option>
                                                        <option value="2">Ditangguhkan</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <label for="">Keterangan</label>
                                                    <textarea name="keterangan" id="keterangan" cols="12" rows="3" class="form-control" required></textarea>
                                                </div>
                                            </div>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-warning"> Update</button>
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