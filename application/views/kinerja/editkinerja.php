<div class="container-fluid">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= base_url('kinerja') ?>">kinerja</a></li>
            <li class="breadcrumb-item">Edit Kinerja</li>

        </ol>
    </nav>

    <div class="card mb-3">
        <div class="card-header">
            <h3 class="card-title"><?= $title; ?></h3>
        </div>
        <div class="card-body">
            <div class="flash-data" data-flashdata="<?= $this->session->flashdata('messege'); ?>"></div>
            <div class="eror" data-flashdata="<?= $this->session->flashdata('eror'); ?>"></div>
            <!-- Button trigger modal -->
            <a href="<?= base_url('kinerja') ?>" class="btn btn-danger mt-3 mb-3 kembali"><i class="fa fa-arrow-left"> Kembali</i></a>

            <form action="<?= base_url('kinerja/ekinerja/') . $kin['kode_kinerja'] ?>" method="post">
                <div class="row">
                    <div class="col-lg-4 col-md-4 col-sm-12 col-12">
                        <label for="">Tanggal Kerja</label>
                        <input type="date" name="tgl" id="tgl" class="form-control" value="<?= $kin['tgl'] ?>" required>
                    </div>

                </div>
                <div class="row mt-3">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                        <label for="">deskripsi Pekerjaan</label>
                        <textarea name="deskripsi" id="deskripsi" cols="30" rows="10" class="form-control" required><?= $kin['deskripsi'] ?></textarea>
                    </div>
                </div>
                <button type="submit" class="btn btn-warning edit mt-3">Edit</button>
            </form>

        </div>
    </div>
</div>