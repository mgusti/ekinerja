<div class="container-fluid">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
        <li class="breadcrumb-item active" aria-current="page">Inventaris</li>
            
        </ol>
    </nav>
    <h1 class="h3 mb-2 text-gray-800"><?= $title; ?></h1>
    <h4 >Ruangan : <?= $ruang['nmruang']?></h4>
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
                    <th scope="col">Kondisi</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i=1;
                    foreach($barang as $b):
                        if($b['nmkondisi']=='Baik'){
                            $kon = 'text-primary';
                        }else if($b['nmkondisi']=='Kurang Baik'){
                            $kon = 'text-warning';
                        }else{
                            $kon = 'text-danger';
                        }
                ?>
                <tr>
                    <th scope="row"><?= $i++;?></th>
                    <td><?= $b['kdbarang']?>.<?= $b['thn_anggaran']?>.<?= $b['kdsub']?></td>
                    <td><?= $b['nama']?></td>
                    <td><?= $b['jenisbarang']?></td>
                    <td class="<?= $kon?>"><?= $b['nmkondisi']?></td>
                    
                    <td class="text-center">
                        
                        <a href="<?= base_url('inventaris/einvent/') . $b['kdsub']?>" class="btn badge-warning"><i class="fa fa-edit"></i></a>
                    </td>
                    
                </tr>
                <?php
                    endforeach;
                ?>
            </tbody>
        </table>
    </div>
</div>