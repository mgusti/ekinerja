<div class="container">

	<?= $this->session->flashdata('messege'); ?>
	<!-- Page Heading -->
	<h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>


	<div class="flash-data" data-flashdata="<?= $this->session->flashdata('messege'); ?>"></div>
	<div class="eror" data-flashdata="<?= $this->session->flashdata('eror'); ?>"></div>
	<div class="main-body">


		<div class="row gutters-sm">
			<div class="col-md-4 mb-3">
				<div class="card bg-gradient-light">
					<div class="card-body">
						<div class="d-flex flex-column align-items-center text-center">
							<img src="<?= base_url('assets/img/profile/') . $user['image'] ?>" alt="Admin" class="rounded-circle" width="150" height="150">
							<div class="mt-3">
								<h2><?= $user['nama'] ?></h2>
								<small class="text-dark"><?= $user['nip'] ?></small>
								<p class="text-secondary mb-1"><?= $user['nama_ruangan'] ?></p>
								<p class="text-muted font-size-sm"><?= $user['nama_jabatan'] ?></p>
								<div class="d-flex flex-row">
									<div class="p-2"><a href="<?= base_url('user/edituser') ?>" class="btn btn-warning">Edit Profile</a></div>
									<div class="p-2"><a href="<?= base_url('user/gantipassword') ?>" class="btn btn-outline-danger">Reset Password</a></div>

								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="card mt-3">
					<div class="card-header">
						<h6 class="d-flex align-items-center mb-3"><i class="material-icons text-info mr-2">Data</i>Kontak</h6>
					</div>
					<div class="card-body">
						<div class="row">
							<div class="col-sm-3">
								<h6 class="mb-0">Email</h6>
							</div>
							<div class="col-sm-9 text-secondary">
								<?= $user['email'] ?>
							</div>
						</div>
						<hr>
						<div class="row">
							<div class="col-sm-3">
								<h6 class="mb-0">HP</h6>
							</div>
							<div class="col-sm-9 text-secondary">
								<?= $user['hp'] ?>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-8">
				<div class="card mb-3">
					<div class="card-header">
						<h6 class="d-flex align-items-center mb-3"><i class="material-icons text-info mr-2">Data</i>KTP</h6>
					</div>
					<div class="card-body">
						<div class="row">
							<div class="col-sm-3">
								<h6 class="mb-0">Nama</h6>
							</div>
							<div class="col-sm-9 text-secondary">
								<?= $user['nama'] ?>
							</div>
						</div>
						<hr>
						<div class="row">
							<div class="col-sm-3">
								<h6 class="mb-0">Tempat/ Tgl Lahir</h6>
							</div>
							<div class="col-sm-9 text-secondary">
								<?= $user['tempat_lahir'] ?>, <?= $user['tgl_lahir'] ?>
							</div>
						</div>
						<hr>
						<?php
						if ($user['kd_jenkel'] == 'L') {
							$kelamin = 'Laki-Laki';
							$ico = 'fa fa-male';
						} else if ($user['kd_jenkel'] == 'P') {
							$kelamin = 'Perempuan';
							$ico = 'fa fa-female';
						} else {
							$kelamin = "";
							$ico = '';
						}
						?>
						<div class="row">
							<div class="col-sm-3">
								<h6 class="mb-0">Jenis kelamin</h6>
							</div>
							<div class="col-sm-9 text-secondary">
								<?= $kelamin ?>
							</div>
						</div>
						<hr>
						<div class="row">
							<div class="col-sm-3">
								<h6 class="mb-0">Golongan Darah</h6>
							</div>
							<div class="col-sm-9 text-secondary">
								<?= $user['kd_goldar'] ?>
							</div>
						</div>
						<hr>
						<div class="row">
							<div class="col-sm-3">
								<h6 class="mb-0">Agama</h6>
							</div>
							<div class="col-sm-9 text-secondary">
								<?= $user['agama'] ?>
							</div>
						</div>
						<hr>
						<div class="row">
							<div class="col-sm-3">
								<h6 class="mb-0">Status Nikah</h6>
							</div>
							<div class="col-sm-9 text-secondary">
								<?= $user['st'] ?>
							</div>
						</div>
						<hr>

					</div>
				</div>

				<div class="row gutters-sm">
					<div class="col-sm-6 mb-3">
						<div class="card h-100">
							<div class="card-header">
								<h6 class="d-flex align-items-center mb-3"><i class="material-icons text-info mr-2">Data</i>Alamat</h6>
							</div>
							<div class="card-body">

								<div class="row">
									<div class="col-sm-3">
										<h6 class="mb-0">Alamat KTP</h6>
									</div>
									<div class="col-sm-9 text-secondary">
										<?= $user['alamat'] ?>
									</div>
								</div>
								<hr>
								<div class="row">
									<div class="col-sm-3">
										<h6 class="mb-0">Alamat Domisili</h6>
									</div>
									<div class="col-sm-9 text-secondary">
										<?= $user['dom_alamat'] ?>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-sm-6 mb-3">
						<div class="card h-100">
							<div class="card-header">
								<h6 class="d-flex align-items-center mb-3"><i class="material-icons text-info mr-2">Data</i>Insentif tahun <?= date('Y') ?></h6>
							</div>
							<div class="card-body">
								<div class="d-flex justify-content-center">
									<div class="row">
										<h1>Update Berikutnya</h1><br>
										<h5>harap bersabar...!!</h5>
										<!-- <table class="table table-striped table-bordered table-responsive table-lg ">
											<thead>
												<tr>
													<th>Bulan</th>
													<th>Tahun</th>
													<th>Insentif</th>
												</tr>
											</thead>
											<tbody>
												<tr>
													<td>Mei</td>
													<td>2021</td>
													<td>Rp. 50.000</td>
												</tr>
											</tbody>
										</table> -->
									</div>
								</div>

							</div>
						</div>
					</div>
				</div>



			</div>
		</div>

	</div>
</div>