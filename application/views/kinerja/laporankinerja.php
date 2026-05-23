<div class="container-fluid">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= base_url('kinerja') ?>">kinerja</a></li>
            <li class="breadcrumb-item">Laporan Kinerja</li>

        </ol>
    </nav>
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
                        <th>User</th>
                        <th>Bidang</th>
                        <th>Deskripsi Pekerjaan</th>

                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    foreach ($kinerja as $k) :

                    ?>
                        <tr>
                            <th><?= $i++ ?></th>
                            <td><?= $k['tgl'] ?></td>
                            <td><?= $k['nama'] ?></td>
                            <td><?= $k['bidang'] ?></td>
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