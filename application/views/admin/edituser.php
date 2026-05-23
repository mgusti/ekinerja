<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800"><?= $title ?></h1>
    <div class="flash-data" data-flashdata="<?= $this->session->flashdata('messege'); ?>"></div>
    <div class="eror" data-flashdata="<?= $this->session->flashdata('eror'); ?>"></div>

    <div class="card bg-gradient-white">

        <div class="card-body">
            <form action="<?= base_url('admin/aksiedituser/' . $datauser['id_user']) ?>" method="post">
                <div class="row">
                    <div class="col-lg-4">
                        <label for="">NIK</label>
                        <input type="number" name="nik" id="nik" class="form-control" value="<?= $datauser['nik'] ?>">
                    </div>
                    <div class="col-lg-4">
                        <label for="">NIP</label>
                        <input type="number" name="nip" id="nip" class="form-control" value="<?= $datauser['nip'] ?>">
                    </div>
                    <div class="col-lg-4">
                        <label for="">NAMA</label>
                        <input type="text" name="nama" id="nama" class="form-control" value="<?= $datauser['nama'] ?>">
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4">
                        <label for="">JABATAN</label>
                        <select name="jabatan" id="jabatan" class="form-control">
                            <option value="<?= $datauser['kd_jabatan'] ?>"><?= $datauser['nama_jabatan'] ?></option>
                            <?php
                            foreach ($jabatan as $j) :
                            ?>
                                <option value="<?= $j['kd_jabatan'] ?>"><?= $j['nama_jabatan'] ?></option>
                            <?php
                            endforeach;
                            ?>
                        </select>
                    </div>
                    <div class="col-lg-4">
                        <label for="">Ruangan</label>
                        <select name="ruangan" id="ruangan" class="form-control">
                            <option value="<?= $datauser['kd_ruangan'] ?>"><?= $datauser['nama_ruangan'] ?></option>
                            <?php
                            foreach ($ruangan as $j) :
                            ?>
                                <option value="<?= $j['kd_ruangan'] ?>"><?= $j['nama_ruangan'] ?></option>
                            <?php
                            endforeach;
                            ?>
                        </select>
                    </div>

                </div>
                <div class="row">
                    <div class="col-lg-4">
                        <label for="">Role Akses</label>
                        <select name="role" id="role" class="form-control">
                            <option value="<?= $datauser['role_id'] ?>"><?= $datauser['rr'] ?></option>
                            <?php
                            foreach ($role as $r) :

                            ?>
                                <option value="<?= $r['id'] ?>"><?= $r['role'] ?></option>
                            <?php
                            endforeach;
                            ?>
                        </select>
                    </div>
                    <div class="col-lg-4">
                        <label for="">ID Absen</label>
                        <input type="number" name="id_absen" id="id_absen" class="form-control" value="<?= $datauser['id_absen'] ?>">
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <label for="">Nomor Kontrak</label>
                        <input type="text" name="nokon" id="nokon" class="form-control" value="<?= $datauser['nomor_kontrak'] ?>">

                    </div>
                    <div class="col-lg-4">
                        <label for="">Upah</label>
                        <input type="text" name="upah" id="upah" class="form-control" value="<?= $datauser['upah'] ?>">

                    </div>
                </div>
                <button class="btn btn-warning mt-3" type="submit">Edit</button>
            </form>
        </div>
    </div>
</div>