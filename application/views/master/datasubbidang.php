<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
        </div>
        <div class="card-body">

            <button type="button" class="btn btn-primary mb-3 mt-3" data-toggle="modal" data-target="#exampleModal">
                Tambah
            </button>
            <div class="flash-data" data-flashdata="<?= $this->session->flashdata('messege'); ?>"></div>
            <div class="eror" data-flashdata="<?= $this->session->flashdata('eror'); ?>"></div>
            <table class="table table-striped table-bordered" id="example">
                <thead class="text-center">
                    <tr>
                        <th>ID SubBidang</th>
                        <th>Nama SubBidang</th>
                        <th>ID Bidang</th>
                        <th>Nama Bidang</th>
                        <th>Hapus</th>

                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($subbidang as $b) :
                    ?>
                        <tr>
                            <td><?= $b['id_subbidang'] ?></td>
                            <td><?= $b['nama_subbidang'] ?></td>
                            <td><?= $b['id_bidang'] ?></td>
                            <td><?= $b['bidang'] ?></td>
                            <td class="text-center"><a href="<?= base_url('master/delsubbidang/') . $b['id_subbidang'] ?>" class="btn btn-danger">Hapus</a></td>

                        </tr>
                    <?php
                    endforeach;
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>


<!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Input Subbidang</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('master/inpsubbidang') ?>" method="post">
                    <div class="row">
                        <div class="col-lg-12">
                            <label for="">Bidang</label>
                            <select name="bidang" id="bidang" class="form-control" required>
                                <option value="">-Pilih-</option>
                                <?php
                                foreach ($bidang as $b) :
                                ?>
                                    <option value="<?= $b['id_bidang'] ?>"><?= $b['bidang'] ?></option>
                                <?php
                                endforeach;
                                ?>
                            </select>
                        </div>
                        <div class="col-lg-12">
                            <label for="">Subbidang</label>
                            <input type="text" name="subbidang" id="subbidang" class="form-control" required>
                        </div>
                    </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>