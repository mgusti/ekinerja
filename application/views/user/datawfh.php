<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800"><?= $title ?></h1>
    <div class="flash-data" data-flashdata="<?= $this->session->flashdata('messege'); ?>"></div>
    <div class="eror" data-flashdata="<?= $this->session->flashdata('eror'); ?>"></div>
    <a href="<?= base_url('user/wfh') ?>" class="btn btn-success mt-3 mb-3"> Input Data WFH</a>
    <table class="table table-striped table-bordered">
        <thead class="text-center">
            <tr>
                <th>Tgl Kerja</th>
                <th>Screen Shoot</th>
                <th>Tgl Upload</th>
                <th>Keterangan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($wfh as $w) :
            ?>
                <tr>
                    <td><?= $w['tgl_kerja'] ?></td>
                    <td><a href="<?= base_url('assets/img/wfh/') . $w['img'] ?>" target="_blank">lihat gambar</a></td>
                    <td><?= $w['time'] ?></td>
                    <td><?= $w['keterangan'] ?></td>
                    <td class="text-center">
                        <a href="<?= base_url('user/delwfh/') . $w['kd_wfh'] ?>" class="btn btn-danger hapus">Hapus</a>

                    </td>
                </tr>
            <?php
            endforeach
            ?>
        </tbody>
    </table>
</div>
<!-- Button trigger modal -->