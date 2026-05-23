<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800"><?= $title;  ?></h1>

    <?= $this->session->flashdata('messege'); ?>
    <?php echo form_open_multipart('user/editpendidikan'); ?>
    <div class="row">
        <div class="col-lg-3">
            <label for="">Jenjang Pendidikan</label>
            <select name="jenjang" id="jenjang" class="form-control">
                <?php
                if ($pendi['jenjang'] == 1) {
                    $p = 'SD';
                } else if ($pendi['jenjang'] == 2) {
                    $p = 'SMP';
                } else if ($pendi['jenjang'] == 3) {
                    $p = 'SMA';
                } else if ($pendi['jenjang'] == 4) {
                    $p = 'S1';
                } else if ($pendi['jenjang'] == 5) {
                    $p = 'S2';
                } else if ($pendi['jenjang'] == 6) {
                    $p = 'S3';
                }
                ?>
                <option value="<?= $pendi['jenjang'] ?>"><?= $p ?></option>
                <option value="1">SD</option>
                <option value="2">SMP</option>
                <option value="3">SMA</option>
                <option value="4">S1</option>
                <option value="5">S2</option>
                <option value="6">S3</option>
            </select>
        </div>
        <div class="col-lg-4">
            <label for="">Nama Lembaga Pendidikan</label>
            <input type="text" name="lembaga" id="lembaga" class="form-control" value="<?= $pendi['nama_lembaga'] ?>">
        </div>
    </div>
    <div class="row">
        <div class="col-lg-2">
            <label for="">Tahun Masuk</label>
            <input type="number" name="masuk" id="masuk" class="form-control" value="<?= $pendi['tahun_masuk'] ?>">
        </div>
        <div class="col-lg-2">
            <label for="">Tahun Selesai</label>
            <input type="number" name="selesai" id="selesai" class="form-control" value="<?= $pendi['tahun_selesai'] ?>">
        </div>

    </div>
    <div class="row">
        <div class="col-lg-3">
            <label for="">Jurusan</label>
            <input type="text" name="jurusan" id="jurusan" class="form-control" value="<?= $pendi['jurusan'] ?>">
        </div>
    </div>
    <style>
        .img-thumbnail {
            width: 400px;
            height: 300px;
        }
    </style>
    <div class="row mt-3">
        <div class="col-lg-4">
            <label for="">Upload Ijazah</label><br>
            <img src="<?= base_url('assets/img/ijazah/') . $pendi['fotoijazah'] ?>" class="img-thumbnail" alt="gambar" id="gmbr"><br>
            <small class="text-danger">besar ukuran Ijazah tidak boleh lebih dari 2MB</small><br>
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
    <button class="btn btn-warning mt-3 mb-3">Edit</button>
    <a href="<?= base_url('user') ?>" class="btn btn-danger">Kembali</a>
    </form>
</div>