<div class="container-fluid">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= base_url('aset')?>">Barang</a></li>
            <li class="breadcrumb-item active" aria-current="page">Detail Barang</li>
            
        </ol>
    </nav>
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
    <div class="flash-data" data-flashdata="<?= $this->session->flashdata('messege');?>"></div>
    <div class="eror" data-flashdata="<?= $this->session->flashdata('eror');?>"></div>
<a href="<?= base_url('aset/isubbarang/') . $kode?>" class="btn btn-primary mb-3"><i class="fa fa-plus" aria-hidden="true"></i> Tambah</a>
<a href="<?= base_url('aset/dallsubbarang/') . $kode ?>" class="btn btn-danger hapus mb-3 float-right"><i class="fa fa-trash " aria-hidden="true"></i> Hapus semua Data</a>
    <div class="table-responsive">
        <table class="table table-striped table-bordered" id="example">
            <thead class="text-center">
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Sub</th>
                    <th scope="col">Nama Barang</th>
                    <th scope="col">Ruangan Lokasi Barang</th>
                    <th scope="col">Kondisi</th>
                    <th scope="col">Nilai (Rp.)</th>
                    <th scope="col">Tahun Anggaran</th>
                    <th scope="col">Jenis Anggaran</th>
                    <th scope="col">Tgl Registrasi Barang</th>
                    <th scope="col">Tgl Distribusi Barang</th>
                    <th scope="col">Aksi</th>

                </tr>
            </thead>
            <tbody>
                <?php
                $i=1;
                    foreach($sub as $b):

                        if($b['namakondisi'] == 'Baik'){
                            $text = 'text-primary';
                        }else if($b['namakondisi'] == 'Kurang Baik'){
                            $text = 'text-warning';
                        }else{
                            $text = 'text-danger';
                        }
                ?>
                
                <tr>
                    <th scope="row"><?= $i++;?></th>
                    <td><?= $b['kdsub']?></td>
                    <td><?= $b['nama']?></td>
                    <td><?= $b['ruangan']?></td>
                    <td class="<?= $text?>"><?= $b['namakondisi']?></td>
                    <td><?= $b['nilai_barang']?></td>
                    <td><?= $b['thn_anggaran']?></td>
                    <td><?= $b['jenis_anggaran']?></td>
                    <td><?= $b['tgl_masuk']?></td>
                    <td><?= $b['tgl_distribusi']?></td>
                    <td class="text-center">
                        <a href="<?= base_url('aset/dsubbarang/') . $b['kdsub'] . '/' . $b['kdbarang'] ?>" class="badge badge-danger hapus"><i class="fa fa-trash" aria-hidden="true"></i></a>
                        <a href="<?= base_url('aset/esubbarang/') . $b['kdsub']?>" class="badge badge-warning"><i class="fa fa-edit"></i></a>
                    </td>
                    
                </tr>
                <?php
                    endforeach;
                ?>
            </tbody>
        </table>
        
    </div>
</div>