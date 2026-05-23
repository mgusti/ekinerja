<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800"><?= $title;  ?></h1>

    <?= $this->session->flashdata('messege'); ?>

    <?php echo form_open_multipart('user/editkk'); ?>
    <div class="row">
        <div class="col-lg-4">
            <label for="">Nomor KK</label>
            <input type="number" name="nokk" id="nokk" class="form-control" value="<?= $nok['nokk'] ?>">
            <?= form_error('nokk', ' <small class="text-danger pl-3">', '</small>'); ?>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-3">
            <label for="">Status KK</label>
            <select name="statuskk" id="statuskk" class="form-control">
                <option value="<?= $nok['statuskk'] ?>"><?= $nok['statuskk'] ?></option>
                <option value="Kepala Keluarga">Kepala Keluarga</option>
                <option value="Istri">Istri</option>
                <option value="Anak">Anak</option>
                <option value="Lainnya">Lainnya</option>
            </select>
        </div>
    </div>

    <style>
        .img-thumbnail {
            width: 350px;
            height: 200px;
        }
    </style>
    <div class="row mt-3">
        <div class="col-lg-4">
            <label for="">Upload KTP</label><br>
            <img src="<?= base_url('assets/img/kk/') . $nok['fotokk'] ?>" class="img-thumbnail" alt="gambar" id="gmbr"><br>
            <small class="text-danger">besar ukuran KTP tidak boleh lebih dari 2MB</small><br>
            <small class="text-danger">Format Foto jpg atau png</small><br>
            <small class="text-danger">Scan Asli Tidak fotocopy</small>
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

    <button class="btn btn-success mt-3">Selesai</button>
    <a href="<?= base_url('user/editktp') ?>" class="btn btn-danger mt-3">Kembali</a>
    </form>

</div>