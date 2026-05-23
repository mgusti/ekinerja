<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800"><?= $title;  ?></h1>
    <div class="flash-data" data-flashdata="<?= $this->session->flashdata('messege'); ?>"></div>
    <div class="eror" data-flashdata="<?= $this->session->flashdata('eror'); ?>"></div>

    <?php echo form_open_multipart('user/edituser'); ?>
    <div class="displai1">
        <div class="row">
            <div class="col-lg-3">
                <label for="">Nik</label>
                <input type="number" class="form-control" name="nik" value="<?= $user['nik'] ?>" id="nik">
                <?= form_error('nik', ' <small class="text-danger pl-3">', '</small>'); ?>
            </div>
            <div class="col-lg-3">
                <label for="">NIP </span></label>
                <input type="number" class="form-control" name="nip" value="<?= $user['nip'] ?>" id="nip">

            </div>
            <div class="col-lg-3">
                <label for="">Nama User</label>
                <input type="text" class="form-control" name="name" value="<?= $user['nama'] ?>" id="name">
                <?= form_error('name', ' <small class="text-danger pl-3">', '</small>'); ?>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3">
                <label for="">Ruangan</label>
                <input type="text" class="form-control" value="<?= $user['nama_ruangan'] ?>" readonly>
            </div>
            <div class="col-lg-3">
                <label for="">Jabatan</label>
                <input type="text" class="form-control" value="<?= $user['nama_jabatan'] ?>" readonly>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-lg-4">
                <label for="">Foto Profile</label><br>
                <img src="<?= base_url('assets/img/profile/') . $user['image'] ?>" class="img-thumbnail" alt="gambar" id="gmbr"><br>
                <small class="text-danger">besar ukuran foto tidak boleh lebih dari 2MB</small><br>
                <small class="text-danger">(Format Foto jpg/jpeg/png)</small>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <div class="custom-file">
                    <input type="file" class="custom-file-input" id="image" name="image" accept="image/*" onchange="document.getElementById('gmbr').src = window.URL.createObjectURL(this.files[0])">
                    <label class="custom-file-label" for="image">Pilih Gambar</label>
                </div>
            </div>
        </div>



        <style>
            .img-thumbnail {
                width: 200px;
                height: 200px;
            }
        </style>


        <button type="submit" class="btn btn-success mt-3">Next</button>
        <a href="<?= base_url('user/index') ?>" class="btn btn-danger mt-3">Batal</a>
    </div>

    </form>
</div>