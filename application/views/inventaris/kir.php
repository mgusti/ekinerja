<div class="container-fluid">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?= base_url('inventaris')?>">Inventaris</a></li>
        <li class="breadcrumb-item active" aria-current="page">KIR</li>
        </ol>
    </nav>
    <h1 class="h3 mb-2 text-gray-800"><?= $title; ?></h1>
    <h4 >Ruangan : <?= $ruang['nmruang']?><a href="<?= base_url('inventaris/lapkir')?>" class="btn btn-danger mb-3 float-right" target="_blank"><i class="fa fa-print" aria-hidden="true"></i> Cetak</a></h4>
    
    <div class="flash-data" data-flashdata="<?= $this->session->flashdata('messege');?>"></div>
    <div class="eror" data-flashdata="<?= $this->session->flashdata('eror');?>"></div>

    <div class="table-responsive mt-3">
        <table class="table table-striped table-bordered" id="example">
            <thead class="text-center">
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Kode</th>
                    <th scope="col">Nama Barang</th>
                    <th scope="col">Jenis Barang</th>
                    <th scope="col">Thn Anggaran</th>
                    <th scope="col">Jenis Anggaran</th>
                    <th scope="col">Nilai Satuan Barang</th>
                    <th scope="col">Baik</th>
                    <th scope="col">Kurang Baik</th>
                    <th scope="col">Rusak</th>
                    <th scope="col">Jumlah Barang</th>
                    <th scope="col">Total Nilai Barang</th>
                    
                </tr>
            </thead>
            <tbody>
                <?php
                $i=1;
                    foreach($barang as $b):

                    $total = $b['nilai_barang'] * $b['toba'];
                ?>
                <tr>
                    <th scope="row"><?= $i++;?></th>
                    <td><?= $b['kdbarang']?></td>
                    <td><?= $b['nama']?></td>
                    <td><?= $b['jenisbarang']?></td>
                    <td><?= $b['thn_anggaran']?></td>
                    <td><?= $b['jenis_anggaran']?></td>
                    <td>Rp. <?= number_format($b['nilai_barang'],2,',','.')?></td>
                    <td class="text-primary"><?= $b['baik']?></td>
                    <td class="text-warning"><?= $b['sedang']?></td>
                    <td class="text-danger"><?= $b['rusak']?></td>
                    <td><?= $b['toba']?></td>
                    <td>Rp.<?= number_format($total,2,',','.')?></td>
                    
                </tr>
                <?php
                    endforeach;
                ?>
            </tbody>
        </table>
    </div>
    
</div>