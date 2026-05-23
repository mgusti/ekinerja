<div class="container-fluid">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
        <li class="breadcrumb-item active" aria-current="page">Barang</li>
            
        </ol>
    </nav>
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
    <div class="flash-data" data-flashdata="<?= $this->session->flashdata('messege');?>"></div>
    <div class="eror" data-flashdata="<?= $this->session->flashdata('eror');?>"></div>
    
    
    <a href="<?= base_url('aset/tbarang')?>" class="btn btn-primary mb-4"><i class="fa fa-plus" aria-hidden="true"></i> Tambah</a>

    <div class="table-responsive">
        <table class="table table-striped table-bordered" id="example">
            <thead class="text-center">
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Kode Barang</th>
                    <th scope="col">Nama Barang</th>
                    <th scope="col">Jenis Barang</th>
                    <th scope="col">Ukuran</th>
                    <th scope="col">Bahan</th>
                    <th scope="col">Merk</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i=1;
                    foreach($barang as $b):
                ?>
                <tr>
                    <th scope="row"><?= $i++;?></th>
                    <td><a href="<?= base_url('aset/subbarang/') . $b['kdbarang']?>" class="badge badge-success"><?= $b['kdbarang']?></a></td>
                    <td><?= $b['nmbarang']?></td>
                    <td><?= $b['jenisbarang']?></td>
                    <td><?= $b['ukuran']?></td>
                    <td><?= $b['bahan']?></td>
                    <td><?= $b['merk']?></td>
                    <td class="text-center">
                        <a href="<?= base_url('aset/dbarang/') . $b['kdbarang'] ?>" class="btn badge-danger hapus"><i class="fa fa-trash" aria-hidden="true"></i></a>
                        <a href="<?= base_url('aset/ebarang/') . $b['kdbarang']?>" class="btn badge-warning"><i class="fa fa-edit"></i></a>
                    </td>
                    
                </tr>
                <?php
                    endforeach;
                ?>
            </tbody>
        </table>
    </div>
</div>