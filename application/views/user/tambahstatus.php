<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800"><?= $title;  ?></h1>

    <?= $this->session->flashdata('messege'); ?>

    <form action="" method="post">
        <div class="row">
            <div class="col-lg-3">
                <label for="">Bidang</label>
                <input type="text" name="bidang" id="bidang" class="form-control" value="<?= $user['bdg'] ?>" readonly>

            </div>
            <div class="col-lg-3" hidden>
                <label for="">id Bidang</label>
                <input type="text" name="idbidang" id="idbidang" class="form-control" value="<?= $user['id_bidang'] ?>" readonly>

            </div>
            <div class="col-lg-3">
                <label for="">Sub Bidang</label>
                <select name="subbidang" id="subbidang" class="form-control">
                    <option value="">-Pilih-</option>
                </select>
                <?= form_error('subbidang', ' <small class="text-danger pl-3">', '</small>'); ?>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-2">
                <label for="">Tahun Mulai Bekerja</label>
                <input type="number" min="1900" max="2099" step="1" value="<?= date('yy') ?>" class="form-control" name="tahun_mulai">
                <?= form_error('tahun_mulai', ' <small class="text-danger pl-3">', '</small>'); ?>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-2">
                <label for="">Status Karyawan</label>
                <select name="status" id="status" class="form-control">
                    <option value="">-Pilih-</option>
                    <option value="PNS">PNS</option>
                    <option value="TKK">TKK</option>
                    <option value="PHL">PHL</option>
                </select>
                <?= form_error('status', ' <small class="text-danger pl-3">', '</small>'); ?>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4">
                <label for="">No BPJS Ketenagakerjaan</label>
                <input type="number" name="bpjs_ket" id="bpjsket" class="form-control" value="">
                <?= form_error('bpjs_ket', ' <small class="text-danger pl-3">', '</small>'); ?>
            </div>
            <div class="col-lg-4">
                <label for="">No Rekening</label>
                <input type="number" name="no_rek" id="norek" class="form-control" value="">
                <?= form_error('no_rek', ' <small class="text-danger pl-3">', '</small>'); ?>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3">
                <label for="">Gaji Pokok</label>
                <input type="number" name="gaji" id="gaji" class="form-control" value="">
                <?= form_error('gaji', ' <small class="text-danger pl-3">', '</small>'); ?>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-5">
                <label for="">Deskripsi Pekerjaan</label>
                <textarea name="pekerjaan" id="pekerjaan" cols="10" rows="5" class="form-control"></textarea>
                <?= form_error('gaji', ' <small class="text-danger pl-3">', '</small>'); ?>
            </div>
        </div>

        <button type="submit" class="btn btn-success mt-3">Simpan/Edit</button>
        <a href="<?= base_url('user') ?>" class="btn btn-danger mt-3">Kembali</a>
    </form>
</div>