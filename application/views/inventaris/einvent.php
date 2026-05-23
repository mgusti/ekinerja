<div class="container-fluid">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?= base_url('inventaris')?>">Inventaris</a></li>
        <li class="breadcrumb-item active" aria-current="page">Edit Kondisi</li>
            
        </ol>
    </nav>
    <h1 class="h3 mb-2 text-gray-800"><?= $title; ?></h1>
    
    <div class="flash-data" data-flashdata="<?= $this->session->flashdata('messege');?>"></div>
    <div class="eror" data-flashdata="<?= $this->session->flashdata('eror');?>"></div>

    <form action="<?= base_url('inventaris/ekon/' . $kon['kdsub'])?>" method="post">
        <div class="row">
            <div class="col-lg-3">
                <label for="">Kondisi</label>
                <select name="kondisi" id="kondisi" class="form-control">
                    <option value="<?= $kon['kondisi']?>"><?= $kon['namakondisi']?></option>
                    <?php
                        foreach ($kondisi as $i):
                    ?>
                    <option value="<?= $i['kdkondisi']?>"><?= $i['namakondisi']?></option>
                    <?php
                        endforeach;
                    ?>
                </select>
            </div>
        </div>
        <button type="submit" class="btn btn-warning mt-3">Edit</button>
        <a href="<?= base_url('inventaris')?>" class="btn btn-danger kembali mt-3">Kembali</a>
    </form>
</div>