<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();

		is_logged_in();
		$this->load->library('form_validation');
	}
	public function index()
	{
		$data['title'] = 'My Profile';
		// $data['users'] = $this->db->get_where('user', ['id_user' => $this->session->userdata('id_user')])->row_array();

		$this->db->select('*, user.image as gmbr, user.nama as nama, agama.agama as agm, status_nikah.status as st,provinsi.nama as pr, kabupaten.nama as kb,kecamatan.nama as kc, kelurahan.nama as kel');
		$this->db->from('user');

		$this->db->join('jabatan', 'jabatan.kd_jabatan = user.kd_jabatan', 'left');
		$this->db->join('ruangan', 'ruangan.kd_ruangan = user.kd_ruangan', 'left');
		$this->db->join('agama', 'agama.kd_agama = user.kd_agama', 'left');
		$this->db->join('status_nikah', 'status_nikah.kd_status = user.kd_status', 'left');
		$this->db->join('provinsi', 'provinsi.id_prov = user.kd_alamat_prov', 'left');
		$this->db->join('kabupaten', 'kabupaten.id_kab = user.kd_alamat_kota', 'left');
		$this->db->join('kecamatan', 'kecamatan.id_kec = user.kd_alamat_kec', 'left');
		$this->db->join('kelurahan', 'kelurahan.id_kel = user.kd_alamat_kel', 'left');
		$this->db->where('user.id_user', $this->session->userdata('id_user'));
		$data['user'] = $this->db->get()->row_array();
		//
		$this->db->select('*, provinsi.nama as domprov, kabupaten.nama as domkab, kecamatan.nama as domkec, kelurahan.nama as domkel');
		$this->db->from('user');
		$this->db->join('provinsi', 'provinsi.id_prov = user.kd_dom_prov');
		$this->db->join('kabupaten', 'kabupaten.id_kab = user.kd_dom_kota');
		$this->db->join('kecamatan', 'kecamatan.id_kec = user.kd_dom_kec');
		$this->db->join('kelurahan', 'kelurahan.id_kel = user.kd_dom_kel');
		$this->db->where('user.username', $this->session->userdata('username'));
		$data['dom'] = $this->db->get()->row_array();
		$data['role'] = $this->db->get_where('user_role', ['id' => $this->session->userdata('role_id')])->row_array();

		$this->db->select('*, bidang.bidang as bdg, subbidang.nama_subbidang as sub ');
		$this->db->from('status_karyawan');
		$this->db->join('bidang', 'bidang.id_bidang = status_karyawan.id_bidang');
		$this->db->join('subbidang', 'subbidang.id_subbidang = status_karyawan.id_subbidang');
		$data['status'] = $this->db->get()->row_array();

		$this->load->view('temp/header', $data);
		$this->load->view('temp/sidebar', $data);
		$this->load->view('temp/topbar', $data);
		$this->load->view('user/index', $data);
		$this->load->view('temp/footer');
	}


	public function edituser()
	{
		$data['title'] = 'Edit User Akun';
		//$data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
		$this->db->select('*');
		$this->db->from('user');
		$this->db->join('ruangan', 'ruangan.kd_ruangan = user.kd_ruangan', 'left');
		$this->db->join('jabatan', 'jabatan.kd_jabatan = user.kd_jabatan', 'left');
		$this->db->where('user.username', $this->session->userdata('username'));
		$data['user'] = $this->db->get()->row_array();


		$this->form_validation->set_rules('name', 'name', 'required|trim');
		$this->form_validation->set_rules('nik', 'nik', 'required|trim');



		if ($this->form_validation->run() == false) {
			$this->load->view('temp/header', $data);
			$this->load->view('temp/sidebar', $data);
			$this->load->view('temp/topbar', $data);
			$this->load->view('user/edituser', $data);
			$this->load->view('temp/footer');
		} else {

			$uploadimg = $_FILES['image']['name'];
			if ($uploadimg) {
				$config['upload_path'] = './assets/img/profile';
				$config['allowed_types'] = 'jpg|png|jpeg';
				$config['max_size']     = '2000'; //artinya 2mb 

				$this->load->library('upload', $config);

				if ($this->upload->do_upload('image')) {

					$lama = $data['user']['image'];
					if ($lama != 'default.jpg') {
						unlink(FCPATH . 'assets/img/profile/' . $lama);
					}
					$new_image = $this->upload->data('file_name');
					$this->db->set('image', $new_image);
				} else {
					$this->session->set_flashdata('eror', 'periksa lagi ukuran foto dan format foto, harus sesuai ketentuan');
					redirect('user/edituser');
				}
			}

			$ktp = $data['user']['ktp'];
			if ($ktp == "") {
				$this->db->set('ktp', 'ktp.png');
			}
			$this->db->set('nama', $this->input->post('name'));
			$this->db->set('nik', $this->input->post('nik'));
			$this->db->set('nip', $this->input->post('nip'));


			$this->db->where('username', $this->session->userdata('username'));
			$this->db->update('user');
			$this->session->set_flashdata('messege', 'Diupdate, lanjut update KTP');
			redirect('user/editktp');
			$this->load->view('temp/header', $data);
			$this->load->view('temp/sidebar', $data);
			$this->load->view('temp/topbar', $data);
			$this->load->view('user/edituser', $data);
			$this->load->view('temp/footer');
		}
	}

	public function editktp()
	{
		$data['title'] = 'Edit User Profil';
		//$data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
		$this->db->select('*, agama.agama as agm, status_nikah.status as st,provinsi.nama as pr, kabupaten.nama as kb,kecamatan.nama as kc, kelurahan.nama as kel');
		$this->db->from('user');
		$this->db->join('bidang', 'bidang.id_bidang = user.id_bidang');
		$this->db->join('agama', 'agama.kd_agama = user.kd_agama');
		$this->db->join('status_nikah', 'status_nikah.kd_status = user.kd_status');
		$this->db->join('provinsi', 'provinsi.id_prov = user.kd_alamat_prov');
		$this->db->join('kabupaten', 'kabupaten.id_kab = user.kd_alamat_kota');
		$this->db->join('kecamatan', 'kecamatan.id_kec = user.kd_alamat_kec');
		$this->db->join('kelurahan', 'kelurahan.id_kel = user.kd_alamat_kel');
		$this->db->where('user.username', $this->session->userdata('username'));
		$data['user'] = $this->db->get()->row_array();
		//
		$this->db->select('*, provinsi.nama as domprov, kabupaten.nama as domkab, kecamatan.nama as domkec, kelurahan.nama as domkel');
		$this->db->from('user');
		$this->db->join('provinsi', 'provinsi.id_prov = user.kd_dom_prov');
		$this->db->join('kabupaten', 'kabupaten.id_kab = user.kd_dom_kota');
		$this->db->join('kecamatan', 'kecamatan.id_kec = user.kd_dom_kec');
		$this->db->join('kelurahan', 'kelurahan.id_kel = user.kd_dom_kel');
		$this->db->where('user.username', $this->session->userdata('username'));
		$data['dom'] = $this->db->get()->row_array();
		//

		$this->db->select('*');
		$this->db->from('agama');
		$this->db->where_not_in('kd_agama', 0);
		$data['agama'] = $this->db->get()->result_array();
		//
		$this->db->select('*');
		$this->db->from('status_nikah');
		$this->db->where_not_in('kd_status', 0);
		$data['status'] = $this->db->get()->result_array();
		//
		$data['prov'] = $this->db->get('provinsi')->result_array();

		//

		$this->form_validation->set_rules('tempat', 'tempat', 'required|trim', [
			'required' => 'Data Tidak Boleh Kosong'
		]);
		$this->form_validation->set_rules('tgllahir', 'tgllahir', 'required|trim', [
			'required' => 'Data Tidak Boleh Kosong'
		]);
		$this->form_validation->set_rules('jenkel', 'jenkel', 'required|trim', [
			'required' => 'Data Tidak Boleh Kosong'
		]);
		$this->form_validation->set_rules('agama', 'agama', 'required|trim', [
			'required' => 'Data Tidak Boleh Kosong'
		]);
		$this->form_validation->set_rules('status', 'status', 'required|trim', [
			'required' => 'Data Tidak Boleh Kosong'
		]);
		$this->form_validation->set_rules('ktp_prov', 'ktp_prov', 'required|trim', [
			'required' => 'Data Tidak Boleh Kosong'
		]);
		$this->form_validation->set_rules('ktp_kota', 'ktp_kota', 'required|trim', [
			'required' => 'Data Tidak Boleh Kosong'
		]);
		$this->form_validation->set_rules('ktp_kec', 'ktp_kec', 'required|trim', [
			'required' => 'Data Tidak Boleh Kosong'
		]);
		$this->form_validation->set_rules('ktp_kel', 'ktp_kel', 'required|trim', [
			'required' => 'Data Tidak Boleh Kosong'
		]);
		$this->form_validation->set_rules('rw', 'rw', 'required|trim', [
			'required' => 'Data Tidak Boleh Kosong'
		]);
		$this->form_validation->set_rules('rt', 'rt', 'required|trim', [
			'required' => 'Data Tidak Boleh Kosong'
		]);
		$this->form_validation->set_rules('alamat', 'alamat', 'required|trim', [
			'required' => 'Data Tidak Boleh Kosong'
		]);
		$this->form_validation->set_rules('dom_prov', 'dom_prov', 'required|trim', [
			'required' => 'Data Tidak Boleh Kosong'
		]);
		$this->form_validation->set_rules('dom_kab', 'dom_kab', 'required|trim', [
			'required' => 'Data Tidak Boleh Kosong'
		]);
		$this->form_validation->set_rules('dom_kec', 'dom_kec', 'required|trim', [
			'required' => 'Data Tidak Boleh Kosong'
		]);
		$this->form_validation->set_rules('dom_kel', 'dom_kel', 'required|trim', [
			'required' => 'Data Tidak Boleh Kosong'
		]);
		$this->form_validation->set_rules('dom_rw', 'dom_rw', 'required|trim', [
			'required' => 'Data Tidak Boleh Kosong'
		]);
		$this->form_validation->set_rules('dom_rt', 'dom_rt', 'required|trim', [
			'required' => 'Data Tidak Boleh Kosong'
		]);
		$this->form_validation->set_rules('domisili', 'domisili', 'required|trim', [
			'required' => 'Data Tidak Boleh Kosong'
		]);
		$this->form_validation->set_rules('hp', 'hp', 'required|trim', [
			'required' => 'Data Tidak Boleh Kosong'
		]);
		$this->form_validation->set_rules('email', 'email', 'required|trim', [

			'required' => 'Data Tidak Boleh Kosong'
		]);


		if ($this->form_validation->run() == false) {
			$this->load->view('temp/header', $data);
			$this->load->view('temp/sidebar', $data);
			$this->load->view('temp/topbar', $data);
			$this->load->view('user/editktp', $data);
			$this->load->view('temp/footer');
		} else {

			$this->db->set('tempat_lahir', $this->input->post('tempat'));
			$this->db->set('tgl_lahir', $this->input->post('tgllahir'));
			$this->db->set('kd_jenkel', $this->input->post('jenkel'));
			$this->db->set('kd_goldar', $this->input->post('goldar'));
			$this->db->set('kd_agama', $this->input->post('agama'));
			$this->db->set('kd_status', $this->input->post('status'));
			$this->db->set('kd_alamat_prov', $this->input->post('ktp_prov'));
			$this->db->set('kd_alamat_kota', $this->input->post('ktp_kota'));
			$this->db->set('kd_alamat_kec', $this->input->post('ktp_kec'));
			$this->db->set('kd_alamat_kel', $this->input->post('ktp_kel'));
			$this->db->set('alamat_rw', $this->input->post('rw'));
			$this->db->set('alamat_rt', $this->input->post('rt'));
			$this->db->set('alamat', $this->input->post('alamat'));
			$this->db->set('kd_dom_prov', $this->input->post('dom_prov'));
			$this->db->set('kd_dom_kota', $this->input->post('dom_kab'));
			$this->db->set('kd_dom_kec', $this->input->post('dom_kec'));
			$this->db->set('kd_dom_kel', $this->input->post('dom_kel'));
			$this->db->set('dom_rw', $this->input->post('dom_rw'));
			$this->db->set('dom_rt', $this->input->post('dom_rt'));
			$this->db->set('dom_alamat', $this->input->post('domisili'));
			$this->db->set('hp', $this->input->post('hp'));
			$this->db->set('email', $this->input->post('email'));



			$this->db->where('username', $this->session->userdata('username'));
			$this->db->update('user');
			$this->session->set_flashdata('messege', 'Diupdate');
			redirect('user');
		}
	}

	public function editkk()
	{
		$data['title'] = 'Edit KK';
		$this->db->select('*');
		$this->db->from('user');
		$this->db->where('user.username', $this->session->userdata('username'));
		$data['user'] = $this->db->get()->row_array();

		$this->db->select('*');
		$this->db->from('user_kk');
		$this->db->where('nik', $data['user']['nik']);
		$data['nok'] = $this->db->get()->row_array();

		$this->db->select('*');
		$this->db->from('user_kk');
		$this->db->where('nik', $data['user']['nik']);
		$kk = $this->db->get();


		if ($kk->num_rows() <= 0) {
			$this->form_validation->set_rules('nokk', 'nokk', 'required|trim', [
				'required' => 'Data Tidak Boleh Kosong'
			]);
			$this->form_validation->set_rules('statuskk', 'statuskk', 'required|trim', [
				'required' => 'Data Tidak Boleh Kosong'
			]);


			if ($this->form_validation->run() == false) {
				$this->load->view('temp/header', $data);
				$this->load->view('temp/sidebar', $data);
				$this->load->view('temp/topbar', $data);
				$this->load->view('user/editkk', $data);
				$this->load->view('temp/footer');
			} else {
				$uploadimg = $_FILES['image']['name'];
				if ($uploadimg) {
					$config['upload_path'] = './assets/img/kk';
					$config['allowed_types'] = 'jpg';
					$config['max_size']     = '2000'; //artinya 2mb 

					$this->load->library('upload', $config);
				}
				if ($this->upload->do_upload('image')) {

					$lama = $data['nok']['fotokk'];
					if ($lama != 'ktp.png') {
						unlink(FCPATH . 'assets/img/kk/' . $lama);
					}
					$new_image = $this->upload->data('file_name');
					$this->db->set('fotokk', $new_image);
				} else {
					$this->session->set_flashdata('messege', '<div class="alert alert-danger" role="alert">periksa lagi ukuran foto</div>');
					redirect('user/editkk');
				}

				$this->db->set('nik', $data['user']['nik']);
				$this->db->set('nokk', $this->input->post('nokk'));
				$this->db->set('statuskk', $this->input->post('statuskk'));
				$this->db->insert('user_kk');
				$this->session->set_flashdata('messege', '<div class="alert alert-success" role="alert">No KK berhasil ditambahkan</div>');
				redirect('user');
			}
		} else {
			$this->form_validation->set_rules('nokk', 'nokk', 'required|trim', [
				'required' => 'Data Tidak Boleh Kosong'
			]);
			$this->form_validation->set_rules('statuskk', 'statuskk', 'required|trim', [
				'required' => 'Data Tidak Boleh Kosong'
			]);
			if ($this->form_validation->run() == false) {
				$this->load->view('temp/header', $data);
				$this->load->view('temp/sidebar', $data);
				$this->load->view('temp/topbar', $data);
				$this->load->view('user/editkk', $data);
				$this->load->view('temp/footer');
			} else {
				$uploadimg = $_FILES['image']['name'];
				if ($uploadimg) {
					$config['upload_path'] = './assets/img/kk';
					$config['allowed_types'] = 'jpg';
					$config['max_size']     = '2000'; //artinya 2mb 

					$this->load->library('upload', $config);

					if ($this->upload->do_upload('image')) {

						$lama = $data['nok']['fotokk'];
						if ($lama != 'ktp.png') {
							unlink(FCPATH . 'assets/img/kk/' . $lama);
						}
						$new_image = $this->upload->data('file_name');
						$this->db->set('fotokk', $new_image);
					} else {
						$this->session->set_flashdata('messege', '<div class="alert alert-danger" role="alert">periksa lagi ukuran foto</div>');
						redirect('user/editkk');
					}
				}

				$this->db->set('nokk', $this->input->post('nokk'));
				$this->db->set('statuskk', $this->input->post('statuskk'));
				$this->db->where('nik', $data['user']['nik']);
				$this->db->update('user_kk');
				$this->session->set_flashdata('messege', '<div class="alert alert-success" role="alert">Profil berhasil diperbarui</div>');
				redirect('user');
			}
		}
		// $this->form_validation->set_rules('tempat', 'tempat', 'required|trim', [
		// 	'required' => 'Data Tidak Boleh Kosong'
		// ]);


	}

	public function carikota()
	{
		$prov = $this->input->post('ktp_prov');

		$kab = $this->db->get_where('kabupaten', ['id_prov' => $prov])->result_array();

		foreach ($kab as $k) {
			echo "<option value=" . $k['id_kab'] . ">" . $k['nama'] . "</option>";
		}
	}
	public function carikec()
	{
		$kab = $this->input->post('ktp_kota');

		$kec = $this->db->get_where('kecamatan', ['id_kab' => $kab])->result_array();

		foreach ($kec as $k) {
			echo "<option value=" . $k['id_kec'] . ">" . $k['nama'] . "</option>";
		}
	}

	public function carikel()
	{
		$kec = $this->input->post('ktp_kec');

		$kel = $this->db->get_where('kelurahan', ['id_kec' => $kec])->result_array();

		foreach ($kel as $l) {

			echo "<option value=" . $l['id_kel'] . ">" . $l['nama'] . "</option>";
		}
	}

	public function caridomkota()
	{
		$prov = $this->input->post('dom_prov');

		$kab = $this->db->get_where('kabupaten', ['id_prov' => $prov])->result_array();

		foreach ($kab as $k) {
			echo "<option value=" . $k['id_kab'] . ">" . $k['nama'] . "</option>";
		}
	}
	public function caridomkec()
	{
		$kab = $this->input->post('dom_kab');

		$kec = $this->db->get_where('kecamatan', ['id_kab' => $kab])->result_array();

		foreach ($kec as $k) {
			echo "<option value=" . $k['id_kec'] . ">" . $k['nama'] . "</option>";
		}
	}

	public function caridomkel()
	{
		$kec = $this->input->post('dom_kec');

		$kel = $this->db->get_where('kelurahan', ['id_kec' => $kec])->result_array();

		foreach ($kel as $l) {

			echo "<option value=" . $l['id_kel'] . ">" . $l['nama'] . "</option>";
		}
	}

	public function gantipassword()
	{
		$data['title'] = 'Ganti Password';
		$data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();

		$this->form_validation->set_rules('passlama', 'Password Lama', 'required|trim', [
			'required' => 'Password Lama Tidak Boleh Kosong'
		]);

		$this->form_validation->set_rules('passbaru', 'Password', 'required|trim|min_length[8]', [

			'min_length' => 'Password terlalu pendek',
			'required' => 'Data Tidak Boleh Kosong'
		]);
		$this->form_validation->set_rules('ulangpass', 'password', 'required|trim|matches[passbaru]', [
			'required' => 'Data Tidak Boleh Kosong',
			'matches' => 'password tidak sama'
		]);

		if ($this->form_validation->run() == false) {

			$this->load->view('temp/header', $data);
			$this->load->view('temp/sidebar', $data);
			$this->load->view('temp/topbar', $data);
			$this->load->view('user/gantipassword', $data);
			$this->load->view('temp/footer');
		} else {

			$plama = $this->input->post('passlama');
			$pbaru = $this->input->post('passbaru');

			if (!password_verify($plama, $data['user']['password'])) {
				$this->session->set_flashdata('messege', '<div class="alert alert-danger" role="alert">Password lama salah</div>');
				redirect('user/gantipassword');
			} else {
				if ($plama == $pbaru) {
					$this->session->set_flashdata('messege', '<div class="alert alert-danger" role="alert">password baru tidak boleh sama dengan password lama</div>');
					redirect('user/gantipassword');
				} else {
					$this->db->set('password', password_hash($pbaru, PASSWORD_DEFAULT));
					$this->db->where('username', $this->session->userdata('username'));
					$this->db->update('user');

					$this->session->set_flashdata('messege', '<div class="alert alert-success" role="alert">password berhasil diganti</div>');
					redirect('user/gantipassword');
				}
			}
		}
	}

	public function wfh()
	{
		$data['title'] = 'Input Data WFH';
		$data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
		$data['bidang'] = $this->db->get('bidang')->result_array();

		$this->load->view('temp/header', $data);
		$this->load->view('temp/sidebar', $data);
		$this->load->view('temp/topbar', $data);
		$this->load->view('user/wfh', $data);
		$this->load->view('temp/footer');
	}

	public function inputwfh()
	{
		$data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
		$new_name = time() . '-' . $data['user']['nik'] . '-' . $_FILES["gmbr"]['name'];
		$config['file_name'] = $new_name;
		$config['upload_path']          = './assets/img/wfh';
		$config['allowed_types']        = 'gif|jpg|png';
		$config['max_size']             = 2000; //2mb


		$this->load->library('upload', $config);
		if (!$this->upload->do_upload('gmbr')) {
			$this->session->set_flashdata('eror', 'periksa lagi ukuran foto, Max 2mb');
			redirect('user/wfh');
		} else {

			$new_image = $this->upload->data('file_name');
			$nik  = $data['user']['nik'];
			$tgl = $this->input->post('tglkerja');

			$ket = $this->input->post('ket');
			$data = [
				'nik' => $nik,
				'tgl_kerja' => $tgl,
				'bidang' => $data['user']['id_bidang'],
				'keterangan' => $ket,
				'img' => $new_image
			];
			$this->db->insert('wfh', $data);
			$this->session->set_flashdata('messege', 'berhasil');
			redirect('user/datawfh');
		}
	}

	public function datawfh()
	{
		$data['title'] = 'Data WFH';
		$data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
		$data['wfh'] = $this->db->get_where('wfh', ['nik' => $data['user']['nik']])->result_array();

		$this->load->view('temp/header', $data);
		$this->load->view('temp/sidebar', $data);
		$this->load->view('temp/topbar', $data);
		$this->load->view('user/datawfh', $data);
		$this->load->view('temp/footer');
	}

	public function delwfh($id)
	{
		$_id = $this->db->get_where('wfh', ['kd_wfh' => $id])->row();
		$query = $this->db->delete('wfh', ['kd_wfh' => $id]);
		if ($query) {
			unlink("./assets/img/wfh/" . $_id->img);
		}
		$this->session->set_flashdata('messege', 'berhasil');
		redirect('user/datawfh');
	}

	public function editwfh($id)
	{
		$data['title'] = 'Edit WFH';
		$data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
		$data['wfh'] = $this->db->get_where('wfh', ['nik' => $data['user']['nik']])->result_array();

		$this->load->view('temp/header', $data);
		$this->load->view('temp/sidebar', $data);
		$this->load->view('temp/topbar', $data);
		$this->load->view('user/editwfh', $data);
		$this->load->view('temp/footer');
	}

	public function laporanwfh()
	{
		$data['title'] = 'Laporan WFH';
		$data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
		$data['wfh'] = $this->db->get_where('wfh', ['nik' => $data['user']['nik']])->result_array();
		$data['bidang'] = $this->db->get('bidang')->result_array();

		$bidang = $this->input->post('bidang');

		$this->db->select('*, user.nama as nm');
		$this->db->from('wfh');
		$this->db->join('user', 'user.nik = wfh.nik');
		$this->db->where('wfh.bidang', $bidang);
		$data['hasil'] = $this->db->get()->result_array();

		$this->load->view('temp/header', $data);
		$this->load->view('temp/sidebar', $data);
		$this->load->view('temp/topbar', $data);
		$this->load->view('user/laporanwfh', $data);
		$this->load->view('temp/footer');
	}

	public function carilap()
	{
	}

	public function editstatuskaryawan()
	{
		$data['title'] = 'Edit Status Karyawan';
		$this->db->select('*, bidang.bidang as bdg');
		$this->db->from('user');
		$this->db->join('bidang', 'bidang.id_bidang = user.id_bidang');
		$this->db->where('user.username', $this->session->userdata('username'));
		$data['user'] = $this->db->get()->row_array();

		$this->db->select('*, bidang.bidang as bdg');
		$this->db->from('status_karyawan');
		$this->db->join('bidang', 'bidang.id_bidang = status_karyawan.id_bidang');
		$this->db->where('nik', $data['user']['nik']);
		$data['status'] = $this->db->get()->row_array();

		$stat = $this->db->get_where('status_karyawan', ['nik' => $data['user']['nik']]);
		if ($stat->num_rows() <= 0) {
			$this->form_validation->set_rules('subbidang', 'subbidang', 'required|trim', [
				'required' => 'sub bidang tidak boleh kosong'
			]);

			$this->form_validation->set_rules('tahun_mulai', 'tahun mulai', 'required|trim', [
				'required' => 'Data Tidak Boleh Kosong'
			]);
			$this->form_validation->set_rules('status', 'status', 'required|trim', [
				'required' => 'Data Tidak Boleh Kosong'
			]);
			$this->form_validation->set_rules('bpjs_ket', 'bpjs ket', 'required|trim', [
				'required' => 'Data Tidak Boleh Kosong'
			]);
			$this->form_validation->set_rules('no_rek', 'no rekening', 'required|trim', [
				'required' => 'Data Tidak Boleh Kosong'
			]);
			$this->form_validation->set_rules('gaji', 'gaji', 'required|trim', [
				'required' => 'Data Tidak Boleh Kosong'
			]);
			$this->form_validation->set_rules('pekerjaan', 'pekerjaan', 'required|trim', [
				'required' => 'Data Tidak Boleh Kosong'
			]);


			if ($this->form_validation->run() == false) {
				$this->load->view('temp/header', $data);
				$this->load->view('temp/sidebar', $data);
				$this->load->view('temp/topbar', $data);
				$this->load->view('user/tambahstatus', $data);
				$this->load->view('temp/footer');
			} else {
				$data = [
					'nik' => $data['user']['nik'],
					'status_karyawan' => $this->input->post('status'),
					'tahun_mulai' => $this->input->post('tahun_mulai'),
					'bpjs_ket' => $this->input->post('bpjs_ket'),
					'no_rek' => $this->input->post('no_rek'),
					'id_bidang' => $this->input->post('idbidang'),
					'id_subbidang' => $this->input->post('subbidang'),
					'pekerjaan' => $this->input->post('pekerjaan'),
					'gaji_pokok' => $this->input->post('gaji'),
				];

				$this->db->insert('status_karyawan', $data);
				$this->session->set_flashdata('messege', '<div class="alert alert-success" role="alert">data berhasil diupdate</div>');
				redirect('user');
			}
		} else {
			$this->db->select('*, bidang.bidang as bdg');
			$this->db->from('status_karyawan');
			$this->db->join('bidang', 'bidang.id_bidang = status_karyawan.id_bidang');
			$this->db->where('nik', $data['user']['nik']);
			$data['stt'] = $this->db->get()->row_array();

			$this->load->view('temp/header', $data);
			$this->load->view('temp/sidebar', $data);
			$this->load->view('temp/topbar', $data);
			$this->load->view('user/editstatuskaryawan', $data);
			$this->load->view('temp/footer');
		}
	}

	public function carisubbidang()
	{
		$idbidang = $this->input->post('idbidang');

		$sub = $this->db->get_where('subbidang', ['id_bidang' => $idbidang])->result_array();

		foreach ($sub as $k) {
			echo "<option value=" . $k['id_subbidang'] . ">" . $k['nama_subbidang'] . "</option>";
		}
	}

	public function editpendidikan()
	{
		$cari = $this->db->get_where('user_pendidikan', ['nik' => $this->session->userdata('nik')]);

		if ($cari->num_rows() > 0) {
			$data['title'] = 'Pendidikan Terakir';
			$this->db->select('*, bidang.bidang as bdg');
			$this->db->from('user');
			$this->db->join('bidang', 'bidang.id_bidang = user.id_bidang');
			$this->db->where('user.username', $this->session->userdata('username'));
			$data['user'] = $this->db->get()->row_array();

			$data['pendi'] = $this->db->get_where('user_pendidikan', ['nik' => $data['user']['nik']])->row_array();
			$this->form_validation->set_rules('jenjang', 'Jenjang Pendidikan', 'required|trim', [
				'required' => 'Pilih salah satu'
			]);
			$this->form_validation->set_rules('lembaga', 'lembaga', 'required|trim', [
				'required' => 'Lembaga Pendidikan Tidak Boleh Kosong'
			]);
			$this->form_validation->set_rules('masuk', 'Tahun Masuk', 'required|trim', [
				'required' => 'Tidak Boleh Kosong'
			]);
			$this->form_validation->set_rules('selesai', 'Tahun Selesai', 'required|trim', [
				'required' => 'Tidak Boleh Kosong'
			]);
			$this->form_validation->set_rules('jurusan', 'Jurusan', 'required|trim', [
				'required' => 'Tidak Boleh Kosong'
			]);
			if ($this->form_validation->run() == false) {
				$this->load->view('temp/header', $data);
				$this->load->view('temp/sidebar', $data);
				$this->load->view('temp/topbar', $data);
				$this->load->view('user/editpendidikan', $data);
				$this->load->view('temp/footer');
			} else {
				$uploadimg = $_FILES['image']['name'];
				if ($uploadimg) {
					$config['upload_path'] = './assets/img/ijazah';
					$config['allowed_types'] = 'jpg';
					$config['max_size']     = '2000'; //artinya 2mb 

					$this->load->library('upload', $config);
				}
				if ($this->upload->do_upload('image')) {

					$lama = $data['pendi']['fotoijazah'];
					if ($lama != 'awal.png') {
						unlink(FCPATH . 'assets/img/ijazah/' . $lama);
					}
					$new_image = $this->upload->data('file_name');
					$this->db->set('fotoijazah', $new_image);
				} else {
					$this->session->set_flashdata('messege', '<div class="alert alert-danger" role="alert">periksa lagi ukuran foto</div>');
					redirect('user/editpendidikan');
				}

				$this->db->where('nik', $data['user']['nik']);
				$this->db->set('jenjang', $this->input->post('jenjang'));
				$this->db->set('tahun_masuk', $this->input->post('masuk'));
				$this->db->set('tahun_selesai', $this->input->post('selesai'));
				$this->db->set('nama_lembaga', $this->input->post('lembaga'));
				$this->db->set('jurusan', $this->input->post('jurusan'));
				$this->db->update('user_pendidikan');
				$this->session->set_flashdata('messege', '<div class="alert alert-success" role="alert">Pendidikan Berhasil Ditambahkan</div>');
				redirect('user');
			}
		} else {
			$data['title'] = 'Pendidikan Terakir';
			$this->db->select('*, bidang.bidang as bdg');
			$this->db->from('user');
			$this->db->join('bidang', 'bidang.id_bidang = user.id_bidang');
			$this->db->where('user.username', $this->session->userdata('username'));
			$data['user'] = $this->db->get()->row_array();
			$data['pendi'] = $this->db->get_where('user_pendidikan', ['nik' => $data['user']['nik']])->row_array();
			$this->form_validation->set_rules('jenjang', 'Jenjang Pendidikan', 'required|trim', [
				'required' => 'Pilih salah satu'
			]);
			$this->form_validation->set_rules('lembaga', 'lembaga', 'required|trim', [
				'required' => 'Lembaga Pendidikan Tidak Boleh Kosong'
			]);
			$this->form_validation->set_rules('masuk', 'Tahun Masuk', 'required|trim', [
				'required' => 'Tidak Boleh Kosong'
			]);
			$this->form_validation->set_rules('selesai', 'Tahun Selesai', 'required|trim', [
				'required' => 'Tidak Boleh Kosong'
			]);
			$this->form_validation->set_rules('jurusan', 'Jurusan', 'required|trim', [
				'required' => 'Tidak Boleh Kosong'
			]);
			if ($this->form_validation->run() == false) {
				$this->load->view('temp/header', $data);
				$this->load->view('temp/sidebar', $data);
				$this->load->view('temp/topbar', $data);
				$this->load->view('user/tambahpendidikan', $data);
				$this->load->view('temp/footer');
			} else {
				$uploadimg = $_FILES['image']['name'];
				if ($uploadimg) {
					$config['upload_path'] = './assets/img/ijazah';
					$config['allowed_types'] = 'jpg';
					$config['max_size']     = '2000'; //artinya 2mb 

					$this->load->library('upload', $config);
				}
				if ($this->upload->do_upload('image')) {

					$lama = $data['pendi']['fotoijazah'];
					if ($lama != 'awal.png') {
						unlink(FCPATH . 'assets/img/ijazah/' . $lama);
					}
					$new_image = $this->upload->data('file_name');
					$this->db->set('fotoijazah', $new_image);
				} else {
					$this->session->set_flashdata('messege', '<div class="alert alert-danger" role="alert">periksa lagi ukuran foto</div>');
					redirect('user/editpendidikan');
				}

				$this->db->set('nik', $data['user']['nik']);
				$this->db->set('jenjang', $this->input->post('jenjang'));
				$this->db->set('tahun_masuk', $this->input->post('masuk'));
				$this->db->set('tahun_selesai', $this->input->post('selesai'));
				$this->db->set('nama_lembaga', $this->input->post('lembaga'));
				$this->db->set('jurusan', $this->input->post('jurusan'));
				$this->db->insert('user_pendidikan');
				$this->session->set_flashdata('messege', '<div class="alert alert-success" role="alert">Pendidikan Berhasil Ditambahkan</div>');
				redirect('user');
			}
		}
	}
}
