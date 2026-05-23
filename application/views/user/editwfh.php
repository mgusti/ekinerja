<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800"><?= $title ?></h1>
    <div class="flash-data" data-flashdata="<?= $this->session->flashdata('messege'); ?>"></div>
    <div class="eror" data-flashdata="<?= $this->session->flashdata('eror'); ?>"></div>

    <?php echo form_open_multipart('user/inputwfh'); ?>
    <div class="row">
        <div class="col-lg-3">
            <label for="">Tanggal Kerja <span>*</span></label>
            <input type="text" name="tglkerja" id="tglkerja" class="form-control" data-provide="datepicker" data-date-format="yyyy-mm-dd" required autocomplete="off">
        </div>
        <div class="col-lg-3">
            <label for="">Bidang <span>*</span></label>
            <select name="bidang" id="bidang" class="form-control" required autocomplete="off">
                <option value="">-Pilih-</option>
                <?php
                foreach ($bidang as $b) :
                ?>
                    <option value="<?= $b['id_bidang'] ?>"><?= $b['bidang'] ?></option>
                <?php
                endforeach;
                ?>
            </select>
        </div>
    </div>
    <style>
        .img-thumbnail {
            width: 200px;
            height: 200px;
        }
    </style>
    <div class="row mt-3">
        <div class="col-lg-4">
            <label for="">Screen Shoot Pekerjaan <span><small>* (ukuran foto max 2mb format jpg)</small></span></label>
            <div class="custom-file">
                <input type="file" class="custom-file-input" id="gmbr" name="gmbr" accept="image/*" required>
                <label class="custom-file-label" for="gmbr">Pilih Gambar</label>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-5">
            <label for="">Keterangan Kerja <span>*</span></label>
            <textarea name="ket" id="ket" cols="30" rows="3" class="form-control" required></textarea>
        </div>
    </div>

    <button type="submit" class="btn btn-success mt-3">Simpan</button>
    <a href="<?= base_url('user/datawfh') ?>" class="btn btn-danger mt-3">Kembali</a>
    </form>
</div>