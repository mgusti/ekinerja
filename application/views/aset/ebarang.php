<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
    <div class="flash-data" data-flashdata="<?= $this->session->flashdata('messege');?>"></div>

    <form action="<?= base_url('aset/editbarang/') . $barang['kdbarang']?>" method="post" class="needs-validation" novalidate>
        <div class="row">
            <div class="col-lg-3">
                <label for="">Kode Barang <small>*</small></label>
                <input type="text" name="kode" id="kode" class="form-control" required minlength="3" maxlength="20" value="<?= $barang['kdbarang']?>" readonly>
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
                <input type="text" name="nama" id="nama" class="form-control" required minlength="3" maxlength="20" value="<?= $barang['nmbarang']?>">
                    <div class="valid-feedback">
                        Looks good!
                    </div>
                    <div class="invalid-feedback">
                        minimal karakter 3 digit, dan maximal 50 digit
                    </div>
            </div>
            <div class="col-lg-3">
                <label for="">Jenis Barang</label>
                <select name="jenis" id="jenis" class="form-control" required>
                    <option value="<?= $barang['jenisbarang']?>"><?= $barang['jenisbarang']?></option>
                    <option value="alkes">Alkes</option>
                </select>
                <div class="valid-feedback">
                        Looks good!
                    </div>
                    <div class="invalid-feedback">
                        Jensi barang harus dipilih
                    </div>
            </div>
            <div class="col-lg-3">
                <label for="">Ukuran</label>
                <input type="text" name="ukuran" id="ukuran" class="form-control" value="<?= $barang['ukuran']?>">
            </div>
            <div class="col-lg-3">
                <label for="">Bahan</label>
                <input type="text" name="bahan" id="bahan" class="form-control" value="<?= $barang['bahan']?>">
            </div>
            <div class="col-lg-3">
                <label for="">Merk</label>
                <input type="text" name="merk" id="merk" class="form-control" value="<?= $barang['merk']?>">
            </div>
        </div>
    <button type="submit" class="btn btn-warning mt-3">Edit</button>
    <a href="<?= base_url('aset')?>" class="btn btn-danger kembali mt-3">Kembali</a>
    </form>
</div>