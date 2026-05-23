<div class="container">
  <!-- Outer Row -->
  <div class="row justify-content-center">
    <div class="col-lg-7">
      <div class="card o-hidden border-0 shadow-lg my-5 bg-gradient-light" data-aos="flip-left">
        <div class="card-body p-0">
          <!-- Nested Row within Card Body -->
          <div class="row">
            <div class="col-lg">
              <div class="p-5">
                <div class="text-center">
                  <h4>Login E-Kinerja</h4>

                </div>
                <div class="flash-data" data-flashdata="<?= $this->session->flashdata('messege'); ?>"></div>
                <div class="eror" data-flashdata="<?= $this->session->flashdata('eror'); ?>"></div>
                <div class="erlog" data-flashdata="<?= $this->session->flashdata('erlog'); ?>"></div>
                <form class="user" method="post" action="<?= base_url('auth '); ?>">
                  <div class="form-group">
                    <input type="text" class="form-control form-control-user" id="username" name="username" placeholder="Masukan Username Anda" value="<?= set_value('username'); ?>">
                    <?= form_error('username', ' <small class="text-danger pl-3">', '</small>'); ?>
                  </div>
                  <div class="form-group">
                    <input type="password" class="form-control form-control-user" id="password" name="password" placeholder="Password">
                    <?= form_error('password', ' <small class="text-danger pl-3">', '</small>'); ?>
                  </div>
                  <button type="submit" class="btn btn-success btn-user btn-block">
                    LOGIN
                  </button>
                  <a href="<?= base_url('auth/registration/') ?>" class="btn btn-primary btn-user btn-block">DAFTAR AKUN (PNS)</a>
                </form>
                <hr>
                <ul class="list-inline text-center">
                  <li class="list-inline-item"><img src="<?= base_url('assets/img/logo.png') ?>" width="80" alt="lgo"></li>
                  <li class="list-inline-item">
                    <h4><strong>RSUD H. Abdul Manap</strong></h4>
                  </li>

                </ul>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


<!-- Button trigger modal -->
<button type="button" class="btn btn-primary notif" data-toggle="modal" data-target="#exampleModalLong" hidden id="notif">
  modal informasi
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Informasi</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <h4>Update v1.1</h4>
        <ul>
          <li>Perbaikan table data user pada admin control</li>
          <li>perbaikan pada profil user</li>
          <li>penambahan role akses untuk kepala bidang</li>
          <li>pemecahan sub bidang</li>

        </ul>

        <ul class="text-danger">
          <h5>
            catatan
          </h5>
          <li>Diharapkan melengkapi Data pada profil, di tombol Edit pada Menu Profil</li>
          <li>Diharapkan Menggunakan google crome</li>
          <li>Diharapkan buka aplikasi menggunakan pc/komputer/laptop, tidak disarankan menggunakan hp/mobile</li>
          <li>Jika menggunakan hp/mobile disarankan layar landscape </li>
        </ul>


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

      </div>
    </div>
  </div>
</div>