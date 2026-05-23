<div class="container-fluid">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href=""><?= $title; ?></a></li>


        </ol>
    </nav>
    <div class="card mb-3">
        <div class="card-body ">
            <form action="" method="get">
                <div class="row">
                    <div class="col-lg-4">
                        <label for="">Bulan</label>
                        <select name="bulan" id="bulan" class="form-control" required>
                            <option value="">-pilih-</option>
                            <?php
                            foreach ($bulan  as $b) {
                            ?>
                                <option value="<?= $b['kode_bulan'] ?>"><?= $b['nama_bulan'] ?></option>
                            <?php
                            }
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
                        <label for="">Role</label>
                        <select name="role" id="role" class="form-control">
                            <option value="">-pilih-</option>
                            <option value="2">TKK</option>
                            <option value="1">PNS</option>
                        </select>
                    </div>

                </div>
                <div class="row">
                    <div class="col-lg-4">
                        <button class="btn btn-danger mt-3"><i class="fa fa-search"></i></button>
                        <?php
                        if ($_GET['bulan'] == "") {
                            $aksi = "d-none";
                        }
                        ?>
                        <a href="<?= base_url('absensi/cetakrekapabsen/?bulan=') . $_GET['bulan'] . '&tahun=' . $_GET['tahun'] . '&role=' . $_GET['role'] ?>" class="btn btn-info mt-3 <?= $aksi ?>" target="_blank" type="submit"><i class="fa fa-print"></i></a>
                    </div>
                </div>
            </form>

        </div>
    </div>
    <div class="card mb-3">

        <div class="card-body">
            <div class="flash-data" data-flashdata="<?= $this->session->flashdata('messege'); ?>"></div>
            <div class="eror" data-flashdata="<?= $this->session->flashdata('eror'); ?>"></div>

            <table class="table table-striped table-bordered table-responsive-md" id="example">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>NIK</th>
                        <th>Nama</th>
                        <th>Role</th>
                        <th>Hadir</th>
                        <th>Alpa</th>
                        <th>Izin</th>
                        <th>Dinas Luar</th>
                        <th>Cuti</th>
                        <th>Libur</th>
                        <th>Jumlah Absen</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;

                    foreach ($rekap as $r) :

                        if ($r['beda_pns'] == 2) {
                            $st = 'TKK';
                        } else if ($r['beda_pns'] == 1) {
                            $st = 'PNS';
                        } else if ($r['beda_pns'] == 0) {
                            $st = 'Admin';
                        } else {
                            $st = 'uknown';
                        }
                    ?>
                        <tr>
                            <th><?= $i++ ?></th>
                            <th><?= $r['nik'] ?></th>
                            <th><?= $r['nama'] ?></th>
                            <th><?= $st ?></th>
                            <th><?= $r['jh'] ?></th>
                            <th><?= $r['ja'] ?></th>
                            <th><?= $r['ji'] ?></th>
                            <th><?= $r['jdl'] ?></th>
                            <th><?= $r['jdc'] ?></th>
                            <th><?= $r['lbr'] ?></th>
                            <th><?= $r['jabsen'] ?></th>
                        </tr>
                    <?php
                    endforeach;
                    ?>
                </tbody>
            </table>



        </div>
    </div>
</div>