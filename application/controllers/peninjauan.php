<?php
defined('BASEPATH') or exit('No direct script access allowed');

class peninjauan extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        is_logged_in();
        $this->load->library('form_validation');
    }


    public function peninjauankinerja()
    {
        $data['title'] = 'Peninjauan Kinerja';
        $data['user'] = $this->db->get_where('user', ['id_user' => $this->session->userdata('id_user')])->row_array();

        $data['jabatan'] = $this->db->get_where('jabatan', ['kd_jabatan' => $data['user']['kd_jabatan']])->row_array();
        $data['ruangan'] = $this->db->get_where('ruangan', ['kd_ruangan' => $data['user']['kd_ruangan']])->row_array();

        $this->db->select('*');
        $this->db->from('user');
        $this->db->where('kd_ruangan', $data['user']['kd_ruangan']);
        $this->db->where('role_id', '2');

        $data['ubid'] = $this->db->get()->result_array();

        $this->load->view('temp/header', $data);
        $this->load->view('temp/sidebar', $data);
        $this->load->view('temp/topbar', $data);
        $this->load->view('penilaian/penilaiankinerja', $data);
        $this->load->view('temp/footer');
    }

    public function datakinerja($id)
    {
        $data['title'] = 'Data Kinerja';
        $data['user'] = $this->db->get_where('user', ['id_user' => $this->session->userdata('id_user')])->row_array();

        $data['bidang'] = $this->db->get_where('bidang', ['id_bidang' => $data['user']['id_bidang']])->row_array();

        $this->db->select('*');
        $this->db->from('user');
        $this->db->where('id_user', $id);
        $data['us'] = $this->db->get()->row_array();


        $this->db->select('*');
        $this->db->from('kinerja');
        $this->db->where('user_id', $id);
        $this->db->where('month(tgl)', $this->input->post('bulan'));
        $this->db->where('year(tgl)', $this->input->post('tahun'));
        $this->db->order_by('tgl ASC');
        $data['kin'] = $this->db->get()->result_array();

        $this->load->view('temp/header', $data);
        $this->load->view('temp/sidebar', $data);
        $this->load->view('temp/topbar', $data);
        $this->load->view('penilaian/datakinerja', $data);
        $this->load->view('temp/footer');
    }

    public function cetak($id)
    {
        $data['users'] = $this->db->get_where('user', ['id_user' => $this->session->userdata('id_user')])->row_array();

        $this->db->select('*, jabatan.nama_jabatan as bd, ruangan.nama_ruangan as asub');
        $this->db->from('user');
        $this->db->join('jabatan', 'user.kd_jabatan = jabatan.kd_jabatan');
        $this->db->join('ruangan', 'user.kd_ruangan = ruangan.kd_ruangan');
        $this->db->where('id_user', $id);
        $data['user'] = $this->db->get()->row_array();
        $data['bulan'] = $this->db->get_where('bulan', ['kode_bulan' => $this->input->post('bulan')])->row_array();

        $this->db->select('*');
        $this->db->from('kinerja');
        $this->db->where('user_id', $id);
        $this->db->where('month(tgl)', $this->input->post('bulan'));
        $this->db->where('year(tgl)', $this->input->post('tahun'));
        $this->db->order_by('tgl ASC');

        $data['kin'] = $this->db->get()->result_array();


        $this->load->view('penilaian/cetak', $data);
    }

    public function persetujuan()
    {
        $data['title'] = 'Persetujuan Kinerja';
        $data['user'] = $this->db->get_where('user', ['id_user' => $this->session->userdata('id_user')])->row_array();
        $data['ruangan'] = $this->db->get_where('ruangan', ['kd_ruangan' => $data['user']['kd_ruangan']])->row_array();
        $data['bulan'] = $this->db->get('bulan')->result_array();

        $this->db->select("*, user.nama as nm, count(distinct tgl) ds, month(tgl) as tg, year(tgl) as th");
        $this->db->from('kinerja');
        $this->db->join('user', 'user.id_user = kinerja.user_id');
        $this->db->group_by('kinerja.user_id');

        $this->db->where('user.kd_ruangan', $data['ruangan']['kd_ruangan']);
        $this->db->where('month(tgl)', $this->input->post('bulan'));
        $this->db->where('year(tgl)', $this->input->post('tahun'));
        $data['kin'] = $this->db->get()->result_array();

        $this->load->view('temp/header', $data);
        $this->load->view('temp/sidebar', $data);
        $this->load->view('temp/topbar', $data);
        $this->load->view('penilaian/persetujuan', $data);
        $this->load->view('temp/footer');
    }

    public function updatestatus()
    {
        $tgl = $this->input->post('tgl');
        $id = $this->input->post('id');
        $thn = $this->input->post('thn');
        $status = $this->input->post('status');

        $this->db->set('setujui', $status);
        $this->db->where('user_id', $id);
        $this->db->where('month(tgl)', $tgl);
        $this->db->where('year(tgl)', $thn);
        $this->db->update('kinerja');

        $this->session->set_flashdata('messege', 'Diupdate');
        redirect('peninjauan/persetujuan');
    }

    public function kinerjatkk($id, $bulan, $tahun)
    {

        $data['title'] = 'Table Kinerja';
        $data['user'] = $this->db->get_where('user', ['id_user' => $this->session->userdata('id_user')])->row_array();

        $this->db->select('*');
        $this->db->from('kinerja');
        $this->db->where('month(tgl)', $bulan);
        $this->db->where('year(tgl)', $tahun);
        $this->db->where('user_id', $id);

        $data['tkk'] = $this->db->get()->result_array();

        $this->load->view('penilaian/kinerjatkk', $data);
    }
}
