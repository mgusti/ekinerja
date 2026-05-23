<?php
defined('BASEPATH') or exit('No direct script access allowed');

class inventaris extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();

		is_logged_in();
		$this->load->library('form_validation');
		
    }

    public function index(){
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $r = $data['user']['kdruang'];
        $data['ruang'] = $this->db->get_where('aset_ruangan', ['kdruang' => $r])->row_array();
        $data['title'] = 'Inventaris Ruangan';
		
        
        
        $this->db->select('*, aset_barang.nmbarang as nama, kondisi_barang.namakondisi as nmkondisi');
        $this->db->from('aset_sub_barang');
        $this->db->join('aset_barang', 'aset_barang.kdbarang = aset_sub_barang.kdbarang');
        $this->db->join('kondisi_barang','kondisi_barang.kdkondisi = aset_sub_barang.kondisi');
        $this->db->where('aset_sub_barang.kdruang', $r );
        $data['barang'] = $this->db->get()->result_array();


        $this->load->view('temp/header', $data);
        $this->load->view('temp/sidebar', $data);
        $this->load->view('temp/topbar', $data);
        $this->load->view('inventaris/index', $data);
        $this->load->view('temp/footer');
    }

    public function kir(){
      $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $r = $data['user']['kdruang'];
        $data['ruang'] = $this->db->get_where('aset_ruangan', ['kdruang' => $r])->row_array();
        $data['title'] = 'KIR';
        
        
        $this->db->select("*, aset_barang.nmbarang as nama, sum(kondisi=1) as baik, sum(kondisi=2) as sedang, sum(kondisi=3) as rusak, count(kdsub) as toba");
        $this->db->from('aset_sub_barang');
        $this->db->join('aset_barang', 'aset_barang.kdbarang = aset_sub_barang.kdbarang');
        $this->db->group_by('aset_sub_barang.kdbarang');
        $this->db->group_by('aset_sub_barang.thn_anggaran');
        $this->db->group_by('aset_sub_barang.jenis_anggaran');
        $this->db->where('aset_sub_barang.kdruang', $r );
        $data['barang'] = $this->db->get()->result_array();

               

        $this->load->view('temp/header', $data);
        $this->load->view('temp/sidebar', $data);
        $this->load->view('temp/topbar', $data);
        $this->load->view('inventaris/kir', $data);
        $this->load->view('temp/footer');
    }

    public function einvent($kd){
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['title'] = 'Edit Kondisi';
        $this->db->select('*, namakondisi');
        $this->db->from('aset_sub_barang');
        $this->db->join('kondisi_barang', 'kondisi_barang.kdkondisi = aset_sub_barang.kondisi');
        $this->db->where('kdsub', $kd);
        $data['kon'] = $this->db->get()->row_array();
        $data['kondisi'] = $this->db->get('kondisi_barang')->result_array();
        $this->load->view('temp/header', $data);
        $this->load->view('temp/sidebar', $data);
        $this->load->view('temp/topbar', $data);
        $this->load->view('inventaris/einvent', $data);
        $this->load->view('temp/footer');
    }

    public function ekon($kd){
      $this->db->where('kdsub', $kd);
      $this->db->set('kondisi', $this->input->post('kondisi'));
      $this->db->update('aset_sub_barang');
      

      $this->session->set_flashdata('messege', 'DiUbah');
			redirect('inventaris');
    }

    public function lapkir(){
      $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
      $r = $data['user']['kdruang'];
      $data['ruang'] = $this->db->get_where('aset_ruangan', ['kdruang' => $r])->row_array();

      $this->db->select("*, aset_barang.nmbarang as nama, sum(kondisi=1) as baik, sum(kondisi=2) as sedang, sum(kondisi=3) as rusak,count(kdsub) as toba");
      $this->db->from('aset_sub_barang');
      $this->db->join('aset_barang', 'aset_barang.kdbarang = aset_sub_barang.kdbarang');
      $this->db->group_by('aset_sub_barang.kdbarang');
      $this->db->group_by('aset_sub_barang.thn_anggaran');
      $this->db->group_by('aset_sub_barang.jenis_anggaran');
      $this->db->where('aset_sub_barang.kdruang', $r );

      $data['barang'] = $this->db->get()->result_array();


      $this->db->select("sum(nilai_barang) as nilai, count(kdsub) as totkd, sum(kondisi=3) as rusak1, sum(kondisi=2) as kurang1, sum(kondisi=1) as baik1");
      $this->db->from('aset_sub_barang');
      
      $this->db->where('aset_sub_barang.kdruang', $r );
      $data['total1'] = $this->db->get()->row_array(); 

      $this->load->view('inventaris/lapkir', $data);
    }
}