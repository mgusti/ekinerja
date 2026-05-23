<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
    <?= $this->session->flashdata('messege'); ?>

    <div class="row">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Jumlah TKK</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $tkk ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-user fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
        $nama_bulan = date('F', mktime(0, 0, 0, $bulan, 10)); // March

        if (set_value('bulan') == "") {
            $hbul = "";
            $text = "-Pilih-";
        } else {
            $hbul = set_value('bulan');
            $text =  date('F', mktime(0, 0, 0, set_value('bulan'), 10));
        }

        ?>
    </div>

    <div class="row">
        <div class="col-xl-6 col-md-6 mb-6 col-12 col-lg-12 mt-3">
            <div class="card">
                <div class="card-body">
                    <form action="" method="post">
                        <div class="row">
                            <div class="col-lg-4">
                                <label for="">Bulan</label>
                                <select name="bulan" id="bulan" class="form-control">
                                    <option value="<?= $hbul ?>"><?= $text ?></option>
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
                        <div class="row mt-3">
                            <div class="col-lg-12">
                                <button class="btn btn-danger"><i class="fa fa-search" type="submit"></i></button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-xl-6 col-md-6 mb-6 col-12 col-lg-12 mt-3">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="row no-gutters align-items-center">
                    <div class="col-12 col-sm-12 col-md-12 col-xl-12">
                        <div class="text-xs font-weight-bold text-success text-uppercase  text-center mt-3">Jumlah TKK Berdasarkan Jabatan dan Ruangan</div>

                    </div>

                    <div class="col-12 col-sm-12 col-md-12 col-xl-12">
                        <a href="" class="btn btn-danger btn-sm float-right mr-4"><i class="fa fa-print"></i></a>
                    </div>


                    <div class="col-12 col-md-12 col-lg-12 col-sm-12 col-xl-12 ">

                        <div class="card-body">
                            <table class="table table-responsive-sm table-striped table-bordered ex table-sm">
                                <thead>
                                    <tr>
                                        <th>NO.</th>
                                        <th>Nama Jabatan</th>
                                        <th>Nama Ruangan</th>
                                        <th>Jumlah TKK</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 1;


                                    foreach ($jmltkk as $g) :


                                    ?>
                                        <tr>
                                            <th><?= $i++ ?></th>

                                            <th><?= $g['nmj'] ?></th>
                                            <th><?= $g['nmr'] ?></th>
                                            <th><?= $g['jml'] ?></th>



                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-6 col-md-6 mb-6 col-12 col-lg-12 mt-3">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="row no-gutters align-items-center">
                    <div class="col-12 col-sm-12 col-md-12 col-xl-12">
                        <div class="text-xs font-weight-bold text-success text-uppercase  text-center mt-3">Laporan E-kinerja TKK Yang Telah Disetujui Atasan</div>
                        <div class="text-xs font-weight-bold text-secondary mb-1 text-center mt-2">Bulan : <?= $nama_bulan ?> - <?= $tahun ?></div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-12 col-xl-12">
                        <a href="<?= base_url('report/cetaktkktimestamp/') . $bulan . '/' . $tahun ?>" class="btn btn-danger btn-sm float-right mr-4" target="_blank"><i class="fa fa-print"></i></a>
                    </div>
                    <div class="col-12 col-md-12 col-lg-12 col-sm-12 col-xl-12 ">
                        <div class="card-body">
                            <table class="table table-responsive-sm table-striped table-bordered ex table-sm">
                                <thead>
                                    <tr>
                                        <th>NO.</th>
                                        <th>NIK</th>
                                        <th>Nama</th>
                                        <th>Jumlah response</th>
                                        <th>Timestamp</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 1;


                                    foreach ($jmlresponse as $g) :


                                    ?>
                                        <tr>
                                            <th><?= $i++ ?></th>

                                            <th><?= $g['niks'] ?></th>
                                            <th><?= $g['namas'] ?></th>
                                            <th><a href="#" onClick="window.open('kinerjatkk/<?= $g['user_id'] . '/' . $bulan . '/' . $tahun ?>','kinerja','resizable,height=800,width=600'); return false;"><?= $g['jml'] ?></a></th>
                                            <th><?= $g['timestamp'] ?></th>


                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-xl-6 col-md-6 mb-6 col-12 col-lg-12 mt-3">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="row no-gutters align-items-center">
                    <div class="col-12 col-sm-12 col-md-12 col-xl-12">
                        <div class="text-xs font-weight-bold text-success text-uppercase  text-center mt-3">Data TKK tidak Input Kinerja</div>

                    </div>

                    <div class="col-12 col-sm-12 col-md-12 col-xl-12">
                        <a href="<?= base_url('report/cetaktidakinput') ?>" class="btn btn-danger btn-sm float-right mr-4"><i class="fa fa-print"></i></a>
                    </div>


                    <div class="col-12 col-md-12 col-lg-12 col-sm-12 col-xl-12 ">

                        <div class="card-body">
                            <table class="table table-responsive-sm table-striped table-bordered ex table-sm">
                                <thead>
                                    <tr>
                                        <th>NO.</th>
                                        <th>NIK</th>
                                        <th>Nama</th>
                                        <th>Ruangan</th>



                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 1;


                                    foreach ($hhh as $g) :


                                    ?>
                                        <tr>
                                            <th><?= $i++ ?></th>

                                            <th><?= $g['nik'] ?></th>
                                            <th><?= $g['nama'] ?></th>
                                            <th><?= $g['nmr'] ?></th>






                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>