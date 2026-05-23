<div class="container-fluid">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= base_url('aset')?>">Barang</a></li>
            <li class="breadcrumb-item active" aria-current="page">Input Barang</li>
            
        </ol>
    </nav>
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
    <?= $this->session->flashdata('messege'); ?>

    <form action="<?= base_url('aset/ibarang')?>" method="post" class="needs-validation" novalidate>
        <div class="row">
            <div class="col-lg-3">
                <label for="">Kode Barang <small>*</small></label>
                <input type="text" name="kode" id="kode" class="form-control" required minlength="3" maxlength="20">
                    <div class="valid-feedback">
                        Looks good!
                    </div>
                    <div class="invalid-feedback">
                        minimal karakter 3 digit, dan maximal 20 digit, dan pastikan kode tidak boleh sama
                    </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3">
                <label for="">Nama Barang <small>*</small></label>
                <input type="text" name="nama" id="nama" class="form-control" required minlength="3" maxlength="20">
                    <div class="valid-feedback">
                        Looks good!
                    </div>
                    <div class="invalid-feedback">
                        minimal karakter 3 digit, dan maximal 50 digit
                    </div>
            </div>
            <div class="col-lg-3">
                <label for="">Jenis Barang <small>*</small></label>
                <select name="jenis" id="jenis" class="form-control" required>
                    <option value="">-pilih-</option>
                    <?php
                        foreach($jenis as $j):
                    ?>
                        <option value="<?= $j['jenisaset']?>"><?= $j['jenisaset']?></option>
                    <?php
                        endforeach;
                    ?>
                </select>
                <div class="valid-feedback">
                        Looks good!
                    </div>
                    <div class="invalid-feedback">
                        Jensi barang harus dipilih
                    </div>
            </div>
            
        </div>
        <div class="row">
            <div class="col-lg-3">
                <label for="">Ukuran</label>
                <input type="text" name="ukuran" id="ukuran" class="form-control">
            </div>
            <div class="col-lg-3">
                <label for="">Bahan</label>
                <input type="text" name="bahan" id="bahan" class="form-control">
            </div>
            <div class="col-lg-3">
                <label for="">Merk</label>
                <input type="text" name="merk" id="merk" class="form-control">
            </div>
        </div>
    <button type="submit" class="btn btn-success mt-3">Simpan</button>
    <a href="<?= base_url('aset')?>" class="btn btn-danger kembali mt-3">Kembali</a>
    </form>
</div>