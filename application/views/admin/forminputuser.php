<div class="container-fluid">

    <div class="card">
        <div class="card-header">
            <h4 class="card-title"><?= $title ?></h4>
        </div>
        <div class="card-body">
            <div class="flash-data" data-flashdata="<?= $this->session->flashdata('messege'); ?>"></div>
            <div class="eror" data-flashdata="<?= $this->session->flashdata('eror'); ?>"></div>
            <form action="<?= base_url('admin/forminputuser') ?>" method="post">
                <div class="row">
                    <div class="col-lg-4">
                        <label for="">NIK</label>
                        <input type="number" name="nik" id="nik" class="form-control" value="<?= set_value('nik'); ?>">
                        <?= form_error('nik', ' <small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    <div class="col-lg-4">
                        <label for="">NIP</label>
                        <input type="number" name="nip" id="nip" class="form-control" value="<?= set_value('nip'); ?>">
                        <?= form_error('nip', ' <small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    <div class=" col-lg-4">
                        <label for="">Nama</label>
                        <input type="text" name="nama" id="nama" class="form-control" value="<?= set_value('nama'); ?>">
                        <?= form_error('nama', ' <small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                </div>
                <div class=" row">
                    <div class="col-lg-5">
                        <label for="">Username</label>
                        <input type="text" name="username" id="username" class="form-control" value="<?= set_value('username'); ?>">
                        <?= form_error('username', ' <small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                </div>
                <div class=" row">
                    <div class="col-lg-4">
                        <label for="">Password</label>
                        <input type="password" name="password" id="password" class="form-control" value="<?= set_value('password'); ?>">
                        <?= form_error('password', ' <small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    <div class=" col-lg-4">
                        <label for="">Ulangi Password</label>
                        <input type="password" name="cpassword" id="cpassword" class="form-control" value="<?= set_value('cpassword'); ?>">
                        <?= form_error('cpassword', ' <small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                </div>
                <div class=" row">
                    <div class="col-lg-4">
                        <label for="">Jabatan</label>
                        <select name="jabatan" id="jabatan" class="form-control">
                            <option value="">-Pilih-</option>
                            <?php
                            foreach ($jabatan as $b) :
                            ?>
                                <option value="<?= $b['kd_jabatan'] ?>"><?= $b['nama_jabatan'] ?></option>
                            <?php
                            endforeach;
                            ?>
                        </select>
                        <?= form_error('jabatan', ' <small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    <div class="col-lg-4">
                        <label for="">Ruangan</label>
                        <select name="ruangan" id="ruangan" class="form-control">
                            <option value="">-Pilih-</option>
                            <?php
                            foreach ($ruangan as $r) :
                            ?>
                                <option value="<?= $r['kd_ruangan'] ?>"><?= $r['nama_ruangan'] ?></option>
                            <?php
                            endforeach;
                            ?>
                        </select>
                        <?= form_error('ruangan', ' <small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4">
                        <label for="">Role Akses</label>
                        <select name="role" id="role" class="form-control">
                            <option value="">-Pilih-</option>
                            <?php
                            foreach ($role as $r) :
                            ?>

                                <option value="<?= $r['id'] ?>"><?= $r['role'] ?></option>
                            <?php
                            endforeach;
                            ?>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <label for="">Nomor Kontrak</label>
                        <input type="text" name="nokon" id="nokon" class="form-control" value="NOMOR:000/RSUD-HAM/2021/2 JANUARI 2021">
                        <?= form_error('nokon', ' <small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    <div class="col-lg-4">
                        <label for="">Upah</label>
                        <input type="text" name="upah" id="upah" class="form-control" value="1300000">
                        <?= form_error('upah', ' <small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                </div>
                <button class="btn btn-primary mt-3 mb-3">Simpan</button>
            </form>
        </div>
    </div>
</div>