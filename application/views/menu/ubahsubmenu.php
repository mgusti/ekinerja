<div class="container">

    <div class="row mt-3">
        <div class="col-md-6">

            <div class="card">
                <div class="card-header">
                    Form Ubah Data Sub Menu
                </div>
                <div class="card-body">
                    <form action="" method="post">
                        <input type="hidden" name="id" value="<?= $subMenu['id']; ?>">
                        <div class="form-group">
                            <label for="menu">Sub Menu</label>
                            <input type="text" name="title" class="form-control" id="title" value="<?= $subMenu['title']; ?>">
                            <small class="form-text text-danger"><?= form_error('title'); ?></small>
                        </div>
                        <div class="form-group">
                            <label for="menu">Menu</label>
                            <input type="text" name="menu_id" class="form-control" id="menu_id" value="<?= $subMenu['menu_id']; ?>">
                            <small class="form-text text-danger"><?= form_error('menu_id'); ?></small>
                        </div>
                        <div class="form-group">
                            <label for="menu">Url</label>
                            <input type="text" name="url" class="form-control" id="url" value="<?= $subMenu['url']; ?>">
                            <small class="form-text text-danger"><?= form_error('url'); ?></small>
                        </div>
                        <div class="form-group">
                            <label for="menu">Icon</label>
                            <input type="text" name="icon" class="form-control" id="icon" value="<?= $subMenu['icon']; ?>">
                            <small class="form-text text-danger"><?= form_error('icon'); ?></small>
                        </div>
                        <div class="form-group">
                            <label for="menu">Active</label>
                            <input type="text" name="is_active" class="form-control" id="is_active" value="<?= $subMenu['is_active']; ?>">
                            <small class="form-text text-danger"><?= form_error('is_active'); ?></small>
                        </div>

                        <button type="submit" name="ubah" class="btn btn-primary float-right">Ubah Data</button>
                    </form>
                </div>
            </div>


        </div>
    </div>

</div>