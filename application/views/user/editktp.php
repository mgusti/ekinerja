<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800"><?= $title;  ?></h1>

    <div class="flash-data" data-flashdata="<?= $this->session->flashdata('messege'); ?>"></div>
    <div class="eror" data-flashdata="<?= $this->session->flashdata('eror'); ?>"></div>
    <?php echo form_open_multipart('user/editktp'); ?>
    <div class="row">
        <div class="col-lg-3">
            <label for="">Tempat Lahir</label>
            <input type="text" class="form-control" name="tempat" value="<?= $user['tempat_lahir'] ?>" id="tempat">
            <?= form_error('tempat', ' <small class="text-danger pl-3">', '</small>'); ?>
        </div>
        <div class="col-lg-3">
            <label for="">Tanggal Lahir</label>
            <input type="date" class="form-control" name="tgllahir" value="<?= $user['tgl_lahir'] ?>" id="tgllahir">
            <?= form_error('tgllahir', ' <small class="text-danger pl-3">', '</small>'); ?>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-3">
            <label for="">Jenis Kelamin</label>
            <select name="jenkel" id="jenkel" class="form-control">
                <?php
                if ($user['kd_jenkel'] == 'L') {
                    $kelamin = 'Laki - Laki';
                } else if ($user['kd_jenkel'] == 'P') {
                    $kelamin = 'Perempua';
                } else {
                    $kelamin = '-Pilih-';
                }
                ?>
                <option value="<?= $user['kd_jenkel'] ?>"><?= $kelamin ?></option>
                <option value="L">Laki - Laki</option>
                <option value="P">Perempuan</option>
            </select>
            <?= form_error('jenkel', ' <small class="text-danger pl-3">', '</small>'); ?>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-3">
            <label for="">Golongan Darah</label>
            <select name="goldar" id="goldar" class="form-control">
                <?php
                if ($user['kd_goldar'] == '') {
                    $goldar = '-Pilih-';
                } else {
                    $goldar = $user['kd_goldar'];
                }
                ?>
                <option value="<?= $user['kd_goldar'] ?>"><?= $goldar ?></option>
                <option value="A">A</option>
                <option value="B">B</option>
                <option value="AB">AB</option>
                <option value="O">O</option>
            </select>
        </div>
        <div class="col-lg-3">
            <label for="">Agama</label>
            <select name="agama" id="agama" class="form-control">
                <option value="<?= $user['kd_agama'] ?>"><?= $user['agm'] ?></option>
                <?php
                foreach ($agama as $a) :
                ?>
                    <option value="<?= $a['kd_agama'] ?>"><?= $a['agama'] ?></option>
                <?php
                endforeach;
                ?>
            </select>
            <?= form_error('agama', ' <small class="text-danger pl-3">', '</small>'); ?>
        </div>
        <div class="col-lg-3">
            <label for="">Status</label>
            <select name="status" id="status" class="form-control">
                <option value="<?= $user['kd_status'] ?>"><?= $user['st'] ?></option>
                <?php
                foreach ($status as $s) :
                ?>
                    <option value="<?= $s['kd_status'] ?>"><?= $s['status'] ?></option>
                <?php
                endforeach;
                ?>
            </select>
            <?= form_error('status', ' <small class="text-danger pl-3">', '</small>'); ?>
        </div>
    </div>
    <hr>
    <h5>Kontak</h5>
    <div class="row">
        <div class="col-lg-3">
            <label for="">No HP</label>
            <input type="number" name="hp" id="hp" value="<?= $user['hp'] ?>" class="form-control">
            <?= form_error('hp', ' <small class="text-danger pl-3">', '</small>'); ?>
        </div>
        <div class="col-lg-3">
            <label for="">Email</label>
            <input type="email" name="email" id="email" value="<?= $user['email'] ?>" class="form-control">
            <?= form_error('email', ' <small class="text-danger pl-3">', '</small>'); ?>
        </div>
    </div>

    <hr>
    <h5>Alamat KTP</h5>
    <div class="row">
        <div class="col-lg-3">
            <label for="">Provinsi</label>
            <select name="ktp_prov" id="ktp_prov" class="form-control">
                <option value="<?= $user['kd_alamat_prov'] ?>"><?= $user['pr'] ?></option>
                <?php
                foreach ($prov as $p) :
                ?>
                    <option value="<?= $p['id_prov'] ?>"><?= $p['nama'] ?></option>
                <?php
                endforeach;
                ?>
            </select>
            <?= form_error('ktp_prov', ' <small class="text-danger pl-3">', '</small>'); ?>
        </div>
        <div class="col-lg-3">
            <label for="">Kab/Kota</label>
            <select name="ktp_kota" id="ktp_kota" class="form-control">
                <option value="<?= $user['kd_alamat_kota'] ?>"><?= $user['kb'] ?></option>
            </select>
            <?= form_error('ktp_kota', ' <small class="text-danger pl-3">', '</small>'); ?>
        </div>
        <div class="col-lg-3">
            <label for="">Kecamatan</label>
            <select name="ktp_kec" id="ktp_kec" class="form-control">
                <option value="<?= $user['kd_alamat_kec'] ?>"><?= $user['kc'] ?></option>
            </select>
            <?= form_error('ktp_kec', ' <small class="text-danger pl-3">', '</small>'); ?>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-3">
            <label for="">Kelurahan</label>
            <select name="ktp_kel" id="ktp_kel" class="form-control">
                <option value="<?= $user['kd_alamat_kel'] ?>"><?= $user['kel'] ?></option>
            </select>
            <?= form_error('ktp_kel', ' <small class="text-danger pl-3">', '</small>'); ?>
        </div>
        <div class="col-lg-3">
            <label for="">RW</label>
            <input type="number" name="rw" id="rw" class="form-control" value="<?= $user['alamat_rw'] ?>">
            <?= form_error('rw', ' <small class="text-danger pl-3">', '</small>'); ?>
        </div>
        <div class="col-lg-3">
            <label for="">RT</label>
            <input type="number" name="rt" id="rt" class="form-control" value="<?= $user['alamat_rt'] ?>">
            <?= form_error('rt', ' <small class="text-danger pl-3">', '</small>'); ?>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <label for="">Alamat KTP</label>
            <textarea name="alamat" id="alamat" cols="30" rows="4" class="form-control"><?= $user['alamat'] ?></textarea>
            <?= form_error('alamat', ' <small class="text-danger pl-3">', '</small>'); ?>
        </div>
    </div>
    <hr>
    <h5>Alamat Domisili</h5>
    <div class="row">
        <div class="col-lg-3">
            <label for="">Provinsi</label>
            <select name="dom_prov" id="dom_prov" class="form-control">
                <option value="<?= $user['kd_dom_prov'] ?>"><?= $dom['domprov'] ?></option>
                <?php
                foreach ($prov as $p) :
                ?>
                    <option value="<?= $p['id_prov'] ?>"><?= $p['nama'] ?></option>
                <?php
                endforeach;
                ?>

            </select>
            <?= form_error('dom_prov', ' <small class="text-danger pl-3">', '</small>'); ?>
        </div>
        <div class="col-lg-3">
            <label for="">Kab/Kota</label>
            <select name="dom_kab" id="dom_kab" class="form-control">
                <option value="<?= $user['kd_dom_kota'] ?>"><?= $dom['domkab'] ?></option>
            </select>
            <?= form_error('dom_kab', ' <small class="text-danger pl-3">', '</small>'); ?>
        </div>
        <div class="col-lg-3">
            <label for="">Kecamatan</label>
            <select name="dom_kec" id="dom_kec" class="form-control">
                <option value="<?= $user['kd_dom_kec'] ?>"><?= $dom['domkec'] ?></option>
            </select>
            <?= form_error('dom_kec', ' <small class="text-danger pl-3">', '</small>'); ?>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-3">
            <label for="">Kelurahan</label>
            <select name="dom_kel" id="dom_kel" class="form-control">
                <option value="<?= $user['kd_dom_kel'] ?>"><?= $dom['domkel'] ?></option>
            </select>
            <?= form_error('dom_kel', ' <small class="text-danger pl-3">', '</small>'); ?>
        </div>
        <div class="col-lg-3">
            <label for="">RW</label>
            <input type="number" name="dom_rw" id="dom_rw" class="form-control" value="<?= $user['dom_rw'] ?>">
            <?= form_error('dom_rw', ' <small class="text-danger pl-3">', '</small>'); ?>
        </div>
        <div class="col-lg-3">
            <label for="">RT</label>
            <input type="number" name="dom_rt" id="dom_rt" class="form-control" value="<?= $user['dom_rt'] ?>">
            <?= form_error('dom_rt', ' <small class="text-danger pl-3">', '</small>'); ?>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <label for="">Alamat Domisili</label>
            <textarea name="domisili" id="domisili" cols="30" rows="4" class="form-control"><?= $user['dom_alamat'] ?></textarea>
            <?= form_error('domisili', ' <small class="text-danger pl-3">', '</small>'); ?>
        </div>
    </div>
    <style>
        .img-thumbnail {
            width: 350px;
            height: 200px;
        }
    </style>




    <button type="submit" class="btn btn-success mt-3">Selesai</button>
    <a href="<?= base_url('user/edituser') ?>" class="btn btn-danger mt-3">Kembali</a>
    </form>
</div>