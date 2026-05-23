<div class="container-fluid">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= base_url('peninjauan/peninjauankinerja') ?>">Peninjauan</a></li>


        </ol>
    </nav>
    <div class="card mb-3">
        <div class="card-header">
            <h3 class="card-title"><?= $title; ?></h3>
        </div>
        <div class="card-body">
            <div class="flash-data" data-flashdata="<?= $this->session->flashdata('messege'); ?>"></div>
            <div class="eror" data-flashdata="<?= $this->session->flashdata('eror'); ?>"></div>


            <p>Ruangan : <?= $ruangan['nama_ruangan'] ?></p>


            <table class="table table-striped table-bordered table-responsive-md " id="example">
                <thead class="text-center">
                    <tr>
                        <th>No.</th>
                        <th>NIK</th>
                        <th>Nama TKK</th>
                        <th>Nilai Kinerja</th>

                    </tr>
                </thead>
                <tbody class="text-center">
                    <?php
                    $i = 1;
                    foreach ($ubid as $u) :

                    ?>
                        <tr>
                            <th><?= $i++ ?></th>
                            <td><?= $u['nik'] ?></td>
                            <td><?= $u['nama'] ?></td>
                            <td><a href="<?= base_url('peninjauan/datakinerja/') . $u['id_user'] ?>" class="btn btn-danger">Kinerja</a></td>



                        </tr>
                    <?php
                    endforeach;
                    ?>

                </tbody>
            </table>
        </div>
    </div>
</div>