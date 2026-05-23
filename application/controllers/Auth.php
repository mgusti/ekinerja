<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
    }
    public function index()
    {

        if ($this->session->userdata('username')) {
            redirect('user');
        }
        $this->form_validation->set_rules('username', 'username', 'required|trim', [
            'required' => 'usernmae tidak boleh kosong'

        ]);

        $this->form_validation->set_rules('password', 'Password', 'required|trim', [
            'required' => 'Password tidak boleh kosong'

        ]);

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Login';
            $this->load->view('login/auth_header', $data);
            $this->load->view('login/login');
            $this->load->view('login/auth_footer');
        } else {
            $this->_login();
        }
    }

    private function _login()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        $user = $this->db->get_where('user', ['username' => $username])->row_array();

        //jika user ada	
        if ($user) {
            //jika user aktif
            if ($user['is_active'] == 1) {
                //cek password
                if (password_verify($password, $user['password'])) {

                    $data = [
                        'username' => $user['username'],
                        'role_id' => $user['role_id'],
                        'id_user' => $user['id_user']
                    ];
                    $this->session->set_userdata($data);

                    redirect('user');
                } else {

                    $this->session->set_flashdata('erlog', 'Password Salah');
                    redirect('auth');
                }
            } else {

                $this->session->set_flashdata('eror', 'Username Belum Diaktifasi');
                redirect('auth');
            }
        } else {

            $this->session->set_flashdata('eror', 'Username Tidak Terdaftar');
            redirect('auth');
        }
    }

    public function registration()
    {


        if ($this->session->userdata('nik')) {
            redirect('user');
        }
        $this->form_validation->set_rules('name', 'Name', 'required|trim', [
            'required' => 'Data Tidak Boleh Kosong'
        ]);
        $this->form_validation->set_rules('nik', 'nik', 'required|trim|is_unique[user.nik]|min_length[16]|max_length[20]', [
            'is_unique' => 'NIK sudah terdaftar',
            'required' => 'Data Tidak Boleh Kosong',
            'min_length' => 'Minimal 16 digit karakter',
            'max_length' => 'Maximal 20 digit karakter',
        ]);
        $this->form_validation->set_rules('nip', 'nip', 'trim|is_unique[user.nip]|min_length[18]|max_length[18]', [
            'is_unique' => 'NIP sudah terdaftar',
            'max_length' => 'harus 18 digit karakter',
            'min_length' => 'harus 18 digit karakter'

        ]);
        $this->form_validation->set_rules('username', 'username', 'required|trim|alpha_numeric|is_unique[user.username]|min_length[8]|max_length[12]', [
            'is_unique' => 'username sudah terdaftar',
            'required' => 'Data Tidak Boleh Kosong',
            'min_length' => 'username terlalu pendek min 8 karakter',
            'max_length' => 'Username terlalu panjang max 12 karakter',
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


        if ($this->form_validation->run() == false) {
            $data['role'] = $this->db->get('user_role')->result_array();
            $data['title'] = 'registration SIMRS';
            $data['jabatan'] = $this->db->get('jabatan')->result_array();
            $data['ruangan'] = $this->db->get('ruangan')->result_array();

            $this->load->view('login/auth_header', $data);
            $this->load->view('login/registration', $data);
            $this->load->view('login/auth_footer');
        } else {
            $data = [
                'nama' => $this->input->post('name'),
                'nik' => $this->input->post('nik'),
                'nip' => $this->input->post('nip'),
                'username' => $this->input->post('username'),
                'kd_jabatan' => $this->input->post('jabatan'),
                'kd_ruangan' => $this->input->post('ruangan'),
                'image' => 'default.jpg',
                'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                'role_id' => 5,
                'is_active' => 1,
                'st_peg' => 1,
                'beda_pns' => 1

            ];

            $this->db->insert('user', $data);
            $this->session->set_flashdata('messege', 'didaftarkan, silahkan login menggunakan username dan password anda');
            redirect('auth');
        }
    }

    public function logout()
    {
        $this->session->unset_userdata('username');
        $this->session->unset_userdata('role_id');
        $this->session->unset_userdata('id_user');

        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
        Anda berhasi keluar
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>');
        redirect('auth');
    }

    public function blocked()
    {
        $this->load->view('login/blocked');
    }
}
