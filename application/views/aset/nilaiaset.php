<div class="container-fluid">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
        <li class="breadcrumb-item active" aria-current="page"><?= $title; ?></li>
        </ol>
    </nav>
    <h1 class="h3 mb-2 text-gray-800">Aset Masuk Per Tahun</h1>
    <div class="flash-data" data-flashdata="<?= $this->session->flashdata('messege');?>"></div>
    <div class="eror" data-flashdata="<?= $this->session->flashdata('eror');?>"></div>
    <a href="<?= base_url('aset/laprekapruang')?>" class="btn btn-danger mt-3" target="_blank"><i class="fa fa-print" aria-hidden="true"></i> Cetak</a>
    <div class="table-responsive mt-3">
        <table class="table table-striped table-bordered" id="example">
            <thead class="text-center">
                <tr>
                    
                    <th scope="col">Tahun</th>
                    <th scope="col" >Jumlah Barang Baik</th>
                    <th scope="col" >Nilai Barang Baik</th>
                    <th scope="col" >Jumlah Barang Kurang Baik</th>
                    <th scope="col" >Nilai Barang Kurang Baik</th>
                    <th scope="col" >Jumlah Barang Rusak</th>
                    <th scope="col" >Nilai Barang Rusak</th>
                    
                </tr>
                
            </thead>
            <tbody>
                <?php
                    foreach($tahun as $t):
                ?>
               
                <tr>
                    <td class="text-center"><?= $t['thn_anggaran']?></td>
                    <td class="text-center"><?= $t['baik']?></td>
                    <td>Rp. <?= number_format($t['nilaibaik'],2,',','.')?></td>
                    <td class="text-center"><?= $t['sedang']?></td>
                    <td> Rp. <?= number_format($t['nilaisedang'],2,',','.')?></td>
                    <td class="text-center"><?= $t['rusak']?></td>
                    <td> Rp. <?= number_format($t['nilairusak'],2,',','.')?></td>
                  
                </tr>
               <?php
                endforeach;
               ?>
            </tbody>
        </table>
    </div>
</div>

