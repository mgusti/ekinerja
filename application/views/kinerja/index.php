<div class="container-fluid">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= base_url('kinerja') ?>">kinerja</a></li>

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
            <button type="button" class="btn btn-success mb-3" data-toggle="modal" data-target="#exampleModal">
                <i class="fa fa-plus">Tambah</i>
            </button>
            <button type="button" class="btn btn-info float-right" data-toggle="modal" data-target="#exampleModalLong">
                <i class="fa fa-book"> Panduan</i>
            </button>

            <div class="card">
                <div class="card-body">
                    <form action="" method="post">
                        <div class="row">
                            <div class="col-12">
                                <label for="">Bulan</label>
                                <select name="bulan" id="bulan" class="form-control" required>
                                    <option value="">-Pilih-</option>
                                    <option value="01">Januari</option>
                                    <option value="02">Februari</option>
                                    <option value="03">Maret</option>
                                    <option value="04">April</option>
                                    <option value="05">Mei</option>
                                    <option value="06">Juni</option>
                                    <option value="07">Juli</option>
                                    <option value="08">Agustus</option>
                                    <option value="09">September</option>
                                    <option value="10">Oktober</option>
                                    <option value="11">November</option>
                                    <option value="12">Desember</option>
                                </select>
                            </div>
                            <div class="col-12">
                                <label for="tahun">Tahun</label>
                                <input type="number" name="tahun" id="tahun" class="form-control" value="<?= date('Y') ?>">
                            </div>
                        </div>

                        <button type="submit" class="btn btn-danger mt-3"><i class="fa fa-search"> Cari</i></button>
                    </form>
                </div>
            </div>
            <table class="table table-striped table-bordered table-responsive-sm " id="example">
                <thead class="text-center">
                    <tr>
                        <th>No.</th>
                        <th>Tgl</th>
                        <th>Deskripsi Pekerjaan</th>
                        <th>Edit</th>
                        <th>Hapus</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    foreach ($kinerja as $k) :

                    ?>
                        <tr>
                            <th><?= $i++ ?></th>
                            <td><?= $k['tgl'] ?></td>
                            <td><?= $k['deskripsi'] ?></td>
                            <td class="text-center">
                                <a href="<?= base_url('kinerja/editkinerja/') . $k['kode_kinerja'] ?>" class="btn btn-warning"><i class="fa fa-edit"></i></a>

                            </td>
                            <td class="text-center">
                                <a href="<?= base_url('kinerja/delkinerja/') . $k['kode_kinerja'] ?>" class="btn btn-danger hapus"><i class="fa fa-trash"></i></a>
                            </td>

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
                <h5 class="modal-title" id="exampleModalLabel">Input Data Kinerja</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('kinerja/inpkinerja') ?>" method="post">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                            <input type="date" name="tgl" id="tgl" class="form-control" placeholder="Tanggal Kerja" required>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                            <textarea name="deskripsi" id="deskripsi" cols="30" rows="10" class="form-control" placeholder="Deskripsi Pekerjaan" required></textarea>
                        </div>
                    </div>
                    <div class="row" hidden>
                        <input type="text" name="user_id" id="user_id" class="form-control" value="<?= $user['id_user'] ?>">
                    </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary mt-3" data-dismiss="modal">Close</button><br>
                <button type="submit" class="btn btn-primary mt-3">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Panduan Modul Kinerja</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <ol>
                        <li>Panduan Input Data Kinerja</li>
                        <p>
                        <ul>
                            <li>klik tombol <button class="btn btn-success disabled"><i class="fa fa-plus"></i> Tambah</button></li>
                            <li>Lalu Inputkan Tanggal Kerja dan deskripsi pekerjaan </li>
                            <li>Cukup input data 1x sehari</li>
                            <li>Jika libur atau cuti, input tanggal dan deskripsi libur atau cuti</li>
                            <li>Lalu tekan tombol <button class="btn btn-primary disabled">Simpan</button></li>
                            <li>contoh data lihat gambar <span class="text-danger">(klik gambar untuk melihat)</span></li>
                            <p><a href="<?= base_url('assets/img/panduan/contoh.jpg') ?>" target="_blank"><img src="<?= base_url('assets/img/panduan/contoh.jpg') ?>" alt="gmbr" class="img-fluid"></a></p>
                        </ul>
                        </p>
                        <li>Panduan Pencarian Data Kinerja</li>
                        <p>
                        <ul>
                            <li>Pilih bulan</li>
                            <li>klik tombol <button class="btn btn-danger disabled"><i class="fa fa-search"> Cari</i></button></li>
                        </ul>
                        </p>
                        <li>Untuk Edit dan Hapus</li>
                        <ul>
                            <li>Jika ingin mengedit atau menghapus data, bisa menggunakan tombol Edit dan Hapus</li>
                            <li>Tombol Terletak disebelah kanan table</li>

                        </ul>

                    </ol>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

            </div>
        </div>
    </div>
</div>