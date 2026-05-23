<?php
defined('BASEPATH') or exit('No direct script access allowed');

class kinerja extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        is_logged_in();
        //$this->load->library('form_validation');
    }

    public function index()
    {
        $data['title'] = 'Data Kinerja';
        $data['user'] = $this->db->get_where('user', ['id_user' => $this->session->userdata('id_user')])->row_array();
        //$data['kinerja'] = $this->db->get_where('kinerja', ['user_id' => '3'])->result_array();
        //var_dump($data['kinerja']);
        $bulan = $this->input->post('bulan');
        $tahun = $this->input->post('tahun');

        $this->db->select('*');
        $this->db->from('kinerja');
        $this->db->where('user_id', $data['user']['id_user']);
        $this->db->where('month(tgl)', $bulan);
        $this->db->where('year(tgl)', $tahun);
        $this->db->order_by('timestamp', 'DESC');
        $data['kinerja'] = $this->db->get()->result_array();

        $this->load->view('temp/header', $data);
        $this->load->view('temp/sidebar', $data);
        $this->load->view('temp/topbar', $data);
        $this->load->view('kinerja/index', $data);
        $this->load->view('temp/footer');
    }

    public function inpkinerja()
    {
        $this->db->set('tgl', $this->input->post('tgl'));
        $this->db->set('deskripsi', $this->input->post('deskripsi'));
        $this->db->set('user_id', $this->input->post('user_id'));
        $this->db->insert('kinerja');

        $this->session->set_flashdata('messege', 'DiTambah');
        redirect('kinerja');
    }

    public function delkinerja($kd)
    {
        $this->db->where('kode_kinerja', $kd);
        $this->db->delete('kinerja');

        $this->session->set_flashdata('messege', 'Dihapus');
        redirect('kinerja');
    }

    public function editkinerja($kd)
    {
        $data['title'] = 'Edit Kinerja';
        $data['user'] = $this->db->get_where('user', ['id_user' => $this->session->userdata('id_user')])->row_array();
        $data['kin'] = $this->db->get_where('kinerja', ['kode_kinerja' => $kd])->row_array();

        $this->load->view('temp/header', $data);
        $this->load->view('temp/sidebar', $data);
        $this->load->view('temp/topbar', $data);
        $this->load->view('kinerja/editkinerja', $data);
        $this->load->view('temp/footer');
    }

    public function ekinerja($kd)
    {
        $this->db->set('tgl', $this->input->post('tgl'));
        $this->db->set('deskripsi', $this->input->post('deskripsi'));
        $this->db->where('kode_kinerja', $kd);
        $this->db->update('kinerja');

        $this->session->set_flashdata('messege', 'DiUbah');
        redirect('kinerja');
    }

    public function laporankinerja()
    {
        $data['title'] = 'Laporan Kinerja';
        $data['user'] = $this->db->get_where('user', ['id_user' => $this->session->userdata('id_user')])->row_array();
        $this->db->select('*, user.nama, bidang.bidang');
        $this->db->from('kinerja');
        $this->db->join('user', 'user.id_user = kinerja.user_id');
        $this->db->join('bidang', 'user.id_bidang = bidang.id_bidang');

        $data['kinerja'] = $this->db->get()->result_array();
        $this->load->view('temp/header', $data);
        $this->load->view('temp/sidebar', $data);
        $this->load->view('temp/topbar', $data);
        $this->load->view('kinerja/laporankinerja', $data);
        $this->load->view('temp/footer');
    }
}
