<?php
defined('BASEPATH') or exit('No direct script access allowed');

class master extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        is_logged_in();
        $this->load->library('form_validation');
    }

    public function databidang()
    {
        $data['title'] = 'Master Bidang';
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();

        $data['bidang'] = $this->db->get('bidang')->result_array();
        $this->load->view('temp/header', $data);
        $this->load->view('temp/sidebar', $data);
        $this->load->view('temp/topbar', $data);
        $this->load->view('master/databidang', $data);
        $this->load->view('temp/footer');
    }

    public function datasubbidang()
    {
        $data['title'] = 'Master Sub Bidang';
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $this->db->select('*');
        $this->db->from('subbidang');
        $this->db->join('bidang', 'bidang.id_bidang = subbidang.id_bidang');
        $data['subbidang'] = $this->db->get()->result_array();
        $data['bidang'] = $this->db->get('bidang')->result_array();
        $this->load->view('temp/header', $data);
        $this->load->view('temp/sidebar', $data);
        $this->load->view('temp/topbar', $data);
        $this->load->view('master/datasubbidang', $data);
        $this->load->view('temp/footer');
    }

    public function inpbidang()
    {
        $this->db->set('bidang', $this->input->post('bidang'));
        $this->db->insert('bidang');
        $this->session->set_flashdata('messege', 'DiTambah');
        redirect('master/databidang');
    }

    public function delbidang($kd)
    {

        $this->db->where('id_bidang', $kd);
        $this->db->delete('bidang');

        $this->session->set_flashdata('messege', 'DiHapus');
        redirect('master/databidang');
    }
    public function delsubbidang($kd)
    {

        $this->db->where('id_subbidang', $kd);
        $this->db->delete('subbidang');

        $this->session->set_flashdata('messege', 'DiHapus');
        redirect('master/datasubbidang');
    }

    public function inpsubbidang()
    {
        $this->db->set('id_bidang', $this->input->post('bidang'));
        $this->db->set('nama_subbidang', $this->input->post('subbidang'));
        $this->db->insert('subbidang');
        $this->session->set_flashdata('messege', 'DiTambah');
        redirect('master/datasubbidang');
    }

    public function datajabatan()
    {
        $data['title'] = 'Master Jabatan';
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $this->db->select('*');
        $this->db->from('jabatan');

        $data['jabatan'] = $this->db->get()->result_array();

        $this->load->view('temp/header', $data);
        $this->load->view('temp/sidebar', $data);
        $this->load->view('temp/topbar', $data);
        $this->load->view('master/datajabatan', $data);
        $this->load->view('temp/footer');
    }

    public function inpjabatan()
    {
        $this->db->set('nama_jabatan', $this->input->post('jabatan'));
        $this->db->insert('jabatan');
        $this->session->set_flashdata('messege', 'DiTambah');
        redirect('master/datajabatan');
    }

    public function deljabatan($kd)
    {
        $this->db->where('kd_jabatan', $kd);
        $this->db->delete('jabatan');

        $this->session->set_flashdata('messege', 'DiHapus');
        redirect('master/datajabatan');
    }

    public function dataruangan()
    {
        $data['title'] = 'Master Ruangan';
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $this->db->select('*');
        $this->db->from('ruangan');

        $data['ruangan'] = $this->db->get()->result_array();

        $this->load->view('temp/header', $data);
        $this->load->view('temp/sidebar', $data);
        $this->load->view('temp/topbar', $data);
        $this->load->view('master/dataruangan', $data);
        $this->load->view('temp/footer');
    }

    public function inpruangan()
    {
        $this->db->set('nama_ruangan', $this->input->post('ruangan'));
        $this->db->insert('ruangan');
        $this->session->set_flashdata('messege', 'DiTambah');
        redirect('master/dataruangan');
    }

    public function delruangan($kd)
    {
        $this->db->where('kd_ruangan', $kd);
        $this->db->delete('ruangan');

        $this->session->set_flashdata('messege', 'DiHapus');
        redirect('master/dataruangan');
    }
}
