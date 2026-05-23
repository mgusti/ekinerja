<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800"><?= $title ?></h1>
    <div class="flash-data" data-flashdata="<?= $this->session->flashdata('messege'); ?>"></div>
    <div class="eror" data-flashdata="<?= $this->session->flashdata('eror'); ?>"></div>

    <a href="<?= base_url('admin/forminputuser') ?>" class="btn btn-primary mt-3 mb-3">Tambah</a>
    <a href="<?= base_url('admin/cetakuser') ?>" class="btn btn-danger float-right mt-3 mb-3" target="_blank"><i class="fa fa-print">Cetak</i></a>
    <div class="card">
        <div class="card-body">
            <table class="table table-bordered table-striped table-responsive" id="example">
                <thead>
                    <tr>
                        <th>foto</th>
                        <th>ID ABSEN</th>
                        <th>NIK</th>
                        <th>NIP</th>
                        <th>NAMA</th>
                        <th>STATUS</th>
                        <th>HP</th>
                        <th>USERNAME</th>
                        <th>JABATAN</th>
                        <th>RUANGAN</th>
                        <th>NO. KONTRAK</th>
                        <th>UPAH</th>
                        <th>ROLE AKSESS</th>
                        <th>AKTIFASI</th>
                        <th>HAPUS</th>
                        <th>EDIT</th>
                        <th>R - PASSWORD</th>

                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($karyawan as $k) :
                        if ($k['is_active'] == '1') {
                            $a = 'AKTIF';
                            $b = 'NON AKTIF';
                            $text = 'success';
                        } else {
                            $a = 'NON AKTIF';
                            $b = 'AKTIF';
                            $text = 'danger';
                        }

                        if ($k['beda_pns'] == 1) {
                            $st = 'PNS';
                        } else if ($k['beda_pns'] == 2) {
                            $st = "TKK";
                        } else {
                            $st = "uknown";
                        }
                    ?>
                        <tr>
                            <td><a href="<?= base_url('assets/img/profile') ?>" onClick="window.open('<?= base_url('assets/img/profile/') . $k['image'] ?>','kinerja','resizable,height=800,width=600'); return false;">Lihat</a></td>
                            <td><?= $k['id_absen'] ?></td>
                            <td><?= $k['nik'] ?></td>
                            <td><?= $k['nip'] ?></td>
                            <td><?= $k['nama'] ?></td>
                            <td><?= $st ?></td>
                            <td><?= $k['hp'] ?></td>
                            <td><a href="<?= base_url('admin/edituser/') . $k['id_user'] ?>"><?= $k['username'] ?></a></td>
                            <td><?= $k['nama_jabatan'] ?></td>
                            <td><?= $k['nama_ruangan'] ?></td>
                            <td><?= $k['nomor_kontrak'] ?></td>
                            <td><?= $k['upah'] ?></td>
                            <td><?= $k['rr'] ?></td>
                            <td class="text-<?= $text ?>"><?= $a ?></td>
                            <td>
                                <a href="<?= base_url('admin/hapususer/') . $k['id_user'] ?>" class="btn btn-danger hapus">Hapus</a>
                            </td>
                            <td>
                                <a href="<?= base_url('admin/editaktif/') . $k['is_active'] . '/' . $k['id_user'] ?>" class="btn btn-warning"><?= $b ?></a>
                            </td>
                            <td>
                                <a href="<?= base_url('admin/rpassword/') . $k['id_user'] ?>" class="btn btn-info reset">R-Password</a>
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