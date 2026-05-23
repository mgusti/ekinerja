<div class="container-fluid">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= base_url('aset')?>">Barang</a></li>
            <li class="breadcrumb-item"><a href="<?= base_url('aset/subbarang/') . $kode?>">Detail Barang</a></li>
            
            <li class="breadcrumb-item active" aria-current="page">Input Detail Barang</li>
            
        </ol>
    </nav>
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
    <div class="flash-data" data-flashdata="<?= $this->session->flashdata('messege');?>"></div>
    <div class="eror" data-flashdata="<?= $this->session->flashdata('eror');?>"></div>


    <form action="<?= base_url('aset/simpansubbarang/') . $kode?>" method="post" class="needs-validation" novalidate>
        <div class="row">
            <div class="col-lg-2">
                <label for="">Jumlah Barang</label>
                <input type="number" name="jumlah" id="jumlah" class="form-control" required value="1">
                    <div class="valid-feedback">
                        Looks good!
                    </div>
                    <div class="invalid-feedback">
                        tidak boleh kosong
                    </div>
            </div>
            <div class="col-lg-3">
                <label for="">Kode Barang</label>
                <input type="text" name="kdbarang" id="kdbarang" class="form-control" value="<?= $barang['kdbarang']?>" readonly>

            </div>
            <div class="col-lg-3">
                <label for="">Nama Barang</label>
                <input type="text" name="nmbarang" id="nmbarang" class="form-control" value="<?= $barang['nmbarang']?>" readonly>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3">
                <label for="">Ruangan</label>
                <select name="ruang" id="ruang" class="form-control" required>
                    <option value="">-pilih-</option>
                    <?php
                        foreach($ruang as $r):
                    ?>
                    <option value="<?= $r['kdruang']?>"><?= $r['nmruang']?></option>
                    <?php
                        endforeach;
                    ?>
                </select>
                    <div class="valid-feedback">
                        Looks good!
                    </div>
                    <div class="invalid-feedback">
                        Pilih salah satu
                    </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3">
                <label for="">Kondisi</label>
                <select name="kondisi" id="kondisi" class="form-control" required>
                    <option value="">-pilih-</option>
                    <?php
                        foreach($kondisi as $k):
                    ?>
                        <option value="<?= $k['kdkondisi']?>"><?= $k['namakondisi']?></option>
                    <?php
                        endforeach;
                    ?>
                </select>
                    <div class="valid-feedback">
                        Looks good!
                    </div>
                    <div class="invalid-feedback">
                        pilih salah satu
                    </div>
            </div>
            <div class="col-lg-3">
                <label for="">Nilai Barang</label>
                <input type="number" name="nilai" id="nilai" class="form-control" required>
                    <div class="valid-feedback">
                        Looks good!
                    </div>
                    <div class="invalid-feedback">
                        tidak boleh kosong
                    </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-2">
                <label for="">Tahun Anggaran</label>
                <input type="number" name="tahun" id="tahun" class="form-control" value="<?= date('Y')?>" required>
                    <div class="valid-feedback">
                        Looks good!
                    </div>
                    <div class="invalid-feedback">
                        tidak boleh kosong
                    </div>
            </div>
            <div class="col-lg-3">
                <label for="">Jenis Anggaran</label>
                <select name="jenis" id="jenis" class="form-control" required>
                    <option value="">-pilih-</option>
                    <?php
                        foreach($anggaran as $a):
                    ?>
                        <option value="<?= $a['jenisanggaran']?>"><?= $a['jenisanggaran']?></option>
                    <?php
                        endforeach;
                    ?>
                </select>
                    <div class="valid-feedback">
                        Looks good!
                    </div>
                    <div class="invalid-feedback">
                        pilih salah satu
                    </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3">
                <label for="">Tgl Registrasi Barang</label>
                <input type="text" name="tglmasuk" id="tglmasuk" class="form-control" data-provide="datepicker" data-date-format="yyyy-mm-dd" required>
                    <div class="valid-feedback">
                        Looks good!
                    </div>
                    <div class="invalid-feedback">
                        tidak boleh kosong
                    </div>
            </div>

            <div class="col-lg-3">
                <label for="">Tgl Distribusi Barang</label>
                <input type="text" name="tgldis" id="tgldis" class="form-control" data-provide="datepicker" data-date-format="yyyy-mm-dd" required>
                    <div class="valid-feedback">
                        Looks good!
                    </div>
                    <div class="invalid-feedback">
                        tidak boleh kosong
                    </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <label for="">Keterangan</label>
                <input type="text" name="keterangan" id="keterangan" class="form-control">
            </div>
        </div>
        <button type="submit" class="btn btn-success simpan mt-3">Simpan</button>
        <a href="<?= base_url('aset/subbarang/') . $kode?>" class="btn btn-danger kembali mt-3">Kembali</a>
    </form>

</div>