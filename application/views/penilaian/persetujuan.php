<div class="container-fluid">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= base_url('peninjauan/peninjauankinerja') ?>">Persetujuan Kinerja</a></li>


        </ol>
    </nav>
    <div class="card mb-3">
        <div class="card-header">
            <h3 class="card-title"><?= $title; ?></h3>
        </div>
        <div class="card-body">
            <div class="flash-data" data-flashdata="<?= $this->session->flashdata('messege'); ?>"></div>
            <div class="eror" data-flashdata="<?= $this->session->flashdata('eror'); ?>"></div>

            <div class="card">
                <div class="card-body">
                    <form action="" method="post">
                        <div class="row">
                            <div class="col-lg-12">
                                <label for="">Bulan</label>
                                <select name="bulan" id="bulan" class="form-control" required>
                                    <option value="">-Pilih</option>
                                    <?php
                                    foreach ($bulan  as $b) :
                                    ?>
                                        <option value="<?= $b['kode_bulan'] ?>"><?= $b['nama_bulan'] ?></option>
                                    <?php
                                    endforeach;
                                    ?>
                                </select>
                            </div>
                            <div class="col-lg-12">
                                <label for="">Tahun</label>
                                <input type="number" name="tahun" id="tahun" value="<?= date('Y') ?>" class="form-control">
                            </div>
                        </div>
                        <button class="btn btn-danger mt-3" type="submit"><i class="fa fa-search"></i></button>
                    </form>
                </div>
            </div>
            <p>Ruangan : <?= $ruangan['nama_ruangan'] ?></p>


            <table class="table table-striped table-bordered table-responsive-md ">
                <thead>
                    <tr class="text-center">

                        <th>Nama</th>
                        <th>Bulan</th>
                        <th>Jumlah Response</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($kin as $k) :
                        if ($k['setujui'] == 0) {
                            $h = "Belum di prosess";
                            $bg = "bg-warning";
                            $btn = "btn-warning";
                        } else if ($k['setujui'] == 1) {
                            $h = "Setuju";
                            $bg = "bg-success";
                            $btn = "btn-success";
                        } else {
                            $h = "Tidak Setuju";
                            $bg = "bg-danger";
                            $btn = "btn-danger";
                        }
                    ?>
                        <tr>

                            <th><?= $k['nm'] ?></th>
                            <th><?= $k['tg'] ?></th>
                            <th><a href="#" onClick="window.open('kinerjatkk/<?= $k['user_id'] . '/' . $k['tg'] . '/' . $k['th'] ?>','kinerja','resizable,height=800,width=600'); return false;"><?= $k['ds'] ?></a></th>

                            <th class="<?= $bg ?> text-center"><button type="button" class="btn <?= $btn ?>" data-toggle="modal" data-target="#exampleModal<?= $k['user_id'] ?>">
                                    <?= $h ?>
                                </button></th>

                        </tr>
                        <div class="modal fade" id="exampleModal<?= $k['user_id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Update Status kinerja</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="<?= base_url('peninjauan/updatestatus') ?>" method="post">
                                            <div class="card bg-secondary">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-lg-12 text-white">
                                                            <input type="text" name="nama" id="nama" class="form-control" value="<?= $k['nama'] ?>" readonly>
                                                        </div>
                                                        <div class="col-lg-12" hidden>
                                                            <label for="">ID User</label>
                                                            <input type="text" name="tgl" id="tgl" class="form-control" value="<?= $k['tg'] ?>">
                                                            <input type="text" name="thn" id="thn" class="form-control" value="<?= $k['th'] ?>">
                                                            <input type="text" name="id" id="id" class="form-control" value="<?= $k['user_id'] ?>">
                                                        </div>

                                                    </div>
                                                    <div class="row text-center mt-3">
                                                        <div class="col-lg-12">
                                                            <label class="btn btn-success btn-lg active">
                                                                <input type="radio" name="status" id="setuju" autocomplete="off" value="1"> Setuju
                                                            </label>
                                                            <label class="btn btn-danger btn-lg">
                                                                <input type="radio" name="status" id="tidaksetuju" autocomplete="off" value="2"> Tidak Setuju
                                                            </label>


                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Update</button>
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