<div class="container-fluid">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
        <li class="breadcrumb-item active" aria-current="page">Rekap</li>
        </ol>
    </nav>
    <h1 class="h3 mb-2 text-gray-800"><?= $title; ?></h1>
    <div class="flash-data" data-flashdata="<?= $this->session->flashdata('messege');?>"></div>
    <div class="eror" data-flashdata="<?= $this->session->flashdata('eror');?>"></div>
    <a href="<?= base_url('aset/laprekapruang')?>" class="btn btn-danger mt-3" target="_blank"><i class="fa fa-print" aria-hidden="true"></i> Cetak</a>
    <div class="table-responsive mt-3">
        <table class="table table-striped table-bordered" id="example">
            <thead class="text-center">
                <tr>
                    <th scope="col" >No</th>
                    <th scope="col" >Ruangan</th>
                    <th scope="col" >baik</th>
                    <th scope="col" >Kurang Baik</th>
                    <th scope="col" >Rusak</th>
                    <th scope="col" >Total Barang</th>
                    <th scope="col" >Total Nilai Barang</th>
                    
                </tr>
                
            </thead>
            <tbody>
                <?php
                $i=1;
                    foreach($barang as $b):
                        
                ?>
                <tr>
                    <th scope="row"><?= $i++;?></th>
                    <td> <?= $b['nmruangan']?></td>
                    <td> <?= $b['baik']?></td>
                    <td> <?= $b['sedang']?></td>
                    <td> <?= $b['rusak']?></td>
                    <td> <?= $b['toba']?></td>
                    <td>Rp. <?= number_format($b['totnil'],2,',','.')?></td>
                    
                    
                </tr>
                <?php
                    endforeach;
                ?>
            </tbody>
        </table>
    </div>
</div>