<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
    <?= $this->session->flashdata('messege'); ?>

    <div class="row">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Jumlah TKK</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $tkk ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-user fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Jumlah Peninjau</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $peninjau ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-user-tie fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-6 col-md-6 mb-6 col-12 col-lg-12">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="row no-gutters align-items-center">
                    <div class="col-12 col-sm-12 col-md-12 col-xl-12">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1 text-center mt-3">Jumlah TKK Berdasarkan Ruangan</div>
                    </div>
                    <div class="col-12 col-md-12 col-lg-12 col-sm-12 col-xl-12 ">
                        <div class="card-body">
                            <table class="table table-responsive-sm table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>NO.</th>
                                        <th>Ruangan</th>
                                        <th>Jumlah TKK</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 1;
                                    foreach ($group_tkk as $g) :

                                    ?>
                                        <tr>
                                            <th><?= $i++ ?></th>
                                            <th><?= $g['ns'] ?></th>
                                            <th><?= $g['total'] ?></th>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>