<style>
    @media print {


        .title-container {

            float: left;

        }

        .gmbrr {

            max-height: 200px;
        }


    }

    .gmbrr {

        height: 200px;
    }
</style>
<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800"><?= $title ?></h1>
    <div class="flash-data" data-flashdata="<?= $this->session->flashdata('messege'); ?>"></div>
    <div class="eror" data-flashdata="<?= $this->session->flashdata('eror'); ?>"></div>

    <button class="btn btn-danger float-right" onclick="printDiv('printableArea')">Print</button>
    <form action="" method="post">
        <div class="row">
            <div class="col-lg-3">
                <label for="">Bidang</label>
                <select name="bidang" id="bidang" class="form-control">
                    <option value="">-pilih-</option>
                    <?php
                    foreach ($bidang as $b) :
                    ?>
                        <option value="<?= $b['id_bidang'] ?>"><?= $b['bidang'] ?></option>
                    <?php
                    endforeach;
                    ?>
                </select>
            </div>
        </div>
        <button type="submit" class="btn btn-success mt-3">Cari</button>
    </form>
    <div id="printableArea">
        <div class="row mt-3 ">

            <?php
            foreach ($hasil as $h) :

            ?>
                <div class="col-xs-3 col-ms-3 col-sm-3 col-md-3 title-container">
                    <div class="card " style="max-width: 18rem;">
                        <img src="<?= base_url('assets/img/wfh/') . $h['img'] ?>" class="card-img-top d-flex justify-content-center gmbrr" alt="gmb">
                        <div class="card-body">
                            <h5 class="card-title text-center"><?= $h['nm'] ?></h5>
                            <p class="card-text"><?= $h['keterangan'] ?></p>

                        </div>
                    </div>
                </div>
            <?php
            endforeach;
            ?>
        </div>
    </div>




</div>