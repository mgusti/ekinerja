<div class="container">

    <div class="row mt-3">
        <div class="col-md-6">

            <div class="card">
                <div class="card-header">
                    Form Ubah Data Menu
                </div>
                <div class="card-body">
                    <form action="" method="post">
                        <input type="hidden" name="id" value="<?= $menu['id']; ?>">
                        <div class="form-group">
                            <label for="menu">Menu</label>
                            <input type="text" name="menu" class="form-control" id="menu" value="<?= $menu['menu']; ?>">
                            <small class="form-text text-danger"><?= form_error('menu'); ?></small>
                        </div>

                        <button type="submit" name="ubah" class="btn btn-primary float-right">Ubah Data</button>
                    </form>
                </div>
            </div>


        </div>
    </div>

</div>