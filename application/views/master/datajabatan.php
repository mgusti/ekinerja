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
            <table class="table table-striped table-bordered table-responsive-sm" id="example">
                <thead class="text-center">
                    <tr>
                        <th>ID Jabatan</th>
                        <th>Nama Jabatan</th>
                        <th>Hapus</th>

                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($jabatan as $j) :
                    ?>
                        <tr>
                            <td><?= $j['kd_jabatan'] ?></td>
                            <td><?= $j['nama_jabatan'] ?></td>
                            <td class="text-center"><a href="<?= base_url('master/deljabatan/') . $j['kd_jabatan']  ?>" class="btn btn-danger">Hapus</a></td>

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
                <h5 class="modal-title" id="exampleModalLabel">Input Jabatan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('master/inpjabatan') ?>" method="post">
                    <div class="row">
                        <div class="col-lg-12">
                            <label for="">Jabatan</label>
                            <input type="text" name="jabatan" id="jabatan" class="form-control" required>
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