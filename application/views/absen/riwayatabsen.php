<div class="container-fluid">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href=""><?= $title; ?></a></li>


        </ol>
    </nav>

    <div class="card mb-3">

        <div class="card-body">
            <div class="flash-data" data-flashdata="<?= $this->session->flashdata('messege'); ?>"></div>
            <div class="eror" data-flashdata="<?= $this->session->flashdata('eror'); ?>"></div>
            <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#exampleModal">
                <i class="fa fa-plus"> Upload</i>
            </button>


            <table class="table table-striped table-bordered table-responsive-md ex">
                <thead class="text-center">
                    <tr>
                        <th>No.</th>
                        <th>Bulan</th>
                        <th>tahun</th>
                        <th>download</th>


                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    foreach ($riwayat as $r) :
                    ?>
                        <tr>
                            <td><?= $i++ ?></td>
                            <td><?= $r['bulan'] ?></td>
                            <td><?= $r['tahun'] ?></td>
                            <td><a href="<?= base_url('assets/pdf/') . $r['pdf'] ?>" class="btn btn-danger">Download</a></td>
                        </tr>
                    <?php
                    endforeach;
                    ?>
                </tbody>

            </table>
        </div>
    </div>
</div>



<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Input Absen</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php echo form_open_multipart('absensi/iriwayatabsen'); ?>
                <div class="row">
                    <div class="col-lg-12">
                        <label for="">Bulan</label>
                        <select name="bulan" id="bulan" class="form-control" required>
                            <option value="">-Pilih-</option>
                            <?php
                            foreach ($bulan  as $b) :
                            ?>
                                <option value="<?= $b['nama_bulan'] ?>"><?= $b['nama_bulan'] ?></option>
                            <?php
                            endforeach;
                            ?>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <label for="">tahun</label>
                        <input type="number" name="tahun" id="tahun" class="form-control" value="<?= date('Y') ?>">
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <label for="">Upload Riwayat</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="doc" name="doc" accept="application/pdf">
                            <label class="custom-file-label" for="image">Pilih Document</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary"> Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>