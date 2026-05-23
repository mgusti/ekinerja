<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();

		is_logged_in();
		$this->load->library('form_validation');
	}

	public function index()
	{
		$data['title'] = 'Dashboard';
		$data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();


		$this->db->from('user');
		$this->db->where('role_id = 2');
		$data['tkk'] = $this->db->count_all_results();

		$this->db->from('user');
		$this->db->where('role_id = 3');
		$data['peninjau'] = $this->db->count_all_results();

		$this->db->select('ruangan.nama_ruangan as ns, count(user.nama) as total');
		$this->db->from('user');
		$this->db->join('ruangan', 'ruangan.kd_ruangan = user.kd_ruangan', 'left');
		$this->db->group_by('user.kd_ruangan');
		$this->db->where('user.role_id = 2');
		$data['group_tkk'] = $this->db->get()->result_array();

		$this->load->view('temp/header', $data);
		$this->load->view('temp/sidebar', $data);
		$this->load->view('temp/topbar', $data);
		$this->load->view('admin/index', $data);
		$this->load->view('temp/footer');
	}

	public function datauser()
	{

		$data['title'] = 'Data User';
		$data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
		$this->db->select('*, user_role.role as rr');
		$this->db->from('user');
		$this->db->join('ruangan', 'ruangan.kd_ruangan = user.kd_ruangan', 'left');
		$this->db->join('jabatan', 'jabatan.kd_jabatan = user.kd_jabatan', 'left');
		$this->db->join('user_role', 'user_role.id = user.role_id');
		$this->db->where_not_in('user.role_id', '1');
		$data['karyawan'] = $this->db->get()->result_array();
		$this->load->view('temp/header', $data);
		$this->load->view('temp/sidebar', $data);
		$this->load->view('temp/topbar', $data);
		$this->load->view('admin/datauser', $data);
		$this->load->view('temp/footer');
	}

	public function editaktif($aktif, $kode)
	{
		if ($aktif == '1') {
			$tif = '0';
		} else {
			$tif = '1';
		}
		$this->db->where('id_user', $kode);
		$this->db->set('is_active', $tif);
		$this->db->update('user');
		$this->session->set_flashdata('messege', 'diubah');
		redirect('admin/datauser');
	}

	public function hapususer($kd)
	{
		$this->db->where('id_user', $kd);
		$this->db->delete('user');

		$this->db->where('user_id', $kd);
		$this->db->delete('kinerja');

		$this->session->set_flashdata('messege', 'dihapus');
		redirect('admin/datauser');
	}

	public function rpassword($id)
	{
		$pass = password_hash('12345678', PASSWORD_DEFAULT);
		$this->db->set('password', $pass);
		$this->db->where('id_user', $id);
		$this->db->update('user');

		$this->session->set_flashdata('messege', 'direset');
		redirect('admin/datauser');
	}

	public function edituser($kd)
	{
		$data['title'] = 'Edit User';
		$data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
		$data['jabatan'] = $this->db->get('jabatan')->result_array();
		$data['ruangan'] = $this->db->get('ruangan')->result_array();
		$data['role'] = $this->db->get('user_role')->result_array();
		$this->db->select('*, user_role.role as rr');
		$this->db->from('user');
		$this->db->join('jabatan', 'jabatan.kd_jabatan = user.kd_jabatan', 'left');
		$this->db->join('user_role', 'user_role.id = user.role_id', 'left');
		$this->db->join('ruangan', 'ruangan.kd_ruangan = user.kd_ruangan', 'left');

		$this->db->where('user.id_user', $kd);
		$data['datauser'] = $this->db->get()->row_array();


		$this->load->view('temp/header', $data);
		$this->load->view('temp/sidebar', $data);
		$this->load->view('temp/topbar', $data);
		$this->load->view('admin/edituser', $data);
		$this->load->view('temp/footer');
	}

	public function carisub()
	{
		$idbidang = $this->input->post('bidang');

		$sub = $this->db->get_where('subbidang', ['id_bidang' => $idbidang])->result_array();

		foreach ($sub as $k) {
			echo "<option value=" . $k['id_subbidang'] . ">" . $k['nama_subbidang'] . "</option>";
		}
	}

	public function aksiedituser($id)
	{

		$this->db->set('nama', $this->input->post('nama'));
		$this->db->set('nik', $this->input->post('nik'));
		$this->db->set('nip', $this->input->post('nip'));
		$this->db->set('kd_jabatan', $this->input->post('jabatan'));
		$this->db->set('kd_ruangan', $this->input->post('ruangan'));
		$this->db->set('role_id', $this->input->post('role'));
		$this->db->set('id_absen', $this->input->post('id_absen'));
		$this->db->set('nomor_kontrak', $this->input->post('nokon'));
		$this->db->set('upah', $this->input->post('upah'));
		$this->db->where('id_user', $id);
		$this->db->update('user');


		$this->session->set_flashdata('messege', 'diubah');
		redirect('admin/datauser');
	}

	public function forminputuser()
	{

		$data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
		$data['jabatan'] = $this->db->get('jabatan')->result_array();
		$data['ruangan'] = $this->db->get('ruangan')->result_array();
		$data['role'] = $this->db->get('user_role')->result_array();
		$this->form_validation->set_rules('nik', 'nik', 'required|trim|is_unique[user.nik]', [
			'is_unique' => 'NIK sudah terdaftar',
			'required' => 'Data Tidak Boleh Kosong'
		]);
		$this->form_validation->set_rules('nip', 'nip', 'trim|is_unique[user.nip]', [
			'is_unique' => 'NIP sudah terdaftar',

		]);

		$this->form_validation->set_rules('nama', 'Nama', 'required|trim', [
			'required' => 'Data Tidak Boleh Kosong'
		]);

		$this->form_validation->set_rules('username', 'username', 'required|trim|alpha_numeric|is_unique[user.username]|min_length[8]|max_length[20]', [
			'is_unique' => 'username sudah terdaftar',
			'required' => 'Data Tidak Boleh Kosong',
			'min_length' => 'username terlalu pendek min 8 karakter',
			'max_length' => 'Username terlalu panjang max 20 karakter',
			'alpha_numeric' => 'Username Harus berupa huruf dan angka tidak boleh menggunakan spasi',

		]);
		$this->form_validation->set_rules('jabatan', 'jabatan', 'required|trim', [

			'required' => 'Data Tidak Boleh Kosong'
		]);
		$this->form_validation->set_rules('ruangan', 'ruangan', 'required|trim', [

			'required' => 'Data Tidak Boleh Kosong'
		]);
		$this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[8]', [

			'min_length' => 'Password terlalu pendek',
			'required' => 'Data Tidak Boleh Kosong'
		]);
		$this->form_validation->set_rules('cpassword', 'password', 'required|trim|matches[password]', [
			'required' => 'Data Tidak Boleh Kosong',
			'matches' => 'password tidak sama'
		]);

		$this->form_validation->set_rules('nokon', 'nokon', 'required|trim|is_unique[user.nomor_kontrak]', [
			'required' => 'Data Tidak Boleh Kosong',
			'is_unique' => 'nomor kontrak sudah ada'
		]);

		$this->form_validation->set_rules('upah', 'upah', 'required|trim', [
			'required' => 'Data Tidak Boleh Kosong',

		]);


		if ($this->form_validation->run() == false) {
			$data['title'] = 'Input User';
			$data['role'] = $this->db->get('user_role')->result_array();
			$data['title'] = 'Input User';
			$data['bidang'] = $this->db->get('bidang')->result_array();
			$data['sub'] = $this->db->get('subbidang')->result_array();

			$this->load->view('temp/header', $data);
			$this->load->view('temp/sidebar', $data);
			$this->load->view('temp/topbar', $data);
			$this->load->view('admin/forminputuser', $data);
			$this->load->view('temp/footer');
		} else {
			$data = [
				"nik" => $this->input->post('nik'),
				"nip" => $this->input->post('nip'),
				"nama" => $this->input->post('nama'),
				"username" => $this->input->post('username'),
				"password" => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
				"role_id" => $this->input->post('role'),
				"kd_jabatan" => $this->input->post('jabatan'),
				"kd_ruangan" => $this->input->post('ruangan'),
				"is_active" => 1,
				"image" => "default.jpg",
				"nomor_kontrak" => $this->input->post('nokon'),
				"upah" => $this->input->post('upah')
			];
			$this->db->insert('user', $data);
			$this->session->set_flashdata('messege', 'ditambakan');
			redirect('admin/datauser');
		}
	}


	public function cetakuser()
	{
		$this->db->select('*');
		$this->db->from('user');
		$this->db->join('ruangan', 'ruangan.kd_ruangan = user.kd_ruangan', 'left');
		$this->db->join('jabatan', 'jabatan.kd_jabatan = user.kd_jabatan', 'left');
		$this->db->where('beda_pns', '1');

		$data['user'] = $this->db->get()->result_array();
		$this->load->view('admin/cetakuser', $data);
	}
}
