<div class="container">

<div class="card o-hidden border-0 shadow-lg my-5 col-lg-7 mx-auto">
  <div class="card-body p-0">
    <!-- Nested Row within Card Body -->
    <div class="row">
      <div class="col-lg">
        <div class="p-5">
          <div class="text-center">
            <h1 class="h4 text-gray-900 mb-4">Daftar Akun Untuk PNS</h1>
          </div>
          <form class="user" method="post" action="<?= base_url('auth/registration'); ?>">
            <div class="form-group">
              <label for="name">Nama Lengkap</label>
              <input type="text" class="form-control " id="name" name="name" value="<?= set_value('name'); ?>">
              <?= form_error('name', ' <small class="text-danger pl-3">', '</small>'); ?>
            </div>
            <div class="form-group">
              <label for="nik">NIK KTP</label>
              <input type="number" class="form-control " id="nik" name="nik" value="<?= set_value('nik'); ?>">
              <?= form_error('nik', ' <small class="text-danger pl-3">', '</small>'); ?>
            </div>
            <div class="form-group">
              <label for="nip">NIP</label>
              <input type="number" class="form-control " id="nip" name="nip" value="<?= set_value('nip'); ?>">
              <?= form_error('nip', ' <small class="text-danger pl-3">', '</small>'); ?>
            </div>
            <div class="form-group">
              <label for="">Username untuk Login</label>
              <input type="text" class="form-control" id="username" name="username" placeholder="username Login" value="<?= set_value('username'); ?>">
              <?= form_error('username', ' <small class="text-danger pl-3">', '</small>'); ?>
            </div>
            <div class="form-group row">
              <div class="col-sm-12 col-lg-12 col-md-12  ">
                <label for="">Jabatan</label>
                <select name="jabatan" id="jabatan" class=" form-control ">
                  <option value="">-Pilih-</option>
                  <?php
                  foreach ($jabatan as $j) :
                  ?>
                    <option value="<?= $j['kd_jabatan'] ?>"><?= $j['nama_jabatan'] ?></option>
                  <?php
                  endforeach;
                  ?>
                </select>
                <?= form_error('jabatan', ' <small class="text-danger pl-3">', '</small>'); ?>
              </div>
            </div>
            <div class="form-group row">
              <div class="col-sm-12 col-lg-12 col-md-12  ">
                <label for="">Ruangan</label>
                <select name="ruangan" id="ruangan" class=" form-control ">
                  <option value="">-Pilih-</option>
                  <?php
                  foreach ($ruangan as $r) :
                  ?>
                    <option value="<?= $r['kd_ruangan'] ?>"><?= $r['nama_ruangan'] ?></option>
                  <?php
                  endforeach;
                  ?>
                </select>
                <?= form_error('ruangan', ' <small class="text-danger pl-3">', '</small>'); ?>
              </div>
            </div>

            <div class="form-group row">
              <div class="col-sm-6 mb-3 mb-sm-0">
                <label for="">Password</label>
                <input type="password" class="form-control " id="password" name="password" placeholder="Password">
                <?= form_error('password', ' <small class="text-danger pl-3">', '</small>'); ?>
              </div>
              <div class="col-sm-6">
                <label for="">Ulangi Password</label>
                <input type="password" class="form-control " id="cpassword" name="cpassword" placeholder="Ulangi Password">
                <?= form_error('cpassword', ' <small class="text-danger pl-3">', '</small>'); ?>
              </div>
            </div>

            <button type="submit" class="btn btn-success btn-user btn-block">
              Daftar Akun
            </button>

            <div class="text-center">
              <a class="small" href="<?= base_url('auth'); ?>">Sudah Memiliki Akun? Login!</a>
            </div>
        </div>
      </div>
    </div>
  </div>
</div>

</div>