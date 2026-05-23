<div class="container-fluid">
    <h1 class="h3 mb-4 mt-4 text-gray-800"><?= $title; ?></h1>
    <?= $this->session->flashdata('messege'); ?>

    <form action="<?= base_url('user/gantipassword')?>" method="post">
        <div class="row">
            <div class="col-lg-3">
                <label for="passlama">Password Lama</label>
                <input type="password" name="passlama" id="passlama" class="form-control" value="<?= set_value('passlama'); ?>">
                <?= form_error('passlama', ' <small class="text-danger pl-3">', '</small>'); ?>
            </div>
        </div>
        <div class="row">
        <div class="col-lg-3">
                <label for="passbaru">Password Baru</label>
                <input type="password" name="passbaru" id="passbaru" class="form-control" value="<?= set_value('passbaru'); ?>">
                <?= form_error('passbaru', ' <small class="text-danger pl-3">', '</small>'); ?>
            </div>
            <div class="col-lg-3">
                <label for="ulangpass">Ulang Password</label>
                <input type="password" name="ulangpass" id="ulangpass" class="form-control">
                <?= form_error('ulangpass', ' <small class="text-danger pl-3">', '</small>'); ?>
            </div>
        </div>
        <button type="submit" class="btn btn-primary mt-3">Ganti Password</button>
        <a href="<?= base_url('user')?>" class="btn btn-danger mt-3">Kembali</a>
    </form>
</div>