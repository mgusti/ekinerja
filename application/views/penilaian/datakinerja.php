<div class="container-fluid">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= base_url('peninjauan/peninjauankinerja') ?>">peninjauan</a></li>
            <li class="breadcrumb-item">Data Kinerja</li>

        </ol>
    </nav>
    <div class="card mb-3">
        <div class="card-body">
            <form action="" method="post">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                        <label for="">Nama</label>
                        <input type="text" name="nama" id="nama" class="form-control" value="<?= $us['nama'] ?>" readonly>
                    </div>
                </div>
                <div class="row" hidden>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                        <label for="">id</label>
                        <input type="text" name="id" id="id" class="form-control" value="<?= $us['id_user'] ?>" readonly>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                        <label for="">Bulan</label>
                        <select name="bulan" id="bulan" class="form-control">
                            <option value="">-Pilih-</option>
                            <option value="01">Januari</option>
                            <option value="02">Februari</option>
                            <option value="03">Maret</option>
                            <option value="04">April</option>
                            <option value="05">Mei</option>
                            <option value="06">Juni</option>
                            <option value="07">Juli</option>
                            <option value="08">Agustus</option>
                            <option value="09">September</option>
                            <option value="11">Oktober</option>
                            <option value="12">Desember</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                        <label for="">Tahun</label>
                        <input type="number" name="tahun" id="tahun" class="form-control" value="2021">

                    </div>
                </div>

                <button type="submit" class="btn btn-danger mt-3"><i class="fa fa-search"></i> Cari</button>
                <button type="button" class="btn btn-info mt-3" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-print"></i> Cetak</button>
            </form>
        </div>
    </div>
    <div class="card mb-3">
        <div class="card-header">
            <h3 class="card-title"><?= $title; ?></h3>
        </div>
        <div class="card-body">
            <div class="flash-data" data-flashdata="<?= $this->session->flashdata('messege'); ?>"></div>
            <div class="eror" data-flashdata="<?= $this->session->flashdata('eror'); ?>"></div>



            <table class="table table-striped table-bordered table-responsive-md " id="example">
                <thead class="text-center">
                    <tr>
                        <th>No.</th>
                        <th>Tgl</th>

                        <th>Deskripsi Pekerjaan</th>

                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    foreach ($kin as $k) :

                    ?>
                        <tr>
                            <th><?= $i++ ?></th>
                            <td><?= $k['tgl'] ?></td>


                            <td><?= $k['deskripsi'] ?></td>


                        </tr>
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
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('peninjauan/cetak/' . $us['id_user']) ?>" method="post" target="_blank">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                            <label for="">Bulan</label>
                            <select name="bulan" id="bulan" class="form-control">
                                <option value="">-Pilih-</option>
                                <option value="01">Januari</option>
                                <option value="02">Februari</option>
                                <option value="03">Maret</option>
                                <option value="04">April</option>
                                <option value="05">Mei</option>
                                <option value="06">Juni</option>
                                <option value="07">Juli</option>
                                <option value="08">Agustus</option>
                                <option value="09">September</option>
                                <option value="11">Oktober</option>
                                <option value="12">Desember</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                            <label for="">Tahun</label>
                            <input type="number" name="tahun" id="tahun" class="form-control" value="2021">

                        </div>
                    </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-info"><i class="fa fa-print"></i> Cetak</button>
                </form>
            </div>
        </div>
    </div>
</div>